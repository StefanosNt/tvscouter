@extends('layouts.app')
 
@section('content')
<div class="container">
    <div class="row pt50"> 
        <div class="col s8 offset-s2 ">
			
			@if (session('status')) 
				<div class="card-panel green lighten-1 mb50"> 
					<span class="white-text">{{ session('status') }}</span>
				</div>
			@endif
			<h4>Reset Password </h4>

			<form role="form" method="POST" action="{{ route('password.email') }}">
				{{ csrf_field() }}

				<div class="{{ $errors->has('email') ? ' has-error' : '' }}"> 
					<div class="input-field">
						<label for="email">E-Mail Address</label>
						<input id="email" type="email" class="validate" name="email" value="{{ old('email') }}" required autofocus>
						@if ($errors->has('email'))
							<span class="help-block">
								<strong>{{ $errors->first('email') }}</strong>
							</span>
						@endif
					</div>
				</div>

				<div class="input-field"> 
					<button type="submit" class="btn red">
						Send Password Reset Link
					</button> 
				</div>
			</form> 
        </div>
    </div>
</div>
@endsection
