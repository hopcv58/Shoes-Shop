@extends('layouts.user')
@section('content')
<!--wrapper start-->
<div id="wrapper">
    <div class="container-fluid">
        <!--side tab-->
        <div class="col-md-2 sidebar-nav">
            <div class="sidebar-nav">
                <div class="navbar navbar-default" role="navigation">
                    <div class="navbar-collapse collapse sidebar-navbar-collapse">
                        <ul class="nav navbar-nav">
                            <li class="active"><a href="#">Menu Item 1</a></li>
                            <li><a href="#">Menu Item 2</a></li>
                            <li><a href="#">Menu Item 3</a></li>
                            <li><a href="#">Menu Item 4</a></li>
                            <li><a href="#">Reviews <span class="badge">1,118</span></a></li>
                        </ul>
                    </div><!--/.nav-collapse -->
                </div>
            </div>
        </div>
        <!--side tab end-->
        <div class="col-md-9">
            <h3 class="text-center">{{$category->name}}</h3>
            <!--section body-->
            @foreach($products as $product)
            <div class="col-md-3">
                <div class="col-md-12 card img-container">
                    <div class="row thumbnail">
                        <a href="/product/{{$product->id}}"><img src="http://placehold.it/500x500" class="img-responsive margin" alt="Image"></a>
                    </div>
                    <div class="img-middle">
                        <div class="img-overlay">
                            <div class="col-md-6">
                                <a href="#" class="glyphicon glyphicon-shopping-cart img-btn btn-default"
                                   aria-hidden="true"></a>
                            </div>
                            <div class="col-md-6">
                                <a href="/product/{{$product->id}}" class="glyphicon glyphicon-eye-open img-btn btn-default " aria-hidden="true"></a>
                            </div>
                        </div>
                    </div>
                    <div class="row img-label">
                        <p class=" text-center img-name"><strong>{{$product->name}}</strong></p>
                        <h3 class=" text-center"><strong>{{$product->price}} {{$product->code}}</strong></h3>
                    </div>
                
                </div>
            </div>
            @endforeach
            <!--section body end-->
        </div>
    
    </div>
</div>
<!--wrapper end-->
@endsection
