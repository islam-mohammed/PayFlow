<?php

namespace App\Interfaces;

interface PaymentGatewayInterface
{
    public function charge(float $amount, array $data): array;
    public function refund(string $transactionId, float $amount): bool;
}
