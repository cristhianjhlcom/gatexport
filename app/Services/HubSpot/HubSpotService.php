<?php

declare(strict_types=1);

namespace App\Services\HubSpot;

use Exception;
use GuzzleHttp\Client;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Log;

final class HubSpotService
{
    private Client $client;

    private string $accessToken;

    public function __construct()
    {
        $this->accessToken = config('hubspot.access');

        if (empty($this->accessToken)) {
            Log::error('[HubSpotService] construct()', [
                'message' => 'Missing access token',
            ]);

            return;
        }

        $this->client = new Client([
            'base_uri' => 'https://api.hubapi.com',
            'headers' => [
                'Authorization' => "Bearer {$this->accessToken}",
                'Content-Type' => 'application/json',
            ],
        ]);
    }

    public function getListingArticles()
    {
        try {
            // $hubspot = Factory::createWithAccessToken($this->accessToken);
            // $response = $hubspot->blogPosts()->all([
            //     'state' => 'PUBLISHED',
            //     'limit' => 10,
            // ]);
            // Log::info('[HubSpotService] getListingArticles() Success');
            // $collection = collect($response->data->objects);
            // return $collection->map(fn($item) => [
            //     'id' => $item->id ??= '',
            //     'meta_description' => $item->meta_description ??= '',
            //     'title' => $item->page_title ??= '',
            //     'content' => $item->post_body ??= '',
            //     'summary' => $item->post_summary ??= '',
            //     'thumbnail' => $item->featured_image ??= '',
            //     'is_published' => $item->is_published ??= false,
            //     'slug' => $item->slug ??= '',
            //     'published_at' => Carbon::createFromTimestampMs($item->published_at)->diffForHumans(),
            // ]);
            $response = $this->client->get('/cms/v3/blogs/posts/');
            $content = json_decode($response->getBody()->getContents(), true);
            // $total = $content['total'] ??= 0;
            $results = $content['results'] ??= [];
            info('[HubSpotService] getListingArticles() Success');

            return collect($results)->map(fn ($item) => [
                'id' => $item['id'] ??= '',
                'meta_description' => $item['meta_description'] ??= '',
                'title' => $item['name'] ??= '',
                'content' => $item['postBody'] ??= '',
                'summary' => $item['postSummary'] ??= '',
                'thumbnail' => $item['featuredImage'] ??= '',
                'is_published' => $item['publishImmediately'] ??= false,
                'slug' => $item['slug'] ??= '',
                'published_at' => Carbon::createFromTimestampMs($item['publishDate'])->diffForHumans(),
            ]);
        } catch (Exception $error) {
            Log::error('[HubSpotService] getListingArticles() Failed', [
                'error' => $error->getMessage(),
                'code' => $error->getCode(),
            ]);

            return [];
        }
    }

    public function getSingleArticle($id)
    {
        try {
            // $hubspot = Factory::createWithAccessToken($this->accessToken);
            // $response = $hubspot->blogPosts()->all([
            //     'slug' => "blog/{$slug}",
            //     'state' => 'PUBLISHED',
            // ]);
            // $item = $response->data->objects[0];
            // return [
            //     'id' => $item->id ??= '',
            //     'meta_description' => $item->meta_description ??= '',
            //     'title' => $item->page_title ??= '',
            //     'content' => $item->post_body ??= '',
            //     'summary' => $item->post_summary ??= '',
            //     'thumbnail' => $item->featured_image ??= '',
            //     'is_published' => $item->is_published ??= false,
            //     'slug' => $item->slug ??= '',
            //     'published_at' => Carbon::createFromTimestampMs($item->published_at)->diffForHumans(),
            // ];
            $response = $this->client->get("/cms/v3/blogs/posts/{$id}");
            $item = json_decode($response->getBody()->getContents(), true);
            info('[HubSpotService] getListingArticles() Success');

            return [
                'id' => $item['id'] ??= '',
                'meta_description' => $item['metaDescription'] ??= '',
                'title' => $item['name'] ??= '',
                'content' => $item['postBody'] ??= '',
                'summary' => $item['postSummary'] ??= '',
                'thumbnail' => $item['featuredImage'] ??= '',
                'is_published' => $item['publishImmediately'] ??= false,
                'slug' => $item['slug'] ??= '',
                'canonical_url' => route('articles.show', $item['id']),
                'published_at' => Carbon::createFromTimestampMs($item['publishDate'])->diffForHumans(),
            ];
        } catch (Exception $error) {
            Log::error('[HubSpotService] getSingleArticle() Failed', [
                'error' => $error->getMessage(),
                'code' => $error->getCode(),
            ]);

            return [];
        }
    }

