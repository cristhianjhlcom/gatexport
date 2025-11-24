<?php

declare(strict_types=1);

namespace App\Http\Controllers\Public;

use App\Enums\ProductStatusEnum;
use App\Models\Category;
use App\Models\Product;
use App\Models\Subcategory;
use Illuminate\Routing\Controller;

final class ProductShowController extends Controller
{
    public function __invoke(Category $category, Subcategory $subcategory, Product $product)
    {
        abort_if(! $product->published, 404);

        // TODO: Mover a scope del modelo subcategory.
        $relatedProducts = $subcategory->products()
            ->where('id', '!=', $product->id)
            ->where('status', ProductStatusEnum::PUBLISHED)
            ->latest()
            ->limit(8)
            ->get();

        // TODO: Refactorizar la vista de productos.
        return view('pages.products.show')->with([
            'product' => $product,
            'subcategory' => $subcategory,
            'category' => $category,
            'relatedProducts' => $relatedProducts,
        ]);
    }
}
