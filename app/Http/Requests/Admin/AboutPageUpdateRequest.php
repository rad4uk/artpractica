<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class AboutPageUpdateRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function rules(): array
    {
        return [
            'title' => 'required|string',
            'slug' => 'string|required',
            'status' => 'integer|required',
            'meta_title' => 'string|required',
            'meta_description' => 'string|required',
            'first_section_data.authorName' => 'string|required',
            'first_section_data.authorDescription' => 'string|required',
            'first_section_data.description' => 'string|required',
            'first_section_data.image' => 'required|image|mimes:jpg,png,jpeg,webp,svg',
            'second_section_data.title' => 'string|required',
            'second_section_data.description' => 'string|required',
            'second_section_data.image' => 'required|image|mimes:jpg,png,jpeg,webp,svg',
            'third_section_data.title' => 'string|required',
            'third_section_data.description' => 'string|required',
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
        ];
    }
}
