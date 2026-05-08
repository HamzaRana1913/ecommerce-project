<?php

use Illuminate\Support\Facades\Facade;
use Illuminate\Support\ServiceProvider;

return [
    'name'     => env('APP_NAME', 'LuxeStore'),
    'env'      => env('APP_ENV', 'production'),
    'debug'    => (bool) env('APP_DEBUG', false),
    'url'      => env('APP_URL', 'http://localhost'),
    'timezone' => 'Asia/Karachi',
    'locale'   => 'en',
    'fallback_locale' => 'en',
    'faker_locale'    => 'en_US',
    'key'   => env('APP_KEY'),
    'cipher'=> 'AES-256-CBC',

    'providers' => ServiceProvider::defaultProviders()->merge([
        App\Providers\AppServiceProvider::class,
    ])->toArray(),

    'aliases' => Facade::defaultAliases()->merge([
        // 'Example' => App\Facades\Example::class,
    ])->toArray(),
];
