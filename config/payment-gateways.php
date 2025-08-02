<?php

return [
    /*--------------------------------------------------------------------------
    | Active Gateway Driver
    |--------------------------------------------------------------------------*/
    'payment_gateway' => env('PAYMENT_GATEWAY', 'hyperpay'),

    /*--------------------------------------------------------------------------
    | Gateway → Class Map
    |--------------------------------------------------------------------------*/
    'gateways' => [
        'hyperpay' => "",
        'alrajhi'  => "",
    ],

    /*--------------------------------------------------------------------------
    | Hyperpay Settings
    |--------------------------------------------------------------------------*/
    'hyperpay' => [
        'base_url'  => env('HYPERPAY_BASE_URL', 'https://test.oppwa.com'),
        'entity_id' => env('HYPERPAY_ENTITY_ID', ''),
        'paths' => [
            'checkout' => env('HYPERPAY_CHECKOUT_PATH', '/v1/checkouts'),
            'status'   => env('HYPERPAY_STATUS_PATH', '/v1/checkouts/{id}/paymentStatus'),
        ],
    ],

    /*--------------------------------------------------------------------------
    | Al Rajhi Settings (illustrative keys, adjust per official docs)
    |--------------------------------------------------------------------------*/
    'alrajhi' => [
        'base_url'    => env('ALRAJHI_BASE_URL', 'https://sandbox.alrajhipay.com'),
        'merchant_id' => env('ALRAJHI_MERCHANT_ID', ''),
        'callback_url'=> env('ALRAJHI_CALLBACK_URL', ''),
        'error_url'   => env('ALRAJHI_ERROR_URL', ''),
        'paths' => [
            'checkout' => env('ALRAJHI_CHECKOUT_PATH', '/v1/payment'),
            'status'   => env('ALRAJHI_STATUS_PATH', '/v1/payment/{id}/status'),
        ],
    ],
];
