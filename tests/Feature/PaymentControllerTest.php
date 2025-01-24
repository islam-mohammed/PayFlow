<?php

namespace Tests\Feature;

use App\Models\Payment;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class PaymentControllerTest extends TestCase
{
    use RefreshDatabase;

    public function test_store_creates_payment()
    {
        $data = [
            'gateway' => 'stripe',
            'amount' => 100.00,
            'data' => ['card_number' => '1234'],
        ];

        $response = $this->postJson('/payments', $data);
        $response->assertStatus(200);
        $this->assertDatabaseHas('payments', [
            'gateway' => 'stripe',
            'amount' => 100.00,
        ]);
    }
}
