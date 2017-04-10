@extends('admin.layout.master')
@section('title')
    Product Order
@endsection
@section('content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1>
                Categories
                <small>List of categories</small>
            </h1>

            <ol class="breadcrumb">
                <li><a href="{{route('admin.homepage')}}"><i class="fa fa-dashboard"></i> Home</a></li>
                <li class="active">{{url()->current()}}</li>
            </ol>

        </section>

        <!-- Main content -->
        <section class="content">

            @if(session('success'))
                <div class="alert alert-success myAlert">
                    <a href="#" class="close">&times;</a>
                    {{session('success')}}
                </div>
            @endif

            @if(session('fail'))
                <div class="alert alert-danger myAlert">
                    <a href="#" class="close">&times;</a>
                    {{session('fail')}}
                </div>
            @endif
            <div class="row">
                <div class="col-md-12">
                    <div class="box">
                        <div class="box-header">
                            @if(!isset($query))
                                <h3 class="box-title">List of orders</h3>
                            @else
                                <h3 class="box-title">show result of {{$query}}</h3>
                            @endif
                            <div class="box-tools">
                                <div class="input-group">
                                    <form action="{{route('admin.productorder.index')}}" method="get" id="cate_search">
                                        <div class="input-group">
                                            <input type="text" name="search" class="form-control pull-right"
                                                   placeholder="Enter order id or product id">
                                            <span class="input-group-btn">
                                                <button type="submit" class="btn btn-default"><i
                                                            class="fa fa-search"></i>
                                                </button>
                                            </span>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                        <!-- /.box-header -->
                        <div class="box-body table-responsive no-padding">
                            <table class="table table-hover">
                                <tr>
                                    <th>Mã số</th>
                                    <th>Mã Hóa Đơn</th>
                                    <th>Sản Phẩm</th>
                                    <th>Số lượng</th>
                                    <th>Ngày tạo</th>
                                    <th>Trạng thái</th>
                                    <th style="width: 7%;">Thành Tiền</th>
                                </tr>
                                @if($product_orders)
                                    @foreach($product_orders as $product_order)
                                        <tr>
                                            <td>{{$product_order->id}}</td>
                                            <td>{{$product_order->orders->id}}</td>
                                            <td>{{$product_order->products->name}}</td>
                                            <td>{{$product_order->qty}}</td>
                                            <td>{{$product_order->created_at->toDateTimeString()}}</td>
                                            <td>
                                                @if($product_order->status == 1)
                                                    <span class="badge bg-blue">Đã Chuyển</span>
                                                @else
                                                    <span class="badge bg-red">Chưa Chuyển</span>
                                                @endif
                                            </td>
                                            <td>${{($product_order->qty)*($product_order->products->price)}}</td>
                                        </tr>
                                    @endforeach
                                @else
                                    <tr>Không có đơn hàng sản phẩm nào</tr>
                                @endif
                            </table>
                            <div class="box-tools">
                                <div class="col-md-12">
                                    <div class="pull-right">
                                        @if(!isset($search))
                                            {{$product_orders->links()}}
                                        @else
                                            {{$product_orders->appends(['search'=>$search])->links()}}
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- /.box-body -->
                    </div>
                    <!-- /.box -->
                </div>
            </div>
        </section>
        <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->
@endsection

@section('script')
    <script>
        $(document).ready(function () {
            //close alert
            $(".close").click(function () {
                $(".myAlert").alert("close");
            });
        });
    </script>
@endsection