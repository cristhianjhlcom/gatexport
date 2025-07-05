<?php

declare(strict_types=1);

namespace App\Http\Controllers\Public;

use App\Models\Category;
use Illuminate\Routing\Controller;

final class CategoryIndexController extends Controller
{
    public function __invoke()
    {
        $categories = Category::with('subcategories')
            ->withCount('subcategories')
            ->latest()
            ->get();

        return view('pages.categories.index')->with([
            'categories' => $categories,
        ]);
    }
}
