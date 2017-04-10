@extends('layouts.user')
@section('extra_nav')
    <li class="dropdown" id="filtMenu">
        <a class="dropdown-toggle" data-toggle="dropdown" href="#">Lọc theo
            <span class="caret"></span></a>
        <ul class="dropdown-menu">
            <li>
                <h4 class="col-md-12" href="#">Chọn khoảng giá:</h4>
                <div class="col-md-12">
                    <div class="text-left">Từ
                        <input id="min" type="number" class="form-control col-md-7" onkeyup="filt()">
                        <div class="text-left">đến</div>
                        <input id="max" type="number" class="form-control col-md-7" onkeyup="filt()">
                    </div>
                </div>
            </li>
            <li>
                <h4 class="col-md-12" href="#">Chọn chất liệu:</h4>
                <div class="col-md-12">
                    <input id="materialInput" type="text" class="form-control col-md-7" onblur="filt()">
                </div>
            </li>
            <li>
                <h4 class="col-md-12" href="#">Tên:</h4>
                <div class="col-md-12">
                    <input id="search" onkeyup="filt()" type="text" class="form-control col-md-7">
                </div>
            </li>
        </ul>
    </li>
@endsection
@section('content')
    <!--wrapper start-->
    <div id="wrapper">
        <div class="container">
            <div class="col-md-12">
                <h3 class="text-center">{{isset($category->name)? $category->name : 'All categories'}}</h3>
                <!--section body-->
                <div id="productList">
                    @foreach($products as $key => $product)
                        <div class="col-md-3" id="card{{$key}}">
                            <div class="col-md-12 card img-container">
                                @if (isset($product->advertisments))
                                    <div class="img-adv">-{{$product->advertisments->discount}}%</div>
                                @endif

                                <div class="row thumbnail">
                                    <a href="{{route('product',[$product->id])}}">
                                        <img src="{{asset('upload/img_product/'.$product->img_profile)}}" class="img-responsive margin"
                                             alt="Image">
                                    </a>
                                </div>
                                <div class="img-middle">
                                    <div class="img-overlay">
                                        <div class="col-md-6">
                                            <form action="{{ route('cart.store') }}" method="POST">
                                                {!! csrf_field() !!}
                                                <input type="hidden" name="id" value="{{ $product->id }}">
                                                <input type="hidden" name="name" value="{{ $product->name }}">
                                                <input type="hidden" name="price" value="{{ $product->price }}">
                                                <input type="hidden" name="size" value="35">
                                                <input type="hidden" name="color"
                                                       value="{{array_unique(json_decode($product->attribute)->color)[0]}}">
                                                <button type="submit"
                                                        class="glyphicon glyphicon-shopping-cart btn-default img-btn"
                                                        aria-hidden="true">
                                                </button>
                                            </form>
                                        </div>
                                        <div class="col-md-6">
                                            <form action="{{ route('wishlist.store') }}" method="POST">
                                                {!! csrf_field() !!}
                                                <input type="hidden" name="id" value="{{ $product->id }}">
                                                <input type="hidden" name="name" value="{{ $product->name }}">
                                                <input type="hidden" name="price" value="{{ $product->price }}"><input
                                                        type="hidden" name="size" value="35">
                                                <input type="hidden" name="color"
                                                       value="{{array_unique(json_decode($product->attribute)->color)[0]}}">
                                                <button type="submit"
                                                        class="glyphicon glyphicon-tags btn-default img-btn"
                                                        aria-hidden="true">
                                                </button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                                <div class="row img-label">
                                    <p class=" text-center img-name"><strong>{{$product->name}}</strong></p>
                                    @if (isset($product->advertisments))
                                        <h4 class="text-center">
                                            <span class=" text-center"><strike>{{$product->price}}</strike></span>
                                            <span class=" text-center"><strong>{{$product->price*(100-$product->advertisments->discount)/100}} {{$product->code}}</strong></span>
                                        </h4>

                                    @else
                                        <h4 class=" text-center"><strong>{{$product->price}} {{$product->code}}</strong>
                                        </h4>
                                    @endif

                                </div>

                            </div>
                        </div>
                    @endforeach
                </div>

                <!--section body end-->
            </div>

        </div>
    </div>

    <!--wrapper end-->
@endsection
@section('extra_js')
    <script>
        function filt()
        {
            var input, productList, productName, min, max, price, materialInput, material;
            input = document.getElementById("search").value;
            productList = document.getElementById("productList");
            min = document.getElementById("min").value;
            max = document.getElementById("max").value;
            materialInput = document.getElementById("materialInput").value;
            if (max == 0) {
                max = 1000;
            }
            @foreach ($products as $i => $product)
                productName = "{{$product->name}}";
            @if (isset($product->advertisments))
                price = {{$product->price*(100-$product->advertisments->discount)/100}};
            @else
                price = {{$product->price}};
            @endif
                material = "{{implode("",json_decode($product->attribute)->material)}}";
            if (productName.toUpperCase().includes(input.toUpperCase())) {
                if (price >= min && (price <= max)) {
                    if (material.toUpperCase().includes(materialInput.toUpperCase())) {
                        document.getElementById("card{{$i}}").style.display = "";
                    } else {
                        document.getElementById("card{{$i}}").style.display = "none";
                    }
                } else {
                    document.getElementById("card{{$i}}").style.display = "none";
                }
            } else {
                document.getElementById("card{{$i}}").style.display = "none";
            }
            @endforeach
        }
    </script>
    <script>
        $('#filtMenu .dropdown-menu').on({
            "click": function (e)
            {
                e.stopPropagation();
            }
        });
    </script>
@endsection
