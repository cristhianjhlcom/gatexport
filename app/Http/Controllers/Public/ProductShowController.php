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
        abort_if($product->status !== ProductStatusEnum::PUBLISHED, 404);

        $category = $category->load('subcategories');
        $subcategory = $subcategory->load([
            'products.subcategory',
            'products.images',
        ]);
        $product = $product->load([
            'subcategory',
            'images',
            'specifications',
        ]);

        return view('pages.products.show')->with([
            'product' => $product,
            'subcategory' => $subcategory,
            'category' => $category,
        ]);
    }
}
