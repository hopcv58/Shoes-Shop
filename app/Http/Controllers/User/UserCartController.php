<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Cart as Cart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Validator;
use App\Responsitory\Products;
use App\Responsitory\Business;

class UserCartController extends Controller
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
        foreach (Cart::content() as $item)
        {
            $product = Products::find($item->id);
            $products[$item->id] = $product;
        }
        return view('user.cart',compact('products'));
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
            return $cartItem->id === $request->id;
        });
        
        if (!$duplicates->isEmpty()) {
            return redirect(url()->previous())->with(['modalFail' => 'Item alredy in your cart']);
        }
        //add to Cart
        Cart::add($request->id, $request->name, 1, $request->price,
          ['color' => $request->color, 'size' => $request->size])->associate('App\Responsitory\Products');
        return redirect(url()->previous())->with(['modalSuccess' => 'Item added to your cart!']);
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
            session()->flash('fail', 'Quantity must be between 1 and 5.');
            return response()->json(['success' => false]);
        }
        
        Cart::update($id, $request->quantity);
        session()->flash('success', 'Quantity was updated successfully!');
        
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
        return redirect('cart')->with(['success' => 'Delete item successfully']);
    }
    
    /**
     * Remove the resource from storage.
     *
     * @return \Illuminate\Http\Response
     */
    public function emptyCart()
    {
        Cart::destroy();
        return redirect('cart')->with(['success' => 'Your cart has been cleared']);
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
            return $cartItem->id === $id;
        });
        
        if (!$duplicates->isEmpty()) {
            return redirect(url()->previous())->with(['fail' => 'Item alredy in your wishlist']);
        }
        
        Cart::instance('wishlist')->add($item->id, $item->name, 1, $item->price, $item->options->toArray())
          ->associate('App\Responsitory\Products');
        
        return redirect('cart')->with(['success' => 'Item moved to your wishlist']);
        
    }
}
