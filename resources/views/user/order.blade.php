@extends('layouts.user')
@section('content')
    <div class="container">
        @if (sizeof(Cart::content()) > 0)
            <div class="row">
                <div class="col-md-6">
                    <div class="panel panel-default">
                        @if (Auth::guard('customer')->guest())
                            <div class="panel-heading">Nhập thông tin:</div>
                            <div class="panel-body">
                                <form class="form-horizontal" role="form" method="POST" action="">
                                    {{ csrf_field() }}
                                    <div class="form-group">
                                        <label for="name" class="col-md-4 control-label">
                                            Họ tên người nhận</label>
                                        <div class="col-md-6">
                                            <input id="name" type="text" class="form-control"
                                                   name="name" required>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="phone" class="col-md-4 control-label">
                                            SĐT</label>
                                        <div class="col-md-6">
                                            <input id="phone" type="tel" class="form-control"
                                                   name="phone" required>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="email" class="col-md-4 control-label">
                                            Email</label>
                                        <div class="col-md-6">
                                            <input id="email" type="email" class="form-control"
                                                   name="email" required>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="payment" class="col-md-4 control-label">
                                            Payment</label>
                                        <div class="col-md-6">
                                            <select id="payment" class="form-control" name="payment" required>
                                                <option value="paypal">Paypal</option>
                                                <option value="fast ship">Fast ship(40k)</option>
                                                <option value="free ship">Free ship(5-7 days)</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="address" class="col-md-4 control-label">
                                            Địa chỉ người nhận</label>
                                        <div class="col-md-6">
                                            <input id="address" type="text" class="form-control"
                                                   name="address" required>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="note" class="col-md-4 control-label">Ghi chú</label>
                                        <div class="col-md-6">
                                        <textarea id="note" type="text" class="form-control"
                                                  name="note"></textarea>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="col-md-6 col-md-offset-4">
                                            <button type="submit" class="btn btn-primary">
                                                Confirm!
                                            </button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        @else
                            <div class="panel-heading">Địa chỉ người nhận</div>
                            <div class="panel-body">
                                <form class="form-horizontal" role="form" method="POST" action="">
                                    {{ csrf_field() }}
                                    <div class="form-group">
                                        <label for="name" class="col-md-4 control-label">
                                            Họ tên người nhận</label>
                                        <div class="col-md-6">
                                            <input id="name" type="text" class="form-control"
                                                   name="name" value="{{Auth::guard('customer')->user()->username}}"
                                                   required>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="phone" class="col-md-4 control-label">
                                            SĐT</label>
                                        <div class="col-md-6">
                                            <input id="phone" type="tel" class="form-control"
                                                   name="phone" value="{{Auth::guard('customer')->user()->phone}}"
                                                   required>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="email" class="col-md-4 control-label">
                                            Email</label>
                                        <div class="col-md-6">
                                            <input id="email" type="email" class="form-control"
                                                   name="email" value="{{Auth::guard('customer')->user()->email}}"
                                                   required>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="payment" class="col-md-4 control-label">
                                            Payment</label>
                                        <div class="col-md-6">
                                            <select id="payment" class="form-control" name="payment" required>
                                                <option value="paypal">Paypal</option>
                                                <option value="fast ship">Fast ship(40k)</option>
                                                <option value="free ship">Free ship(5-7 days)</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="address" class="col-md-4 control-label">
                                            Địa chỉ người nhận</label>
                                        <div class="col-md-6">
                                            <input id="address" type="text" class="form-control"
                                                   name="address" value="{{Auth::guard('customer')->user()->address}}"
                                                   required>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="note" class="col-md-4 control-label">Ghi chú</label>
                                        <div class="col-md-6">
                                        <textarea id="note" type="text" class="form-control"
                                                  name="note"></textarea>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <input type="hidden" name="customer_id"
                                               value="{{Auth::guard('customer')->user()->id}}">
                                    </div>
                                    <div class="form-group">
                                        <div class="col-md-6 col-md-offset-4">
                                            <button type="submit" class="btn btn-primary">
                                                Confirm!
                                            </button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        @endif
                    </div>
                </div>
                <div class="col-md-6">
                    <h3>Your Cart</h3>
                    <hr>
                    <table class="table">
                        <thead>
                        <tr>
                            <th class="col-md-4"></th>
                            <th>Product</th>
                            <th>Option</th>
                            <th>Quantity</th>
                            <th>Price</th>
                            <th class="column-spacer"></th>
                        </tr>
                        </thead>

                        <tbody>

                        @foreach (Cart::content() as $item)
                            <tr>
                                <td class="table-image"><a href="{{ url('index', [$item->model->slug]) }}"><img
                                                src="http://placehold.it/500x500" alt="product"
                                                class="img-responsive cart-image col-md-6"></a></td>
                                <td><a href="{{ url('index', [$item->model->slug]) }}">{{ $item->name }}</a></td>

                                <td class="col-md-3">Size {{$item->options['size']}}
                                    ,màu {{$item->options['color']}}</td>
                                <td>{{$item->qty}}</td>
                                <td>${{ $item->subtotal }}</td>
                            </tr>

                        @endforeach
                        <tr>
                            <td class="table-image"></td>
                            <td></td>
                            <td></td>
                            <td class="small-caps table-bg" style="text-align: right">Total</td>
                            <td>${{ Cart::instance('default')->subtotal() }}</td>
                        </tr>
                        <tr>
                            <td class="table-image"></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                        </tr>
                        </tbody>
                    </table>
                </div>
                @else
                    <h3>You have no items in your shopping cart</h3>
                    <button onclick="{{route('index')}}" class="btn btn-primary btn-lg">Continue Shopping
                    </button>


                    <div class="spacer"></div>

            </div>
        @endif
    </div>
@endsection