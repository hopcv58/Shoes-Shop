@extends('admin.layout.master')
@section('title')
    Admin Talaha | Products
@endsection
@section('content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1>
                Products
                <small>List of products</small>
            </h1>

            <ol class="breadcrumb">
                <li><a href="{{route('admin.homepage')}}"><i class="fa fa-dashboard"></i> Home</a></li>
                <li class="active">{{url()->current()}}</li>
            </ol>

        </section>

        <!-- Main content -->
        <section class="content">
            <div class="row" style="margin-bottom: 15px">
                <div class="col-md-3">
                    <a class="btn btn-facebook form-control" href="{{route('products.create')}}">+ Add new products</a>
                </div>
                <div class="col-md-3">
                    <a class="btn btn-google form-control" href="{{route('advertisments.create')}}">+ Add event advertisment</a>
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
                                <h3 class="box-title">List of products</h3>
                            @else
                                <h3 class="box-title">Show result of {{$query}}</h3>
                            @endif
                            <div class="box-tools">
                                <div class="input-group">
                                    <form action="{{route('products.index')}}" method="get" id="products_search">
                                        <div class="input-group">
                                            <input type="text" name="search" class="form-control pull-right"
                                                   placeholder="Enter name of product">
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
                                    <th>Tên sp</th>
                                    <th>Mã sp</th>
                                    <th>Ký hiệu</th>
                                    <th>Mô tả</th>
                                    <th>Giá</th>
                                    <th>Quảng cáo</th>
                                    <th>Hình đại diện</th>
                                    <th>Ngày tạo</th>
                                    <th>Trạng thái</th>
                                    <th>Số lượng</th>
                                    <th style="width: 7%;" colspan="2">Action</th>
                                </tr>
                                @foreach($products as $product)
                                    <tr>
                                        <td>{{$product->name}}</td>
                                        <td style="width: 5%;">{{$product->code}}</td>
                                        <td style="width: 10%;">{{$product->alias}}</td>
                                        <td style="width: 15%">{!! $product->description !!}</td>
                                        <td>{{$product->price}}</td>
                                        @if($product->advertisments != null)
                                            <td>
                                                <span class="badge bg-blue-active">{{$product->advertisments->name}}</span>
                                            </td>
                                        @else
                                            <td><span class="badge bg-red">No Advertisment</span></td>
                                        @endif
                                        <td><img src="{{asset('upload/img_product/'.$product->img_profile)}}"
                                                 class="img-responsive" width="100px" alt=""></td>
                                        <td>{{date_format($product->updated_at,'Y-m-d')}}</td>
                                        <td>
                                            @if($product->is_public == 1)
                                                <span class="badge bg-blue">public</span>
                                            @else
                                                <span class="badge bg-red">private</span>
                                            @endif
                                        </td>
                                        <td>{{$soluong[$product->id]}}</td>
                                        <td>
                                            <a href="javascript:;"
                                               class="btn btn-xs btn-danger delete"
                                               dataId="{{$product->id}}"><i class="fa fa-trash"></i></a>
                                        </td>
                                        <td>
                                            <a href="{{route('products.edit', ['id' => $product->id])}}" class="btn btn-xs btn-facebook"><i
                                                        class="fa fa-pencil-square-o"></i></a>
                                        </td>
                                    </tr>
                                @endforeach
                            </table>
                            <div class="box-tools">
                                <div class="col-md-12">
                                    <div class="pull-right">
                                        @if(!isset($query))
                                            {{$products->links()}}
                                        @else
                                            {{$products->appends(['search'=>$query])->links()}}
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
                    <h4 class="modal-title" id="myModalLabel">Are you sure to delete this products?</h4>
                </div>

                <div class="modal-body">
                    <form action="{{route('admin.products.delete')}}" method="post">
                        {{csrf_field()}}
                        <input type="hidden" id="product_id" value="0" name="product_id">
                        <input type="submit" value="Delete" class="btn btn-danger">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    </form>
                </div>

            </div>
        </div>
    </div>

    <!-- end modal delete -->
@endsection

@section('script')
    <script>
        $(document).ready(function () {
            //close alert
            $(".close").click(function () {
                $(".myAlert").alert("close");
            });
            //show modal delete
            $(".delete").click(function () {
                $("#product_id").val($(this).attr('dataId'));
                $("#deleteModal").modal({
                    'show': true
                });
            });
//            $(".alert").alert();
        });
    </script>
@endsection