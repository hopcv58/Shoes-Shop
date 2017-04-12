@extends('layouts.user')
@section('left_bar')
    <div class="col-md-12">
        <h4 class="mybold">TÌM THEO TÊN</h4>
        <div class="input-group">
        <span class="input-group-btn">
            <button class="btn btn-default"><i class="fa fa-search"></i></button>
        </span>
            <input id="search" onkeyup="filt()" type="text" class="form-control col-md-7"
                   placeholder="Nhập tên sản phẩm ...">
        </div>
        <div class="row">
            <h4 class="mybold">DANH MỤC</h4>
            <ul class="list-unstyled">
                @foreach($cateList as $cate)
                    <li style="margin-left: 10px; margin-bottom: 10px; color: #3d393a"><strong><a
                                    href="{{url('category',[$cate->id])}}">{{$cate->name}}</a></strong></li>
                @endforeach
            </ul>
        </div>

        <div class="row">
            <h4 class="mybold">KHOẢNG GIÁ</h4>
            <div class="text-left">
                <p><strong>Từ</strong></p>
                <input id="min" name="min" type="number" class="form-control col-md-7" onkeyup="filt()">
                <br> <br>
                <br>
                <p><strong>Đến</strong></p>
                <input id="max" name="max" type="number" class="form-control col-md-7" onkeyup="filt()">

            </div>
        </div>

        <div class="row">
            <h4 class="mybold">CHẤT LIỆU</h4>
            <ul class="list-unstyled">
                <li class="col-md-6"><input type="checkbox" id="materialInput" value="Da mờ" onchange="filt();"> Da mờ
                </li>
                <li class="col-md-6"><input type="checkbox" id="materialInput" value="Da" onchange="filt();"> Da bò</li>
                <li class="col-md-6"><input type="checkbox" id="materialInput" value="4" onchange="filt();"> Kim tuyến
                </li>
                <li class="col-md-6"><input type="checkbox" id="materialInput" value="4" onchange="filt();"> Kim tuyến
                </li>
                <li class="col-md-6"><input type="checkbox" id="materialInput" value="4" onchange="filt();"> Kim tuyến
                </li>
                <li class="col-md-6"><input type="checkbox" id="materialInput" value="4" onchange="filt();"> Kim tuyến
                </li>
            </ul>
        </div>

        <div class="row">
            <h4 class="mybold">ĐỘ CAO</h4>
            <ul class="list-unstyled">
                <li class="col-md-4"><input type="checkbox" id="heightInput" value="1" onchange="filt()"> 1 cm</li>
                <li class="col-md-4"><input type="checkbox" id="heightInput" value="2" onchange="filt()"> 2 cm</li>
                <li class="col-md-4"><input type="checkbox" id="heightInput" value="3" onchange="filt()"> 3 cm</li>
                <li class="col-md-4"><input type="checkbox" id="heightInput" value="4" onchange="filt()"> 4 cm</li>
                <li class="col-md-4"><input type="checkbox" id="heightInput" value="5" onchange="filt()"> 5 cm</li>
                <li class="col-md-4"><input type="checkbox" id="heightInput" value="6" onchange="filt()"> 6 cm</li>
                <li class="col-md-4"><input type="checkbox" id="heightInput" value="7" onchange="filt()"> 7 cm</li>
                <li class="col-md-4"><input type="checkbox" id="heightInput" value="8" onchange="filt()"> 8 cm</li>
                <li class="col-md-4"><input type="checkbox" id="heightInput" value="9" onchange="filt()"> 9 cm</li>
                <li class="col-md-4"><input type="checkbox" id="heightInput" value="10" onchange="filt()"> 10 cm</li>
                <li class="col-md-4"><input type="checkbox" id="heightInput" value="11" onchange="filt()"> 11 cm</li>
            </ul>
        </div>
    </div>
@endsection
@section('right_content')
    <div class="row">
        <!--section label-->
        <hr>
        <h3>Giày:
            <small>({{count($products)}} kết quả )</small>
        </h3>
        <br>

        <!--section label end-->
        @if(count($products)>0)
            @foreach($products as $key => $product)
                <div class="col-md-3">
                    <div class="img-container">
                        @if (isset($product->advertisments))
                            <div class="img-adv">-{{$product->advertisments->discount}}%</div>
                        @endif
                        <a href="{{route('product',[$product->id])}}">
                            <img src="{{asset('upload/img_product/'.$product->img_profile)}}"
                                 class="img-responsive margin"
                                 alt="Image"></a>

                        <div class="img-middle">
                            <div class="img-overlay">
                                <div class="col-md-6">
                                    <form action="{{ route('cart.store') }}" method="POST">
                                        {!! csrf_field() !!}
                                        <input type="hidden" name="id" value="{{ $product->id }}">
                                        <input type="hidden" name="name" value="{{ $product->name }}">
                                        <input type="hidden" name="price" value="{{ $product->price }}">
                                        <input type="hidden" name="option"
                                               value="{{ $product->attribute }}">
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
                                        <input type="hidden" name="price" value="{{ $product->price }}">
                                        <input type="hidden" name="option"
                                               value="{{ $product->attribute }}">
                                        <button type="submit"
                                                class="glyphicon glyphicon-tags btn-default img-btn"
                                                aria-hidden="true">
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </div>
                        <div class="row img-label">
                            <p class=" text-center img-name" style="margin-bottom: 20px">
                                <strong>{{$product->name}}</strong></p>
                            <h4 class=" text-center">
                                <strong>{{number_format($product->price)}} đ</strong>
                            </h4>
                        </div>

                    </div>
                </div>
            @endforeach

        @endif
    </div>
    <div class="row">
        <!--section label-->
        <hr>
        <h3>Kiểu giày:
            <small>({{count($categories)}} kết quả)</small>
        </h3>
        <br>
        <!--section label end-->
        @if(count($categories)>0)
            @foreach($categories as $category)
                <a href="{{route('category',$category->id)}}"
                   class="text-center">
                    {{$category->name}}
                </a>
            @endforeach
        @endif
    </div>
    <div class="row">
        <!--section label-->
        <hr>
        <h3>Các bài post:
            <small>({{count($newsList)}} kết quả)</small>
        </h3>
        <br>
        <!--section label end-->
        @if(count($newsList)>0)
            @foreach($newsList as $news)
                <div class="col-md-4">
                    <a href="{{route('news',$news->id)}}">
                        <img src="{{asset('upload/img_news/'.$news->img)}}"
                             class="img-responsive margin" alt="Image">
                    </a>
                    <br>
                    <h4 class=" text-center"> {{$news->title}} </h4>

                    <p>{{$news->summary}}</p>
                </div>
            @endforeach
        @endif
    </div>


    @if(count($newsList)==0 && count($categories)==0 && count($products)==0)
        <div class="row">
            <hr>
                <h3>Không tìm thấy bất cứ kết quả nào phù hợp!</h3>
        </div>
    @endif
@endsection
@section('extra_js')
    <script>
        function filt() {
            var input, productList, productName, min, max, price, material, height;
            var materialInput = [];
            var heightInput = [];
            $("input:checkbox[id=materialInput]:checked").each(function () {
                materialInput.push($(this).val());
            });
            $("input:checkbox[id=heightInput]:checked").each(function () {
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
            "click": function (e) {
                e.stopPropagation();
            }
        });
    </script>
@endsection