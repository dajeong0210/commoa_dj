<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ApplyUpdateRequest extends FormRequest
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
            'user_email' => 'email',
            'shop_name' => 'required',
            'shop_url' => 'required',
            'business_name' => 'required',
            'business_ceo' => 'required',
            'business_address' => 'required',
            'business_no' => 'required|numeric',
            'business_sale_no' => 'required',
            'contact_name' => 'required',
            'contact_email' => 'required|email',
            'contact_mobile' => 'required',
            'contact_phone' => 'required',
            'agree_01' => 'accepted',
            'agree_02' => 'accepted',
        ];
    }
}
