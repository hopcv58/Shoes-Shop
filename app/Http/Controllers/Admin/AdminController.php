<?php

namespace App\Http\Controllers\Admin;


use App\Responsitory\Business;
use App\Responsitory\Categories;
use App\Responsitory\Customers;
use App\Responsitory\Feedbacks;
use App\Responsitory\Orders;
use App\Responsitory\productOrder;
use App\Responsitory\Products;
use App\Responsitory\Slides;
use App\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
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
        $total_sale = $this->business->adminGetSale();
        $total_orders = $this->business->adminGetAllOrders();
        $total_products = $this->business->adminGetAllProducts();
        $total_customer = $this->business->adminGetAllCustomer();
        $customers = User::latest()->limit(8)->get();
        $products = Products::latest()->limit(5)->get();
        $product_orders = productOrder::latest()->limit(7)->get();
        $hot_products = productOrder::select('product_id', DB::raw('SUM(qty) as `total_qty`'))
            ->groupBy('product_id')
            ->limit(8)
            ->orderBy('total_qty', 'desc')
            ->get();
//        dd($hot_products);
        return view('admin.pages.index',
            compact('total_sale', 'total_orders', 'total_products', 'total_customer', 'customers', 'products',
                'product_orders', 'hot_products'));
    }

    public function getSale()
    {
        $month = Carbon::now()->month;
        $day = Carbon::now()->day;
        $monthSale = $this->business->adminGetMonthSale($month);
        $daySale = $this->business->adminGetDaySale($day);
        $totalSale = $this->business->adminGetSale();
        $totalQty = $this->business->adminGetQty();
        $dayQty = $this->business->adminGetDayQty($day);
        $monthQty = $this->business->adminGetMonthQty($month);
        $totalOrder = $this->business->adminGetAllOrders();
        $categories = Categories::all();
        $products_cate = $this->business->adminGetAllProductsFromCategories();
        $products_qty = $this->business->adminGetProductQuantity();
        $order_under_1M = Orders::where('total', '<', 1000000)->count();
        $order_over_2M = Orders::where('total', '>', 2000000)->count();
        $order_beetween_1M_2M = Orders::where('total', '>', 1000000)->where('total', '<' , 2000000)->count();
        return view('admin.pages.orders.thongke',
            compact('monthSale', 'daySale', 'totalSale', 'totalQty', 'dayQty', 'monthQty', 'totalOrder', 'categories',
                'products_cate', 'products_qty', 'order_under_1M', 'order_over_2M', 'order_beetween_1M_2M'));
    }

    public function showCreateSlidesForm()
    {
        return view('admin.pages.news.createSlide');
    }

    public function postSlide(Request $request)
    {
        $path = 'upload/img_news';
        $slides = new Slides();
        $is_public = $request->has('is_public') ? 1 : 0;
        if ($request->hasFile('img_profile')) {
            $name = $this->business->saveImg($request->file('img_profile'), $path);
            $slides->name = $name;
            $slides->is_public = $is_public;
            $slides->save();
        }
        if ($request->hasFile('img')) {
            $names = $this->business->saveManyImg($request->file('img'), $path);
            foreach ($names as $name) {
                $slides = new Slides();
                $slides->name = $name;
                $slides->is_public = $is_public;
                $slides->save();
            }
        }
        return redirect()->back()->with('success', 'upload thành công');
    }

    public function changeFeedbackStatus($id)
    {
        $feedback = Feedbacks::find($id);
        if ($feedback->is_public == 1) {
            $feedback->is_public = 0;
            $feedback->save();
        } else {
            $feedback->is_public = 1;
            $feedback->save();
        }
        return redirect()->back()->with('success', 'Thay đổi trạng thái thành công');
    }

    public function getListSlides()
    {
        $slides = Slides::paginate(5);
        return \view('admin.pages.news.listSlides', compact('slides'));
    }

    public function deleteSlide(Request $request)
    {
        $slide = Slides::find($request->input('slide_id'));
        $slide->delete();
        if (($slide->name != null) && file_exists("upload/img_news/$slide->name")) {
            unlink("upload/img_news/$slide->name");
        }
        return redirect()->back()->with('success', 'Xóa thành công');
    }

    public function slideChangeStatus($id)
    {
        $slide = Slides::find($id);
        $slide->is_public == 0 ? $slide->is_public = 1 : $slide->is_public = 0;
        $slide->save();
        return redirect()->back();
    }

}
