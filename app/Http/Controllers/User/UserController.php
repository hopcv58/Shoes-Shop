<?php

namespace App\Http\Controllers\User;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class UserController extends Controller
{
    function __construct()
    {
        
    }
    
    public function index()
    {
<<<<<<< HEAD
        return view('/home');
=======
        return view('User.index');
>>>>>>> 8d1ce6ac7c83a492e89cc269a0c9db471b164c9a
    }
    public function showCategory()
    {
        return view('user.category');
    }
    public function showProduct()
    {
        return view('user.product');
    }
}
