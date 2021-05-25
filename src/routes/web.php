<?php

use Illuminate\Support\Facades\Route;

Route::get('/noon_payment', "App\Http\Controllers\NoonPaymentController@index");
Route::get('/noon_payment_response', "App\Http\Controllers\NoonPaymentController@response");
