<!DOCTYPE html>
<html lang="en">
<head>
<title>justLaravel - Custom Authentication in Laravel</title>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet"
	href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
<link rel="stylesheet" href="http://www.w3schools.com/lib/w3.css">
<script
	src="https://cdnjs.cloudflare.com/ajax/libs/modernizr/2.8.3/modernizr.min.js"></script>
<script
	src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
	<script
	src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
</head>
<body>
	<ul class="w3-navbar w3-light-grey w3-border">
		<li><a href="#">Home</a></li>
		<li><a href="#">Sample Link 1</a></li>
		<li><a href="#">Sample Link 2</a></li> @if (session()->get('name'))
		<li class="w3-right">
				Welcome {{session()->get('name') }} , <a class="w3-right" href="/logout">Logout</a> </li> @else
		<li class="w3-right"><a class="w3-green" href="#" id="auth"
			onclick="document.getElementById('authentication').style.display='block'">SignIn/SignUp</a></li>@endif
	</ul>
	<div id="authentication" class="w3-modal">
		<span
			onclick="document.getElementById('authentication').style.display='none'"
			class="w3-closebtn w3-grey w3-hover-red w3-container w3-padding-16 w3-display-topright">X</span>

		<div class="w3-modal-content w3-card-8 w3-animate-zoom"
			style="max-width: 600px">

			<div class="col-md-6 w3-card-8 w3-teal" onclick="openForm('Login')">
				<h3>Sign In</h3>
			</div>
			<div class="col-md-6 w3-card-8 w3-teal"
				onclick="openForm('Register')">
				<h3>Sign Up</h3>
			</div>
			<div style="margin-top: 25px !important;">
				<div id="Login" class="w3-container form">
					<div class="w3-container ">
						<div class="w3-section">
							<br> <br>@if (count($errors->login) > 0)
							<div class="alert alert-danger">
								<ul>
									@foreach ($errors->login->all() as $error)
									<P>{{ $error }}</p>
									@endforeach
								</ul>
							</div>
							@endif 
							@if (Session::has('message'))
							<div class="alert alert-warning">{{ Session::get('message') }}</div>
							@endif
							<form action="/login" method="POST">
								{{ csrf_field() }} <input type="hidden" name="redirurl"
									value="{{ $_SERVER['REQUEST_URI'] }}"> <label><b>Username</b></label>
								<input name="username"
									class="w3-input w3-border w3-margin-bottom" type="text"
									placeholder="Enter Username" required> <label><b>Password</b></label>
								<input class="w3-input w3-border w3-margin-bottom"
									name="password" type="password" placeholder="Enter Password"
									required> <input type="submit"
									class="w3-btn w3-btn-block w3-green" value="Login"> <input
									class="w3-check w3-margin-top" type="checkbox"
									checked="checked"> Remember me
							</form>
						</div>
					</div>
					<div class="w3-container w3-border-top w3-padding-16 ">
						<button
							onclick="document.getElementById('authentication').style.display='none'"
							type="button" class="w3-btn w3-red">Cancel</button>
						<span class="w3-right w3-padding w3-hide-small">Forgot <a href="#">password?</a></span>
					</div>
				</div>
			</div>
			<div id="Register" class="w3-container form ">
				<div class="w3-container">
					<div class="w3-section">

						<br> <br> 
						@if (count($errors->register) > 0)
						<div class="alert alert-danger">
							<ul>
								@foreach ($errors->register->all() as $error)
								<P>{{ $error }}</p>
								@endforeach
							</ul>
						</div>
						@endif
						<form action="/register" method="POST" id="regForm">
							{{ csrf_field() }} <input type="hidden" name="redirurl"
								value="{{ $_SERVER['REQUEST_URI'] }}"> <label><b>Email</b></label>
							<input class="w3-input w3-border w3-margin-bottom" type="text"
								name="email" placeholder="Enter Email"
								value="{{ old('email') }}" required> <label><b>Username</b></label>
							<input class="w3-input w3-border w3-margin-bottom" type="text"
								name="name" placeholder="Enter username" required
								value="{{ old('name') }}"> <label><b>Password</b></label> <input
								class="w3-input w3-border w3-margin-bottom" type="password"
								name="password" required placeholder="Enter Password"> <label><b>Confirm
									Password</b></label> <input
								class="w3-input w3-border w3-margin-bottom" required
								type="password" name="password_confirmation"
								placeholder="Enter Password">
							<button type="submit" class="w3-btn w3-btn-block w3-green">SignUp</button>
						</form>
					</div>
				</div>
				<div class="w3-container w3-border-top w3-padding-16 ">
					<button
						onclick="document.getElementById('authentication').style.display='none'"
						type="button" class="w3-btn w3-red">Cancel</button>
				</div>
			</div>
		</div>
	</div>
	<div class="fluid-container"></div>
	<script>	
openForm("Login");
function openForm(formName) {
    
    var x = document.getElementsByClassName("form");
    for (i = 0; i < x.length; i++) {
       x[i].style.display = "none";  
    }
    document.getElementById(formName).style.display = "block";  
}
</script>
@if (Session::has('message'))
	<script>  $('#auth').click(); </script>
	@endif @if($errors->login->any())
	<script>  $('#auth').click();</script>
	@endif @if($errors->register->any())
	<script>  $('#auth').click(); openForm('Register');</script>
	@endif
</body>
</html>