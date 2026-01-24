<?php

declare(strict_types=1);

namespace App\Actions\HubSpot;

use GuzzleHttp\Client;

final class CreateOrUpdateContact
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
        try {
            $response = $this->client->post('/crm/v3/objects/contacts', [
                'json' => [
                    'properties' => [
                        'email' => $data['email'],
                        'firstname' => $data['name'],
                        'phone' => $data['phone'] ?? null,
                        'hs_lead_status' => 'NEW',
                        'lifecyclestage' => 'lead',
                    ],
                ],
            ]);

            return json_decode($response->getBody()->getContents(), true);
        } catch (\Exception $e) {
            // If contact already exists, update it
            $response = $this->client->get("/crm/v3/objects/contacts/{$data['email']}", [
                'query' => ['idProperty' => 'email'],
            ]);

            $contact = json_decode($response->getBody()->getContents(), true);

            // Update the existing contact
            $updateResponse = $this->client->patch("/crm/v3/objects/contacts/{$contact['id']}", [
                'json' => [
                    'properties' => [
                        'firstname' => $data['name'],
                        'phone' => $data['phone'] ?? null,
                        'hs_lead_status' => 'NEW',
                    ],
                ],
            ]);

            return json_decode($updateResponse->getBody()->getContents(), true);
        }
    }
}
