<?php

namespace Mobin\PinPolicy\Providers;

use Carbon\Laravel\ServiceProvider;

class PinPolicyServiceProvider extends ServiceProvider
{
    public function boot()
    {
        //$this->loadViewsFrom(__DIR__.'/../../resources/lang/en', 'password-policy');
        $this->loadMigrationsFrom(__DIR__ . '/../../database/migrations');
        $this->publishes([
            __DIR__.'/../../config/pin-policy.php' =>  config_path('pin-policy.php'),
        ], 'config');
    }
}