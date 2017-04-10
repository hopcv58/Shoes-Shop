@extends('admin.layout.master')
@section('title')
    Phản hồi từ khách hàng
@endsection
@section('content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1>
                Phản hồi từ khách hàng
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
                            <h3 class="box-title">Phản hồi từ khách hàng</h3>
                            @else
                                <h3 class="box-title">show result of {{$query}}</h3>
                            @endif
                        </div>
                        <!-- /.box-header -->
                        <div class="box-body table-responsive no-padding">
                            <table class="table table-hover">
                                <tr>
                                    <th>Tên khách hàng</th>
                                    <th>Nội dung</th>
                                    <th>Trạng thái</th>
                                    <th>Ngày tạo</th>
                                    <th style="width: 7%;">Thay đổi trạng thái</th>
                                </tr>
                                @foreach($feedbacks as $feedback)
                                    <tr>
                                        <td>{{$feedback->username == null ? $feedback->customers->username : $feedback->username}}</td>
                                        <td>{{$feedback->content}}</td>

                                        <td>
                                            @if($feedback->is_public == 1)
                                                <span class="badge bg-blue">Public</span>
                                            @else
                                                <span class="badge bg-red">Private</span>
                                            @endif
                                        </td>
                                        <td>{{date_format($feedback->updated_at,'Y-m-d')}}</td>
                                        <td>
                                            <form action="{{route('admin.feedbacks.changestatus', ['id' => $feedback->id])}}" method="post" role="form">
                                                {{csrf_field()}}
                                                <button class="btn btn-primary" type="submit">change</button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                            </table>
                            <div class="box-tools">
                                <div class="col-md-12">
                                    <div class="pull-right">
                                        @if(!isset($query))
                                        {{$feedbacks->links()}}
                                            @else
                                        {{$feedbacks->appends(['search'=>$query])->links()}}
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