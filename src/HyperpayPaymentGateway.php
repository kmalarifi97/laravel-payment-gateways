<?php

namespace Kmalarifi\PaymentGateways;

use Kmalarifi\PaymentGateways\DTO\CreateTransactionResponseDTO;
use Kmalarifi\PaymentGateways\DTO\TransactionStatusResponseDTO;

class HyperpayPaymentGateway extends AbstractGateway
{
    public function mapStatus(string $code): string
    {

        if (!$code) {
            return 'error';
        }
        if (str_starts_with($code, '000.200')) {
            return 'pending';
        }
        if (str_starts_with($code, '000.100')) {
            return 'success';
        }
        if (str_starts_with($code, '100.')) {
            return 'failed';
        }
        return 'error';
    }


    public function getCreateTransactionEnpoint(): string
    {
        return config('payment-gateways.hyperpay.base_url')
            . config('payment-gateways.hyperpay.paths.create_transaction');
    }


    public function getCreateTransactionPayload(array $input): array
    {
        $payload = [
            'amount' => (string) $input['amount'],
            'currency' => $input['currency'],
            'merchant_transaction_id' => $input['transactionReference'],
        ];
        if (isset($input['metadata']) && is_array($input['metadata'])) {

            $payload = $this->preparePayload($payload, $input['metadata']);
        }

        return $payload;
    }


    public function preparePayload(array $payload, array $metadata = []): array
    {
        $payload = array_merge($payload, $metadata);
        return array_filter($payload, fn($v) => !is_null($v));
    }


    public function getCreateTransactionResponse($raw): CreateTransactionResponseDTO
    {
        $jsonRaw = $raw->json();
        return new CreateTransactionResponseDTO(
            status:$raw->status(),
            code_status: $this->mapStatus($jsonRaw['result']['code'] ?? $jsonRaw['status'] ?? ''),
            reference: $jsonRaw['id'] ?? $jsonRaw['transactionId'] ?? '',
            transactionUrl: $jsonRaw['id'] ?? $jsonRaw['transactionId'] ?? '',
            message: $jsonRaw['result']['description'] ?? null,
            code: $jsonRaw['result']['code'] ?? null,
            raw: $jsonRaw,
            metadata: []
        );
    }


    public function getTransactionStatusEndpoint(array $params): string
    {
        // For Hyperpay, you might use a query param or path param (check API docs)
        return config('payment-gateways.hyperpay.base_url')
            . config('payment-gateways.hyperpay.paths.transaction_status');
    }


    public function getTransactionStatusResponse($raw): TransactionStatusResponseDTO
    {
        $jsonRaw = $raw->json();
        return new TransactionStatusResponseDTO(
            status: $raw->status(),
            code_status: $this->mapStatus($jsonRaw['result']['code'] ?? $jsonRaw['status'] ?? ''),
            reference: $jsonRaw['id'] ?? $jsonRaw['transactionId'] ?? '',
            message: $jsonRaw['result']['description'] ?? null,
            code: $jsonRaw['result']['code'] ?? null,
            raw: $jsonRaw,
            meta: []
        );
    }

    public function abstrctPost(string $endpoint, array $body, array $headers = []): \Illuminate\Http\Client\Response
    {
        $this->post($endpoint, $this->createRequestBody($body), $headers);
    }
}
