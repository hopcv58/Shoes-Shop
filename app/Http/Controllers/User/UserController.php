<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Responsitory\Business;
use App\Responsitory\Customers;
use App\Responsitory\Feedbacks;
use App\Responsitory\News;
use App\Responsitory\Products;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;


class UserController extends Controller
{
    private $business;
    
    function __construct()
    {
        $this->business = new Business();
    }
    
    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        $feedbacks = $this->business->getFeedback();
        $slides = $this->business->getSlide();
        return view('User.index', compact('feedbacks', 'slides'));
    }
    
    public function showCategory($cate_id)
    {
//        $product  =  productcate::with('Categories')->get();
        $category = $this->business->getCateById($cate_id);
        if (isset($category)) {
            if ($category->is_public == 0) {
                return view('errors.404');
            }
            $products = $this->business->getProductByCate($cate_id);
            return view('user.category', compact('products', 'category'));
        } else {
            return view('errors.404');
        }
    }
    
    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function showNewProduct()
    {
//        $product  =  productcate::with('Categories')->get();
        $products = $this->business->getAllProduct()->take(8);
        if (isset($products)) {
            return view('user.category', compact('products'));
        } else {
            return view('errors.404');
        }
    }
    
    /**
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function showProduct($id)
    {
//        $product  =  productcate::with('Categories')->get();
        $product = $this->business->getProductById($id);
        if (isset($product)) {
            $comment = $this->business->getCommentByProduct($id);
            $related = $this->business->getProductRelated($id);
            return view('user.product', compact('product', 'comment', 'related'));
        } else {
            return view('errors.404');
        }
    }
    
    public function showNews($id)
    {
        $news = $this->business->getNewsById($id);
        
        if (isset($news)) {
            $comments = $this->business->getCommentByNews($id);
            $related = $this->business->getRandomNews($id);
            return view('user.news', compact('news', 'comments', 'related'));
        } else {
            return view('errors.404');
        }
        
    }
    
    public function showAllNews()
    {
        $newsList = $this->business->getAllNews();
        return view('user.allNews', compact('newsList'));
    }
    
    public function search(Request $request)
    {
        $categories = $this->business->searchCategories($request->input);
        $newsList = $this->business->searchNews($request->input);
        $products = $this->business->searchProducts($request->input);
        return view('user.search', compact('categories', 'newsList', 'products'));
    }
    
    public function addCommentToProduct(Request $request)
    {
        try {
            Products::find($request->commentable_id)->comments()->create(
              [
                'customer_id' => $request->customer_id,
                'content' => $request->input('content'),
              ]
            );
            return Redirect::back();
        } catch (Exception $ex) {
            dd($ex->getMessage());
        }
        
    }
    
    public function addCommentToNews(Request $request)
    {
        try {
            News::find($request->commentable_id)->comments()->create(
              [
                'customer_id' => $request->customer_id,
                'content' => $request->input('content')
              ]
            );
            return Redirect::back();
        } catch (Exception $ex) {
            dd($ex->getMessage());
        }
        
    }
    
    public function showFeedbackForm()
    {
        return view('user.feedback');
    }
    
    public function addFeedback(Request $request)
    {
        $this->business->saveFeedback($request);
        return view('user.feedback');
    }
    
}
