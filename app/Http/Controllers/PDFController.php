<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Plan;
use App\Foodtestkit;
use App\Mapoffice;
use PDF;

class PDFController extends Controller
{
    //
    public function planAll()
    {
        $data = Plan::all();
        $pdf = \App::make('dompdf.wrapper');
        $pdf->getDomPDF()->set_option("enable_php", true);
        $pdf->loadView('pdf.member_plan_all', ['plans' => $data])->setPaper('a4', 'landscape');
        return $pdf->stream('ผลการตรวจสอบสารปนเปิ้อนทั้งหมด.pdf');
    }

    //
    public function planSuccess()
    {
        $data = Plan::all()->where('status', '1');
        $pdf = \App::make('dompdf.wrapper');
        $pdf->getDomPDF()->set_option("enable_php", true);
        $pdf->loadView('pdf.member_plan_success', ['plans' => $data])->setPaper('a4', 'landscape');
        return $pdf->stream('ผลการตรวจสอบสารปนเปิ้อนทั้งหมด.pdf');
    }

    //
    public function planSlowsuccess()
    {
        $data = Plan::all()->where('status', '2');
        $pdf = \App::make('dompdf.wrapper');
        $pdf->getDomPDF()->set_option("enable_php", true);
        $pdf->loadView('pdf.member_plan_slowsuccess', ['plans' => $data])->setPaper('a4', 'landscape');
        return $pdf->stream('ผลการตรวจสอบสารปนเปิ้อนทั้งหมด.pdf');
    }

    //
    public function planUnsuccess()
    {
        $data = Plan::all()->where('status', '0');
        $pdf = \App::make('dompdf.wrapper');
        $pdf->getDomPDF()->set_option("enable_php", true);
        $pdf->loadView('pdf.member_plan_unsuccess', ['plans' => $data])->setPaper('a4', 'landscape');
        return $pdf->stream('ผลการตรวจสอบสารปนเปิ้อนทั้งหมด.pdf');
    }

    //
    public function resultProvince()
    {
        $id = request()->province;
        // $dd = Mapoffice::whereIn('map_office', function($query) use ($id) {
        //     $query->select('province')
        //     ->from('offices')
        //     ->where('province', $id)
        //     ->get();
        // });
        // dd($dd);
        $data = Plan::all()->whereIn('status', ['1','2']);
        $testkit = Foodtestkit::all();
        $pdf = \App::make('dompdf.wrapper');
        $pdf->getDomPDF()->set_option("enable_php", true);
        $pdf->loadView('pdf.manager_inspectiondetail_province', ['plans' => $data, 'testkits' => $testkit])->setPaper('a4', 'landscape');
        return $pdf->stream('รายงานสรุปผลการตรวจสอบสารปนเปื้อนในอาหาร.pdf');
    }

    //
    public function resultDistrict()
    {
        $data = Plan::all()->whereIn('status', ['1','2']);
        $testkit = Foodtestkit::all();
        $pdf = \App::make('dompdf.wrapper');
        $pdf->getDomPDF()->set_option("enable_php", true);
        $pdf->loadView('pdf.manager_inspectiondetail_district', ['plans' => $data, 'testkits' => $testkit])->setPaper('a4', 'landscape');
        return $pdf->stream('รายงานสรุปผลการตรวจสอบสารปนเปื้อนในอาหาร.pdf');
    }
}
