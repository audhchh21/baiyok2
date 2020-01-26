<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class FoodtestkitController extends Controller
{
    //
    public function foodtestkitMain()
    {
        return view('member.foodtestkit.main');
    }

    //
    public function foodtestkitEdit()
    {
        return view('member.foodtestkit.edit');
    }
}
