<?php

declare(strict_types=1);

namespace App\Providers;

use App\Models\Category;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

final class ViewServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        View::composer('components.layouts.public', function ($view) {
            $categories = Category::with('subcategories')
                ->orderBy('name')
                ->get()
                ->map(fn ($category) => [
                    'name' => $category->name,
                    'slug' => $category->slug,
                    'image' => $category->getImagePathAttribute(),
                    'subcategories' => $category->subcategories->map(fn ($subcategory) => [
                        'name' => $subcategory->name,
                        'slug' => $subcategory->slug,
                        'image' => $subcategory->getImagePathAttribute(),
                    ]),
                ]);

            $view->with('navigationCategories', $categories);
        });
    }
}
