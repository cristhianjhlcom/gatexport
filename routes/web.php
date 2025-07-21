<?php

declare(strict_types=1);

use Illuminate\Support\Facades\Route;

// NOTE: Rutas admin
Route::middleware(['web', 'auth'])
    ->prefix('admin')
    ->name('admin.')
    ->group(base_path('routes/admin.php'));

// NOTE: Rutas públicas
Route::middleware(['web', 'locale'])
    ->group(base_path('routes/public.php'));

// NOTE: Auth routes.
Route::view('/auth/register', 'auth.register')->name('auth.register');
