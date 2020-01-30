<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Plan;
use App\Inspection;
use App\inspectiondetail;
use App\Foodsample;
use App\Foodsamplesource;
use App\Foodtestkit;

class InspectiondetailController extends Controller
{
    //
    public function inspectiondetailCheck($id)
    {
        $plan = Plan::findOrFail($id);
        $foodsample = Foodsample::pluck('name', 'id');
        $foodsamplesource = Foodsamplesource::pluck('name', 'id');
        $foodtestkit = Foodtestkit::pluck('name', 'id');
        $check = [
            's1' => 'ไม่พบ',
            's2' => 'พบปลอดภัย',
            's3' => 'พบไม่ปลอดภัย',
        ];
        return view('member.inspectiondetail.check', [
            'plan'=>$plan,
            'foodsample' => $foodsample,
            'foodsamplesoure' => $foodsamplesource,
            'foodtestkit' => $foodtestkit,
            'check' => $check
        ]);
    }

    //
    public function inspectiondetailEdit($id)
    {
        $plan = Plan::findOrFail($id);
        $foodsample = Foodsample::pluck('name', 'id');
        $foodsamplesource = Foodsamplesource::pluck('name', 'id');
        $foodtestkit = Foodtestkit::pluck('name', 'id');
        $check = [
            's1' => 'ไม่พบ',
            's2' => 'พบปลอดภัย',
            's3' => 'พบไม่ปลอดภัย',
        ];
        return view('member.inspectiondetail.check', [
            'plan'=>$plan,
            'foodsample' => $foodsample,
            'foodsamplesoure' => $foodsamplesource,
            'foodtestkit' => $foodtestkit,
            'check' => $check
        ]);
    }

    //
    public function inspectiondetailConfirm(Request $request, $id)
    {
        // dd($request->all());
        $plan = Plan::findOrFail($id);
        $plan['plan_id'] = $plan->id;
        $plan['date'] = now();
        $plan['status'] = '1';

        try{
            $inspection = Inspection::cerate($plan);
        } catch ( \Exception $e) {
            dd($e->getMessage());
            return redirect()->route('')->with('error', 'เกิดข้อผิดพลาด!! ไม่สามารถบันทึกแผนงานได้!!');
            exit();
        }
        
        $detail['foodsample'] = $request->foodsample;
        $detail['foodsamplesource'] = $request->foodsamplesource;
        $detail['foodtestkit'] = $request->foodtestkit;
        $detail['status'] = $request->status;
        $detail['detail'] = $request->detail;
        $detail['image'] = $request->uploadimage;

        for($count = 0; $count < count(); $count++)
        {
            $inspectiondetail['inspection_id'] = $inspection->id;
            $inspectiondetail['foodsample_id'] = $detail['foodsample'][$count];
            $inspectiondetail['foodsamplesource_id'] = $detail['foodsamplesource'][$count];
            $inspectiondetail['foodtestkit_id'] = $detail['foodtestkit'][$count];
            $inspectiondetail['inspection_result'] = $detail['status'][$count];
            $inspectiondetail['actuation_after'] = $detail['detail'][$count];
            $inspectiondetail['inspection_image'] = $detail['image'][$count];
            try{
                $inspectiondetail = Inspectiondetail::create($inspectiondetail);
            } catch ( \Exception $e) {
                dd($e->getMessage());
                return redirect()->route('')->with('error', 'เกิดข้อผิดพลาด!! ไม่สามารถบันทึกแผนงานได้!!');
                exit();
            }
        }

        // check date 
        if($plan->plan_end > $plan['date'])
        {
            $plan->status = '1';
        }
        else if($plan->start < $plan['date'])
        {
            $plan->status = '2';
        }

        try{
            $plan->save();
        } catch ( \Exception $e) {
            // dd($e->getMessage());
            return redirect()->route('')->with('error', 'เกิดข้อผิดพลาด!! ไม่สามารถบันทึกแผนงานได้!!');
        }
        return redirect()->route('')->with('status', 'บันทึกแผนงานเรียบร้อย!!');
        
    }

    //
    public function inspectiondetailUpdate(Request $request, $id)
    {
        dd($request->all());   
    }

    //
    private function uploadImage($file, $path)
    {
        $input['file'] = $file;
        $input['path'] = $path;
        return response()->json($input, 200);
    }
}
