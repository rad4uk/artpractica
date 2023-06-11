<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class ContactPageUpdateRequest extends FormRequest
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
    public function rules()
    {
        return [
            'title' => 'required|string',
            'slug' => 'string|required',
            'status' => 'integer|required',
            'meta_title' => 'string|required',
            'meta_description' => 'string|required',
            'fields.address' => 'string|required',
            'fields.phone' => 'string|required',
            'fields.email' => 'string|required',
        ];
    }

    public function messages(): array
    {
        return [
            'title' => "Поле Название обязательно",
            'slug.required' => 'Поле Ссылка является обязательным',
            'slug.unique' => 'Поле ссылка должна быть уникальной',
            'meta_title' => "Поле Мета заголовок является обязателеным",
            'meta_description' => "Поле Мета описание является обязателеным",
            'fields.address.required' => "Поле Адрес является обязателеным",
            'fields.phone.required' => "Поле Телефон является обязателеным",
            'fields.email.required' => "Поле email является обязателеным",
        ];
    }
}
