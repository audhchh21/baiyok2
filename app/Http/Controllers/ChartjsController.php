<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Arr;

use App\District;
use App\Foodtestkit;
use App\Plan;
use App\Inspection;
use App\Inspectiondetail;
use App\Office;

class ChartjsController extends Controller
{
    //
    public function main()
    {
        return view('chartjs.main', [
            'FoodProvince' => $this->chartFoodProvince(),
            'FoodDistrict' => $this->chartFoodDistrict(),
            'FoodSubdistrict' => $this->chartFoodSubdistrict(),
        ]);
    }

    public function chartFoodProvince()
    {

        $label = $this->getLabels($this->getFoodtestkit());
        $color = $this->getColor(count($label));
        $data = [];
        foreach($this->getFoodtestkit() as $key => $testkit){
            $inspectiondetail = $this->getInspectiondetail();
            $data = Arr::prepend($data, $inspectiondetail->where('foodtestkit_id', $testkit->id)->count());
        }
        $dataset = [
            [
                'backgroundColor' => $color,
                'data' => $data
            ]
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
        ->type('pie')
        ->size(['width' => 400, 'height' => 200])
        ->labels($label)
        ->datasets($dataset)
        ->options($options);
    }

    public function chartFoodDistrict()
    {
        $label = $this->getLabels($this->getDistrict());
        $color = $this->getColor(count($label));
        $dataset = [];
        foreach($this->getFoodtestkit() as $testkitkey => $testkit){
            $data = [];
            for($count = 0; $count <= count($label); $count++){
                $plans = $this->getPlan();
                $data = Arr::prepend($data, $plans);
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
        ->size(['width' => 400, 'height' => 200])
        ->labels($label)
        ->datasets($dataset)
        ->options($options);
    }

    public function chartFoodSubdistrict()
    {
        $label = $this->getLabels($this->getOffice());
        $color = $this->getColor(count($label));
        $dataset = [];
        foreach($this->getFoodtestkit() as $key => $testkit){
            $data = [];
            for($count = 0 ; $count <= count($label); $count++){
                $data = Arr::prepend($data, rand(0,50));
            }
            $datas = [
                'label' => $testkit->name,
                'backgroundColor' => $color[$key],
                'data' => $data
            ];
            $dataset = Arr::prepend($dataset, $datas);
        }
        $options = [
            'title' => [
                'display' => true,
                'position' => 'top',
                'text' => 'กราฟสรุปในระดับโรงพยาบาลส่งเสริมสุขภาพตำบล',
                'fontSize' => 24,
                'fontStyle' => 'bold'
            ],
            'legend' => [
                'display' => true,
                'position' => 'right',
            ],
            'tooltips' => [
                'enabled' => true,
            ],
        ];

        return app()->chartjs
        ->name('subdistrict')
        ->type('bar')
        ->size(['width' => 400, 'height' => 200])
        ->labels($label)
        ->datasets($dataset)
        ->options($options);
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

    private function getInspectiondetail()
    {
        return Inspectiondetail::all();
    }

    private function getInspection()
    {
        return Inspection::all();
    }

    private function getFoodtestkit()
    {
        return Foodtestkit::all();
    }

    private function getDistrict()
    {
        return District::orderBy('id', 'desc')->get();
    }

    private function getOffice()
    {
        return Office::all();
    }

    private function getPlan()
    {
        return Plan::all();
    }
}
