<?php

namespace Kmalarifi\PaymentGateways;

use Kmalarifi\PaymentGateways\Contracts\PaymentGatewayContract;
use Kmalarifi\PaymentGateways\DTO\CreateTransactionResponseDTO;
use Kmalarifi\PaymentGateways\DTO\TransactionStatusResponseDTO;

abstract class AbstractGateway implements PaymentGatewayContract
{
    public function createTransaction(
        float  $amount,
        string $currency,
        string $transactionReference,
        ?array $metadata = [],
        ?array $params = [],
        array  $headers = []
    ): CreateTransactionResponseDTO
    {
        $input = compact(
            'amount',
            'currency',
            'transactionReference',
            'metadata',
            'params'
        );


        $endpoint = $this->getCreateTransactionEnpoint();
        $body = $this->getCreateTransactionPayload($input);
        $raw = $this->abstrctPost($endpoint, $body, $headers, $params);


        return $this->getCreateTransactionResponse($raw, $transactionReference);
    }

    public function transactionStatus(
        ?string $transactionReference = null,
        array   $params = [],
        array   $headers = []
    ): TransactionStatusResponseDTO
    {
        $endpoint = $this->getTransactionStatusEndpoint($params);

        $raw = $this->get($endpoint, $headers, $params);

        return $this->getTransactionStatusResponse($raw);
    }


    protected function prepareQueryParams(array $params): string
    {
        if (empty($params)) {
            return '';
        }
        return '?' . http_build_query($params);
    }


    public function post(string $endpoint, $payload, array $headers, $params = [])
    {
        return \Http::withHeaders($headers)->post($endpoint . $this->prepareQueryParams($params), $payload);

    }


    public function formPost(string $endpoint, $payload, array $headers, $params = [])
    {
        return \Http::asForm()->withHeaders($headers)->post($endpoint . $this->prepareQueryParams($params), $payload);
    }


    public function get(string $endpoint, array $headers, array $params = [])
    {

        $response = \Http::withHeaders($headers)->get($endpoint . $this->prepareQueryParams($params));
        return $response;
    }


    abstract public function mapStatus(string $code): string;

    abstract public function getCreateTransactionEnpoint(): string;

    abstract public function getCreateTransactionPayload(array $input);

    abstract public function getCreateTransactionResponse(array $raw, $transactionReference = null): CreateTransactionResponseDTO;

    /// --- Transaction Status ----///
    abstract public function getTransactionStatusEndpoint(array $params): string;

    abstract public function getTransactionStatusResponse(array $raw): TransactionStatusResponseDTO;

    abstract public function abstrctPost(string $endpoint, $payload, array $headers, $params = []);

}
