<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class PageCreateRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules(): array
    {
        return [
            'title' => 'required|string',
            'description' => 'string',
            'slug' => 'string|required|unique:pages',
            'meta_title' => 'string|required',
            'meta_description' => 'string|required',
        ];
    }

    public function messages(): array
    {
        return [
            'title' => "Поле Название обязательно",
            'description' => 'Поле Описание должно быть от 2 символов',
            'slug.required' => 'Поле Ссылка является обязательным',
            'slug.unique' => 'Поле ссылка должна быть уникальной',
            'meta_title' => "Поле Мета заголовок является обязателеным",
            'meta_description' => "Поле Мета описание является обязателеным",
        ];
    }
}
