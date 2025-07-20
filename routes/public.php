<?php

declare(strict_types=1);

use App\Http\Controllers\Public\AboutUsIndexController;
use App\Http\Controllers\Public\CategoryIndexController;
use App\Http\Controllers\Public\CategoryShowController;
use App\Http\Controllers\Public\HomeIndexController;
use App\Http\Controllers\Public\ProductShowController;
use App\Http\Controllers\Public\SubcategoryIndexController;
use Illuminate\Support\Facades\Route;

Route::get('/', HomeIndexController::class)->name('home.index');
Route::get('/about-us', AboutUsIndexController::class)->name('about-us.index');
Route::get('/categories', CategoryIndexController::class)->name('categories.index');
Route::get('/{category:slug}', CategoryShowController::class)->name('categories.show');
Route::get('/{category:slug}/{subcategory:slug}', SubcategoryIndexController::class)
    ->scopeBindings()
    ->name('subcategories.index');
Route::get('/{category:slug}/{subcategory:slug}/{product:slug}', ProductShowController::class)
    ->scopeBindings()
    ->name('products.show');
