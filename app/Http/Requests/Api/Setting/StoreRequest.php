<?php

namespace App\Http\Requests\Api\Setting;

use Illuminate\Foundation\Http\FormRequest;

class StoreRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */

    public $settingId;

    public function authorize(): bool
    {
        return true;
    }

    public function prepareForValidation()
    {


    }

    public function rules(): array
    {

        return [
            'title' => 'required|string',
            'key' => 'required|string',
            'value' => !$this->route('setting')?->id ? 'required' : '',
        ];
    }

    public function messages()
    {
        return [
            'title.required' => 'Заголовок обязателен',
            'key.required' => 'Ключ обязателен',
            'value' => 'Значение обязательное'
        ];
    }
}
