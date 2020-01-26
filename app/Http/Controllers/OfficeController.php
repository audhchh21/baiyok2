<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\RequestOffice;

use App\Office;
use App\Province;
use App\District;
use App\Subdistrict;

class OfficeController extends Controller
{
    //
    public function officeMain()
    {
        $offices = $this->getOffice();
        return view('admin.office.main', [
            'count' => 1,
            'offices' => $offices
        ]);
    }

    //
    public function officeCreate()
    {
        $province = $this->getProvince()->pluck('name', 'id');
        $district = $this->getDistrict()->pluck('name', 'id');
        $subdistrict = $this->getSubdistrict()->pluck('name', 'id');
        $zipcode = $this->getSubdistrict()->pluck('zip_code', 'id')->groupBy('zip_code');
        return view('admin.office.create', [
            'provinces' => $province,
            'districts' => $district,
            'subdistricts' => $subdistrict,
            'zipcodes' => $zipcode
        ]);
    }

    //
    public function officeEdit($id)
    {
        $office = $this->getOffice()->find($id);
        $province = $this->getProvince()->pluck('name', 'id');
        $district = $this->getDistrict()->pluck('name', 'id');
        $subdistrict = $this->getSubdistrict()->pluck('name', 'id');
        $zipcode = $this->getSubdistrict()->pluck('zip_code', 'id');
        return view('admin.office.edit', [
            'office' => $office,
            'provinces' => $province,
            'districts' => $district,
            'subdistricts' => $subdistrict,
            'zipcodes' => $zipcode
        ]);
    }

    //
    public function officeStore(RequestOffice $request)
    {
        $input['name'] = $request->name;
        $input['address'] = $request->address;
        $input['province'] = $request->province;
        $input['district'] = $request->district;
        $input['subdistrict'] = $request->subdistrict;

        try {
            $office = Office::create($input);
        } catch (\Exception $e) {
            return redirect()->route('admin.office.create')->with('error', 'หน่วยงาน "'.$input['name'].'" มีอยู่แล้ว ไม่สามารถเพิ่มหน่วยงานได้!!');
        }
        return redirect()->route('admin.office.create')->with('status', 'เพิ่มหน่วยงาน "'.$input['name'].'" เรียบร้อย!!');
    }

    //
    public function officeUpdate(RequestOffice $request, $id)
    {
        $office = Office::findOrFail($id);
        $office->name = $request->name;
        $office->address = $request->address;
        $office->province = $request->province;
        $office->district = $request->district;
        $office->subdistrict = $request->subdistrict;
        try {
            $office->save();
        } catch (\Exception $e) {
            return redirect()->route('admin.office.edit', ['id' => $office->id])->with('error', 'ไม่สามารถแก้ไขชื่อหน่วยงานซ้ำกันได้!!');
        }
        return redirect()->route('admin.office.edit', ['id' => $office->id])->with('status', 'แก้ไขหน่วยงาน "'.$office->name.'" เรียบร้อย!!');
    }

    //
    public function officeDelete($id)
    {
        $office = Office::findOrFail($id);
        try {
            $office->delete();
        } catch (\Exception $e) {
            return redirect()->route('admin.office')->with('error', 'หน่วยงาน "'.$office->name.'" ถูกใช้งานอยู่ ไม่สามารถลบหน่วยงานได้!!');
        }
        return redirect()->route('admin.office')->with('status', 'ลบหน่วยงาน "'.$office->name.'" เรียบร้อย!!');
    }

    //
    private function getOffice()
    {
        $office = Office::all();
        return $office;
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
