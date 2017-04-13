<?php

namespace App\Responsitory;

use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

/**
 * contain all Business logic
 * Class Business
 * @package App\Responsitory
 */
class Business // extends Model
{
    private $categories;
    private $comments;
    private $customer;
    private $products;
    private $news;
    private $feedbacks;
    private $orders;
    private $productCates;
    private $productOrder;
    private $slides;
    private $advertisments;
    
    public function __construct()
    {
        $this->categories = new Categories();
        $this->comments = new Comments();
        $this->customer = new Customers();
        $this->feedbacks = new Feedbacks();
        $this->news = new News();
        $this->orders = new Orders();
        $this->productCates = new productcate();
        $this->productOrder = new productOrder();
        $this->products = new Products();
        $this->slides = new Slides();
        $this->advertisments = new Advertisments();
    }
    
    public function getCate()
    {
        return $this->categories->index();
    }
    
    /**
     * @param UploadedFile $img
     * @param string $path
     * @return null|string Ten file img upload
     */
    public function saveImg($img, $path)
    {
        if ($img == null) {
            return null;
        }
        $err = null;
        $name = $img->getClientOriginalName();
        $ext = $img->getClientOriginalExtension();
        //kiem tra file trung ten
        while (file_exists($path . '/' . $name)) {
            $name = str_random(5) . "_" . $name;
        }
        $arr_ext = ['png', 'jpg', 'gif', 'jpeg'];
        if (!in_array($ext, $arr_ext) || $img->getClientSize() > 500000) {
            $name = null;
            return redirect()->back()->with('not_img', 'Chọn file ảnh png jpg gif jpeg có kích thước < 5Mb');
        } else {
            $img->move($path, $name);
        }
        return $name;
    }
    
    /**
     * upload nhieu anh
     * @param array $imgs
     * @param string $path
     * @return array|\Illuminate\Http\RedirectResponse
     */
    public function saveManyImg($imgs, $path)
    {
        $names = [];
        if ($imgs == null) {
            return null;
        }
        foreach ($imgs as $img) {
            $err = null;
            $name = $img->getClientOriginalName();
            $ext = $img->getClientOriginalExtension();
            //kiem tra file trung ten
            while (file_exists($path . '/' . $name)) {
                $name = str_random(5) . "_" . $name;
            }
            $arr_ext = ['png', 'jpg', 'gif', 'jpeg'];
            if (!in_array($ext, $arr_ext)) {
                $names = null;
                return redirect()->back()->with('not_img', 'Chọn file ảnh png jpg gif jpeg có kích thước < 5Mb');
            } else {
                $img->move($path, $name);
                $names[] = $name;
            }
        }
        return $names;
    }
    
    /**
     * @param array $data
     * @param array $cates
     * @return bool|null
     */
    public function adminCreateProduct($data, $cates)
    {
        if ($data == null) {
            return null;
        }
        try {

            $this->products->name           = $data['name'];
            $this->products->code           = $data['code'];
            $this->products->alias          = $data['alias'];
            $this->products->description    = $data['description'];
            $this->products->phoi_do        = $data['phoi_do'];
            $this->products->ad_id          = $data['ad_id'];
            $this->products->price          = $data['price'];
            $this->products->attribute      = $data['attribute'];
            $this->products->img_profile    = $data['img_profile'];
            $this->products->img            = $data['img'];
            $this->products->is_public      = $data['is_public'];
            $this->products->height         = $data['height'];
            $this->products->material       = $data['material'];
            $this->products->save();
            foreach ($cates as $cate) {
                $this->products->productCate()->create(["cate_id" => $cate]);
            }
            return true;
        } catch (Exception $ex) {
            return false;
        }
    }
    
    /**
     * Lấy toàn bộ danh mục sản phẩm của 1 sản phẩm
     * @param integer $product_id
     * @return array
     */
    public function adminGetProductCate($product_id)
    {
        $cate_ids = $this->productCates->select('cate_id')->where('product_id', $product_id)->get();
        $arr_cate = [];
        if ($cate_ids != null) {
            foreach ($cate_ids as $cate_id) {
                $arr_cate[] = $cate_id->cate_id;
            }
        }
        return $arr_cate;
    }
    
    /**
     * lấy toàn bộ sản phẩm từ 1 danh mục
     * @param $cate_id
     * @return array|null
     */
    public function adminGetAllProductsFromCate($cate_id)
    {
        $product_ids = $this->productCates->select('product_id')->where('cate_id', $cate_id)->get();
        $arr_product = [];
        if ($product_ids == null) {
            return null;
        }
        foreach ($product_ids as $product_id) {
            $arr_product[] = $product_id->product_id;
        }
        
        return $arr_product;
    }
    
