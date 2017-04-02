<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\View;

class AdminController extends Controller
{
    function __construct()
    {
        $this->middleware('admin');
    }

    public function getIndex()
    {
        return view('admin.pages.index');
    }

}
