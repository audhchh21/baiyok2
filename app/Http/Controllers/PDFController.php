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
        $pdf = \App::make('dompdf.wrapper');
        $pdf->getDomPDF()->set_option("enable_php", true);
        $pdf->loadView('pdf.member_plan_all', ['plans' => $data])->setPaper('a4', 'landscape');;
        return $pdf->stream('ผลการตรวจสอบสารปนเปิ้อนทั้งหมด.pdf');
    }

    //
    public function planSuccess()
    {
        $data = Plan::all()->where('status', '1');
        $pdf = \App::make('dompdf.wrapper');
        $pdf->getDomPDF()->set_option("enable_php", true);
        $pdf->loadView('pdf.member_plan_success', ['plans' => $data])->setPaper('a4', 'landscape');;
        return $pdf->stream('ผลการตรวจสอบสารปนเปิ้อนทั้งหมด.pdf');
    }

    //
    public function planSlowsuccess()
    {
        $data = Plan::all()->where('status', '2');
        $pdf = \App::make('dompdf.wrapper');
        $pdf->getDomPDF()->set_option("enable_php", true);
        $pdf->loadView('pdf.member_plan_slowsuccess', ['plans' => $data])->setPaper('a4', 'landscape');;
        return $pdf->stream('ผลการตรวจสอบสารปนเปิ้อนทั้งหมด.pdf');
    }

    //
    public function planUnsuccess()
    {
        $data = Plan::all()->where('status', '0');
        $pdf = \App::make('dompdf.wrapper');
        $pdf->getDomPDF()->set_option("enable_php", true);
        $pdf->loadView('pdf.member_plan_unsuccess', ['plans' => $data])->setPaper('a4', 'landscape');;
        return $pdf->stream('ผลการตรวจสอบสารปนเปิ้อนทั้งหมด.pdf');
    }

    //
    public function resultProvince()
    {
        $data = Plan::all()->where('status', '0');
        $pdf = \App::make('dompdf.wrapper');
        $pdf->getDomPDF()->set_option("enable_php", true);
        $pdf->loadView('pdf.member_plan_unsuccess', ['plans' => $data])->setPaper('a4', 'landscape');;
        return $pdf->stream('รายงานสรุปผลการตรวจสอบสารปนเปื้อนในอาหาร.pdf');
    }

    //
    public function resultDistrict()
    {
        $data = Plan::all()->where('status', '0');
        $pdf = \App::make('dompdf.wrapper');
        $pdf->getDomPDF()->set_option("enable_php", true);
        $pdf->loadView('pdf.member_plan_unsuccess', ['plans' => $data])->setPaper('a4', 'landscape');;
        return $pdf->stream('รายงานสรุปผลการตรวจสอบสารปนเปื้อนในอาหาร.pdf');
    }
}
