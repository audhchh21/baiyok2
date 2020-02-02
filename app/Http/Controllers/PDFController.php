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
        // $pdf = PDF::loadView('pdf.member_plan', ['plans' => $data])
        // ->setPaper('a4', 'landscape');
        $pdf = \App::make('dompdf.wrapper');
        /* Careful: use "enable_php" option only with local html & script tags you control.
        used with remote html or scripts is a major security problem (remote php injection) */
        $pdf->getDomPDF()->set_option("enable_php", true);
        $pdf->loadView('pdf.member_plan', ['plans' => $data])->setPaper('a4', 'landscape');;
        return $pdf->stream('ผลการตรวจสอบสารปนเปิ้อนทั้งหมด.pdf');
    }
}
