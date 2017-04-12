@extends('layouts.user')
@section('path')
    <ol class="breadcrumb">
        <li><a href="{{route('index')}}">Trang chủ</a></li>
        <li class="active"><span style="font-weight: bold;">Liên hệ</span></li>
    </ol>
    <div class="col-md-6">
        <div class="col-md-12">
            <img class="img-responsive" style="margin-top: 15px"
                 src="{{asset('upload/img_pages/contact_content_img.jpg')}}" alt="">
            <p style="color: #615a5e; margin-top: 30px; margin-bottom: 60px">Hãy gửi thông tin phản hồi đến chúng tôi để
                giúp chúng tôi có thể hoàn thiện sản phẩm của mình hơn.</p>
            <h4 style="font-weight: bold">THÔNG TIN SHOP</h4>
            <address style="color: #717171" class="small">
                <strong>Điện thoại</strong> <br>
                0888340410 <br>
                <strong>Email</strong> <br>
                cskh@talaha.vn <br>
            </address>
        </div>
    </div>
@endsection
@section('content')
    {{--comment--}}
    <div class="row">

        <div class="col-md-6">
            <h3 class="row">GỬI THƯ CHO CHÚNG TÔI</h3>
            <p class="row" style="color: #655d62; margin-bottom: 30px; margin-top: 30px">Hãy gửi thông tin phản hồi đến
                chúng tôi để giúp chúng tôi có thể hoàn thiện sản
                phẩm của mình hơn.</p>
            @if (Auth::guard('customer')->guest())
                <form class="form-horizontal nlienhe" role="form" method="POST" action="">
                    {{ csrf_field() }}
                    <div class="form-group">
                        <label for="name" class="control-label">
                            Họ tên:
                        </label>
                        <input placeholder="Tên:" id="username" type="text" class="form-control"
                               name="username" required>
                    </div>
                    <div class="form-group">
                        <label for="phone" class=" control-label">
                            Điện thoại:
                        </label>
                        <input id="phone" type="tel" class="form-control"
                               name="phone" required placeholder="Điện thoại:">
                    </div>
                    <div class="form-group">
                        <label for="email" class="control-label">
                            Email:
                        </label>
                        <input placeholder="Email:" id="email" type="email" class="form-control"
                               name="email" required>
                    </div>
                    <div class="form-group">
                        <label for="content" class="control-label">Ý kiến của bạn:</label>
                        <textarea id="content" type="text" class="form-control" rows="5"
                                  name="content" placeholder="Tin nhắn:"></textarea>
                    </div>
                    <div class="form-group">
                        <button type="submit" class=" mybtn btn">
                            Feedback!
                        </button>
                    </div>
                </form>
            @else
                <form action="" method="POST" class="form-horizontal form-cart">
                    {!! csrf_field() !!}
                    <div class="form-group">
                        <label for="content" class="control-label">Ý kiến của bạn</label>
                        <textarea id="content" type="text" class="form-control" rows="5" placeholder="Your feedback"
                                  required name="content"></textarea>
                    </div>
                    <div class="form-group">
                        <button type="submit" class="btn my-default-btn">
                            Feedback to us!
                        </button>
                    </div>
                </form>
            @endif
        </div>
    </div>

    {{--end comment--}}
@endsection