<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RequestSubdistrict extends FormRequest
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
            'zipcode' => 'required|size:5'
        ];
    }

    public function messages()
    {
        return [
            //
            'name.required' => 'กรุณาใส่ชื่อตำบล',
            'zipcode.required' => 'กรุณาใส่รหัสไปรษณีย์',
            'zipcode.size' => 'กรุณาใส่รหัสไปรษณีย์ ให้ครบ 5 ตัว',

        ];
    }
}
