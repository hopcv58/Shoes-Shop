<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Responsitory\Business;
use App\Responsitory\Customers;
use App\Responsitory\News;
use App\Responsitory\Products;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;

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
        $newsList = $this->business->getAllNews()->shuffle()->take(4);
        $feedbacks = $this->business->getFeedback();
        $slides = $this->business->getSlide();
        return view('User.index', compact('feedbacks', 'slides', 'newsList'));
    }
    
    public function showProfile()
    {
        if (Auth::guard('customer')->guest()) {
            return view('errors.404');
        } else {
            $customer = $this->business->getCustomerById();
        }
        return view('user.profile', compact('customer'));
    }
    
    public function editProfile(Request $request)
    {
        $rule = [
          'password' => 'required|min:6|max:20',
          'confirm' => 'required|min:6|max:20',
          'address' => 'required|min:3|max:191',
          'phone' => 'required|max:30'
        ];
        $validator = Validator::make($request->all(), $rule);
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }
        if ($request->password != $request->confirm) {
            return redirect()->back()->with('fail', 'Mật khẩu không khớp')->withInput();
        }
        Customers::where('id', Auth::guard('customer')->user()->id)
          ->update([
            'password' => bcrypt($request->password),
            'address' => $request->address,
            'phone' => $request->phone,
          ]);
        return redirect()->route('profile')->with('modalSuccess', 'Sửa thông tin thành công');
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
        
        $products = $this->business->getAllProduct()->take(12);
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
        if ($request->input == "") {
            return redirect()->back()->with(['modalFail' => 'Bạn cần nhập từ khóa để tìm kiếm']);
        }
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
