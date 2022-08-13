<?php

use Illuminate\Support\Facades\Route;
use laililmahfud\starterkit\controllers\Api\TokenController;

Route::prefix(config('starterkit.app_api_prefix'))->group(function () {
    
    Route::controller(TokenController::class)->group(function () {
        Route::get('/token/get-token', 'getToken')->name('api.get-token');
        Route::get('/token/renew', 'renewToken')->name('api.renew-token');
    });

});