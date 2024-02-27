<?php

namespace App\Http\Requests\Api;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

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
            'identification_code' => 'required|min:14',
            'image1' => 'required|file|mimes:jpeg,png,jpg',
            'image2' => 'required|file|mimes:jpeg,png,jpg',
            'image3' => 'required|file|mimes:jpeg,png,jpg'
        ];
    }
}
