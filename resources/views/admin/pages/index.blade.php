@extends('admin.layout.master')

@section('title')
    Bảng điều khiển
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
        <section class="content">
            <!-- Info boxes -->
            <div class="row">
                <div class="col-md-3 col-sm-6 col-xs-12">
                    <div class="info-box">
                        <span class="info-box-icon bg-aqua"><i class="fa fa-pencil-square-o"></i></span>

                        <div class="info-box-content">
                            <span class="info-box-text">Tổng số hóa đơn</span>
                            <span class="info-box-number">{{$total_orders}}</span>
                        </div>
                        <!-- /.info-box-content -->
                    </div>
                    <!-- /.info-box -->
                </div>
                <!-- /.col -->
                <div class="col-md-3 col-sm-6 col-xs-12">
                    <div class="info-box">
                        <span class="info-box-icon bg-red"><i class="fa fa-briefcase"></i></span>

                        <div class="info-box-content">
                            <span class="info-box-text">Tổng sản phẩm</span>
                            <span class="info-box-number">{{$total_products}}</span>
                        </div>
                        <!-- /.info-box-content -->
                    </div>
                    <!-- /.info-box -->
                </div>
                <!-- /.col -->

                <!-- fix for small devices only -->
                <div class="clearfix visible-sm-block"></div>

                <div class="col-md-3 col-sm-6 col-xs-12">
                    <div class="info-box">
                        <span class="info-box-icon bg-green"><i class="ion ion-ios-cart-outline"></i></span>

                        <div class="info-box-content">
                            <span class="info-box-text">Tổng doanh thu</span>
                            <span class="info-box-number">{{$total_sale}} $</span>
                        </div>
                        <!-- /.info-box-content -->
                    </div>
                    <!-- /.info-box -->
                </div>
                <!-- /.col -->
                <div class="col-md-3 col-sm-6 col-xs-12">
                    <div class="info-box">
                        <span class="info-box-icon bg-yellow"><i class="ion ion-ios-people-outline"></i></span>

                        <div class="info-box-content">
                            <span class="info-box-text">Khách hàng</span>
                            <span class="info-box-number">{{$total_customer}}</span>
                        </div>
                        <!-- /.info-box-content -->
                    </div>
                    <!-- /.info-box -->
                </div>
                <!-- /.col -->
            </div>
            <!-- /.row -->


            <!-- Main row -->
            <div class="row">
                <!-- Left col -->
                <div class="col-md-8">

                    <!-- /.box -->
                    <!-- TABLE: Sản phẩm bán chạy nhất-->
                    <div class="box box-info">
                        <div class="box-header with-border">
                            <h3 class="box-title">Sản phẩm bán chạy nhất</h3>

                            <div class="box-tools pull-right">
                                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i
                                            class="fa fa-minus"></i>
                                </button>
                                <button type="button" class="btn btn-box-tool" data-widget="remove"><i
                                            class="fa fa-times"></i></button>
                            </div>
                        </div>
                        <!-- /.box-header -->
                        <div class="box-body">
                            <div class="table-responsive">
                                <table class="table no-margin">
                                    <thead>
                                    <tr>
                                        <th>Mã sản phẩm</th>
                                        <th>Tên sản phẩm</th>
                                        <th>Giá</th>
                                        <th>Giảm giá</th>
                                        <th>Số lượng bán được</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @if($hot_products != null)
                                        @foreach($hot_products as $hot_product)
                                            <tr>
                                                <td>{{$hot_product->product_id}}</td>
                                                <td>{{$hot_product->products->name}}</td>
                                                <td><span class="label label-primary">${{$hot_product->products->price}}</span></td>
                                                <td><span class="label label-danger">
                                                        @if($hot_product->products->advertisments != null)
                                                        {{$hot_product->products->advertisments->discount}} %
                                                        @else
                                                        0%
                                                            @endif
                                                    </span></td>
                                                <td>{{$hot_product->total_qty}}</td>
                                            </tr>
                                        @endforeach
                                    @else
                                        <tr>
                                            <td>Không có sản phẩm nào</td>
                                        </tr>
                                    @endif
                                    </tbody>
                                </table>
                            </div>
                            <!-- /.table-responsive -->
                        </div>
                        <!-- /.box-body -->
                        <div class="box-footer clearfix">
                            <a href="{{route("products.index")}}"
                               class="btn btn-sm btn-default btn-flat text-center">Xem toàn bộ sản phẩm</a>
                        </div>
                        <!-- /.box-footer -->
                    </div>
                    <!-- /.box -->
                    <!-- /.row -->

                    <!-- TABLE: LATEST ORDERS -->
                    <div class="box box-info">
                        <div class="box-header with-border">
                            <h3 class="box-title">Latest Orders</h3>

                            <div class="box-tools pull-right">
                                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i
                                            class="fa fa-minus"></i>
                                </button>
                                <button type="button" class="btn btn-box-tool" data-widget="remove"><i
                                            class="fa fa-times"></i></button>
                            </div>
                        </div>
                        <!-- /.box-header -->
                        <div class="box-body">
                            <div class="table-responsive">
                                <table class="table no-margin">
                                    <thead>
                                    <tr>
                                        <th>Order ID</th>
                                        <th>Item</th>
                                        <th>Quantity</th>
                                        <th>Status</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @if($product_orders != null)
                                        @foreach($product_orders as $product_order)
                                            <tr>
                                                <td>
                                                    <a href="pages/examples/invoice.html">{{$product_order->order_id}}</a>
                                                </td>
                                                <td>{{$product_order->products->name}}</td>
                                                <td>{{$product_order->qty}}</td>
                                                @if($product_order->status == 1)
                                                    <td><span class="label label-success">Shipped</span></td>
                                                @else
                                                    <td><span class="label label-danger">Pending</span></td>
                                                @endif
                                            </tr>
                                        @endforeach
                                    @else
                                        <tr>
                                            <td>Không có hóa đơn nào</td>
                                        </tr>
                                    @endif
                                    </tbody>
                                </table>
                            </div>
                            <!-- /.table-responsive -->
                        </div>
                        <!-- /.box-body -->
                        <div class="box-footer clearfix">
                            <a href="{{route("admin.orders.index")}}"
                               class="btn btn-sm btn-default btn-flat text-center">View All
                                Orders</a>
                        </div>
                        <!-- /.box-footer -->
                    </div>
                    <!-- /.box -->
                </div>
                <!-- /.col -->

                <div class="col-md-4">

                    <!-- PRODUCT LIST -->
                    <div class="box box-primary">
                        <div class="box-header with-border">
                            <h3 class="box-title">Recently Added Products</h3>

                            <div class="box-tools pull-right">
                                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i
                                            class="fa fa-minus"></i>
                                </button>
                                <button type="button" class="btn btn-box-tool" data-widget="remove"><i
                                            class="fa fa-times"></i></button>
                            </div>
                        </div>
                        <!-- /.box-header -->
                        <div class="box-body">
                            <ul class="products-list product-list-in-box">
                                @if($products != null)
                                    @foreach($products as $product)
                                        <li class="item">
                                            <div class="product-img">
                                                <img src="{{asset("upload/img_product/$product->img_profile")}}" width="100px" alt="Product Image">
                                            </div>
                                            <div class="product-info">
                                                <a href="javascript:void(0)" class="product-title">{{$product->name}}
                                                    <span class="label label-warning pull-right">{{$product->price}} $</span></a>
                                                <span class="product-description">{!! $product->description !!}</span>
                                            </div>
                                        </li>
                                        <!-- /.item -->
                                    @endforeach
                                @else
                                    <li>Không có sản phẩm nào</li>
                                @endif
                            </ul>
                        </div>
                        <!-- /.box-body -->
                        <div class="box-footer text-center">
                            <a href="{{route('products.index')}}" class="uppercase">View All Products</a>
                        </div>
                        <!-- /.box-footer -->
                    </div>
                    <!-- /.box -->

                    {{--<div class="col-md-6">--}}
                        <!-- USERS LIST -->
                        <div class="box box-danger">
                            <div class="box-header with-border">
                                <h3 class="box-title">Latest Members</h3>

                                <div class="box-tools pull-right">
                                    <span class="label label-danger">8 New Members</span>
                                    <button type="button" class="btn btn-box-tool" data-widget="collapse"><i
                                                class="fa fa-minus"></i>
                                    </button>
                                    <button type="button" class="btn btn-box-tool" data-widget="remove"><i
                                                class="fa fa-times"></i>
                                    </button>
                                </div>
                            </div>
                            <!-- /.box-header -->
                            <div class="box-body no-padding">
                                <ul class="users-list clearfix">
                                    @if($customers != null)
                                        @foreach($customers as $customer)
                                            <li>
                                                <img src="{{asset("upload/img_profile/$customer->img")}}"
                                                     alt="User Image">
                                                <a class="users-list-name" href="#">{{$customer->name}}</a>
                                                <span class="users-list-date">{{$customer->created_at->toFormattedDateString()}}</span>
                                            </li>
                                        @endforeach
                                    @else
                                        <li>
                                            <a class="users-list-name" href="#">Chưa có thành viên nào</a>
                                        </li>
                                    @endif
                                </ul>
                                <!-- /.users-list -->
                            </div>
                            <!-- /.box-body -->
                            <div class="box-footer text-center">
                                <a href="{{route('users.index')}}" class="uppercase">View All Users</a>
                            </div>
                            <!-- /.box-footer -->
                        </div>
                        <!--/.box -->
                    {{--</div>--}}
                    <!-- /.col -->
                </div>
                <!-- /.col -->



            </div>
            <!-- /.row -->
        </section>
        <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->
@endsection