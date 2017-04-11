@extends('admin.layout.master')
@section('title')
    News
@endsection
@section('content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1>Danh Sách Slides</h1>

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
                        <div class="box-body table-responsive" style="padding: 20px">
                            @foreach($slides as $slide)
                                <div class="col-md-6" style="margin-bottom: 10px;">
                                    <img src="{{asset("upload/img_news/$slide->name")}}" width="100%" alt="">
                                    <div>
                                        <small style="font-weight: bold"
                                               class="pull-right">{{date_format($slide->updated_at,'Y-m-d')}}</small>
                                        <br>
                                            @if($slide->is_public == 1)
                                                <a href="{{route('admin.slide.changestatus', ['id' => $slide->id])}}" class="btn btn-primary col-md-3 btn-status">Public</a>
                                            @else
                                                <a href="{{route('admin.slide.changestatus', ['id' => $slide->id])}}" class="btn btn-danger col-md-3 btn-status">Private</a>
                                            @endif

                                            <form action="{{route('admin.slides.destroy')}}"
                                                  method="post" role="form">
                                                {{csrf_field()}}
                                                <input type="hidden" value="{{$slide->id}}" name = "slide_id">
                                                {{--<input type="hidden" value="{{$new->id}}" name="id">--}}
                                                <button class="btn btn-danger col-md-3" type="submit">Xóa</button>
                                            </form>
                                    </div>
                                </div>
                            @endforeach
                            <div class="box-tools">
                                <div class="col-md-12">
                                    <div class="pull-right">
                                        {{$slides->links()}}
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
            //show modal delete
            $(".delete").click(function () {
                $("#idCate").val($(this).attr('dataId'));
                $("#deleteModal").modal({
                    'show': true
                });
            });

//            $(".alert").alert();
        });
    </script>
@endsection