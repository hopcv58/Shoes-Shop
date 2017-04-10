@extends('layouts.user')
@section('content')
    <!--wrapper start-->
    <div id="wrapper">
        <div class="container">
            @foreach($newsList as $news)
                <div class="row card section-row">
                    <div class="col-md-1">
                        <div class="thumbnail">
                            <a href="{{route('news',$news->id)}}"><img
                                        src="{{asset('upload/img_product/'.$news->img)}}"
                                        class="img-responsive margin" alt="Image"></a>
                        </div>
                    </div>
                    <div class="col-md-8">
                        <a href="{{route('news',$news->id)}}">{{$news->title}}</a>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
    {{--end add comment--}}
    <!--wrapper end-->
@endsection