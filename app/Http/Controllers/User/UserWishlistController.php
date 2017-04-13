<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Responsitory\Business;
use App\Responsitory\Products;
use Cart as Cart;
use Illuminate\Http\Request;
use Validator;

class UserWishlistController extends Controller
{
    private $business;
    
    public function __construct()
    {
        $this->business = new Business();
    }
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products = [];
        foreach (Cart::instance('wishlist')->content() as $item) {
            $product = Products::find($item->id);
            $products[ $item->id ] = $product;
        }
        return view('user.wishlist', compact('products'));
    }
    
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $duplicates = Cart::instance('wishlist')->search(function ($cartItem, $rowId) use ($request) {
            return ($cartItem->rowId == $request->id || $cartItem->id == $request->id);
        });
        if (!$duplicates->isEmpty()) {
            return redirect(url()->previous())->with(['modalFail' => 'Sản phẩm đã tồn tại trong danh sách yêu thích']);
        }
        $product = $this->business->getProductById($request->id);
        if (isset($product)) {
            if (isset($product->advertisments)) {
                $product->price = $product->price * (100 - $product->advertisments->discount) / 100;
            }
            $product->color = array_unique(json_decode($product->attribute)->color)[ 0 ];
            $product->size = array_unique(json_decode($product->attribute)->size)[ 0 ];
            Cart::add($product->id, $product->name, 1, $product->price,
              ['color' => $product->color, 'size' => $product->size])->associate('App\Responsitory\Products');
            return redirect(url()->previous())->with(['modalSuccess' => 'Thêm vào mục yêu thích thành công']);
        } else {
            return redirect(url()->previous())->with(['modalFail' => 'LỖI! Hãy chọn đúng sản phẩm']);
        }
    }
    
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }
    
    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Cart::instance('wishlist')->remove($id);
        return redirect('wishlist')->with(['success' => 'Xóa khỏi mục yêu thích thành công']);
    }
    
    /**
     * Remove the resource from storage.
     *
     * @return \Illuminate\Http\Response
     */
    public function emptyWishlist()
    {
        Cart::instance('wishlist')->destroy();
        return redirect('wishlist')->with(['success' => 'Làm rỗng mục yêu thích thành công']);
    }
    
    /**
     * Switch item from wishlist to shopping cart.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function switchToCart($id)
    {
        $item = Cart::instance('wishlist')->get($id);
        Cart::instance('wishlist')->remove($id);
        
        $duplicates = Cart::instance('default')->search(function ($cartItem, $rowId) use ($id) {
            return ($cartItem->rowId == $id || $cartItem->id == $id);
        });
        if (!$duplicates->isEmpty()) {
            return redirect(url()->previous())->with(['fail' => 'Sản phẩm đã tồn tại trong giỏ hàng']);
        }
        Cart::instance('default')->add($item->id, $item->name, 1, $item->price, $item->options->toArray())
          ->associate('App\Responsitory\Products');
        return redirect('wishlist')->with(['success' => 'Chuyển sang giỏ hàng thành công']);
        
    }
}
