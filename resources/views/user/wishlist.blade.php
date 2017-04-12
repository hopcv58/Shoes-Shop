@extends('layouts.user')
{{--@section('path')--}}
    {{--@parent / Wishlist--}}
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
        <li class="active"><span style="font-weight: bold;">Wishlist</span></li>
    </ol>
    <h2 class="Bold" style="margin-left: 30px">Wishlist</h2>
@endsection
@section('content')
    <h2>Your Wishlist</h2>
    <hr>
    @if (sizeof(Cart::instance('wishlist')->content()) > 0)

        <table class="table table-responsive">
            <thead>
            <tr>
                <th></th>
                <th>Product</th>
                <th>Option</th>
                <th>Price</th>
                <th colspan="2" style="width: 7%"></th>
            </tr>
            </thead>
            <tbody>
            @foreach (Cart::instance('wishlist')->content() as $item)
                <tr>
                    <td class="table-image"><a href="{{ route('product', [$item->id]) }}"><img
                                    src="{{asset('upload/img_product/'.$products[$item->id]->img_profile)}}"
                                    alt="product" width="150px"></a></td>
                    <td><a href="{{ route('product', [$item->id]) }}">{{ $item->name }}</a></td>
                    <td class="col-md-3">Size {{$item->options['size']}},màu {{$item->options['color']}}</td>
                    <td><h3>{{ number_format($item->subtotal) }} đ</h3></td>
                    <td>
                        <form action="{{ url('wishlist', [$item->rowId]) }}" method="POST" class="side-by-side">
                            {!! csrf_field() !!}
                            <input type="hidden" name="_method" value="DELETE">
                            <input type="submit" class="btn btn-danger btn-xs" value="Remove">
                        </form>
                    </td>
                    <td>
                        <form action="{{ url('switchToCart', [$item->rowId]) }}" method="POST" class="side-by-side">
                            {!! csrf_field() !!}
                            <input type="submit" class="btn btn-primary btn-xs" value="To Cart">
                        </form>
                    </td>
                </tr>
            @endforeach

            </tbody>
        </table>


        <div style="float:right">
            <form action="{{ url('/emptyWishlist') }}" method="POST">
                {!! csrf_field() !!}
                <input type="hidden" name="_method" value="DELETE">
                <input type="submit" class="btn my-default-btn" value="Empty Wishlist">
            </form>
        </div>

    @else

        <h3>Không có sản phẩm nào trong danh sách yêu thích</h3>
        <a href="{{route('index')}}" class="btn my-default-btn">Continue Shopping</a>

    @endif

    <div class="spacer"></div>

@endsection
