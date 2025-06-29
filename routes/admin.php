<?php

declare(strict_types=1);

use App\Http\Controllers\Admin\ImageUploadAction;
use App\Livewire\Admin\Orders\OrderCreateManagement;
use App\Livewire\Admin\Orders\OrderEditManagement;
use App\Livewire\Admin\Orders\OrderIndexManagement;
use App\Livewire\Admin\Orders\OrderShowManagement;
use App\Livewire\Admin\Products\ProductCreateManagement;
use App\Livewire\Admin\Products\ProductEditManagement;
use App\Livewire\Admin\Products\ProductIndexManagement;
use App\Livewire\Admin\Products\ProductShowManagement;
use App\Livewire\Admin\Users\Create as AdminCreateUser;
use App\Livewire\Admin\Users\Edit as AdminEditUser;
use App\Livewire\Admin\Users\Index as AdminIndexUser;
use App\Livewire\Admin\Users\Show as AdminShowUser;
use Illuminate\Support\Facades\Route;

Route::group(['middleware' => 'role:super_admin|manager'], function () {
    // NOTE: Users Management.
    Route::get('users', AdminIndexUser::class)->name('users.index');
    Route::get('users/create', AdminCreateUser::class)->name('users.create');
    Route::get('users/{user}', AdminShowUser::class)->name('users.show');
    Route::get('users/{user}/edit', AdminEditUser::class)->name('users.edit');

    // NOTE: Orders Management.
    Route::get('orders', OrderIndexManagement::class)->name('orders.index');
    Route::get('orders/create', OrderCreateManagement::class)->name('orders.create');
    Route::get('orders/{user}', OrderShowManagement::class)->name('orders.show');
    Route::get('orders/{user}/edit', OrderEditManagement::class)->name('orders.edit');

    // NOTE: Products Management.
    Route::get('products', ProductIndexManagement::class)->name('products.index');
    Route::get('products/create', ProductCreateManagement::class)->name('products.create');
    Route::get('products/{user}', ProductShowManagement::class)->name('products.show');
    Route::get('products/{user}/edit', ProductEditManagement::class)->name('products.edit');

    Route::post('images/upload', ImageUploadAction::class)->name('images.upload');
});
