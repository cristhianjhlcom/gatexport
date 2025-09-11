<?php

declare(strict_types=1);

namespace App\Http\Controllers\Public;

use App\Enums\ProductStatusEnum;
use App\Models\Category;
use Illuminate\Routing\Controller;

final class CategoryIndexController extends Controller
{
    public function __invoke()
    {
        // $categories = Category::with('subcategories')
        //     ->withCount('subcategories')
        //     ->latest()
        //     ->get();
        $categories = Category::whereHas('subcategories.products', function ($query) {
            $query->where('status', ProductStatusEnum::PUBLISHED->value);
        })
            ->with(['subcategories' => function ($query) {
                $query->whereHas('products', function ($query) {
                    $query->where('status', ProductStatusEnum::PUBLISHED->value);
                });
            }])
            ->withCount(['subcategories' => function ($query) {
                $query->whereHas('products', function ($query) {
                    $query->where('status', ProductStatusEnum::PUBLISHED->value);
                });
            }])
            ->latest()
            ->get();

        return view('pages.categories.index')->with([
            'categories' => $categories,
        ]);
    }
}
