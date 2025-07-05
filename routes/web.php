<?php

declare(strict_types=1);

use App\Http\Controllers\Public\HomeIndexController;
use Illuminate\Support\Facades\Route;

Route::get('/', HomeIndexController::class)->name('home.index');

// NOTE: Auth routes.
Route::view('/auth/register', 'auth.register')->name('auth.register');
