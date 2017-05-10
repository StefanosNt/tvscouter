
@extends('layouts.app')

<style>
	.title h2{
		font-weight: 300;
		margin-bottom:0px; 
	}
	.badges{
		padding-left:10px;
	}
	.status{
		font-weight: 400;
		font-size: 0.8rem!important;
		color: #fff!important; 
		border-radius: 2px;
		float:none!important; 
		padding:6px!important;
	}
</style>

@section('content')
	<div class="container-fluid">
   	  <div class="series-poster-wrapper z-depth-1" style="background: url('https://image.tmdb.org/t/p/w1280/{{$series['backdrop_path']}}');">
<!--	  	<div class="banner series-banner z-depth-1" style="background: url('https://image.tmdb.org/t/p/w1280/{{$series['backdrop_path']}}');"></div>-->
		<div class="series-poster-block">
			<div><img class="series-poster-img z-depth-2" src="https://image.tmdb.org/t/p/w500/{{$series['poster_path']}}"></div>
			<button class="watchlist-btn btn">Add to watchlist</button> 
		</div>

      </div>
      <p class="invisible">{{$n=$series['vote_average']}}</p>
	@php


	$int = $n%10;
	$dec = ($n*100)%100;

	if($dec>50) $int++;

	 $int = $int*10;
	@endphp

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

      <p class="series-overview">{{$series['overview']}}</p>
      <div class="row" class="series-details">
        <div class="col s12 m2">
        	<ul class="collection seasons">
        		@foreach($series['seasons'] as $k => $v)
        	  		@if($v['season_number']==0) @continue @endif
						<li><a id="{{$v['season_number']}}" class="collection-item @if($v['season_number']==$seasonNumber) active @endif">Season {{$v['season_number']}}</a></li>
		  		@endforeach
		  	</ul>
        </div>

        <div class="col s12 m10">

			 <ul id="episode-list" class="collection with-header collapsible" data-collapsible="accordion">
				<li>
				  <div class="row collection-header episode-list-header">
					  <div class="col s3"><h5>Episode</h5></div>
					  <div class="col s5"><h5>Titlte</h5></div>
					  <div class="col s4"><h5>Air Date</h5></div>
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






<!--
			<table class="episodes">
			<thead>
			  <tr class="collection">
				  <th class="collection-item">Episode</th>
				  <th class="collection-item">Title</th>
				  <th class="collection-item">Air Date</th>
				  <th class="collection-item"></th>
			  </tr>
			</thead>

			<tbody>
				@foreach($season['episodes'] as $k => $v)
				  <tr class="collection">
					<td class="collection-item">{{$v['episode_number']}}</td>
					<td class="collection-item">{{$v['name']}}</td>
					<td class="collection-item">{{$v['air_date']}}</td>
					<td class="collection-item">
						<input type="checkbox" class="filled-in ss" id="s{{$v['season_number']}}e{{$v['episode_number']}}"/><label for="s{{$v['season_number']}}e{{$v['episode_number']}}"></label>
					</td>
				  </tr>
				@endforeach
			</tbody>
			</table>
-->
        </div>
      </div>
@endsection
@section('js')

	<script>
		$(document).ready(function(){
			var watching,seasons;
			var i=0;
			
			$.ajaxSetup({
				headers: {
						'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
				}
			});
			
			function watchState(){
				$.ajax({
					'_token': $('meta[name=csrf-token]').attr('content'),
					async:false,
					method:'POST',
					url:'/watchliststate',
					data:{"uid" : {{ Auth::user()->id }} , "sid" : {{$series['id']}} },
					success: function(data){
						watching = data;
					}
				});
			}
			
			function highlight(){
				if (watching == 1) $(".watchlist-btn").addClass("watchlist-btn-true").text("Watching");
				if (watching == 0) $(".watchlist-btn").removeClass("watchlist-btn-true").text("Add to watchlist");
			}	
			
			
			watchState();
 
			console.log(watching);
			
			highlight();
		
			$(".watchlist-btn").click(function(){
				
				$.ajax({
						'_token': $('meta[name=csrf-token]').attr('content'),
						async:false,
						method:'POST',
						url:'/tv/{{$series['id']}}',
						data:{"uid" : {{ Auth::user()->id }} , "sid" : {{$series['id']}} , "sname" : "{{$series['name']}}" , "sposter" : "{{$series['poster_path']}}"  },
						success: function(s){
							console.log(s);
						}
				});
				
				watchState();
				console.log(watching);
				highlight();
			}) 
			
			$.ajax({
				async:false,
				method:'GET',
				url:'/tv/{{$series['id']}}/all',
				success: function(s){
					 seasons = s;
				}
			});

			console.log(seasons);

			$(".seasons").click(function(e){
				$(".seasons .active").removeClass("active");
				$("#"+e.target.id).addClass("active");

				$("#episode-list .episode").remove()
				$.each(seasons['season/'+e.target.id]['episodes'],function(i,v){
					$("#episode-list").append(
						'<li class="episode">'+
						  '<div class="collapsible-header row episode-header">'+
							  '<div class="col s3">'+v.episode_number+'</div>'+
							  '<div class="col s5">'+v.name+'</div>'+
							  '<div class="col s4">'+v.air_date+'</div>'+
						  '</div>'+
						  '<div class="collapsible-body episode-body"><span>'+v.overview+'</span></div>'+
						'</li>'
//						'<tr class="collection">'+
//							'<td class="collection-item">'+v.episode_number+'</td>'+
//							'<td class="collection-item">'+v.name+'</td>'+
//							'<td class="collection-item">'+v.air_date+'</td>'+
////							'<td class="collection-item"><input type="checkbox" class="filled-in ss" id=s'+e.target.id+'e'+v.episode_number+'><label for=s'+e.target.id+'e'+v.episode_number+'></label></td>'+
//						'</tr>'
					);
				})

			})

		})
	</script>
@endsection
