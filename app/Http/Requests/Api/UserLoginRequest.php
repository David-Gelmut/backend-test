<?php

namespace App\Http\Requests\Api;

use Illuminate\Foundation\Http\FormRequest;

class UserLoginRequest extends FormRequest
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
            'email'=>['required','email'],
            'password'=>['required','min:8']
        ];
    }

    public function messages()
    {
        return [
            'email.required' => 'Поле с email обязательно для заполнения',
            'email.email' => 'Поле электронной почты должно содержать действительный адрес электронной почты',
            'password.required' => 'Поле с паролем обязательно для заполнения',
            'password.min' => 'Поле пароля должно содержать не менее 8 символов.',
        ];
    }
}
