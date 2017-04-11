<!DOCTYPE html>
<html lang="{{ config('app.locale') }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Shoe shop') }}</title>

    <!-- Styles -->
    <link href="{{ asset('user/css/bootstrap.css') }}" rel="stylesheet">
    {{--<link href="{{ asset('css/app.css') }}" rel="stylesheet">--}}
    <link href="{{ asset('user/css/my.css') }}" rel="stylesheet">

    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.5.0/css/font-awesome.min.css">
    <!-- Ionicons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.1/css/ionicons.min.css">

    <!-- Scripts -->
    <script src="{{ asset('user/js/jquery.js') }}"></script>
    <script src="{{ asset('user/js/bootstrap.min.js') }}"></script>
    <script>
        window.Laravel = {!! json_encode([
            'csrfToken' => csrf_token(),
        ]) !!};
    </script>
</head>
<body>
<!--header start-->
<header>
    <div class="header-wrapper">
        <div class="container">
            <div class="row">
                <div class="col-md-3 pull-left">
                    <ul class="list-unstyled clearfix">
                        <li class="facebook">
                            <a target="_blank" href="https://www.facebook.com/talaha.vn" class="fa fa-facebook"></a>
                        </li>
                        <li class="twitter">
                            <a class="fa fa-twitter" target="_blank" href="#"></a>
                        </li>
                        <li class="google-plus">
                            <a class="fa fa-google-plus" target="_blank" href="#"></a>
                        </li>
                        <li class="youtube">
                            <a class="fa fa-youtube" target="_blank" href="#"></a>
                        </li>
                        <li class="instagram">
                            <a class="fa fa-instagram" target="_blank" href="#"></a>
                        </li>
                    </ul>
                </div>
                <div class="col-md-5 col-md-offset-2 ">
                    <div class="pull-right">
                        <a class="text-header" href="{{route('allNews')}}">Xu hướng thời trang | </a>
                        <a class="text-header" href="#"> Chính sách đổi trả | </a>
                        <a class="text-header" href="#"> Hướng dẫn chọn size giày </a>
                    </div>
                </div>
                <div class="col-md-2">
                    <div class="pull-right">
                        <span><i class="fa fa-phone"></i><strong><a href="#"
                                                                    style="margin-left: 10px">08 88340410</a></strong></span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</header>
<!--header end-->
<!--title-->
<div class="navbar navbar-default nav-nomargin">
    <div class="container">
        <div class="col-md-2">
            <div class="pull-left"><a class="navbar-text" href="{{route('index')}}"><img
                            src="{{asset('upload/img_product/logo.png')}}"></a></div>
        </div>
        <div class="col-md-4" style="margin-top: 10px">
            <form action="{{route('search')}}" class="navbar-form navbar-left">
                <div class="input-group">
                    <input type="text" name="input" class="form-control" placeholder="search..." style="border-radius: 0px;">
                    <span class="input-group-btn">
                        <button type="submit" class="btn btn-default"><i class="fa fa-search"></i></button>
                    </span>
                </div>
            </form>

        </div>
       {{-- <div class="col-md-2 info">
            <div class="policy-text">
                <strong>BẢO HÀNH SẢN PHẨM</strong>
                <p class="small">TRỌN ĐỜI</p>
            </div>
        </div>--}}
        <div class="col-md-2 info">
            <div class="policy-text">
                <strong>MIỄN PHÍ VẬN CHUYỂN</strong>
                <p class="small">ĐƠN HÀNG NGUYÊN GIÁ</p>
            </div>
        </div>
        <div class="col-md-2 info">
            <div class="policy-text">
                <strong>HỖ TRỢ MIỄN PHÍ</strong>
                <p class="small">24/7</p>
            </div>
        </div>
        <div class="col-md-2 login-area info">
            {{--login area--}}
            <div class="pull-right">
                @if (Auth::guard('customer')->guest())
                    <ul class="list-unstyled">
                        <li><a href="{{ route('register') }}"><span class="glyphicon glyphicon-user"></span> Sign Up</a>
                        </li>
                        <li><a href="{{ route('login') }}"><span class="glyphicon glyphicon-log-in"></span> Login</a>
                        </li>
                    </ul>
                @else
                    <ul class="list-unstyled">
                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button"
                               aria-expanded="false">
                                {{ Auth::guard('customer')->user()->username }} <span class="caret"></span>
                            </a>

                            <ul class="dropdown-menu" role="menu">
                                <li>
                                    <a href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        Logout
                                    </a>
                                    <form id="logout-form" action="{{ route('logout') }}" method="POST"
                                          style="display: none;">
                                        {{ csrf_field() }}
                                    </form>
                                </li>
                                <li>
                                    <a href="{{route('order.index')}}">Xem các đơn hàng</a>
                                </li>
                            </ul>
                        </li>
                    </ul>
                @endif
            </div>
            {{--login area--}}
        </div>
        <!--<div class="nav navbar-nav">-->
        <!--<li><a href="#"><span class="glyphicon glyphicon-user"></span> </a></li>-->
        <!--<li><a href="#"><span class="glyphicon glyphicon-log-in"></span> </a></li>-->
        <!--</div>-->

    </div>
