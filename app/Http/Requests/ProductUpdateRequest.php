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
            'ram' => 'required|numeric',
            'ssd' => 'required|numeric',
            'hdd' => 'required|numeric',
            'power' => 'required|numeric',
        ];
    }
    
    public function response(array $errors){
        return back()->withErrors($errors)->withInput();
    }
}
