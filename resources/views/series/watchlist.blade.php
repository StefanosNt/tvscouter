@extends('layouts.app')


@section('content')
	
	<div class="container-fluid">
		<div class="center-align"><h1 class="section-title"> WATCHLIST </h1></div>
		
		<div class="row">
			@foreach($watchlist  as $k => $v)

			<div class="col s6 m4 l3 xl2 pbot">
			  <div class="card hoverable">
				<div class="card-image">
				  <img class="pop-img" src="{{'https://image.tmdb.org/t/p/w500'.$v['series_poster']}}">
<!--				  <a class="btn-floating halfway-fab waves-effect waves-light red"><i class="material-icons">add</i></a>-->
				</div>
				<div class="card-content pop-body">
			  		<span class="card-title"> <a href="/tv/{{$v['series_id']}}"> {{$v['series_name']}} </a> </span>
				</div>
			  </div>
			</div> 
			
			@endforeach  
			
		</div>
		
		
		
		
	</div>	
@endsection