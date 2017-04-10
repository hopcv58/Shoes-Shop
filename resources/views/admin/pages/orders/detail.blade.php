@extends('admin.layout.master')
@section('title')
    Order Detail
@endsection
@section('content')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            {{--         <h1>
                         Dashboard
                         <small>Version 2.0</small>
                     </h1>--}}
            <div>
                <ol class="breadcrumb">
                    <li><a href="{{route('admin.homepage')}}"><i class="fa fa-dashboard"></i> Home</a></li>
                    <li class="active">Dashboard</li>
                </ol>
            </div>

        </section>


        <!-- Main content -->
        <section class="invoice">
            <!-- title row -->
            <div class="row">
                <div class="col-xs-12">
                    <h2 class="page-header">
                        <i class="fa fa-globe"></i> AdminLTE, Inc.
                        <small class="pull-right">Date: {{\Carbon\Carbon::now('Asia/Ho_Chi_Minh')->format('l jS F Y')}}</small>
                    </h2>
                </div>
                <!-- /.col -->
            </div>
            <!-- info row -->
            <div class="row invoice-info">
                <div class="col-sm-4 invoice-col">
                    From
                    <address>
                        <strong>Admin, Inc.</strong><br>
                        Vân Đồn, Hai Bà Trưng, Hà Nội<br>
                        Phone: {{\Illuminate\Support\Facades\Auth::user()->phone}}<br>
                        Email: {{\Illuminate\Support\Facades\Auth::user()->email}}
                    </address>
                </div>
                <!-- /.col -->
                <div class="col-sm-4 invoice-col">
                    To
                    <address>
                        <strong>{{$customer_name}}</strong><br>
                        Address: {{$customer_address}}<br>
                        Phone: {{$customer_phone}}<br>
                        Email: {{$customer_email}}
                    </address>
                </div>
                <!-- /.col -->
                <div class="col-sm-4 invoice-col">
                    <b>Invoice: {{$order_id->code}}</b><br>
                    <br>
                    <b>Order ID:</b> {{$order_id->id}}<br>
                    <b>Ngày tạo:</b> {{date_format($order_id->created_at, 'd-m-Y')}}<br>
                </div>
                <!-- /.col -->
            </div>
            <!-- /.row -->

            <!-- Table row -->
            <div class="row">
                <div class="col-xs-12 table-responsive">
                    <table class="table table-striped">
                        <thead>
                        <tr>
                            <th>Qty</th>
                            <th>Product</th>
                            <th>Alias</th>
                            <th>Description</th>
                            <th>Subtotal</th>
                        </tr>
                        </thead>
                        <tbody>
                        @if($product_id != null)
                            @foreach($product_id as $pid)
                        <tr>
                            <td>{{$pid->qty}}</td>
                            <td>{{$pid->products->name}}</td>
                            <td>{{$pid->products->alias}}</td>
                            <td>{{$pid->products->description}}</td>
                            <td>${{($pid->qty)*($pid->products->price)}}</td>
                        </tr>
                            @endforeach
                        @else
                            <tr>Không có sản phẩm nào trong đơn hàng</tr>
                        @endif
                        </tbody>
                    </table>
                </div>
                <!-- /.col -->
            </div>
            <!-- /.row -->

            <div class="row">
                <!-- accepted payments column -->
                <div class="col-xs-6">
                    <p class="lead">Payment Methods:</p>
                    <p>{{$order_id->payment}}</p>

                    <p class="text-muted well well-sm no-shadow" style="margin-top: 10px;">
                   {{$order_id->payment_info}}
                    </p>
                </div>
                <!-- /.col -->
                <div class="col-xs-6">

                    <div class="table-responsive">
                        <table class="table">
                            <tr>
                                <th style="width:50%">Subtotal:</th>
                                <td>${{$order_id->total}}</td>
                            </tr>
                            <tr>
                                <th>Shipping:</th>
                                <td>$0</td>
                            </tr>
                            <tr>
                                <th>Total:</th>
                                <td>${{$order_id->total}}</td>
                                @if($order_id->status == 1)
                                    <td class="label label-primary">Đã Thanh Toán</td>
                                @else
                                    <td class="label label-danger">Chưa Thanh Toán</td>
                                @endif
                            </tr>
                        </table>
                    </div>
                </div>
                <!-- /.col -->
            </div>
            <!-- /.row -->
        </section>
        <!-- /.content -->
        <div class="clearfix"></div>
    </div>
@endsection

@section('script')
    <script>
        $(document).ready(function () {
            $(".textarea").wysihtml5();
            $('input').iCheck({
                checkboxClass: 'icheckbox_square-blue',
                radioClass: 'iradio_square-blue',
                increaseArea: '20%' // optional
            });
        });
    </script>
@endsection