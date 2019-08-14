@php $user = Auth::user()->getRoleNames(); @endphp
 <div class="sidebar" id="sidebar">
	<div class="sidebar-inner slimscroll">
		<div id="sidebar-menu" class="sidebar-menu">
			<ul>
			@foreach($user as $v)
							@php
							if($v=="Admin"){
							@endphp
				<li class="active"> 
					<a href="{{ url('home') }}"><i class="la la-dashboard"></i> <span>Dashboard</span></a>
				</li>
				<!--li> 
					<a href="employee-dashboard.html"><i class="la la-tachometer"></i> <span>Employee Dashboard</span></a>
				</li-->
				
				<li class="submenu">
					<a href="#" class="noti-dot"><i class="la la-user"></i> <span> Master</span> <span class="menu-arrow"></span></a>
					<ul style="display: none;">
						<li><a href="{{ route('clients.index') }}">Client List</a></li>
						<li><a href="{{ route('statuses.index') }}">Status List</a></li>
						<li><a href="{{ route('categories.index') }}">Category List</a></li>
						<li><a href="{{ route('rates.index') }}">Rate List</a></li>
						<li><a href="{{ route('ratemasters.index') }}">Rate Master List</a></li>
						<li><a href="{{ route('mooring_masters.index') }}">Mooring Master List</a></li>
					</ul>
				</li>
				@php
				}
				if($v=="Mooring Master"){
				@endphp
				<li class="active"> 
					<a href="{{ route('settings.myprofile') }}"><i class="la la-dashboard"></i> <span>Dashboard</span></a>
				</li>
				@php
				}
				@endphp
			    @endforeach
				<li> 
					<a href="{{ route('timesheet.index') }}"><i class="la la-tachometer"></i> <span>Timesheet</span></a>
				</li>
				@foreach($user as $v)
							@php
							if($v=="Admin"){
							@endphp
				<li class="submenu">
					<a href="#" class="noti-dot"><i class="la la-pie-chart"></i> <span> Report</span> <span class="menu-arrow"></span></a>
					<ul style="display: none;">
						<li><a href="{{ url('reports')}}">Summary Report</a></li>
						
					</ul>
				</li>
				<li> 
					<a href="{{ route('users.index') }}"><i class="la la-user-plus"></i> <span>User</span></a>
				</li>
				@php
				}
				@endphp
			    @endforeach
			</ul>
		</div>
	</div>
</div>
