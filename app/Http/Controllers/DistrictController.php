<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\RequestDistrict;

use App\Province;
use App\District;

class DistrictController extends Controller
{
    //
    public function districtMain()
    {
        $provinces = $this->getProvince()->pluck('name', 'id');
        $districts = $this->getDistrict();
        return view('admin.city.district.main', [
            'count' => 1,
            'provinces' => $provinces,
            'districts' => $districts
        ]);
    }

    //
    public function districtEdit($id)
    {
        $provinces = $this->getProvince()->pluck('name', 'id');
        $district = $this->getDistrict()->find($id);
        return view('admin.city.district.edit', [
            'provinces' => $provinces,
            'district' => $district
        ]);
    }

    //
    public function districtStore(RequestDistrict $request)
    {
        $input['name'] = $request->name;
        $input['province_id'] = $request->province;
        try {
            $district = District::create($input);
        } catch (\Exception $e) {
            return redirect()->route('admin.district')->with('error', 'ไม่สามารถเพิ่มอำเภอ "'.$input['name'].'" ได้!!');
        }
        return redirect()->route('admin.subdistrict')->with('status', 'เพิ่มอำเภอ "'.$district->name.'" เรียบร้อย!!')->with('province', $input['province_id'])->with('district', $district->id);
    }

    //
    public function districtUpdate(RequestDistrict $request, $id)
    {
        $district = District::findOrFail($id);
        $district->name = $request->name;
        $district->province_id = $request->province;
        try {
            $district->save();
        } catch (\Exception $e) {
            return redirect()->route('admin.district.edit', ['id' => $district->id])->with('error', 'ไม่สามารถแก้ไขอำเภอ "'.$input['name'].'" ได้!!');
        }
        return redirect()->route('admin.district.edit', ['id' => $district->id])->with('status', 'แก้ไขอำเภอ "'.$district->name.'" เรียบร้อย!!');
    }

    //
    public function districtDelete($id)
    {
        $district = District::findOrFail($id);
        try {
            $district->delete();
        } catch (\Exception $e) {
            return redirect()->route('admin.district')->with('error', 'อำเภอ "'.$district->name.'" มีการใช้งานอยู่ ไม่สามารถลบได้!!');
        }
        return redirect()->route('admin.district')->with('status', 'ลบอำเภอ "'.$district->name.'" เรียบร้อย!!');
    }

    //
    private function getProvince()
    {
        $province = Province::all();
        return $province;
    }

    //
    private function getDistrict()
    {
        $district = District::all();
        return $district;
    }
}
