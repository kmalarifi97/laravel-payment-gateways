<?php

namespace Kmalarifi\PaymentGateways;


abstract class AbstractGateway
{
    /** Allow children to reuse basic error formatting */

    public function returnResponse($response)
    {
        return $response;
    }
}