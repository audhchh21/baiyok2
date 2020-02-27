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
            if($user->type == 'Admin'){
                return redirect()->route('admin.profile.edit')->with('error', 'แก้ไขข้อมูลส่วนตัวไม่สำเสร็จ!!');
            }elseif($user->type == 'Manager'){
                return redirect()->route('manager.profile.edit')->with('error', 'แก้ไขข้อมูลส่วนตัวไม่สำเสร็จ!!');
            }elseif($user->type == 'User'){
                return redirect()->route('member.profile.edit')->with('error', 'แก้ไขข้อมูลส่วนตัวไม่สำเสร็จ!!');
            }
        }
        if($user->type == 'Admin'){
            return redirect()->route('admin.profile.edit')->with('status', 'แก้ไขข้อมูลเรียบร้อย!!');
        }elseif($user->type == 'Manager'){
            return redirect()->route('manager.profile.edit')->with('status', 'แก้ไขข้อมูลเรียบร้อย!!');
        }elseif($user->type == 'User'){
            return redirect()->route('member.profile.edit')->with('status', 'แก้ไขข้อมูลเรียบร้อย!!');
        }
    }

    //
    public function profilePasswordReset(Request $request)
    {
        // dd($request->all());
        $password = User::findOrFail(Auth::user()->id);
        if(Hash::check($request->current_password, Auth::user()->password))
        {

            $password->password = Hash::make($request->new_password);
            $password->save();
            if($password->type == 'Admin'){
                return redirect()->route('admin.profile.edit')->with('status', 'เปลี่ยนรหัสผ่านสำเร็จ!!');
            }elseif($password->type == 'Manager'){
                return redirect()->route('manager.profile.edit')->with('status', 'เปลี่ยนรหัสผ่านสำเร็จ!!');
            }elseif($password->type == 'User'){
                return redirect()->route('member.profile.edit')->with('status', 'เปลี่ยนรหัสผ่านสำเร็จ!!');
            }
        }else{
            if($password->type == 'Admin'){
                return redirect()->route('admin.profile.edit')->with('status', 'เปลี่ยนรหัสผ่านไม่สำเร็จ!!');
            }elseif($password->type == 'Manager'){
                return redirect()->route('manager.profile.edit')->with('status', 'เปลี่ยนรหัสผ่านไม่สำเร็จ!!');
            }elseif($password->type == 'User'){
                return redirect()->route('member.profile.edit')->with('status', 'เปลี่ยนรหัสผ่านไม่สำเร็จ!!');
            }
        }
    }
}
