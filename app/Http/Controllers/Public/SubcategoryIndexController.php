<?php

declare(strict_types=1);

namespace App\Http\Controllers\Public;

use App\Enums\ProductStatusEnum;
use App\Models\Category;
use App\Models\Subcategory;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

final class SubcategoryIndexController extends Controller
{
    public function __invoke(Request $request, Category $category, Subcategory $subcategory)
    {
        $category = $category->load([
            'subcategories',
            'subcategories.products',
            'subcategories.products.images',
            'subcategories.products.subcategory.category',
            'subcategories.category',
        ]);
        // $category = $category->load('subcategories');
        $subcategory = $subcategory->load([
            'products.subcategory',
            'products.images',
            'products.specifications',
            'products.subcategory.category',
        ]);
        $products = $subcategory
            ->products()
            ->where('status', ProductStatusEnum::PUBLISHED)
            ->orderBy('created_at', 'desc')
            ->get();

        return view('pages.subcategories.index')->with([
            'products' => $products,
            'subcategory' => $subcategory,
            'category' => $category,
        ]);
    }
}
