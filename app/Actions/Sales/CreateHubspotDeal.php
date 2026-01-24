<?php

declare(strict_types=1);

namespace App\Actions\Sales;

use Exception;
use GuzzleHttp\Client;

final class CreateHubspotDeal
{
    private Client $client;

    public function __construct()
    {
        $this->client = new Client([
            'base_uri' => 'https://api.hubapi.com',
            'headers' => [
                'Authorization' => 'Bearer '.config('hubspot.access'),
                'Content-Type' => 'application/json',
            ],
        ]);
    }

    public function __invoke(array $data): array
    {
        $contact = $this->createOrGetContact($data);

        try {
            $deal = $this->createDeal($data, $contact['id']);
            $this->associateContactWithDeal($contact['id'], $deal['id']);

            return [
                'contact' => $contact,
                'deal' => $deal,
            ];
        } catch (Exception $e) {
            // Log the error for debugging
            report($e);

            // If deal creation fails due to missing scopes, just return contact
            return [
                'contact' => $contact,
                'deal' => null,
            ];
        }
    }

    private function createOrGetContact(array $data): array
    {
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

            return json_decode($response->getBody()->getContents(), true);
        } catch (Exception $e) {
            $response = $this->client->get("/crm/v3/objects/contacts/{$data['email']}", [
                'query' => ['idProperty' => 'email'],
            ]);

            return json_decode($response->getBody()->getContents(), true);
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

        // Add a note to the deal with additional details
        $this->addNoteToObject('deal', $deal['id'], $this->formatDetailedNote($data));

        return $deal;
    }

    private function associateContactWithDeal(string $contactId, string $dealId): void
    {
        $this->client->put("/crm/v4/objects/contacts/{$contactId}/associations/default/deals/{$dealId}");
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

            // Associate note with the object (deal)
            $this->client->put("/crm/v4/objects/notes/{$note['id']}/associations/default/{$objectType}s/{$objectId}");
        } catch (Exception $e) {
            // Log but don't fail if note creation fails
            report($e);
        }
    }
}
