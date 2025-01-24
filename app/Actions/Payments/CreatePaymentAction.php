<?php

namespace App\Actions\Payments;

use App\Repositories\PaymentRepository;
use App\Services\PaymentGateways\GatewayFactory;

class CreatePaymentAction
{
    public function __construct(
        private PaymentRepository $paymentRepository
    ) {}

    public function execute(string $gateway, float $amount, array $data): array
    {
        $paymentGateway = GatewayFactory::create($gateway);
        $response = $paymentGateway->charge($amount, $data);

        $this->paymentRepository->create([
            'transaction_id' => $response['transaction_id'],
            'gateway' => $gateway,
            'amount' => $amount,
            'status' => $response['status'],
        ]);

        return $response;
    }
}