</div>
<!--title end-->
<div id="app" class="body-content">
    <!--navbar-->
    <div class="nav-wrapper">
        <nav class="navbar" data-spy="affix" data-offset-top="130"
             style="background-color: #fff; padding: 10px;">
            <div class="container">
                <ul class="nav navbar-nav">
                    <li class="trangchu"><a href="{{route('index')}}">TRANG CHỦ</a>
                        <ul class="lienhe list-unstyled">
                            <li><a href="#">GIỚI THIỆU</a></li>
                            <li><a href="#">LIÊN HỆ</a></li>
                        </ul>
                    </li>
                    <li><a href="{{route('index')}}">SẢN PHẨM MỚI</a></li>
                    {{--<li class="dropdown">--}}
                    {{--<a class="dropdown-toggle" data-toggle="dropdown" href="#">Tất cả sản phẩm--}}
                    {{--<span class="caret"></span></a>--}}
                    {{--<ul class="dropdown-menu">--}}
                    @foreach($cateList as $category)
                        <li><a href="{{url('category',[$category->id])}}">{{$category->name}}</a></li>
                    @endforeach
                    {{--</ul>--}}
                    {{--</li>--}}
                    <li>
                        <a href="{{route('allNews')}}">TIN TỨC</a>
                    </li>
                    @yield('extra_nav')
                </ul>
                <ul class="nav navbar-nav navbar-right">
                    {{--     <li>
                             <form action="{{route('search')}}" class="navbar-form navbar-left">
                                 <div class="form-group">
                                     <input type="text" name="input" class="form-control">
                                 </div>
                                 <button type="submit" class="btn btn-primary"><span
                                             class="glyphicon glyphicon-search"></span> Search
                                 </button>
                             </form>
                         </li>--}}

                    {{--cart/wishlist area--}}
                    <li><a href="{{ url('/wishlist') }}">wishlist
                            ({{ Cart::instance('wishlist')->count(false) }})</a></li>
                    <li><a href="{{ url('/cart') }}"><span class="glyphicon glyphicon-shopping-cart"></span>
                            ({{ Cart::instance('default')->count(false) }})</a></li>

                    {{--cart/wishlist area end--}}
                </ul>
            </div>
            <hr>
        </nav>

    </div>
    <!--navbar end-->
    @yield('content')
</div>
<!--footer begin-->
<footer class="footer">
    <div class="container">
        <div class="col-md-4">
            <h4>GIỚI THIỆU TALAHA</h4>
            <br>
            <p>Talaha tôn vinh người phụ nữ hiện đại với phong cách thời thượng, cởi mở và cũng rất duyên dáng, thân
                thiện.</p>
            <br>
            <h4>THÔNG TIN LIÊN LẠC</h4>
            <p>HOTLINE: 0888340410 </p>
            <p>Giờ mở cửa: 08:00-22:00</p>
            <p>Mail: cskh@talaha.vn</p>
            <div class="col-md-12" style="margin-top: 10px">
                <img src="{{asset('upload/img_pages/chungchi.png')}}" alt="">
            </div>
            <div class="col-sm-12 col-xs-12 mobile-icon" style="margin-top: 20px;">
                <ul class="list-unstyled clearfix">
                    <li class="facebook">
                        <a target="_blank" href="https://www.facebook.com/talaha.vn" class="fa fa-facebook"></a>
                    </li>
                    <li class="twitter">
                        <a class="fa fa-twitter" target="_blank" href="#"></a>
                    </li>
                    <li class="google-plus">
                        <a class="fa fa-google-plus" target="_blank" href="#"></a>
                    </li>
                    <li class="youtube">
                        <a class="fa fa-youtube" target="_blank" href="#"></a>
                    </li>
                    <li class="instagram">
                        <a class="fa fa-instagram" target="_blank" href="#"></a>
                    </li>
                </ul>
            </div>
        </div>
        <div class="col-md-2">
            <h4>HỖ TRỢ KHÁCH HÀNG</h4>
            <ul class="list-unstyled">
                <li><a href="#">Hướng dẫn chọn size</a></li>
                <li><a href="#">Chính sách bảo hành và đổi trả</a></li>
                <li><a href="#">Quy định hình thức thanh toán và giao hàng</a></li>
                <li><a href="#">Chính sách bảo mật</a></li>
            </ul>
        </div>
        <div class="col-md-2">
            <h4>TIN TỨC</h4>
            <br>
            <ul class="list-unstyled">
                <li><a href="#">Xu hướng thời trang</a></li>
                <li><a href="#">Thông tin khuyến mãi</a></li>
                <li><a href="#">Bộ sưu tập</a></li>
            </ul>
        </div>
        <div class="col-md-4">
            <h4>FANPAGE FACEBOOK</h4>
            <div class="fb-page" data-href="https://www.facebook.com/facebook"
                 data-small-header="false" data-adapt-container-width="true" data-hide-cover="false"
                 data-show-facepile="true">
                {{--<blockquote cite="https://www.facebook.com/facebook" class="fb-xfbml-parse-ignore"><a--}}
                {{--href="https://www.facebook.com/facebook">Facebook</a></blockquote>--}}
            </div>
        </div>
    </div>
</footer>
@yield('extra_js')
<!--footer end-->
<!-- Scripts -->
<div id="fb-root"></div>
<script>(function (d, s, id) {
        var js, fjs = d.getElementsByTagName(s)[0];
        if (d.getElementById(id)) return;
        js = d.createElement(s);
        js.id = id;
        js.src = "//connect.facebook.net/en_US/sdk.js#xfbml=1&version=v2.8";
        fjs.parentNode.insertBefore(js, fjs);
    }(document, 'script', 'facebook-jssdk'));
</script>
</body>
</html>
