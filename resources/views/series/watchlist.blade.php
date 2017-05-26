@extends('layouts.app') 
@section('content')
	<div class="container-fluid">

		@include('components.header',[ 'header' => 'WATCHLIST' ] )

		<div class="row">
			@foreach($watchlist as $k => $v)
			<div class="col s6 m4 l3 xl2 pbot">
				<div class="card hoverable">
					<div class="card-image common-aspect-ratio">
						@if($v['series_poster']===null)
						<a href="/tv/{{$v['id']}}"><img class="pop-img" src="http://placehold.it/342x513?text=NO+POSTER"></a>
						@else
						<a href="/tv/{{$v['series_id']}}"><img class="pop-img" src="{{'https://image.tmdb.org/t/p/w500'.$v['series_poster']}}"></a>
						@endif
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
