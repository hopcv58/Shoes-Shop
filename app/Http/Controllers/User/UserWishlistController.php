<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Cart as Cart;
use Illuminate\Http\Request;
use Validator;
use App\Responsitory\Products;

class UserWishlistController extends Controller
{
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products = [];
        foreach (Cart::instance('wishlist')->content() as $item)
        {
            $product = Products::find($item->id);
            $products[$item->id] = $product;
        }
        return view('user.wishlist',compact('products'));
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
            return $cartItem->id === $request->id;
        });
        
        if (!$duplicates->isEmpty()) {
            return redirect(url()->previous())->withErrorMessage('Item is already in your wishlist!');
        }
        
        Cart::add($request->id, $request->name, 1, $request->price,
          ['color' => $request->color, 'size' => $request->size])->associate('App\Responsitory\Products');
        return redirect(url()->previous())->withSuccessMessage('Item was added to your wishlist!');
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
        return redirect('wishlist')->withSuccessMessage('Item has been removed!');
    }
    
    /**
     * Remove the resource from storage.
     *
     * @return \Illuminate\Http\Response
     */
    public function emptyWishlist()
    {
        Cart::instance('wishlist')->destroy();
        return redirect('wishlist')->withSuccessMessage('Your wishlist has been cleared!');
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
        $duplicates = Cart::search(function ($cartItem, $rowId) use ($id) {
            return $cartItem->id === $id;
        });
        
        if (!$duplicates->isEmpty()) {
            return redirect(url()->previous())->withErrorMessage('Item is already in your cart!');
        }
        Cart::instance('default')->add($item->id, $item->name, 1, $item->price, $item->options->toArray())
          ->associate('App\Responsitory\Products');
        
        return redirect('wishlist')->withSuccessMessage('Item has been moved to your shopping cart!');
        
    }
}
