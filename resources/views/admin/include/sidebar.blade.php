<!-- Left side column. contains the logo and sidebar -->
<aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
        <!-- Sidebar user panel -->
        <div class="user-panel">
            <div class="pull-left image">
                <img src="{{asset('upload/img_profile/meo.jpg')}}" class="img-circle" alt="User Image">
            </div>
            <div class="pull-left info">
                <p>{{Auth::user()->name}}</p>
                <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
            </div>
        </div>
        <!-- search form -->
        <form action="#" method="get" class="sidebar-form">
            <div class="input-group">
                <input type="text" name="q" class="form-control" placeholder="Search...">
                <span class="input-group-btn">
                <button type="submit" name="search" id="search-btn" class="btn btn-flat"><i class="fa fa-search"></i>
                </button>
              </span>
            </div>
        </form>
        <!-- /.search form -->
        <!-- sidebar menu: : style can be found in sidebar.less -->
        <ul class="sidebar-menu">
            <li class="header">MAIN NAVIGATION</li>

            <!-- Trang chủ admin -->
            <li class="active treeview">
                <a href="#">
                    <i class="fa fa-dashboard"></i> <span>Dashboard</span>
                </a>
            </li>

            <!-- ./ trang chủ admin -->

            <!-- quản lý sản phẩm -->
            <li class="treeview">
                <a href="#">
                    <i class="fa fa-files-o"></i>
                    <span>Quản lý sản phẩm</span>
                    <span class="pull-right-container">
              <span class="label label-primary pull-right">4</span>
            </span>
                </a>
                <ul class="treeview-menu">
                    <li><a href="pages/layout/top-nav.html"><i class="fa fa-circle-o"></i> Danh mục sản phẩm</a></li>
                    <li><a href="pages/layout/boxed.html"><i class="fa fa-circle-o"></i> Loại sản phẩm</a></li>
                </ul>
            </li>
            <!-- ./ quản lý sản phẩm -->

            <!-- Thống kê thương mại -->
            <li class="treeview">
                <a href="#">
                    <i class="fa fa-pie-chart"></i>
                    <span>Thống kê thương mại</span>
                    <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
                </a>
                <ul class="treeview-menu">
                    <li><a href="pages/charts/chartjs.html"><i class="fa fa-circle-o"></i> Doanh Thu</a></li>
                    <li><a href="pages/charts/morris.html"><i class="fa fa-circle-o"></i> Sản Phẩm</a></li>
                    <li><a href="pages/charts/flot.html"><i class="fa fa-circle-o"></i> Giao Dịch</a></li>
                    <li><a href="pages/charts/inline.html"><i class="fa fa-circle-o"></i> Bài Viết</a></li>
                </ul>
            </li>
            <!-- ./thống kê thương mại -->

            <!-- quản lý đơn hàng -->
            <li class="treeview">
                <a href="#">
                    <i class="fa fa-paper-plane"></i>
                    <span>Quản lý đơn hàng</span>
                    <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
                </a>
                <ul class="treeview-menu">
                    <li><a href="pages/UI/general.html"><i class="fa fa-circle-o"></i> Đơn Hàng</a></li>
                    <li><a href="pages/UI/icons.html"><i class="fa fa-circle-o"></i> Lịch sử giao dịch</a></li>
                    <li><a href="pages/UI/buttons.html"><i class="fa fa-circle-o"></i> Buttons</a></li>
                    <li><a href="pages/UI/sliders.html"><i class="fa fa-circle-o"></i> Sliders</a></li>
                    <li><a href="pages/UI/timeline.html"><i class="fa fa-circle-o"></i> Timeline</a></li>
                    <li><a href="pages/UI/modals.html"><i class="fa fa-circle-o"></i> Modals</a></li>
                </ul>
            </li>
            <!-- ./quản lý đơn hàng -->

            <!-- quản lý user -->
            <li class="treeview">
                <a href="#">
                    <i class="fa fa-users"></i> <span>Quản lý người dùng</span>
                    <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
                </a>
                <ul class="treeview-menu">
                    <li><a href="pages/tables/simple.html"><i class="fa fa-circle-o"></i> Ban quản trị</a></li>
                    <li><a href="pages/tables/data.html"><i class="fa fa-circle-o"></i> Khách hàng</a></li>
                </ul>
            </li>
            <!-- ./quản lý user -->

            <!-- quản lý tin tức -->
            <li class="treeview">
                <a href="#">
                    <i class="fa fa-newspaper-o"></i> <span>Quản lý bài đăng</span>
                    <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
                </a>
                <ul class="treeview-menu">
                    <li><a href="pages/tables/simple.html"><i class="fa fa-circle-o"></i> Tin tức</a></li>
                    <li><a href="pages/tables/data.html"><i class="fa fa-circle-o"></i> slides</a></li>
                    <li><a href="pages/tables/data.html"><i class="fa fa-circle-o"></i> Phản hồi</a></li>
                    <li><a href="pages/tables/data.html"><i class="fa fa-circle-o"></i> Bình luận</a></li>
                </ul>
            </li>
            <!-- ./quản lý tin tức -->




            <li class="header">LABELS</li>
            <li><a href="#"><i class="fa fa-circle-o text-red"></i> <span>Important</span></a></li>
            <li><a href="#"><i class="fa fa-circle-o text-yellow"></i> <span>Warning</span></a></li>
            <li><a href="#"><i class="fa fa-circle-o text-aqua"></i> <span>Information</span></a></li>
            <li>
                <a href="pages/mailbox/mailbox.html">
                    <i class="fa fa-envelope"></i> <span>Mailbox</span>
                    <span class="pull-right-container">
              <small class="label pull-right bg-yellow">12</small>
              <small class="label pull-right bg-green">16</small>
              <small class="label pull-right bg-red">5</small>
            </span>
                </a>
            </li>
        </ul>
    </section>
    <!-- /.sidebar -->
</aside>