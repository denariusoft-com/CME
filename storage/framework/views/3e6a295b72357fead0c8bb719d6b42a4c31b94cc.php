<?php $user = Auth::user()->getRoleNames(); ?>
 <div class="sidebar" id="sidebar">
	<div class="sidebar-inner slimscroll">
		<div id="sidebar-menu" class="sidebar-menu">
			<ul>
				<?php $__currentLoopData = $user; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $v): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
							<?php
							if($v=="Admin"){
							?>
					<li class="<?php echo e(Request::is('home*') ? 'active' : ''); ?>"> 

					<a href="<?php echo e(url('home')); ?>"><i class="la la-dashboard"></i> <span>Dashboard</span></a>
				</li>
				<!--li> 
					<a href="employee-dashboard.html"><i class="la la-tachometer"></i> <span>Employee Dashboard</span></a>
				</li-->
				
				<li class="submenu">
					<a href="#" class="noti-dot"><i class="la la-user"></i> <span> Master</span> <span class="menu-arrow"></span></a>
					<ul style="display:<?php echo e(Request::is(array('clients*','statuses*','categories*','rates*','ratemasters*','mooring_masters*')) ? 'block' : ' none'); ?>">
						<li class="<?php echo e(Request::is('clients*') ? 'active' : ''); ?>"><a href="<?php echo e(route('clients.index')); ?>">Client List</a></li>
						<li class="<?php echo e(Request::is('statuses*') ? 'active' : ''); ?>"><a href="<?php echo e(route('statuses.index')); ?>">Status List</a></li>
						<li class="<?php echo e(Request::is('categories*') ? 'active' : ''); ?>"><a href="<?php echo e(route('categories.index')); ?>">Category List</a></li>
						<li class="<?php echo e(Request::is('rates*') ? 'active' : ''); ?>"><a href="<?php echo e(route('rates.index')); ?>">Rate List</a></li>
						<li class="<?php echo e(Request::is('mooring_masters*') ? 'active' : ''); ?>"><a href="<?php echo e(route('mooring_masters.index')); ?>">Mooring Master List</a></li>
					    <li class="<?php echo e(Request::is('ratemasters*') ? 'active' : ''); ?>"><a href="<?php echo e(route('ratemasters.index')); ?>">Rate Master List</a></li>
						
					</ul>
				</li>
				<?php
				}
				if($v=="Mooring Master"){
				?>
				<li class="active"> 
					<a href="<?php echo e(route('settings.myprofile')); ?>"><i class="la la-dashboard"></i> <span>Dashboard</span></a>
				</li>
				<?php
				}
				?>
			    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
				<li> 


				<li class="<?php echo e(Request::is('timesheet*') ? 'active' : ''); ?>"> 
				<a href="<?php echo e(route('timesheet.index')); ?>"><i class="la la-tachometer"></i> <span>Timesheet</span></a>
				</li>
				<?php $__currentLoopData = $user; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $v): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
							<?php
							if($v=="Admin"){
							?>
				<li class="submenu">
					<a href="#" class="noti-dot"><i class="la la-pie-chart"></i> <span> Report</span> <span class="menu-arrow"></span></a>
					<ul style="display:<?php echo e(Request::is(array('reports*')) ? 'block' : ' none'); ?>">
						<li class="<?php echo e(Request::is('reports*') ? 'active' : ''); ?>"><a href="<?php echo e(url('reports')); ?>">Summary Report</a></li>
						
					</ul>
				</li>
				<li class="<?php echo e(Request::is('users*') ? 'active' : ''); ?>"> 
					<a href="<?php echo e(route('users.index')); ?>"><i class="la la-user-plus"></i> <span>User</span></a>
				</li>
				<?php
				}
				?>
			    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
			</ul>
		</div>
	</div>
</div>
<?php /**PATH D:\php7\htdocs\laravel\CME\resources\views/header/sidebar.blade.php ENDPATH**/ ?>