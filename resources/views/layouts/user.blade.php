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
{{--<link href="{{ asset('user/css/style.css') }}" rel="stylesheet">--}}

<!-- Scripts -->
    <script src="{{ asset('user/js/jquery.js') }}"></script>
    <script src="{{ asset('user/js/bootstrap.min.js') }}"></script>
    <script src="{{asset('user/js/jquery.elevatezoom.js')}}"></script>
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
                <div class="col-md-3">Shop bán giày</div>
                <h6 class="col-md-5 col-md-offset-2 ">
                    <a class="text-header" href="{{route('allNews')}}">Xu hướng thời trang | </a>
                    <a class="text-header" href="#"> Chính sách đổi trả | </a>
                    <a class="text-header" href="#"> Hướng dẫn chọn size giày </a>
                </h6>
                <div class="col-md-2 pull-right">
                    <a class="text-header" href="#"><strong>01689719045</strong></a>
                </div>
            </div>
        </div>
    </div>
</header>
<!--header end-->
<!--title-->
<div class="navbar navbar-default nav-nomargin">
    <div class="container">
        <div class="nav navbar-nav col-md-4">
            <li><a class="navbar-text" href="{{route('index')}}"><img
                            src="{{asset('upload/img_product/logo.png')}}"></a></li>
        </div>
        <div class="pull-right">
            <div class="navbar-text">
                <div class="col-md-2">
                    <h2 class="glyphicon glyphicon-certificate"></h2>
                </div>
                <div class="pull-right">
                    <h4><strong>Bảo hành sản phẩm</strong></h4>
                    <p>trọn đời</p>
                </div>
            </div>
            <div class="navbar-text">
                <div class="col-md-2">
                    <h2 class="glyphicon glyphicon-certificate"></h2>
                </div>
                <div class="pull-right">
                    <h4><strong>Miễn phí vận chuyển</strong></h4>
                    <p>trong khu vực miền Bắc</p>
                </div>
            </div>
            <div class="navbar-text">
                <div class="col-md-2">
                    <h2 class="glyphicon glyphicon-certificate"></h2>
                </div>
                <div class="pull-right">
                    <h4><strong>Hỗ trợ miễn phí</strong></h4>
                    <p>24/7</p>
                </div>
            </div>
            <!--<div class="nav navbar-nav">-->
            <!--<li><a href="#"><span class="glyphicon glyphicon-user"></span> </a></li>-->
            <!--<li><a href="#"><span class="glyphicon glyphicon-log-in"></span> </a></li>-->
            <!--</div>-->
        </div>
    </div>
</div>
<!--title end-->
<div id="app" class="body-content">
    <!--navbar-->
    <div class="nav-wrapper">
        <nav class="navbar navbar-default" data-spy="affix" data-offset-top="130">
            <div class="container">
                <ul class="nav navbar-nav">
                    <li class=""><a href="{{route('index')}}">Trang chủ</a></li>
                    <li class="dropdown">
                        <a class="dropdown-toggle" data-toggle="dropdown" href="#">Tất cả sản phẩm
                            <span class="caret"></span></a>
                        <ul class="dropdown-menu">
                            @foreach($cateList as $category)
                                <li><a href="{{url('category',[$category->id])}}">{{$category->name}}</a></li>
                            @endforeach
                        </ul>
                    </li>
                    <li>
                        <a href="{{route('allNews')}}"></a>
                    </li>

                </ul>
                <ul class="nav navbar-nav navbar-right">
                    <li>
                        <form action="{{route('search')}}" class="navbar-form navbar-left">
                            <div class="form-group">
                                <input type="text" name="input" class="form-control">
                            </div>
                            <button type="submit" class="btn btn-primary"><span
                                        class="glyphicon glyphicon-search"></span> Search
                            </button>
                        </form>
                    </li>
                    {{--cart/wishlist area--}}
                    <li><a href="{{ url('/wishlist') }}">Wishlist
                            ({{ Cart::instance('wishlist')->count(false) }})</a></li>
                    <li><a href="{{ url('/cart') }}">Cart
                            ({{ Cart::instance('default')->count(false) }})</a></li>

                    {{--cart/wishlist area end--}}
                    {{--login area--}}
                    @if (Auth::guard('customer')->guest())
                        <li><a href="{{ route('register') }}"><span class="glyphicon glyphicon-user"></span> Sign Up</a>
                        </li>
                        <li><a href="{{ route('login') }}"><span class="glyphicon glyphicon-log-in"></span> Login</a>
                        </li>
                    @else
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
                    @endif
                    {{--login area--}}
                </ul>
            </div>
        </nav>
    </div>
    <!--navbar end-->
    <!--wrapper start-->
    <div id="wrapper">
        <div class="container">
            {{--path--}}
            {{--@section('path')--}}
                {{--<a href="{{route('index')}}">Home</a>--}}
            {{--@show--}}
            {{--path end--}}
            {{--side nav--}}
            <div class="col-md-3 widget">
                @yield('left_bar')
            </div>
            {{--side nav end--}}
            <div class="col-md-9">
                @yield('content')
            </div>
            @yield('no_left_bar')
        </div>
    </div>
    <!--wrapper end-->
