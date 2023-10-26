<?php

return [
    /*
     |--------------------------------------------------------------------------
     | Laravel money
     |--------------------------------------------------------------------------
     */
    'locale' => config('app.locale', 'ar_SA'),
    'defaultCurrency' => config('app.currency', 'SAR'),
    'defaultFormatter' => null,
    'defaultSerializer' => null,
    'isoCurrenciesPath' => __DIR__.'/../vendor/moneyphp/money/resources/currency.php',
    'currencies' => [
        'iso' => 'all',
        'bitcoin' => 'all',
        'custom' => [
            'MY1' => 2,
            'MY2' => 3
        ],
    ],
];
