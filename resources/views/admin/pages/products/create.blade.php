@extends('admin.layout.master')
@section('title')
    Admin Talaha | Create new product
@endsection
@section('css')
    <!-- Select2 -->
    <link rel="stylesheet" href="{{asset('admin/plugins/select2/select2.min.css')}}">
@endsection
@section('content')
    <div class="content-wrapper">
        <section class="content-header">
            <h1>
                Products
                <small>Create new product</small>
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
                            <form action="{{route('products.store')}}" method="post" role="form"
                                  enctype="multipart/form-data">
                                {{csrf_field()}}
                                <div class="form-group">
                                    <legend>Tạo mới sản phẩm</legend>
                                </div>
                                {{--@if(count($errors)>0)
                                    <span class="alert alert-danger">
                                        @foreach($errors->all() as $error)
                                            {{$error}}
                                        @endforeach
                                    </span>
                                @endif--}}
                                <div class="form-group {{$errors->has('name') ? 'has-error' : ''}}">
                                    <label for="name" class="control-label">Tên giày (*)</label>
                                    <input type="text" class="form-control" name="name" placeholder="Enter Name ..."
                                           value="{{old('name')}}" required autofocus>
                                    @if($errors->has('name'))
                                        <span class="help-block">
                                    <strong>{{$errors->first('name')}}</strong>
                                         </span>
                                    @endif
                                </div>

                                <div class="form-group {{$errors->has('code') ? 'has-error' : ''}}">
                                    <label for="code" class="control-label">Mã sản phẩm </label>
                                    <input type="text" class="form-control" name="code"
                                           placeholder="Enter Product Code ..."
                                           value="{{old('code')}}">
                                    @if($errors->has('code'))
                                        <span class="help-block">
                                    <strong>{{$errors->first('code')}}</strong>
                                         </span>
                                    @endif
                                </div>

                                <div class="form-group {{session('cate_err') ? 'has-error' : ''}}">
                                    <label>Chọn loại giày (*)</label>
                                    <select class="form-control select2" multiple="multiple"
                                            data-placeholder="Select a Categories" name="cate_id[]"
                                            style="width: 100%;">
                                        @foreach($cates as $cate)
                                            <option value="{{$cate->id}}">{{$cate->name}}</option>
                                        @endforeach
                                    </select>
                                    @if(session('cate_err'))
                                        <span class="help-block">
                                    <strong>{{session('cate_err')}}</strong>
                                         </span>
                                    @endif
                                </div>

                                <div class="form-group">
                                    <label>Advertisment</label>
                                    <select class="form-control select2" name="ad_id"
                                            style="width: 100%;">
                                        <option value="" selected>Chọn chương trình quảng cáo</option>
                                        @foreach($advers as $adver)
                                            <option value="{{$adver->id}}">{{$adver->name}}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="form-group {{$errors->has('alias') ? 'has-error' : ''}}">
                                    <label for="alias" class="control-label">Tên gọi khác </label>
                                    <input type="text" class="form-control" name="alias" value="{{old('password')}}"
                                           placeholder="Enter Alias ...">
                                    @if($errors->has('alias'))
                                        <span class="help-block">
                                    <strong>{{$errors->first('alias')}}</strong>
                                         </span>
                                    @endif
                                </div>

                                <div class="form-group {{$errors->has('description') ? 'has-error' : ''}}">
                                    <label for="description" class="control-label">Mô tả </label>
                                    <textarea class="form-control textarea" name="description"
                                              placeholder="Enter product description ...">{{old('description')}}</textarea>
                                    @if($errors->has('description'))
                                        <span class="help-block">
                                    <strong>{{$errors->first('description')}}</strong>
                                         </span>
                                    @endif
                                </div>

                                <div class="form-group {{$errors->has('height') ? 'has-error' : ''}}">
                                    <label for="height" class="control-label">Chiều cao giày (*)</label>
                                    <select name="height" class="form-control">
                                        @for($i=0; $i < 11 ;$i++)
                                            <option value="{{$i}}" {{ $i == 0 ? 'selected' : ''}}>{{$i}}</option>
                                        @endfor
                                    </select>
                                    @if($errors->has('height'))
                                        <span class="help-block">
                                    <strong>{{$errors->first('height')}}</strong>
                                         </span>
                                    @endif
                                </div>

                                <div class="form-group {{$errors->has('material') ? 'has-error' : ''}}">
                                    <label for="material" class="control-label">Chất liệu giày (*) </label>
                                    <input type="text" name="material" class="form-control"
                                           placeholder="Chất liệu giày ..."
                                           value="{{old('material')}}">
                                    @if($errors->has('material'))
                                        <span class="help-block">
                                    <strong>{{$errors->first('material')}}</strong>
                                         </span>
                                    @endif
                                </div>

                                <div class="form-group {{$errors->has('phoi_do') ? 'has-error' : ''}}">
                                    <label for="phoi_do" class="control-label">Phối Đồ </label>
                                    <input type="text" name="phoi_do" class="form-control" placeholder="Phối Đồ"
                                           value="{{old('phoi_do')}}">
                                    @if($errors->has('phoi_do'))
                                        <span class="help-block">
                                    <strong>{{$errors->first('phoi_do')}}</strong>
                                         </span>
                                    @endif
                                </div>

                                <div class="form-group {{$errors->has('price') ? 'has-error' : ''}}">
                                    <label for="price" class="control-label">Giá bán (VNĐ) (*)</label>
                                    <input type="number" class="form-control" name="price"
                                           placeholder="Enter Price ..."
                                           value="{{old('price')}}">
                                    @if($errors->has('price'))
                                        <span class="help-block">
                                    <strong>{{$errors->first('price')}}</strong>
                                         </span>
                                    @endif
                                </div>

                                <div class="form-group {{session('not_img') ? 'has-error' : ''}}">
                                    <label for="img_profile" class="control-label">Image Profile (*)</label>
                                    <input type="file" name="img_profile"
                                           value="{{old('img_profile')}}">
                                    @if(session('not_img'))
                                        <span class="help-block">
                                    <strong>{{session('not_img')}}</strong>
                                         </span>
                                    @endif
                                </div>

                                <div class="form-group {{$errors->has('img') ? 'has-error' : ''}}">
                                    <label for="img" class="control-label">Image Detail </label>
                                    <input type="file" name="img[]" multiple
                                           value="{{old('img')}}">
                                    @if($errors->has('img'))
                                        <span class="help-block">
                                    <strong>{{$errors->first('img')}}</strong>
                                         </span>
                                    @endif
                                </div>

                                <div id="attribute">
                                    <label class="control-label">Attribute (*)</label>
                                    <div class="col-md-12" id="add_new"
                                         style="border: 1px solid #e5e5e5; margin-bottom: 10px">
                                        <div class="form-group {{$errors->has('attribute') ? 'has-error' : ''}}">
                                            <label for="size" class="control-label">Size</label>
                                            <select name="size[]" class="form-control">
                                                @for($i=35; $i < 46 ;$i++)
                                                    <option value="{{$i}}" {{old('size[]') ? 'selected' : ''}}>{{$i}}</option>
                                                @endfor
                                            </select>
                                            <label for="color" class="control-label">Color</label>
                                            <input type="text" class="form-control" name="color[]"
                                                   placeholder="Enter Color ..."
                                                   value="{{old('color[]')}}">
                                            <label for="qty" class="control-label">Số lượng (*)</label>
                                            <input type="number" class="form-control" name="qty[]"
                                                   placeholder="Số lượng ..."
                                                   value="{{old('qty[]')}}">
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <button type="button" class="btn btn-facebook" id="add_attribute"> Add new
                                        attribute
                                    </button>
                                </div>

                                <div class="form-group">
                                    <div class="checkbox icheck">
                                        <label>
                                            <input type="checkbox" value="1"
                                                   name="is_public" {{old('is_public')? 'checked' : ''}}>
                                            Public <span class="text-danger"> (default: private)</span>
                                        </label>
                                    </div>
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
    <!-- Select2 -->
    <script src="{{asset('admin/plugins/select2/select2.full.min.js')}}"></script>
    <script>
        $(document).ready(function () {
            var max_att = 15;
            var x = 1;
            $(".select2").select2();
            $(".textarea").wysihtml5();
            $('input').iCheck({
                checkboxClass: 'icheckbox_square-blue',
                radioClass: 'iradio_square-blue',
                increaseArea: '20%' // optional
            });
            $("#add_attribute").click(function (e) {
                e.preventDefault();
                if (x < max_att) {
                    x++;
                    $("#attribute").append(' <hr> <div class="col-md-12" '
                        + 'style="border: 1px solid #e5e5e5; margin-bottom: 10px; padding: 10px">'
                        + '<div class="form-group {{$errors->has('attribute') ? 'has-error' : ''}}">'
                        + '<label for="size" class="control-label">Size</label>'
                        + '<select name="size[]" class="form-control">@for($i=35; $i < 45 ;$i++)'
                        + '<option value="{{$i}}" {{old('height[]') ? 'selected' : ''}}>{{$i}}</option>'
                        + '@endfor</select>'
                        + '<label for="color" class="control-label">Color</label>'
                        + '<input type="text" class="form-control" name="color[]" placeholder="Enter Color ..."'
                        + 'value="{{old('color[]')}}">'
                        + '<label for="qty" class="control-label">Số lượng</label>'
                        + '<input type="number" class="form-control" name="qty[]"'
                        + 'placeholder="Số lượng ..." value="{{old('qty[]')}}">'
                        + '</div><a href="#" class="btn btn-danger remove_field">remove</a></div>');
                }
            });
            $("#attribute").on("click", ".remove_field", function (e) {
                e.preventDefault();
                $(this).parent('div').remove();
                x--;
            });
        });
    </script>
@endsection