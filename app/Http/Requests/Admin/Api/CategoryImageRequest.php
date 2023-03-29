<?php

namespace App\Http\Requests\Admin\Api;

use Illuminate\Foundation\Http\FormRequest;

class CategoryImageRequest extends FormRequest
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
            'image' => "required|image|mimes:jpg,jpeg,png",
            'categoryId' => 'required|integer',
            'categoryImageId' => 'required|integer',
        ];
    }

    public function messages()
    {
        return [
            "image.required" => "Вы забыли выбрать изображение",
            'image.image' => 'Загружаемые файлы должны быть изображениями',
            'image.mimes' => 'Загружаемые файлы должны быть формата jpg, jpeg, png',
        ];
    }
}
