@extends('admin.layout.master')
@section('title')
    News
@endsection
@section('content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1>
                News
                <small>Danh Sách Bài Post</small>
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
                    <a class="btn btn-facebook" href="{{route('news.create')}}">+ Thêm mới bài post</a>
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
                            <h3 class="box-title">List of categories</h3>
                            @else
                                <h3 class="box-title">show result of {{$query}}</h3>
                            @endif
                            <div class="box-tools">
                                <div class="input-group">
                                    <form action="{{route('news.index')}}" method="get" id="cate_search">
                                        <div class="input-group">
                                            <input type="text" name="search" class="form-control pull-right"
                                                   placeholder="Enter name of category">
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
                                    <th>Tiêu đề</th>
                                    <th>Tóm tắt</th>
                                    <th>Ảnh hiển thị</th>
                                    <th>Trạng thái</th>
                                    <th>Ngày tạo</th>
                                    <th style="width: 7%;" colspan="2">hoạt động</th>
                                </tr>
                                @foreach($news as $new)
                                    <tr>
                                        <td>{{$new->title}}</td>
                                        <td style="width: 20%;">{{$new->summary}}</td>
                                        <td style="width: 30%;"><img src="{{asset("upload/img_news/$new->img")}}" class="thumbnail" width="150px" alt=""></td>
                                        <td>
                                            @if($new->is_public == 1)
                                                <span class="badge bg-blue">Public</span>
                                            @else
                                                <span class="badge bg-red">Private</span>
                                            @endif
                                        </td>
                                        <td>{{date_format($new->updated_at,'Y-m-d')}}</td>
                                        <td>
                                            <a href="{{route('news.edit',['id' => "$new->id"])}}"
                                               class="btn btn-xs btn-primary"><i class="fa fa-pencil-square-o"></i></a>
                                        </td>
                                        <td>
                                            <form action="{{route('news.destroy', ['id' => $new->id])}}" method="post" role="form">
                                                {{csrf_field()}}
                                                {{method_field('delete')}}
                                                {{--<input type="hidden" value="{{$new->id}}" name="id">--}}
                                                <button class="btn btn-xs btn-danger" type="submit"><i class="fa fa-trash"></i></button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                            </table>
                            <div class="box-tools">
                                <div class="col-md-12">
                                    <div class="pull-right">
                                        @if(!isset($query))
                                        {{$news->links()}}
                                            @else
                                        {{$news->appends(['search'=>$query])->links()}}
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
                    <h4 class="modal-title" id="myModalLabel">Are you sure to delete this categories?</h4>
                </div>
                <div class="modal-body">
                    <form action="" method="post">
                        {{csrf_field()}}
                        <input type="hidden" id="idCate" value="0" name="idCate">
                        <input type="submit" value="Delete" class="btn btn-danger">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    </form>
                </div>
                {{--<div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary">Save changes</button>
                </div>--}}

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
            $(".delete").click(function(){
               $("#idCate").val($(this).attr('dataId'));
               $("#deleteModal").modal({
                   'show' : true
               });
            });
//            $(".alert").alert();
        });
    </script>
@endsection