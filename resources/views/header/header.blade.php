<!-- Loader -->
	<div id="loader-wrapper">
		<div id="loader">
			<div class="loader-ellips">
			  <span class="loader-ellips__dot"></span>
			  <span class="loader-ellips__dot"></span>
			  <span class="loader-ellips__dot"></span>
			  <span class="loader-ellips__dot"></span>
			</div>
		</div>
	</div>
	<!-- /Loader -->
<div class="header">
			
	<!-- Logo -->
	<div class="header-left">
		<a href="" class="logo">
		@php
		if(!empty(CommonHelper::theme_setting())){
			$themerec = CommonHelper::theme_setting();
		}
		else{
			$themerec="";
		}
		@endphp
		@if(!empty($themerec->logo))
		<img src="{{ URL::to('/') }}/storage/app/public/images/{{ $themerec->logo }}" width="70" height="40" alt="">
		@else
		<img src="{{ asset('public/assets/img/logo.png') }}" width="100" height="40" alt="">
		@endif
			
		</a>
	</div>
	<!-- /Logo -->
	
	<a id="toggle_btn" href="javascript:void(0);">
		<span class="bar-icon">
			<span></span>
			<span></span>
			<span></span>
		</span>
	</a>
	
	<!-- Header Title -->
	<!--div class="page-title-box">
		<h3>Denariusoft</h3>
	</div-->
	<!-- /Header Title -->
	
	<a id="mobile_btn" class="mobile_btn" href="#sidebar"><i class="fa fa-bars"></i></a>
	
	<!-- Header Menu -->
	<ul class="nav user-menu">
	
		<li class="nav-item dropdown has-arrow main-drop">
			<a href="#" class="dropdown-toggle nav-link" data-toggle="dropdown">
				<span class="user-img"><img src="{{ asset('public/assets/img/profiles/avatar-21.jpg') }}" alt="">
				<span class="status online"></span></span>
				<span>Admin</span>
			</a>
			<div class="dropdown-menu">
				<a class="dropdown-item" href="profile.html">My Profile</a>
				<a class="dropdown-item" href="{{ url('settings')}}">Settings</a>
				<a class="dropdown-item" href="{{ route('logout') }}"
				   onclick="event.preventDefault();
								 document.getElementById('logout-form').submit();">
					{{ __('Logout') }}
				</a>

				<form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
					@csrf
				</form>
			</div>
		</li>
	</ul>
	<!-- /Header Menu -->
	
	<!-- Mobile Menu -->
	<div class="dropdown mobile-user-menu">
		<a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><i class="fa fa-ellipsis-v"></i></a>
		<div class="dropdown-menu dropdown-menu-right">
			<a class="dropdown-item" href="profile.html">My Profile</a>
			<a class="dropdown-item" href="settings.html">Settings</a>
			<a class="dropdown-item" href="{{ route('logout') }}"
			onclick="event.preventDefault();
								 document.getElementById('logout-form').submit();">
					{{ __('Logout') }}</a>
					
				<form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
					@csrf
				</form>
		</div>
	</div>
	<!-- /Mobile Menu -->
	
</div>
			