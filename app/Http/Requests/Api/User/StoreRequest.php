<?php

namespace App\Http\Requests\Api\User;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class StoreRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */

    protected $user;

    public function authorize(): bool
    {
        return true;
    }

    protected function prepareForValidation(): void
    {
        $this->user = $this->route()->user;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, ValidationRule|array|string>
     */
    public function rules(): array
    {

        return [
            'name' => 'required|min:2',
            'email' => !$this->user ? 'required|email|unique:users,email': '',
            'password' => !$this->user ? 'required|min:8' : '',
            'role_id' => 'required|exists:roles,id'
        ];
    }
}
