<?php

namespace App\Http\Requests\Api;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class RegistrationRequest extends FormRequest
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
            'fio' => 'required',
            'identification_code' => 'required|string|min:7',
            'image1' => 'required|file|mimes:jpeg,png,jpg',
            'image2' => 'required|file|mimes:jpeg,png,jpg',
            'image3' => 'required|file|mimes:jpeg,png,jpg'
        ];
    }

    protected function failedValidation(Validator $validator): void
    {
        $response = response()->json($validator->errors());
        throw new HttpResponseException($response, 422);
    }
}
