<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RequestShop extends FormRequest
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
            'titlename' => 'required',
            'f_name' => 'required',
            'l_name' => 'required',
            'tel' => 'required|size:10',
            'address' => 'required',
            'province' => 'required',
            'district' => 'required',
            'subdistrict' => 'required',
        ];
    }

    public function messages()
    {
        return [
            //
            'name.required' => 'กรุณาใส่ชื่อร้านอาหาร',
            'titlename.required' => 'กรุณาเลือกคำนำหน้าชื่อ',
            'f_name.required' => 'กรุณาใส่ชื่อ',
            'l_name.required' => 'กรุณาใส่นามสกุล',
            'tel.required' => 'กรุณาใส่เบอร์โทรศัพท์ติดต่อ',
            'tel.size' => 'กรุณาใส่เบอร์โทรศัพท์ให้ครบ 10 ตัว',
            'address.required' => 'กรุณาใสที่อยู่ร้านอาหาร',
            'province.required' => 'กรุณาเลือกจังหวัด',
            'district.required' => 'กรุณาเลือกอำเภอ',
            'subdistrict.required' => 'กรุณาเลือกตำบล',
        ];
    }
}
