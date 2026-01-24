<?php

declare(strict_types=1);

namespace App\Actions\Setting;

use App\Models\Category;
use App\Models\Product;
use App\Models\Subcategory;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;

final class GetStoreUrls
{
    public function execute()
    {
        return Cache::remember('all_store_urls', now()->addWeek(), function () {
            return DB::transaction(function () {
                $categories = Category::all()->map(fn (Category $category) => [
                    'id' => $category->slug,
                    'label' => $category->localizedName,
                    'path' => $category->showUrl,
                ]);

                $subcategories = Subcategory::all()->map(fn (Subcategory $subcategory) => [
                    'id' => $subcategory->slug,
                    'label' => $subcategory->localizedName,
                    'path' => $subcategory->indexUrl,
                ]);

                $products = Product::all()->map(fn (Product $product) => [
                    'id' => $product->slug,
                    'label' => $product->localizedName,
                    'path' => $product->showUrl,
                ]);

                return collect()
                    ->merge($categories)
                    ->merge($subcategories)
                    ->merge($products)
                    ->values();
            });
        });
    }
}
