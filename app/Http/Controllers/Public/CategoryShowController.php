<?php

declare(strict_types=1);

namespace App\Http\Controllers\Public;

use App\Enums\ProductStatusEnum;
use App\Models\Category;
use Illuminate\Routing\Controller;

final class CategoryShowController extends Controller
{
    public function __invoke(Category $category)
    {
        $category = $category->load([
            'subcategories',
            'subcategories.products' => function ($query) {
                $query->where('status', ProductStatusEnum::PUBLISHED)->limit(8);
            },
            'subcategories.products.images',
            // 'subcategories.products.subcategory.category',
            // 'subcategories.category',
        ]);

        return view('pages.categories.show')->with([
            'category' => $category,
        ]);
    }
}
