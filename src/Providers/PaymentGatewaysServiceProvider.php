<?php

namespace Kmalarifi\PaymentGateways\Providers;

use Illuminate\Support\ServiceProvider;
use Kmalarifi\PaymentGateways\Contracts\PaymentGatewayContract;

class PaymentGatewaysServiceProvider extends ServiceProvider
{
    /**
     * Register bindings.
     */
    public function register(): void
    {

        $this->mergeConfigFrom(__DIR__ . '/../../config/payment-gateways.php', 'payment-gateways');

        $this->app->bind(PaymentGatewayContract::class, function ($app) {
            $driver = config('payment-gateways.payment_gateway');

            $class = config("payment-gateways.gateways.$driver");

            if (!$class || !class_exists($class)) {
                throw new \InvalidArgumentException("Payment gateway [$driver] is not configured or class does not exist.");
            }

            return $app->make($class);
        });
    }

    /**
     * Publish the config file so applications can override it.
     */
    public function boot(): void
    {
        $this->publishes([
            __DIR__ . '/../../config/payment-gateways.php' => config_path('payment-gateways.php'),
        ], 'payment-gateways');
    }
}