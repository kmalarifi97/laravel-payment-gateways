<?php

namespace Kmalarifi\PaymentGateways\Contracts;

use Kmalarifi\PaymentGateways\DTO\CreateCheckoutResponseDTO;


/**
 * Contract that every payment‑gateway adapter must implement.
 *
 * Each implementation (e.g. HyperpayGateway, StripeGateway) is responsible for
 * translating this canonical set of parameters into the gateway‑specific API
 * request and wrapping the result in a CreateCheckoutResponseDTO.
 */
interface PaymentGatewayContract
{
    /**
     * Creates a new checkout/order session with the chosen payment gateway.
     *
     * @param  float        $amount
     * @param  string       $currency
     * @param  string       $merchantTransactionId
     * @param  string|null  $paymentMethod
     * @param  string|null  $customerGivenName
     * @param  string|null  $customerSurname
     * @param  string|null  $customerIdDocType
     * @param  string|null  $customerIdDocId
     * @param  string|null  $accessToken
     * @param  int|string|null $customerId
     * @param  array|null   $meta
     * @return CreateCheckoutResponseDTO
     */
    public function createCheckout(
        float $amount,
        string $currency,
        string $merchantTransactionId,
        string $paymentMethod = null,
        string $customerGivenName = null,
        string $customerSurname = null,
        string $customerIdDocType = null,
        string $customerIdDocId = null,
        string $accessToken = null,
        $customerId = null,
        array $meta = []
    ): CreateCheckoutResponseDTO;
}
