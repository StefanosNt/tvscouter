@extends('layouts.app')

<style>
	
	.title{
		margin :40px 0 40px 0; 
	}
	
</style>



@section('content')
	
	
	
	<div class="container"> 
	<div class="title"><h1> Hello {{ Auth::user()->name }}	</h1></div>
  	
	  <div class="row">
	  
		<form class="col s12" method='post' aria-controls="" autocomplete="off">
		<!--	for disabling autocomplete	  -->
		  <div class="row" style="display:none">
			<div class="input-field col s12">
			  <input id="password" type="password" class="validate">
			  <label for="password">Password</label>
			</div>
		  </div> 
		  
		  <div class="row">
			<div class="input-field col s12">
			  <input id="username" type="text" class="validate" value="{{ Auth::user()->name }}">
			  <label for="first_name">Username</label>
			</div> 
		  </div> 
		  
		  <div class="row">
			<div class="input-field col s12">
			  <input id="email" type="email" class="validate" value="{{ Auth::user()->email }}">
			  <label for="email">Email</label>
			</div>
		  </div> 
		  
		  <div class="row">
			<div class="input-field col s12">
			  <input id="password" type="password" class="validate" value="{{ Auth::user()->password }}">
			  <label for="password">Password</label>
			</div>
		  </div>
		</form>
	  </div>
		
		
	</div>
 
@endsection