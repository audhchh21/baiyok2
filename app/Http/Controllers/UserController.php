<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\RequestUser;
use App\Http\Requests\RequestUserEdit;
use Illuminate\Support\Facades\Hash;

use App\User;
use App\Titlename;
use App\Office;

class UserController extends Controller
{
    //
    public function userMain()
    {
        $user = $this->getUser();
        return view('admin.user.main', [
            'count' => 1,
            'users' => $user
        ]);
    }

    //
    public function userCreate()
    {
        $titlenames = $this->getTitlename()->pluck('name', 'id');
        $offices = $this->getOffice()->pluck('name', 'id');
        return view('admin.user.create', [
            'titlenames' => $titlenames,
            'offices' => $offices
        ]);
    }

    //
    public function userEdit($id)
    {
        $user = $this->getUser()->find($id);
        $titlenames = $this->getTitlename()->pluck('name', 'id');
        $offices = $this->getOffice()->pluck('name', 'id');
        return view('admin.user.edit', [
            'user' => $user,
            'titlenames' => $titlenames,
            'offices' => $offices
        ]);
    }

    //
    public function userStore(RequestUser $request)
    {
        // dd($request->all());
        $input['email'] = $request->email;
        $input['password'] = Hash::make($request->password);
        $input['titlename_id'] = $request->titlename;
        $input['f_name'] = $request->f_name;
        $input['l_name'] = $request->l_name;
        $input['phone'] = $request->phone;
        $input['office_id'] = $request->office;

        $type = $request->type;
        if($type == 't1'){
            $input['type'] = 'Admin';
        }else if($type == 't2'){
            $input['type'] = 'Manager';
        }else if($type == 't3'){
            $input['type'] = 'User';
        }

        $status = $request->status;
        if($status == 's1'){
            $input['status'] = '1';
        }else if($status == 's2'){
            $input['status'] = '0';
        }else if($status == 's3'){
            $input['status'] = '2';
        }

        try {
            $user = User::create($input);
        } catch (\Exception $e) {
            // dd($e->getMessage());
            return redirect()->route('admin.user.create')->with('error', 'ไม่สามารถ ใช้อีเมลซ้ำกันได้');
        }

        return redirect()->route('admin.user.create')->with('status', 'เพิ่มผู้ใช้งาน "'.$input['email'].'" เรียบร้อย!!');
    }

    //
    public function userUpdate(RequestUserEdit $request, $id)
    {
        // dd($request->all());
        $user = User::findOrFail($id);
        $user->email = $request->email;
        $user->titlename_id = $request->titlename;
        $user->f_name = $request->f_name;
        $user->l_name = $request->l_name;
        $user->phone = $request->phone;
        $user->office_id = $request->office;

        $type = $request->type;
        if($type == 't1'){
            $user->type = 'Admin';
        }else if($type == 't2'){
            $user->type = 'Manager';
        }else if($type == 't3'){
            $user->type = 'User';
        }

        $status = $request->status;
        if($status == 's1'){
            $user->status = '1';
        }else if($status == 's2'){
            $user->status = '0';
        }else if($status == 's3'){
            $user->status = '2';
        }

        try {
            $user->save();
        } catch (\Exception $e) {
            // dd($e->getMessage());
            return redirect()->route('admin.user.edit', ['id' => $user->id])->with('error', 'ไม่สามารถแก้ไข "'.$request->email.'" ซ้ำกันได้');
        }
        return redirect()->route('admin.user.edit', ['id' => $user->id])->with('status', 'แก้ไขผู้ใช้งาน "'.$request->email.'" เรียบร้อย!!');
    }

    //
    public function userDelete($id)
    {
        $user = User::findOrFail($id);
        try {
            $user->delete();
        } catch (\Exception $e) {
            // dd($e->getMessage());
            return redirect()->route('admin.user')->with('error', 'ไม่สามารถลบผู้ใช้งาน "'.$user->email.'" ได้!!');
        }
        return redirect()->route('admin.user')->with('status', 'ลบผู้ใช้งาน "'.$user->email.'" เรียบร้อย!!');
    }

    //
    private function getUser()
    {
        $user = User::all();
        return $user;
    }

    //
    private function getTitlename()
    {
        $titlename = Titlename::all();
        return $titlename;
    }

    //
    private function getOffice()
    {
        $office = Office::all();
        return $office;
    }
}
