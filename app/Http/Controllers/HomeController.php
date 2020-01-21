<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function adminDashboard()
    {
        return view('admin.dashboard');
    }

    public function mannagerDashboard()
    {
        return view('manager.dashboard');
    }

    public function memberDashboard()
    {
        return view('member.dashboard');
    }
}
