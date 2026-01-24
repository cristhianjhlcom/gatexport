<?php

declare(strict_types=1);

namespace App\Actions\Sales;

use App\Models\Product;
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

    public function __invoke(Product $product, array $data): array
    {
        $contact = $this->createOrGetContact($data);

        $deal = $this->createDeal($product, $data, $contact['id']);

        $this->associateContactWithDeal($contact['id'], $deal['id']);

        return [
            'contact' => $contact,
            'deal' => $deal,
        ];
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
        } catch (\Exception $e) {
            $response = $this->client->get("/crm/v3/objects/contacts/{$data['email']}", [
                'query' => ['idProperty' => 'email'],
            ]);

            return json_decode($response->getBody()->getContents(), true);
        }
    }

    private function createDeal(Product $product, array $data, string $contactId): array
    {
        $dealName = sprintf(
            '%s - %s %s',
            $product->name,
            $data['firstName'],
            $data['lastName']
        );

        $response = $this->client->post('/crm/v3/objects/deals', [
            'json' => [
                'properties' => [
                    'dealname' => $dealName,
                    'dealstage' => 'qualifiedtobuy',
                    'pipeline' => 'default',
                    'amount' => $product->price * $data['quantity'],
                    'closedate' => now()->addDays(30)->timestamp * 1000,
                    'hubspot_owner_id' => null,
                    'description' => $this->formatDealDescription($product, $data),
                ],
            ],
        ]);

        return json_decode($response->getBody()->getContents(), true);
    }

    private function associateContactWithDeal(string $contactId, string $dealId): void
    {
        $this->client->put("/crm/v3/objects/contacts/{$contactId}/associations/deals/{$dealId}/deal_to_contact");
    }

    private function formatDealDescription(Product $product, array $data): string
    {
        return sprintf(
            "Product Inquiry Details:\n\nProduct: %s\nQuantity: %d\nCustomer Notes: %s\nPhone: %s",
            $product->name,
            $data['quantity'],
            $data['notes'],
            $data['phone']
        );
    }
}
