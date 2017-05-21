@extends('layouts.app')
<style>
 

	
	
/*
	input[type="checkbox"] + label:after{ 
		border-radius:100%!important;  
		
}
*/
	/* When the input field gets focus, change its width to 100% */
/*
	input[type=text]:focus {
		width: 100%!important;
	}
*/
</style>

@section('content')
<!--

<div class="ss">
  <input type="checkbox" class="filled-in ss" id="filled-in-box" checked="checked" /><label for="filled-in-box">Filled in</label>
</div>
  
-->
  
 
<!--
<div class="search-box">
	<input class="search-input" type="text" name="search" placeholder="Search for a show.." autocomplete="off">
	<div class="loading center-align ">
	   <div class="preloader-wrapper big active">
		<div class="spinner-layer spinner-blue-only">
		  <div class="circle-clipper left">
			<div class="circle"></div>
		  </div> 
		</div>
	  </div> 
	  <p>loading....</p>  
	</div>   
	<div class='search-results'></div>
</div>
-->

<div class="container">
	<div class="row"> 
		<div class="col s12 section center">
			<h1>{{$totalHours}}</h1>
			<p>Hours spent watching series </p>
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
</div>



@endsection

@section('js')
<script>
//	$(document).ready(function(){
//		
//		$(".search-input").keyup(function(e) {
//			var inputVal = $('.search-input').val();
//			
//			$('.search-results').html('');
//			$(".loading").attr( "style", "display: block !important;" );
////			$('.search-results').html('');
//			clearTimeout($.data(this, 'timer'));
//			console.log(inputVal);
//			if ($('.search-input').val()==""){
//				$('.search-results').html('');
//				$(".loading").attr( "style", "display: none !important;" );
//			}
//			if (e.keyCode == 13){
//				getData();
//			}
//			else if(e.keyCode == 8){
//				if(inputVal ==""){
//					$(".loading").attr( "style", "display: none !important;" );
//				}
//				else{
//					$(".loading").attr( "style", "display: block !important;" );
//				}
//				$('.search-results').html('');
//				$(this).data('timer', setTimeout(getData, 500)); 
//			}
//			else{
//				$(this).data('timer', setTimeout(getData, 500)); 
//			}
//			 
//		}); 
//		function getData(){
//			$('.search-results').html('');
//			$('.search-results').slideDown("fast");
//			$.ajax({
//				async:false,
//				method:'GET',
//				url:'/tv/search/'+$('.search-input').val().toString(), 
//				success:function(res){
//					console.log(res);
//					if(res.results.length===0){
//						console.log("No record found");
//						$(".loading").attr( "style", "display: none !important;" );
//						$('.search-results').append('<p> No record found</p>')
//					}
//					$.each(res.results, function(i,ser){ 
//						$(".loading").attr( "style", "display: none !important;" );
//						var name = ser.name;
//						var id = ser.id;
//						var airdate = ser.first_air_date;
//						var poster = 'https://image.tmdb.org/t/p/w185'+ser.poster_path;
//						if(ser.poster_path===null)	poster="http://placehold.it/185x278?text=NO+POSTER"
//						$('.search-results').append(
//							'<div class="card horizontal search-content">'+
//								'<div class="card-image">'+
//									'<img style="width:92.5;height:139"src="'+poster+'">'+
//								'</div>'+
//								'<div class="card-stacked">'+
//									'<div class="card-content">'+
//										'<a href="/tv/'+id+'">'+name+'</a>'+ 
//										'<p style="color:#8b8b8b">'+airdate+'</p>'+
////										'<span class="status badge green">WATCHING</span>'+
//									'</div>'+
//								'</div>'+
//							'</div>'
//						);
//						
//						
//					});
//				}
//			})
//		}
		
//		function getData(){
//			$('.search-results').html('')
//			$.ajax({
//				async:false,
//				method:'GET',
//				url:'/tv/search/'+$('.search-input').val().toString(),
//				success:function(res){
//					console.log(res);
//					$.each(res.results, function(i,ser){
//						var name = ser.name;
//						var id = ser.id;
//						var airdate = ser.first_air_date;
//						var poster = 'https://image.tmdb.org/t/p/w45_and_h67_bestv2'+ser.poster_path;
//						
//						$('.search-results').append(
//							'<div class="search-content">'+
//							'<img style="float:left;padding-right:10px" src="'+poster+'">'+
//							'<a href="/tv/'+id+'">'+name+'</a>'+
//							'<p style="color:#8b8b8b">'+airdate+'</p>'+
//							'</div>'
//						);
//						
//						
//					});
//				}
//			})
//		}
//	});
</script>
@endsection