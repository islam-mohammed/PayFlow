<?php

namespace App\Services\PaymentGateways;

use App\Interfaces\PaymentGatewayInterface;

class PaypalGatewayService implements PaymentGatewayInterface
{
    public function charge(float $amount, array $data): array
    {
        // Simulate PayPal API charge
        return [
            'transaction_id' => 'paypal_' . uniqid(),
            'status' => 'success',
            'amount' => $amount,
        ];
    }

    public function refund(string $transactionId, float $amount): bool
    {
        // Simulate PayPal API refund
        return true;
    }
}
