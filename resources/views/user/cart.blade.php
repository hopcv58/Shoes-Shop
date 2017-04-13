@extends('layouts.user')
{{--@section('path')--}}
{{--@parent / Cart--}}
{{--@endsection--}}
{{--@section('left_bar')--}}
{{--<ul><strong><h3>Danh mục</h3></strong></ul>--}}
{{--<ul class="col-md-offset-1">--}}
{{--@foreach($cateList as $category)--}}
{{--<li><strong><a href="{{url('category',[$category->id])}}">{{$category->name}}</a></strong></li>--}}
{{--@endforeach--}}
{{--</ul>--}}
{{--@endsection--}}
@section('path')
    <ol class="breadcrumb">
        <li><a href="{{route('index')}}">Trang chủ</a></li>
        <li class="active"><span style="font-weight: bold;">Giỏ Hàng</span></li>
    </ol>
    <h2 class="Bold" style="margin-left: 30px">Giỏ Hàng</h2>
@endsection
@section('content')

    @if (sizeof(Cart::content()) > 0)

        <table class="table table-responsive">
            <thead>
            <tr>
                <th style="width: 25%">Giày</th>
                <th style="width: 15%">Thông tin</th>
                <th class="text-center">Giá</th>
                <th style="width: 10%">Số lượng</th>
                <th class="text-center">Tổng</th>
                <th width="7%" colspan="2"></th>
            </tr>
            </thead>

            <tbody>

            @foreach (Cart::content() as $item)
                <tr>
                    <td class="table-image"><a href="{{ route('product', [$item->id]) }}"><img
                                    src="{{asset('upload/img_product/'.$products[$item->id]->img_profile)}}"
                                    alt="product" width="200px"></a></td>
                    <td><strong><a href="{{ route('product', [$item->id]) }}">{{ $item->name }}</a></strong>
                        <h5>Size {{$item->options['size']}},màu {{$item->options['color']}}</h5>
                    </td>

                    <td class="text-center"><h3>{{number_format($item->price)}} đ</h3></td>
                    <td>
                        <input type="number" class="quantity myform form-control" data-id="{{ $item->rowId }}"
                               value="{{$item->qty}}">
                        {{--<option {{ $item->qty == 1 ? 'selected' : '' }}>1</option>
                        <option {{ $item->qty == 2 ? 'selected' : '' }}>2</option>
                        <option {{ $item->qty == 3 ? 'selected' : '' }}>3</option>
                        <option {{ $item->qty == 4 ? 'selected' : '' }}>4</option>
                        <option {{ $item->qty == 5 ? 'selected' : '' }}>5</option>
                    </input>--}}
                    </td>
                    <td class="text-center"><h3>{{ number_format($item->subtotal) }} đ</h3></td>
                    <td>
                        <form action="{{ url('cart', [$item->rowId]) }}" method="POST" class="side-by-side"
                              onsubmit="return confirm('Are you sure to delete this from your cart?');">
                            {!! csrf_field() !!}
                            <input type="hidden" name="_method" value="DELETE">
                            <input type="submit" class="btn btn-danger btn-xs" value="Xóa">
                        </form>
                    </td>
                    <td>

                        <form action="{{ url('switchToWishlist', [$item->rowId]) }}" method="POST"
                              class="side-by-side">
                            {!! csrf_field() !!}
                            <input type="submit" class="btn btn-primary btn-xs" value="Đánh dấu">
                        </form>
                    </td>
                </tr>

            @endforeach

            </tbody>
        </table>
        <div class="row">
            <div class="col-md-3 pull-right" style="padding-top: 30px; margin-top: 20px">
                <a href="{{ route('index') }}" class="mya pull-right">
                    <small><<</small>
                    Tiếp tục mua sắm</a>
                <h2 class="pull-right" style="margin-top: 30px; margin-bottom: 30px;">
                    <small>Tất cả</small>
                    <span style="color: black; font-weight: bold">{{Cart::instance('default')->subtotal() }} đ </span>
                </h2>

                <a href="{{route('order.index')}}" class="btn mybtn" style="float: right;">Thanh Toán</a>
                <form action="{{ url('emptyCart') }}" method="POST"
                      onsubmit="return confirm('This will empty your cart completely\n Are you sure about this?');">
                    {!! csrf_field() !!}
                    <input type="hidden" name="_method" value="DELETE">
                    <input type="submit" class="mybtn btn" value="Empty Cart">
                </form>
            </div>
        </div>
    @else
        <h3>Không có sản phẩm nào trong giỏ hàng của bạn :((</h3>
        <a href="{{route('index')}}" class="btn my-default-btn">Continue Shopping</a>

    @endif

@endsection

@section('extra_js')
    <script>
        (function ()
        {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $('.quantity').on('change', function ()
            {
                var id = $(this).attr('data-id')
                $.ajax({
                    type: "PATCH",
                    url: '{{ url("/cart") }}' + '/' + id,
                    data: {
                        'quantity': this.value,
                    },
                    success: function (data)
                    {
                        window.location.href = '{{ url('/cart') }}';
                    }
                });

            });

        })();

    </script>
@endsection