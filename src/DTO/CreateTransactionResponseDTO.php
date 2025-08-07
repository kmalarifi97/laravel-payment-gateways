<?php

namespace Kmalarifi\PaymentGateways\DTO;

class CreateTransactionResponseDTO
{
    public string $status;              // e.g., 'success', 'pending', 'failed'
    public string $code_status;         // Canonical status code (e.g., 'redirect')
    public string $reference;           // Transaction/session/order ID
    public ?string $transactionUrl;     // Redirect URL if applicable
    public ?string $htmlForm;
    public bool $redirect;
    public ?string $message;            // Human-readable message
    public ?string $code;               // Gateway response code
    public array $raw;                  // Full raw API response
    public array $metadata;             // Adapter-specific extras

    public function __construct(
        string  $status,
        string  $code_status,
        string  $reference,
        ?string $transactionUrl = null,
        ?string $htmlForm = null,
        bool    $redirect = false,
        ?string $message = null,
        ?string $code = null,
        array   $raw = [],
        array   $metadata = []
    )
    {
        $this->status = $status;
        $this->code_status = $code_status;
        $this->reference = $reference;
        $this->transactionUrl = $transactionUrl;
        $this->htmlForm = $htmlForm;
        $this->redirect = $redirect;
        $this->message = $message;
        $this->code = $code;
        $this->raw = $raw;
        $this->metadata = $metadata;
    }
}
