<?php

declare(strict_types=1);

namespace App\Http\Controllers\Public;

use App\Http\Controllers\Controller;
use Carbon\Carbon;
use Exception;
use Illuminate\Support\Facades\Log;
use SevenShores\Hubspot\Factory;

final class ArticleIndexController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke()
    {
        $accessToken = config('hubspot.access');

        Log::debug('[HubSpot] ArticleIndexController - Token check', [
            'has_token' => ! empty($accessToken),
            'token_length' => $accessToken ? mb_strlen($accessToken) : 0,
        ]);

        if (empty($accessToken)) {
            Log::warning('[HubSpot] ArticleIndexController - Missing access token, returning empty articles');

            return view('pages.articles.index', ['articles' => collect()]);
        }

        try {
            Log::info('[HubSpot] ArticleIndexController - Fetching blog posts');

            $hubspot = Factory::createWithAccessToken($accessToken);
            $response = $hubspot->blogPosts()->all([
                'state' => 'PUBLISHED',
                'limit' => 10,
            ]);

            Log::info('[HubSpot] ArticleIndexController - Blog posts fetched successfully', [
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
                'slug' => $item->slug,
                'published_at' => Carbon::createFromTimestampMs($item->published_at)->diffForHumans(),
            ]);

            return view('pages.articles.index', compact('articles'));
        } catch (Exception $e) {
            Log::error('[HubSpot] ArticleIndexController - Failed to fetch blog posts', [
                'error' => $e->getMessage(),
                'code' => $e->getCode(),
                'trace' => $e->getTraceAsString(),
            ]);

            return view('pages.articles.index', ['articles' => collect()]);
        }
    }
}
