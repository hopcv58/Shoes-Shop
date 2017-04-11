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
                return redirect()->back()->with(['login_fails' => 'incorrect username or password']);
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
            'name' => 'required|max:191',
            'email' => 'email|max:191',
            'password' => 'required|min:6|max:191',
            'confirm' => 'required|min:6|max:191',
            'address' => 'required|max:191',
            'phone' => 'required|max:191'

        ];
        $validator = Validator::make($request->all(), $rule);
        if($validator->fails()){
            return redirect()->back()->withErrors($validator)->withInput();
        }
        if($request->password != $request->confirm){
            return redirect()->back()->with('fail', 'Mật khẩu không khớp')->withInput();
        }
        $customer = new Customers();
        $customer->username = $request->name;
        $customer->email = $request->email;
        $customer->password = bcrypt($request->password);
        $customer->address = $request->address;
        $customer->phone = $request->phone;
        $customer->save();
        return redirect()->back()->with('success', 'Thêm mới người dùng thành công');
    }



    public function showForgotPasswordForm()
    {
        return view('auth.passwords.email');
    }
}
