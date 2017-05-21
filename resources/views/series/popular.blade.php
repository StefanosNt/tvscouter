@extends('layouts.app')


@section('content')

	<div class="container-fluid">
		<div class="row">
			@foreach($popular  as $k => $v)

			<div class="col s6 m4 l3 xl2 popular">
			  <div class="card hoverable">
				<div class="card-image">
				  <img class="pop-img" src="{{'https://image.tmdb.org/t/p/w500'.$v['poster_path']}}">
<!--				  <a class="btn-floating halfway-fab waves-effect waves-light red"><i class="material-icons">add</i></a>-->
				</div>
				<div class="card-content pop-body">
			  <span class="card-title"> <a href="/tv/{{$v['id']}}"> {{$v['name']}} </a> </span>
<!--				  <p>{{substr($v['overview'],0,100)}}...</p>-->
				</div>
			  </div>
			</div> 
			
			@endforeach  
			
		</div>
	</div>	
@endsection


@section('js')
<script>
//	$(document).ready(function(){ 
//		var minHeight = 9999;
//		$(window).on('resize', function(){  
//			var win = $(this); //this = window 
//			if (win.width() <= 600 ) {  minHeight = 9999 }
//			if (win.width() >600 && win.width() <= 992 ) {  minHeight = 9999 }
//			if (win.width() >992 && win.width() <= 1200 ) {  minHeight = 9999 }
//			if (win.width() >120 ) {  minHeight = 9999 }
//			
//			
//			$('.popular').each(function(i,el){
//				if($(this).height() < minHeight) {
//					minHeight = $(this).height();  
//					console.log(minHeight);
//				}
//			}); 
//			$('.popular').css('max-height', minHeight);
//		});
//	});

	
</script>
@endsection('js')