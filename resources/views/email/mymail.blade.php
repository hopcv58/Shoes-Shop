<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>My Mail</title>
</head>
<body>
<h1>Admin Talaha</h1>
<h4>Thông tin đơn hàng của bạn</h4>
<div class="row">
    <table class="table table-bordered col-md-6">
        <tr>
            <td>Mã đơn hàng:</td>
            <td>{{$order->id}}</td>
        </tr>
        <tr>
            <td>Tên khách hàng:</td>
            <td>{{ ($order->customer_id == null) ? $order->username : $order->customers->username }}</td>
        </tr>
        <tr>
            <td>Phương thức thanh toán:</td>
            <td>{{$order->payment}}</td>
        </tr>
        <tr>
            <td>Địa chỉ:</td>
            <td>{{ ($order->customer_id == null) ? $order->address : $order->customers->address }}</td>
        </tr>
        <tr>
            <td>Điện thoại:</td>
            <td>{{ ($order->customer_id == null) ? $order->phone : $order->customers->phone }}</td>
        </tr>
    </table>
    <table class="table table-bordered col-md-6">
        <tr>
            <td>Tên sản phẩm</td>
            <td>Số lượng</td>
            <td>Giá bán</td>
            <td>Giám giá</td>
            <td>Giá khuyến mãi</td>
        </tr>
        @foreach($order_products as $order_product)
            <tr>
                <td>{{$order_product->products->name}}</td>
                <td>{{$order_product->qty}}</td>
                <td>{{$order_product->products->price}}</td>
                <td><span class="label label-danger">{{($order_product->products->ad_id != null) ? $order_product->products->advertisments->discount : 0}}
                        %</span></td>
                <?php $a = ($order_product->products->ad_id != null) ? ($order_product->products->price * (1 - ($order_product->products->advertisments->discount) / 100)) : $order_product->products->price; ?>
                <td>{{number_format($a)}}</td>
            </tr>
        @endforeach
    </table>
    <span class="label label-danger"><h4>Tổng giá trị đơn hàng: {{number_format($order->total)}} vnđ</h4></span>
</div>
<h4>Cám ơn bạn đã mua hàng tại Talaha!</h4>
<h4>Chúng tôi sẽ liên lạc với bạn ngay sau đó</h4>
</body>
</html>