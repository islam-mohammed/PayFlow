<?php

namespace App\Http\Controllers;

use App\Actions\Payments\CreatePaymentAction;
use App\Http\Requests\CreatePaymentRequest;

class PaymentController extends Controller
{
    public function __construct(private CreatePaymentAction $createPaymentAction) {}

    public function store(CreatePaymentRequest $request)
    {
        $response = $this->createPaymentAction->execute(
            $request->gateway,
            $request->amount,
            $request->validated()
        );

        return response()->json($response);
    }
}
