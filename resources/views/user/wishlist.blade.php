@extends('layouts.user')

@section('content')

    <div class="container">
        <p><a href="{{ url('index') }}">Home</a> / Wishlist</p>
        <h1>Your Wishlist</h1>

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

        @if (sizeof(Cart::instance('wishlist')->content()) > 0)

            <table class="table">
                <thead>
                <tr>
                    <th class="table-image"></th>
                    <th>Product</th>
                    <th>Option</th>
                    <th>Price</th>
                    <th class="column-spacer"></th>
                    <th></th>
                </tr>
                </thead>
                <tbody>
                @foreach (Cart::instance('wishlist')->content() as $item)
                    <tr>
                        <td class="table-image"><a href="{{ url('index', [$item->model->slug]) }}"><img
                                        src="http://placehold.it/500x500" alt="product"
                                        class="img-responsive cart-image"></a></td>
                        <td><a href="{{ url('/category/1', [$item->model->slug]) }}">{{ $item->name }}</a></td>
                        <td class="col-md-3">{{implode($item->options->toArray(),' ')}}</td>
                        <td>${{ $item->subtotal }}</td>
                        <td class=""></td>
                        <td>
                            <form action="{{ url('wishlist', [$item->rowId]) }}" method="POST" class="side-by-side">
                                {!! csrf_field() !!}
                                <input type="hidden" name="_method" value="DELETE">
                                <input type="submit" class="btn btn-danger btn-sm" value="Remove">
                            </form>

                            <form action="{{ url('switchToCart', [$item->rowId]) }}" method="POST" class="side-by-side">
                                {!! csrf_field() !!}
                                <input type="submit" class="btn btn-success btn-sm" value="To Cart">
                            </form>
                        </td>
                    </tr>
                @endforeach

                </tbody>
            </table>

            <div class="spacer"></div>

            <a href="/index" class="btn btn-primary btn-lg">Continue Shopping</a> &nbsp;

            <div style="float:right">
                <form action="{{ url('/emptyWishlist') }}" method="POST">
                    {!! csrf_field() !!}
                    <input type="hidden" name="_method" value="DELETE">
                    <input type="submit" class="btn btn-danger btn-lg" value="Empty Wishlist">
                </form>
            </div>

        @else

            <h3>You have no items in your Wishlist</h3>
            <a href="/index" class="btn btn-primary btn-lg">Continue Shopping</a>

        @endif

        <div class="spacer"></div>

    </div> <!-- end container -->

@endsection
