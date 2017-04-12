@extends('layouts.user')
@section('content')
    <div class="container">
        <h3 class="Bold">Chi tiết tài khoản và Lịch sử đặt hàng</h3>
        <h4 class="Bold" style="margin-top: 30px; margin-bottom: 30px;">Đơn hàng của bạn</h4>
        @if (sizeof($orders) == 0)
            <p class="Bold">Bạn không đặt bất kỳ đơn hàng nào</p>
        @else
            <table class="table table-hover card">
                <tbody>
                <tr class="active header">
                    <th>Người nhận</th>
                    <th>Payment</th>
                    <th class="col-md-3">Address</th>
                    <th>Phone</th>
                    <th>Total</th>
                    <th>Status</th>
                    <th>Date</th>
                </tr>
                @foreach($orders as $order)
                    <tr>
                        <td>{{$order->username}}</td>
                        <td>{{$order->payment}}</td>
                        <td>{{$order->address}}</td>
                        <td>{{$order->phone}}</td>
                        <td>{{number_format($order->total)}} đ</td>
                        <td>{{$order->status ? "Đã chuyển" : "Chưa chuyển"}}</td>
                        <td>{{$order->created_at}}</td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        @endif
    </div>
@endsection