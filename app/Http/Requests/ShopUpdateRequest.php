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
            'shop_name' => 'required',
            'shop_url' => 'required',
            'contact_name' => 'required',
            'contact_email' => 'required|email',
            'contact_mobile' => 'required',
            'business_address' => 'required',
        ];
    }
    
    public function response(array $errors){
        return back()->withErrors($errors)->withInput();
    }
}
