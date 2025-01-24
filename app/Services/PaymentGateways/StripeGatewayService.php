<?php

namespace App\Services\PaymentGateways;

use App\Interfaces\PaymentGatewayInterface;

class StripeGatewayService implements PaymentGatewayInterface
{
    public function charge(float $amount, array $data): array
    {
        // Simulate Stripe API charge
        return [
            'transaction_id' => 'stripe_12345',
            'status' => 'success',
            'amount' => $amount,
        ];
    }

    public function refund(string $transactionId, float $amount): bool
    {
        // Simulate Stripe API refund
        return true;
    }
}
