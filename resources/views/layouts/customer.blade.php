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
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('customer/css/bootstrap.css') }}" rel="stylesheet">
    <link href="{{ asset('customer/css/my.css') }}" rel="stylesheet">

    <!-- Scripts -->
    <script src="{{ asset('customer/js/jquery.js') }}"></script>
    <script src="{{ asset('customer/js/bootstrap.min.js') }}"></script>
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
                <div class="col-md-3">icon</div>
                <div class="col-md-3 col-md-offset-4 ">
                    <a href="">ffffff | </a>
                    <a href="">Lorem ipsum | </a>
                    <a href="">Lorem ipsum.</a>
                </div>
                <div class="col-md-2">
                    <p>Lorem ipsum amet</p>
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
            <li><a class="navbar-text" href="#"><h4>Home</h4></a></li>
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
<div id="app">
    <!--navbar-->
    <div class="nav-wrapper">
        <nav class="navbar navbar-default" data-spy="affix" data-offset-top="130">
            <div class="container">
                <ul class="nav navbar-nav">
                    <li class="active"><a href="#">Trang chủ</a></li>
                    <li class="dropdown">
                        <a class="dropdown-toggle" data-toggle="dropdown" href="#">Sản phẩm mới
                            <span class="caret"></span></a>
                        <ul class="dropdown-menu">
                            <li><a href="#">Giày công sở</a></li>
                            <li><a href="#">Giày búp bê</a></li>
                            <li><a href="#">Giày sandal</a></li>
                            <li><a href="#">Giày da thật</a></li>
                        </ul>
                    </li>
                    <li><a class="dropdown-toggle" data-toggle="dropdown" href="#">Giày nam</a></li>
                    <li><a class="dropdown-toggle" data-toggle="dropdown" href="#">Giày nữ</a></li>
                </ul>
                <ul class="nav navbar-nav navbar-right">
                    <li>
                        <form class="navbar-form navbar-left">
                            <div class="form-group">
                                <input type="text" class="form-control" placeholder="Search">
                            </div>
                            <a href="#" class="navbar-link"><span class="glyphicon glyphicon-search"></span> Search</a>
                        </form>
                    </li>
                    @if (Auth::guard('customer')->guest())
                        <li><a href="{{ route('register') }}"><span class="glyphicon glyphicon-user"></span> Sign Up</a>
                        </li>
                        <li><a href="{{ route('login') }}"><span class="glyphicon glyphicon-log-in"></span> Login</a>
                        </li>
                    @else
                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                                {{ Auth::guard('customer')->user()->username }} <span class="caret"></span>
                            </a>

                            <ul class="dropdown-menu" role="menu">
                                <li>
                                    <a href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        Logout
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                        {{ csrf_field() }}
                                    </form>
                                </li>
                            </ul>
                        </li>
                    @endif
                </ul>
            </div>
        </nav>
    </div>
    <!--navbar end-->
    @yield('content')
</div>
<!--footer begin-->
<footer class="footer">
    <div class="footer-wrapper">
        <div class="container">
            <div class="col-md-4">
                Giới thiệu khách hàng
            </div>
            <div class="col-md-2">
                Hỗ trợ khách hàng
            </div>
            <div class="col-md-2">
                Tin tức
            </div>
            <div class="col-md-4">
                Fan page
            </div>
        </div>
    </div>
</footer>
<!--footer end-->
<!-- Scripts -->
<script src="{{ asset('js/app.js') }}"></script>
</body>
</html>
