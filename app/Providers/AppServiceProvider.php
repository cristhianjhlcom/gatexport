<?php

declare(strict_types=1);

namespace App\Providers;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\URL;
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
        // NOTE: Si empieza a dar problemas con las relaciones automáticas, comentar esta línea.
        // NOTE: 01# Carg lentas de Eloquent al usar relaciones automáticas.
        // NOTE: 02# Problemas con relaciones automáticas y carga condicional.
        Model::automaticallyEagerLoadRelationships();

        URL::forceHttps(app()->isProduction());

        Model::unguard(! app()->isProduction());

        Model::shouldBeStrict(! app()->isProduction());

        DB::prohibitDestructiveCommands(app()->isProduction());
    }
}
