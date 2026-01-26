<?php

declare(strict_types=1);

namespace App\Http\Controllers\Public;

use App\Http\Controllers\Controller;
use Carbon\Carbon;
use Exception;
use Illuminate\Support\Facades\Log;
use SevenShores\Hubspot\Factory;

final class ArticleShowController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(string $slug)
    {
        $accessToken = config('hubspot.access');

        Log::debug('[HubSpot] ArticleShowController - Token check', [
            'has_token' => ! empty($accessToken),
            'token_length' => $accessToken ? strlen($accessToken) : 0,
            'slug' => $slug,
        ]);

        if (empty($accessToken)) {
            Log::warning('[HubSpot] ArticleShowController - Missing access token');
            abort(503, 'Service temporarily unavailable');
        }

        try {
            Log::info('[HubSpot] ArticleShowController - Fetching article', [
                'slug' => $slug,
            ]);

            $hubspot = Factory::createWithAccessToken($accessToken);
            $response = $hubspot->blogPosts()->all([
                'slug' => "blog/{$slug}",
                'state' => 'PUBLISHED',
            ]);

            if (empty($response->data->objects)) {
                Log::warning('[HubSpot] ArticleShowController - Article not found', [
                    'slug' => $slug,
                ]);
                abort(404, 'Artículo no encontrado');
            }

            Log::info('[HubSpot] ArticleShowController - Article found', [
                'slug' => $slug,
                'article_id' => $response->data->objects[0]->id ?? null,
            ]);

            $item = $response->data->objects[0];
            $article = [
                'id' => $item->id,
                'meta_description' => $item->meta_description,
                'title' => $item->page_title,
                'content' => $item->post_body,
                'summary' => $item->post_summary,
                'thumbnail' => $item->featured_image,
                'is_published' => $item->is_published,
                'canonical_url' => route('articles.show', ['slug' => str_replace('blog/', '', $item->slug)]),
                'published_at' => Carbon::createFromTimestampMs($item->published_at)->diffForHumans(),
            ];

            return view('pages.articles.show', compact('article'));
        } catch (Exception $e) {
            Log::error('[HubSpot] ArticleShowController - Failed to fetch article', [
                'slug' => $slug,
                'error' => $e->getMessage(),
                'code' => $e->getCode(),
                'trace' => $e->getTraceAsString(),
            ]);

            abort(503, 'Error loading article');
        }
    }
}
