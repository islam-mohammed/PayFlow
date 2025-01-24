<?php

namespace App\Services\PaymentGateways;

use App\Interfaces\PaymentGatewayInterface;

class GatewayFactory
{
    public static function create(string $gateway): PaymentGatewayInterface
    {
        return match ($gateway) {
            'stripe' => new StripeGatewayService(),
            'paypal' => new PaypalGatewayService(),
            default => throw new \InvalidArgumentException('Invalid payment gateway.'),
        };
    }
}
