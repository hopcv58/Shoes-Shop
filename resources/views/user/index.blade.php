@extends('layouts.user')
@section('content')
    <!--wrapper start-->
    <div id="wrapper">
        <div class="container">
            <!--image slide-->
            <section>
                <div class="row img-container section-row">
                    <div id="myCarousel" class="carousel slide" data-ride="carousel">
                        <!-- Indicators -->
                        <ol class="carousel-indicators">
                            <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
                            @for($i = 1; $i<count($slides);$i++)
                            <li data-target="#myCarousel" data-slide-to="{{$i}}"></li>
                            @endfor
                        </ol>

                        <!-- Wrapper for slides -->
                        <div class="carousel-inner" role="listbox">
                            <div class="item active">
                                <img src="{{asset('upload/img_product/'.$slides[0]->name)}}">
                            </div>

                            @for($i = 1; $i<count($slides);$i++)
                            <div class="item">
                                <img src="{{asset('upload/img_product/'.$slides[$i]->name)}}">
                            </div>
                            @endfor
                        </div>

                        <!-- Left and right controls -->
                        <a class="left carousel-control" href="#myCarousel" role="button" data-slide="prev">
                            <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
                            <span class="sr-only">Previous</span>
                        </a>
                        <a class="right carousel-control" href="#myCarousel" role="button" data-slide="next">
                            <span class="glyphicon glyphicon-chevron-right " aria-hidden="true"></span>
                            <span class="sr-only">Next</span>
                        </a>
                    </div>
                </div>
            </section>
            <!--image slide end-->
            <!--3 trailer image-->
            <section>
                <div class="row img-container section-row">
                    <div class="col-md-4">
                        <img src="http://placehold.it/500x500" class="img-responsive margin" alt="Image">
                    </div>
                    <div class="col-md-4">
                        <img src="http://placehold.it/500x500" class="img-responsive margin" alt="Image">
                    </div>
                    <div class="col-md-4">
                        <img src="http://placehold.it/500x500" class="img-responsive margin" alt="Image">
                    </div>
                </div>
            </section>
            <!--3 trailer image end-->
            @foreach($cateList as $cate)
                <section>
                    <!--section label-->
                    <div class="text-center section-row">
                        <div class="row">
                            <div class="col-md-5">
                                <hr>
                            </div>
                            <div class="col-md-2 section-title text-center">{{$cate->name}}</div>
                            <div class="col-md-5">
                                <hr>
                            </div>
                        </div>
                    </div>
                    <!--section label end-->
                    <!--section body-->
                    <div class="row">
                        @foreach($productList[$cate->id] as $pro)
                        <div class="col-md-3">
                            <div class="col-md-12 card img-container">
                                <a href="{{route('product',[$pro->id])}}" class="row thumbnail">
                                    <img src="{{asset('upload/img_product/'.$pro->img_profile)}}" class="img-responsive margin" alt="Image">
                                </a>
                                <div class="img-middle">
                                    <div class="img-overlay">
                                        <div class="col-md-6">
                                            <form action="{{ route('cart.store') }}" method="POST">
                                                {!! csrf_field() !!}
                                                <input type="hidden" name="id" value="{{ $pro->id }}">
                                                <input type="hidden" name="name" value="{{ $pro->name }}">
                                                <input type="hidden" name="price" value="{{ $pro->price }}">
                                                <input type="hidden" name="size" value="35">
                                                <input type="hidden" name="color"
                                                       value="{{array_unique(json_decode($pro->attribute)->color)[0]}}">
                                                <button type="submit"
                                                        class="glyphicon glyphicon-shopping-cart btn-default img-btn"
                                                        aria-hidden="true">
                                                </button>
                                            </form>
                                        </div>
                                        <div class="col-md-6">
                                            <form action="{{ route('wishlist.store') }}" method="POST">
                                                {!! csrf_field() !!}
                                                <input type="hidden" name="id" value="{{ $pro->id }}">
                                                <input type="hidden" name="name" value="{{ $pro->name }}">
                                                <input type="hidden" name="price" value="{{ $pro->price }}">
                                                <input type="hidden" name="size" value="35">
                                                <input type="hidden" name="color"
                                                       value="{{array_unique(json_decode($pro->attribute)->color)[0]}}">
                                                <button type="submit"
                                                        class="glyphicon glyphicon-tags btn-default img-btn"
                                                        aria-hidden="true">
                                                </button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                                <div style="padding: 20px">
                                    <p class=" text-center"><strong>{{$pro->name}}</strong></p>
                                    <h3 class=" text-center"><strong>{{$pro->price}} {{$pro->code}}</strong></h3>
                                </div>

                            </div>
                        </div>
                            @endforeach
                    </div>
                    <!--section body end-->
                    <!--section button-->
                    <div class="text-center section-row">
                        <a class="btn btn-default section-button" href="{{route('category',$cate->id)}}">
                            Xem thêm
                        </a>
                    </div>
                    <!--section button end-->
                </section>
            @endforeach
            <section>
                <!--section label-->
                <div class="text-center section-row">
                    <div class="row">
                        <div class="col-md-5">
                            <hr>
                        </div>
                        <div class="col-md-2 section-title text-center">Đánh giá</div>
                        <div class="col-md-5">
                            <hr>
                        </div>
                    </div>
                </div>
                <!--section label end-->
                <!--section body-->
                <div class="row">
                    @foreach($feedbacks as $feedback)
                        <div class="col-md-2">
                            <div class="col-md-12 card img-container">
                                <a href="{{route('product',[$pro->id])}}" class="row thumbnail">
                                    <img src="{{asset('upload/img_product/'.$pro->img_profile)}}" class="img-responsive margin" alt="Image">
                                </a>
                                <div class="img-middle">
                                    <div class="img-overlay">
                                        <div class="col-md-6">
                                            <form action="{{ route('cart.store') }}" method="POST">
                                                {!! csrf_field() !!}
                                                <input type="hidden" name="id" value="{{ $pro->id }}">
                                                <input type="hidden" name="name" value="{{ $pro->name }}">
                                                <input type="hidden" name="price" value="{{ $pro->price }}">
                                                <input type="hidden" name="size" value="35">
                                                <input type="hidden" name="color"
                                                       value="{{array_unique(json_decode($pro->attribute)->color)[0]}}">
                                                <button type="submit"
                                                        class="glyphicon glyphicon-shopping-cart btn-default img-btn"
                                                        aria-hidden="true">
                                                </button>
                                            </form>
                                        </div>
                                        <div class="col-md-6">
                                            <form action="{{ route('wishlist.store') }}" method="POST">
                                                {!! csrf_field() !!}
                                                <input type="hidden" name="id" value="{{ $pro->id }}">
                                                <input type="hidden" name="name" value="{{ $pro->name }}">
                                                <input type="hidden" name="price" value="{{ $pro->price }}">
                                                <input type="hidden" name="size" value="35">
                                                <input type="hidden" name="color"
                                                       value="{{array_unique(json_decode($pro->attribute)->color)[0]}}">
                                                <button type="submit"
                                                        class="glyphicon glyphicon-tags btn-default img-btn"
                                                        aria-hidden="true">
                                                </button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                                <div style="padding: 20px">
                                    <p class=" text-center"><strong>{{$pro->name}}</strong></p>
                                    <h3 class=" text-center"><strong>{{$pro->price}} {{$pro->code}}</strong></h3>
                                </div>

                            </div>
                        </div>
                    @endforeach
                </div>
                <!--section body end-->
                <!--section button-->
                <div class="text-center section-row">
                    <a class="btn btn-default section-button" href="{{route('category',$cate->id)}}">
                        Xem thêm
                    </a>
                </div>
                <!--section button end-->
            </section>
        </div>
    </div>
    <!--wrapper end-->
@endsection

