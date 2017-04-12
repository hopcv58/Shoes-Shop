@extends('layouts.user')
@section('content')
    @if (sizeof(Cart::content()) > 0)
        <div class="row">
            <div class="col-md-6">

                @if (Auth::guard('customer')->guest())
                    <h3>NHẬP THÔNG TIN GIAO HÀNG</h3>
                    <hr>
                    <div class="col-md-8 col-md-offset-2 form-cart">
                        <form onsubmit="return confirm('This will empty your cart and submit your order\n Are you sure about this?');"
                              class="form-horizontal" role="form" method="POST" action="">
                            {{ csrf_field() }}
                            <div class="form-group">
                                <label for="username" class="control-label">
                                    Họ tên</label>
                                <input id="username" type="text" class="form-control" placeholder="Name..."
                                       name="username" required>
                            </div>
                            <div class="form-group">
                                <label for="phone" class="control-label">
                                    Điện thoại <span class="text-danger">(*)</span></label>
                                <input id="phone" type="tel" class="form-control" placeholder="Phone Number..."
                                       name="phone" required>
                            </div>
                            <div class="form-group">
                                <label for="email" class="control-label">
                                    Email</label>
                                <input id="email" type="email" class="form-control" placeholder="Email..."
                                       name="email" required>
                            </div>
                            <div class="form-group">
                                <label for="payment" class="control-label">
                                    Payment</label>
                                <select id="payment" class="form-control" name="payment" required>
                                    <option value="paypal">Paypal</option>
                                    <option value="free ship">Free ship</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="address" class="control-label">
                                    Địa chỉ giao hàng <span class="text-danger">(*)</span></label>
                                <input id="address" type="text" class="form-control" placeholder="Address..."
                                       name="address" required>
                            </div>
                            <div class="form-group">
                                <label for="note" class="control-label">Ghi chú</label>
                                <textarea id="note" type="text" class="form-control" placeholder="Note..."
                                          name="note"></textarea>
                            </div>
                            <div class="form-group">
                                <button type="submit" class="btn my-default-btn">
                                    Confirm!
                                </button>
                            </div>
                        </form>
                    </div>
                @else
                    <h3>THÔNG TIN GIAO HÀNG</h3>
                    <hr>
                    <div class="col-md-8 col-md-offset-2 form-cart">
                        <form onsubmit="return confirm('This will empty your cart and submit your order\n Are you sure about this?');"
                              class="form-horizontal" role="form" method="POST" action="">
                            {{ csrf_field() }}
                            <div class="form-group">
                                <label for="username" class="control-label">
                                    Họ Tên</label>
                                <input id="username" type="text" class="form-control" placeholder="Name..."
                                       name="username" value="{{Auth::guard('customer')->user()->username}}"
                                       required>
                            </div>
                            <div class="form-group">
                                <label for="phone" class="control-label">
                                    Điện Thoai <span class="text-danger">(*)</span></label>
                                <input id="phone" type="tel" class="form-control" placeholder="Phone Number ..."
                                       name="phone" value="{{Auth::guard('customer')->user()->phone}}"
                                       required>
                            </div>
                            <div class="form-group">
                                <label for="email" class="control-label">
                                    Email</label>
                                <input id="email" type="email" class="form-control" placeholder="Email..."
                                       name="email" value="{{Auth::guard('customer')->user()->email}}"
                                       required>
                            </div>
                            <div class="form-group">
                                <label for="payment" class="control-label">
                                    Payment</label>
                                <select id="payment" class="form-control" name="payment" required>
                                    <option value="paypal">Paypal</option>
                                    <option value="free ship">Free ship</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="address" class="control-label">
                                    Địa Chỉ</label>
                                <input id="address" type="text" class="form-control" placeholder="Address..."
                                       name="address" value="{{Auth::guard('customer')->user()->address}}"
                                       required>
                            </div>
                            <div class="form-group">
                                <label for="note" class="control-label">Ghi chú</label>
                                <textarea id="note" type="text" class="form-control" placeholder="Note..."
                                          name="note"></textarea>
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
                        <th>Product</th>
                        <th>Option</th>
                        <th>Qty</th>
                        <th>Price</th>
                        <th class="column-spacer"></th>
                    </tr>
                    </thead>

                    <tbody>

                    @foreach (Cart::content() as $item)
                        <tr>
                            <td><a href="{{ url('index', [$item->model->slug]) }}">
                                    <img src="{{asset('upload/img_product/'.$productList[$item->id]->img_profile)}}" alt="product" width="150px">
                                </a></td>
                            <td><a href="{{ url('index', [$item->model->slug]) }}">{{ $item->name }}</a></td>

                            <td class="col-md-3">Size {{$item->options['size']}}
                                ,màu {{$item->options['color']}}</td>
                            <td>{{$item->qty}}</td>
                            <td>${{ $item->subtotal }}</td>
                        </tr>

                    @endforeach
                    </tbody>
                </table>
                <div>
                    <h4 style="text-align: right">Thành tiền</td>
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