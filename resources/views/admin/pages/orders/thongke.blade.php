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
                <div class="col-md-6">
                    <div class="box">
                        <!-- /.box-header -->
                        <div class="box-body table-responsive no-padding">
                            <div class="col-md-12">
                                <p class="lead">Tổng doanh thu: <span class="pull-right">${{$totalSale}}</span></p>
                                <p class="lead">Doanh thu hôm nay {{\Carbon\Carbon::now()->format('d-m-Y')}}: <span class="pull-right">${{$daySale}}</span></p>
                                <p class="lead">Doanh thu tháng {{\Carbon\Carbon::now()->format('m-Y')}}: <span class="pull-right">${{$monthSale}}</span></p>
                            </div>
                        </div>
                        <!-- /.box-body -->
                    </div>
                    <!-- /.box -->
                </div>
                <div class="col-md-6">
                    <div class="box">
                        <div class="box-body table-responsive no-padding">
                            <div class="col-md-12">
                            <p class="lead">Tổng số giao dịch: <span class="pull-right">{{$totalOrder}}</span></p>
                            <p class="lead">Tổng số sản phẩm: <span class="pull-right">{{$totalQty}} sản phẩm</span> </p>
                            <p class="lead">Hôm nay {{\Carbon\Carbon::now()->format('d-m-Y')}}: <span class="pull-right">{{$dayQty}} sản phẩm</span></p>
                            <p class="lead">Tháng hiện tại {{\Carbon\Carbon::now()->format('m-Y')}}
                                <span class="pull-right">{{$monthQty}} sản phẩm</span></p>
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