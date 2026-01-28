<?php

declare(strict_types=1);

namespace App\Livewire\Public\Products;

use App\Enums\ProductStatusEnum;
use App\Models\Product;
use App\Models\Subcategory;
use Livewire\Component;
use Livewire\WithPagination;

final class SubcategoriesCatalog extends Component
{
    use WithPagination;

    public ?int $subcategoryId = null;

    public ?string $sort = null;

    public Subcategory $subcategory;

    protected $queryString = [
        'subcategoryId' => ['except' => null],
        'sort' => ['except' => ''],
    ];

    public function boot()
    {
        $this->subcategoryId = $this->subcategory->id;
    }

    public function filterBySubcategory($subcategoryId): void
    {
        $this->subcategoryId = is_null($subcategoryId) ? null : (int) $subcategoryId;
        $this->resetPage();
    }

    public function updatedSort(): void
    {
        $this->resetPage();
    }

    public function clearFilters(): void
    {
        $this->subcategoryId = $this->category->id;
        $this->subcategoryId = null;
        $this->sort = '';

        $this->resetPage();
    }

    public function render()
    {
        $products = Product::query()
            ->with(['subcategory', 'subcategory.category', 'images', 'specifications'])
            ->where('status', ProductStatusEnum::PUBLISHED);

        if ($this->subcategoryId) {
            $products->where('subcategory_id', $this->subcategoryId);
        }

        if ($this->sort === 'latest') {
            $products->orderBy('created_at', 'desc');
        } else {
            $products->ordered();
        }

        $products = $products->paginate(9);

        return view('livewire.public.products.subcategories-catalog', compact('products'));
    }
}
