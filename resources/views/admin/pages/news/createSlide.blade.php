@extends('admin.layout.master')
@section('title')
    Admin Talaha | Create new Slides
@endsection
@section('css')
    <!-- Select2 -->
    <link rel="stylesheet" href="{{asset('admin/plugins/select2/select2.min.css')}}">
@endsection
@section('content')
    <div class="content-wrapper">
        <section class="content-header">
            <h1>
                Slides
            </h1>

            <ol class="breadcrumb">
                <li><a href="{{route('admin.homepage')}}"><i class="fa fa-dashboard"></i> Home</a></li>
                <li class="active">{{url()->current()}}</li>
            </ol>
        </section>
        <section class="content">
            <div class="row">
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
                <div class="col-md-8 col-md-offset-2">
                    <div class="box box-primary">
                        <div class="box-body">
                            <form action="{{route('admin.news.postslides')}}" method="post" role="form"
                                  enctype="multipart/form-data">
                                {{csrf_field()}}
                                <div class="form-group">
                                    <legend>Thêm mới slide</legend>
                                </div>

                                <div class="form-group {{session('not_img') ? 'has-error' : ''}}">
                                    <label for="img_profile" class="control-label">Upload 1 ảnh</label>
                                    <input type="file" name="img_profile"
                                           value="{{old('img_profile')}}">
                                    @if(session('not_img'))
                                        <span class="help-block">
                                    <strong>{{session('not_img')}}</strong>
                                         </span>
                                    @endif
                                </div>

                                <div class="form-group {{$errors->has('img') ? 'has-error' : ''}}">
                                    <label for="img" class="control-label">Upload nhiều ảnh</label>
                                    <input type="file" name="img[]" multiple
                                           value="{{old('img')}}">
                                    @if($errors->has('img'))
                                        <span class="help-block">
                                    <strong>{{$errors->first('img')}}</strong>
                                         </span>
                                    @endif
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
            $(".close").click(function () {
                $(".myAlert").alert("close");
            });
            var max_att = 15;
            var x = 1;
            $(".select2").select2();
            $('input').iCheck({
                checkboxClass: 'icheckbox_square-blue',
                radioClass: 'iradio_square-blue',
                increaseArea: '20%' // optional
            });
        });
    </script>
@endsection