<?php

return [
    'app_name' => env('APP_NAME'),
    'admin_path' => 'admin',
    'app_logo' => 'vendor/starterkit/img/ic_logo.png',
    'admin_sidebar_color' => '#1a2035',
    'admin_login_view' => 'starterkit::module.auth.login',

    'app_api_prefix' => 'api',
    'api_key' => env('API_KEY'),
    'jwt_secret' => env('JWT_SECRET'),
];