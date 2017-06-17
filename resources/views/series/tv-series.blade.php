@extends('layouts.app')

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
	<div class="series-poster-wrapper z-depth-1" style="background: url('https://image.tmdb.org/t/p/w1280/{{$series['backdrop_path']}}') center; ">
		<div class="series-poster-block">
			<div><img class="series-poster-img z-depth-2" src="https://image.tmdb.org/t/p/w500/{{$series['poster_path']}}"></div>
			<a class="watchlist-btn btn">Add to watchlist</a>
			<a class="btn red w100p bs0" href="#trailer-modal"> Trailer</a>
		</div> 
	</div>
	<p class="invisible">{{$n=$series['vote_average']}}</p>
	@php $int = $n%10; $dec = ($n*100)%100; if($dec>50) $int++; $int = $int*10; $trailer = 0;@endphp

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
	<h4 class="ptblr1020 fw300">Cast</h4>
	<div class="row extras-wrapper">
		@foreach($series['credits']['cast'] as $k => $v)
			<div class="col s4 m3 l2 xl1 extras">   
				<div class="card">
					<div class="card-image extras-aspect-ratio">
						@if($v['profile_path']===null)
							<a id="{{$v['id']}}" href="#person-modal" class="people"><img id="{{$v['id']}}" src="http://placehold.it/342x513?text=NO+POSTER"></a>
						@else
							<a id="{{$v['id']}}" href="#person-modal" class="people"><img id="{{$v['id']}}" src="https://image.tmdb.org/t/p/w185/{{$v['profile_path']}}"></a>
						@endif
					</div>
					<div class="card-content extras-body">
						<span class="center"> {{$v['name']}} </span>
					</div>
				</div>  
			</div>
		@endforeach
	</div>
	<h4 class="ptblr1020 fw300">Recommended Series</h4>
	<div class="row extras-wrapper">
		@foreach($series['recommendations']['results'] as $k => $v)
			<div class="col s4 m3 l2 xl1 extras">   
				<div class="card">
					<div class="card-image extras-aspect-ratio">
						@if($v['poster_path']===null)
							<a href="/tv/{{$v['id']}}"><img src="http://placehold.it/342x513?text=NO+POSTER"></a>
						@else
							<a href="/tv/{{$v['id']}}"><img src="https://image.tmdb.org/t/p/w185/{{$v['poster_path']}}"></a>
						@endif
					</div>
					<div class="card-content extras-body">
						<span class="center"> {{$v['name']}} </span>
					</div>
				</div>  
			</div>
		@endforeach
	</div>
	<h4 class="ptblr1020 fw300">Episode List</h4> 
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
	
	<div id="trailer-modal" class="modal">
		<div class="modal-content p0"> 
			@foreach($series['videos']['results'] as $k => $v)
				@if($v['type']=='Trailer')
					<div class="video-container">
						<iframe width="853" height="480" src="https://www.youtube.com/embed/{{$v['key']}}" frameborder="0" allowfullscreen></iframe>
					</div>
					@php $trailer=1; @endphp
					@break
				@endif 
			@endforeach
			@if($trailer==0)
				<h5 class="center">No Trailer Available</h5>
			@endif
		</div>
	</div>
	
	<div id="person-modal" class="modal">
		<div class="modal-content"> 
			<div class="container" id="person-info"> 
				<div class="row valign-wrapper">
					<div class="col s12 m6">
						<img id="person-img" class="responsive-img" src="" alt="">
					</div>
					<div class="col s12 m6" style="text-align:center">
						<p>Name: <span id="name"></span></p>
						<p>Birthday: <span id="birthday"></span></p>
						<p>Birthplace: <span id="birthday"></span></p> 
						<p><a id="imdb-link" href="" target="_blank">IMDB Link</a></p>
					</div>
				</div>
				<div class="row">
					<div class="col s12">
						<p>Biography</p>
						<p id="bio" class="light"></p> 
					</div> 
				</div> 
				
			</div>

			 
			<div id="loader">
				<div class="preloader-wrapper active">
					<div class="spinner-layer spinner-red-only">
						<div class="circle-clipper left">
							<div class="circle"></div>
						</div>
						<div class="gap-patch">
							<div class="circle"></div>
						</div>
						<div class="circle-clipper right">
							<div class="circle"></div>
						</div>
					</div>
				</div>
			</div>  
		</div>
	</div>
	
	@endsection 