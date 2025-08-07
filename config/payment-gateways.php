<?php

use Kmalarifi\PaymentGateways\HyperpayPaymentGateway;
use Kmalarifi\PaymentGateways\AlrajhiPaymentGateway;


return [
    /*--------------------------------------------------------------------------
    | Active Gateway Driver
    |--------------------------------------------------------------------------*/
    'payment_gateway' => 'alrajhi',

    /*--------------------------------------------------------------------------
    | Gateway → Class Map
    |--------------------------------------------------------------------------*/
    'gateways' => [
        'hyperpay' => HyperpayPaymentGateway::class,
        'alrajhi' => AlrajhiPaymentGateway::class,
    ],

    /*--------------------------------------------------------------------------
    | Hyperpay Settings
    |--------------------------------------------------------------------------*/
    'hyperpay' => [
        'base_url' => env('APIGEE_BASE_URL'),
        'paths' => [
            'create_transaction' => '/',
            'transaction_status' => '/',
        ],
    ],

    /*--------------------------------------------------------------------------
    | alrajhi Settings (illustrative keys, adjust per official docs)
    |--------------------------------------------------------------------------*/
    //Request URL:
    'alrajhi' => [
        'base_url' => env('ALRAJHI_BASE_URL'),
        'merchant_id' => env('ALRAJHI_MERCHANT_ID', env()),
        'password' => env('ARB_TRANPORTAL_PASSWORD'),
        'resource_key' => env('ALRAJHI_RESOURCE_KEY', env()),
        'currency_code' => env('ALRAJHI_CURRENCY_CODE', env()),
        'paths' => [
            'create_transaction' => env(''),
            'transaction_status' => env(''),
        ],
        'redirect' => [
            'success' => env('ARB_REDIRECT_SUCCESS', ''),
            'fail' => env('ARB_REDIRECT_FAIL', ''),
            'umi_success' => env(''),
            'umi_fail' => env(''),
        ]
    ],

];
