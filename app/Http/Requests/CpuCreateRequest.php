<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CpuCreateRequest extends FormRequest
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
            'cpu_name' => 'required|unique:cpus,name',
            'cpu_brand' => 'required',
            'cpu_core' => 'required',
            'cpu_level' => 'required',
        ];
    }

    public function response(array $errors){
        return back()->withErrors($errors)->withInput();
    }
}
