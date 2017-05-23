<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta name="csrf-token" content="{{ Session::token() }}">
	<title>Sami</title>

	<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
	<link href="{{ URL::asset('css/materialize.css') }}" rel="stylesheet">
	<link href="{{ URL::asset('font-awesome-4.7.0/css/font-awesome.min.css') }}" rel="stylesheet">
	<link href="{{ URL::asset('css/app.css') }}" rel="stylesheet" type="text/css">
	<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
	<script src="{{ URL::asset('js/materialize.min.js') }}"></script> 

   	<script>
		$(document).ready(function(){
			var i=0;
			
			$('.modal').modal();
			$(".button-collapse").sideNav(); 
			$('.carousel').carousel();

			
			$('#expand-toggle').click(function(){
				if(i%2==0){ 
					$('#expand-toggle').removeClass('expanded').addClass('compressed')
					$('#sidebar').addClass('w50');
					$('main').addClass('pl50'); 
					$('#user-name').hide();
					$('#user-img').hide();
					$('.sidebar-text').hide();
					i++;
				}else{ 
					$('#expand-toggle').removeClass('compressed').addClass('expanded')
					$('#sidebar').removeClass('w50');
					$('main').removeClass('pl50'); 
					$('#user-name').show();
					$('#user-img').show();
					$('.sidebar-text').show();
					i++;
				}
			});  
			
			$('#search-button').click(function(){
				$('#search-box').slideDown('fast');
				$('#search-box input').fadeIn().addClass('input-show').focus(); 
				$('#search-results').empty();
			});
			$('#search-box input').on("focusout",function(){
				$('#search-box input').val('').fadeOut().removeClass('input-show');
				$('#search-results').removeClass('search-results-style');
				$('#search-box').fadeOut();
			}); 
//			$(document.body).click(function(evt){
//  				var id = evt.target.id;	
//				console.log(id);
//			});
//			$("#search-box").on('click'  , function (event) { 
//			
//			});
			
			

			
		});
        window.Laravel = {!! json_encode([
            'csrfToken' => csrf_token(),
        ]) !!};
		
    </script>

	@yield('js')
	
<style>
	#search-box{  
		width:80%;
		margin:0 auto;
	} 
	#search-results{ 
		display: none;
		width:100%;
		margin-right: 10px;
		overflow: auto;
		min-height: 50px;
		max-height: 400px;  
	}  
	.search-results-style{ 
		background: white;
    	box-shadow: 0px 4px 11px 1px rgba(123, 109, 114, 0.47);
	}
	.search-content{
		padding:5px 20px;
		background: white; 
		margin:0!important;
		 
	} 
	.loading {
		padding:10px;
		margin-right: 10px;
		display:none;
		width:100%; 
		background: white; 
		transition: box-shadow .25s;
   		border-radius: 2px;
		box-shadow: 0 2px 2px 0 rgba(0,0,0,0.14), 0 1px 5px 0 rgba(0,0,0,0.12), 0 3px 1px -2px rgba(0,0,0,0.2);
	}
	.ss{  
		margin-top:50px;
		margin-left:140px; 
	}
	.status{
		font-weight: 300;
		font-size: 0.8rem!important;
		color: #fff!important; 
		border-radius: 2px;
	}
	 
	#search-wrapper{
		width: 100%;
		top: 0;
		height:10px;
	} 
	#search-box input{  
		width: 0;
	}  
	.input-show { 
		height: 34px!important;
		width: 100%!important;
		padding-left: 20px!important;
		background: white!important;
		border-radius: 40px!important;
		margin: 3px 0px 7px 0!important;
		border: solid 1px darkolivegreen;
	}
	.input-show {
		border: solid 1px darkolivegreen!important;
		box-shadow: 0 0 0 darkolivegreen!important;
	} 
</style>
</head>

