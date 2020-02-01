<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Foodsample;

class FoodsampleController extends Controller
{
    //
    public function foodsampleMain()
    {
        $foodsample = Foodsample::all();
        $category = [
            'ผัดสด' => 'ผัดสด',
            'ผลไม้สด' => 'ผลไม้สด',
            'ของหมักดอง' => 'ของหมักดอง',
            'ของสด' => 'ของสด',
            'อาหารแปรรูป' => 'อาหารแปรรูป',
            'ของทอด' => 'ของทอด',
            'อื่นๆ' => 'อื่นๆ'
        ];
        return view('member.foodsample.main', [
            'count' => 1,
            'foodsamples' => $foodsample,
            'category' => $category
        ]);
    }

    //
    public function foodsampleEdit($id)
    {
        $foodsample = Foodsample::findOrFail($id);
        $category = [
            'ผัดสด' => 'ผัดสด',
            'ผลไม้สด' => 'ผลไม้สด',
            'ของหมักดอง' => 'ของหมักดอง',
            'ของสด' => 'ของสด',
            'อาหารแปรรูป' => 'อาหารแปรรูป',
            'ของทอด' => 'ของทอด',
            'อื่นๆ' => 'อื่นๆ'
        ];
        return view('member.foodsample.edit', [
            'foodsample' => $foodsample,
            'category' => $category
        ]);
    }

    //
    public function foodsampleStore(Request $request)
    {
        // dd($request->all());
        $input['name'] = str_replace(' ', '', $request->name);
        $input['category'] = $request->category;

        try {
            $foodsample = Foodsample::create($input);
        } catch (\Exception $e) {
            return redirect()->route('member.foodsample')->with('error', 'ตัวอย่างอาหาร "'.$input['name'].'" มีอยู่แล้ว!!');
        }
        return redirect()->route('member.foodsample')->with('status', 'เพิ่มตัวอย่างอาหาร "'.$foodsample->name.'" เรียบร้อย!!');
    }

    //
    public function foodsampleUpdate(Request $request, $id)
    {
        // dd($request->all());
        $foodsample = Foodsample::findOrFail($id);
        $foodsample->name = str_replace(' ', '', $request->name);
        $foodsample->category = $request->category;
        try {
            $foodsample->save();
        } catch (\Exception $e) {
            return redirect()->route('member.foodsample.edit', ['id' => $foodsample->id])->with('error', 'แก้ไขตัวอย่างอาหาร "'.$foodsample->name.'" ไม่สำเสร็จ!!');
        }
        return redirect()->route('member.foodsample.edit', ['id' => $foodsample->id])->with('status', 'แก้ไขตัวอย่างอาหาร "'.$foodsample->name.'" สำเสร็จ!!');
    }

    //
    public function foodsampleDelete($id)
    {
        $foodsample = Foodsample::findOrFail($id);
        try {
            $foodsample->delete();
        } catch (\Exception $e) {
            return redirect()->route('member.foodsample')->with('error', 'ตัวอย่างอาหาร "'.$foodsample->name.'" ใช้ถูกใช้งานอยู่ ไม่สามารถลบได้!!');
        }
        return redirect()->route('member.foodsample')->with('status', 'ลบตัวอย่างอาหาร "'.$foodsample->name.'" เรียบร้อย!!');
    }
}
