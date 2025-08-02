<?php

namespace Kmalarifi\PaymentGateways\DTO;

class CreateCheckoutResponseDTO
{

    public string $resultCode;
    public string $resultDescription;
    public string $buildNumber;
    public string $timestamp;
    public string $ndc;
    public string $id;
    public string $integrity;
    public string $trackingId;

    public function __construct(
        string $resultCode,
        string $resultDescription,
        string $buildNumber,
        string $timestamp,
        string $ndc,
        string $id,
        string $integrity,
        string $trackingId
    ) {
        $this->resultCode = $resultCode;
        $this->resultDescription = $resultDescription;
        $this->buildNumber = $buildNumber;
        $this->timestamp = $timestamp;
        $this->ndc = $ndc;
        $this->id = $id;
        $this->integrity = $integrity;
        $this->trackingId = $trackingId;
    }

}