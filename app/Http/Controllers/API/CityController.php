<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Province;
use App\District;
use App\Subdistrict;

class CityController extends Controller
{
    // Province API จังหวัด
    public function getProvince()
    {
        $id = request()->id;
        if($id != null){
            $province = Province::findOrFail($id);
        }else{
            $province = Province::all();
        }
        return $this->responseSuccess($province);
    }

    // District API อำเภอ
    public function getDistrict()
    {
        $id = request()->id;
        if($id != null){
            $district = District::where('province_id',$id)->get();
        }else{
            $district = District::all();
        }
        return $this->responseSuccess($district);
    }

    // Subdistrict API ตำบล
    public function getSubdistrict()
    {
        $id = request()->id;
        if($id != null){
            $subdistrict = Subdistrict::where('district_id',$id)->get();
        }else{
            $subdistrict = Subdistrict::all();
        }
        return $this->responseSuccess($subdistrict);
    }

    // response Success
    private function responseSuccess($res)
    {
        return response()->json(["status" => "success", "data" => $res], 200)
            ->header("Access-Control-Allow-Origin", "*")
            ->header("Access-Control-Allow-Methods", "GET, POST, PUT, DELETE, OPTIONS")
            ->header('Content-Type', 'application/json');
    }
}
