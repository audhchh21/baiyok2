<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Http\Request;

use App\User;
use App\Titlename;
use App\Office;

use Auth;

class RegisterController extends Controller
{
    use RegistersUsers;

    protected $redirectTo = '/';

    public function __construct()
    {
        $this->middleware('guest');
    }

    public function showRegistrationForm()
    {
        $titlename = Titlename::all();
        $office = Office::all();
        return view('auth.register',[
            'titlenames' => $titlename,
            'offices' => $office
        ]);
    }

    protected function validator(array $data)
    {
        return Validator::make($data, [
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            'f_name' => ['required', 'string', 'max:255'],
            'l_name' => ['required', 'string', 'max:255'],
            'phone' => ['required', 'size:10'],
        ]);
    }

    public function register(Request $request)
    {
        $password = Hash::make($request->password);

        $user = new User;
        $user->email = $request->email;
        $user->password = $password;
        $user->titlename_id = $request->titlename;
        $user->f_name = $request->f_name;
        $user->l_name = $request->l_name;
        $user->phone = $request->phone;
        $user->office_id = $request->office_id;
        $user->type = 'User';
        $user->status  = '0';
        $user->save();

        //login as well.
        // Auth::login($user, false);

        return redirect()->route('register')->with('status', 'สมัครสมาชิกเรียบร้อย!!');
    }
}
