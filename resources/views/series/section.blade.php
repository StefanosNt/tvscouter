@extends('layouts.app') 

@php $segments = explode('=', url()->current()); $page = $segments[ count($segments) - 1 ]; @endphp

@section('js')
<script> var page = {{$page}} </script>
<script src="{{ URL::asset('js/pagination.js') }}"></script> 
@endsection('js')

@section('content') 

	@if($category=='popular') 
		@include('components.header',[ 'header' => 'POPULAR' ] )
	@elseif($category=='top_rated')	
		@include('components.header',[ 'header' => 'TOP RATED' ] )
	@endif 

	<div class="container-fluid">
		<div class="row">
			@foreach($section as $k => $v)
			<div class="col s6 m4 l3 xl2 tv-section">
				<div class="card hoverable">
					<div class="card-image common-aspect-ratio">
						@if($v['poster_path']===null)
						<a href="/tv/{{$v['id']}}"><img class="pop-img" src="http://placehold.it/342x513?text=NO+POSTER"></a>
						@else
						<a href="/tv/{{$v['id']}}"><img class="pop-img" src="{{'https://image.tmdb.org/t/p/w342'.$v['poster_path']}}"></a>
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
				<li class="waves-effect"><a href="/tv/category={{$category}}&page={{$page-1}}"><i class="material-icons">chevron_left</i></a></li>
				<li class="waves-effect"><a href="/tv/category={{$category}}&page=1">1</a></li>
				<li class="waves-effect"><a href="/tv/category={{$category}}&page=2">2</a></li>
				<li class="waves-effect"><a href="/tv/category={{$category}}&page=3">3</a></li>
				<li class="waves-effect"><a href="/tv/category={{$category}}&page=4">4</a></li>
				<li class="waves-effect"><a href="/tv/category={{$category}}&page=5">5</a></li>
				<li class="waves-effect"><a href="/tv/category={{$category}}&page=6">6</a></li>
				<li class="waves-effect"><a href="/tv/category={{$category}}&page=7">7</a></li>
				<li class="waves-effect"><a href="/tv/category={{$category}}&page=8">8</a></li>
				<li class="waves-effect"><a href="/tv/category={{$category}}&page=9">9</a></li>
				<li class="waves-effect"><a href="/tv/category={{$category}}&page=10">10</a></li>
				<li class="waves-effect"><a href="/tv/category={{$category}}&page={{$page+1}}"><i class="material-icons">chevron_right</i></a></li>
			</ul>
		</div>
	</div>
@endsection

