<?php

declare(strict_types=1);

// use App\Http\Controllers\Admin\ImageDeleteController;
// use App\Http\Controllers\Admin\ImageUploadController;
use App\Livewire\Admin\Categories\CategoryCreateManagement;
use App\Livewire\Admin\Categories\CategoryEditManagement;
use App\Livewire\Admin\Categories\CategoryIndexManagement;
use App\Livewire\Admin\Orders\OrderCreateManagement;
use App\Livewire\Admin\Orders\OrderEditManagement;
use App\Livewire\Admin\Orders\OrderIndexManagement;
use App\Livewire\Admin\Orders\OrderShowManagement;
use App\Livewire\Admin\Products\ProductCreateManagement;
use App\Livewire\Admin\Products\ProductEditManagement;
use App\Livewire\Admin\Products\ProductIndexManagement;
use App\Livewire\Admin\Products\ProductShowManagement;
use App\Livewire\Admin\Settings\SettingAboutManagement;
use App\Livewire\Admin\Settings\SettingBannersManagement;
use App\Livewire\Admin\Settings\SettingCompetitiveAdvantagesManagement;
use App\Livewire\Admin\Settings\SettingGeneralManagement;
use App\Livewire\Admin\Settings\SettingProvidersManagement;
use App\Livewire\Admin\Settings\SettingServicesManagement;
use App\Livewire\Admin\Subcategories\SubcategoryCreateManagement;
use App\Livewire\Admin\Subcategories\SubcategoryEditManagement;
use App\Livewire\Admin\Subcategories\SubcategoryIndexManagement;
use App\Livewire\Admin\Users\UserCreateManagement;
use App\Livewire\Admin\Users\UserEditManagement;
use App\Livewire\Admin\Users\UserIndexManagement;
use App\Livewire\Admin\Users\UserShowManagement;
use Illuminate\Support\Facades\Route;

Route::group(['middleware' => 'role:super_admin|manager'], function () {
    // NOTE: Users Management.
    Route::get('users', UserIndexManagement::class)->name('users.index');
    Route::get('users/create', UserCreateManagement::class)->name('users.create');
    Route::get('users/{user}', UserShowManagement::class)->name('users.show');
    Route::get('users/{user}/edit', UserEditManagement::class)->name('users.edit');

    // NOTE: Orders Management.
    Route::get('orders', OrderIndexManagement::class)->name('orders.index');
    // Route::get('orders/create', OrderCreateManagement::class)->name('orders.create');
    // Route::get('orders/{user}', OrderShowManagement::class)->name('orders.show');
    Route::get('orders/{order}/edit', OrderEditManagement::class)->name('orders.edit');

    // NOTE: Products Management.
    Route::get('products', ProductIndexManagement::class)->name('products.index');
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

    // NOTE: Settings Management.
    Route::get('settings/general', SettingGeneralManagement::class)->name('settings.general');
    Route::get('settings/about', SettingAboutManagement::class)->name('settings.about');
    Route::get('settings/providers', SettingProvidersManagement::class)->name('settings.providers');
    Route::get('settings/banners', SettingBannersManagement::class)->name('settings.banners');
    Route::get('settings/services', SettingServicesManagement::class)->name('settings.services');
    Route::get('settings/advantages', SettingCompetitiveAdvantagesManagement::class)->name('settings.advantages');
});
