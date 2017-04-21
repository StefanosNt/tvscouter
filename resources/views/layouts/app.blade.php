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
	<link href="{{ URL::asset('css/app.css') }}" rel="stylesheet" type="text/css">
	<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
	<script src="{{ URL::asset('js/materialize.min.js') }}"></script>

   	<script>
		$(document).ready(function(){
			$('.modal').modal();
			$(".button-collapse").sideNav();
		});
        window.Laravel = {!! json_encode([
            'csrfToken' => csrf_token(),
        ]) !!};
    </script>

	@yield('js')

</head>

<body>

	<nav id="navbar" class="top-nav">
		<a href="#" data-activates="sidebar" class="button-collapse hide-on-med-and-up"><i class="material-icons">menu</i></a>
		<div class="nav-wrapper">
			<a href="/" id="logo" class="brand-logo">SAMI</a>
			<ul id="right-bar" class="right">
				@if (Auth::guest())
					<li><a class="modal-trigger" href="#login">Log In</a></li>
					<li><a class="modal-trigger" href="#signup">Sign Up</a></li>
				@else
					<li class="dropdown">
						<a class='dropdown-button' href='#' data-activates='account'>
							{{ Auth::user()->name }} <span class="caret"></span>
						</a>

						<ul id='account' class="dropdown-content">
							<li><a href="#"> Account Settings </a></li>
							<li>
								<a href="{{ route('logout') }}"
									onclick="event.preventDefault();
											 document.getElementById('logout-form').submit();">
									Logout
								</a>

								<form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
									{{ csrf_field() }}
								</form>
							</li>

						</ul>
					</li>
				@endif

			</ul>
		</div>
	</nav>

	<ul id="sidebar" class="side-nav fixed">
		<li><a class="waves-effect waves-red" href="/"><i class="material-icons">home</i><span class="sidebar-text">HOME</span></a></li>
		<li><a class="waves-effect waves-red" href="/tv/popular"><i class="material-icons">trending_up</i><span class="sidebar-text">POPULAR</span></a></li>
		<li><a class="waves-effect waves-red" href="/watchlist"><i class="material-icons">check</i><span class="sidebar-text">WATCHLIST</span></a></li>
		<li><a class="waves-effect waves-red" href="/towatch"><i class="material-icons">schedule</i><span class="sidebar-text">TO WATCH</span></a></li>
		<li><a class="waves-effect waves-red" href="/favorites"><i class="material-icons">favorite</i><span class="sidebar-text">FAVORITES</span></a></li>
	</ul>
	<main>

		@yield('content')

	</main>

	@extends('auth/login')
	@extends('auth/register')

</body>
