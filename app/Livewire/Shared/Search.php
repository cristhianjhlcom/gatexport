<?php

declare(strict_types=1);

namespace App\Livewire\Shared;

use App\Enums\ProductStatusEnum;
use App\Models\Product;
use Illuminate\Contracts\View\View;
use Illuminate\Database\Eloquent\Collection;
use Livewire\Attributes\Computed;
use Livewire\Attributes\Url;
use Livewire\Component;

final class Search extends Component
{
    public string $theme = 'light';

    #[Url(except: '')]
    public string $search = '';

    public function render(): View
    {
        return view('livewire.shared.search');
    }

    #[Computed]
    public function products(): Collection
    {
        if (! $this->search) {
            return new Collection();
        }

        return Product::query()
            ->with([
                'images',
                'subcategory',
                'subcategory.category',
            ])
            ->where('status', ProductStatusEnum::PUBLISHED)
            ->search($this->search)
            ->limit(10)
            ->get();
    }
}
