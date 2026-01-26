<?php

declare(strict_types=1);

namespace App\Actions\HubSpot;

use Exception;
use GuzzleHttp\Client;
use Illuminate\Support\Facades\Log;

final class CreateOrUpdateContact
{
    private Client $client;

    private bool $isConfigured = false;

    public function __construct()
    {
        $accessToken = config('hubspot.access');

        Log::debug('[HubSpot] CreateOrUpdateContact - Initializing client', [
            'has_token' => ! empty($accessToken),
            'token_length' => $accessToken ? strlen($accessToken) : 0,
        ]);

        if (empty($accessToken)) {
            Log::warning('[HubSpot] CreateOrUpdateContact - Missing access token');

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
            Log::error('[HubSpot] CreateOrUpdateContact - Cannot execute, client not configured');

            return ['error' => 'HubSpot not configured'];
        }

        Log::info('[HubSpot] CreateOrUpdateContact - Creating contact', [
            'email' => $data['email'],
            'name' => $data['name'] ?? null,
        ]);

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

            $result = json_decode($response->getBody()->getContents(), true);

            Log::info('[HubSpot] CreateOrUpdateContact - Contact created successfully', [
                'contact_id' => $result['id'] ?? null,
                'email' => $data['email'],
            ]);

            return $result;
        } catch (Exception $e) {
            Log::info('[HubSpot] CreateOrUpdateContact - Contact exists, attempting update', [
                'email' => $data['email'],
                'error' => $e->getMessage(),
            ]);

            try {
                $response = $this->client->get("/crm/v3/objects/contacts/{$data['email']}", [
                    'query' => ['idProperty' => 'email'],
                ]);

                $contact = json_decode($response->getBody()->getContents(), true);

                Log::debug('[HubSpot] CreateOrUpdateContact - Found existing contact', [
                    'contact_id' => $contact['id'] ?? null,
                ]);

                $updateResponse = $this->client->patch("/crm/v3/objects/contacts/{$contact['id']}", [
                    'json' => [
                        'properties' => [
                            'firstname' => $data['name'],
                            'phone' => $data['phone'] ?? null,
                            'hs_lead_status' => 'NEW',
                        ],
                    ],
                ]);

                $result = json_decode($updateResponse->getBody()->getContents(), true);

                Log::info('[HubSpot] CreateOrUpdateContact - Contact updated successfully', [
                    'contact_id' => $result['id'] ?? null,
                    'email' => $data['email'],
                ]);

                return $result;
            } catch (Exception $updateException) {
                Log::error('[HubSpot] CreateOrUpdateContact - Failed to update contact', [
                    'email' => $data['email'],
                    'error' => $updateException->getMessage(),
                    'code' => $updateException->getCode(),
                ]);

                throw $updateException;
            }
        }
    }
}
