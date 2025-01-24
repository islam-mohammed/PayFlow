<?php

namespace App\Actions\Payments;

use App\Repositories\PaymentRepository;
use App\Services\PaymentGateways\GatewayFactory;

class RefundPaymentAction
{
    public function __construct(
        private PaymentRepository $paymentRepository
    ) {}

    /**
     * Handle the refund process.
     *
     * @param string $gateway
     * @param string $transactionId
     * @param float $amount
     * @return array
     */
    public function execute(string $gateway, string $transactionId, float $amount): array
    {
        // Get the appropriate gateway service
        $paymentGateway = GatewayFactory::create($gateway);

        // Process the refund
        $refundStatus = $paymentGateway->refund($transactionId, $amount);

        if ($refundStatus) {
            // Update the payment record (optional based on your use case)
            $payment = $this->paymentRepository->updateStatusByTransactionId($transactionId, 'refunded');

            return [
                'status' => 'success',
                'message' => 'Refund processed successfully.',
                'payment' => $payment,
            ];
        }

        return [
            'status' => 'failure',
            'message' => 'Refund processing failed. Please try again.',
        ];
    }
}
