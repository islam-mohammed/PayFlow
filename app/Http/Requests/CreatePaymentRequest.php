<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreatePaymentRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'gateway' => 'required|string|in:stripe,paypal',
            'amount' => 'required|numeric|min:0.01',
            'data' => 'required|array',
        ];
    }
}
