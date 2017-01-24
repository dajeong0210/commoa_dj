<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserUpdateRequest extends FormRequest
{

    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'user_email' => 'required|email',
            'user_name' => 'required|max:255',
            'password' => 'min:6|confirmed',
            'old_password' => 'required',
        ];
    }
    
    public function response(array $errors){
        return redirect('/myinfo')
                        ->withErrors($errors)
                        ->withInput();
    }
}
