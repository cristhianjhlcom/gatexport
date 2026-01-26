<?php

declare(strict_types=1);

namespace App\Actions\Sales;

use Exception;
use GuzzleHttp\Client;
use Illuminate\Support\Facades\Log;

final class CreateHubspotDeal
{
    private Client $client;

    private bool $isConfigured = false;

    public function __construct()
    {
        $accessToken = config('hubspot.access');

        Log::debug('[HubSpot] CreateHubspotDeal - Initializing client', [
            'has_token' => ! empty($accessToken),
            'token_length' => $accessToken ? strlen($accessToken) : 0,
        ]);

        if (empty($accessToken)) {
            Log::warning('[HubSpot] CreateHubspotDeal - Missing access token');

            return;
        }

        $this->isConfigured = true;
        $this->client = new Client([
            'base_uri' => 'https://api.hubapi.com',
            'headers' => [
                'Authorization' => 'Bearer '.$accessToken,
                'Content-Type' => 'application/json',
            ],
        ]);
    }

    public function __invoke(array $data): array
    {
        if (! $this->isConfigured) {
            Log::error('[HubSpot] CreateHubspotDeal - Cannot execute, client not configured');

            return ['error' => 'HubSpot not configured', 'contact' => null, 'deal' => null];
        }

        Log::info('[HubSpot] CreateHubspotDeal - Starting deal creation process', [
            'email' => $data['email'],
            'product' => $data['interest']['product_name'] ?? null,
        ]);

        $contact = $this->createOrGetContact($data);

        try {
            $deal = $this->createDeal($data, $contact['id']);
            $this->associateContactWithDeal($contact['id'], $deal['id']);

            Log::info('[HubSpot] CreateHubspotDeal - Deal created and associated successfully', [
                'contact_id' => $contact['id'],
                'deal_id' => $deal['id'],
            ]);

            return [
                'contact' => $contact,
                'deal' => $deal,
            ];
        } catch (Exception $e) {
            Log::error('[HubSpot] CreateHubspotDeal - Failed to create deal', [
                'contact_id' => $contact['id'] ?? null,
                'error' => $e->getMessage(),
                'code' => $e->getCode(),
            ]);
            report($e);

            return [
                'contact' => $contact,
                'deal' => null,
            ];
        }
    }

    private function createOrGetContact(array $data): array
    {
        Log::info('[HubSpot] CreateHubspotDeal::createOrGetContact - Creating contact', [
            'email' => $data['email'],
        ]);

        try {
            $response = $this->client->post('/crm/v3/objects/contacts', [
                'json' => [
                    'properties' => [
                        'email' => $data['email'],
                        'firstname' => $data['firstName'],
                        'lastname' => $data['lastName'],
                        'phone' => $data['phone'],
                        'hs_lead_status' => 'NEW',
                        'lifecyclestage' => 'opportunity',
                    ],
                ],
            ]);

            $result = json_decode($response->getBody()->getContents(), true);

            Log::info('[HubSpot] CreateHubspotDeal::createOrGetContact - Contact created', [
                'contact_id' => $result['id'] ?? null,
            ]);

            return $result;
        } catch (Exception $e) {
            Log::info('[HubSpot] CreateHubspotDeal::createOrGetContact - Contact exists, fetching', [
                'email' => $data['email'],
                'error' => $e->getMessage(),
            ]);

            $response = $this->client->get("/crm/v3/objects/contacts/{$data['email']}", [
                'query' => ['idProperty' => 'email'],
            ]);

            $result = json_decode($response->getBody()->getContents(), true);

            Log::info('[HubSpot] CreateHubspotDeal::createOrGetContact - Existing contact fetched', [
                'contact_id' => $result['id'] ?? null,
            ]);

            return $result;
        }
    }

