<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RequestUserEdit extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            //
            'email' => 'required',
            'titlename' => 'required',
            'f_name' => 'required',
            'l_name' => 'required',
            'phone' => 'required|min:9|max:10',
            'office' => 'required'
        ];
    }

    public function messages()
    {
        return [
            //
            'email.required' => 'กรุณาใส่อีเมล',
            'titlename.required' => 'กรุณาเลือกคำนำหน้าชื่อ',
            'f_name.required' => 'กรุณาใส่ชื่อ',
            'l_name.required' => 'กรุณาใส่นามสกุล',
            'phone.required' => 'กรุณาใส่เบอร์โทรศัพท์',
            'phone.min' => 'กรุณาใส่เบอร์โทรศัพท์ให้ครบ 9 - 10 ตัว',
            'phone.max' => 'กรุณาใส่เบอร์โทรศัพท์ให้น้อยกว่า 11 ตัว',
            'office.required' => 'กรุณาใส่อีเมล',
        ];
    }
}
