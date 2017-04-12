@extends('layouts.user')
@section('content')
    <!--wrapper start-->
    <div id="wrapper">
        <div class="container">
            <div>
                <img src="{{asset("upload/img_pages/header_blog_img2.jpg")}}" alt=""
                     class="img-responsive"/>
                <ol class="breadcrumb">
                    <li><a href="{{route('index')}}">Trang chủ</a></li>
                    <li class="active">Blogs</li>
                </ol>
            </div>
            <div class="row">
                <div class="col-md-10 col-md-offset-1">
                    <img src="{{asset("upload/img_news/$news->img")}}" class="img-responsive text-center" width="100%"
                         alt="">
                    <div style="padding: 20px 30px">
                        <h2 class="text-center" style="margin-bottom: 50px">{{$news->title}}</h2>
                        <p class="pull-right">Ngày đăng: {{date_format($news->updated_at, 'd-m-Y')}}</p>
                        <br>
                        <p style="margin-top: 30px"><em>{!! $news->summary !!}</em></p>
                        <div class="tintuc">
                            {!! $news->content !!}
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div>
            <hr>
            <h4 class="text-center">Bình luận của bạn</h4>

            {{--comment--}}
            @if(count($comments)>0)
                <div class="col-md-8 col-md-offset-2">
                    @foreach($comments as $cmt)
                        <div style="margin-bottom: 30px">
                            <h5 style="font-weight: bold;">{{$cmt->customers->username}}
                                <small style="color: #919191">{{date_format($cmt->customers->created_at, 'd-m-Y')}}</small>
                            </h5>
                            <p>{!! $cmt->content !!}</p>
                        </div>
                    @endforeach
                </div>
            @else
                <div class="col-md-8 col-md-offset-2">
                    <div class="panel panel-body">
                        <strong class="col-md-12">Chưa có bình luận</strong><br>
                    </div>
                </div>
            @endif

            {{--end comment--}}
            {{--add comment--}}

            @if (Auth::guard('customer')->guest())
                <div class="col-md-8 col-md-offset-2">
                    You're not log in. Please <a class="" href="{{route('login')}}">Login</a>
                    or <a class="" href="{{route('register')}}">Register</a> to comment
                </div>
            @else
                <form action="{{url('news/comment')}}" method="POST" class="form-horizontal col-md-8 col-md-offset-2">
                    {!! csrf_field() !!}
                    <div class="form-group">
                        <textarea class="col-md-8 form-control" rows="5" name="content" id="comment"
                                  placeholder="Your comment" required></textarea>
                    </div>
                    <input type="hidden" name="commentable_id" value="{{$news->id}}">
                    <input type="hidden" name="customer_id" value="{{Auth::guard('customer')->user()->id}}">
                    <button class="btn my-default-btn">Comment
                        as {{ Auth::guard('customer')->user()->username }}</button>
                </form>
            @endif
        </div>

    </div>{{--end add comment--}}
@endsection