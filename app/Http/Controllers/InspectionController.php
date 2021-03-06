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
        $userid = User::where('office_id', auth()->user()->office_id)->get();
        foreach($userid as $item){
            $output = Arr::prepend($output, $item->id);
        }
        return $output;
    }

    //
    public function inspectionAll()
    {
        $start = request()->start_plan;
        $end = request()->end_plan;
        $show = request()->show_plan;
        if($start && $end && $show){
            $date_start = date_create($start);
            $date_end = date_create($end);
            $f_start = date_format($date_start,"Y-m-d 00:00:00");
            $f_end = date_format($date_end,"Y-m-d 23:59:59");
            if($show == 'd1'){
                $plan = Plan::whereBetween('plan_start', [$f_start, $f_end])
                ->whereIn('to_user_id', $this->office_ids())
                ->get();
            }elseif($show == 'd2'){
                $plan = Plan::where('to_user_id', auth()->user()->id)
                ->whereBetween('plan_start', [$f_start, $f_end])
                ->get();
            }
        }else{
            $plan = Plan::whereIn('user_id', $this->office_ids())
            ->orderBy('created_at', 'desc')
            ->get();
        }

        return view('member.inspection.all', [
            'count' => 1,
            'plans' => $plan
        ]);
    }

    //
    public function inspectionSuccessful()
    {
        $start = request()->start_plan;
        $end = request()->end_plan;
        $show = request()->show_plan;
        if($start && $end && $show){
            $date_start = date_create($start);
            $date_end = date_create($end);
            $f_start = date_format($date_start,"Y-m-d 00:00:00");
            $f_end = date_format($date_end,"Y-m-d 23:59:59");
            if($show == 'd1'){
                $plan = Plan::whereBetween('plan_start', [$f_start, $f_end])
                ->where('status', '1')
                ->whereIn('user_id', $this->office_ids())
                ->orderBy('created_at', 'desc')
                ->get();
            }elseif($show == 'd2'){
                $plan = Plan::whereBetween('plan_start', [$f_start, $f_end])
                ->where('status', '1')
                ->whereIn('user_id', $this->office_ids())
                ->orderBy('created_at', 'desc')
                ->get();
            }
        }else{
            $plan = Plan::where('status', '1')
            ->whereIn('user_id', $this->office_ids())
            ->orderBy('created_at', 'desc')
            ->get();
        }

        return view('member.inspection.successful', [
            'count' => 1,
            'plans' => $plan
        ]);
    }

    //
    public function inspectionSlowsuccessful()
    {
        $start = request()->start_plan;
        $end = request()->end_plan;
        $show = request()->show_plan;
        if($start && $end && $show){
            $date_start = date_create($start);
            $date_end = date_create($end);
            $f_start = date_format($date_start,"Y-m-d 00:00:00");
            $f_end = date_format($date_end,"Y-m-d 23:59:59");
            if($show == 'd1'){
                $plan = Plan::whereBetween('plan_start', [$f_start, $f_end])
                ->where('status', '2')
                ->whereIn('user_id', $this->office_ids())
                ->orderBy('created_at', 'desc')
                ->get();
            }elseif($show == 'd2'){
                $plan = Plan::whereBetween('plan_start', [$f_start, $f_end])
                ->where('status', '2')
                ->whereIn('user_id', $this->office_ids())
                ->orderBy('created_at', 'desc')
                ->get();
            }
        }else{
            $plan = Plan::where('status', '2')
            ->whereIn('user_id', $this->office_ids())
            ->orderBy('created_at', 'desc')
            ->get();
        }
        return view('member.inspection.slowsuccessful', [
            'count' => 1,
            'plans' => $plan
        ]);
    }

    //
    public function inspectionUnsuccessful()
    {
        $start = request()->start_plan;
        $end = request()->end_plan;
        $show = request()->show_plan;
        if($start && $end && $show){
            $date_start = date_create($start);
            $date_end = date_create($end);
            $f_start = date_format($date_start,"Y-m-d 00:00:00");
            $f_end = date_format($date_end,"Y-m-d 23:59:59");
            if($show == 'd1'){
                $plan = Plan::whereBetween('plan_start', [$f_start, $f_end])
                ->where('status', '0')
                ->whereIn('user_id', $this->office_ids())
                ->orderBy('created_at', 'desc')
                ->get();
            }elseif($show == 'd2'){
                $plan = Plan::whereBetween('plan_start', [$f_start, $f_end])
                ->where('status', '0')
                ->whereIn('user_id', $this->office_ids())
                ->orderBy('created_at', 'desc')
                ->get();
            }
        }else{
            $plan = Plan::where('status', '0')
            ->whereIn('user_id', $this->office_ids())
            ->orderBy('created_at', 'desc')
            ->get();
        }
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
