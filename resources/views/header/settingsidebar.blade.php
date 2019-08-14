<!-- Sidebar -->
@php $user = Auth::user()->getRoleNames(); @endphp
<div class="sidebar" id="sidebar">
                <div class="sidebar-inner slimscroll">
					<div class="sidebar-menu">
						<ul>
							<li> 
								<a href="{{ url('home')}}"><i class="la la-home"></i> <span>Back to Home</span></a>
							</li>
							<li class="menu-title">Settings</li>
							@foreach($user as $v)
							@php
							if($v=="Admin"){
							@endphp
							<li> 
								<a href="{{ url('settings')}}"><i class="la la-building"></i> <span>Company Settings</span></a>
							</li>
							<li> 
								<a href="{{ action('SettingController@themesettings') }}"><i class="la la-photo"></i> <span>Theme Settings</span></a>
							</li>
							
							<!--<li> 
								<a href="localization.html"><i class="la la-clock-o"></i> <span>Localization</span></a>
							</li>
							-->
							<li> 
								<a href="{{ url('roles')}}"><i class="la la-key"></i> <span>Roles & Permissions</span></a>
							</li>
							@php
							}
							@endphp
							@endforeach
							<li> 
								<a href="{{ route('settings.myprofile') }}"><i class="la la-user"></i> <span>My Profile</span></a>
							</li>
							<!--<li> 
								<a href="email-settings.html"><i class="la la-at"></i> <span>Email Settings</span></a>
							</li>
							<li> 
								<a href="invoice-settings.html"><i class="la la-pencil-square"></i> <span>Invoice Settings</span></a>
							</li>
							<li> 
								<a href="salary-settings.html"><i class="la la-money"></i> <span>Salary Settings</span></a>
							</li>
							<li> 
								<a href="notifications-settings.html"><i class="la la-globe"></i> <span>Notifications</span></a>
							</li>
							<li> 
								<a href="change-password.html"><i class="la la-lock"></i> <span>Change Password</span></a>
							</li>
							<li> 
								<a href="leave-type.html"><i class="la la-cogs"></i> <span>Leave Type</span></a>
							</li>-->
						</ul>
					</div>
                </div>
            </div>
			<!-- Sidebar -->