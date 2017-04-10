@extends('layouts.user')
@section('content')
    <!--wrapper start-->
    <div id="wrapper">
        <div class="container">
            <div class="row">
                <div class="col-md-6">
                    <h2 class="text-center">{{$news->title}}</h2>
                    <i class="">{{$news->summary}}</i>
                    <p>
                        {{$news->content}}
                    </p>
                </div>
                <div class="col-md-5 pull-right">
                    <h3>Bài viết tương tự</h3>
                    @foreach($related as $relate)
                        <div class="row card section-row">
                            <div class="col-md-3">
                                <div class="thumbnail">
                                    <a href="{{route('news',$relate->id)}}"><img
                                                src="{{asset('upload/img_product/'.$relate->img)}}"
                                                class="img-responsive margin" alt="Image"></a>
                                </div>
                            </div>
                            <div class="col-md-8">
                                <a href="{{route('news',$relate->id)}}">{{$relate->title}}</a>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>

            <div class="text-center section-row">
                <div class="row">
                    <div class="col-md-5">
                        <hr>
                    </div>
                    <div class="col-md-2 section-title">Bình luận</div>
                    <div class="col-md-5">
                        <hr>
                    </div>
                </div>
            </div>
            {{--comment--}}
            @if(count($comments)>0)
                <div class="panel panel-default col-md-8 col-md-offset-2">
                    <div class="panel panel-body">
                        @foreach($comments as $cmt)
                            <strong class="col-md-12">{{$cmt->customers->username}}</strong><br>
                            <i class="col-md-8">{{$cmt->customers->email}}</i>
                            <i class="col-md-4">{{$cmt->customers->created_at}}</i>
                            <p class="col-md-12">{{$cmt->content}}</p>
                        @endforeach
                    </div>
                </div>
            @else
                <div class="text-center margin">
                    <pre>Chưa có bình luận.</pre>
                </div>
            @endif

            {{--end comment--}}
            {{--add comment--}}

            @if (Auth::guard('customer')->guest())
                You're not log in. Please <a class="" href="{{route('login')}}">Login</a>
                or <a class="" href="{{route('register')}}">Register</a> to comment
            @else
                <form action="{{url('news/comment')}}" method="POST" class="form-horizontal col-md-8 col-md-offset-2">
                    {!! csrf_field() !!}
                    <div class="form-group">
                        <textarea class="col-md-8 form-control" rows="5" name="content" id="comment"
                                  placeholder="Your comment" required></textarea>
                    </div>
                    <input type="hidden" name="commentable_id" value="{{$news->id}}">
                    <button class="btn btn-info btn-lg">Comment
                        as {{ Auth::guard('customer')->user()->username }}</button>
                </form>
            @endif
        </div>
    </div>
    {{--end add comment--}}
    <!--wrapper end-->
@endsection