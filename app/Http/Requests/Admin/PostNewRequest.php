<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class PostNewRequest extends FormRequest
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
            'formData.category_id' => 'required',
            'formData.title' => 'string|required',
            'formData.description' => 'string|required',
            'formData.slug' => 'string|required|unique:posts,slug',
            'formData.preview_file' => 'required'
        ];
    }

    public function messages()
    {
        return [
            'formData.categoryId' => "Вы забыли выбрать категорию",
            'formData.title' => "Поле Заголовок обязательно",
            'formData.slug.required' => 'Поле Ссылка является обязательным',
            'formData.slug.unique' => 'Ссылка должна быть уникальной',
            'formData.preview_file.required' => 'Фото проекта является обязательным полем'
        ];
    }
}
