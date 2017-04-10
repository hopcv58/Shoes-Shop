<?php

namespace App\Responsitory;

use Illuminate\Http\Request;
use Illuminate\Http\UploadedFile;

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
    public function saveImg(UploadedFile $img, $path)
    {
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
            if (!in_array($ext, $arr_ext) || $img->getClientSize() > 500000) {
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
            $this->products->name = $data[ 'name' ];
            $this->products->code = $data[ 'code' ];
            $this->products->alias = $data[ 'alias' ];
            $this->products->description = $data[ 'description' ];
            $this->products->phoi_do = $data[ 'phoi_do' ];
            $this->products->ad_id = $data[ 'ad_id' ];
            $this->products->price = $data[ 'price' ];
            $this->products->attribute = $data[ 'attribute' ];
            $this->products->img_profile = $data[ 'img_profile' ];
            $this->products->img = $data[ 'img' ];
            $this->products->is_public = $data[ 'is_public' ];
            $this->products->save();
            foreach ($cates as $cate) {
                $this->products->productCate()->create(["cate_id" => $cate]);
            }
            return true;
        } catch (\Exception $ex) {
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

//   ==================================User function===================================================
    
    public function getCateById($cate_id)
    {
        $cate = categories::where('id', $cate_id)->first();
        return $cate;
    }
    
    public function getAllProduct()
    {
        $products = products::where('is_public',1)->latest()->get();
        return $products;
    }
    
    public function getAllCate()
    {
        $category = categories::where('is_public',1)->latest()->get();
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
          ->whereIn('products.id', $arr_product)->where('is_public',1)->latest()->get();
//        dd($product_list);
        return $product_list;
        
    }
    
    public function getProductById($id)
    {
        $product = products::where('id', $id)->first();
        return $product;
    }
    
    public function getProductOption($id)
    {
        $product = products::where('id', $id)->first();
        $json = json_decode($product->attribute, true);
        $option = [];
        $row = (count($json, COUNT_RECURSIVE) - count($json)) / 5;              // 5 is number of attribute
        for ($i = 0; $i < $row; $i++) {
            foreach ($json as $key => $value) {
                $option[ $i ][ $key ] = $json[ $key ][ $i ];
            }
        }
        
        return $option;
    }
    
    public function getCommentByProduct($product_id)
    {
        $comment = comments::join('customers', 'comments.customer_id', '=', 'customers.id')->where([
          ['commentable_id', '=', $product_id],
          ['commentable_type', '=', 'App\Responsitory\Products'],
        ])->get();
        return $comment;
    }
    
    public function getNewsById($id)
    {
        $news = news::where('id', $id)->where('is_public',1)->first();
        return $news;
    }
    public function getAllNews(){
        $news = news::where('is_public',1)->get();
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
        $related = news::where('id', '<>', $id)->where('is_public',1)->get()->shuffle()->take(4);
        return $related;
    }
    
    public function searchNews($input)
    {
        $news = news::where('title', 'like', '%' . $input . '%')->where('is_public',1)->get();
        return $news;
    }
    
    public function searchCategories($input)
    {
        $categories = categories::where('name', 'like', '%' . $input . '%')->where('is_public',1)->get();
        return $categories;
    }
    
    public function searchProducts($input)
    {
        $products = products::where('name', 'like', "%$input%")->where('is_public',1)->get();
        return $products;
    }
    public function  getFeedback()
    {
        $feedbacks = Feedbacks::where('is_public',1)->get()->shuffle()->take(6);
        return $feedbacks;
    }
    public function  getSlide()
    {
        $slides = Slides::where('is_public',1)->get();
        return $slides;
    }
    
}
