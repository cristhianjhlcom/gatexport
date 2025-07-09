<?php

declare(strict_types=1);

namespace App\Http\Controllers\Public;

use App\Models\Category;
use Illuminate\Routing\Controller;

final class CategoryShowController extends Controller
{
    public function __invoke(Category $category)
    {
        $category = $category->load([
            'subcategories',
            'subcategories.products',
        ]);

        return view('pages.categories.show')->with([
            'category' => $category,
        ]);
    }
}
