<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\RequestShop;

use App\Shop;
use App\Titlename;
use App\Province;
use App\District;
use App\Subdistrict;

class ShopController extends Controller
{
    //
    public function shopMain()
    {
        $shop = Shop::all();
        return view('member.shop.main', [
            'count' => 1,
            'shops' => $shop
        ]);
    }

    //
    public function shopCreate()
    {
        $titlename = Titlename::pluck('name', 'id');
        $province = $this->getProvince()->pluck('name', 'id');
        $district = $this->getDistrict()->pluck('name', 'id');
        $subdistrict = $this->getSubdistrict()->pluck('name', 'id');
        $zipcode = $this->getSubdistrict()->pluck('zip_code', 'id')->groupBy('zip_code');
        return view('member.shop.create', [
            'titlenames' => $titlename,
            'provinces' => $province,
            'districts' => $district,
            'subdistricts' => $subdistrict,
            'zipcodes' => $zipcode
        ]);
    }

    //
    public function shopEdit($id)
    {
        $shop = Shop::findOrFail($id);
        $titlename = Titlename::pluck('name', 'id');
        $province = $this->getProvince()->pluck('name', 'id');
        $district = $this->getDistrict()->pluck('name', 'id');
        $subdistrict = $this->getSubdistrict()->pluck('name', 'id');
        $zipcode = $this->getSubdistrict()->pluck('zip_code', 'id')->groupBy('zip_code');
        return view('member.shop.edit', [
            'shop' => $shop,
            'titlenames' => $titlename,
            'provinces' => $province,
            'districts' => $district,
            'subdistricts' => $subdistrict,
            'zipcodes' => $zipcode
        ]);
    }

    //
    public function shopStore(RequestShop $request)
    {
        // dd($request->all());
        $input['name'] = str_replace(' ', '', $request->name);
        $input['titlename_id'] = $request->titlename;
        $input['f_name'] = $request->f_name;
        $input['l_name'] = $request->l_name;
        $input['tel'] = $request->tel;
        $input['place'] = $request->place;
        $input['address'] = $request->address;
        $input['province'] = $request->province;
        $input['district'] = $request->district;
        $input['subdistrict'] = $request->subdistrict;
        try {
            $shop = Shop::create($input);
        } catch (\Exception $th) {
            return redirect()->route('member.shop.create')->with('error', 'เพิ่มร้านค้า "'.$shop->name.'" ไม่ได้!!');
        }
        return redirect()->route('member.shop.create')->with('status', 'เพิ่มร้านค้า "'.$shop->name.'" เรียบร้อย!!');
    }

    //
    public function shopUpdate(RequestShop $request, $id)
    {
        // dd($request->all());
        $shop = Shop::findOrFail($id);
        $shop->name = str_replace(' ', '', $request->name);
        $shop->titlename_id = $request->titlename;
        $shop->f_name = $request->f_name;
        $shop->l_name = $request->l_name;
        $shop->tel= $request->tel;
        $shop->place = $request->place;
        $shop->address = $request->address;
        $shop->province = $request->province;
        $shop->district = $request->district;
        $shop->subdistrict = $request->subdistrict;
        try {
            $shop->save();
        } catch (\Exception $th) {
            return redirect()->route('member.shop.edit', ['id' => $shop->id])->with('error', 'ไม่สามารถแก้ไขร้านค้า"'.$shop->name.'"ได้!!');
        }
        return redirect()->route('member.shop.edit', ['id' => $shop->id])->with('status', 'แก้ไขร้านค้า "'.$shop->name.'" เรียบร้อย!!');
    }

    //
    public function shopDelete($id)
    {
        $shop = Shop::findOrFail($id);
        try {
            $shop->delete();
        } catch (\Exception $th) {
            return redirect()->route('member.shop')->with('error', 'ร้านค้า "'.$shop->name.'" มีการใช้งานอยู่ไม่สามารถลบได้');
        }
        return redirect()->route('member.shop')->with('status', 'ลบร้านค้า "'.$shop->name.'" เรียบร้อย!!');
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
