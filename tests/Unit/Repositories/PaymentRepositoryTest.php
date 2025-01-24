<?php

namespace Tests\Unit\Repositories;

use App\Models\Payment;
use App\Repositories\PaymentRepository;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class PaymentRepositoryTest extends TestCase
{
    use RefreshDatabase;

    public function test_create_method_saves_payment_to_database()
    {
        $repository = new PaymentRepository();
        $payment = $repository->create([
            'transaction_id' => 'test_12345',
            'gateway' => 'stripe',
            'amount' => 150.00,
            'status' => 'success',
        ]);

        $this->assertDatabaseHas('payments', [
            'transaction_id' => 'test_12345',
            'gateway' => 'stripe',
            'amount' => 150.00,
            'status' => 'success',
        ]);
        $this->assertInstanceOf(Payment::class, $payment);
    }
}
