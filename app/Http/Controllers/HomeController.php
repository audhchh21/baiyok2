<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Arr;

use Auth;

use App\User;
use App\Plan;
use App\Office;
use App\Foodsample;
use App\Foodsamplesource;
use App\Foodtestkit;
use App\Inspectiondetail;

class HomeController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    // ADMIN

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

    // MANAGER

    public function managerDashboard()
    {
        $user = Auth::user();
        $plans = Plan::all();

        $ymd = date('Y-m-d');
        $date_start = date("Y-m-d", strtotime("first day of this month"));
        $date_end = date("Y-m-d", strtotime("last day of this month"));
        $dayend = date('t',strtotime('today'));
        for($day_start = 1; $day_start <= $dayend; $day_start++){
            $lable[$day_start-1] = 'วันที่ '.$day_start;
            if($date_start <= $ymd && $date_start <= $ymd)
            {
                $b_date = date_create($date_start);
                $planall[$day_start-1] = $plans
                ->whereBetween('created_at', [
                    date_format($b_date, 'Y-m-d 00:00:00'),
                    date_format($b_date, 'Y-m-d 23:59:59')
                    ])
                ->count();
                $plansuccess[$day_start-1] = $plans
                ->whereBetween('created_at', [
                    date_format($b_date, 'Y-m-d 00:00:00'),
                    date_format($b_date, 'Y-m-d 23:59:59')
                    ])
                ->where('status', '1')
                ->count();
                $planslowsuccess[$day_start-1] = $plans
                ->whereBetween('created_at', [
                    date_format($b_date, 'Y-m-d 00:00:00'),
                    date_format($b_date, 'Y-m-d 23:59:59')
                    ])
                ->where('status', '2')
                ->count();
                $planunsuccess[$day_start-1] = $plans
                ->whereBetween('created_at', [
                    date_format($b_date, 'Y-m-d 00:00:00'),
                    date_format($b_date, 'Y-m-d 23:59:59')
                    ])
                ->where('status', '0')
                ->count();
            }
            else
            {
                $planall[$day_start-1] = 0;
                $plansuccess[$day_start-1] = 0;
                $planslowsuccess[$day_start-1] = 0;
                $planunsuccess[$day_start-1] = 0;
            }
            $date_start = date ("Y-m-d", strtotime("+1 day", strtotime($date_start)));
        }

        $dashboard_plan = app()->chartjs
        ->name('barChartTest')
        ->type('bar')
        ->size(['width' => 0, 'height' => 400])
        ->labels($lable)
        ->datasets([
            [
                "label" => "แผนงานทั้งหมด",
                'backgroundColor' => '#000000',
                'data' => $planall
            ],
            [
                "label" => "แผนงานตรวจสอบเรียบร้อย",
                'backgroundColor' => '#006600',
                'data' => $plansuccess
            ],
            [
                "label" => "แผนงานตรวจสอบล่าช้า",
                'backgroundColor' => '#FF9900',
                'data' => $planslowsuccess
            ],
            [
                "label" => "แผนงานที่ยังไม่ได้ตรวจสอบ",
                'backgroundColor' => '#CC0000',
                'data' => $planunsuccess
            ]
        ])
        ->options([]);

        $plan_all = $plans->count();
        $plan_today = $plans
        ->whereBetween('created_at', [
            date('Y-m-d 00:00:00'),
            date('Y-m-d 23:59:59')
            ])
        ->count();
        $plan_check = $plans->whereIn('status', ['1','2'])->count();
        $plan_un = $plans->where('status', '0')->count();
        return view('manager.dashboard', [
            'plan_all' => $plan_all,
            'plan_today' => $plan_today,
            'plan_check' => $plan_check,
            'plan_un' => $plan_un,
            'dashboardplan' => $dashboard_plan
        ]);
    }

    public function managerPDF()
    {
        return view('manager.pdf.main');
    }


    // MAMBER

    public function memberDashboard()
    {
        $user = Auth::user();
        $plan = Plan::all();
        $plan_all = $plan->count();
        $plan_today = $plan->whereBetween('created_at', [date('Y-m-d 00:00:00'),date('Y-m-d 23:59:59')])->count();
        $plan_check = $plan->where('status', '0')->where('to_user_id', $user->id)->count();
        $user_count = $this->getUser()->where('office_id', $user->office_id)->count();
        $plans = $plan->where('status', '0')->where('to_user_id', $user->id);
        $category = [
            'ผัดสด' => 'ผัดสด',
            'ผลไม้สด' => 'ผลไม้สด',
            'ของหมักดอง' => 'ของหมักดอง',
            'ของสด' => 'ของสด',
            'อาหารแปรรูป' => 'อาหารแปรรูป',
            'ของทอด' => 'ของทอด',
            'อื่นๆ' => 'อื่นๆ'
        ];
        // dd($user_count);
        return view('member.dashboard', [
            'plan_all' => $plan_all,
            'plan_today' => $plan_today,
            'plan_check' => $plan_check,
            'user_count' => $user_count,
            'plans' => $plans,
            'category' => $category
        ]);
    }



    private function getUser()
    {
        return User::all();
    }


}
