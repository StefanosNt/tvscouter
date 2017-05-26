@extends('layouts.app')
	
	@section('content')
	
	<div class="container">
		@if(session('status'))
			<div class="card-panel @if(session('status')=='Success') green @else red @endif lighten-1 mb50"> 
				<span class="white-text">{{ session('status') }}</span>
			</div> 
		@endif
		<h4 class="pb20">Reset Password</h4> 
		
		<div class="row">
			<form role="form" method="POST" action="{{ route('user.password_reset') }}">
				{{ csrf_field() }} 
				
				
				<div class="{{ $errors->has('password') ? ' has-error' : '' }}">

					<div class="input-field">
						<label for="password">Old Password</label>
						<input id="password" type="password" name="password_old" required>

						@if ($errors->has('password_old'))
							<span><strong>{{ $errors->first('password_old') }}</strong></span>
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

	
@endsection