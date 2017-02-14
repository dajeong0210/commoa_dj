<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProductUpdateRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }


    public function rules()
    {
        return [
            'name' => 'required',
            'image' => 'image',
            'url' => 'required',
            'price' => 'required|numeric',
            'cpu_id' => 'required',
            'vga_id' => 'required',
            'ssd' => 'numeric',
            'hdd' => 'numeric',
            'ram' => 'required|numeric',
            'power' => 'required|numeric',
            'monitor' => 'numeric',
        ];
    }
    
    public function response(array $errors){
        return back()->withErrors($errors)->withInput();
    }
}
