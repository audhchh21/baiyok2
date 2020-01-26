<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\RequestSubdistrict;

use App\Province;
use App\District;
use App\Subdistrict;

class SubdistrictController extends Controller
{
    //
    public function subdistrictMain()
    {
        $provinces = $this->getProvince()->pluck('name', 'id');
        $districts = $this->getDistrict()->pluck('name', 'id');
        $subdistricts = $this->getSubdistrict();
        return view('admin.city.subdistrict.main', [
            'count' => 1,
            'provinces' => $provinces,
            'districts' => $districts,
            'subdistricts' => $subdistricts
        ]);
    }

    //
    public function subdistrictEdit($id)
    {
        $provinces = $this->getProvince()->pluck('name', 'id');
        $districts = $this->getDistrict()->pluck('name', 'id');
        $subdistrict = $this->getSubdistrict()->find($id);
        return view('admin.city.subdistrict.edit', [
            'provinces' => $provinces,
            'districts' => $districts,
            'subdistrict' => $subdistrict
        ]);
    }

    //
    public function subdistrictStore(RequestSubdistrict $request)
    {
        $input['name'] = $request->name;
        $input['zip_code'] = $request->zipcode;
        $input['district_id'] = $request->district;
        try {
            $subdistrict = Subdistrict::create($input);
        } catch (\Exception $e) {
            return redirect()->route('admin.subdistrict')->with('error', 'ไม่สามารถเพิ่มตำบล "'.$input['name'].'" ได้!!');
        }
        return redirect()->route('admin.subdistrict')->with('status', 'เพิ่มตำบล "'.$subdistrict->name.'" เรียบร้อย!!');
    }

    //
    public function subdistrictUpdate(RequestSubdistrict $request, $id)
    {
        $subdistrict = Subdistrict::findOrFail($id);
        $subdistrict->name = $request->name;
        $subdistrict->zip_code = $request->zipcode;
        $subdistrict->district_id = $request->district;
        try {
            $subdistrict->save();
        } catch (\Exception $e) {
            return redirect()->route('admin.subdistrict.edit', ['id' => $subdistrict->id])->with('error', 'ไม่สามารถแก้ไขตำบล "'.$subdistrict->name.'" ได้!!');
        }
        return redirect()->route('admin.subdistrict.edit', ['id' => $subdistrict->id])->with('status', 'แก้ไขตำบล "'.$subdistrict->name.'" เรียบร้อย!!');
    }

    //
    public function subdistrictDelete($id)
    {
        $subdistrict = Subdistrict::findOrFail($id);
        try {
            $subdistrict->delete();
        } catch (\Exception $e) {
            return redirect()->route('admin.subdistrict')->with('error', 'ตำบล "'.$subdistrict->name.'" มีการใช้งานอยู่ ไม่สามารถลบได้!!');
        }
        return redirect()->route('admin.subdistrict')->with('status', 'ลบตำบล "'.$subdistrict->name.'" เรียบร้อย!!');
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

    //
    private function getSubdistrict()
    {
        $subdistrict = Subdistrict::all();
        return $subdistrict;
    }
}
