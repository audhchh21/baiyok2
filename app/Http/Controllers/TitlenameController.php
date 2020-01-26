<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\RequestTitlename;

use App\Titlename;

class TitlenameController extends Controller
{
    //
    public function titlenameMain()
    {
        $titlename = Titlename::all();
        return view('admin.titlename.main', [
            'count' => 1,
            'titlenames' => $titlename
        ]);
    }

    //
    public function titlenameCreate()
    {
        return view('admin.titlename.create');
    }

    //
    public function titlenameEdit($id)
    {
        $titlename = Titlename::findOrFail($id);
        return view('admin.titlename.edit', [
            'titlename' => $titlename
        ]);
    }

    //
    public function titlenameStore(RequestTitlename $request)
    {
        $input['name'] = $request->titlename;
        try {
            $titlename = Titlename::create($input);
        } catch ( \Exception $e ) {
            return redirect()->route('admin.titlename.create')->with('error', 'ไม่สามารถเพิ่มคำนำหน้าชื่อซ้ำกันได้!!');
        }
        return redirect()->route('admin.titlename.create')->with('status', 'เพิ่มคำนำหน้าชื่อ "'.$titlename->name.'" เรียบร้อย!!');
    }

    //
    public function titlenameUpdate(RequestTitlename $request, $id)
    {
        $titlename = Titlename::findOrFail($id);

        $def_title = $titlename->name;
        $titlename->name = $request->titlename;

        try {
            $titlename->save();
        } catch ( \Exception $e ) {
            return redirect()->route('admin.titlename.edit', ['id'=>$id])->with('error', 'ไม่สามารถแก้ไขคำนำหน้าชื่อซ้ำกันได้!!');
        }
        return redirect()->route('admin.titlename.edit', ['id'=>$id])->with('status', 'แก้ไขคำนำหน้าชื่อ "'.$def_title.'" แก้ไขเป็น "'.$titlename->name.'" เรียบร้อย!!');
    }

    //
    public function titlenameDelete($id)
    {
        $titlename = Titlename::findOrFail($id);

        try {
            $titlename->delete();
        } catch ( \Exception $e ) {
            return redirect()->route('admin.titlename')->with('error', 'คำนำหน้าชื่อ "'.$titlename->name.'" ถูกใช้งานอยู่ ไม่สามารถลบคำนำหน้าชื่อได้!!');
        }
        return redirect()->route('admin.titlename')->with('status', 'ลบคำนำหน้าชื่อ "'.$titlename->name.'" เรียบร้อย!!');
    }
}
