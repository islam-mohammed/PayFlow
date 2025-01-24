<?php

namespace Tests\Unit\Actions\Payments;

use App\Actions\Payments\RefundPaymentAction;
use App\Repositories\PaymentRepository;
use App\Services\PaymentGateways\StripeGatewayService;
use Mockery;
use Tests\TestCase;

class RefundPaymentActionTest extends TestCase
{
    public function test_execute_method_processes_refund()
    {
        $mockRepository = Mockery::mock(PaymentRepository::class);
        $mockRepository->shouldReceive('updateStatusByTransactionId')->once()->andReturn([
            'id' => 1,
            'status' => 'refunded'
        ]);

        $action = new RefundPaymentAction($mockRepository);
        $gatewayMock = Mockery::mock(StripeGatewayService::class);
        $gatewayMock->shouldReceive('refund')->once()->andReturn(true);

        $response = $action->execute('stripe', 'test_12345', 50.00);
        $this->assertEquals('success', $response['status']);
        $this->assertEquals('Refund processed successfully.', $response['message']);
    }
}
