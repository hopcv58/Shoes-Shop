<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Responsitory\Business;
use App\Responsitory\Products;
use Cart as Cart;
use Illuminate\Http\Request;
use Validator;

class UserCartController extends Controller
{
    private $business;
    
    public function __construct()
    {
        $this->business = new Business();
        parent::__construct();
    }
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products = [];
        foreach (Cart::content() as $item) {
            $product = Products::find($item->id);
            $products[ $item->id ] = $product;
        }
        return view('user.cart', compact('products'));
    }
    
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //check duplicate
        $duplicates = Cart::search(function ($cartItem, $rowId) use ($request) {
            return ($cartItem->rowId == $request->id || $cartItem->id == $request->id);
        });
        
        if (!$duplicates->isEmpty()) {
            return redirect(url()->previous())->with(['modalFail' => 'Sản phẩm đã có trong giỏ hàng']);
        }
        $product = $this->business->getProductById($request->id);
        if (isset($product)) {
            if (isset($product->advertisments)) {
                $product->price = $product->price * (100 - $product->advertisments->discount) / 100;
            }
            $product->color = array_unique(json_decode($product->attribute)->color)[ 0 ];
            $product->size = array_unique(json_decode($product->attribute)->size)[ 0 ];
            //add to Cart
            Cart::add($product->id, $product->name, 1, $product->price,
              ['color' => $product->color, 'size' => $product->size])->associate('App\Responsitory\Products');
            return redirect(url()->previous())->with(['modalSuccess' => 'Thêm vào giỏ hàng thành công!']);
        } else {
            return redirect(url()->previous())->with(['modalFail' => 'LỖI! Đề nghị bạn chọn đúng sản phẩm']);
        }
        
    }
    
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(Request $request, $id)
    {
        // Validation on max quantity
        $validator = Validator::make($request->all(), [
          'quantity' => 'required|numeric|between:1,5'
        ]);
        
        if ($validator->fails()) {
            session()->flash('fail', 'Số lượng phải nằm trong khoảng từ 1-5');
            return response()->json(['success' => false]);
        }
        
        Cart::update($id, $request->quantity);
        
        return response()->json(['success' => true]);
        
    }
    
    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Cart::remove($id);
        return redirect('cart')->with(['success' => 'Xóa thành công!']);
    }
    
    /**
     * Remove the resource from storage.
     *
     * @return \Illuminate\Http\Response
     */
    public function emptyCart()
    {
        Cart::destroy();
        return redirect('cart')->with(['success' => 'Làm rỗng giỏ hàng thành công']);
    }
    
    /**
     * Switch item from shopping cart to wishlist.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function switchToWishlist($id)
    {
        $item = Cart::get($id);
        
        Cart::remove($id);
        
        $duplicates = Cart::instance('wishlist')->search(function ($cartItem, $rowId) use ($id) {
            return ($cartItem->rowId == $id || $cartItem->id == $id);
        });
        
        if (!$duplicates->isEmpty()) {
            return redirect(url()->previous())->with(['fail' => 'Sản phẩm đã có trong mục yêu thích']);
        }
        
        Cart::instance('wishlist')->add($item->id, $item->name, 1, $item->price, $item->options->toArray())
          ->associate('App\Responsitory\Products');
        
        return redirect('cart')->with(['success' => 'Chuyển sang danh sách yêu thích thành công']);
        
    }
}
