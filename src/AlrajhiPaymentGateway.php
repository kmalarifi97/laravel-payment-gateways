<?php

namespace Kmalarifi\PaymentGateways;

namespace Kmalarifi\PaymentGateways;

use Kmalarifi\PaymentGateways\DTO\CreateTransactionResponseDTO;
use Kmalarifi\PaymentGateways\DTO\TransactionStatusResponseDTO;

class AlrajhiPaymentGateway extends AbstractGateway
{
    public function mapStatus(string $code): string
    {
        // Adjust mapping based on Al Rajhi's result/status codes
        if (!$code) {
            return 'error';
        }
        if ($code === '000') {
            return 'success';
        }
        if ($code === '100') {
            return 'pending';
        }
        if ($code === '200') {
            return 'failed';
        }
        return 'error';
    }


    public function getCreateTransactionEnpoint(): string
    {
        return config('payment-gateways.alrajhi.base_url')
            . config('payment-gateways.alrajhi.paths.create_transaction');
    }


    public function getCreateTransactionPayload(array $input)
    {
        $payload = 'amt=' . number_format($input['amount'], 2, '.', '') . '&action=1&trackid=' . $input['transactionReference'] . '&udf2=' . ($input['customer_email'] ?? '') . '&udf3=' . ($input['customer_phone'] ?? '') . '&udf4=' . ($input['customer_name'] ?? '') . '&udf5=&udf6=&udf7=&udf8=&udf9=&udf10=&responseURL=https://localpaymenttest.lndo.site/umi-payment/result&errorURL=https://localpaymenttest.lndo.site/umi-payment/result&currencycode=' . $input['currency'] . '&langid=AR&payorIDType=IQA&payorIDNumber=2487379485&id=IPAY3O18lXVrbSp&password=' . config('payment-gateways.alrajhi.password') . '&billDetails=[{"issuerAgencyId":"004001000001000000","billingAccountId":"24090100000007","dueAmount":"' . number_format($input['amount'], 2, '.', '') . '","paidAmount":"' . number_format($input['amount'], 2, '.', '') . '","agencyCode":"ABCD"}]';
        $trandata = $this->encryption($payload, '50978154775950978154775950978154');


        return [
            "tranportalId" => "IPAY3O18lXVrbSp",
            "responseURL" => "https://localpaymenttest.lndo.site/umi-payment/result",
            "errorURL" => "https://localpaymenttest.lndo.site/umi-payment/result",
            "trandata" => $trandata,
        ];
    }


    public function getCreateTransactionResponse($raw,$transactionReference = null): CreateTransactionResponseDTO
    {
        return new CreateTransactionResponseDTO(
            status: $raw->status(),
            code_status: '',
            reference: $transactionReference,
            transactionUrl: '',
            htmlForm: $raw->body(),
            redirect: $raw->status() != 200 ? false : true,
            message: null,
            code: null,
            raw: ["htmlBody" => $raw->body()],
            metadata: []
        );
    }


    public function getTransactionStatusEndpoint(array $params): string
    {
        return config('payment-gateways.alrajhi.base_url')
            . config('payment-gateways.alrajhi.paths.status');
    }


    public function getTransactionStatusResponse($raw): TransactionStatusResponseDTO
    {
        $response = $raw->json(); // Or parse differently if XML or other
        return new TransactionStatusResponseDTO(
            status: $raw->status(),
            code_status: $this->mapStatus($response['result'] ?? $response['status'] ?? ''),
            reference: $response['tranid'] ?? $response['trackid'] ?? '',
            message: $response['message'] ?? null,
            code: $response['result'] ?? $response['status'] ?? null,
            raw: $response,
            meta: []
        );
    }


    private function encryption(string $str, string $key): string
    {
        $blocksize = openssl_cipher_iv_length('AES-256-CBC');
        $pad = $blocksize - (strlen($str) % $blocksize);
        $str = $str . str_repeat(chr($pad), $pad);
        $encrypted = openssl_encrypt($str, 'AES-256-CBC', $key, OPENSSL_ZERO_PADDING, 'PGKEYENCDECIVSPC');
        $encrypted = base64_decode($encrypted);
        $encrypted = unpack('C*', ($encrypted));
        $chars = array_map('chr', $encrypted);
        $bin = implode($chars);
        $encrypted = bin2hex($bin);

        return urlencode($encrypted);
    }


    private function wrapData(array $data): string
    {
        $data = json_encode($data);
        return "[$data]";
    }


    private function createRequestBody($encoded_data): string
    {
        $encryptedData = [
            'id' => config('payment-gateways.alrajhi.merchant_id'),
            'trandata' => $this->encryption($encoded_data, config('payment-gateways.alrajhi.resource_key')),
            'responseURL' => config('payment-gateways.alrajhi.callback_url'),
            'errorURL' => config('payment-gateways.alrajhi.error_url'),
        ];

        return $this->wrapData($encryptedData);
    }

    public function abstrctPost(string $endpoint, $payload, array $headers, $params = [])
    {
        return $this->formPost($endpoint, $payload, $headers, $params);
    }
}
