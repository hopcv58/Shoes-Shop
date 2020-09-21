<?php

namespace App\Http\Controllers;

use App\Responsitory\Business;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Support\Facades\View;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function __construct()
    {
        $business = new Business();

        //        view share data
        $cateList = $business->getAllCate();
        $productList = [];
        foreach ($cateList as $cate)
            $productList[$cate->id] = $business->getProductByCate($cate->id)->shuffle()->take(4);
        View::share('productList', $productList);
        View::share('cateList', $cateList);
    }
}
