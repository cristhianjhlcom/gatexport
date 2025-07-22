<?php

declare(strict_types=1);

namespace App\Providers;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\ServiceProvider;

final class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        // Model::shouldBeStrict(! app()->isProduction());
        // DB::prohibitDestructiveCommands(app()->isProduction());

        /*
        DB::listen(function ($query) {
            if (app()->isProduction()) {
                return;
            }

            Illuminate\Support\Facades\Log::info('Query executed', [
                'slq' => $query->sql,
                'bindings' => $query->bindings,
                'time' => round($query->time * 1000, 2),
            ]);
        });
        */
    }
}
