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
        'base_url' => '',
        'merchant_id' => '',
        'password' => '',
        'resource_key' => '',
        'currency_code' => '',
        'paths' => [
            'create_transaction' => '',
            'transaction_status' => '',
        ],
        'redirect' => [
            'success' => '',
            'fail' =>'',
            'umi_success' => '',
            'umi_fail' => '',
        ]
    ],

];
