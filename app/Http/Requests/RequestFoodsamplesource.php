<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RequestFoodsamplesource extends FormRequest
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
            'name.required' => 'กรุณาใส่ชื่อแหล่งที่มาตัวอย่างอาหาร',
        ];
    }
}
