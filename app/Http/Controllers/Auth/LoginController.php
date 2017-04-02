<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\Validator;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest', ['except' => 'logout']);
    }

    //Hien thi form dang nhap admin   :get
    //post thong tin dang nhap len form : post
    //logout : post
    //tao middleware cho auth nay
    public function showAdminLoginForm()
    {
        return view('admin.pages.admin-login');
    }

    public function login(Request $request)
    {
        $rule = [
            'email' => 'required',
            'password' => 'required|min:6',
        ];
        $validator = Validator::make($request->all(), $rule);
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        } else {
//            dd('validate thanh cong');
            $input = [
                'email' => $request->input('email'),
                'password' => $request->input('password')
            ];
            if(Auth::guard('customer')->attempt($input))
            {
                $us = Auth::guard('customer')->user();
//                dd('dang nhap thanh cong:' . $us);
            }else{
//                dd('dang nhap that bai');
                return redirect()->back()->with(['login_fail' => 'username or password incorrect'])->withInput();
            }
        }
    }

    public function logout()
    {
        Auth::guard('customer')->logout();
        return redirect()->route('adminLogin');
    }
}
