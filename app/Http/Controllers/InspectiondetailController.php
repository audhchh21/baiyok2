<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Plan;

class InspectiondetailController extends Controller
{
    //
    public function inspectiondetailCheck($id)
    {
        $plan = Plan::findOrFail($id);
        return view('member.inspectiondetail.check', [
            'plan'=>$plan
        ]);
    }

    //
    public function inspectiondetailEdit()
    {

    }

    //
    public function inspectiondetailConfirm(Request $request)
    {
        dd($request->all());
    }

    //
    public function inspectiondetailUpdate(Request $request, $id)
    {
        dd($request->all());
    }
}
