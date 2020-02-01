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
    // function หน้าสร้างแผนงานใหม่
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
            'foodsamplesource' => $foodsamplesource,
            'foodtestkit' => $foodtestkit,
            'check' => $check
        ]);
    }

    // function หน้าแก้ไขแผนงาน
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
            'foodsamplesource' => $foodsamplesource,
            'foodtestkit' => $foodtestkit,
            'check' => $check
        ]);
    }

    // function บันทึกแผนงาน
    public function inspectiondetailConfirm(Request $request, $id)
    {
        $plan = Plan::findOrFail($id);
        try{
            $inspection = Inspection::create([
                'plan_id' => $plan->id,
                'date' => date('Y-m-d H:i:s'),
                'status' => '1'
            ]);
        } catch ( \Exception $e) {
            return redirect()->route('member.inspectiondetail.check', ['id' => $inspection->id])->with('error', 'เกิดข้อผิดพลาด!! ไม่สามารถบันทึกแผนงานได้!!');
        }
        $detail['foodsample'] = $request->foodsample;
        $detail['foodsamplesource'] = $request->foodsamplesource;
        $detail['foodtestkit'] = $request->foodtestkit;
        $detail['status'] = $request->status;
        $detail['detail'] = $request->detail;
        for($count = 0; $count < count($detail['foodsample']); $count++)
        {
            // แปลง statu
            $statusCheck = $detail['status'][$count];
            if($statusCheck == 's1'){
                $status = 1;
            }elseif($statusCheck == 's2'){
                $status = 2;
            }elseif($statusCheck == 's3'){
                $status = 3;
            }
            // อัพโหลดรูป
            try {
                $image = $request->file('uploadimage')[$count];
                $name = time().'_'.$image->getClientOriginalName();
                $fileImage = str_replace(' ', '_', $name);
                try {
                    $image->move(public_path('images/uploads'), $fileImage);
                } catch (\Exception $e) {
                    dd($e->getMessage());
                }

            } catch ( \Exception $e) {
                $fileImage = 'no-image.png';
            }
            // เพิ่มแผนงาน
            try {
                $inspectiondetail = Inspectiondetail::create([
                    'inspection_id' => $inspection->id,
                    'foodsample_id' => $detail['foodsample'][$count],
                    'foodsamplesource_id' => $detail['foodsamplesource'][$count],
                    'foodtestkit_id' => $detail['foodtestkit'][$count],
                    'inspection_result' => $status,
                    'actuation_after' => $detail['detail'][$count],
                    'inspection_image' => $fileImage,
                ]);
            } catch ( \Exception $e) {
                return redirect()->route('member.inspectiondetail.check', ['id' => $inspection->id])->with('error', 'เกิดข้อผิดพลาด!! ไม่สามารถบันทึกแผนงานได้!!');
            }
        }
        // ตรวจสอบวันที่บันทึกแผนงาน
        if($plan->plan_end > $inspection->date){
            $plan->status = '1';
        }else if($plan->start < $inspection->date){
            $plan->status = '2';
        }

        try{
            $plan->save();
        } catch ( \Exception $e) {
            return redirect()->route('member.inspectiondetail.check', ['id' => $inspection->id])->with('error', 'เกิดข้อผิดพลาด!! ไม่สามารถบันทึกแผนงานได้!!');
        }
        // บันทึกแผนงานสำเร็จ
        return redirect()->route('member.plan')->with('status', 'บันทึกแผนงานเรียบร้อย!!');
    }

    // function แก้ไขแผนงาน
    public function inspectiondetailUpdate(Request $request, $id)
    {
        dd($request->all());
    }


}
