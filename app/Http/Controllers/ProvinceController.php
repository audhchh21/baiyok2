<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\RequestProvince;

use App\Province;
use App\Subdistrict;

class ProvinceController extends Controller
{
    //
    public function all()
    {
        $city = Subdistrict::all();
        return view('admin.city.city', [
            'citys' => $city
        ]);
    }

    //
    public function provinceMain()
    {
        $provinces = $this->getProvince();
        return view('admin.city.province.main', [
            'count' => 1,
            'provinces' => $provinces
        ]);
    }

    //
    public function provinceEdit($id)
    {
        $province = $this->getProvince()->find($id);
        return view('admin.city.province.edit', [
            'province' => $province
        ]);
    }

    //
    public function provinceStore(RequestProvince $request)
    {
        $input['name'] = str_replace(' ', '', $request->name);

        try {
            $province = Province::create($input);
        } catch (\Exception $e) {
            return redirect()->route('admin.province')->with('error', 'จังหวัด "'.$input['name'].'" มีอยู่แล้ว!!');
        }
        return redirect()->route('admin.district')->with('status', 'เพิ่มจังหวัด "'.$province->name.'" สำเสร็จ!!')->with('province', $province->id);
    }

    //
    public function provinceUpdate(RequestProvince $request, $id)
    {
        $province = Province::findOrFail($id);
        $def_title = $province->name;
        $province->name = str_replace(' ', '', $request->name);
        try {
            $province->save();
        } catch (\Exception $e) {
            return redirect()->route('admin.province.edit', ['id' => $province->id])->with('error', 'จังหวัด "'.$province->name.'" มีอยู่แล้ว!!');
        }
        return redirect()->route('admin.province.edit', ['id' => $province->id])->with('status', 'แก้ไขจังหวัด "'.$def_title.'" เป็น "'.$province->name.'" เรียบร้อย!!');
    }

    //
    public function provinceDelete($id)
    {
        $province = Province::findOrFail($id);
        try {
            $province->delete();
        } catch (\Exception $e) {
            return redirect()->route('admin.province')->with('error', 'จังหวัด "'.$province->name.'" ถูกใช้งานอยู่ไม่สามารถลบได้!!');
        }
        return redirect()->route('admin.province')->with('status', 'ลบจังหวัด "'.$province->name.'" เรียบร้อย!!');
    }

    //
    private function getProvince()
    {
        $province = Province::all();
        return $province;
    }
}
