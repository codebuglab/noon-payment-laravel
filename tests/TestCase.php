<?php

namespace Tests;

use Orchestra\Testbench\TestCase as BaseTestCase;
use CodeBugLab\NoonPayment\NoonPaymentServiceProvider;

abstract class TestCase extends BaseTestCase
{
    protected function getPackageProviders($app)
    {
        return [
            NoonPaymentServiceProvider::class
        ];
    }
}
