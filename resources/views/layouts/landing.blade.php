<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta name="csrf-token" content="{{ Session::token() }}">
	<title>TVScout</title>

	<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
	<link href="{{ URL::asset('css/materialize.css') }}" rel="stylesheet">
	<link href="{{ URL::asset('css/app.css') }}" rel="stylesheet" type="text/css">
	<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
	<script src="{{ URL::asset('js/materialize.min.js') }}"></script>

   	<script>
		$(document).ready(function(){  
			$('.modal').modal();   
			$('.parallax').parallax();
			$('.scrollspy').scrollSpy({
				scrollOffset : 60
			});
		});
        window.Laravel = {!! json_encode([
            'csrfToken' => csrf_token(),
        ]) !!};
		
    </script>

	@yield('js')

</head>

<body>  
	<div class="navbar-fixed">
		<nav id="navbar" class="top-nav">
			<a href="#" data-activates="sidebar" class="button-collapse hide-on-med-and-up"><i class="material-icons">menu</i></a>
			<div class="nav-wrapper">
				<a href="/" id="logo" class="brand-logo">TVS</a>
				<ul class="center" style="margin-left:30%">
					<li><a href="#home">HOME</a></li>
					<li><a href="#features">FEATURES</a></li>
					<li><a href="#contact">CONTACT</a></li>
				</ul>
				<ul id="right-bar" class="right"> 
					<li><a class="modal-trigger" href="#login">Log In</a></li>
					<li><a class="modal-trigger" href="#signup">Sign Up</a></li>  
				</ul>
			</div>
		</nav>
	</div>

	<main class="main"> 
		<div class="content">
			@yield('content') 
		</div>  
	</main>

	@extends('auth/login')
	@extends('auth/register')

</body>
