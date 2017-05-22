@extends('layouts.app')


@section('content')

	@php 
		$segments = explode('/', url()->current());
		$page = $segments[ count($segments) - 1 ];
	@endphp
	
	<div class="container-fluid">
		<div class="row">
			@foreach($section  as $k => $v)

			<div class="col s6 m4 l3 xl2 tv-section">
			  <div class="card hoverable">
				<div class="card-image">
			  	@if($v['poster_path']===null) <img class="pop-img" src="http://placehold.it/342x513?text=NO+POSTER">
				@else <img class="pop-img" src="{{'https://image.tmdb.org/t/p/w342'.$v['poster_path']}}">
				@endif
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
		<div class="row center">
			<ul class="pagination">
				<li class="waves-effect"><a href="/tv/{{$category}}/{{$page-1}}"><i class="material-icons">chevron_left</i></a></li>
				<li class="waves-effect"><a href="/tv/{{$category}}/1">1</a></li>
				<li class="waves-effect"><a href="/tv/{{$category}}/2">2</a></li>
				<li class="waves-effect"><a href="/tv/{{$category}}/3">3</a></li>
				<li class="waves-effect"><a href="/tv/{{$category}}/4">4</a></li>
				<li class="waves-effect"><a href="/tv/{{$category}}/5">5</a></li>
				<li class="waves-effect"><a href="/tv/{{$category}}/6">6</a></li>
				<li class="waves-effect"><a href="/tv/{{$category}}/7">7</a></li>
				<li class="waves-effect"><a href="/tv/{{$category}}/8">8</a></li>
				<li class="waves-effect"><a href="/tv/{{$category}}/9">9</a></li>
				<li class="waves-effect"><a href="/tv/{{$category}}/10">10</a></li>
				<li class="waves-effect"><a href="/tv/{{$category}}/{{$page+1}}"><i class="material-icons">chevron_right</i></a></li>
			</ul>
		</div>
	</div>	
	

	
@endsection


@section('js')
<script>
	$(document).ready(function(){ 
		$("ul li:nth-child({{$page+1}})").addClass( "active" ).removeClass("waves-effect");
		
		if($("ul li:nth-child(2)").hasClass("active")){
			$("ul li:nth-child(1)").addClass('disabled').removeClass('waves-effect');
		}
		
		if($("ul li:nth-last-child(2)").hasClass("active")){
			$("ul li:nth-last-child(1)").addClass('disabled').removeClass('waves-effect');
		} 
		
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
	});

	
</script>
@endsection('js')