<?php

namespace TimeShow\UCenter;

use Illuminate\Support\ServiceProvider;

class UCenterServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        //
        $this->publishes([
            __DIR__.'/config/ucenter.php'=>config_path('ucenter.php'),
        ]);

    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        //
        $this->mergeConfigFrom(__DIR__.'/config/ucenter.php','ucenter');
        $this->app->bind('ucenter',function ($app){
            return new UCenter();
        });
        $this->app->bind('TimeShow\UCenter\Contracts\Api',config('ucenter.service'));
    }
}
