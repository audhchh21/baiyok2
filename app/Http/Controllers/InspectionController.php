<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use App\Plan;
use App\Inspection;
use App\inspectiondetail;
use App\Foodsample;
use App\Foodsamplesource;
use App\Foodtestkit;
use App\User;

use Auth;

class InspectionController extends Controller
{
    //
    public function office_ids($output = [])
    {
        $userid = User::where('office_id', auth()->user()->office_id)
        ->get();
        foreach($userid as $item)
        {
            $output = Arr::prepend($output, $item->id);
        }
        return $output;
    }
    //
    public function inspectionAll()
    {
        $plan = Plan::whereIn('user_id', $this->office_ids())
        ->orderBy('created_at', 'desc')
        ->get();
        return view('member.inspection.all', [
            'count' => 1,
            'plans' => $plan
        ]);
    }

    //
    public function inspectionSuccessful()
    {
        $plan = Plan::where('status', '1')
        ->whereIn('user_id', $this->office_ids())
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
        ->whereIn('user_id', $this->office_ids())
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
        ->whereIn('user_id', $this->office_ids())
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
