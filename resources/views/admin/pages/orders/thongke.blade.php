@extends('admin.layout.master')
@section('title')
    Admin | Thống kê
@endsection
@section('content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1>
                Thống kê
            </h1>

            <ol class="breadcrumb">
                <li><a href="{{route('admin.homepage')}}"><i class="fa fa-dashboard"></i> Home</a></li>
                <li class="active">{{url()->current()}}</li>
            </ol>

        </section>

        <!-- Main content -->
        <section class="content">
            <div class="row">
                <div class="col-md-6">
                    <div class="box">
                        <!-- /.box-header -->
                        <div class="box-body table-responsive no-padding">
                            <table class="table table-bordered" style="font-size: medium;">
                                <tr>
                                    <td>Tổng doanh thu:</td>
                                    <td><span class="pull-right">{{number_format($totalSale)}} vnđ</span></td>
                                </tr>
                                <tr>
                                    <td>Doanh thu hôm nay {{\Carbon\Carbon::now()->format('d-m-Y')}}:</td>
                                    <td><span class="pull-right">{{number_format($daySale)}} vnđ</span></td>
                                </tr>
                                <tr>
                                    <td>Doanh thu tháng {{\Carbon\Carbon::now()->format('m-Y')}}:</td>
                                    <td><span class="pull-right">{{number_format($monthSale)}} vnđ</span></td>
                                </tr>
                            </table>
                        </div>
                        <!-- /.box-body -->
                    </div>
                    <!-- /.box -->
                </div>
                <div class="col-md-6">
                    <div class="box">
                        <div class="box-body table-responsive no-padding">
                            <table class="table table-bordered" style="font-size: medium">
                                <tr>
                                    <td>Tổng số giao dịch:</td>
                                    <td><span class="pull-right">{{$totalOrder}} </span></td>
                                </tr>
                                <tr>
                                    <td>Tổng số sản phẩm bán được:</td>
                                    <td><span class="pull-right">{{$totalQty}} sản phẩm </span></td>
                                </tr>
                                <tr>
                                    <td>Hôm nay {{\Carbon\Carbon::now()->format('d-m-Y')}}:</td>
                                    <td><span class="pull-right">{{$dayQty}} sản phẩm</span></td>
                                </tr>
                                <tr>
                                    <td>Tháng hiện tại {{\Carbon\Carbon::now()->format('m-Y')}}:</td>
                                    <td><span class="pull-right">{{$monthQty}} sản phẩm</span></td>
                                </tr>
                            </table>
                        </div>
                        <!-- /.box-body -->
                    </div>
                    <!-- /.box -->
                </div>

                <div class="col-md-6">
                    <div class="box">
                        <table class="table table-bordered" style="font-size: medium">
                            <tr>
                                <td>Hóa đơn dưới 1,000,000 vnđ:</td>
                                <td><span class="pull-right">{{$order_under_1M}}</span></td>
                            </tr>
                            <tr>
                                <td>Hóa đơn từ 1,000,000 - 2,000,000 vnđ:</td>
                                <td><span class="pull-right">{{$order_beetween_1M_2M}}</span></td>
                            </tr>
                            <tr>
                                <td>Hóa đơn trên 2,000,000 vnd</td>
                                <td><span class="pull-right">{{$order_over_2M}}</span></td>
                            </tr>
                        </table>
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="box">
                        <h3 style="font-weight: bold; text-align: center">Thống kê các sản phẩm theo danh mục</h3>
                        @if($categories != null)
                            @foreach($categories as $category)
                                <div class="box box-primary">
                                    <h4 class="col-md-12" style="font-weight: bold">{{$category->name}}</h4>
                                    <table class="table table-bordered">
                                        <tr>
                                            <td>Tên Sản Phẩm</td>
                                            <td>Số lượng</td>
                                            <td>Giá</td>
                                            <td>Khuyến mãi</td>
                                        </tr>
                                        @if($category->productCate != null)
                                            @foreach($products_cate[$category->id] as $p_cate)
                                                <tr>
                                                    <td>{{$p_cate->products->name}}</td>
                                                    <td>{{$products_qty[$p_cate->products->id]}}</td>
                                                    <td><span class="label label-default">{{number_format($p_cate->products->price)}} vnđ</span></td>
                                                    <td>
                                                        @if($p_cate->products->ad_id == null)
                                                            <span class="label label-primary">Ko khuyến mãi</span>
                                                        @else
                                                            <span class="label label-danger">{{$p_cate->products->advertisments->discount}} %</span>
                                                        @endif
                                                    </td>
                                                </tr>
                                            @endforeach
                                        @endif
                                    </table>
                                </div>
                            @endforeach
                        @endif
                    </div>
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