</div>
<!--footer begin-->
<footer class="footer ">
    <div class="footer-wrapper">
        <div class="footer-widgets">

            <div class="container">
                <div class="row">
                    <div class="col-md-4">
                        <div class="row">
                            <div class="col-md-12 col-sm-6">
                                <div class="widget">
                                    <h3 class="widget-title">GIỚI THIỆU TALAHA<i class="fa fa-plus-square"></i></h3>

                                    <div class="widget-content">
                                        <p>Talaha tôn vinh người phụ nữ hiện đại với phong cách thời thượng, cởi mở và
                                            cũng rất duyên dáng, thân thiện.</p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12 col-sm-6">
                                <div class="widget">
                                    <h3 class="widget-title">THÔNG TIN LIÊN LẠC<i class="fa fa-plus-square"></i></h3>
                                    <div class="widget-content">
                                        <p>HOTLINE: 0888340410 </p>
                                        <p>Giờ mở cửa: 08:00-22:00</p>
                                        <p>Mail: cskh@talaha.vn</p>
                                    </div>
                                </div><!-- /.widget -->
                            </div>
                            <div class="col-md-12 col-sm-6">
                                <a href="#" target="_blank">
                                    <img src="//sw001.hstatic.net/2/010dfdd7021097/bocongthuong.png"
                                         style="max-width: 180px;">
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-2 col-sm-6">
                        <div class="widget">
                            <h3 class="widget-title">HỖ TRỢ KHÁCH HÀNG<i class="fa fa-plus-square"></i></h3>
                            <ul>
                                <li><a href="#">Hướng Dẫn Chọn Size</a></li>
                                <li><a href="#">Chính sách bảo hành và đổi trả hàng</a></li>
                                <li><a href="#">Quy định hình thức thanh toán và giao
                                        hàng</a></li>
                                <li><a href="#">Chính sách bảo mật</a></li>
                            </ul>
                        </div><!-- /.widget -->
                    </div>
                    <div class="col-md-2 col-sm-6">
                        <div class="widget">
                            <h3 class="widget-title">Tin Tức<i class="fa fa-plus-square"></i></h3>
                            <ul>
                                <li><a href="#">Xu hướng Thời trang</a></li>
                                <li><a href="#">Thông tin khuyến mãi</a></li>
                                <li><a href="#">Bộ sưu tập</a></li>
                            </ul>
                        </div><!-- /.widget -->
                    </div>
                    <div class="col-md-4">
                        <div class="widget">
                            <h3 class="widget-title">Fanpage Facebook<i class="fa fa-plus-square"></i></h3>
                            <ul class="list-socials">
                                <li class="margin-bottom-20"><!-- Facebook widget -->
                                    <div class="footer-static-content">
                                        <div class="fb-page fb_iframe_widget"
                                             data-href="https://www.facebook.com/talaha.vn/?fref=ts" data-width="358"
                                             data-height="300" data-small-header="false"
                                             data-adapt-container-width="true" data-hide-cover="false"
                                             data-show-facepile="true" data-show-posts="false" fb-xfbml-state="rendered"
                                             fb-iframe-plugin-query="adapt_container_width=true&amp;app_id=263266547210244&amp;container_width=0&amp;height=300&amp;hide_cover=false&amp;href=https%3A%2F%2Fwww.facebook.com%2Ftalaha.vn%2F%3Ffref%3Dts&amp;locale=en_US&amp;sdk=joey&amp;show_facepile=true&amp;show_posts=false&amp;small_header=false&amp;width=358">
                                            <span style="vertical-align: bottom; width: 358px; height: 214px;"><iframe
                                                        name="f3bbb78ea0fef9" width="358px" height="300px"
                                                        frameborder="0" allowtransparency="true" allowfullscreen="true"
                                                        scrolling="no" title="fb:page Facebook Social Plugin"
                                                        src="https://www.facebook.com/v2.0/plugins/page.php?adapt_container_width=true&amp;app_id=263266547210244&amp;channel=http%3A%2F%2Fstaticxx.facebook.com%2Fconnect%2Fxd_arbiter%2Fr%2FnRK_i0jz87x.js%3Fversion%3D42%23cb%3Df1cb118d4f03de4%26domain%3Dtalaha.vn%26origin%3Dhttp%253A%252F%252Ftalaha.vn%252Ff248843950661d8%26relation%3Dparent.parent&amp;container_width=0&amp;height=300&amp;hide_cover=false&amp;href=https%3A%2F%2Fwww.facebook.com%2Ftalaha.vn%2F%3Ffref%3Dts&amp;locale=en_US&amp;sdk=joey&amp;show_facepile=true&amp;show_posts=false&amp;small_header=false&amp;width=358"
                                                        style="border: none; visibility: visible; width: 358px; height: 214px;"
                                                        class=""></iframe></span></div>
                                    </div>
                                    <div style="clear:both;">
                                    </div>
                                    <!-- #Facebook widget -->
                                    <script>
                                        (function (d, s, id)
                                        {
                                            var js, fjs = d.getElementsByTagName(s)[ 0 ];
                                            if (d.getElementById(id)) {
                                                return;
                                            }
                                            js = d.createElement(s);
                                            js.id = id;
                                            js.src = "//connect.facebook.net/en_US/sdk.js#xfbml=1&appId=263266547210244&version=v2.0";
                                            fjs.parentNode.insertBefore(js, fjs);
                                        }(document, 'script', 'facebook-jssdk'));
                                    </script>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="hidden-lg hidden-md hidden-sm hidden-xs mobile-nav">
                    <ul>
                        <li>
                            <a href="#" class="" title="Xu hướng thời trang">Xu hướng
                                thời trang</a>
                        </li>
                        <li>
                            <a href="#" class="" title="Chính sách đổi trả">Chính sách đổi
                                trả</a>
                        </li>
                        <li>
                            <a href="#" class="" title="Hướng dẫn chọn size giày">Hướng
                                dẫn chọn size giày</a>
                        </li>
                    </ul>
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
        </div><!-- /.footer-widgets -->
        <!-- /.footer-copyright -->
    </div><!-- /.footer-wrapper -->
</footer>
@yield('extra_js')
<!--footer end-->
<!-- Scripts -->
</body>
</html>
