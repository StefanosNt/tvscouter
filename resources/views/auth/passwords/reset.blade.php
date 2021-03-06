@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row pt50">
        <div class="col s8 offset-s2"> 

			@if (session('status')) 
				<div class="card-panel green lighten-1 mb50"> 
					<span class="white-text">{{ session('status') }}</span>
				</div>
			@endif
			<h4 class="pb20">Reset Password</h4> 

			<form role="form" method="POST" action="{{ route('password.request') }}">
				{{ csrf_field() }}
				<input type="hidden" name="token" value="{{ $token }}">

				<div class="{{ $errors->has('email') ? ' has-error' : '' }}">

					<div class="input-field">
						<label for="email">E-Mail Address</label>
						<input id="email" type="email" name="email" class="validate" value="{{ $email or old('email') }}" required autofocus>

						@if ($errors->has('email'))
							<span><strong>{{ $errors->first('email') }}</strong></span>
						@endif
					</div>
				</div>

				<div class="{{ $errors->has('password') ? ' has-error' : '' }}">

					<div class="input-field">
						<label for="password">Password</label>
						<input id="password" type="password" name="password" required>
						
						@if ($errors->has('password'))
							<span><strong>{{ $errors->first('password') }}</strong></span>
						@endif
					</div>
				</div>

				<div class="{{ $errors->has('password_confirmation') ? ' has-error' : '' }}">
					<div class="input-field">
						<label for="password-confirm">Confirm Password</label>
						<input id="password-confirm" type="password" class="form-control" name="password_confirmation" required>

						@if ($errors->has('password_confirmation'))
							<span><strong>{{ $errors->first('password_confirmation') }}</strong></span>
						@endif
					</div>
				</div>

				<div class="form-group"> 
					<button type="submit" class="btn red">
						Reset Password
					</button> 
				</div>
			</form>
        </div>
    </div>
</div>
@endsection
