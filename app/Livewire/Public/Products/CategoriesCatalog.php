<?php

namespace App\Livewire\Public\Products;

use App\Enums\ProductStatusEnum;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Support\Collection;
use Livewire\Component;
use Livewire\WithPagination;

class CategoriesCatalog extends Component
{
    use WithPagination;

    public ?int $categoryId = null;
    public int|string|null $subcategoryId = null;
    public ?string $sort = null;
    public Category $category;
    public Collection $subcategories;

    protected $queryString = [
        'subcategoryId' => ['except' => null],
        'sort' => ['except' => ''],
    ];

    public function boot()
    {
        $this->subcategories = $this->category->subcategories;
        $this->categoryId = $this->category->id;
    }

    public function filterBySubcategory($subcategoryId): void
    {
        $this->subcategoryId = is_null($subcategoryId) ? null : (int) $subcategoryId;
        $this->resetPage();
    }

    public function updatedCategoryId(): void
    {
        $this->resetPage();
    }

    public function updatedSubcategoryId(): void
    {
        if (!is_null($this->subcategoryId) && is_numeric($this->subcategoryId)) {
            $this->subcategoryId = (int) $this->subcategoryId;
        } elseif (!is_numeric($this->subcategoryId)) {
            $this->subcategoryId = null;
        }

        $this->resetPage();
    }

    public function updatedSort(): void
    {
        $this->resetPage();
    }

    public function clearFilters(): void
    {
        $this->categoryId = $this->category->id;
        $this->subcategoryId = null;
        $this->sort = '';

        $this->resetPage();
    }

    public function render()
    {
        $products = Product::query()
            ->with(['subcategory', 'subcategory.category', 'images'])
            ->where('status', ProductStatusEnum::PUBLISHED);

        if ($this->subcategoryId) {
            $products->where('subcategory_id', $this->subcategoryId);
        } elseif ($this->categoryId) {
            $products->whereHas('subcategory', fn($query) => $query->where('category_id', $this->categoryId));
        }

        if ($this->sort === 'latest') {
            $products->orderBy('created_at', 'desc');
        }

        $products = $products->paginate(9);

        return view('livewire.public.products.categories-catalog', compact('products'));
    }
}
