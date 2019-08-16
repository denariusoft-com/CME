<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0">
        <meta name="description" content="">
		<meta name="keywords" content="">
        <meta name="author" content="">
        <meta name="robots" content="noindex, nofollow">
        <title>Login - Mooring STS</title>
		
		<!-- Favicon -->
		@php
		
		if(!empty(CommonHelper::theme_setting())){
			$themerec = CommonHelper::theme_setting();
		}
		else{
			$themerec="";
		}
		@endphp
		@if(!empty($themerec->favicon))
		<link rel="shortcut icon" type="image/x-icon" href="{{ URL::to('/') }}/storage/app/public/images/{{ $themerec->favicon }}">
		@else
		<link rel="shortcut icon" type="image/x-icon" href="{{ asset('public/assets/img/logo.png') }}">
		@endif
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
    <body style="xbackground: linear-gradient(to right, #ea7815 0%, #ad8484 100%);" class="account-page">
	
		<!-- Main Wrapper -->
        <div style="" class="main-wrapper">
			<div class="account-content">
				<div class="container">
				
					<!-- Account Logo -->
					<!--div class="account-logo">
						<a href=""><img src="{{ asset('public/assets/img/logo.png') }}" alt="Denariusoft"></a>
					</div-->
					<!-- /Account Logo -->
					
					<div class="account-box">
						<div class="account-wrapper">
							<!--h3 class="account-title">{{ __('Login') }}</h3-->
							<p class="account-subtitle">
							@php
							if(!empty(CommonHelper::theme_setting())){
								$themerec = CommonHelper::theme_setting();
							}
							else{
								$themerec="";
							}
							@endphp
							@if(!empty($themerec->logo))
							<img src="{{ URL::to('/') }}/storage/app/public/images/{{ $themerec->logo }}" width="70" height="40" alt="CME">
							@else
							<img src="{{ asset('public/assets/img/logo.png') }}" alt="CME" style="max-width:150px;">
							@endif
							</p>
							
							<!-- Account Form -->
							 <form method="POST" action="{{ route('login') }}">
								@csrf
								<div class="form-group">
									<label>{{ __('E-Mail Address') }}</label>
									<input class="form-control @error('email') is-invalid @enderror" id="email" name="email" type="email" value="{{ old('email') }}" required autocomplete="email" autofocus>
									@error('email')
										<span class="invalid-feedback" role="alert">
											<strong>{{ $message }}</strong>
										</span>
									@enderror
								</div>
								<div class="form-group">
									<div class="row">
										<div class="col">
											<label>{{ __('Password') }}</label>
										</div>
										<div class="col-auto">
											@if (Route::has('password.request'))
												<a class="text-muted" href="{{ route('password.request') }}">
													{{ __('Forgot Your Password?') }}
												</a>
											@endif
										</div>
									</div>
									<input type="password" id="password" name="password" class="form-control @error('password') is-invalid @enderror" required autocomplete="current-password">
									@error('password')
										<span class="invalid-feedback" role="alert">
											<strong>{{ $message }}</strong>
										</span>
									@enderror
								</div>
								<div class="form-group text-center">
									<button class="btn btn-primary account-btn" type="submit">{{ __('Login') }}</button>
								</div>
								<!--div class="account-footer">
									@if (Route::has('register'))
									<p>Don't have an account yet? <a href="{{ route('register') }}">{{ __('Register') }}</a></p>
									@endif
								</div-->
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