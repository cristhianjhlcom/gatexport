<?php

namespace App\Http\Controllers\Public;

use App\Http\Controllers\Controller;
use App\Models\Article;
use Carbon\Carbon;
use Illuminate\Http\Request;
use SevenShores\Hubspot\Factory;

class ArticleShowController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(string $slug)
    {
        $hubspot = Factory::createWithAccessToken(config('hubspot.access'));
        $response = $hubspot->blogPosts()->all([
            'slug'   => "blog/{$slug}",
            'state'  => 'PUBLISHED'
        ]);

        if (empty($response->data->objects)) {
            abort(404, 'Artículo no encontrado');
        }

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
    }
}
