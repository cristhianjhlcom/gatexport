<?php

namespace App\Livewire\Admin\Articles;

use App\Models\Article;
use Livewire\Component;

class ShowArticles extends Component
{
    public function render()
    {
        $articles = Article::latest()->paginate(8);

        return view('livewire.admin.articles.show-articles', compact('articles'))
            ->layout('components.layouts.admin')
            ->title('Manejo de artículos');
    }
}
