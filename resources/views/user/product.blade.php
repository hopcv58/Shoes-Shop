@extends('layouts.user')
@section('content')
    {{--init--}}
    <?php
    $attribute = json_decode($product->attribute);
    $colors = !empty($attribute->color) ? array_unique($attribute->color) : [];
    $sizes = !empty($attribute->size) ? array_unique($attribute->size) : [];
    $images = json_decode($product->img) !== null ? json_decode($product->img) : [];
    ?>
    <div class="row">
        <div>
            <ol class="breadcrumb">
                <li><a href="{{route('index')}}">Trang chủ</a></li>
                <li class="active">{{$product->name}}</li>
            </ol>
        </div>
        <div class="col-md-4">
            <img id="zoom_01" src="{{asset('upload/img_product/'.$product->img_profile)}}"
                 data-zoom-image="{{asset('upload/img_product/'.$product->img_profile)}}"/>
            <div id="gal1">
                <a href="#" data-image="{{asset('upload/img_product/'.$product->img_profile)}}"
                   data-zoom-image="{{asset('upload/img_product/'.$product->img_profile)}}">
                    <img id="zoom_01" src="{{asset('upload/img_product/'.$product->img_profile)}}"/>
                </a>
                @foreach($images as $img)
                    <a href="#" data-image="{{asset('upload/img_product/'.$img)}}"
                       data-zoom-image="{{asset('upload/img_product/'.$img)}}">
                        <img id="zoom_01" src="{{asset('upload/img_product/'.$img)}}"/>
                    </a>
                @endforeach
            </div>
        </div>
        <div class="col-md-4">
            <h3>{{$product->name}}</h3>
            <p style="color: #989898"> Còn hàng</p>
            <h4 style="font-weight: bold; margin-top: 20px"> Dịch vụ khách hàng </h4>
            <ul class="dichvu">
                <li>Bảo hành chọn đời</li>
                <li>Miễn phí giao hàng trong nội thành</li>
                <li>Hỗ trợ miễn phí 24/7</li>
            </ul>
            <div class="col-md-12">
                <form method="POST" class="form-horizontal form-chi-tiet">
                    <div class="form-group">
                        <label for="color" class="control-label" style="margin-bottom: 10px">Màu Sắc</label>
                        <select class="form-control" name="color" id="material">
                            @foreach ($colors as $color)
                                <option>{!! $color !!}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="size" class="control-label" style="margin-bottom: 10px">Kích thước</label>
                        <select class="form-control" name="size" id="size">
                            @foreach ($sizes as $size)
                                <option>{!! $size !!}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group" style="">
                        @if (isset($product->advertisments))
                            <p style="color: #6e6e6e">Giá bán: <strike>{{number_format($product->price)}} đ</strike></p>
                            <strong>Khuyến mãi: <span class="text-danger">{{number_format($product->price*(100-$product->advertisments->discount)/100)}}
                                    đ</span>
                            </strong>

                        @else
                            <strong>Giá bán: <span class="text-danger">{{number_format($product->price)}} đ</span>
                            </strong>
                        @endif
                    </div>
                    <div class="form-group">
                        <input type="submit" formaction="{{ route('cart.store') }}" class="btn btn-sm my-default-btn"
                               value="Chọn mua">
                        <input type="submit" formaction="{{ route('wishlist.store') }}"
                               class="btn btn-sm my-default-btn" value="Yêu thích">
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
        <div class="col-md-4 thong-tin-san-pham">
            <h3>Thông tin sản phẩm</h3>
            <p>Sản phẩm: {{$product->name}}</p>
            <p>Chất liệu: {{$product->material}}</p>
            <p>Độ cao: {{$product->height}}</p>
            <p>Màu sắc: {{implode(", ",$colors)}}</p>
            <p>Kích cỡ: {{implode(", ",$sizes)}}</p>
            <p>Phối đồ: {{$product->phoi_do}}</p>
            <br>
            <p><strong>ĐẶC ĐIỂM NỔI BẬT</strong></p>
            {!! $product->description  !!}
        </div>
    </div>


    <div class="row">
        <hr style="color: #d0d0d0">

        {{--comment--}}
        <p><strong>{{count($comment)}} Bình luận </strong></p>
        <hr style="border-top: 1px solid #cccccc">
        {{--add comment--}}
        <div class="col-md-12 comment-product">
            @if (Auth::guard('customer')->guest())
                Hãy đăng nhập để đánh giá sản phẩm. <a class="" href="{{route('login')}}">Đăng nhập</a>
                or <a class="" href="{{route('register')}}">Đăng ký</a>
            @else
                <form action="{{url('product/comment')}}" method="POST"
                      class="form-horizontal">
                    {!! csrf_field() !!}
                    <div class="form-group">
                        <textarea class="form-control" rows="3" name="content" id="comment"
                                  placeholder="Your comment" required></textarea>
                    </div>
                    <input type="hidden" name="commentable_id" value="{{$product->id}}">
                    <input type="hidden" name="customer_id" value="{{Auth::guard('customer')->user()->id}}">
                    <div class="pull-right">
                        <button class="btn btn-sm my-default-btn">Comments</button>
                    </div>
                </form>
            @endif
        </div>
        {{--end add comment--}}
        @if(count($comment)>0)
            @foreach($comment as $cmt)
                <div style="margin-bottom: 15px">
                    <p><strong style="color: #000000">{{$cmt->username}}</strong>
                        <span class="pull-right"><i>{{date_format($cmt->created_at, 'd-m-Y')}}</i></span></p>
                    {{--<p><i>{{$cmt->email}}</i></p>--}}
                    <p>{{$cmt->content}}</p>
                </div>
            @endforeach
        @endif
        {{--end comment--}}

    </div>

    <div class="row">
        {{--related--}}
        @if(count($related)>0)
            <hr>
            <h3 class="Bold">Sản phẩm liên quan</h3>
            <br>
            @foreach($related as $relate)
                <div class="col-md-3">
                    <div class="product-item" style="height: 450px">
                        <a href="{{route('product',[$relate->id])}}">
                            <img src="{{asset('upload/img_product/'.$relate->img_profile)}}"
                                 class="img-responsive margin"
                                 alt="Image">
                        </a>
                        <div class="img-middle-cate">
                            <div class="img-overlay">
                                <div class="col-md-6">
                                    <form action="{{ route('cart.store') }}" method="POST">
                                        {!! csrf_field() !!}
                                        <input type="hidden" name="id" value="{{ $relate->id }}">
                                        <input type="hidden" name="name" value="{{ $relate->name }}">
                                        @if (!isset($relate->advertisments))
                                            <input type="hidden" name="price" value="{{ $relate->price }}">
                                        @else
                                            <input type="hidden" name="price"
                                                   value="{{$relate->price*(100-$relate->advertisments->discount)/100}}">
                                        @endif
                                        <input type="hidden" name="size" value="35">
                                        <input type="hidden" name="color"
                                               value="{{!empty(json_decode($relate->attribute)->color) ? array_unique(json_decode($relate->attribute)->color)[0] : 0}}">
                                        <button type="submit"
                                                class="glyphicon glyphicon-shopping-cart btn-default img-btn"
                                                aria-hidden="true">
                                        </button>
                                    </form>
                                </div>
                                <div class="col-md-6">
                                    <form action="{{ route('wishlist.store') }}" method="POST">
                                        {!! csrf_field() !!}
                                        <input type="hidden" name="id" value="{{ $relate->id }}">
                                        <input type="hidden" name="name" value="{{ $relate->name }}">
                                        @if (!isset($relate->advertisments))
                                            <input type="hidden" name="price" value="{{ $product->price }}">
                                        @else
                                            <input type="hidden" name="price"
                                                   value="{{$relate->price*(100-$relate->advertisments->discount)/100}}">
                                        @endif
                                        <input type="hidden" name="size" value="35">
                                        <input type="hidden" name="color"
                                               value="{{!empty(json_decode($relate->attribute)->color) ? array_unique(json_decode($relate->attribute)->color)[0] : 0}}">
                                        <button type="submit"
                                                class="glyphicon glyphicon-tags btn-default img-btn"
                                                aria-hidden="true">
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </div>
                        <div class="img-label">
                            <h5 class=" text-center"><strong>{{$relate->name}}</strong></h5>
                            @if (isset($product->advertisments))
                                <h3 class="text-center">
                                    {{number_format($product->price*(100-$product->advertisments->discount)/100)}} đ
                                </h3>
                                <h4 class="text-center">
                                    <strike>{{number_format($product->price)}} đ</strike>
                                </h4>
                            @else
                                <h3 class=" text-center">
                                    {{number_format($product->price)}} đ
                                </h3>
                                <br>
                            @endif

                        </div>
                    </div>

                </div>
            @endforeach
        @endif
        {{--related--}}
    </div>
@endsection


@section('extra_js')
    <script>
        function changeImg(img) {
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
        $("#zoom_01").bind("click", function (e) {
            var ez = $('#zoom_01').data('elevateZoom');
            $.fancybox(ez.getGalleryList());
            return false;
        });
    </script>
@endsection