<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

use Auth;
use App\User;
use App\Office;
use App\Titlename;

class ProfileController extends Controller
{
    //
    public function profileMain()
    {
        $user = Auth::user();
        return view('profile.main', [
            'user' => $user
        ]);
    }

    //
    public function profileEdit()
    {
        $user = Auth::user();
        $titlename = Titlename::pluck('name', 'id');
        $office = Office::pluck('name', 'id');
        return view('profile.edit', [
            'user' => $user,
            'titlename' => $titlename,
            'office' => $office
        ]);
    }

    //
    public function profilePassword()
    {
        $user = Auth::user();
        return view('profile.password', [
            'user' => $user
        ]);
    }

    //
    public function profileUpdate(Request $request, $id)
    {
        // dd($request->all());
        $user = User::findOrFail($id);
        $user->email = $request->email;
        $user->titlename_id = $request->titlename;
        $user->f_name = $request->f_name;
        $user->l_name = $request->l_name;
        $user->phone = $request->phone;
        $user->office_id = $request->office;
        try {
            $user->save();
        } catch (\Exception $e) {
            // dd($e->getMessage());
            return redirect()->route('admin.profile.edit')->with('error', 'แก้ไขข้อมูลส่วนตัวไม่สำเสร็จ!!');
        }
        return redirect()->route('admin.profile.edit')->with('status', 'แก้ไขข้อมูลเรียบร้อย!!');
    }

    //
    public function profilePasswordReset(Request $request)
    {
        // dd($request->all());
        if(Hash::check($request->current_password, Auth::user()->password))
        {
            $password = User::findOrFail(Auth::user()->id);
            $password->password = Hash::make($request->new_password);
            $password->save();
            return redirect()->route('admin.profile.password')->with('status', 'เปลี่ยนรหัสผ่านสำเร็จ!!');
        }else{
            return redirect()->route('admin.profile.password')->with('error', 'เปลี่ยนรหัสผ่านไม่สำเร็จ!!');
        }
    }
}
