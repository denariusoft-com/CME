 <div class="sidebar" id="sidebar">
	<div class="sidebar-inner slimscroll">
		<div id="sidebar-menu" class="sidebar-menu">
			<ul>
				<li class="{{ Request::is('home*') ? 'active' : '' }}"> 
					<a href="{{ url('home') }}"><i class="la la-dashboard"></i> <span>Dashboard</span></a>
				</li>
				<!--li> 
					<a href="employee-dashboard.html"><i class="la la-tachometer"></i> <span>Employee Dashboard</span></a>
				</li-->
				<li class="submenu">
					<a href="#" class="noti-dot"><i class="la la-user"></i> <span> Master</span> <span class="menu-arrow"></span></a>
					<ul style="display:{{ Request::is(array('clients*','statuses*','categories*','rates*','ratemasters*','mooring_masters*')) ? 'block' : ' none' }}">
						<li class="{{ Request::is('clients*') ? 'active' : '' }}"><a href="{{ route('clients.index') }}">Client List</a></li>
						<li class="{{ Request::is('statuses*') ? 'active' : '' }}"><a href="{{ route('statuses.index') }}">Status List</a></li>
						<li class="{{ Request::is('categories*') ? 'active' : '' }}"><a href="{{ route('categories.index') }}">Category List</a></li>
						<li class="{{ Request::is('rates*') ? 'active' : '' }}"><a href="{{ route('rates.index') }}">Rate List</a></li>
						<li class="{{ Request::is('ratemasters*') ? 'active' : '' }}"><a href="{{ route('ratemasters.index') }}">Rate Master List</a></li>
						<li class="{{ Request::is('mooring_masters*') ? 'active' : '' }}"><a href="{{ route('mooring_masters.index') }}">Mooring Master List</a></li>
					</ul>
				</li>
				<li class="{{ Request::is('timesheet*') ? 'active' : '' }}"> 
					<a href="{{ route('timesheet.index') }}"><i class="la la-tachometer"></i> <span>Timesheet</span></a>
				</li>
				<li class="submenu">
					<a href="#" class="noti-dot"><i class="la la-pie-chart"></i> <span> Report</span> <span class="menu-arrow"></span></a>
					<ul style="display:{{ Request::is(array('reports*')) ? 'block' : ' none' }}">
						<li class="{{ Request::is('reports*') ? 'active' : '' }}"><a href="{{ url('reports')}}">Summary Report</a></li>
						
					</ul>
				</li>
				<li class="{{ Request::is('users*') ? 'active' : '' }}"> 
					<a href="{{ route('users.index') }}"><i class="la la-user-plus"></i> <span>User</span></a>
				</li>
				
			</ul>
		</div>
	</div>
</div>
