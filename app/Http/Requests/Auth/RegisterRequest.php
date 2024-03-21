<?php

namespace App\Http\Requests\Auth;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class RegisterRequest extends FormRequest
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
            'email' => ['required', 'string', 'email', 'unique:users,email'],
            'name' => ['required', 'string', 'min:2', 'max:255'],
            'password' => ['required', 'string', 'min:6', 'max:255', 'confirmed'],
        ];
    }

    /**
     * Get the error messages for the defined validation rules.
     *
     * @return array<string, string>
     */
    public function messages(): array
    {
        return [
            'email.required' => 'Поле не может быть пустым',
            'email.unique' => 'Этот адрес электронной почты уже используется',
            'email.email' => 'Неверный адрес электронной почты',
            'name.required' => 'Поле не может быть пустым',
            'name.min' => 'Минимальная длина имени :min символов',
            'name.max' => 'Максимальная длина имени :max символов',
            'password.required' => 'Поле не может быть пустым',
            'password.confirmed' => 'Пароли не совпадают',
            'password.min' => 'Минимальная длина пароля :min символов',
            'password.max' => 'Максимальная длина пароля :max символов',
        ];
    }
}