    private function createDeal(array $data, string $contactId): array
    {
        $dealName = sprintf(
            '%s - %s %s',
            $data['interest']['product_name'],
            $data['firstName'],
            $data['lastName']
        );

        Log::info('[HubSpot] CreateHubspotDeal::createDeal - Creating deal', [
            'deal_name' => $dealName,
            'contact_id' => $contactId,
        ]);

        $properties = [
            'dealname' => $dealName,
            'dealstage' => 'qualifiedtobuy',
            'pipeline' => 'default',
            'closedate' => now()->addDays(30)->timestamp * 1000,
            'hubspot_owner_id' => null,
            'description' => $this->formatDealDescription($data),
            'hs_priority' => 'medium',
            'deal_currency_code' => 'USD',
        ];

        $response = $this->client->post('/crm/v3/objects/deals', [
            'json' => [
                'properties' => $properties,
            ],
        ]);

        $deal = json_decode($response->getBody()->getContents(), true);

        Log::info('[HubSpot] CreateHubspotDeal::createDeal - Deal created', [
            'deal_id' => $deal['id'] ?? null,
        ]);

        $this->addNoteToObject('deal', $deal['id'], $this->formatDetailedNote($data));

        return $deal;
    }

    private function associateContactWithDeal(string $contactId, string $dealId): void
    {
        Log::debug('[HubSpot] CreateHubspotDeal::associateContactWithDeal - Associating', [
            'contact_id' => $contactId,
            'deal_id' => $dealId,
        ]);

        $this->client->put("/crm/v4/objects/contacts/{$contactId}/associations/default/deals/{$dealId}");

        Log::info('[HubSpot] CreateHubspotDeal::associateContactWithDeal - Association complete');
    }

    private function formatDealDescription(array $data): string
    {
        return sprintf(
            "Product Inquiry - %s\n\nCustomer interested in: %s\n\nView Product: %s\n\nContact: %s %s\nEmail: %s\nPhone: %s\n\nInquiry Date: %s",
            $data['interest']['product_name'],
            $data['interest']['product_name'],
            $data['interest']['product_url'],
            $data['firstName'],
            $data['lastName'],
            $data['email'],
            $data['phone'],
            now()->format('Y-m-d H:i:s')
        );
    }

    private function formatDetailedNote(array $data): string
    {
        return sprintf(
            '<h3>Product Inquiry Details</h3>
            <p><strong>Product:</strong> %s</p>
            <p><strong>Product URL:</strong> <a href="%s" target="_blank">%s</a></p>
            <hr>
            <p><strong>Customer Name:</strong> %s %s</p>
            <p><strong>Email:</strong> <a href="mailto:%s">%s</a></p>
            <p><strong>Phone:</strong> %s</p>
            <hr>
            <p><strong>Inquiry Date:</strong> %s</p>
            <p><em>This inquiry was automatically generated from the website product inquiry form.</em></p>',
            $data['interest']['product_name'],
            $data['interest']['product_url'],
            $data['interest']['product_url'],
            $data['firstName'],
            $data['lastName'],
            $data['email'],
            $data['email'],
            $data['phone'],
            now()->format('F j, Y \a\t g:i A')
        );
    }

    private function addNoteToObject(string $objectType, string $objectId, string $noteBody): void
    {
        Log::debug('[HubSpot] CreateHubspotDeal::addNoteToObject - Adding note', [
            'object_type' => $objectType,
            'object_id' => $objectId,
        ]);

        try {
            $noteResponse = $this->client->post('/crm/v3/objects/notes', [
                'json' => [
                    'properties' => [
                        'hs_note_body' => $noteBody,
                        'hs_timestamp' => now()->timestamp * 1000,
                    ],
                ],
            ]);

            $note = json_decode($noteResponse->getBody()->getContents(), true);

            Log::debug('[HubSpot] CreateHubspotDeal::addNoteToObject - Note created', [
                'note_id' => $note['id'] ?? null,
            ]);

            $this->client->put("/crm/v4/objects/notes/{$note['id']}/associations/default/{$objectType}s/{$objectId}");

            Log::info('[HubSpot] CreateHubspotDeal::addNoteToObject - Note associated successfully');
        } catch (Exception $e) {
            Log::warning('[HubSpot] CreateHubspotDeal::addNoteToObject - Failed to add note', [
                'object_type' => $objectType,
                'object_id' => $objectId,
                'error' => $e->getMessage(),
            ]);
            report($e);
        }
    }
}
