@extends('layouts.user')
@section('content')
    <!--wrapper start-->
    <div id="wrapper">
        <div class="container">
            <div class="row">

                <div class="col-md-5">
                    <div class="col-md-12 thumbnail">
                        <div class="prezoom" data-scale="4"
                             data-image="{{asset('upload/img_product/'.$product->img_profile)}}"></div>
                    </div>
                    <div class="col-md-3">
                        <div class="thumbnail">
                            <a href="{{route('product',$product->id)}}"><img src="http://placehold.it/500x500"
                                                                             class="img-responsive margin" alt="Image"></a>
                        </div>
                    </div>
                    <pre>
                        <?php
                        foreach ($option as $value) {
                            var_dump($value);
                        }
                        ?>
                    </pre>
                </div>
                <div class="col-md-6">
                    <h2>{{$product->name}}</h2>
                    @if (isset($product->advertisments))
                        <h4>
                            <span class=" text-center"><strike>{{$product->price}}</strike></span>
                            <span class=" text-center"><strong>{{$product->price*(100-$product->advertisments->discount)/100}} {{$product->code}}</strong></span>
                        </h4>

                    @else
                        <h4 class=" text-center"><strong>{{$product->price}} {{$product->code}}</strong>
                        </h4>
                    @endif
                    <div class="row col-md-12">
                        {!! $product->description  !!}
                    </div>
                    <form method="POST">
                        <div class="col-md-12">
                            <h4>Chọn màu:</h4>
                            <select class="form-control" name="color" id="material">
                                <?php
                                $colors = array_unique(json_decode($product->attribute)->color)
                                ?>
                                @foreach ($colors as $color)
                                    <option>{!! $value['color'] !!}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-12">
                            <h4>Chọn size:</h4>
                            <select class="form-control" name="size" id="material">
                                @for($i = 35; $i <= 40; $i++)
                                    <option>{!! $i !!}</option>
                                @endfor
                            </select>
                        </div>
                        <div class="col-md-4">
                            <input type="submit" formaction="{{ route('cart.store') }}" class="btn btn-success btn-lg"
                                   value="Add to Cart">
                        </div>
                        <div class="col-md-4">
                            <input type="submit" formaction="{{ route('wishlist.store') }}"
                                   class="btn btn-primary btn-lg" value="Add to Wishlist">
                        </div>
                        {!! csrf_field() !!}
                        <input type="hidden" name="id" value="{{ $product->id }}">
                        <input type="hidden" name="name" value="{{ $product->name }}">
                        @if (isset($product->advertisments))
                            <input type="hidden" name="price"
                                   value="{{$product->price*(100-$product->advertisments->discount)/100}}">
                        @else
                            <input type="hidden" name="price" value="{{$product->price}}">
                        @endif
                    </form>
                </div>
            </div>
            {{--comment--}}
            <div class="row">
                @if(count($comment)>0)
                    <div class="text-center section-row">
                        <div class="row">
                            <div class="col-md-5">
                                <hr>
                            </div>
                            <div class="col-md-2 section-title">Ý kiến khách hàng</div>
                            <div class="col-md-5">
                                <hr>
                            </div>
                        </div>
                    </div>
                    <div class="panel panel-default col-md-8 col-md-offset-2">
                        <div class="panel panel-body">
                            @foreach($comment as $cmt)
                                <strong class="col-md-12">{{$cmt->username}}</strong><br>
                                <i class="col-md-8">{{$cmt->email}}</i>
                                <i class="col-md-4">{{$cmt->created_at}}</i>
                                <p class="col-md-12">{{$cmt->content}}</p>
                            @endforeach
                        </div>
                    </div>
            </div>
            @endif
            {{--end comment--}}
            {{--add comment--}}

            @if (Auth::guard('customer')->guest())
                You're not log in. Please <a class="" href="{{route('login')}}">Login</a>
                or <a class="" href="{{route('register')}}">Register</a> to comment
            @else
                <form action="{{url('product/comment')}}" method="POST" class="form-horizontal col-md-8 col-md-offset-2">
                    {!! csrf_field() !!}
                    <div class="form-group">
                        <textarea class="col-md-8 form-control" rows="5" name="content" id="comment"
                                  placeholder="Your comment" required></textarea>
                    </div>
                    <input type="hidden" name="commentable_id" value="{{$product->id}}">
                    <input type="hidden" name="customer_id" value="{{Auth::guard('customer')->user()->id}}">
                    <button class="btn btn-info btn-lg">Comment
                        as {{ Auth::guard('customer')->user()->username }}</button>
                </form>
            @endif
        </div>
    </div>
    {{--end add comment--}}
    <!--wrapper end-->
@endsection


@section('extra_js')
    <script>
        var elementThumbnailPhoto = 'prezoom';
        var elementPhoto = 'zoomed';

        $('.' + elementThumbnailPhoto)
        // tile mouse actions
            .on('mouseover', function ()
            {
                $(this).children('.' + elementPhoto).css({
                    'transform': 'scale(' + $(this).attr('data-scale') + ')'
                });
            })
            .on('mouseout', function ()
            {
                $(this).children('.' + elementPhoto).css({
                    'transform': 'scale(1)'
                });
            })
            .on('mousemove', function (e)
            {
                $(this).children('.' + elementPhoto).css({
                    'transform-origin': ((e.pageX - $(this).offset().left) / $(
                        this).width()) * 100 + '% ' + ((e.pageY - $(this).offset().top) / $(this).height()) * 100 + '%'
                });
            })
            // tiles set up
            .each(function ()
            {
                $(this)
                // add a photo container
                    .append('<div class="' + elementPhoto + '"></div>')
                    // set up a background image for each tile based on data-image attribute
                    .children('.' + elementPhoto).css({
                    'background-image': 'url(' + $(this).attr('data-image') + ')'
                });
            })
    </script>
    <script>

    </script>
@endsection