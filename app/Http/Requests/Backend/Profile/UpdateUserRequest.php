<?php

namespace App\Http\Requests\Backend\Profile;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class UpdateUserRequest extends FormRequest
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
     * @return array<string, ValidationRule|array|string>
     */
    public function rules(): array
    {
        $user = auth()->user();

        return [
            'name' => ['required', 'string', 'min:2', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users,email,' . $user->id],
            'username' => ['required', 'string', 'max:255', 'unique:users,username,' . $user->id, 'regex:/^([a-zA-Z][a-zA-Z0-9]*|[a-zA-Z][a-zA-Z0-9]*_[a-zA-Z0-9]+)+$/'],
            'password' => ['nullable', 'string', 'min:8'],
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
            'name.required' => 'Поле не может быть пустым',
            'name.min' => 'Минимальная длина имени :min символов',
            'name.max' => 'Максимальная длина имени :max символов',
            'email.required' => 'Поле не может быть пустым',
            'email.unique' => 'Этот адрес электронной почты уже используется',
            'email.email' => 'Неверный адрес электронной почты',
            'username.required' => 'Поле не может быть пустым',
            'username.regex' => "Разрешенный формат: {$this->getValidUsernameFormats()}",
            'username.unique' => 'Это имя пользователя уже используется',
            'username.max' => 'Максимальная длина имени пользователя :max символов',
            'password.min' => 'Минимальная длина пароля :min символов',
        ];
    }

    protected function getValidUsernameFormats(): string
    {
        $username = request()->get('username');
        $snake = str($username)->snake();
        $camel = str($username)->camel();
        $pascal = ucfirst($camel);
        $formats = compact('snake', 'camel', 'pascal');

        return implode(', ', $formats);
    }
}
