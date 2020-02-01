<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Foodsamplesource;

class FoodsamplesourceController extends Controller
{
    //
    public function foodsamplesourceMain()
    {
        $foodsamplesource = Foodsamplesource::all();
        return view('member.foodsamplesource.main', [
            'count' => 1,
            'foodsamplesources' => $foodsamplesource
        ]);
    }

    //
    public function foodsamplesourceEdit($id)
    {
        $foodsamplesource = Foodsamplesource::findOrFail($id);
        return view('member.foodsamplesource.edit', [
            'foodsamplesource' => $foodsamplesource
        ]);
    }

    //
    public function foodsamplesourceStore(Request $request)
    {
        $input['name'] = str_replace(' ', '', $request->name);
        try {
            $foodsamplesource = Foodsamplesource::create($input);
        } catch (\Exception $e) {
            return redirect()->route('member.foodsamplesource')->with('error', 'แหล่งที่มาตัวอย่างอาหาร "'.$input['name'].'" มีอยู่แล้ว!!');
        }
        return redirect()->route('member.foodsamplesource')->with('status', 'เพิ่มแหล่งที่มาตัวอย่างอาหาร "'.$foodsamplesource->name.'" เรียบร้อย!!');
    }

    //
    public function foodsamplesourceUpdate(Request $request, $id)
    {
        $foodsamplesource = Foodsamplesource::findOrFail($id);
        $foodsamplesource->name = str_replace(' ', '', $request->name);
        try {
            $foodsamplesource->save();
        } catch (\Exception $e) {
            return redirect()->route('member.foodsamplesource.edit', ['id' => $foodsamplesource->id])->with('error', 'แก้ไขแหล่งที่มาตัวอย่างอาหาร "'.$foodsamplesource->name.'" ไม่สำเสร็จ!!');
        }
        return redirect()->route('member.foodsamplesource.edit', ['id' => $foodsamplesource->id])->with('status', 'แก้ไขแหล่งที่มาตัวอย่างอาหาร "'.$foodsamplesource->name.'" สำเสร็จ!!');
    }

    //
    public function foodsamplesourceDelete($id)
    {
        $foodsamplesource = Foodsamplesource::findOrFail($id);
        try {
            $foodsamplesource->delete();
        } catch (\Exception $e) {
            return redirect()->route('member.foodsamplesource')->with('error', 'แหล่งที่มาตัวอย่างอาหาร "'.$foodsamplesource->name.'" ใช้ถูกใช้งานอยู่ ไม่สามารถลบได้!!');
        }
        return redirect()->route('member.foodsamplesource')->with('status', 'status', 'ลบแหล่งที่มาตัวอย่างอาหาร "'.$foodsamplesource->name.'" เรียบร้อย!!');
    }
}
