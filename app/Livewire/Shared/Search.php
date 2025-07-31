<?php

declare(strict_types=1);

namespace App\Livewire\Shared;

use App\Models\Product;
use Livewire\Attributes\Url;
use Livewire\Component;

final class Search extends Component
{
    #[Url(except: '')]
    public string $search = '';

    public function render()
    {
        return view('livewire.shared.search', [
            'products' => Product::with([
                'images',
                'subcategory',
                'subcategory.category',
            ])
                ->search($this->search)
                ->limit(10)
                ->get(),
        ]);
    }
}