<body>
	<div id="sidebar-toggle" class="fixed-action-btn hide-on-med-and-up l23">
		<a data-activates="sidebar" class="button-collapse btn-floating red">
			<i class="material-icons">menu</i>
		</a> 
	</div>  
	<div id="search-wrapper" class="fixed-action-btn">
		<a id="search-button" class="btn-floating green right">
			<i class="material-icons" >search</i>
		</a> 
		<div id="search-box">  
			<input class="search-input right" type="text" name="search" placeholder="Search for a show.." autocomplete="off">
			<div class="loading center-align right">
			   <div class="preloader-wrapper big active">
				<div class="spinner-layer spinner-blue-only">
				  <div class="circle-clipper left">
					<div class="circle"></div>
				  </div> 
				</div>
			  </div>  
			</div>   
			<div id="search-results" class='right'></div> 
		</div>
		
	</div>  
	<ul id="sidebar" class="side-nav fixed red"> 
		<li id="expand-toggle" class="expanded waves-effect waves-red hide-on-small-only"><a><i class="fa fa-expand" aria-hidden="true"></i></a></li>

        <li id="user-name"> <a href="/settings" class="white-text center"> {{ Auth::user()->name }}</a> </li>
		<li id="user-img"> <img class="circle" src="http://www.imran.com/xyper_images/icon-user-default.png" width="100px"> </li>
		
		<li><a class="waves-effect waves-red" href="/"><i class="material-icons">home</i><span class="sidebar-text">HOME</span></a></li>
		<li><a class="waves-effect waves-red" href="/tv/watchlist"><i class="material-icons">check</i><span class="sidebar-text">WATCHLIST</span></a></li>
		<li><a class="waves-effect waves-red" href="/tv/schedule"><i class="material-icons">schedule</i><span class="sidebar-text">SCHEDULE</span></a></li>
		<li><a class="waves-effect waves-red" href="/tv/category=popular&page=1"><i class="material-icons">trending_up</i><span class="sidebar-text">POPULAR</span></a></li>
		<li><a class="waves-effect waves-red" href="/tv/category=top_rated&page=1"><i class="material-icons">favorite</i><span class="sidebar-text">TOP RATED</span></a></li>
		<li><a class="waves-effect waves-red" href="/settings"><i class="material-icons">settings</i><span class="sidebar-text">SETTINGS</span></a></li>
		<li>
			<a class="waves-effect waves-red" href="{{ route('logout') }}" onclick="event.preventDefault();document.getElementById('logout-form').submit();">
				<i class="material-icons">exit_to_app</i><span class="sidebar-text">LOG OUT</span> 
			</a> 
			<form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">{{ csrf_field() }}</form>
		</li>
	</ul>
	<main class="main">
		<div class="content">
			@yield('content') 
		</div>

	</main>

</body>

<script>
	$(document).ready(function(){
		
		$(".search-input").keyup(function(e) {
			$('#search-results').removeClass('search-results-style');

			var inputVal = $('.search-input').val();
			
			$('#search-results').html('');
			$(".loading").show();
//			$('#search-results').html('');
			clearTimeout($.data(this, 'timer'));
			console.log(inputVal);
			if ($('.search-input').val()==""){
				$('#search-results').html('');
				$(".loading").hide();
			}
			if (e.keyCode == 13){
				getData();
			}
			else if(e.keyCode == 8){
				if(inputVal ==""){
					$(".loading").hide();
				}
				else{
					$(".loading").show();
				}
				$('#search-results').html('');
				$(this).data('timer', setTimeout(getData, 500)); 
			}
			else{
				$(this).data('timer', setTimeout(getData, 500)); 
			}
			 
		}); 
		function getData(){
			$('#search-results').html('');
			$('#search-results').slideDown("fast");
			$.ajax({
				async:false,
				method:'GET',
				url:'/tv/search/'+$('.search-input').val().toString(), 
				success:function(res){
					console.log(res);
					if(res.results.length===0){
						console.log("No record found");
						$(".loading").hide();
						$('#search-results').addClass('search-results-style').append('<p style="text-align:center"> No record found</p>');
					}
					$.each(res.results, function(i,ser){ 
						$(".loading").hide();
						var name = ser.name;
						var id = ser.id;
						var airdate = ser.first_air_date;
						var poster = 'https://image.tmdb.org/t/p/w185'+ser.poster_path;
						if(ser.poster_path===null)	poster="http://placehold.it/185x278?text=NO+POSTER"
						$('#search-results').addClass('search-results-style');
						$('#search-results').append(
							'<div class="card horizontal search-content">'+
								'<div class="card-image">'+
									'<img src="'+poster+'">'+
//									'<img style="width:92.5;height:139"src="'+poster+'">'+
								'</div>'+
								'<div class="card-stacked">'+
									'<div class="card-content">'+
										'<a href="/tv/'+id+'">'+
										'<p>'+name+'</p>'+
										'<p style="color:#8b8b8b">'+airdate+'</p>'+
										'</a>'+ 
//										'<span class="status badge green">WATCHING</span>'+
									'</div>'+
								'</div>'+
							'</div>'
						);
						
						
					});
				}
			})
		}
	});
</script>


