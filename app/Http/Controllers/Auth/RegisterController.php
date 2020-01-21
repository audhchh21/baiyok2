<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;

use App\User;
use App\Titlename;
use App\Office;

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
        $user->f_name = $request->f_name;
        $user->l_name = $request->l_name;
        $user->phone = $request->phone;
        $user->office_id = $request->office_id;
        $user->type = 'User';
        $user->status  = '0';
        $user->save();

        //login as well.
        Auth::login($user,true);
    }

    // protected function create(array $data)
    // {
    //     return User::create([
    //         'email' => $data['email'],
    //         'password' => Hash::make($data['password']),
    //         'titlename_id' => $data['titlename_id'],
    //         'f_name' => $data['f_name'],
    //         'l_name' => $data['l_name'],
    //         'phone' => $data['phone'],
    //         'office_id' => $data['office_id'],
    //         'type' => 'User',
    //         'Status' => '0'
    //     ]);
    // }
}
