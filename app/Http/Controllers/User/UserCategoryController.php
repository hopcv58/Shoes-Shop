<?php

namespace App\Http\Controllers\User;

use App\Responsitory\Customers;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class userCategoryController extends Controller
{
    public function showCategory()
    {
        return view('user.category');
    }
}
