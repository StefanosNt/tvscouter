@extends('layouts.app')


@section('css') <link href="{{ URL::asset('css/tv-series.css') }}" rel="stylesheet"> @endsection
@section('js') 
	<script> 
		var uid = {{Auth::user()->id}};
		var sid = {{$series['id']}};
		var sname = "{{$series['name']}}";
		var sposter = "{{$series['poster_path']}}";
		var totalSeriesMinutes = {{$series['total_series_minutes']}};
	</script>
	<script src="{{URL::asset('js/tv-series.js')}}" async></script>
@endsection

@section('content')
<div class="container-fluid">
	<div class="series-poster-wrapper z-depth-1" style="background: url('https://image.tmdb.org/t/p/w1280/{{$series['backdrop_path']}}');">
		<div class="series-poster-block">
			<div><img class="series-poster-img z-depth-2" src="https://image.tmdb.org/t/p/w500/{{$series['poster_path']}}"></div>
			<button class="watchlist-btn btn">Add to watchlist</button>
		</div> 
	</div>
	<p class="invisible">{{$n=$series['vote_average']}}</p>
	@php $int = $n%10; $dec = ($n*100)%100; if($dec>50) $int++; $int = $int*10; @endphp

	<div class="title-block">
		<span class="title"><h2>{{$series['name']}}</h2></span>
		<span class="stars-container stars-{{$int}}">★★★★★</span>
		<span class="rating">{{$series['vote_average']}}</span>
	</div>
	<div class="badges">
		<span class="status badge green">{{$series['networks'][0]['name']}}</span>
		<span class="status badge light-blue darken-2">{{ date('Y',strtotime($series['first_air_date']))}}</span>
		<span class="status badge red">{{$series['episode_run_time'][0]}}m</span>
		<span class="status badge lime">{{$series['status']}}</span>
	</div>

	<p class="title-block">{{$series['overview']}}</p>
	<div class="row" class="series-details">
		<div class="col s12 m2">
			<ul class="collection seasons">
				@foreach($series['seasons'] as $k => $v) @if($v['season_number']==0) @continue @endif
				<li><a id="{{$v['season_number']}}" class="collection-item @if($v['season_number']==$seasonNumber) active @endif">Season {{$v['season_number']}}</a></li>
				@endforeach
			</ul>
		</div>

		<div class="col s12 m10">

			<ul id="episode-list" class="collection with-header collapsible" data-collapsible="accordion">
				<li>
					<div class="row collection-header episode-list-header">
						<div class="col s3">
							<h5>Episode</h5>
						</div>
						<div class="col s5">
							<h5>Titlte</h5>
						</div>
						<div class="col s4">
							<h5>Air Date</h5>
						</div>
					</div>
				</li>
				@foreach($season['episodes'] as $k => $v)
				<li class="episode">
					<div class="collapsible-header row episode-header">
						<div class="col s3">{{$v['episode_number']}}</div>
						<div class="col s5">{{$v['name']}}</div>
						<div class="col s4">{{$v['air_date']}}</div>
					</div>
					<div class="collapsible-body episode-body"><span>{{$v['overview']}}</span></div>
				</li>
				@endforeach
			</ul>
		</div>
	</div>
	@endsection 