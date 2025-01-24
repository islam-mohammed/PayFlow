<?php

namespace App\Repositories;

use App\Models\Payment;

class PaymentRepository
{
    public function create(array $data): Payment
    {
        return Payment::create($data);
    }
    public function updateStatusByTransactionId(string $transactionId, string $status)
    {
        $payment = Payment::where('transaction_id', $transactionId)->firstOrFail();
        $payment->status = $status;
        $payment->save();

        return $payment;
    }
}
