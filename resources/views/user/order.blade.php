@extends('layouts.user')
@section('content')
    @if (Auth::guard('customer')->guest())
        Nhập địa chỉ và chọn PT thanh toán
    @else
        Chọn phương thức thanh toán
    @endif
@endsection