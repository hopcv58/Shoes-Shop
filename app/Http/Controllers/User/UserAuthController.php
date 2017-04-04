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
<<<<<<< HEAD
        return view('auth.login');
=======
        return view('user.auth.login');
>>>>>>> 8d1ce6ac7c83a492e89cc269a0c9db471b164c9a
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
        return redirect()->route('login');
    }

    public function showRegistrationForm()
    {
<<<<<<< HEAD
        return view('auth.register');
=======
        return view('user.auth.register');
>>>>>>> 8d1ce6ac7c83a492e89cc269a0c9db471b164c9a
    }

    public function postRegister(Request $request)
    {

    }

    public function showForgotPasswordForm()
    {
        return view('auth.passwords.email');
    }
}
