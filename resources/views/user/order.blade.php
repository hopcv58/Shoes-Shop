@extends('layouts.user')
@section('content')
    @if (sizeof(Cart::content()) > 0)
        <div class="row">
            <div class="col-md-6">

                @if (Auth::guard('customer')->guest())
                    <h3>NHẬP THÔNG TIN GIAO HÀNG</h3>
                    <hr>
                    <div class="col-md-8 col-md-offset-2 form-cart">
                        <form onsubmit="return confirm('Giỏ hàng sẽ bị làm trống và đơn hàng sẽ được gửi\n Bạn có chắc chắn?');"
                              class="form-horizontal" role="form" method="POST" action="">
                            {{ csrf_field() }}
                            <div class="form-group {{ $errors->has('username') ? ' has-error' : '' }}">
                                <label for="username" class="control-label">
                                    Họ tên</label>
                                <input id="username" type="text" class="form-control" placeholder="Tên..."
                                       name="username" required>
                                @if ($errors->has('username'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('username') }}</strong>
                                    </span>
                                @endif
                            </div>
                            <div class="form-group">
                                <label for="phone" class="control-label">
                                    Điện thoại <span class="text-danger">(*)</span></label>
                                <input id="phone" type="tel" class="form-control" placeholder="SĐT..."
                                       name="phone" required>
                            </div>
                            <div class="form-group {{ $errors->has('email') ? ' has-error' : '' }}">
                                <label for="email" class="control-label">
                                    Email</label>
                                <input id="email" type="email" class="form-control" placeholder="Email..."
                                       name="email" required>
                                @if ($errors->has('email'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                            </div>
                            <div class="form-group {{ $errors->has('payment') ? ' has-error' : '' }}">
                                <label for="payment" class="control-label">
                                    Payment</label>
                                <select id="payment" class="form-control" name="payment" required>
                                    <option value="paypal">Paypal</option>
                                    <option value="free ship">Free ship</option>
                                </select>
                                @if ($errors->has('payment'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('payment') }}</strong>
                                    </span>
                                @endif
                            </div>
                            <div class="form-group {{ $errors->has('address') ? ' has-error' : '' }}">
                                <label for="address" class="control-label">
                                    Địa chỉ giao hàng <span class="text-danger">(*)</span></label>
                                <input id="address" type="text" class="form-control" placeholder="Địa chỉ..."
                                       name="address" required>
                                @if ($errors->has('address'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('address') }}</strong>
                                    </span>
                                @endif
                            </div>
                            <div class="form-group {{ $errors->has('note') ? ' has-error' : '' }}">
                                <label for="note" class="control-label">Ghi chú</label>
                                <textarea id="note" type="text" class="form-control" placeholder="Viết ghi chú cho đơn hàng"
                                          name="note"></textarea>
                                @if ($errors->has('note'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('note') }}</strong>
                                    </span>
                                @endif
                            </div>
                            <div class="form-group">
                                <button type="submit" class="btn my-default-btn">
                                    Xác nhận!
                                </button>
                            </div>
                        </form>
                    </div>
                @else
                    <h3>THÔNG TIN GIAO HÀNG</h3>
                    <hr>
                    <div class="col-md-8 col-md-offset-2 form-cart">
                        <form onsubmit="return confirm('Giỏ hàng sẽ bị làm trống và đơn hàng sẽ được gửi\n Bạn có chắc chắn?');"
                              class="form-horizontal" role="form" method="POST" action="">
                            {{ csrf_field() }}
                            <div class="form-group" {{ $errors->has('username') ? ' has-error' : '' }}>
                                <label for="username" class="control-label">
                                    Họ Tên</label>
                                <input id="username" type="text" class="form-control" placeholder="Tên..."
                                       name="username" value="{{Auth::guard('customer')->user()->username}}" required>
                                @if ($errors->has('username'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('username') }}</strong>
                                    </span>
                                @endif
                            </div>
                            <div class="form-group">
                                <label for="phone"
                                       class="control-label {{ $errors->has('phone') ? ' has-error' : '' }}">
                                    Điện Thoai <span class="text-danger">(*)</span></label>
                                <input id="phone" type="tel" class="form-control" placeholder="SĐT ..."
                                       name="phone" value="{{Auth::guard('customer')->user()->phone}}" required>
                                @if ($errors->has('phone'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('phone') }}</strong>
                                    </span>
                                @endif
                            </div>
                            <div class="form-group {{ $errors->has('email') ? ' has-error' : '' }}">
                                <label for="email" class="control-label">
                                    Email</label>
                                <input id="email" type="email" class="form-control" placeholder="Email..."
                                       name="email" value="{{Auth::guard('customer')->user()->email}}" required>
                                @if ($errors->has('email'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                            </div>
                            <div class="form-group {{ $errors->has('payment') ? ' has-error' : '' }}">
                                <label for="payment" class="control-label">
                                    Payment</label>
                                <select id="payment" class="form-control" name="payment" required>
                                    <option value="paypal">Paypal</option>
                                    <option value="free ship">Free ship</option>
                                </select>
                                @if ($errors->has('payment'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('payment') }}</strong>
                                    </span>
                                @endif
                            </div>
                            <div class="form-group {{ $errors->has('address') ? ' has-error' : '' }}">
                                <label for="address" class="control-label">
                                    Địa Chỉ</label>
                                <input id="address" type="text" class="form-control" placeholder="Địa chỉ..."
                                       name="address" value="{{Auth::guard('customer')->user()->address}}"
                                       required>
                                @if ($errors->has('address'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('address') }}</strong>
                                    </span>
                                @endif
                            </div>
                            <div class="form-group  {{ $errors->has('note') ? ' has-error' : '' }}">
                                <label for="note" class="control-label">Ghi chú</label>
                                <textarea id="note" type="text" class="form-control" placeholder="Ghi chú..."
                                          name="note"></textarea>
                                @if ($errors->has('note'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('note') }}</strong>
                                    </span>
                                @endif
                            </div>
                            <div class="form-group">
                                <button type="submit" class="btn my-default-btn">
                                    Confirm!
                                </button>
                            </div>
                        </form>
                    </div>
                @endif
            </div>
            <div class="col-md-6">
                <h3>ĐƠN HÀNG CỦA BẠN</h3>
                <hr>
                <table class="table table-responsive">
                    <thead>
                    <tr>
                        <th></th>
                        <th>Tên sản phẩm</th>
                        <th>Size/Màu</th>
                        <th>Qty</th>
                        <th>Giá</th>
                        <th class="column-spacer"></th>
                    </tr>
                    </thead>

                    <tbody>

                    @foreach (Cart::content() as $item)
                        <tr>
                            <td><a href="{{ url('index', [$item->model->slug]) }}">
                                    <img src="{{asset('upload/img_product/'.$productList[$item->id]->img_profile)}}"
                                         alt="product" width="150px">
                                </a></td>
                            <td><a href="{{ url('index', [$item->model->slug]) }}">{{ $item->name }}</a></td>

                            <td class="col-md-3">Size {{$item->options['size']}}
                                ,màu {{$item->options['color']}}</td>
                            <td>{{$item->qty}}</td>
                            <td>{{ number_format($item->subtotal) }}đ</td>
                        </tr>

                    @endforeach
                    </tbody>
                </table>
                <div>
                    <h4 style="text-align: right">Thành tiền</h4>
                        <h3 style="text-align: right" class="Bold">{{ Cart::instance('default')->subtotal() }} đ </h3>
                </div>
            </div>
        </div>
    @else
        <h3>Không có sản phẩm nào trong giỏ hàng của bạn</h3>
        <a href="{{route('index')}}" class="btn my-default-btn">Continue Shopping</a>

        </div>
    @endif
@endsection