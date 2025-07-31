<?php

return [
    'payment_gateway' => env('PAYMENT_GATEWAY', 'hyperpay'),
    'gateways' => [
        'hyperpay' => Kmalarifi\PaymentGateways\HyperPayPaymentGateway::class,
    ],
    'hyperpay' => [
        'base_url'  => env('HYPERPAY_BASE_URL', 'https://test.oppwa.com'),
        'entity_id' => env('HYPERPAY_ENTITY_ID', ''),
        "paths" => [
            'checkout' => env('HYPERPAY_CHECKOUT_PATH', '/v1/checkouts'),
            'status' => env('HYPERPAY_STATUS_PATH', '/v1/checkouts/{id}/paymentStatus'),
        ],
    ],
];
