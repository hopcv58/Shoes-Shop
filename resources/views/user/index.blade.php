@extends('layouts.user')
@section('content')
    <!--wrapper start-->
    <div id="wrapper">
        <div class="container">
            <!--image slide-->
            <section>
                <div class="row img-container section-row">
                    <div id="myCarousel" class="carousel slide" data-ride="carousel">
                        <!-- Indicators -->
                        <ol class="carousel-indicators">
                            <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
                            @for($i = 1; $i<count($slides);$i++)
                                <li data-target="#myCarousel" data-slide-to="{{$i}}"></li>
                            @endfor
                        </ol>
                        <!-- Wrapper for slides -->
                        <div class="carousel-inner" role="listbox">
                            @for($i = 0; $i<count($slides);$i++)
                                <div class="item {{ $i == 0 ? 'active' : '' }}">
                                    <img src="{{asset('upload/img_news/'.$slides[$i]->name)}}">
                                </div>
                            @endfor
                        </div>
                        <!-- Left and right controls -->
                        <a class="left carousel-control" href="#myCarousel" role="button" data-slide="prev">
                            <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
                            <span class="sr-only">Previous</span>
                        </a>
                        <a class="right carousel-control" href="#myCarousel" role="button" data-slide="next">
                            <span class="glyphicon glyphicon-chevron-right " aria-hidden="true"></span>
                            <span class="sr-only">Next</span>
                        </a>
                    </div>
                </div>
            </section>
            <!--image slide end-->
            <!--3 trailer image-->
            <section>
                <div class="row img-container section-row">
                    <div class="col-md-4">
                        <a href="{{url('category',1)}}"><img src="{{asset('upload/img_pages/category1_img.jpg')}}"
                                                             class="img-responsive margin" alt="Image"></a>
                    </div>
                    <div class="col-md-4">
                        <a href="{{url('category',2)}}"><img src="{{asset('upload/img_pages/category2_img.jpg')}}"
                                                             class="img-responsive margin" alt="Image"></a>
                    </div>
                    <div class="col-md-4">
                        <a href="{{url('category',3)}}"><img src="{{asset('upload/img_pages/category3_img.jpg')}}"
                                                             class="img-responsive margin" alt="Image"></a>
                    </div>
                </div>
            </section>
            <!--3 trailer image end-->
            @foreach($cateList as $cate)
                <section>
                    <!--section label-->
                    <div class="text-center section-row">
                        <div class="row">
                            <div class="col-md-5">
                                <hr>
                            </div>
                            <div class="col-md-2 section-title text-center">{{$cate->name}}</div>
                            <div class="col-md-5">
                                <hr>
                            </div>
                        </div>
                    </div>
                    <!--section label end-->
                    <!--section body-->
                    <div class="row">
                        @foreach($productList[$cate->id] as $pro)
                            <div class="col-md-3">

                                <div class="col-md-12 img-container">
                                    @if (isset($pro->advertisments))
                                        <div class="img-adv"><p>-{{$pro->advertisments->discount}}%</p></div>
                                    @endif
                                    <a href="{{route('product',[$pro->id])}}" class="row">
                                        <img src="{{asset('upload/img_product/'.$pro->img_profile)}}"
                                             class="img-responsive margin" alt="Image">
                                    </a>
                                    <div class="img-middle">
                                        <div class="img-overlay">
                                            <div class="col-md-6">
                                                <form action="{{ route('cart.store') }}" method="POST">
                                                    {!! csrf_field() !!}
                                                    <input type="hidden" name="id" value="{{ $pro->id }}">
                                                    <input type="hidden" name="name" value="{{ $pro->name }}">
                                                    @if (!isset($pro->advertisments))
                                                        <input type="hidden" name="price" value="{{ $pro->price }}">
                                                    @else
                                                        <input type="hidden" name="price"
                                                               value="{{$pro->price*(100-$pro->advertisments->discount)/100}}">
                                                    @endif
                                                    <input type="hidden" name="size" value="35">
{{--                                                    <input type="hidden" name="color"--}}
{{--                                                           value="{{array_unique(json_decode($pro->attribute)->color)[0]}}">--}}
                                                    <button type="submit"
                                                            class="glyphicon glyphicon-shopping-cart btn-default img-btn"
                                                            aria-hidden="true">
                                                    </button>
                                                </form>
                                            </div>
                                            <div class="col-md-6">
                                                <form action="{{ route('wishlist.store') }}" method="POST">
                                                    {!! csrf_field() !!}
                                                    <input type="hidden" name="id" value="{{ $pro->id }}">
                                                    <input type="hidden" name="name" value="{{ $pro->name }}">
                                                    @if (!isset($pro->advertisments))
                                                        <input type="hidden" name="price" value="{{ $pro->price }}">
                                                    @else
                                                        <input type="hidden" name="price"
                                                               value="{{$pro->price*(100-$pro->advertisments->discount)/100}}">
                                                    @endif
                                                    <input type="hidden" name="size" value="35">
{{--                                                    <input type="hidden" name="color"--}}
{{--                                                           value="{{array_unique(json_decode($pro->attribute)->color)[0]}}">--}}
                                                    <button type="submit"
                                                            class="glyphicon glyphicon-tags btn-default img-btn"
                                                            aria-hidden="true">
                                                    </button>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                    <div style="padding: 20px">
                                        <p class=" text-center"><strong>{{$pro->name}}</strong></p>
                                        @if (isset($pro->advertisments))
                                            <h3 class="text-center">
                                                {{number_format($pro->price*(100-$pro->advertisments->discount)/100)}} đ
                                            </h3>
                                            <h4 class="text-center">
                                                <strike>{{number_format($pro->price)}} đ</strike>
                                            </h4>
                                        @else
                                            <h3 class=" text-center">
                                                {{number_format($pro->price)}} đ
                                            </h3>
                                            <br>
                                        @endif
                                    </div>

                                </div>
                            </div>
                        @endforeach
                    </div>
                    <!--section body end-->
                    <!--section button-->
                    <div class="text-center section-row">
                        <a class=" section-button" href="{{route('category',$cate->id)}}">
                            Xem thêm
                        </a>
                    </div>
                    <!--section button end-->
                </section>
            @endforeach

            {{--Section tin tuc--}}
            <section>
                <!--section label-->
                <div class="text-center section-row">
                    <div class="row">
                        <div class="col-md-5">
                            <hr>
                        </div>
                        <div class="col-md-2 section-title text-center">Tin tức</div>
                        <div class="col-md-5">
                            <hr>
                        </div>
                    </div>
                </div>
                <!--section label end-->
                <!--section body-->
                <div class="row">
                    @foreach($newsList as $news)
                        <div class="col-md-3">
                            <div class="col-md-12">
                                <img src="{{asset('upload/img_news/'.$news->img)}}" width="100%"
                                     class=" margin" alt="Image" height="200px">
                                <p style="margin-top: 20px"><strong>{{$news->title}}</strong></p>
                                <p class="feedback-index">{!! $news->summary !!}</p>

                            </div>
                        </div>

                    @endforeach
                </div>
                <!--section body end-->
                <div class="text-center section-row">
                    <a class=" section-button" href="{{route('allNews')}}">
                        Xem thêm
                    </a>
                </div>
            </section>

            {{--.section tin tuc--}}
            <section>
                <!--section label-->
                <div class="text-center section-row">
                    <div class="row">
                        <div class="col-md-5">
                            <hr>
                        </div>
                        <div class="col-md-2 section-title text-center">Đánh giá</div>
                        <div class="col-md-5">
                            <hr>
                        </div>
                    </div>
                </div>
                <!--section label end-->
                <!--section body-->
                <div class="row">
{{--                    @foreach($feedbacks as $feedback)
                        <div class="col-md-2">
                            <div class="col-md-12">
                                <img src="http://placehold.it/150x150"
                                     class="img-circle margin" alt="Image">
                                @if(isset($feedback->customer_id))
                                    <p style="margin-top: 20px"><strong>{{$feedback->customers->username}}</strong></p>
                                @else
                                    <p style="margin-top: 20px"><strong>{{$feedback->username}}</strong></p>
                                @endif
                                <p class="feedback-index">
                                    {{$feedback->content}}
                                </p>
                            </div>
                        </div>
                    @endforeach--}}
                    <div class="col-md-2">
                            <img src="http://sw001.hstatic.net/6/01ecebb0cbcbcf/unnamed__1__grande.png"
                                 class="" alt="Image" width="100%" height="120px">
                                <p style="margin-top: 20px"><strong>Chị Diễn Vy</strong></p>
                            <p class="feedback-index">
                                Chất liệu kiểu dáng y hình mẫu. Mình rất hài lòng về sp của talaha. Bạn chăm sóc khách hàng tư vấn rất nhiệt tình...
                            </p>
                    </div>
                        <div class="col-md-2">
                                <img src="http://sw001.hstatic.net/2/023979a0ed2c65/14356057_10207566533900880_330190549_n_grande.png"
                                     class="img-feedback" alt="Image">
                                    <p style="margin-top: 20px"><strong>Chị Nguyễn Thị Quí</strong></p>

                                <p class="feedback-index">
                                    Mẫu mã của Talaha rất đa dạng, mình vừa mua 1 đôi sandal bên này đi lên dáng rất đẹp và êm chân. Giao hàng rất đúng hẹn...
                                </p>
                        </div>
                        <div class="col-md-2">
                                <img src="http://sw001.hstatic.net/6/01fa6799416ce0/14341788_10207565887044709_204502548_n_grande.png"
                                     class="img-feedback" alt="Image">
                                    <p style="margin-top: 20px"><strong>Chị Nguyễn Thu Liễu</strong></p>
                                <p class="feedback-index">
                                    Giày chất lượng và rất bền. Mong nhiều mẫu giày mới. Cảm thấy rất tin tưởng khi đặt giày của Talaha...
                                </p>
                        </div>
                        <div class="col-md-2">
                                <img src="http://sw001.hstatic.net/5/0202badb19cc84/14365359_10207565915165412_507229059_n_grande.png"
                                     class="img-feedback" alt="Image">
                                    <p style="margin-top: 20px"><strong>Chị Nguyễn Thị Thanh Tâm</strong></p>
                                <p class="feedback-index">
                                    Mình rất thích giày của shop. Mỗi lần đi chọn giày là mình rất vất vả mà giày của shop nhìn là mình ưng liền mà đi thì...
                                </p>
                        </div>
                        <div class="col-md-2">
                                <img class="img-feedback" src="http://sw001.hstatic.net/5/01ecefa405c40e/unnamed_grande.png" alt="Image">
                                    <p style="margin-top: 20px"><strong>Chị Hằng Nguyễn</strong></p>
                                <p class="feedback-index">
                                    Thích talaha vì mang rất êm chân. Mang đc 2 đôi mà tới giờ còn chưa suy suyển...
                                </p>
                        </div>
                        <div class="col-md-2">
                                <img src="http://sw001.hstatic.net/2/0206cc97e86a81/unnamed_grande.png"
                                     class="img-feedback" alt="Image">
                                    <p style="margin-top: 20px"><strong>Chị Nguyễn Thị Lệ Thủy</strong></p>
                                <p class="feedback-index">
                                    Giày Talaha kiểu dáng y như hình.  Ngoài còn đẹp hơn ý, đi rất êm chân. Em rất thích...
                                </p>
                        </div>
                </div>
                <!--section body end-->
                <!--section button-->
                <!--section button end-->
            </section>
        </div>
    </div>
@endsection

