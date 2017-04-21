@extends('layouts.app')


@section('content')

	<div class="container-fluid">
		<div class="row">
			@foreach($popular  as $k => $v)

			<div class="col s6 m4 l3 xl2 pbot">
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