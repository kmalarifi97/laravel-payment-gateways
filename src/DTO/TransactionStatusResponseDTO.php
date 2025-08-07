<?php

namespace Kmalarifi\PaymentGateways\DTO;

class TransactionStatusResponseDTO
{
    public string $status;        // e.g., 'success', 'pending', 'failed', 'cancelled'
    public string $reference;     // The transaction/order/session ID you checked
    public ?string $message;      // Human-readable message (optional)
    public ?string $code;         // Gateway result/status code (optional)
    public array $raw;            // The full raw response from the gateway
    public array $meta;           // Any extra data (optional)

    public function __construct(
        int     $status,
        string  $code_status,
        string  $reference,
        ?string $message = null,
        ?string $code = null,
        array   $raw = [],
        array   $meta = []
    )
    {
        $this->status = $status;
        $this->code_status = $code_status;
        $this->reference = $reference;
        $this->message = $message;
        $this->code = $code;
        $this->raw = $raw;
        $this->meta = $meta;
    }
}
