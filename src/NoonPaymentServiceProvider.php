<?php

namespace CodeBugLab\NoonPayment;

use Illuminate\Support\ServiceProvider;

class NoonPaymentServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->mergeConfigFrom(
            __DIR__ . '/config/noon_payment.php',
            'noon_payment'
        );

        $this->app->bind('NoonPayment', function () {
            return NoonPayment::getInstance();
        });
    }

    public function boot()
    {
        if (config("noon_payment.register_routes")) {
            $this->loadRoutesFrom(__DIR__ . '/routes/web.php');
        }

        $this->publishes([
            __DIR__ . '/config/noon_payment.php' => config_path('noon_payment.php'),
        ], 'config');

        $this->publishes([
            __DIR__ . '/Http/Controllers/NoonPaymentController.php' => app_path('Http/Controllers/NoonPaymentController.php')
        ], 'controller');
    }
}
