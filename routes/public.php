<?php

declare(strict_types=1);

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Log;

Route::get('/logs', function () {
    Log::info('Test');
});
