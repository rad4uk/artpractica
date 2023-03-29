<?php

namespace App\Http\Requests\Admin\Api;

use Illuminate\Foundation\Http\FormRequest;

class ImagesRequest extends FormRequest
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
     * @return array
     */
    public function rules()
    {
        return [
            "images" => "required|array",
            "images.*" => "image|mimes:jpg,jpeg,png",
        ];
    }

    public function messages()
    {
        return [
            "images.required" => "Вы забыли выбрать изображение",
            'images.image' => 'Загружаемые файлы должны быть изображениями',
            'images.mimes' => 'Загружаемые файлы должны быть формата jpg, jpeg, png',
        ];
    }
}
