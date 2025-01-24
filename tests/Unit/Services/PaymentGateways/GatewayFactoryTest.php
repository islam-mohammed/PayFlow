<?php

namespace Tests\Unit\Services\PaymentGateways;

use App\Services\PaymentGateways\GatewayFactory;
use App\Services\PaymentGateways\StripeGatewayService;
use App\Services\PaymentGateways\PaypalGatewayService;
use Tests\TestCase;

class GatewayFactoryTest extends TestCase
{
    public function test_create_method_returns_stripe_gateway()
    {
        $gateway = GatewayFactory::create('stripe');
        $this->assertInstanceOf(StripeGatewayService::class, $gateway);
    }

    public function test_create_method_returns_paypal_gateway()
    {
        $gateway = GatewayFactory::create('paypal');
        $this->assertInstanceOf(PaypalGatewayService::class, $gateway);
    }

    public function test_create_method_throws_exception_for_invalid_gateway()
    {
        $this->expectException(\InvalidArgumentException::class);
        GatewayFactory::create('invalid_gateway');
    }
}
