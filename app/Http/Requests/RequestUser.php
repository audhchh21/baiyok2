<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RequestUser extends FormRequest
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
            'password' => 'required|confirmed|min:6',
            'password_confirmation' => 'min:6',
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
            'password.required' => 'กรุณาใส่รหัสผ่าน',
            'password.confirmed' => 'รหัสผ่านไม่ตรงกัน',
            'password.min' => 'กรุณาใส่รหัสผ่านมากกว่า 6 ตัว',
            'password_confirmation.min' => 'กรุณาใส่รหัสผ่านมากกว่า 6 ตัว',
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
