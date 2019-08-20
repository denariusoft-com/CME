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
<?php $user = Auth::user()->getRoleNames(); ?>
	<!-- Logo -->
	<div class="header-left">
		<a href="" class="logo">
		<?php
		$themerec ="";
		if(!empty(CommonHelper::theme_setting())){
			$themerec = CommonHelper::theme_setting();
		}
		else{
			$themerec="";
		}
		?>
		<?php if(!empty($themerec->logo)): ?>
		<img src="<?php echo e(URL::to('/')); ?>/storage/app/public/images/<?php echo e($themerec->logo); ?>" width="70" height="40" alt="">
		<?php else: ?>
		<img src="<?php echo e(asset('public/assets/img/logo.png')); ?>" width="100" height="40" alt="">
		<?php endif; ?>
			
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
				<span class="user-img"><!--<img src="<?php echo e(asset('public/assets/img/profiles/avatar-21.jpg')); ?>" alt="">-->
				<?php								
									$id=Auth::user()->id;
									if(!empty(CommonHelper::profile_img($id))){
										$profrec = CommonHelper::profile_img($id);
									}
									else{
										$profrec="";
									}
								?>
										<?php if(!empty($profrec->profile_img)): ?>
										<img src="<?php echo e(URL::to('/')); ?>/storage/app/public/images/<?php echo e($profrec->profile_img); ?>" alt="" width="60" height="30">
										<?php else: ?>
										<img  src="<?php echo e(URL::to('/')); ?>/public/assets\img\profiles\user.jpg" alt="user">
										<?php endif; ?>	
				<span class="status online"></span></span>
				<span><?php echo e(Auth::user()->name); ?>

				</span>
			</a>
			<div class="dropdown-menu">
				<a class="dropdown-item" href="<?php echo e(route('settings.myprofile')); ?>">My Profile</a>
				<?php $__currentLoopData = $user; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $v): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
				<?php
				if($v=="Admin"){
				?>
				<a class="dropdown-item" href="<?php echo e(url('settings')); ?>">Settings</a>
				<?php
				}
				?>
			    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
				<a class="dropdown-item" href="<?php echo e(route('logout')); ?>"
				   onclick="event.preventDefault();
								 document.getElementById('logout-form').submit();">
					<?php echo e(__('Logout')); ?>

				</a>

				<form id="logout-form" action="<?php echo e(route('logout')); ?>" method="POST" style="display: none;">
					<?php echo csrf_field(); ?>
				</form>
			</div>
		</li>
	</ul>
	<!-- /Header Menu -->
	
	<!-- Mobile Menu -->
	<div class="dropdown mobile-user-menu">
		<a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><i class="fa fa-ellipsis-v"></i></a>
		<div class="dropdown-menu dropdown-menu-right">
			<a class="dropdown-item" href="<?php echo e(route('settings.myprofile')); ?>">My Profile</a>
			<?php $__currentLoopData = $user; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $v): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
				<?php
				if($v=="Admin"){
				?>
				<a class="dropdown-item" href="<?php echo e(url('settings')); ?>">Settings</a>
				<?php
				}
				?>
			    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
			<a class="dropdown-item" href="<?php echo e(route('logout')); ?>"
			onclick="event.preventDefault();
								 document.getElementById('logout-form').submit();">
					<?php echo e(__('Logout')); ?></a>
					
				<form id="logout-form" action="<?php echo e(route('logout')); ?>" method="POST" style="display: none;">
					<?php echo csrf_field(); ?>
				</form>
		</div>
	</div>
	<!-- /Mobile Menu -->
	
</div>
			<?php /**PATH D:\php7\htdocs\laravel\CME\resources\views/header/header.blade.php ENDPATH**/ ?>