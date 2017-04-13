<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Mail\orderMail;
use App\Responsitory\Business;
use App\Responsitory\Orders;
use App\Responsitory\productOrder;
use App\Responsitory\Products;
use Cart as Cart;
use Illuminate\Http\Request;
use Illuminate\Mail\Mailer;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;

class UserOrderController extends Controller
{
    private $business;
    
    function __construct()
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
        $productList = [];
        foreach (Cart::content() as $item) {
            $product = Products::find($item->id);
            $productList[ $item->id ] = $product;
        }
        return view('user.order', compact('productList'));
    }
    
    /**
     * @param Request $request
     * @return mixed
     */
    public function store(Request $request, Mailer $mailer)
    {
        try {
            $order = new Orders();
            $rule = [
              'username' => 'required|max:30',
              'payment' => 'required|max:30|in:paypal,free ship',
              'email' => 'email|min:3|max:50',
              'address' => 'required|min:3|max:191',
              'phone' => 'required|max:30',
              'note' => 'max:500'
            ];
            $validator = Validator::make($request->all(), $rule);
            if ($validator->fails()) {
                return redirect()->back()->withErrors($validator)->withInput();
            }
            $order->payment = $request->payment;
            $order->status = 0;
            $order->total = str_replace(",", "", Cart::instance('default')->subtotal());
            $order->note = $request->note;
            if (!Auth::guard('customer')->guest()) {
                $order->customer_id = Auth::guard('customer')->user()->id;
                $order->username = $request->input('username') ? $request->input('username') : Auth::guard('customer')->user()->username;
                $order->email = $request->input('email') ? $request->input('email') : Auth::guard('customer')->user()->email;
                $order->phone = $request->input('phone') ? $request->input('phone') : Auth::guard('customer')->user()->phone;
                $order->address = $request->input('address') ? $request->input('address') : Auth::guard('customer')->user()->address;
            } else {
                $order->username = $request->input('username');
                $order->email = $request->input('email');
                $order->phone = $request->input('phone');
                $order->address = $request->input('address');
            }
            $order->save();
            $order_products = [];
            foreach (Cart::content() as $item) {
                $product = $this->business->getProductById($item->id);
                $productOrder = new productOrder();
                $productOrder->product_id = $product->id;
                $productOrder->qty = $item->qty;
                $productOrder->attribute = json_encode($item->options);
                $productOrder->status = 0;
                $productOrder->order_id = $order->id;
                $productOrder->save();
                $order_products[] = $productOrder;
            }
//            dd($order);
            $mail_to = $request->input('email');
            $mailer->to($mail_to)->send(new orderMail($order, $order_products));
            Cart::destroy();
            return Redirect::back()->with(['success' => 'Cảm ơn bạn đã lựa chọn chúng tôi. Bạn hãy check mail để kiểm tra đơn hàng. Chúng tôi sẽ liên hệ với bạn trong thời gian sớm nhất']);
        } catch (Exception $ex) {
            dd($ex->getMessage());
        }
    }
    
    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function showAll()
    {
        $orders = [];
        if (Auth::guard('customer')->guest()) {
            return view('user.showOrder', compact('orders'));
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
