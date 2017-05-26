@extends('layouts.app')
@section('js') <script src="{{URL::asset('js/schedule.js')}}"></script> @endsection
@section('content') 
	@include('components.header',[ 'header' => 'SCHEDULE' ] )

	<div class="container">

		<div id="monday" class="row day-of-week"></div>
		<div id="tuesday" class="row day-of-week"></div>
		<div id="wednesday" class="row day-of-week"></div>
		<div id="thursday" class="row day-of-week"></div>
		<div id="friday" class="row day-of-week"></div>
		<div id="saturday" class="row day-of-week"></div>
		<div id="sunday" class="row day-of-week"></div>
		<div id="later" class="row"></div>

		<div class="row">
			@foreach($schedule as $k => $v)
			<div id="{{$loop->index}}" class="col s12 episode">
				<div class="card horizontal">
					<div class="card-image">
						<img class="series-img" src="{{'https://image.tmdb.org/t/p/w500'.$v['series_poster']}}">
					</div>
					<div class="card-stacked">
						<div class="card-content">
							<span class="card-title"> <a href="/tv/{{$v['series_id']}}"> {{$v['series_name']}} </a> </span>
							<p class='air-date'>{{$v['air_date']}}</p>
							<p class='ep-details'>Season {{$v['season_number']}} Episode {{$v['episode_number']}} - {{$v['episode_name']}}</p>
						</div>
					</div>
				</div>
			</div>
			@endforeach
		</div>

	</div>
@endsection  
