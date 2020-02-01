<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Plan;
use PDF;

class PDFController extends Controller
{
    //
    public function planAll()
    {
        $data = Plan::all();
        $pdf = PDF::loadView('pdf.member_plan', ['plans' => $data]);
        return @$pdf->stream('invoice.pdf');
    }
}
