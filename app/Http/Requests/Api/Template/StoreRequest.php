<?php

namespace App\Http\Requests\Api\Template;

use Illuminate\Contracts\Validation\ValidationRule;
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

    protected function prepareForValidation(): void
    {
        $this->template = $this->route()->template;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'title' => 'required|string',
            'variables' => 'required|string',
            'file' => !$this->template ? 'required|file|mimes:doc,docx' : ''
        ];
    }

    public function messages()
    {
        return [
            'title.required' => 'Заголовок обязателен',
            'variables' => 'Переменные обязательны',
            'file.required' => 'Файл обязателен',
            'file.file' => 'Неккоректный тип файла',
            'file.mimes' => 'Неправильный формат файла'
        ];
    }
}
