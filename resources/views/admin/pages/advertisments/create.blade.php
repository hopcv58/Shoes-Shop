@extends('admin.layout.master')
@section('title')
    Create new advertisment
@endsection
@section('css')
    <!-- Select2 -->
    <link rel="stylesheet" href="{{asset('admin/plugins/select2/select2.min.css')}}">
@endsection
@section('content')
    <div class="content-wrapper">
        <section class="content-header">
            <h1>
                Advertisment
                <small>Create new advertisment</small>
            </h1>

            <ol class="breadcrumb">
                <li><a href="{{route('admin.homepage')}}"><i class="fa fa-dashboard"></i> Home</a></li>
                <li class="active">{{url()->current()}}</li>
            </ol>
        </section>
        <section class="content">
            <div class="row" style="margin-bottom: 15px">
                <div class="col-md-6">
                    <a class="btn btn-facebook" href="{{route('advertisments.index')}}">Xem toàn bộ các sự kiện quảng cáo</a>
                </div>
            </div>
            <div class="row">
                <div class="col-md-8 col-md-offset-2">
                    <div class="box box-primary">
                        <div class="box-body">
                            <form action="{{route('advertisments.store')}}" method="post" role="form">
                                {{csrf_field()}}
                                <div class="form-group">
                                    <legend>Create new advertisment</legend>
                                </div>

                                <div class="form-group {{$errors->has('name') ? 'has-error' : ''}}">
                                    <label for="name" class="control-label">Name of Even (*)</label>
                                    <input type="text" class="form-control" name="name" placeholder="Enter Name ..."
                                           value="{{old('name')}}" required autofocus>
                                    @if($errors->has('name'))
                                        <span class="help-block">
                                    <strong>{{$errors->first('name')}}</strong>
                                         </span>
                                    @endif
                                </div>

                                <div class="form-group {{session('product_err') ? 'has-error' : ''}}">
                                    <label>Products (Product in this event Advertisment)</label>
                                    <select class="form-control select2" multiple="multiple"
                                            data-placeholder="Select a Product" name="product_id[]"
                                            style="width: 100%;">
                                        @foreach($products as $product)
                                            <option value="{{$product->id}}">{{$product->name}}</option>
                                        @endforeach
                                    </select>
                                    @if(session('product_err'))
                                        <span class="help-block">
                                    <strong>{{session('product_err')}}</strong>
                                         </span>
                                    @endif
                                </div>

                                <div class="form-group {{$errors->has('detail') ? 'has-error' : ''}}">
                                    <label for="detail" class="control-label">Detail </label>
                                    <input type="text" class="form-control" name="detail" value="{{old('detail')}}"
                                           placeholder="Enter Details of even ...">
                                    @if($errors->has('detail'))
                                        <span class="help-block">
                                    <strong>{{$errors->first('detail')}}</strong>
                                        </span>
                                    @endif
                                </div>

                                <div class="form-group {{$errors->has('start_date') ? 'has-error' : ''}}">
                                    <label for="start_date" class="control-label">Start date (*)</label>
                                        <input type="text" class="form-control" id="datepicker2" name="start_date" value="{{old('start_date')}}"
                                               placeholder="start_date ...">

                                    @if($errors->has('start_date'))
                                        <span class="help-block">
                                    <strong>{{$errors->first('start_date')}}</strong>
                                         </span>
                                    @endif
                                </div>

                                <div class="form-group {{$errors->has('end_date') ? 'has-error' : ''}}">
                                    <label for="end_date" class="control-label">End Date (*)</label>
                                    <input type="text" class="form-control" id="datepicker" name="end_date" value="{{old('end_date')}}"
                                           placeholder="end_date ...">

                                    @if($errors->has('end_date'))
                                        <span class="help-block">
                                    <strong>{{$errors->first('end_date')}}</strong>
                                         </span>
                                    @endif
                                </div>

                                <div class="form-group {{$errors->has('discount') ? 'has-error' : ''}}">
                                    <label for="discount" class="control-label">Discount (%) (*)</label>
                                    <input type="number" class="form-control" name="discount" value="{{old('discount')}}"
                                           placeholder="Discount ...">
                                    @if($errors->has('discount'))
                                        <span class="help-block">
                                    <strong>{{$errors->first('discount')}}</strong>
                                         </span>
                                    @endif
                                </div>

                                <div class="form-group">
                                    <button type="submit" class="btn btn-primary">Submit</button>
                                    <button class="btn btn-github" type="reset">Reset</button>
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
    <script src="{{asset('admin/plugins/select2/select2.full.min.js')}}"></script>
    <script>
        $(document).ready(function () {
            $(".textarea").wysihtml5();
            $('input').iCheck({
                checkboxClass: 'icheckbox_square-blue',
                radioClass: 'iradio_square-blue',
                increaseArea: '20%' // optional
            });
            $(".select2").select2();
            //Date picker
            $('#datepicker').datepicker({
                autoclose: true
            });
            $('#datepicker2').datepicker({
                autoclose: true
            });
        });
    </script>
@endsection