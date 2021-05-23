<?php

namespace CodeBugLab\NoonPayment;

use Illuminate\Support\ServiceProvider;


class NoonPaymentServiceProvider extends ServiceProvider
{
    public function boot()
    {
        $this->loadRoutesFrom(__DIR__ . '/routes/web.php');
        $this->mergeConfigFrom(
            __DIR__ . '/config/noon_payment.php',
            'noon_payment'
        );

        $this->publishes([
            __DIR__ . '/config/noon_payment.php' => config_path('noon_payment.php'),
        ], 'config');

        $this->publishes([
            __DIR__ . '/Http/Controllers/NoonPaymentController.php' => app_path('Http/Controllers/NoonPaymentController.php')
        ], 'controller');
    }

    public function register()
    {
        $this->app->singleton('NoonPayment', function () {
            return NoonPayment::getInstance();
        });
    }
}
