<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Responsitory\Orders;
use App\Responsitory\productOrder;
use Cart as Cart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Validator;

class UserOrderController extends Controller
{
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('user.order');
    }
    
    public function store(Request $request)
    {
        try {
            $order = new Orders();

//            $order->name = $request->name;
            $order->payment = $request->payment;
            $order->status = 0;
            $order->total = floatval(Cart::instance('default')->subtotal());
            $order->note = $request->note;
            $order->customer_id = $request->customer_id;
            $order->username = $request->name;
            $order->email = $request->email;
            $order->phone = $request->phone;
            $order->address = $request->address;
            $order->save();
            foreach (Cart::content() as $item) {
                $productOrder = new productOrder();
                $productOrder->product_id = $item->id;
                $productOrder->qty = $item->qty;
                $productOrder->attribute = json_encode($item->options);
                $productOrder->status = 0;
                $productOrder->order_id = $order->id;
                $productOrder->save();
                
            }
            Cart::destroy();
            return Redirect::back();
        } catch (Exception $ex) {
            dd($ex->getMessage());
        }
    }
    
    public function show()
    {
        $orders = [];
        if (Auth::guard('customer')->guest()) {
            return view('user.showOrder',compact('orders'));
        } else {
            $orders = Orders::where('customer_id', Auth::guard('customer')->user()->id)->get();
            return view('user.showOrder', compact('orders'));
        }
    }
//        $productOrders = [];
//        foreach ($orders as $order)
//        {
//            $productOrder = productOrder::where('order_id',$order->id)->get();
//            array_push($productOrders,$productOrder);
//        }
//        return view('user.showOrder',compact('orders','productOrders'));
    
}
