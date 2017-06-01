@extends('layouts.app')   
@section('content') 

<div  id="index-banner" class="parallax-container">
	<div  id="home"  class="section scrollspy">
		<div class="container"> 
			<h1 class="header center white-text text-lighten-2">TVScouter</h1>
			<div class="row center">
				<h5 class="header col s12 light"> The place to track all your series instantly and effectively. Just some clicks away!</h5>
			</div> 
		</div>
	</div>
	<div id="first-background" class="parallax"><img src="{{ URL::asset('photos/asset2.jpg') }}" alt="Unsplashed background img 1"></div>
</div>


<div id="features" class="container section scrollspy"> 
	<div class="row">
		<div class="col s12 m4">
			<div class="icon-block">
				<h2 class="center red-text"><i class="material-icons">flash_on</i></h2>
				<h5 class="center">TV Schedule</h5>
				<p class="light">By adding TV shows into your watchlist TVScouter automatically makes up your TV schedule so that you can always know when any episode of your watchlist is airing.</p>
			</div>
		</div> 
		<div class="col s12 m4">
			<div class="icon-block">
				<h2 class="center red-text"><i class="material-icons">group</i></h2>
				<h5 class="center">Series info</h5> 
				<p class="light">Get all the needed information about a TV show. From series genre to episodes description, you can get it all.</p>
			</div>
		</div> 
		<div class="col s12 m4">
			<div class="icon-block">
				<h2 class ="center red-text"><i class="material-icons">settings</i></h2>
				<h5 class="center">Suggestions</h5> 
				<p class="light">Tired of searching for a new show to watch? We've got you handled. With the popular section you can always have something to watch.</p>
			</div>
		</div>
	</div>  
</div> 


<div class="parallax-container"> 
	<div class="parallax"><img id="networks" src="{{ URL::asset('photos/asset1.jpg') }}" alt="Unsplashed background img 2"></div>
</div>


<div id="contact" class="container-fluid section scrollspy"> 
	<div class="row">
		<div class="col s12 center">
			<h4>Contact </h4>
			<p class="left-align light center"> The development of this website is in alpha stage. For any further information or request feel free ask at <b><span id="contact-email"></span></b></p>
		</div>
	</div> 
</div>

<footer class="page-footer pt0">  
	<div class="footer-copyright grey lighten-4">
		<div class="container">
			<p><a href="https://www.themoviedb.org/" target="_blank"><img class="right pl15" src="{{URL::asset('photos/powered-by-rectangle-green.svg')}}" height="40px" width="auto"alt=""></a></p>
			<p class="black-text">This product uses the TMDb API but is not endorsed or certified by TMDb.</p>
		</div>
	</div>
</footer>
@endsection