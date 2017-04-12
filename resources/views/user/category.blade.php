@extends('layouts.user')
@section('path')
    <div>
        @if(isset($category))
            <img src="{{asset("upload/img_pages/$category->img_profile")}}" alt=""
                 class="img-responsive"/>
        @else
            {{--Link ảnh cho sản phẩm mới nhất ở đây--}}
            <img src="{{asset("upload/img_pages/sanPhamMoiNhat")}}" alt=""
                 class="img-responsive"/>
        @endif
        <ol class="breadcrumb">
            <li><a href="{{route('index')}}">Trang chủ</a></li>
            <li><a href="#">Danh mục</a></li>
            <li class="active"><span style="font-weight: bold;">
                {{isset($category->name)? $category->name : 'Sản phẩm mới nhập'}}
                </span></li>
        </ol>
        <h3 class="text-center">{{isset($category->name)? $category->name : 'Sản phẩm mới nhập'}}</h3>
        <hr style="background-color: #292126; height: 1px">
    </div>
@endsection
@section('left_bar')
    <ul><strong><h3>Danh mục</h3></strong></ul>
    <ul class="col-md-offset-1">
        @foreach($cateList as $cate)
            <li><strong><a href="{{url('category',[$cate->id])}}">{{$cate->name}}</a></strong></li>
        @endforeach
    </ul>
    <ul>
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
        <li><h4>Chất liệu:</h4></li>
        <li>
            <ul>
                <li class="col-md-6"><input type="checkbox" id="materialInput" value="Da mờ" onchange="filt()">Da mờ
                </li>
                <li class="col-md-6"><input type="checkbox" id="materialInput" value="Nhựa" onchange="filt()">Nhựa</li>
                <li class="col-md-6"><input type="checkbox" id="materialInput" value="Da" onchange="filt()">Da</li>
                <li class="col-md-6"><input type="checkbox" id="materialInput" value="4" onchange="filt()">Option 4</li>
            </ul>
        </li>
        <li><h4>Độ cao gót:</h4></li>
        <li>
            <ul>
                <li class="col-md-4"><input type="checkbox" id="heightInput" value="1" onchange="filt()">1 cm</li>
                <li class="col-md-4"><input type="checkbox" id="heightInput" value="2" onchange="filt()">2 cm</li>
                <li class="col-md-4"><input type="checkbox" id="heightInput" value="3" onchange="filt()">3 cm</li>
                <li class="col-md-4"><input type="checkbox" id="heightInput" value="4" onchange="filt()">4 cm</li>
                <li class="col-md-4"><input type="checkbox" id="heightInput" value="5" onchange="filt()">5 cm</li>
                <li class="col-md-4"><input type="checkbox" id="heightInput" value="6" onchange="filt()">6 cm</li>
                <li class="col-md-4"><input type="checkbox" id="heightInput" value="7" onchange="filt()">7 cm</li>
                <li class="col-md-4"><input type="checkbox" id="heightInput" value="8" onchange="filt()">8 cm</li>
                <li class="col-md-4"><input type="checkbox" id="heightInput" value="9" onchange="filt()">9 cm</li>
                <li class="col-md-4"><input type="checkbox" id="heightInput" value="10" onchange="filt()">10 cm</li>
                <li class="col-md-4"><input type="checkbox" id="heightInput" value="11" onchange="filt()">11 cm</li>
            </ul>
        </li>
        <li>
            <h4 class="col-md-12" href="#">Tên:</h4>
            <div class="col-md-12">
                <input id="search" onkeyup="filt()" type="text" class="form-control col-md-7">
            </div>
        </li>
    </ul>
@endsection
@section('right_content')
    <!--wrapper start-->
    <!--section body-->
    <div id="productList">
        @foreach($products as $key => $product)
            <div class="col-md-3" id="card{{$key}}">
                <div class="product-item">
                    @if (isset($product->advertisments))
                        <div class="img-adv"><p>-{{$product->advertisments->discount}}%</p></div>
                    @endif

                    {{--<div class="row">--}}
                    <a href="{{route('product',[$product->id])}}">
                        <img src="{{asset('upload/img_product/'.$product->img_profile)}}"
                             class="img-responsive margin"
                             alt="Image">
                    </a>
                    {{--</div>--}}
                    <div class="img-middle-cate">
                        <div class="img-overlay">
                            <div class="col-md-6">
                                <form action="{{ route('cart.store') }}" method="POST">
                                    {!! csrf_field() !!}
                                    <input type="hidden" name="id" value="{{ $product->id }}">
                                    <input type="hidden" name="name" value="{{ $product->name }}">
                                    @if (!isset($product->advertisments))
                                        <input type="hidden" name="price" value="{{ $product->price }}">
                                    @else
                                        <input type="hidden" name="price"
                                               value="{{$product->price*(100-$product->advertisments->discount)/100}}">
                                    @endif
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
                                    @if (!isset($product->advertisments))
                                        <input type="hidden" name="price" value="{{ $product->price }}">
                                    @else
                                        <input type="hidden" name="price"
                                               value="{{$product->price*(100-$product->advertisments->discount)/100}}">
                                    @endif
                                    <input type="hidden" name="size" value="35">
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
                    <div class="product-price" style="margin-top: 20px">
                        <p class="text-center"><strong>{{$product->name}}</strong></p>
                        @if (isset($product->advertisments))
                            <h3 class="text-center">
                                {{number_format($product->price*(100-$product->advertisments->discount)/100)}} đ
                            </h3>
                            <h4 class="text-center">
                                <strike>{{number_format($product->price)}} đ</strike>
                            </h4>
                        @else
                            <h3 class=" text-center">
                                {{number_format($product->price)}} đ
                            </h3>
                            <br>
                        @endif

                    </div>

                </div>
            </div>
        @endforeach
            {{ $products->links() }}
    </div>
    <!--section body end-->
@endsection
@section('extra_js')
    <script>
        function filt()
        {
            var input, productList, productName, min, max, price, material, height;
            var materialInput = [];
            var heightInput = [];
            $("input:checkbox[id=materialInput]:checked").each(function ()
            {
                materialInput.push($(this).val());
            });
            $("input:checkbox[id=heightInput]:checked").each(function ()
            {
                heightInput.push($(this).val());
            });
            input = document.getElementById("search").value;
            productList = document.getElementById("productList");
            min = document.getElementById("min").value;
            max = document.getElementById("max").value;
            @foreach ($products as $i => $product)
                productName = "{{$product->name}}";
            @if (isset($product->advertisments))
                price = {{$product->price*(100-$product->advertisments->discount)/100}};
            @else
                price = {{$product->price}};
            @endif
                material = "{{$product->material}}";
            height = "{{$product->height}}";
            if ((productName.toUpperCase().includes(input.toUpperCase())) &&
                (price >= min && (price <= max || max == 0)) &&
                (materialInput.indexOf(material) > -1 || materialInput.length == 0) &&
                (heightInput.indexOf(height) > -1 || heightInput.length == 0)) {
                document.getElementById("card{{$i}}").style.display = "";
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
