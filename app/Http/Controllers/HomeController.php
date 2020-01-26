<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Arr;

use App\User;
use App\Office;

class HomeController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function adminDashboard()
    {
        $user_count = $this->getUser()->count();
        $user_status_0_count = $this->getUser()->where('status', '0')->count();
        $user_status_2_count = $this->getUser()->where('status', '2')->count();
        $userstatus = $this->getUser()->where('status', '0');
        $office_count = Office::count();
        $office_ten = Office::paginate(10);
        return view('admin.dashboard', [
            'user_count' => $user_count,
            'office_count' => $office_count,
            'user_status_0_count' => $user_status_0_count,
            'user_status_2_count' => $user_status_2_count,
            'userstatus' => $userstatus,
            'offices_ten' => $office_ten,
            'pieUser' => $this->piechartUser()
        ]);
    }

    public function userSuccess(Request $request)
    {
        $user = User::findOrFail($request->id);
        $user->status = '1';
        try {
            $user->save();
        } catch (\Exception $e) {
            return redirect()->route('admin.dashboard')->with('error', 'เกิดข้อผิดพลาดไม่สามารถ "อนุมัติสิทธิ์" ผู้ใช้งานได้!!');
        }
        return redirect()->route('admin.dashboard')->with('status', '"อนุมัติสิทธิ์" ผู้ใช้งานเรียบร้อย!!');
    }

    public function userUnsuccess(Request $request)
    {
        $user = User::findOrFail($request->id);
        $user->status = '2';
        try {
            $user->save();
        } catch (\Exception $e) {
            return redirect()->route('admin.dashboard')->with('error', 'เกิดข้อผิดพลาดไม่สามารถ "ยกเลิกอนุมัติสิทธิ์" ผู้ใช้งานได้!!');
        }
        return redirect()->route('admin.dashboard')->with('status', '"ยกเลิกอนุมัติสิทธิ์" ผู้ใช้งานเรียบร้อย!!');
    }

    private function piechartUser()
    {
        $lable = User::all()->groupBy('type');
        $chartjs = app()->chartjs
        ->name('pieChartUser')
        ->type('pie')
        ->size(['width' => 99, 'height' => 99])
        ->labels(['ผู้ดูแลระบบ', 'ผู้บริหาร', 'เจ้าหน้าที่'])
        ->datasets([
            [
                'backgroundColor' => ['#FF6384', '#36A2EB'],
                'hoverBackgroundColor' => ['#FF6384', '#36A2EB'],
                'data' => [$lable['Admin']->count(), $lable['Manager']->count(), $lable['User']->count()]
            ]
        ])
        ->options([]);

        return $chartjs;
    }

    public function managerDashboard()
    {
        return view('manager.dashboard');
    }

    public function memberDashboard()
    {
        return view('member.dashboard');
    }

    private function getUser()
    {
        return User::all();
    }


}
