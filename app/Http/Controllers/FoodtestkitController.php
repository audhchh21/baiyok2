<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Foodtestkit;

class FoodtestkitController extends Controller
{
    //
    public function foodtestkitMain()
    {
        $foodtestkit = Foodtestkit::all();
        return view('member.foodtestkit.main', [
            'count' => 1,
            'foodtestkits' => $foodtestkit
        ]);
    }

    //
    public function foodtestkitEdit($id)
    {
        $foodtestkit = Foodtestkit::findOrFail($id);
        return view('member.foodtestkit.edit', [
            'foodtestkit' => $foodtestkit
        ]);
    }

    //
    public function foodtestkitStore(Request $request)
    {
        // dd($request->all());
        $input['name'] = $request->name;

        try {
            $foodtestkit = Foodtestkit::create($input);
        } catch (\Exception $e) {
            return redirect()->route('member.foodtestkit')->with('error', 'ชุดทดสอบ "'.$input['name'].'" มีอยู่แล้ว!!');
        }
        return redirect()->route('member.foodtestkit')->with('status', 'เพิ่มชุดทดสอบเรียบร้อย!!');
    }

    //
    public function foodtestkitUpdate(Request $request, $id)
    {
        // dd($request->all());
        $foodtestkit = Foodtestkit::findOrFail($id);
        $foodtestkit->name = $request->name;
        try {
            $foodtestkit->save();
        } catch (\Exception $e) {
            return redirect()->route('member.foodtestkit.edit', ['id' => $foodtestkit->id])->with('error', 'แก้ไขชุดทดสอบ "'.$foodtestkit->name.'" ไม่สำเสร็จ!!');
        }
        return redirect()->route('member.foodtestkit.edit', ['id' => $foodtestkit->id])->with('status', 'แก้ไขชุดทดสอบ "'.$foodtestkit->name.'" สำเสร็จ!!');
    }

    //
    public function foodtestkitDelete($id)
    {
        $foodtestkit = Foodtestkit::findOrFail($id);
        try {
            $foodtestkit->delete();
        } catch (\Exception $e) {
            return redirect()->route('member.foodtestkit')->with('error', 'ชุดทดสอบ "'.$foodtestkit->name.'" ใช้ถูกใช้งานอยู่ ไม่สามารถลบได้!!');
        }
        return redirect()->route('member.foodtestkit')->with('status', 'ลบชุดทดสอบ "'.$foodtestkit->name.'" เรียบร้อย!!');
    }
}
