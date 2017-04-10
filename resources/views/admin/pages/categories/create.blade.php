@extends('admin.layout.master')
@section('title')
    Create new category
@endsection
@section('content')
    <div class="content-wrapper">
        <section class="content-header">
            <h1>
                Categories
                <small>Create new categories</small>
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
                            <form action="{{route('admin.categories.postCreate')}}" method="post" role="form">
                                {{csrf_field()}}
                                <div class="form-group">
                                    <legend>Create new category</legend>
                                </div>

                                <div class="form-group {{$errors->has('name') ? 'has-error' : ''}}">
                                    <label for="name" class="control-label">Name of Category (*)</label>
                                    <input type="text" class="form-control" name="name" placeholder="Enter Name ..."
                                           value="{{old('name')}}" required autofocus>
                                    @if($errors->has('name'))
                                        <span class="help-block">
                                    <strong>{{$errors->first('name')}}</strong>
                                         </span>
                                    @endif
                                </div>

                                <div class="form-group {{$errors->has('alias') ? 'has-error' : ''}}">
                                    <label for="alias" class="control-label">Alias of Category</label>
                                    <input type="text" class="form-control" name="alias" value="{{old('alias')}}"
                                           placeholder="Enter Alias ...">
                                    @if($errors->has('alias'))
                                        <span class="help-block">
                                    <strong>{{$errors->first('alias')}}</strong>
                                         </span>
                                    @endif
                                </div>

                                <div class="form-group {{$errors->has('description') ? 'has-error' : ''}}">
                                    <label for="description" class="control-label">Description of Category</label>
                                    <textarea class="textarea" name="description"
                                              placeholder="Enter Description ...">{{old('description')}}</textarea>

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
                                                   name="is_public" {{old('is_public')? 'checked' : ''}}>
                                            Public <span class="text-danger"> (default: private)</span>
                                        </label>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <button type="submit" value="submit" class="btn btn-primary">Submit</button>
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