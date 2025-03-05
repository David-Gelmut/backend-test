<?php

namespace App\Http\Requests\Api;

use Illuminate\Foundation\Http\FormRequest;

class UserRegisterRequest extends FormRequest
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
            'name'=>['required','string','max:100'],
            'email'=>['required','string','email','unique:users','max:50'],
            'password'=>['required','confirmed','min:8']
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'Поле с именем обязательно для заполнения',
            'name.max' => 'Поле с именем должно быть не более 50 символов',
            'email.required' => 'Поле с email обязательно для заполнения',
            'email.email' => 'Поле электронной почты должно содержать действительный адрес электронной почты',
            'email.unique' => 'Пользователь с таким email уже есть в базе',
            'password.required' => 'Поле с паролем обязательно для заполнения',
            'password.min' => 'Поле пароля должно содержать не менее 8 символов.',
            'password.confirmed' => 'Поле пароля должно содержать с полем подтверждение пароля',
        ];
    }
}
