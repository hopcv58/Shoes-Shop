@extends('layouts.user')
@section('no_left_bar')
    {{--init--}}
    <?php
    $colors = array_unique(json_decode($product->attribute)->color);
    $images = json_decode($product->img);
    ?>
    <div class="row">
        <div class="col-md-4">
            <img id="zoom_01" src="{{asset('upload/img_product/'.$product->img_profile)}}"
                 data-zoom-image="{{asset('upload/img_product/'.$product->img_profile)}}"/>
            <div id="gal1">
                <a href="#" class="thumbnail" data-image="{{route('product',$product->img_profile)}}"
                   data-zoom-image="{{asset('upload/img_product/'.$product->img_profile)}}">
                    <img id="zoom_01" src="{{asset('upload/img_product/'.$product->img_profile)}}"/>
                </a>
                @foreach($images as $img)
                    <a href="#" class="thumbnail" data-image="{{asset('upload/img_product/'.$img)}}"
                       data-zoom-image="{{asset('upload/img_product/'.$img)}}">
                        <img id="zoom_01" src="{{asset('upload/img_product/'.$img)}}"/>
                    </a>
                @endforeach
            </div>
        </div>
        <div class="col-md-7">
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
                        @foreach ($colors as $color)
                            <option>{!! $color !!}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-12">
                    <h4>Chọn size:</h4>
                    <select class="form-control" name="size" id="size">
                        @for($i = 35; $i <= 40; $i++)
                            <option>{!! $i !!}</option>
                        @endfor
                    </select>
                </div>
                <div class="col-md-4">
                    <div class="spacer"></div>
                    <input type="submit" formaction="{{ route('cart.store') }}" class="btn btn-success btn-lg"
                           value="Add to Cart">
                </div>
                <div class="col-md-4">
                    <div class="spacer"></div>
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
        @endif
    </div>

    {{--end comment--}}
    {{--add comment--}}

    @if (Auth::guard('customer')->guest())
        You're not log in. Please <a class="" href="{{route('login')}}">Login</a>
        or <a class="" href="{{route('register')}}">Register</a> to comment
    @else
        <form action="{{url('product/comment')}}" method="POST"
              class="form-horizontal col-md-8 col-md-offset-2">
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
    {{--end add comment--}}
@endsection


@section('extra_js')
    <script>
        function changeImg(img)
        {
            document.getElementById()
        }
    </script>
    <script>
        //initiate the plugin and pass the id of the div containing gallery images
        $("#zoom_01").elevateZoom({
            gallery: 'gal1',
            cursor: 'pointer',
            galleryActiveClass: 'active',
            imageCrossfade: true,
            loadingIcon: ''
        });
        //pass the images to Fancybox
        $("#zoom_01").bind("click", function (e)
        {
            var ez = $('#zoom_01').data('elevateZoom');
            $.fancybox(ez.getGalleryList());
            return false;
        });
    </script>
@endsection