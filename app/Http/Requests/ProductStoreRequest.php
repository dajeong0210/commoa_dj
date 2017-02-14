<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProductStoreRequest extends FormRequest
{

    public function authorize()
    {
        return true;
    }


    public function rules()
    {
        return [
            'name' => 'required',
            'image' => 'required|image',
            'url' => 'required',
            'price' => 'required|numeric',
            'cpu_id' => 'required',
            'vga_id' => 'required',
            'ram' => 'required|numeric',
            'ssd' => 'numeric',
            'hdd' => 'numeric',
            'power' => 'required|numeric',
        ];
    }
    
    public function response(array $errors){
        return redirect('myproduct/create')->withErrors($errors)->withInput();
    }
}
