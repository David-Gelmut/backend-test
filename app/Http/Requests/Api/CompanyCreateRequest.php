<?php

namespace App\Http\Requests\Api;

use Illuminate\Foundation\Http\FormRequest;

class CompanyCreateRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return auth()->check();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'inn' => ['required', 'max:12','min:10'],
        ];
    }

    public function messages()
    {
        return [
            'inn.required' => 'Поле с ИНН обязательно для заполнения',
            'inn.max' => 'Поле с ИНН имеет не более 12 символов',
            'inn.min' => 'Поле с ИНН имеет не менее 10 символов',
        ];
    }
}
