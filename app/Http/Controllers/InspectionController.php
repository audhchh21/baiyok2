<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Plan;
use App\Inspection;
use App\inspectiondetail;
use App\Foodsample;
use App\Foodsamplesource;
use App\Foodtestkit;

class InspectionController extends Controller
{
    //
    public function inspectionAll()
    {
        $plan = Plan::orderBy('created_at', 'desc')->get();
        return view('member.inspection.all', [
            'count' => 1,
            'plans' => $plan
        ]);
    }

    //
    public function inspectionSuccessful()
    {
        $plan = Plan::where('status', '1')
        ->orderBy('created_at', 'desc')
        ->get();
        return view('member.inspection.successful', [
            'count' => 1,
            'plans' => $plan
        ]);
    }

    //
    public function inspectionSlowsuccessful()
    {
        $plan = Plan::where('status', '2')
        ->orderBy('created_at', 'desc')
        ->get();
        return view('member.inspection.slowsuccessful', [
            'count' => 1,
            'plans' => $plan
        ]);
    }

    //
    public function inspectionUnsuccessful()
    {
        $plan = Plan::where('status', '0')
        ->orderBy('created_at', 'desc')
        ->get();
        return view('member.inspection.unsuccessful', [
            'count' => 1,
            'plans' => $plan
        ]);
    }

    //
    public function inspectionDetail($id)
    {
        $inspection = Inspection::findOrFail($id);
        return view('member.inspection.detail', [
            'inspection' => $inspection
        ]);
    }

    //
    public function inspectionEdit($id)
    {
        $inspection = Inspection::findOrFail($id);
        $foodsample = Foodsample::pluck('name', 'id');
        $foodsamplesource = Foodsamplesource::pluck('name', 'id');
        $foodtestkit = Foodtestkit::pluck('name', 'id');
        $check = [
            's1' => 'ไม่พบ',
            's2' => 'พบปลอดภัย',
            's3' => 'พบไม่ปลอดภัย',
        ];
        return view('member.inspection.edit', [
            'inspection' => $inspection,
            'foodsample' => $foodsample,
            'foodsamplesource' => $foodsamplesource,
            'foodtestkit' => $foodtestkit,
            'check' => $check
        ]);
    }

    //
    public function inspectionDelete($id)
    {
        $plan = Plan::findOrFail($id);
        try {
            $plan->delete();
        } catch (\Exception $e) {
            // dd($e->getMessage());
            return redirect()->route('member.inspection')->with('error', 'เกิดข้อผิดพลาด! ไม่สามารถลบแผนงานได้!!');
        }
        return redirect()->route('member.inspection')->with('status', 'ลบแผนงานเสร็จเรียบร้อย!!');
    }
}
