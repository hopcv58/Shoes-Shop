<?php

namespace App\Http\Controllers\User;

use App\Responsitory\Customers;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class userProductController extends Controller
{
    public function showProduct()
    {
        return view('user.product');
    }
}
