@extends('admin.layout.master')
@section('title')
    Create news
@endsection
@section('content')
    <div class="content-wrapper">
        <section class="content-header">
            <h1>
                News
                <small>Tạo bài post mới</small>
            </h1>

            <ol class="breadcrumb">
                <li><a href="{{route('admin.homepage')}}"><i class="fa fa-dashboard"></i> Home</a></li>
                <li class="active">{{url()->current()}}</li>
            </ol>
        </section>
        <section class="content">
            <div class="row">
                <div class="col-md-12">
                    <div class="box box-primary">
                        <div class="box-body">
                            <form action="{{route('news.store')}}" method="post" role="form"
                                  enctype="multipart/form-data">
                                {{csrf_field()}}
                                <div class="form-group">
                                    <legend>Tạo bài post mới</legend>
                                </div>

                                <div class="form-group {{$errors->has('title') ? 'has-error' : ''}}">
                                    <label for="title" class="control-label">Title (*)</label>
                                    <input type="text" class="form-control" name="title" placeholder="Enter Title ..."
                                           value="{{old('title')}}" required autofocus>
                                    @if($errors->has('title'))
                                        <span class="help-block">
                                    <strong>{{$errors->first('title')}}</strong>
                                         </span>
                                    @endif
                                </div>

                                <div class="form-group {{$errors->has('summary') ? 'has-error' : ''}}">
                                    <label for="summary" class="control-label">Tóm Tắt</label>
                                    <textarea class="textarea" name="summary"
                                              placeholder="Enter summary ...">{{old('summary')}}
                                    </textarea>
                                    @if($errors->has('summary'))
                                        <span class="help-block">
                                    <strong>{{$errors->first('summary')}}</strong>
                                         </span>
                                    @endif
                                </div>

                                <div class="form-group {{$errors->has('content') ? 'has-error' : ''}}">
                                    <label for="content" class="control-label">Nội dung</label>
                                    <textarea class="textarea" name="content"
                                              placeholder="Enter content ...">{{old('content')}}</textarea>

                                    @if($errors->has('content'))
                                        <span class="help-block">
                                    <strong>{{$errors->first('content')}}</strong>
                                         </span>
                                    @endif
                                </div>


                                <div class="form-group {{$errors->has('img') ? 'has-error' : ''}}">
                                    <label for="img" class="control-label">Ảnh Đại Diện</label>
                                    <input type="file" name="img">
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