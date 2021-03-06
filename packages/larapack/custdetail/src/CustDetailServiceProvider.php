<?php

namespace Larapack\Custdetail;

use Illuminate\Support\ServiceProvider;

class CustDetailServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        include __DIR__.'/routes/web.php';
        $this->app->make('Larapack\Custdetail\CustdetailController');
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        $this->loadViewsFrom(__DIR__.'/views', 'custdetail');
        $this->publishes([
            __DIR__.'/views' => base_path('resources/views/larapack/custdetail/'),
        ]);
    }
}
