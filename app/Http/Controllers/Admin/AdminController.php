<?php

namespace App\Http\Controllers\Admin;


use App\Responsitory\Business;
use App\Responsitory\Categories;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\View;

class AdminController extends Controller
{
    private $business;
    function __construct()
    {
        $this->business = new Business();
//        $this->middleware('admin');

    }

    public function getIndex()
    {
        return view('admin.pages.index');
    }

}
