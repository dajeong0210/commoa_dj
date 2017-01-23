<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ApplyStoreRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'user_email' => 'email|unique:applies',
            'shop_name' => 'required',
            'shop_url' => 'required',
            'business_name' => 'required',
            'business_ceo' => 'required',
            'business_address' => 'required',
            'business_no' => 'required|numeric',
            'business_sale_no' => 'required',
            'business_docu' => 'required',
            'sale_docu' => 'required',
            'contact_name' => 'required',
            'contact_email' => 'required|email',
            'contact_mobile' => 'required',
            'contact_phone' => 'required',
            'agree_01' => 'accepted',
            'agree_02' => 'accepted',
        ];
    }

}
