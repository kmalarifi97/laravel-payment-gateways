<?php

namespace Kmalarifi\PaymentGateways\Contracts;

use Kmalarifi\PaymentGateways\DTO\CreateTransactionResponseDTO;
use Kmalarifi\PaymentGateways\DTO\TransactionStatusResponseDTO;


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
     * @param float $amount
     * @param string $currency
     * @param string $merchantTransactionId
     * @param int|string|null $customerId
     * @param array|null $metadata
     * @return CreateCheckoutResponseDTO
     */
    public function createTransaction(
        float  $amount,
        string $currency,
        string $transactionReference,
        ?array $metadata = [],
        array  $params = [],
        array  $headers = []
    ): CreateTransactionResponseDTO;

    public function transactionStatus(
        ?string $transactionReference = null,
        array   $params = [],
        array   $headers = []
    ): TransactionStatusResponseDTO;

}
