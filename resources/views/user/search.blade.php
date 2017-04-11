@extends('layouts.user')
@section('left_bar')
    <ul><strong><h3>Danh mục</h3></strong></ul>
    <ul class="col-md-offset-1">
        @foreach($cateList as $category)
            <li><strong><a href="{{url('category',[$category->id])}}">{{$category->name}}</a></strong></li>
        @endforeach
    </ul>
    <ul>
        <li><a href="#products"><h3>Products</h3></a></li>
        <li><a href="#categories"><h3>Categories</h3></a></li>
        <li><a href="#news"><h3>News</h3></a></li>
    </ul>
@endsection
@section('content')
    <section class="row">
        <!--section label-->
        <div class="text-center section-row" id="products">
            <div class="row">
                <div class="col-md-5">
                    <hr>
                </div>
                <div class="col-md-2 section-title text-center">Giày</div>
                <div class="col-md-5">
                    <hr>
                </div>
                <div class="row">
                    <h4>({{count($products)}} kết quả)</h4>
                </div>
            </div>
        </div>
        <!--section label end-->
        @if(count($products)>0)
            <div class="col-md-10 col-md-offset-1">
                @foreach($products as $key => $product)
                    <div class="col-md-3">
                        <div class="col-md-12 card img-container">
                            @if (isset($product->advertisments))
                                <div class="img-adv">-{{$product->advertisments->discount}}%</div>
                            @endif
                            <div class="row thumbnail">
                                <a href="{{route('product',[$product->id])}}">
                                    <img src="{{asset('upload/img_product/'.$product->img_profile)}}"
                                         class="img-responsive margin"
                                         alt="Image"></a>
                            </div>
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
                                <p class=" text-center img-name"><strong>{{$product->name}}</strong></p>
                                <h3 class=" text-center">
                                    <strong>{{$product->price}} {{$product->code}}</strong>
                                </h3>
                            </div>

                        </div>
                    </div>
                @endforeach
            </div>

        @endif
    </section>
    <section class="row">
        <!--section label-->
        <div class="text-center section-row" id="categories">
            <div class="row">
                <div class="col-md-5">
                    <hr>
                </div>
                <div class="col-md-2 section-title text-center">Kiểu giày
                </div>
                <div class="col-md-5">
                    <hr>
                </div>
            </div>
            <div class="row">
                <h4>({{count($categories)}} kết quả)</h4>
            </div>
        </div>
        <!--section label end-->
        @if(count($categories)>0)
            <div class="col-md-10 col-md-offset-1">
                @foreach($categories as $category)
                    <a href="{{route('category',$category->id)}}"
                       class="col-md-6 btn btn-default btn-lg text-center">
                        {{$category->name}}
                    </a>
                @endforeach
            </div>
        @endif
    </section>
    <section class="row">
        <!--section label-->
        <div class="text-center section-row" id="news">
            <div class="row">
                <div class="col-md-5">
                    <hr>
                </div>
                <div class="col-md-2 section-title text-center">Bài viết</div>
                <div class="col-md-5">
                    <hr>
                </div>
                <div class="row">
                    <h4>({{count($newsList)}} kết quả)</h4>
                </div>
            </div>
        </div>
        <!--section label end-->
        @if(count($newsList)>0)
            @foreach($newsList as $news)
                <div class="col-md-4">
                    <div class="col-md-12 card img-container">
                        <div class="row thumbnail">
                            <a href="{{route('news',$news->id)}}">
                                <img src="{{asset('upload/img_product/'.$news->img)}}"
                                     class="img-responsive margin" alt="Image">
                            </a>
                        </div>
                        <div class="row img-label">
                            <h4 class=" text-center img-name">
                                <strong>
                                    <a href="{{route('news',$news->id)}}">{{$news->title}}</a>
                                </strong>
                            </h4>
                            <div class="spacer"></div>
                        </div>

                    </div>
                </div>
            @endforeach
        @endif
    </section>


    @if(count($newsList)==0 && count($categories)==0 && count($products)==0)
        <div class="panel panel-default col-md-8 col-md-offset-2">
            <div class="panel panel-body text-center">
                <h3>Không tìm thấy bất cứ kết quả nào phù hợp</h3>
            </div>
        </div>
    @endif
@endsection