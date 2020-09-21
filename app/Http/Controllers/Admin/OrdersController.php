<?php

namespace App\Http\Controllers\Admin;

use App\Responsitory\Business;
use App\Responsitory\Orders;
use App\Responsitory\productOrder;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class OrdersController extends Controller
{
    private $orders;
    private $business;

    function __construct()
    {
        $this->orders = new Orders();
        $this->business = new Business();
        parent::__construct();
    }

    public function index(Request $request)
    {
        $total_order = $this->business->adminGetAllOrders();
        $order_paid = $this->business->adminTotalOrdersPaid();
        $order_processing = $total_order - $order_paid;
        $search = $request->input('search');
        if ($search == null) {
            $orders = Orders::latest()->orderBy('status')->paginate(5);
            return view('admin.pages.orders.list', compact('total_order', 'order_paid', 'order_processing', 'orders'));
        } else {
            $orders = $this->orders->search($search, 'id', 'code', 5);
            return view('admin.pages.orders.list',
                compact('total_order', 'order_paid', 'order_processing', 'orders', 'search'));
        }
    }

    public function delete(Request $request)
    {
        $order_id = $this->orders->find($request->input('order_id'));
//        dd($request->input('order_id'));
        if ($order_id->delete()) {
            return redirect()->route('admin.orders.index')->with('success', "Xóa thành công hóa đơn $order_id->id");
        } else {
            return redirect()->route('admin.orders.index')->with('fail', "Thất bại");
        }
    }

    public function detailProduct($id)
    {
        $order_id = $this->orders->find($id);
        $product_id = $this->business->adminGetProductFromOrder($id);
        $customer_name = ($order_id->username != null) ? $order_id->username : $order_id->customers->username;
        $customer_address = ($order_id->address != null) ? $order_id->address : $order_id->customers->address;
        $customer_phone = ($order_id->phone != null) ? $order_id->phone : $order_id->customers->phone;
        $customer_email = ($order_id->email != null) ? $order_id->email : $order_id->customers->email;
        return view('admin.pages.orders.detail',
            compact('product_id', 'order_id', 'customer_name', 'customer_email', 'customer_address', 'customer_phone'));
    }

    public  function update($order_id){
        $order_id = $this->orders->find($order_id);
//        dd('aa');
        $product_order = productOrder::where('order_id', $order_id);
        /*$product_order->status == 0 ? $product_order->status = 1 : $product_order->status = 0;
        $product_order->save();*/
        return view('admin.pages.orders.update', compact('order_id', 'product_order'));
    }

    public function postUpdate(Request $request, $id)
    {
        $order_id = $this->orders->find($id);
        $product_orders = $order_id->productOrders;
        $order_id->status = $request->has('status') ? 1 : 0;
        $order_id->note = $request->input('note');
        if($product_orders != null){  //&& ($order_id->payment == 'free ship')
            if($order_id->status == 1) {
                foreach ($product_orders as $product_order) {
                    $product_order->status = 1;
                    $product_order->save();
                }
            }else{
                foreach ($product_orders as $product_order) {
                    $product_order->status = 0;
                    $product_order->save();
                }
            }
        }
        $order_id->save();
        return redirect()->route('admin.orders.index')->with('success', 'cập nhật đơn hàng thành công');
    }

    public function getProductOrders(Request $request){
        $search = $request->input('search');
        $product_order = new productOrder();
        if($search == null) {
            $product_orders = $product_order->latest()->paginate(5);
            return view('admin.pages.orders.productorderindex', compact('product_orders'));
        }else{
            $product_orders = $product_order->search($search,'order_id','product_id', 5);
            return view('admin.pages.orders.productorderindex', compact('product_orders', 'search'));
        }
    }

    public function detail($id)
    {
        $order_id = $this->orders->find($id);
        $status = ($order_id->status == 0) ? 'Chưa thanh toán' : 'đã thanh toán';
        $customer_name = ($order_id->username != null) ? $order_id->username : ($order_id->customers->username);
        $customer_phone = ($order_id->phone != null) ? $order_id->phone : ($order_id->customers->phone);
        $customer_email = ($order_id->email != null) ? $order_id->email : ($order_id->customers->email);
        $customer_address = ($order_id->address != null) ? $order_id->address : ($order_id->customers->address);
        echo "
           <div class='row'>
                <div class='col-md-6'>
                <p>Chi tiết hóa đơn</p>
                      <table class='table table-bordered'>
                          <tr>
                            <td>Mã Giao Dịch: </td>
                             <td>$order_id->id</td>
                          </tr>
                           <tr>
                            <td>Ngày Tạo: </td>
                             <td>$order_id->created_at</td>
                          </tr>
                          <tr>
                          <td>Ghi chú: </td>
                          <td>$order_id->note</td>
                          </tr>
                            <tr><td>Tổng tiền: </td>
                            <td>$order_id->total</td></tr>
                            <tr><td>Hình thức:</td>
                            <td>$order_id->payment</td></tr>
                            <tr><td>Trạng thái: </td>
                            <td>$status</td></tr>
                     </table>
                 </div>
                 
                 <div class='col-md-6'>
                  <p>Thông tin khách hàng</p>
                      <table class='table table-bordered'>
                          <tr>
                            <td>Tên</td>
                             <td>$customer_name</td>
                          </tr>
                           <tr>
                            <td>Điện Thoại</td>
                             <td>$customer_phone</td>
                          </tr>
                          <tr>
                            <td>Email</td>
                             <td>$customer_email</td>
                          </tr>
                          <tr>
                            <td>Địa chỉ</td>
                             <td>$customer_address</td>
                          </tr>
 
                     </table>
                 </div>
              </div>
           ";
    }
}
