<?php

declare(strict_types=1);

use App\Http\Controllers\Public\AboutUsIndexController;
use App\Http\Controllers\Public\ArticleIndexController;
use App\Http\Controllers\Public\ArticleShowController;
use App\Http\Controllers\Public\CatalogFileIndexController;
use App\Http\Controllers\Public\CategoryIndexController;
use App\Http\Controllers\Public\CategoryShowController;
use App\Http\Controllers\Public\FaqIndexController;
use App\Http\Controllers\Public\HomeIndexController;
use App\Http\Controllers\Public\LocalizationUpdateController;
use App\Http\Controllers\Public\PolicyShowController;
use App\Http\Controllers\Public\ProductShowController;
use App\Http\Controllers\Public\ServicesIndexController;
use App\Http\Controllers\Public\SubcategoryIndexController;
use App\Livewire\Public\Products\PageView as ProductsPageView;
use Illuminate\Support\Facades\Route;

Route::get('/', HomeIndexController::class)->name('home.index');
Route::get('/preguntas-frecuentes', FaqIndexController::class)->name('faqs.index');
Route::get('/politicas/{policy:slug}', PolicyShowController::class)->name('politics.show');
Route::get('/localization/{locale}', LocalizationUpdateController::class)->name('localization.update');
Route::get('/about-us', AboutUsIndexController::class)->name('about-us.index');
Route::get('/services', ServicesIndexController::class)->name('services.index');
Route::get('/blog', ArticleIndexController::class)->name('articles.index');
Route::get('/blog/{id}', ArticleShowController::class)->name('articles.show');
// Route::get('/catalogs', CatalogFileIndexController::class)->name('catalogs.index');
Route::get('/products', ProductsPageView::class)->name('products.index');
Route::get('/categories', CategoryIndexController::class)->name('categories.index');
Route::get('/{category}', CategoryShowController::class)->name('categories.show');
Route::get('/{category}/{subcategory}', SubcategoryIndexController::class)->scopeBindings()->name('subcategories.index');
Route::get('/{category}/{subcategory}/{product}', ProductShowController::class)->scopeBindings()->name('products.show');
