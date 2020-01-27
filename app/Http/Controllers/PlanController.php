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
        $plans = Plan::all();
        return view('member.plan.main', [
            'count' => 1,
            'plans' => $plans
        ]);
    }

    //
    public function planCreate()
    {
        $offices = Office::all();
        $users = User::all();
        $shops = Shop::all();
        return view('member.plan.create', [
            'offices' => $offices,
            'users' => $users,
            'shops' => $shops
        ]);
    }

    //
    public function planEdit()
    {
        return view('member.plan.edit');
    }

    //
    public function planStore(Request $request)
    {
        dd($request->all());
    }

    //
    public function planUpdate(Request $request, $id)
    {
        dd($request->all());
    }

    //
    public function planDelete($id)
    {
        dd($request->all());
    }
}