    /**
     * Trả về thuộc tính của một product
     * @param integer $product_id
     * @return array
     */
    public function adminGetProductAttribute($product_id)
    {
        $product = $this->products->findOrFail($product_id);
        $cates = Categories::select('id', 'name')->get();
        $advers = Advertisments::select('id', 'name')->get();
        $product_cate = $this->adminGetProductCate($product_id);
        $attribute = $product->attribute;
        $imgs = $product->img;
        $arr_img = json_decode($imgs);
        $arr_att = json_decode($attribute);
        return compact('product', 'cates', 'advers', 'product_cate', 'arr_img', 'arr_att');
    }


    /**
     * lưu thông tin 1 quảng cáo cho các sản phẩm
     * @param array $data
     * @param array $product_ids
     * @return bool
     */
    public function adminStoreAd($data, $product_ids)
    {
        try {
            $this->advertisments->name = $data[ 'name' ];
            $this->advertisments->detail = $data[ 'detail' ];
            $this->advertisments->start_date = $data[ 'start_date' ];
            $this->advertisments->end_date = $data[ 'end_date' ];
            $this->advertisments->discount = $data[ 'discount' ];
            $this->advertisments->save();
            if ($product_ids != null) {
                foreach ($product_ids as $product_id) {
                    $pd_id = $this->products->find($product_id);
                    $pd_id->advertisments()->associate($this->advertisments);
                    $pd_id->save();
                }
            }
            return true;
        } catch (\Exception $exception) {
            return false;
        }
    }
    
    /**
     * Cập nhật thông tin quảng cáo theo id
     * @param array $data
     * @param integer $id
     * @param array $product_ids
     * @return bool
     */
    public function adminUpdateAdById($data, $id, $product_ids)
    {
        try {
            $ad_id = $this->advertisments->findOrFail($id);
            $ad_id->name = $data[ 'name' ];
            $ad_id->detail = $data[ 'detail' ];
            $ad_id->start_date = $data[ 'start_date' ];
            $ad_id->end_date = $data[ 'end_date' ];
            $ad_id->discount = $data[ 'discount' ];
            $ad_id->save();
            if ($product_ids != null) {
                foreach ($product_ids as $product_id) {
                    $pd_id = $this->products->find($product_id);
                    $pd_id->advertisments()->associate($ad_id);
                    $pd_id->save();
                }
            }
            return true;
        } catch (\Exception $exception) {
            return false;
        }
    }
    
    /**
     * Lấy toàn bộ sản phẩm
     * @return mixed
     */
    public function adminGetAllProducts()
    {
        return $this->products->count();
    }
    
    /**
     * Lấy toàn bộ order
     * @return mixed
     */
    public function adminGetAllOrders()
    {
        return $this->orders->count();
    }
    
    /**
     * Lấy toàn bộ khách hàng
     * @return mixed
     */
    public function adminGetAllCustomer()
    {
        return $this->customer->count();
    }
    
    /**
     * Tổng doanh thu
     * @return mixed
     */
    public function adminGetSale()
    {
        return $this->orders->where('status', 1)->sum('total');
    }
    
    /**
     * Tổng các hóa đơn đã thanh toán
     * @return mixed
     */
    public function adminTotalOrdersPaid()
    {
        return $this->orders->where('status', 1)->count();
    }
    
    /**
     * Lấy tất cả các sản phẩm từ 1 hóa đơn
     * @param integer $order_id
     * @return array|null
     */
    public function adminGetProductFromOrder($order_id)
    {
        $product_orders = $this->productOrder->where('order_id', $order_id)->get();
        return $product_orders;
    }
    
    /**
     * Doanh thu theo thang
     * @param integer $month
     * @return mixed
     */
    public function adminGetMonthSale($month)
    {
//        $month = Carbon::now()->month;
        return DB::table('orders')->where('status', 1)->whereMonth('created_at', $month)->sum('total');
    }
    
    public function adminGetQty()
    {
        return $this->productOrder->where('status', 1)->sum('qty');
    }
    
    public function adminGetMonthQty($month)
    {
        return $this->productOrder->where('status', 1)->whereMonth('created_at', $month)->sum('qty');
    }
    
    public function adminGetDayQty($day)
    {
        return $this->productOrder->where('status', 1)->whereDay('created_at', $day)->sum('qty');
    }
    
    public function adminGetDaySale($day)
    {
        return DB::table('orders')->whereDay('updated_at', $day)->where('status', 1)->sum('total');
    }
    
    /**
     * Trả về mảng số lượng từng sản phẩm
     * @return array
     */
    public function adminGetProductQuantity()
    {
        $products = $this->products->all();
        $arr = [];
        foreach ($products as $product) {
            $arr_att = json_decode($product->attribute);
            $arr[ $product->id ] = ($arr_att != null) ? array_sum($arr_att->qty) : 0;
        }
        return $arr;
    }

