<?php

namespace App\Http\Controllers\User;

use App\Responsitory\Customers;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class UserAuthController extends Controller
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
    protected $redirectTo = '/';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest', ['except' => 'logout']);
        parent::__construct();
    }
    public function showLoginForm()
    {
        return view('user.auth.login');
    }

    public function login(Request $request)
    {
        $customer = new Customers();
        $validator = Validator::make($request->all(),$customer->ruleLogin());
        if($validator->fails()){
            return redirect()->back()->withErrors($validator)->withInput();
        }else{
            $input = [
                'email' => $request->input('email'),
                'password' => $request->input('password'),
            ];
            if(Auth::guard('customer')->attempt($input,$request->has('remember'))){
                return redirect()->route('index');
            }else{
                return redirect()->back()->with(['fail' => 'Mật khẩu hoặc tài khoản không đúng']);
            }
        }
    }

    public function logout(Request $request)
    {
        Auth::guard('customer')->logout();
        return redirect()->route('index');
    }

    public function showRegistrationForm()
    {
        return view('user.auth.register');
    }

    public function register(Request $request)
    {
        $rule = [
            'name' => 'required|max:30',
            'email' => 'email|min:3|max:50',
            'password' => 'required|min:6|max:20',
            'confirm' => 'required|min:6|max:20',
            'address' => 'required|min:3|max:191',
            'phone' => 'required|max:30'
        ];
        $validator = Validator::make($request->all(), $rule);
        if($validator->fails()){
            return redirect()->back()->withErrors($validator)->withInput();
        }
        if($request->password != $request->confirm){
            return redirect()->back()->with('fail', 'Mật khẩu không khớp')->withInput();
        }
        if(count(Customers::where('email',$request->email)->get()))
        {
            return redirect()->back()->with('fail', 'Email đã có người sử dụng')->withInput();
        }
        $customer = new Customers();
        $customer->username = $request->name;
        $customer->email = $request->email;
        $customer->password = bcrypt($request->password);
        $customer->address = $request->address;
        $customer->phone = $request->phone;
        $customer->save();
        return redirect()->route('login')->with('success', 'Đăng ký thành công. Mời bạn đăng nhập');
    }



    public function showForgotPasswordForm()
    {
        return view('auth.passwords.email');
    }
}
