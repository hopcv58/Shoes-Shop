@extends('admin.layout.master')
@section('title')
    Cập nhật đơn hàng
@endsection
@section('content')
    <div class="content-wrapper">
        <section class="content-header">
            <h1>
                Order
                <small>Cập nhật đơn hàng</small>
            </h1>

            <ol class="breadcrumb">
                <li><a href="{{route('admin.homepage')}}"><i class="fa fa-dashboard"></i> Home</a></li>
                <li class="active">{{url()->current()}}</li>
            </ol>
        </section>
        <section class="content">
            <div class="row">
                <div class="col-md-8 col-md-offset-2">
                    <div class="box box-primary">
                        <div class="box-body">
                            <form action="{{route('admin.orders.update.post',['id' => "$order_id->id"])}}" method="post" role="form">
                                {{csrf_field()}}
                                <div class="form-group">
                                    <legend>Cập nhật đơn hàng</legend>
                                </div>

                                <div class="form-group">
                                    <label for="name" class="control-label">Mã Đơn Hàng</label>
                                    <input type="text" class="form-control" name="name" placeholder="Enter Name ..."
                                           value="{{$order_id->id}}" disabled>
                                </div>

                                <div class="form-group">
                                    <label for="alias" class="control-label">Khách hàng</label>
                                    <input type="text" class="form-control" name="alias" value="{{$order_id->customers->username}}"
                                           disabled>
                                </div>

                                <div class="form-group {{$errors->has('note') ? 'has-error' : ''}}">
                                    <label for="note" class="control-label">Ghi chú đơn hàng </label>
                                    <textarea class="textarea" name="note"
                                              placeholder="Enter Description ...">{{$order_id->note}}</textarea>

                                    @if($errors->has('note'))
                                        <span class="help-block">
                                    <strong>{{$errors->first('note')}}</strong>
                                         </span>
                                    @endif
                                </div>

                                <div class="form-group">
                                    <div class="checkbox icheck">
                                        <label>
                                            <input type="checkbox" value="1"
                                                   name="status" {{$order_id->status ? 'checked' : ''}}>
                                            Đã thanh toán <span class="text-danger"> (default: Chưa thanh toán)</span>
                                        </label>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <button type="submit" class="btn btn-primary">Cập nhật</button>
                                    <button class="btn btn-github" type="reset">Đặt lại</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </section>
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