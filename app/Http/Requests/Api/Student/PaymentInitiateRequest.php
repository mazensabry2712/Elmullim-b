<?php

namespace App\Http\Requests\Api\Student;

use Illuminate\Foundation\Http\FormRequest;

class PaymentInitiateRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'wallet_number' => ['required', 'string', 'regex:/^01[0125][0-9]{8}$/'],
            'orderable_type' => ['required', 'string', 'in:lessons,courses'],
            'orderable_id' => ['required', 'integer', 'min:1'],
        ];
    }

    public function failedValidation(\Illuminate\Contracts\Validation\Validator $validator)
    {
        return failResponse($validator->errors()->first());
    }
}
