<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0">
        <meta name="description" content="">
		<meta name="keywords" content="">
        <meta name="author" content="">
        <meta name="robots" content="noindex, nofollow">
        <title>Forgot Password - STS</title>
		
		<!-- Favicon -->
        <link rel="shortcut icon" type="image/x-icon" href="{{ ('public/assets/img/favicon.png') }}">
		
		<!-- Bootstrap CSS -->
        <link rel="stylesheet" href="{{ asset('public/assets/css/bootstrap.min.css') }}">
		
		<!-- Fontawesome CSS -->
        <link rel="stylesheet" href="{{ asset('public/assets/css/font-awesome.min.css') }}">
		
		<!-- Main CSS -->
        <link rel="stylesheet" href="{{ asset('public/assets/css/style.css') }}">
		
		<!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
		<!--[if lt IE 9]>
			<script src="assets/js/html5shiv.min.js"></script>
			<script src="assets/js/respond.min.js"></script>
		<![endif]-->
    </head>
    <body class="account-page">
	
		<!-- Main Wrapper -->
        <div class="main-wrapper">
		
			<div class="account-content">
				<div class="container">
				
					<!-- Account Logo -->
					<!--div class="account-logo">
						<a href="index.html"><img src="assets\img\logo2.png" alt="Denariusoft"></a>
					</div-->
					<!-- /Account Logo -->
					
					<div class="account-box">
						<div class="account-wrapper">
							<h3 class="account-title">Forgot Password?</h3>
							<p class="account-subtitle">Enter your email to get a password reset link</p>
							@if (session('status'))
								<div class="alert alert-success" role="alert">
									{{ session('status') }}
								</div>
							@endif
							<!-- Account Form -->
							 <form method="POST" action="{{ route('password.email') }}">
							@csrf
								<div class="form-group">
									<label>{{ __('E-Mail Address') }}</label>
									<input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>
									@error('email')
										<span class="invalid-feedback" role="alert">
											<strong>{{ $message }}</strong>
										</span>
									@enderror
								</div>
								<div class="form-group text-center">
									<button class="btn btn-primary account-btn" type="submit">{{ __('Send Password Reset Link') }}</button>
								</div>
								<div class="account-footer">
									<p>Remember your password? <a href="{{ route('login') }}">Login</a></p>
								</div>
							</form>
							<!-- /Account Form -->
							
						</div>
					</div>
				</div>
			</div>
        </div>
		<!-- /Main Wrapper -->
		
		<!-- jQuery -->
        <script src="{{ asset('public/assets/js/jquery-3.2.1.min.js') }}"></script>
		
		<!-- Bootstrap Core JS -->
        <script src="{{ asset('public/assets/js/popper.min.js') }}"></script>
        <script src="{{ asset('public/assets/js/bootstrap.min.js') }}"></script>
		
		<!-- Custom JS -->
		<script src="{{ asset('public/assets/js/app.js') }}"></script>
		
    </body>
</html>