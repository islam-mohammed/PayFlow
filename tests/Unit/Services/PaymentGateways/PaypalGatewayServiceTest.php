<?php

namespace Tests\Unit\Services\PaymentGateways;

use App\Services\PaymentGateways\PaypalGatewayService;
use Tests\TestCase;

class PaypalGatewayServiceTest extends TestCase
{
    public function test_charge_method_returns_correct_response()
    {
        $gateway = new PaypalGatewayService();
        $response = $gateway->charge(200.00, ['test_data' => 'value']);

        $this->assertArrayHasKey('transaction_id', $response);
        $this->assertEquals('success', $response['status']);
        $this->assertEquals(200.00, $response['amount']);
    }

    public function test_refund_method_returns_true()
    {
        $gateway = new PaypalGatewayService();
        $result = $gateway->refund('paypal_67890', 30.00);

        $this->assertTrue($result);
    }
}
