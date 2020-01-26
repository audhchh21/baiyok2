<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PlanController extends Controller
{
    //
    public function planMain()
    {
        return view('member.plan.main');
    }

    //
    public function planCreate()
    {
        return view('member.plan.create');
    }

    //
    public function planEdit()
    {
        return view('member.plan.edit');
    }
}