    /**
     * Lấy toàn bộ sản phẩm từ 1 thể loại
     * @return array
     */
    public function adminGetAllProductsFromCategories(){
        $categories = $this->categories->all();
        if($categories == null){
            return null;
        }
        $products_cate = [];
        foreach ($categories as $category){
            $products_cate[$category->id] = productcate::where('cate_id', $category->id)->get();
//            dd($products_cate);
        }
//        dd($products_cate);
        return $products_cate;
    }

    //   ==================================User function===================================================
    public function getCateById($cate_id)
    {
        $cate = categories::where('id', $cate_id)->first();
        return $cate;
    }
    
    public function getAllProduct()
    {
        $products = products::where('is_public', 1)->latest()->get();
        return $products;
    }
    
    public function getAllCate()
    {
        $category = categories::where('is_public', 1)->latest()->get();
        return $category;
    }
    
    public function getProductByCate($cate_id)
    {
        $product_ids = productcate::where('cate_id', $cate_id)->get();
        $arr_product = [];
        foreach ($product_ids as $value) {
            $arr_product[] = $value->product_id;
        }
        $product_list = $this->products
          ->whereIn('products.id', $arr_product)->where('is_public', 1)->latest()->paginate(12);
//        dd($product_list);
        return $product_list;
        
    }
    
    public function getProductById($id)
    {
        $product = products::where('id', $id)->where('is_public',1)->first();
        return $product;
    }
//
//    public function checkProductAvailable($product_id,$color,$size)
//    {
//        $product = products::where('id', $product_id)->first();
//        //check còn hàng (availavle)
//        $json = json_decode($product->attribute, true);
//        $sizes = array_keys($json['size'], $size);
//        $colors = array_keys($json['color'], $color);
//        if(current(array_intersect($sizes,$colors))=== false){
//            return 0;
//        }
//        else {
//            return $json['qty'][current(array_intersect($sizes,$colors))];
//        }
//    }
//
    public function getCommentByProduct($product_id)
    {
        $comment = comments::join('customers', 'comments.customer_id', '=', 'customers.id')->where([
          ['commentable_id', '=', $product_id],
          ['commentable_type', '=', 'App\Responsitory\Products'],
        ])->get();
        return $comment;
    }
    
    public function getProductRelated($product_id)
    {
        $categories = productcate::where('product_id',$product_id)->get();
        $related = [];
        foreach ($categories as $cate)
        {
            $related[] = $this->getProductByCate($cate->cate_id);
        }
        return ($related[array_rand($related)]->shuffle()->take(4));
    }
    
    public function getNewsById($id)
    {
        $news = news::where('id', $id)->where('is_public', 1)->first();
        return $news;
    }
    
    public function getAllNews()
    {
        $news = news::where('is_public', 1)->get();
        return $news;
    }
    
    public function getCommentByNews($news_id)
    {
        $comments = comments::where([
          ['commentable_id', '=', $news_id],
          ['commentable_type', '=', 'App\Responsitory\News'],
        ])->get();
        return $comments;
    }
    
    public function getRandomNews($id)
    {
        $related = news::where('id', '<>', $id)->where('is_public', 1)->get()->shuffle()->take(4);
        return $related;
    }
    
    public function searchNews($input)
    {
        $news = news::where('title', 'like', '%' . $input . '%')->where('is_public', 1)->get();
        return $news;
    }
    
    public function searchCategories($input)
    {
        $categories = categories::where('name', 'like', '%' . $input . '%')->where('is_public', 1)->get();
        return $categories;
    }
    
    public function searchProducts($input)
    {
        $products = products::where('name', 'like', "%$input%")->where('is_public', 1)->get();
        return $products;
    }
    
    public function getFeedback()
    {
        $feedbacks = Feedbacks::where('is_public', 1)->get()->shuffle()->take(6);
        return $feedbacks;
    }
    
    public function getSlide()
    {
        $slides = Slides::where('is_public', 1)->get();
        return $slides;
    }
    
    public function saveFeedback(Request $request)
    {
        try {
            $feedback = new Feedbacks();
//            $order->name = $request->name;
            $feedback->content = $request->input('content');
            if (!isset(Auth::guard('customer')->user()->id)) {
                $feedback->username = $request->username;
                $feedback->email = $request->email;
                $feedback->phone = $request->phone;
            } else {
                $feedback->customer_id = Auth::guard('customer')->user()->id;
                $feedback->username = Auth::guard('customer')->user()->username;
                $feedback->email = Auth::guard('customer')->user()->email;
                $feedback->phone = Auth::guard('customer')->user()->phone;
            }
            $feedback->is_public = 0;
            $feedback->save();
        } catch (Exception $ex) {
            dd($ex->getMessage());
        }
    }
}
