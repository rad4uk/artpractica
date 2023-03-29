<?php

namespace App\Http\Requests\Admin\Api;

use Illuminate\Foundation\Http\FormRequest;

class CategoryImageUpdateRequest extends FormRequest
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
            'newImageId' => "required|integer",
            'categoryId' => 'required|integer',
            'categoryImageId' => 'required|integer',
        ];
    }

    public function messages()
    {
        return [

        ];
    }
}
