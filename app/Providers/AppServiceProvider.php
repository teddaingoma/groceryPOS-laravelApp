<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        // usually, assets load in http, unsecured
        // to allow the assets to be loaded when in a secured environment like https
        if($this->app->environment('production')) {
            \URL::forceScheme('https');
        }
    }
}
