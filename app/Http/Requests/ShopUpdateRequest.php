<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ShopUpdateRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }


    public function rules()
    {
        return [
            'user_email' => 'required|email',
            'name' => 'required',
            'url' => 'required',
            'contact_name' => 'required',
            'contact_email' => 'required|email',
            'contact_phone' => 'required',
            'contact_address' => 'required',
            'image' => 'image',
        ];
    }
    
    public function response(array $errors){
        return back()->withErrors($errors)->withInput();
    }
}
