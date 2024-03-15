<?php

namespace App\Http\Requests\Api\Page;

use Illuminate\Foundation\Http\FormRequest;

class StoreRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'title' => 'required',
            'text' => 'required'
        ];
    }

    public function messages()
    {
        return [
            'title.required' => 'Заголовок обязателен',
            'text.required' => 'Описание обязательное'
        ];
    }
}
