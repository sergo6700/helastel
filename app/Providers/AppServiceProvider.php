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
        $this->app->bind(
            'App\Clusters\UserControllerInterface',
            'App\Services\UserControllerService'
        );
        $this->app->bind(
            'App\Clusters\BookControllerInterface',
            'App\Services\BookControllerService'
        );
    }
}
