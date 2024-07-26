<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
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
        $router = $this->app['router'];

        // Register route-specific middleware
        $router->aliasMiddleware('cekEngineer', \App\Http\Middleware\CekEngineer::class);
        $router->aliasMiddleware('cekKoordinator', \App\Http\Middleware\CekKoordinator::class);
        $router->aliasMiddleware('cekAdmin', \App\Http\Middleware\CekAdmin::class);
    }
}
