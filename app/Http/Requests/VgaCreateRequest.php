<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class VgaCreateRequest extends FormRequest
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
            'name' => 'required|unique:vgas,name',
            'brand' => 'required',
            'level' => 'required',
        ];
    }

    public function response(array $errors){
        return back()->withErrors($errors)->withInput();
    }
}
