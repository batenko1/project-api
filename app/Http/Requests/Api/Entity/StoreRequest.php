<?php

namespace App\Http\Requests\Api\Entity;

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
            'title' => 'required|string',
            'parent_id' => $this->request->get('parent_id') ? 'sometimes|numeric|exists:entities,id' : '',
            'filters_type' => 'sometimes',
            'filters_name' => 'sometimes',
            'filters_alias' => 'sometimes',
            'filters_values' => 'sometimes',


            'filters_entity_type' => 'sometimes',
            'filters__entity_name' => 'sometimes',
            'filters_entity_alias' => 'sometimes',
            'filters_entity_values' => 'sometimes',



        ];
    }

    public function messages()
    {
        return [
            'title.required' => 'Заголовок обязательный',
            'title.string' => 'Заголовок должен быть строкой',
            'parent_id.exists' => 'Несуществующая категория'
        ];
    }
}
