<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="css/bootstrap.css" rel="stylesheet">
    <link href="css/my.css" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="css/style.css">
    <script type="text/javascript" src="js/jquery.js"></script>
    <script type="text/javascript" src="js/bootstrap.min.js"></script>
    <title>Document</title>

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
<div class="navbar navbar-default">
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
                <li><a href="#"><span class="glyphicon glyphicon-user"></span> Sign Up</a></li>
                <li><a href="#"><span class="glyphicon glyphicon-log-in"></span> Login</a></li>
            </ul>
        </div>
    </nav>
</div>

<!--navbar end-->
<!--wrapper start-->
<div id="wrapper">
    <div class="container">
        <div class="col-md-5">
            <div class="prezoom" data-scale="4" data-image="http://placehold.it/445x445"></div>
        </div>
        <div class="col-md-6">
            Chi tiết sản phẩm
        </div>
    </div>
</div>
<!--wrapper end-->
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
</body>
<script>
	var elementThumbnailPhoto = 'prezoom';
	var elementPhoto = 'zoomed';
	
	$('.' + elementThumbnailPhoto)
	// tile mouse actions
		.on('mouseover', function () {
			$(this).children('.' + elementPhoto).css({
				'transform': 'scale(' + $(this).attr('data-scale') + ')'
			});
		})
		.on('mouseout', function () {
			$(this).children('.' + elementPhoto).css({
				'transform': 'scale(1)'
			});
		})
		.on('mousemove', function (e) {
			$(this).children('.' + elementPhoto).css({
				'transform-origin': ((e.pageX - $(this).offset().left) / $(this).width()) * 100 + '% ' + ((e.pageY - $(this).offset().top) / $(this).height()) * 100 + '%'
			});
		})
		// tiles set up
		.each(function () {
			$(this)
			// add a photo container
				.append('<div class="' + elementPhoto + '"></div>')
				// set up a background image for each tile based on data-image attribute
				.children('.' + elementPhoto).css({
				'background-image': 'url(' + $(this).attr('data-image') + ')'
			});
		})
</script>
</html>