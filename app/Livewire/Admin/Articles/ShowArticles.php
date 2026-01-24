<?php

declare(strict_types=1);

namespace App\Livewire\Admin\Articles;

use Livewire\Component;
use SevenShores\Hubspot\Factory;

final class ShowArticles extends Component
{
    public function render()
    {
        $hubspot = Factory::createWithAccessToken(config('hubspot.access'));
        $response = $hubspot->blogPosts()->all([
            // 'content_group_id' => 'TU_ID_DE_BLOG',
            'state' => 'PUBLISHED',
            'limit' => 10,
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
    }
}
