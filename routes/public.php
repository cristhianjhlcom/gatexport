<?php

declare(strict_types=1);

use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Route;

Route::get('/logs', function () {
    Log::info('Test');
});
