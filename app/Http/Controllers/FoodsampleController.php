<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class FoodsampleController extends Controller
{
    //
    public function foodsampleMain()
    {
        return view('member.foodsample.main');
    }

    //
    public function foodsampleEdit()
    {
        return view('member.foodsample.edit');
    }
}
