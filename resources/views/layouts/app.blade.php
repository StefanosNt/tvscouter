<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta name="csrf-token" content="{{ Session::token() }}">
	<title>{{config('app.name')}}</title>

	<link href="{{ URL::asset('materialize/css/materialize.min.css') }}" rel="stylesheet">
	<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
	<link href="{{ URL::asset('font-awesome-4.7.0/css/font-awesome.min.css') }}" rel="stylesheet">
	@yield('css') 
	@if(Auth::check()) 
		<link href="{{ URL::asset('css/app.css') }}" rel="stylesheet" type="text/css"> 
	@else 
		<link href="{{ URL::asset('css/landing.css') }}" rel="stylesheet" type="text/css">
	@endif

	<script src="{{ URL::asset('js/jquery-3.2.1.min.js') }}"></script> 
	<script src="{{ URL::asset('js/jquery.mousewheel.min.js') }}"></script> 
	<script src="{{ URL::asset('materialize/js/materialize.min.js') }}"></script>
	<script src="{{ URL::asset('js/app.js') }}"></script>
	@yield('js')
 
</head>

<body>

	@if(Auth::check())
	
	<!--	Show the user panel 	-->
	
	<div id="sidebar-toggle" class="fixed-action-btn hide-on-med-and-up l23">
		<a data-activates="sidebar" class="button-collapse btn-floating red">
			<i class="material-icons">menu</i>
		</a>
	</div>
	
	<div id="search-wrapper" class="fixed-action-btn">
		<a id="search-button" class="btn-floating green right">
			<i class="material-icons">search</i>
		</a>
		<div id="search-box">
			<form action="">
				<input class="search-input right" type="text" name="search" placeholder="Search for a show.." autocomplete="off">
			</form>		
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
	
	<ul id="sidebar" class="side-nav fixed red z-depth-1">
		<li id="expand-toggle" class="expanded hide-on-small-only"><a><i class="fa fa-expand white-text" aria-hidden="true"></i></a></li>
		<li id="user-name"> <a href="/settings" class="white-text center"> {{ Auth::user()->name }}</a> </li>
		<li id="user-img"> <img class="circle" src="{{URL::asset('storage')}}/{{Auth::user()->avatar}}" width="100px"> </li>
		<li><a class="waves-effect white-text sidebar-option" href="/"><i class="material-icons white-text">home</i>HOME</a></li>
		<li><a class="waves-effect white-text sidebar-option" href="/watchlist"><i class="material-icons white-text">check</i>WATCHLIST</a></li>
		<li><a class="waves-effect white-text sidebar-option" href="/schedule"><i class="material-icons white-text">schedule</i>SCHEDULE</a></li>
		<li><a class="waves-effect white-text sidebar-option" href="/tv/category=popular&page=1"><i class="material-icons white-text">trending_up</i>POPULAR</a></li>
		<li><a class="waves-effect white-text sidebar-option" href="/tv/category=top_rated&page=1"><i class="material-icons white-text">favorite</i>TOP RATED</a></li>
		<li><a class="waves-effect white-text sidebar-option" href="/settings"><i class="material-icons white-text">settings</i>SETTINGS</a></li>
		<li>
			<a class="waves-effect waves-red white-text" href="{{ route('logout') }}" onclick="event.preventDefault();document.getElementById('logout-form').submit();">
				<i class="material-icons white-text">exit_to_app</i><span class="white-text">LOG OUT</span>
			</a>
			<form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">{{ csrf_field() }}</form>
		</li>
	</ul>
	 
	@else
	
		<!--		Show the top bar in landing page 		-->
		
		<div class="navbar-fixed">
			<nav id="navbar" class="top-nav">
				<a href="#" data-activates="slide-out" class="button-collapse"><i class="material-icons">menu</i></a>
				<div class="nav-wrapper">
					<a href="/" id="logo" class="brand-logo">TVS</a>
					<ul id="options" class="hide-on-med-and-down" style="margin-left:41%">
						<li><a href="#home">HOME</a></li>
						<li><a href="#features">FEATURES</a></li>
						<li><a href="#contact">CONTACT</a></li>
					</ul>
					<ul class="right hide-on-med-and-down">
						<li><a class="modal-trigger" href="#login">LOG IN</a></li>
						<li><a class="modal-trigger" href="#signup">SIGN UP</a></li>
					</ul>
				</div>
			</nav>
		</div>
		
		<ul id="slide-out" class="side-nav">
			<li><a href="#home">HOME</a></li>
			<li><a href="#features">FEATURES</a></li>
			<li><a href="#contact">CONTACT</a></li>
			<li><a class="modal-trigger" href="#login">LOG IN</a></li>
			<li><a class="modal-trigger" href="#signup">SIGN UP</a></li>
		</ul>
 
		@include('auth/login') 
		@include('auth/register')

	@endif
	
	<main class="main">
		<div class="content">
			@yield('content')
		</div>
	</main>
	
	
</body>
 