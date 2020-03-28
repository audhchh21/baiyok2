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
    public function plan()
    {
        $plans = Plan::whereIn('user_id', function($query) {
            $query->select('id')
            ->from('users')
            ->where('office_id', auth()->user()->office_id)
            ->get();
        })
        ->get();

        $pdf = PDF::loadView('pdf.member_plan', compact('plans'));
        $pdf->getDomPDF()->set_option("enable_php", true);
        $pdf->setPaper('a4', 'landscape');
        return $pdf->stream('รายงานสรุปผลสารปนเปิ้อนในอาหาร.pdf');

    }

    //
    public function planAll()
    {
        $plans = Mapoffice::where('map_office', auth()->user()->office_id)->get();
        $testkits = Foodtestkit::all();

        $pdf = PDF::loadView('pdf.member_plan_all', compact('plans', 'testkits'));
        $pdf->getDomPDF()->set_option("enable_php", true);
        $pdf->setPaper('a4', 'landscape');
        return $pdf->stream('รายงานสรุปผลสารปนเปิ้อนในอาหาร.pdf');
    }

    //
    public function planSuccess()
    {
        $plans = Mapoffice::where('map_office', auth()->user()->office_id)
        ->get();
        $testkits = Foodtestkit::all();

        $pdf = PDF::loadView('pdf.member_plan_success', compact('plans', 'testkits'));
        $pdf->getDomPDF()->set_option("enable_php", true);
        $pdf->setPaper('a4', 'landscape');
        return $pdf->stream('รายงานสรุปผลสารปนเปิ้อนในอาหาร.pdf');
    }

    //
    public function planSlowsuccess()
    {
        $plans = Mapoffice::where('map_office', auth()->user()->office_id)->get();
        $testkits = Foodtestkit::all();

        $pdf = PDF::loadView('pdf.member_plan_slowsuccess', compact('plans', 'testkits'));
        $pdf->getDomPDF()->set_option("enable_php", true);
        $pdf->setPaper('a4', 'landscape');
        return $pdf->stream('รายงานสรุปผลสารปนเปิ้อนในอาหาร.pdf');
    }

    //
    public function planUnsuccess()
    {
        $plans = Mapoffice::where('map_office', auth()->user()->office_id)->get();
        $testkits = Foodtestkit::all();

        $pdf = PDF::loadView('pdf.member_plan_unsuccess', compact('plans', 'testkits'));
        $pdf->getDomPDF()->set_option("enable_php", true);
        $pdf->setPaper('a4', 'landscape');
        return $pdf->stream('รายงานสรุปผลสารปนเปิ้อนในอาหาร.pdf');
    }

    //
    public function resultProvince()
    {
        $plans = Mapoffice::where('map_office', auth()->user()->office_id)->get();
        $testkits = Foodtestkit::all();

        $pdf = PDF::loadView('pdf.manager_inspectiondetail_province', compact('plans', 'testkits'));
        $pdf->getDomPDF()->set_option("enable_php", true);
        $pdf->setPaper('a4', 'landscape');
        return $pdf->stream('รายงานตรวจสอบสารปนเปื้อนในระดับจังหวัด.pdf');
    }

    //
    public function resultDistrict()
    {
        $plans = Mapoffice::where('map_office', auth()->user()->office_id)->get();
        $testkits = Foodtestkit::all();

        $pdf = PDF::loadView('pdf.member_plan', compact('plans', 'testkits'));
        $pdf->getDomPDF()->set_option("enable_php", true);
        $pdf->setPaper('a4', 'landscape');
        return $pdf->stream('รายงานตรวจสอบสารปนเปื้อนในระดับอำเภอ.pdf');
    }
}
