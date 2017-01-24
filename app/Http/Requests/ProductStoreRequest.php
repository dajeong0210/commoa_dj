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
            'image' => 'required',
            'url' => 'required',
            'price' => 'required',
            'cpu' => 'required',
            'vga' => 'required',
            'ram' => 'required|numeric',
            'ssd' => 'required|numeric',
            'hdd' => 'required|numeric',
            'power' => 'required|numeric',
        ];
    }
    
    public function response(array $errors){
        return redirect('myproduct/create')->withErrors($errors)->withInput();
    }
}
