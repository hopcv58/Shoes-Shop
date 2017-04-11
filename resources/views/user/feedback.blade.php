@extends('layouts.user')
@section('no_left_bar')
    {{--comment--}}
    <div class="row">
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
        @if (Auth::guard('customer')->guest())
            <form class="form-horizontal" role="form" method="POST" action="">
                {{ csrf_field() }}
                <div class="form-group">
                    <label for="name" class="col-md-4 control-label">
                        Họ tên
                    </label>
                    <div class="col-md-6">
                        <input id="username" type="text" class="form-control"
                               name="username" required>
                    </div>
                </div>
                <div class="form-group">
                    <label for="phone" class="col-md-4 control-label">
                        SĐT
                    </label>
                    <div class="col-md-6">
                        <input id="phone" type="tel" class="form-control"
                               name="phone" required>
                    </div>
                </div>
                <div class="form-group">
                    <label for="email" class="col-md-4 control-label">
                        Email
                    </label>
                    <div class="col-md-6">
                        <input id="email" type="email" class="form-control"
                               name="email" required>
                    </div>
                </div>
                <div class="form-group">
                    <label for="content" class="col-md-4 control-label">Ý kiến của bạn</label>
                    <div class="col-md-6">
                        <textarea id="content" type="text" class="form-control" rows="5"
                                  name="content"></textarea>
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-md-6 col-md-offset-4">
                        <button type="submit" class="btn btn-primary">
                            Feedback to us!
                        </button>
                    </div>
                </div>
            </form>
        @else
            <form action="" method="POST" class="form-horizontal col-md-8 col-md-offset-2">
                {!! csrf_field() !!}
                <div class="form-group">
                    <label for="content" class="col-md-4 control-label">Ý kiến của bạn</label>
                    <div class="col-md-6">
                        <textarea id="content" type="text" class="form-control" rows="5"
                                  required name="content"></textarea>
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-md-6 col-md-offset-4">
                        <button type="submit" class="btn btn-primary">
                            Feedback to us!
                        </button>
                    </div>
                </div>
            </form>
        @endif
    </div>

    {{--end comment--}}
@endsection