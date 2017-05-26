@extends('layouts.app')

<style>
	.title {
		margin: 40px 0 40px 0;
	}
</style>



@section('content')



<div class="container">
	<div class="title">
		<h1> Hello {{ Auth::user()->name }} </h1>
	</div>
	
	@if(session('status'))
	<div class="card-panel green lighten-1 mb50"> 
		<span class="white-text">{{ session('status') }}</span>
	</div> 
	@endif
	
	<div class="row">

		<form class="col s12" method='post' aria-controls="" autocomplete="off" action="{{ route('update_info') }}">
			{{ csrf_field() }}

			<!--	for disabling autocomplete	  -->
			<div class="row" style="display:none">
				<div class="input-field col s12">
					<input id="password" type="password" class="validate">
					<label for="password">Password</label>
				</div>
			</div>

			<div class="row">
				<div class="input-field col s12">
					<input id="username" name="name" type="text" class="validate" value="{{ Auth::user()->name }}">
					<label for="first_name">Username</label>
				</div>
			</div>

			<div class="row">
				<div class="input-field col s12">
					<input id="email" type="email" class="validate" disabled value="{{ Auth::user()->email }}">
					<label for="email">Email</label>
				</div>
			</div>
			<div class="row">
				<div class="col s12 btn-area">
					<button class="btn waves-effect waves-light green darken-1" type="submit" name="action">APPLY</button>
				</div>
			</div>
			<div class="row">
				<div class="col s12 btn-area">
					<a class="btn orange darken-2" href="/settings/user_password_reset"> Change Password</a>
					<a class="btn red darken-2" href=""> Remove Account</a>
				</div>
			</div>
		</form>
	</div>


</div>

@endsection