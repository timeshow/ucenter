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
        include __DIR__.'routes.php';
        $this->publishes([
            __DIR__.'/config/ucenter.php'=>config_path('ucenter.php'),
        ]);
        $this->mergeConfigForm(__DIR__.'/config/ucenter.php','ucenter');
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        //
        $this->app->bind('ucenter',function ($app){
            return new UCenter;
        });
        $this->app->bind('TimeShow\UCenter\Contracts\Api',config('ucenter.service'));
    }
}
