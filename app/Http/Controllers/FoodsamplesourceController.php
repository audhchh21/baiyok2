<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class FoodsamplesourceController extends Controller
{
    //
    public function foodsamplesourceMain()
    {
        return view('member.foodsamplesource.main');
    }

    //
    public function foodsamplesourceEdit()
    {
        return view('member.foodsamplesource.edit');
    }
}
