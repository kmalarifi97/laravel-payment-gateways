<?php

namespace Kmalarifi\PaymentGateways\DTO;

//
//{
//    "result": {
//    "code": "000.200.100",
//    "description": "successfully created checkout"
//  },
//  "build_number": "3f7c7328bd046bae24e507712d6bad58f6371657@2025-07-30 13:41:24 +0000",
//  "timestamp": "2025-07-30 14:24:00+0000",
//  "ndc": "733D53C17947C29D100D5A3E1C2CCDBB.uat01-vm-tx01",
//  "id": "733D53C17947C29D100D5A3E1C2CCDBB.uat01-vm-tx01",
//  "integrity": "sha384-ZL0CY7Zz/FLBPKm3nIqj5W3YUNxyHvk6KGXmYzmR/zRAWy9pmVbcaODewOCaI2XU",
//  "tracking_id": "7b9db8a4-2c81-41c2-879b-5701e4bb583c25965"
//}
class CreateCheckoutDTO
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