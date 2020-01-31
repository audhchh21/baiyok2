<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Inspection;
use App\Plan;
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
        dd($inspection);
        return view('member.inspection.detail', [
            'inspection' => $inspection
        ]);
    }

    //
    public function inspectionEdit($id)
    {
        $inspection = Inspection::findOrFail($id);
        dd($inspection);
        return view('member.inspection.edit', [
            'inspection' => $inspection
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
