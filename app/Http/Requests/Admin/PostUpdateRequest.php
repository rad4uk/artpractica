<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class PostUpdateRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize(): bool
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
            'formData.meta_title' => 'required|string|max:255',
            'formData.meta_description' => 'required|string|max:500',
            'formData.title' => 'string|required|max:500',
            'formData.sub_title' => 'string|required|max:500',
            'formData.description' => 'nullable|string',
            'formData.category_id' => 'required|exists:categories,id',
            'formData.preview_file' => 'required|image|mimes:jpeg,jpg,png,webp',
            'formData.apartment_images.*' => 'nullable|image|mimes:jpeg,jpg,png,webp',
            'formData.square' => 'required|numeric',
            'formData.additionalPosts.*' => 'nullable|exists:posts,id'
        ];
    }


    public function messages(): array
    {
        return [
            'formData.meta_title.required' => 'Поле "Мета заголовок" является обязательным и должно содержать не более 255 символов.',
            'formData.meta_title.string' => 'Поле "Мета заголовок" должно быть строкой.',
            'formData.meta_description.required' => 'Поле "Мета описание" является обязательным и должно содержать не более 500 символов.',
            'formData.meta_description.string' => 'Поле "Мета описание" должно быть строкой.',
            'formData.title.string' => 'Поле "Заголовок" должно быть строкой.',
            'formData.title.required' => 'Поле "Заголовок" является обязательным и должно содержать не более 500 символов.',
            'formData.sub_title.string' => 'Поле "Подзаголовок" должно быть строкой.',
            'formData.sub_title.required' => 'Поле "Подзаголовок" является обязательным и должно содержать не более 500 символов.',
            'formData.description.string' => 'Поле "Описание" должно быть строкой.',
            'formData.category_id.required' => 'Поле "ID категории" является обязательным и должно существовать в базе данных.',
            'formData.category_id.exists' => 'Выбранная категория не существует в базе данных.',
            'formData.preview_file.required' => 'Поле "Превью файла" является обязательным и должно быть изображением в форматах jpeg, jpg, png или webp.',
            'formData.preview_file.image' => 'Поле "Фото проекта" должно быть изображением.',
            'formData.preview_file.mimes' => 'Поле "Фото проекта" должно быть изображением в форматах jpeg, jpg, png или webp.',
            'formData.apartment_images.*.image' => 'Поле "Фотографии планировки" должно быть изображением.',
            'formData.apartment_images.*.mimes' => 'Поле "Фотографии планировки" должно быть изображением в форматах jpeg, jpg, png или webp.',
            'formData.square.required' => 'Поле "Площадь" является обязательным и должно быть числом.',
            'formData.square.numeric' => 'Поле "Площадь" должно быть числом.',
            'formData.additionalPosts.*.exists' => 'Выбранная дополнительная запись не существует в базе данных.'
        ];
    }
}
