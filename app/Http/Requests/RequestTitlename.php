<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RequestTitlename extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'titlename' => 'required'
        ];
    }

    public function messages()
    {
        return [
            'titlename.required' => 'กรุณาใส่คำนำหน้าชื่อ',
            'titlename.unique' => 'ไม่สามารถเพิ่มคำหน้าชื่อซ้้ำกันได้'
        ];
    }
}
