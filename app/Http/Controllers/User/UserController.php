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
        return view('User.index');
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
