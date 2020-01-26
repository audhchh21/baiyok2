<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class InspectionController extends Controller
{
    //
    public function inspectionAll()
    {
        return view('member.inspection.all');
    }

    //
    public function inspectionSuccessful()
    {
        return view('member.inspection.successful');
    }

    //
    public function inspectionSlowsuccessful()
    {
        return view('member.inspection.slowsuccessful');
    }

    //
    public function inspectionUnsuccessful()
    {
        return view('member.inspection.unsuccessful');
    }

}
