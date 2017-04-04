@extends('layouts.user')
@section('content')
<!--wrapper start-->
<div id="wrapper">
    <div class="container">
        <div class="col-md-5">
            <div class="prezoom" data-scale="4" data-image="http://placehold.it/445x445"></div>
        </div>
        <div class="col-md-6">
            Chi tiết sản phẩm
        </div>
    </div>
</div>
<!--wrapper end-->
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
