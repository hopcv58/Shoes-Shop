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
@section('content')
    <h1>Your Cart</h1>

    <hr>

    @if (session()->has('success_message'))
        <div class="alert alert-success">
            {{ session()->get('success_message') }}
        </div>
    @endif

    @if (session()->has('error_message'))
        <div class="alert alert-danger">
            {{ session()->get('error_message') }}
        </div>
    @endif

    @if (sizeof(Cart::content()) > 0)

        <table class="table">
            <thead>
            <tr>
                <th class="col-md-4"></th>
                <th>Product</th>
                <th>Option</th>
                <th>Quantity</th>
                <th>Price</th>
                <th class="column-spacer"></th>
                <th></th>
            </tr>
            </thead>

            <tbody>

            @foreach (Cart::content() as $item)
                <tr>
                    <td class="table-image"><a href="{{ route('product', [$item->id]) }}"><img
                                    src="{{asset('upload/img_product/'.$products[$item->id]->img_profile)}}"
                                    alt="product"
                                    class="img-responsive cart-image col-md-6"></a></td>
                    <td><a href="{{ route('product', [$item->id]) }}">{{ $item->name }}</a></td>

                    <td class="col-md-3">Size {{$item->options['size']}},màu {{$item->options['color']}}</td>
                    <td>
                        <select class="quantity" data-id="{{ $item->rowId }}">
                            <option {{ $item->qty == 1 ? 'selected' : '' }}>1</option>
                            <option {{ $item->qty == 2 ? 'selected' : '' }}>2</option>
                            <option {{ $item->qty == 3 ? 'selected' : '' }}>3</option>
                            <option {{ $item->qty == 4 ? 'selected' : '' }}>4</option>
                            <option {{ $item->qty == 5 ? 'selected' : '' }}>5</option>
                        </select>
                    </td>
                    <td>${{ $item->subtotal }}</td>
                    <td class=""></td>
                    <td>
                        <form action="{{ url('cart', [$item->rowId]) }}" method="POST" class="side-by-side">
                            {!! csrf_field() !!}
                            <input type="hidden" name="_method" value="DELETE">
                            <input type="submit" class="col-md-6 btn btn-danger btn-sm" value="Xóa">
                        </form>

                        <form action="{{ url('switchToWishlist', [$item->rowId]) }}" method="POST"
                              class="side-by-side">
                            {!! csrf_field() !!}
                            <input type="submit" class="col-md-6 btn btn-success btn-sm" value="Đánh dấu">
                        </form>
                    </td>
                </tr>

            @endforeach
            <tr>
                <td class="table-image"></td>
                <td></td>
                <td></td>
                <td class="small-caps table-bg" style="text-align: right">Total</td>
                <td>${{ Cart::instance('default')->subtotal() }}</td>
                <td></td>
                <td></td>
            </tr>
            <tr>
                <td class="table-image"></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
            </tr>
            </tbody>
        </table>

        <a href="{{ URL::previous() }}" class="btn btn-primary btn-lg">Continue Shopping</a> &nbsp;
        <a href="{{route('order.index')}}" class="btn btn-success btn-lg">Proceed to Checkout</a>

        <div style="float:right">
            <form action="{{ url('emptyCart') }}" method="POST">
                {!! csrf_field() !!}
                <input type="hidden" name="_method" value="DELETE">
                <input type="submit" class="btn btn-danger btn-lg" value="Empty Cart">
            </form>
        </div>
    @else
        <h3>You have no items in your shopping cart</h3>
        <a href="{{route('index')}}" class="btn btn-primary btn-lg">Continue Shopping</a>

    @endif
    <div class="spacer"></div>

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