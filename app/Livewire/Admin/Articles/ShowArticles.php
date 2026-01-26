<?php

declare(strict_types=1);

namespace App\Livewire\Admin\Articles;

use Exception;
use Illuminate\Support\Facades\Log;
use Livewire\Component;
use SevenShores\Hubspot\Factory;

final class ShowArticles extends Component
{
    public function render()
    {
        $accessToken = config('hubspot.access');

        Log::debug('[HubSpot] ShowArticles - Token check', [
            'has_token' => ! empty($accessToken),
            'token_length' => $accessToken ? strlen($accessToken) : 0,
        ]);

        if (empty($accessToken)) {
            Log::warning('[HubSpot] ShowArticles - Missing access token');

            return view('livewire.admin.articles.show-articles', ['articles' => collect()])
                ->layout('components.layouts.admin')
                ->title('Manejo de artículos');
        }

        try {
            Log::info('[HubSpot] ShowArticles - Fetching blog posts');

            $hubspot = Factory::createWithAccessToken($accessToken);
            $response = $hubspot->blogPosts()->all([
                'state' => 'PUBLISHED',
                'limit' => 10,
            ]);

            Log::info('[HubSpot] ShowArticles - Blog posts fetched successfully', [
                'count' => count($response->data->objects ?? []),
            ]);

            $collection = collect($response->data->objects);
            $articles = $collection->map(fn ($item) => [
                'id' => $item->id,
                'meta_description' => $item->meta_description,
                'title' => $item->page_title,
                'content' => $item->post_body,
                'summary' => $item->post_summary,
                'thumbnail' => $item->featured_image,
                'is_published' => $item->is_published,
            ]);

            return view('livewire.admin.articles.show-articles', compact('articles'))
                ->layout('components.layouts.admin')
                ->title('Manejo de artículos');
        } catch (Exception $e) {
            Log::error('[HubSpot] ShowArticles - Failed to fetch blog posts', [
                'error' => $e->getMessage(),
                'code' => $e->getCode(),
                'trace' => $e->getTraceAsString(),
            ]);

            return view('livewire.admin.articles.show-articles', ['articles' => collect()])
                ->layout('components.layouts.admin')
                ->title('Manejo de artículos');
        }
    }
}
