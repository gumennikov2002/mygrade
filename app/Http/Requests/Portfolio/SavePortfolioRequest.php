<?php

namespace App\Http\Requests\Portfolio;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class SavePortfolioRequest extends FormRequest
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
        return [
            'isActive' => ['required', 'boolean'],
            'title' => ['required', 'string', 'min:2', 'max:255'],
            'slug' => ['required', 'string', 'min:2', 'max:255'],
            'description' => ['nullable', 'string'],
        ];
    }

    public function messages(): array
    {
        return [
            'title.required' => 'Поле "Заголовок" обязательно для заполнения',
            'title.min' => 'Поле "Заголовок" должно содержать не менее :min символов',
            'title.max' => 'Поле "Заголовок" должно содержать не более :max символов',
            'slug.required' => 'Поле "Slug" обязательно для заполнения',
            'slug.min' => 'Поле "Slug" должно содержать не менее :min символов',
            'slug.max' => 'Поле "Slug" должно содержать не более :max символов',
        ];
    }
}
