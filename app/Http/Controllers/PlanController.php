<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Plan;
use App\User;
use App\Shop;
use App\Office;

class PlanController extends Controller
{
    //
    public function planMain()
    {
        $start = request()->start_plan;
        $end = request()->end_plan;
        $status = request()->status_plan;
        $show = request()->show_plan;
        if($start && $end && $status && $show){
            $date_start = date_create($start);
            $date_end = date_create($end);
            $f_start = date_format($date_start,"Y-m-d 00:00:00");
            $f_end = date_format($date_end,"Y-m-d 23:59:59");
            switch ($status) {
                case 's1':
                    $q_status = ['0','1','2','3'];
                    break;

                case 's2':
                    $q_status = ['1'];
                    break;

                case 's3':
                    $q_status = ['0'];
                    break;

                case 's4':
                    $q_status = ['2'];
                    break;

                default:
                    $q_status = ['0','1','2','3'];
                    break;
            }
            if($show == 'd1'){
                $userid = User::where('office_id', auth()->user()->office_id)->get();
                $plans = Plan::whereIn('status', $q_status)
                ->whereBetween('plan_start', [$f_start, $f_end])
                ->whereIn('to_user_id', $userid)
                ->get();
            }elseif($show == 'd2'){
                $plans = Plan::where('to_user_id', auth()->user()->id)
                ->whereIn('status', $q_status)
                ->whereBetween('plan_start', [$f_start, $f_end])
                ->get();
            }
        }else{
            $plans = Plan::all()
            ->where('user_id', auth()->user()->id)
            ->where('status', '0');
        }
        return view('member.plan.main', [
            'count' => 1,
            'plans' => $plans
        ]);
    }

    //
    public function planCreate()
    {
        $offices = Office::all();
        $users = User::where('office_id', auth()->user()->office_id)->where('status', '1')->get();
        $shops = Shop::all();
        return view('member.plan.create', [
            'offices' => $offices,
            'users' => $users,
            'shops' => $shops
        ]);
    }

    //
    public function planEdit($id)
    {
        $plan = Plan::findOrFail($id);
        $offices = Office::all();
        $users = User::where('office_id', auth()->user()->office_id)->where('status', '1')->get();
        $shops = Shop::all();
        return view('member.plan.edit', [
            'plan' => $plan,
            'offices' => $offices,
            'users' => $users,
            'shops' => $shops
        ]);
    }

    //
    public function planStore(Request $request)
    {
        $startdate = date_create($request->plan_start);
        $enddate = date_create($request->plan_end);
        $input['user_id'] = auth()->user()->id;
        $input['plan_start'] = date_format($startdate, "Y-m-d 00:00:00");
        $input['plan_end'] = date_format($enddate, "Y-m-d 23:59:59");
        $input['createby_user_id'] = auth()->user()->id;
        $input['to_user_id'] = $request->user;
        $input['shop_id'] = $request->shop;
        $input['status'] = '0';
        try {
            $plan = Plan::create($input);
        } catch (\Exception $e) {
            // dd($e->getMessage());
            return redirect()->route('member.plan.create')->with('error', 'เกิดข้อผิดพลาด! ไม่สามารถเพิ่มแผนงานได้!!');
        }
        return redirect()->route('member.plan')->with('status', 'เพิ่มแผนงานเสร็จเรียบร้อย!!');

    }

    //
    public function planUpdate(Request $request, $id)
    {
        // dd($request->all());

        $startdate = date_create($request->plan_start);
        $enddate = date_create($request->plan_end);

        $plan = Plan::findOrFail($id);

        $plan->plan_start = date_format($startdate, "Y-m-d 00:00:00");
        $plan->plan_end = date_format($enddate, "Y-m-d 23:59:59");
        $plan->createby_user_id = auth()->user()->id;
        $plan->to_user_id = $request->user;
        $plan->shop_id = $request->shop;
        try {
            $plan->save();
        } catch (\Exception $e) {
            // dd($e->getMessage());
            return redirect()->route('member.plan.create')->with('error', 'เกิดข้อผิดพลาด! ไม่สามารถแก้ไขแผนงานได้!!');
        }
        return redirect()->route('member.plan')->with('status', 'แก้ไขแผนงานเสร็จเรียบร้อย!!');
    }

    //
    public function planDelete($id)
    {
        $plan = Plan::findOrFail($id);
        try {
            $plan->delete();
        } catch (\Exception $e) {
            // dd($e->getMessage());
            return redirect()->route('member.plan')->with('error', 'เกิดข้อผิดพลาด! ไม่สามารถลบแผนงานได้!!');
        }
        return redirect()->route('member.plan')->with('status', 'ลบแผนงานเสร็จเรียบร้อย!!');
    }
}
