@extends('layouts.user')
@section('content')
    <div class="container">
        @if (sizeof($orders) > 0)
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
                        <td>{{$order->total}}</td>
                        <td>{{$order->status ? "Đã chuyển" : "Chưa chuyển"}}</td>
                        <td>{{$order->created_at}}</td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        @else
            <div class="spacer"></div>
            <h2 class="center-block">Bạn chưa có đơn hàng nào</h2>
        @endif
        <a href="{{route('index')}}" class="btn btn-primary btn-lg">Continue Shopping</a>
    </div>
@endsection