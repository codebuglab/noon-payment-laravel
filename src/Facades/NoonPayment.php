<?php

namespace CodeBugLab\NoonPayment\Facades;

use Illuminate\Support\Facades\Facade;

class NoonPayment extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'NoonPayment';
    }
}
