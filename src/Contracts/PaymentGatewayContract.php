<?php

namespace Kmalarifi\PaymentGateways;

/**
 * Contract that every payment‑gateway adapter must implement.
 *
 * Each implementation (e.g. HyperpayGateway, StripeGateway) is responsible for
 * translating this canonical set of parameters into the gateway‑specific API
 * request and wrapping the result in a CheckoutResponseDto.
 */
interface PaymentGatewayContract
{
    /**
     * Creates a new checkout/order session with the chosen payment gateway.
     *
     * @param  float        $amount                    Amount to charge.
     * @param  string       $currency                  ISO‑4217 currency code (e.g. "SAR").
     * @param  string       $paymentMethod             Gateway‑specific payment method identifier.
     * @param  string       $customerGivenName         Customer’s given/first name.
     * @param  string       $customerSurname           Customer’s surname/family name.
     * @param  string       $customerIdDocType         Identification document type (e.g. "NID", "IQAMA", "PASSPORT").
     * @param  string       $customerIdDocId           Identification document number.
     * @param  string       $accessToken               Bearer token or API key already obtained for the gateway.
     * @param  int|string   $customerId                Merchant‑side customer reference.
     * @param  string       $merchantTransactionId     Merchant‑generated unique transaction reference.
     *
     * @return CheckoutResponseDto                      Normalised gateway response.
     */
    public function createCheckout(
        float $amount,
        string $currency,
        string $paymentMethod,
        string $customerGivenName,
        string $customerSurname,
        string $customerIdDocType,
        string $customerIdDocId,
        string $accessToken,
        int|string $customerId,
        string $merchantTransactionId
    ): CheckoutResponseDto;
}