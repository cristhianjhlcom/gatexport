<?php

declare(strict_types=1);

namespace App\Providers;

use App\Actions\Home\GetAbout;
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
        View::composer('components.footer.footer', function ($view) {
            $view->with([
                'company_logos' => (new GetCompanyLogos)->execute(),
                'general_information' => (new GetGeneralInformation)->execute(),
            ]);
        });

        View::composer('components.common.seo.tags', function ($view) {
            $view->with([
                'company_logos' => (new GetCompanyLogos)->execute(),
                'general_information' => (new GetGeneralInformation)->execute(),
            ]);
        });

        View::composer('components.common.whatsapp-link.index', function ($view) {
            $generalInformation = (new GetGeneralInformation)->execute();
            $view->with([
                'link' => $generalInformation['contact_information']['whatsapp_link'] ?? '#',
            ]);
        });

        View::composer('components.common.contact-section.index', function ($view) {
            $about = (new GetAbout)->execute();
            $data = $about['translations']['contact'];
            $title = $data['title'] ??= '';
            $description = $data['description'] ??= '';
            $view->with([
                'title' => $title,
                'description' => $description,
            ]);
        });

        View::composer('components.layouts.public', function ($view) {
            $view->with([
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
