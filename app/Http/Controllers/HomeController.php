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
use App\Province;
use App\District;
use App\Subdistrict;
use App\Mapoffice;
use App\Mapdistrict;

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
        $plans = Plan::all();
        $plan_all = $plans->count();
        $plan_today = $plans->whereBetween('created_at', [date('Y-m-d 00:00:00'),date('Y-m-d 23:59:59')])->count();
        $plan_check = $plans->whereIn('status', ['1','2'])->count();
        $plan_un = $plans->where('status', '0')->count();

        $testkids = $this->getFoodtestkit();
        $districts = $this->getDistrict();

        $data = [];
        foreach($testkids as $testkid){
            $data = Arr::prepend($data, [
                'name' => $testkid->name,
            ]);
        }

        return view('manager.dashboard', [
            'plan_all' => $plan_all,
            'plan_today' => $plan_today,
            'plan_check' => $plan_check,
            'plan_un' => $plan_un,

            'ChartProvince' => $this->chartFoodProvince(),
            'ChartDistrict' => $this->chartFoodDistrict(),

            'testkids' => $testkids,
            'districts' => $districts,


        ]);
    }

    public function managerPDF()
    {
        $province = Province::pluck('name', 'id');
        $district = District::pluck('name', 'id');
        return view('manager.pdf.main', [
            'provinces' => $province,
            'districts' => $district,

        ]);
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

        /**
         *
         */
        $datas1 = [];
        $datas2 = [];
        $datas3 = [];
        $lable = [];
        $testkids = Foodtestkit::orderBy('id')->get();
        foreach($testkids as $testkid) {
            $testkid_id = $testkid->id;
            $lable = Arr::prepend($lable, $testkid->name);
            $mapoffice1 = Mapoffice::where('map_office', auth()->user()->office_id)
            ->whereIn('map_inspectiondetail', function ($query1) use ($testkid_id) {
                $query1->select('id')
                ->from('inspectiondetails')
                ->where('foodtestkit_id', $testkid_id)
                ->where('inspection_result','1')
                ->get();
            })
            ->count();
            $datas1 = Arr::prepend($datas1, $mapoffice1);

            $mapoffice2 = Mapoffice::where('map_office', auth()->user()->office_id)
            ->whereIn('map_inspectiondetail', function ($query2) use ($testkid_id) {
                $query2->select('id')
                ->from('inspectiondetails')
                ->where('foodtestkit_id', $testkid_id)
                ->where('inspection_result','2')
                ->get();
            })
            ->count();
            $datas2 = Arr::prepend($datas2, $mapoffice2);

            $mapoffice3 = Mapoffice::where('map_office', auth()->user()->office_id)
            ->whereIn('map_inspectiondetail', function ($query3) use ($testkid_id) {
                $query3->select('id')
                ->from('inspectiondetails')
                ->where('foodtestkit_id', $testkid_id)
                ->where('inspection_result','3')
                ->get();
            })
            ->count();
            $datas3 = Arr::prepend($datas3, $mapoffice3);
        }

        // dd($datas3);
        $testkidchart = app()->chartjs
        ->name('testkidchart')
        ->type('bar')
        ->size(['width' => 400, 'height' => 200])
        ->labels($lable)
        ->datasets([
            [
                'label' => 'ไม่พบ',
                'backgroundColor' => 'rgba(38, 185, 154, 0.31)',
                'borderColor' => 'rgba(0, 0, 0, 0.7)',
                'pointBorderColor' => 'rgba(0, 0, 0, 0.7)',
                'pointBackgroundColor' => 'rgba(0, 0, 0, 0.7)',
                'pointHoverBackgroundColor' => '#fff',
                'pointHoverBorderColor' => 'rgba(220,220,220,1)',
                'data' => $datas1,
            ],
            [
                'label' => 'พบปลอดภัย',
                'backgroundColor' => 'rgba(255, 123, 127, 0.31)',
                'borderColor' => 'rgba(0, 0, 0, 0.7)',
                'pointBorderColor' => 'rgba(0, 0, 0, 0.7)',
                'pointBackgroundColor' => 'rgba(0, 0, 0, 0.7)',
                'pointHoverBackgroundColor' => '#fff',
                'pointHoverBorderColor' => 'rgba(220,220,220,1)',
                'data' => $datas2,
            ],
            [
                'label' => 'พบไม่ปลอดภัย',
                'backgroundColor' => 'rgba(255, 0, 127, 0.31)',
                'borderColor' => 'rgba(0, 0, 0, 0.7)',
                'pointBorderColor' => 'rgba(0, 0, 0, 0.7)',
                'pointBackgroundColor' => 'rgba(0, 0, 0, 0.7)',
                'pointHoverBackgroundColor' => '#fff',
                'pointHoverBorderColor' => 'rgba(220,220,220,1)',
                'data' => $datas3,
            ]
        ])
        ->options([
            'title' => [
                'display' => true,
                'position' => 'top',
                'text' => 'กราฟแสดงผลการตรวจพบสารปนเปื้อน',
                'fontSize' => 18,
                'fontStyle' => 'bold',
                'fontColor' => '#000',
                'padding' => 10,
                'lineHeight' => 1.2
            ],
            'tooltips' => [
                'enabled' => 'true',
                'mode' => 'index',
                'titleFontSize' => 14,
                'titleFontColor' => '#fff',
                'titleAlign' => 'left',
                'bodyFontSize' => 14
            ],
            'legend' => [
                'display' => 'true',
                'position' => 'top',
                'fullWidth' => true,
                'labels' => [
                    'fontColor' => '#000'
                ],
            ]
        ]);

        // dd($user_count);
        return view('member.dashboard', [
            'plan_all' => $plan_all,
            'plan_today' => $plan_today,
            'plan_check' => $plan_check,
            'user_count' => $user_count,
            'plans' => $plans,
            'category' => $category,
            'testkidchart' => $testkidchart
        ]);
    }

    public function chartFoodProvince()
    {

        $label = $this->getLabels($this->getFoodtestkit());
        $color = $this->getColor(count($label));
        $datas = [
            'backgroundColor' => 'rgba(0,0,0,1)',
            'data' => [1, 2, 3]
        ];
        $options = [
            'title' => [
                'display' => true,
                'position' => 'top',
                'text' => 'กราฟสรุปในระดับจังหวัด',
                'fontSize' => 24,
                'fontStyle' => 'bold'
            ],
            'legend' => [
                'display' => true,
                'position' => 'bottom',
            ],
            'tooltips' => [
                'enabled' => true,
            ],
        ];

        return app()->chartjs
        ->name('province')
        ->type('bar')
        ->size(['width' => 400, 'height' => 300])
        ->labels($label)
        ->datasets($datas)
        ->options($options);
    }

    public function chartFoodDistrict()
    {
        $label = $this->getLabels($this->getDistrict());
        $color = $this->getColor(count($label));
        $dataset = [];
        foreach($this->getFoodtestkit() as $testkitkey => $testkit){
            $data = [];
            foreach($this->getDistrict() as $district){
                $id = $testkit->id;
                $data = Arr::prepend($data, Mapdistrict::where('map_district', $district->id)
                ->whereIn('map_inspectiondetail', function ($query) use ($id) {
                    $query->select('id')
                    ->from('inspectiondetails')
                    ->where('foodtestkit_id', function ($query) use ($id) {
                        $query->select('id')
                        ->from('foodtestkits')
                        ->where('id', $id);
                    });
                })
                ->count());
            }
            $datas = [
                'label' => $testkit->name,
                'backgroundColor' => $color[$testkitkey],
                'data' => $data
            ];
            $dataset = Arr::prepend($dataset, $datas);
        }
        $options = [
            'title' => [
                'display' => true,
                'position' => 'top',
                'text' => 'กราฟสรุปในระดับอำเภอ',
                'fontSize' => 24,
                'fontStyle' => 'bold'
            ],
            'legend' => [
                'display' => true,
                'position' => 'bottom',
            ],
            'tooltips' => [
                'enabled' => true,
            ],
        ];

        return app()->chartjs
        ->name('district')
        ->type('bar')
        ->size(['width' => 400, 'height' => 300])
        ->labels($label)
        ->datasets($dataset)
        ->options($options);
    }


    private function getUser()
    {
        return User::all();
    }

    private function getLabels($foodtestkit)
    {
        $output = [];
        foreach($foodtestkit as $data){
            $output = Arr::prepend($output, $data->name);
        }
        return $output;
    }

    private function getColor($count = 1)
    {
        $hexcode = ['0', '1', '2', '3', '4', '5', '6', '7', '8', '9', 'a', 'b', 'c', 'd', 'e', 'f'];
        $output = [];
        for($i = 0; $i <= $count; $i++){
            $output = Arr::prepend($output, '#'.$hexcode[rand(0,15)].$hexcode[rand(0,15)].$hexcode[rand(0,15)].$hexcode[rand(0,15)].$hexcode[rand(0,15)].$hexcode[rand(0,15)]);
        }
        return $output;
    }

    private function getFoodtestkit()
    {
        return Foodtestkit::all();
    }

    private function getDistrict()
    {
        return District::all();
    }

}
