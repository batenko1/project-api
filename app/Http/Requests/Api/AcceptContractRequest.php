<?php

namespace App\Http\Requests\Api;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class AcceptContractRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'account_id' => 'required|exists:accounts,id',
            'order_id' => 'required|exists:orders,id'
        ];
    }

    public function messages()
    {
        return [
            'account_id.required' => 'Идентификатор профиля обязателен',
            'account_id.exists' => 'Несуществующий профиль',
            'order_id.required' => 'Идентификатор заказа обязателен',
            'order_id.exists' => 'Несуществующий заказ',
        ];
    }

    protected function failedValidation(Validator $validator): void
    {
        $response = response()->json($validator->errors());
        throw new HttpResponseException($response, 422);
    }


}
