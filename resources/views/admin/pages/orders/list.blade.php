@extends('admin.layout.master')
@section('title')
    Categories
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
            <div class="row" style="margin-bottom: 15px">
                <div class="col-md-12">
                    <p>Tổng số hóa đơn: {{$total_order}}</p>
                    <p>Đã thanh toán: {{$order_paid}}</p>
                    <p>Chưa thanh toán: {{$order_processing}}</p>
                </div>
            </div>
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
                                    <form action="{{route('admin.orders.index')}}" method="get" id="cate_search">
                                        <div class="input-group">
                                            <input type="text" name="search" class="form-control pull-right"
                                                   placeholder="Enter order code">
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
                                    <th>Khách hàng</th>
                                    <th>Phương thức thanh toán</th>
                                    <th>Tổng tiền</th>
                                    <th>Ngày tạo</th>
                                    <th>Trạng thái</th>
                                    <th>Chi Tiết</th>
                                    <th style="width: 7%;" colspan="2">Hành động</th>
                                </tr>
                                @foreach($orders as $order)
                                    <tr>
                                        <td>{{$order->id}}</td>
                                        <td style="width: 20%;">{{($order->username != null) ? $order->username : $order->customers->username }}</td>
                                        <td style="width: 10%;">{{$order->payment}}</td>
                                        <td>{{$order->total}} $</td>
                                        <td>{{$order->created_at->toDateTimeString()}}</td>
                                        <td>
                                            @if($order->status == 1)
                                                <a href="{{route('admin.orders.update',['id' => $order->id])}}"><span class="badge bg-blue">Đã thanh toán</span></a>
                                            @else
                                                <a href="{{route('admin.orders.update',['id' => $order->id])}}"><span class="badge bg-red">Chưa thanh toán</span></a>
                                            @endif
                                        </td>
                                        <td>
                                            <a href="{{route('admin.orders.detail',['id' => $order->id])}}">Chi Tiết</a>
                                        </td>
                                        <td>
                                            <a href="javascript:;"
                                               class="btn btn-xs btn-danger detail"
                                               dataId="{{$order->id}}"><i class="fa fa-file"></i></a>
                                        </td>
                                        <td>
                                            <a href="javascript:;"
                                               class="btn btn-xs btn-danger delete"
                                                dataId="{{$order->id}}"><i class="fa fa-trash"></i></a>
                                        </td>
                                    </tr>
                                @endforeach
                            </table>
                            <div class="box-tools">
                                <div class="col-md-12">
                                    <div class="pull-right">
                                        @if(!isset($search))
                                        {{$orders->links()}}
                                            @else
                                        {{$orders->appends(['search'=>$search])->links()}}
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

    <!-- start modal delete -->
    <div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
         aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal"><span
                                aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                    <h4 class="modal-title" id="myModalLabel">Khi xóa đơn hàng toàn bộ thông tin liên quan đến đơn hàng đều bị xóa, Tiếp tục xóa?</h4>
                </div>
                <div class="modal-body">
                    <form action="{{route('admin.orders.delete')}}" method="post">
                        {{csrf_field()}}
                        <input type="hidden" id="idCate" value="0" name="order_id">
                        <input type="submit" value="Delete" class="btn btn-danger">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    </form>
                </div>

            </div>
        </div>
    </div>

    <!-- end modal delete -->

    <!-- modal detail -->
    <div class="modal fade" id="detailModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
         aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal"><span
                                aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                    <h4 class="modal-title" id="myModalLabel"><i class="fa fa-cart-plus"></i> Chi tiết Hóa Đơn</h4>
                </div>
                <div class="modal-body" id="orderDetail" >
                </div>

            </div>
        </div>
    </div>

    <!-- end modal detail -->
@endsection

@section('script')
    <script>
        $(document).ready(function () {
            //close alert
            $(".close").click(function () {
                $(".myAlert").alert("close");
            });
            //show modal delete
            $(".delete").click(function(){
               $("#idCate").val($(this).attr('dataId'));
               $("#deleteModal").modal({
                   'show' : true
               });
            });

            $(".detail").click(function () {
               var order_id = $(this).attr('dataId');
                $.get("orders/detail/"+order_id, function (data) {
                 $("#orderDetail").html(data);
                 });
                $("#detailModal").modal({
                    'show' : true
                });
            });
//            $(".alert").alert();
        });
    </script>
@endsection