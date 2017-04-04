<?php

namespace App\Responsitory;

use Illuminate\Database\Eloquent\Model;

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

}
