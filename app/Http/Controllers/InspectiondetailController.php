<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class InspectiondetailController extends Controller
{
    //
    public function inspectiondetailCreate()
    {

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
