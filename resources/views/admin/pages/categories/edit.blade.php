@extends('admin.layout.master')
@section('title')
    Update category
@endsection
@section('content')
    <div class="content-wrapper">
        <section class="content-header">
            <h1>
                Categories
                <small>Update category</small>
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
                            <form action="{{route('admin.categories.postUpdate',['id' => "$cateid->id"])}}" method="post" role="form" enctype="multipart/form-data">
                                {{csrf_field()}}
                                <div class="form-group">
                                    <legend>Create new category</legend>
                                </div>

                                <div class="form-group {{$errors->has('name') ? 'has-error' : ''}}">
                                    <label for="name" class="control-label">Name of Category</label>
                                    <input type="text" class="form-control" name="name" placeholder="Enter Name ..."
                                           value="{{$cateid->name}}" required autofocus>
                                    @if($errors->has('name'))
                                        <span class="help-block">
                                    <strong>{{$errors->first('name')}}</strong>
                                         </span>
                                    @endif
                                </div>

                                <div class="form-group">
                                    <img src="{{asset("upload/img_pages/$cateid->img_profile")}}" width="600px" alt="">
                                </div>
                                <div class="form-group {{session('not_img') ? 'has-error' : ''}}">
                                    <label for="img_profile" class="control-label">Thay đổi ảnh hiển thị trên trang</label>
                                    <input type="file" name="img_profile"
                                           value="{{old('img_profile')}}">
                                    @if(session('not_img'))
                                        <span class="help-block">
                                    <strong>{{session('not_img')}}</strong>
                                         </span>
                                    @endif
                                </div>

                                <div class="form-group {{$errors->has('alias') ? 'has-error' : ''}}">
                                    <label for="alias" class="control-label">Alias of Category </label>
                                    <input type="text" class="form-control" name="alias" value="{{$cateid->alias}}"
                                           placeholder="Enter Alias ...">
                                    @if($errors->has('alias'))
                                        <span class="help-block">
                                    <strong>{{$errors->first('alias')}}</strong>
                                         </span>
                                    @endif
                                </div>

                                <div class="form-group {{$errors->has('description') ? 'has-error' : ''}}">
                                    <label for="description" class="control-label">Description of Category </label>
                                    <textarea class="textarea" name="description"
                                              placeholder="Enter Description ...">{{$cateid->description}}</textarea>

                                    @if($errors->has('description'))
                                        <span class="help-block">
                                    <strong>{{$errors->first('description')}}</strong>
                                         </span>
                                    @endif
                                </div>

                                <div class="form-group">
                                    <div class="checkbox icheck">
                                        <label>
                                            <input type="checkbox" value="1"
                                                   name="is_public" {{$cateid->is_public ? 'checked' : ''}}>
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