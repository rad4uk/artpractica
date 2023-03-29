<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Client\Request;

class PostCreateRequest extends FormRequest
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
            'parent' => 'required',
            'title' => 'string|required',
            'description' => 'string',
            'slug' => 'string|required|unique:posts',
            'preview_image' => 'required'
        ];
    }

    public function messages()
    {
        return [
            'title' => "Поле Заголовок обязательно",
            'slug.required' => 'Поле Ссылка является обязательным',
            'slug.unique' => 'Ссылка должна быть уникальной',
            'preview_image.required' => 'Фото проекта является обязательным'
        ];
    }
}
