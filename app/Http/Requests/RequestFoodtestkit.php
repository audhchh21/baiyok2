<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RequestFoodtestkit extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            //
            'name' => 'required',
        ];
    }

    public function messages()
    {
        return [
            //
            'name.required' => 'กรุณาใส่ชื่อชุดทดสอบอาหาร',
        ];
    }
}
