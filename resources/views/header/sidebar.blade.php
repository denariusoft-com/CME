 <div class="sidebar" id="sidebar">
	<div class="sidebar-inner slimscroll">
		<div id="sidebar-menu" class="sidebar-menu">
			<ul>
				<li class="active"> 
					<a href="index.html"><i class="la la-dashboard"></i> <span>Dashboard</span></a>
				</li>
				<!--li> 
					<a href="employee-dashboard.html"><i class="la la-tachometer"></i> <span>Employee Dashboard</span></a>
				</li-->
				<li class="submenu">
					<a href="#" class="noti-dot"><i class="la la-user"></i> <span> Master</span> <span class="menu-arrow"></span></a>
					<ul style="display: none;">
						<li><a href="{{ route('clients.index') }}">Client</a></li>
					</ul>
				</li>
				<li> 
					<a href="{{ route('users.index') }}"><i class="la la-user-plus"></i> <span>User</span></a>
				</li>
				
			</ul>
		</div>
	</div>
</div>
