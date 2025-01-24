<?php

namespace Tests\Unit\Services\PaymentGateways;

use App\Services\PaymentGateways\StripeGatewayService;
use Tests\TestCase;

class StripeGatewayServiceTest extends TestCase
{
    public function test_charge_method_returns_correct_response()
    {
        $gateway = new StripeGatewayService();
        $response = $gateway->charge(100.00, ['test_data' => 'value']);

        $this->assertArrayHasKey('transaction_id', $response);
        $this->assertEquals('success', $response['status']);
        $this->assertEquals(100.00, $response['amount']);
    }

    public function test_refund_method_returns_true()
    {
        $gateway = new StripeGatewayService();
        $result = $gateway->refund('stripe_12345', 50.00);

        $this->assertTrue($result);
    }
}
