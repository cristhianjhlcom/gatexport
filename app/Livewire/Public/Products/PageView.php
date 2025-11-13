<?php

declare(strict_types=1);

namespace App\Livewire\Public\Products;

use App\Enums\ProductStatusEnum;
use App\Models\Category;
use App\Models\Product;
use App\Models\Setting;
use Livewire\Component;
use Livewire\WithPagination;

final class PageView extends Component
{
    use WithPagination;

    public ?int $categoryId = null;

    public ?int $subcategoryId = null;

    protected $queryString = [
        'categoryId' => ['except' => null],
        'subcategoryId' => ['except' => null],
    ];

    public function render()
    {
        $productsQuery = Product::query()
            ->with(['subcategory', 'subcategory.category'])
            ->where('status', ProductStatusEnum::PUBLISHED);

        if ($this->subcategoryId) {
            $productsQuery->where('subcategory_id', $this->subcategoryId);
        } elseif ($this->categoryId) {
            $productsQuery->whereHas('subcategory', fn($query) => $query->where('category_id', $this->categoryId));
        }

        $products = $productsQuery->paginate(9);

        $categories = Category::query()
            ->with('subcategories')
            ->get();

        $details = Setting::getByLocale('product_page', app()->getLocale());

        return view('livewire.public.products.page-view', compact('products', 'categories', 'details'))
            ->layout('components.layouts.public');
    }

    public function filterByCategory(int $categoryId): void
    {
        $this->categoryId = $categoryId;
        $this->subcategoryId = null;
    }

    public function filterBySubcategory(int $subcategoryId): void
    {
        $this->subcategoryId = $subcategoryId;
    }
}
