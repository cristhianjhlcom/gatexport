<?php

declare(strict_types=1);

use App\Livewire\Admin\Categories\CategoryCreateManagement;
use App\Livewire\Admin\Categories\CategoryEditManagement;
use App\Livewire\Admin\Categories\CategoryIndexManagement;
use App\Livewire\Admin\Faqs\FaqManagement;
use App\Livewire\Admin\Orders\OrderIndexManagement;
use App\Livewire\Admin\Policies\CreatePolicy;
use App\Livewire\Admin\Policies\PolicyManagement;
use App\Livewire\Admin\Policies\UpdatePolicy;
use App\Livewire\Admin\Products\ProductCreateManagement;
use App\Livewire\Admin\Products\ProductDetailManagement;
use App\Livewire\Admin\Products\ProductEditManagement;
use App\Livewire\Admin\Products\ProductIndexManagement;
use App\Livewire\Admin\Products\ProductShowManagement;
use App\Livewire\Admin\Settings\SettingAboutManagement;
use App\Livewire\Admin\Settings\SettingBannersManagement;
use App\Livewire\Admin\Settings\SettingCompetitiveAdvantagesManagement;
use App\Livewire\Admin\Settings\SettingCountriesManagement;
use App\Livewire\Admin\Settings\SettingGeneralManagement;
use App\Livewire\Admin\Settings\SettingServicesManagement;
use App\Livewire\Admin\Subcategories\SubcategoryCreateManagement;
use App\Livewire\Admin\Subcategories\SubcategoryEditManagement;
use App\Livewire\Admin\Subcategories\SubcategoryIndexManagement;
use App\Livewire\Admin\Users\UserCreateManagement;
use App\Livewire\Admin\Users\UserEditManagement;
use App\Livewire\Admin\Users\UserIndexManagement;
use Illuminate\Support\Facades\Route;

Route::group(['middleware' => 'role:super_admin|manager'], function () {
    Route::get('/', OrderIndexManagement::class)->name('dashboard.index');
    // NOTE: Users Management.
    Route::get('users', UserIndexManagement::class)->name('users.index');
    Route::get('users/create', UserCreateManagement::class)->name('users.create');
    Route::get('users/{user}/edit', UserEditManagement::class)->name('users.edit');

    // NOTE: Orders Management.
    Route::get('orders', OrderIndexManagement::class)->name('orders.index');

    // NOTE: Products Management.
    Route::get('products', ProductIndexManagement::class)->name('products.index');
    Route::get('products/detail', ProductDetailManagement::class)->name('products.detail');
    Route::get('products/create', ProductCreateManagement::class)->name('products.create');
    Route::get('products/{product}', ProductShowManagement::class)->name('products.show');
    Route::get('products/{product}/edit', ProductEditManagement::class)->name('products.edit');

    // NOTE: Categories Management.
    Route::get('categories', CategoryIndexManagement::class)->name('categories.index');
    Route::get('categories/create', CategoryCreateManagement::class)->name('categories.create');
    Route::get('categories/{category}/edit', CategoryEditManagement::class)->name('categories.edit');

    // NOTE: Sub Categories Management.
    Route::get('subcategories', SubcategoryIndexManagement::class)->name('subcategories.index');
    Route::get('subcategories/create', SubcategoryCreateManagement::class)->name('subcategories.create');
    Route::get('subcategories/{subcategory}/edit', SubcategoryEditManagement::class)->name('subcategories.edit');

    // NOTE: FAQs Management.
    Route::get('faqs', FaqManagement::class)->name('faqs.index');

    // NOTE: Policies Management.
    Route::get('policies', PolicyManagement::class)->name('policies.index');
    Route::get('policies/create', CreatePolicy::class)->name('policies.store');
    Route::get('policies/{policy}/update', UpdatePolicy::class)->name('policies.update');

    // NOTE: Settings Management.
    Route::get('settings/general', SettingGeneralManagement::class)->name('settings.general');
    Route::get('settings/about', SettingAboutManagement::class)->name('settings.about');
    Route::get('settings/banners', SettingBannersManagement::class)->name('settings.banners');
    Route::get('settings/services', SettingServicesManagement::class)->name('settings.services');
    Route::get('settings/countries', SettingCountriesManagement::class)->name('settings.countries');
    Route::get('settings/advantages', SettingCompetitiveAdvantagesManagement::class)->name('settings.advantages');
});
