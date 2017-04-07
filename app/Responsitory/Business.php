<?php

namespace App\Responsitory;

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
    
    public function getCateById($cate_id)
    {
        $cate = categories::where('id', $cate_id)->get();
        return $cate[ 0 ];
    }
    
    public function getProductById($id)
    {
        $cate = products::where('id', $id)->get();
        return $cate[ 0 ];
    }
    
    public function getProductByCate($cate_id)
    {
        $product_ids = productcate::where('cate_id', $cate_id)->get();
        $arr_product = [];
        foreach ($product_ids as $value) {
            $arr_product[] = $value->product_id;
        }
        $product_list = $this->products->whereIn('id', $arr_product)->get();
        return $product_list;
        
    }
    
    public function getCommentByProduct($product_id)
    {
        $comment = comments::join('customers', 'comments.customer_id', '=', 'customers.id')->where('commentable_id',
          $product_id)->get();
        return $comment;
    }
}
