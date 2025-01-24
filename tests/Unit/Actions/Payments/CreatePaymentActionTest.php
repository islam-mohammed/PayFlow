<?php

namespace Tests\Unit\Actions\Payments;

use App\Actions\Payments\CreatePaymentAction;
use App\Repositories\PaymentRepository;
use App\Services\PaymentGateways\StripeGatewayService;
use Mockery;
use Tests\TestCase;

class CreatePaymentActionTest extends TestCase
{
    public function test_execute_method_creates_payment()
    {
        $mockRepository = Mockery::mock(PaymentRepository::class);
        $mockRepository->shouldReceive('create')->once()->andReturn(['id' => 1]);

        $action = new CreatePaymentAction($mockRepository);
        $gatewayMock = Mockery::mock(StripeGatewayService::class);
        $gatewayMock->shouldReceive('charge')->once()->andReturn([
            'transaction_id' => 'test_12345',
            'status' => 'success',
            'amount' => 100.00,
        ]);

        $response = $action->execute('stripe', 100.00, ['card' => '1234']);
        $this->assertEquals('test_12345', $response['transaction_id']);
        $this->assertEquals('success', $response['status']);
        $this->assertEquals(100.00, $response['amount']);
    }
}
