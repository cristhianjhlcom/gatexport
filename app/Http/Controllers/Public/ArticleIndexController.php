<?php

namespace App\Http\Controllers\Public;

use App\Http\Controllers\Controller;
use Carbon\Carbon;
use SevenShores\Hubspot\Factory;

class ArticleIndexController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke()
    {
        // $articles = Article::published()->latest()->paginate(10);
        $hubspot = Factory::createWithAccessToken(config('hubspot.access'));
        $response = $hubspot->blogPosts()->all([
            // 'content_group_id' => 'TU_ID_DE_BLOG',
            'state' => 'PUBLISHED',
            'limit' => 10
        ]);
        $collection = collect($response->data->objects);
        $articles = $collection->map(fn($item) => [
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
    }
}
