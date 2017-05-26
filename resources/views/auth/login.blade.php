<div id="login" class="modal">
	<div class="modal-content">
		<h4 class="center">Log in</h4>
		<form class="col s12" role="form" method="POST" action="{{ route('login') }}">
			{{ csrf_field() }}
			<div class="row">
				<div class="input-field col s12">
					<input id="email" type="email" class="validate" name="email" value="{{ old('email') }}" required autofocus>
					<label for="email">Email</label> @if ($errors->has('email'))
					<span>
						<strong>{{ $errors->first('email') }}</strong>
					</span> @endif
				</div>
			</div>
			<div class="row">
				<div class="input-field col s12">
					<input id="password" type="password" class="validate" name="password" required>
					<label for="password">Password</label> @if ($errors->has('password'))
					<span class="help-block">
						<strong>{{ $errors->first('password') }}</strong>
					</span> @endif
				</div>
			</div>
			<div class="row">
				<div class="col s12">
					<p>
						<input type="checkbox" id="remember" {{ old( 'remember') ? 'checked' : '' }}>
						<label for="remember">Remember me</label>
					</p>
					<a href="/password/reset">Forgot Password?</a>
				</div>
			</div>
			<div class="divider"></div>
			<div class="row">
				<div class="col m12">
					<p class="right-align">
						<button class="btn waves-effect waves-light red" type="submit" name="action">Login</button>
					</p>
				</div>
			</div>
		</form>
	</div>
</div>
