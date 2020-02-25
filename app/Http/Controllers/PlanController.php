<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Auth;

use App\Plan;
use App\User;
use App\Shop;
use App\Office;

class PlanController extends Controller
{
    //
    public function planMain()
    {
        $plans = Plan::all()
        ->where('user_id', Auth::user()->id)
        ->where('status', '0');
        request()->start_plan ? dd(request()->start_plan) : null;
        return view('member.plan.main', [
            'count' => 1,
            'plans' => $plans
        ]);
    }

    //
    public function planCreate()
    {
        $offices = Office::all();
        $users = User::where('office_id', Auth::user()->office_id)->get();
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
        $users = User::where('office_id', Auth::user()->office_id)->get();
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
        $input['user_id'] = Auth::user()->id;
        $input['plan_start'] = date_format($startdate, "Y-m-d 00:00:00");
        $input['plan_end'] = date_format($enddate, "Y-m-d 23:59:59");
        $input['createby_user_id'] = Auth::user()->id;
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
        $plan->createby_user_id = Auth::user()->id;
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
