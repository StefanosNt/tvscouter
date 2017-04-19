@extends('layouts.app')
<style>
	.search-box{  
		width:80%;
		margin:0 auto;
	}
/*
	.search-results{ 
		background:aliceblue;
	}
*/
	.search-results{
				-webkit-transition: height 0.4s ease-in-out;
		transition: height 0.4s ease-in-out;
	}
	.search-input{
		margin:0px!important;
	}
	input[type=text] {
/*		width: 130px!important; */ 
/*		padding-left:20px!important;*/
	} 
	.search-content{
		padding:5px 20px;
		background:aliceblue;
/*		height:80px;*/
		margin:0!important;
		 
	} 
	.loading {
		padding:10px;
		display:none!important;
		width:100%;
		
		transition: box-shadow .25s;
   		 border-radius: 2px;
		box-shadow: 0 2px 2px 0 rgba(0,0,0,0.14), 0 1px 5px 0 rgba(0,0,0,0.12), 0 3px 1px -2px rgba(0,0,0,0.2);
	}
	.ss{  
		margin-top:50px;
		margin-left:140px; 
	}
	


	
	
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


	<div class='search-results'>
	
<!--
		<a href="http://placehold.it" style="float:left;padding-right:10px"><img src="http://placehold.it/250x150"></a>
		<p><h5>The flash</h5></p>
		<p>03/01/2015</p>
	</div>
-->
 
 
    
</div>

@endsection

@section('js')
<script>
	$(document).ready(function(){
		
		$(".search-input").keyup(function(e) {
			var inputVal = $('.search-input').val();
			
			$('.search-results').html('');
			$(".loading").attr( "style", "display: block !important;" );
//			$('.search-results').html('');
			clearTimeout($.data(this, 'timer'));
			console.log(inputVal);
			if ($('.search-input').val()==""){
				$('.search-results').html('');
				$(".loading").attr( "style", "display: none !important;" );
			}
			if (e.keyCode == 13){
				getData();
			}
			else if(e.keyCode == 8){
				if(inputVal ==""){
					$(".loading").attr( "style", "display: none !important;" );
				}
				else{
					$(".loading").attr( "style", "display: block !important;" );
				}
				$('.search-results').html('');
				$(this).data('timer', setTimeout(getData, 500)); 
			}
			else{
				$(this).data('timer', setTimeout(getData, 500)); 
			}
			 
		}); 
		function getData(){
			$('.search-results').html('');
			$('.search-results').slideDown("fast");
			$.ajax({
				async:false,
				method:'GET',
				url:'/tv/search/'+$('.search-input').val().toString(), 
				success:function(res){
					console.log(res);
					if(res.results.length===0){
						console.log("No record found");
						$(".loading").attr( "style", "display: none !important;" );
						$('.search-results').append('<p> No record found</p>')
					}
					$.each(res.results, function(i,ser){ 
						$(".loading").attr( "style", "display: none !important;" );
						var name = ser.name;
						var id = ser.id;
						var airdate = ser.first_air_date;
						var poster = 'https://image.tmdb.org/t/p/w185'+ser.poster_path;
						if(ser.poster_path===null)	poster="http://placehold.it/185x278?text=NO+POSTER"
						$('.search-results').append(
							'<div class="card horizontal search-content">'+
								'<div class="card-image">'+
									'<img style="width:92.5;height:139"src="'+poster+'">'+
								'</div>'+
								'<div class="card-stacked">'+
									'<div class="card-content">'+
										'<a href="/tv/'+id+'">'+name+'</a>'+
										'<p style="color:#8b8b8b">'+airdate+'</p>'+
									'</div>'+
								'</div>'+
							'</div>'
						);
						
						
					});
				}
			})
		}
		
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
	});
</script>
@endsection