<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RequestOffice extends FormRequest
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
            'address' => 'required',
            'province' => 'required',
            'district' => 'required',
            'subdistrict' => 'required',
            'zipcode' => 'required',
        ];
    }

    public function messages()
    {
        return [
            //
            'name.required' => 'กรุณาใส่าชื่อหน่วยงาน',
            'address.required' => 'กรุณาใส่ที่อยู่หน่ยวงาน',
            'province.required' => 'กรุณาเลือกจังหวัด',
            'district.required' => 'กรุณาเลือกอำเภอ',
            'subdistrict.required' => 'กรุณาเลือกตำบล',
            'zipcode.required' => 'กรุณาเลือกรหัสไปรษณีย์',
            '' => '',
        ];
    }
}
