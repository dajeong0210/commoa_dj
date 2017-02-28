<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CategoryRequest extends FormRequest
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
            'category_name' => 'required',
            'color' => 'unique:categories,color',
            'min_memory' => 'numeric',
            'storage' => 'numeric',
            'recommend_memory' => 'numeric',
            'category_image' => 'image',
        ];
    }

    public function response(array $errors){
        return back()->withErrors($errors)->withInput();
    }
}
