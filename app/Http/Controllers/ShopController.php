<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ShopController extends Controller
{
    //
    public function shopMain()
    {
        return view('member.shop.main');
    }

    //
    public function shopCreate()
    {
        return view('member.shop.create');
    }

    //
    public function shopEdit()
    {
        return view('member.shop.edit');
    }
}
