	<!-- Modal Structure -->
	<div id="signup" class="modal">
	  <div class="modal-content">
      <h4 class="center">Sign up</h4> 
		<form id="signup-form" class="col s12" method="POST" action="{{ route('register') }}">
		{{ csrf_field() }}
			<div class="row">
				<div class="input-field col s12">
					<input id="name" type="text" class="validate {{ $errors->has('name') ? 'invalid' : '' }}" name="name" value="{{ old('name') }}" required autofocus>
					<label for="name">Name</label>
					@if ($errors->has('name'))
						<span>
							<strong>{{ $errors->first('name') }}</strong>
						</span>
					@endif
				</div>
			</div>
			<div class="row">
				<div class="input-field col s12">
					<input id="email" type="email" class="validate {{ $errors->has('email') ? 'invalid' : '' }}" name="email" value="{{ old('email') }}" required>
					<label for="email">Email</label>
					@if ($errors->has('email'))
						<span>
							<strong>{{ $errors->first('email') }}</strong>
						</span>
					@endif			 
				</div>
			</div>
			<div class="row">
				<div class="input-field col s12">
					<input id="password" type="password" class="validate {{ $errors->has('password') ? 'invalid' : '' }}" name="password" required>
					<label for="password">Password</label>
					@if ($errors->has('password'))
						<span class="help-block">
							<strong>{{ $errors->first('password') }}</strong>
						</span>
					@endif
				</div>
			</div>
			<div class="row">
				<div class="input-field col s12">
					<input id="password_confirmation" type="password" class="validate" name="password_confirmation" required>
					<label for="password_confirmation">Confirm Password</label> 
				</div>
			</div>
			<div class="divider"></div>
			<div class="row">
				<div class="col m12">
					<p class="right-align">
						<button id="register-btn"class="btn waves-effect waves-light red" type="submit" name="action">Register</button>
					</p>
				</div>
			</div>
		</form>
	  </div>
<!--
	  <div class="modal-footer">
		<a href="#!" class=" modal-action modal-close waves-effect waves-green btn-flat">Agree</a>
	  </div>
-->
	</div> 
	 
	<script>
		$(document).ready(function(){

			$("#signup-form").submit(function(){
			});

			$("#password").on("focusout", function (e) {
				if ($(this).val() != $("#password_confirmation").val()) {
					$("#password_confirmation").removeClass("valid").addClass("invalid");
				} else {
					$("#password_confirmation").removeClass("invalid").addClass("valid");
				}
			});

			$("#password_confirmation").on("keyup", function (e) {
				if ($("#password").val() != $(this).val()) {
					$(this).removeClass("valid").addClass("invalid");

				} else {
					$(this).removeClass("invalid").addClass("valid");
				}
			});
		}); 
	</script>  
