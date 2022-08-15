<?php

use Illuminate\Support\Facades\Route;
use laililmahfud\starterkit\helpers\Starterkit;
use laililmahfud\starterkit\middleware\ApiMiddleware;
use laililmahfud\starterkit\controllers\Api\TokenController;

Route::prefix(config('starterkit.app_api_prefix'))->group(function () {

    Route::controller(TokenController::class)->group(function () {
        Route::get('/token/get-token', 'getToken')->name('api.get-token');
        Route::get('/token/renew', 'renewToken')->name('api.renew-token');
    });

    try {
        $routeAppsApi = include base_path('routes/starterkit_api.php');
        foreach ($routeAppsApi as $prefix => $api) {
            $controller = $api['controller'];
            $role = $api['role'];
            $controller = 'App\\Http\\Controllers\Api\\' . $controller;
            Route::middleware([ApiMiddleware::class])->group(function () use($controller,$prefix) {
                Starterkit::routeApiController($prefix, $controller);
            });
        }
    } catch (Exception $e) {

    }
});
