<?php

namespace App\Http\Controllers\User;

use App\Responsitory\Business;
use App\Responsitory\productcate;
use App\Responsitory\Products;
use App\Responsitory\Categories;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class UserController extends Controller
{
    private $business;
    function __construct()
    {
        $this->business = new Business();
    }
    
    public function index()
    {
        return view('User.index');
    }
    public function showCategory($cate_id)
    {
//        $product  =  productcate::with('Categories')->get();
        $products = $this->business->getProductByCate($cate_id);
        $category = $this->business->getCateById($cate_id);
        return view('user.category',compact('products','category'));
    }
    public function showProduct($id)
    {
//        $product  =  productcate::with('Categories')->get();
        $product = $this->business->getProductById($id);
        $comment = $this->business->getCommentByProduct($id);
        return view('user.product',compact('product','comment'));
    }
}
