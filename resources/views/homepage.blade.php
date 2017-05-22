@extends('layouts.app')
<style> 
</style>

@section('content') 
	<div class="container">
		<div class="row"> 
		<h1 class="fw200 center">Time spent watching series</h1>
			<div class="col s12 section center">
				<h1>{{$totalHours}}</h1>
				<p>Total hours</p>
			</div>
			<div class="col s6 m3 section center">
				<h2>{{$years}}</h2>
				<p>Years</p>
			</div>
			<div class="col s6 m3 section center">
				<h2>{{$months}}</h2>
				<p>Months</p>
			</div>
			<div class="col s6 m3 section center">
				<h2>{{$days}}</h2>
				<p>Days</p>
			</div>
			<div class="col s6 m3 section center">
				<h2>{{$hours}}</h2>
				<p>Days</p>
			</div>
		</div>
		<div class="divider"></div>
		
		<h1 class="fw200 center">Popular</h1>
		@include('components.popular')
		<a class="btn red mb30" href="tv/popular/1">Show more</a>
		<div class="divider"></div>

		<h1 class="fw200 center">Top Rated</h1> 
		@include('components.top-rated')
		<a class="btn red mb30" href="tv/top_rated/1">Show more</a>

		<div class="divider"></div>

		
	</div>  
	 
  	
  	
@endsection

@section('js')
<script> 
	$(document).ready(function(){
		
	$('.carousel.carousel-slider').carousel({fullWidth: true});
		
		
	});
</script>
@endsection