    public function createDeals(array $params)
    {
        $contact = $this->createOrGetContact($params['payload']);

        info('[HubSpotService] createDeals() - Contact Obtained', [
            'contact_id' => $contact['id'] ?? null,
        ]);

        try {
            $this->client->post('/crm/v3/objects/deals', [
                'json' => [
                    'properties' => [
                        'dealname' => sprintf('Oportunidad - %s', $params['interest']['product_name']),
                        'pipeline' => 'default',
                        'dealstage' => 'appointmentscheduled',
                        'product_name' => $params['interest']['product_name'],
                        'product_url' => $params['interest']['product_url'],
                        // 'description' => $this->formatDealDescription($data),
                        // 'closedate' => now()->addDays(30)->timestamp * 1000,
                        // 'hubspot_owner_id' => null,
                        // 'hs_priority' => 'medium',
                        // 'deal_currency_code' => 'USD',
                    ],
                    'associations' => [
                        [
                            'to' => ['id' => $contact['id']],
                            'types' => [
                                [
                                    'associationCategory' => 'HUBSPOT_DEFINED',
                                    'associationTypeId' => 3,
                                ],
                            ],
                        ],
                    ],
                ],
            ]);
            info('[HubSpotService] createDeals() Success');
        } catch (\GuzzleHttp\Exception\ClientException $error) {
            Log::error('[HubSpotService] createDeals() ClientException');

            $response = json_decode((string) $error->getResponse()->getBody(), true);
            if ($response['category'] === 'VALIDATION_ERROR') {
                foreach ($response['errors'] as $err) {
                    if ($err['code'] === 'PROPERTY_DOESNT_EXIST') {
                        $propertyName = $err['context']['propertyName'][0];
                        $this->createDealsProperty($propertyName);
                    }
                }

                // Reintentar después de crear las propiedades
                return $this->createDeals($params);
            }
            throw $error;
        } catch (Exception $error) {
            report($error);
            Log::error('[HubSpotService] createDeals() Failed', [
                'error' => $error->getMessage(),
                'code' => $error->getCode(),
            ]);
        }
    }

    public function createOrGetContact(array $data): array
    {
        try {
            $response = $this->client->post('/crm/v3/objects/contacts', [
                'json' => [
                    'properties' => [
                        'email' => $data['email'],
                        'firstname' => $data['firstName'],
                        'lastname' => $data['lastName'],
                        'phone' => $data['phone'],
                        'lifecyclestage' => 'lead',
                        // NOTE: En caso de ser necesario.
                        // NOTE: https://developers.hubspot.com/docs/api-reference/crm-contacts-v3/guide#recommended-properties
                        // 'mobilephone' => '',
                        // 'fax' => '',
                        // 'jobtitle' => '',
                        // 'address' => '',
                        // 'city' => '',
                        // 'state' => '',
                        // 'country' => '',
                        // 'zip' => '',
                    ],
                ],
            ]);

            info('[HubSpotService] createOrGetContact() Success');

            $result = json_decode($response->getBody()->getContents(), true);

            return $result;
        } catch (Exception $error) {
            Log::error('[HubSpotService] createOrGetContact() Failed', [
                'error' => $error->getMessage(),
                'code' => $error->getCode(),
            ]);

            return $this->getContactByEmail($data['email']);
        }
    }

    public function getContactByEmail(string $email)
    {
        try {
            $response = $this->client->get("/crm/v3/objects/contacts/{$email}", [
                'query' => ['idProperty' => 'email'],
            ]);

            $result = json_decode($response->getBody()->getContents(), true);

            Log::info('[HubSpotService] getContactByEmail() Success');

            return $result;
        } catch (Exception $error) {
            Log::error('[HubSpotService] getContactByEmail() Failed', [
                'error' => $error->getMessage(),
                'code' => $error->getCode(),
            ]);

            return null;
        }
    }

    private function createDealsProperty(string $name)
    {
        try {
            $this->client->post('/crm/v3/properties/deals', [
                'json' => [
                    'name' => $name,
                    'label' => ucfirst(str_replace('_', ' ', $name)),
                    'type' => 'string',
                    'fieldType' => 'text',
                    'groupName' => 'dealinformation',
                ],
            ]);
            Log::info('[HubSpotService] createDealsProperty() Success', [
                'property' => $name,
            ]);
        } catch (Exception $error) {
            Log::error('[HubSpotService] createDealsProperty() Failed', [
                'property' => $name,
                'error' => $error->getMessage(),
                'code' => $error->getCode(),
            ]);
        }
    }
}
