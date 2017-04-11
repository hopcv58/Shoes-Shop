@extends('layouts.user')
@section('content')
    <!--wrapper start-->
    <div class="container">
        <img src="//hstatic.net/246/1000067246/1000154680/blog_xuhuong_img.jpg?v=329" alt="" class="img-responsive" />
        <ol class="breadcrumb">
            <li><a href="{{route('index')}}">Trang chủ</a></li>
            <li class="active"><span>Blog</span></li>
        </ol>
    </div>
    <div id="wrapper">
        <div class="container">
            <h3 class="text-center">XU HƯỚNG THỜI TRANG</h3>
            <hr style="background-color: #2a2a2a; height: 1px">
            {{--<div class="row section-row">--}}
            @foreach($newsList as $news)
                    <div class="col-md-3 section-row">
                            <a href="{{route('news',$news->id)}}"><img
                                        src="{{asset('upload/img_news/'.$news->img)}}"
                                        class="img-responsive margin" alt="Image"></a>
                            <a href="{{route('news',$news->id)}}">{{$news->title}}</a>
                            <p>{{$news->summary}}</p>
                    </div>
            @endforeach
            {{--</div>--}}
        </div>
    </div>
    {{--end add comment--}}
    <!--wrapper end-->
@endsection