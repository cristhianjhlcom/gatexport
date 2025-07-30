<?php

declare(strict_types=1);

namespace App\Providers;

use App\Actions\Home\GetGeneralInformation;
use App\Actions\Setting\GetCompanyLogos;
use App\Models\Category;
use App\Models\Order;
use App\Models\Product;
use App\Models\Subcategory;
use App\Models\User;
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
        View::composer('components.footer.index', function ($view) {
            $view->with([
                'company_logos' => (new GetCompanyLogos)->execute(),
                'general_information' => (new GetGeneralInformation)->execute(),
            ]);
        });

        View::composer('components.common.whatsapp-link.index', function ($view) {
            $view->with([
                'contactInformation' => (new GetGeneralInformation)->execute()['contact_information'],
            ]);
        });

        View::composer('components.layouts.public', function ($view) {
            $categories = Category::with('subcategories')
                ->orderBy('name')
                ->get()
                ->map(fn($category) => [
                    'name' => $category->name,
                    'slug' => $category->slug,
                    'image' => $category->getImagePathAttribute(),
                    'subcategories' => $category->subcategories->map(fn($subcategory) => [
                        'name' => $subcategory->name,
                        'slug' => $subcategory->slug,
                        'image' => $subcategory->getImagePathAttribute(),
                    ]),
                ]);

            $view->with([
                'navigationCategories' => $categories,
                'companyLogos' => (new GetCompanyLogos)->execute(),
            ]);
        });

        View::composer('components.layouts.admin', function ($view) {
            $view->with([
                'usersCount' => User::count(),
                'subcategoriesCount' => Subcategory::count(),
                'categoriesCount' => Category::count(),
                'productsCount' => Product::count(),
                'ordersCount' => Order::count(),
                'companyLogos' => (new GetCompanyLogos)->execute(),
            ]);
        });
    }
}
