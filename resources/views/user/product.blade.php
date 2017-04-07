@extends('layouts.user')
@section('content')
    <!--wrapper start-->
    <div id="wrapper">
        <div class="container">
            <div class="row">
                <div class="col-md-5">
                    <div class="prezoom" data-scale="4" data-image="http://placehold.it/445x445"></div>
                </div>
                <div class="col-md-6">
                    <h3>{{$product->name}}</h3>
                    {{$product->description}}
                    <h4> Chọn màu:</h4>
                    {{$product->attribute}}
                    <h4>Chọn size:</h4>
                    {{$product->attribute}}

                    <div class="row">
                        <form action="{{ url('/cart') }}" method="POST" class="col-md-4">
                            {!! csrf_field() !!}
                            <input type="hidden" name="id" value="{{ $product->id }}">
                            <input type="hidden" name="name" value="{{ $product->name }}">
                            <input type="hidden" name="price" value="{{ $product->price }}">
                            <input type="hidden" name="option" value="{{ $product->attribute }}">
                            <input type="submit" class="btn btn-success btn-lg" value="Add to Cart">
                        </form>

                        <form action="{{ url('/wishlist') }}" method="POST" class="col-md-4">
                            {!! csrf_field() !!}
                            <input type="hidden" name="id" value="{{ $product->id }}">
                            <input type="hidden" name="name" value="{{ $product->name }}">
                            <input type="hidden" name="price" value="{{ $product->price }}">
                            <input type="submit" class="btn btn-primary btn-lg" value="Add to Wishlist">
                        </form>
                    </div>
                </div>
            </div>


            {{--comment--}}

            <div class="text-center section-row">
                <div class="row">
                    <div class="col-md-5">
                        <hr>
                    </div>
                    <div class="col-md-2 section-title">Ý kiến khách hàng</div>
                    <div class="col-md-5">
                        <hr>
                    </div>
                </div>
            </div>
            <div class="panel panel-default col-md-8 col-md-offset-2">
                <div class="panel panel-body">
                    @foreach($comment as $cmt)
                        <strong class="col-md-12">{{$cmt->username}}</strong><br>
                        <i class="col-md-8">{{$cmt->email}}</i>
                        <i class="col-md-4">{{$cmt->created_at}}</i>
                        <p class="col-md-12">{{$cmt->content}}</p>
                    @endforeach
                </div>
            </div>


            {{--end comment--}}
            {{--add comment--}}

            @if (Auth::guard('customer')->guest())
                <form action="" method="POST" class="form-horizontal col-md-8 col-md-offset-2">
                    {!! csrf_field() !!}
                    <div class="form-group">
                        <textarea class="col-md-8 form-control" rows="5" id="comment" placeholder="Your comment"
                                  required></textarea>
                    </div>
                    <div class="form-group">
                        <label for="name">Your name:</label>
                        <input type="text" class="form-control" id="name" required>
                    </div>
                    <div class="form-group">
                        <label for="email">Your email:</label>
                        <input type="email" class="form-control" id="email" required>
                    </div>
                    <div class="form-group">
                        <label for="phone">Your Phone number:</label>
                        <input type="text" class="form-control" id="phone" required>
                    </div>
                    <button class="btn btn-info btn-lg">Comment as Guest</button>
                    <i class="pull-right">REMEMBER: You have to wait for accept for this comment</i>
                </form>
            @else
                <form action="" method="POST" class="form-horizontal col-md-8 col-md-offset-2">
                    {!! csrf_field() !!}
                    <div class="form-group">
                        <textarea class="col-md-8 form-control" rows="5" id="comment" placeholder="Your comment"
                                  required></textarea>
                    </div>
                    <button class="btn btn-info btn-lg">Comment as {{ Auth::guard('customer')->user()->username }}</button>
                </form>
            @endif
        </div>
    </div>
    {{--end add comment--}}
    <!--wrapper end-->
@endsection


@section('extra_js')
    <script>
			var elementThumbnailPhoto = 'prezoom';
			var elementPhoto = 'zoomed';

			$('.' + elementThumbnailPhoto)
			// tile mouse actions
				.on('mouseover', function () {
					$(this).children('.' + elementPhoto).css({
						'transform': 'scale(' + $(this).attr('data-scale') + ')'
					});
				})
				.on('mouseout', function () {
					$(this).children('.' + elementPhoto).css({
						'transform': 'scale(1)'
					});
				})
				.on('mousemove', function (e) {
					$(this).children('.' + elementPhoto).css({
						'transform-origin': ((e.pageX - $(this).offset().left) / $(this).width()) * 100 + '% ' + ((e.pageY - $(this).offset().top) / $(this).height()) * 100 + '%'
					});
				})
				// tiles set up
				.each(function () {
					$(this)
					// add a photo container
						.append('<div class="' + elementPhoto + '"></div>')
						// set up a background image for each tile based on data-image attribute
						.children('.' + elementPhoto).css({
						'background-image': 'url(' + $(this).attr('data-image') + ')'
					});
				})
    </script>
@endsection