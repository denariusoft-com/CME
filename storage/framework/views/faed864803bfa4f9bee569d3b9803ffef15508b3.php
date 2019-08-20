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
		<?php
		
		if(!empty(CommonHelper::theme_setting())){
			$themerec = CommonHelper::theme_setting();
		}
		else{
			$themerec="";
		}
		?>
		<?php if(!empty($themerec->favicon)): ?>
		<link rel="shortcut icon" type="image/x-icon" href="<?php echo e(URL::to('/')); ?>/storage/app/public/images/<?php echo e($themerec->favicon); ?>">
		<?php else: ?>
		<link rel="shortcut icon" type="image/x-icon" href="<?php echo e(asset('public/assets/img/logo.png')); ?>">
		<?php endif; ?>
       <!-- Bootstrap CSS -->
        <link rel="stylesheet" href="<?php echo e(asset('public/assets/css/bootstrap.min.css')); ?>">
		
		<!-- Fontawesome CSS -->
        <link rel="stylesheet" href="<?php echo e(asset('public/assets/css/font-awesome.min.css')); ?>">
		
		<!-- Main CSS -->
        <link rel="stylesheet" href="<?php echo e(asset('public/assets/css/style.css')); ?>">
		
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
						<a href=""><img src="<?php echo e(asset('public/assets/img/logo.png')); ?>" alt="Denariusoft"></a>
					</div-->
					<!-- /Account Logo -->
					
					<div class="account-box">
						<div class="account-wrapper">
							<!--h3 class="account-title"><?php echo e(__('Login')); ?></h3-->
							<p class="account-subtitle">
							<?php
							if(!empty(CommonHelper::theme_setting())){
								$themerec = CommonHelper::theme_setting();
							}
							else{
								$themerec="";
							}
							?>
							<?php if(!empty($themerec->logo)): ?>
							<img src="<?php echo e(URL::to('/')); ?>/storage/app/public/images/<?php echo e($themerec->logo); ?>" width="70" height="40" alt="CME">
							<?php else: ?>
							<img src="<?php echo e(asset('public/assets/img/logo.png')); ?>" alt="CME" style="max-width:150px;">
							<?php endif; ?>
							</p>
							
							<!-- Account Form -->
							 <form method="POST" action="<?php echo e(route('login')); ?>">
								<?php echo csrf_field(); ?>
								<div class="form-group">
									<label><?php echo e(__('E-Mail Address')); ?></label>
									<input class="form-control <?php if ($errors->has('email')) :
if (isset($message)) { $messageCache = $message; }
$message = $errors->first('email'); ?> is-invalid <?php unset($message);
if (isset($messageCache)) { $message = $messageCache; }
endif; ?>" id="email" name="email" type="email" value="<?php echo e(old('email')); ?>" required autocomplete="email" autofocus>
									<?php if ($errors->has('email')) :
if (isset($message)) { $messageCache = $message; }
$message = $errors->first('email'); ?>
										<span class="invalid-feedback" role="alert">
											<strong><?php echo e($message); ?></strong>
										</span>
									<?php unset($message);
if (isset($messageCache)) { $message = $messageCache; }
endif; ?>
								</div>
								<div class="form-group">
									<div class="row">
										<div class="col">
											<label><?php echo e(__('Password')); ?></label>
										</div>
										<div class="col-auto">
											<?php if(Route::has('password.request')): ?>
												<a class="text-muted" href="<?php echo e(route('password.request')); ?>">
													<?php echo e(__('Forgot Your Password?')); ?>

												</a>
											<?php endif; ?>
										</div>
									</div>
									<input type="password" id="password" name="password" class="form-control <?php if ($errors->has('password')) :
if (isset($message)) { $messageCache = $message; }
$message = $errors->first('password'); ?> is-invalid <?php unset($message);
if (isset($messageCache)) { $message = $messageCache; }
endif; ?>" required autocomplete="current-password">
									<?php if ($errors->has('password')) :
if (isset($message)) { $messageCache = $message; }
$message = $errors->first('password'); ?>
										<span class="invalid-feedback" role="alert">
											<strong><?php echo e($message); ?></strong>
										</span>
									<?php unset($message);
if (isset($messageCache)) { $message = $messageCache; }
endif; ?>
								</div>
								<div class="form-group text-center">
									<button class="btn btn-primary account-btn" type="submit"><?php echo e(__('Login')); ?></button>
								</div>
								<!--div class="account-footer">
									<?php if(Route::has('register')): ?>
									<p>Don't have an account yet? <a href="<?php echo e(route('register')); ?>"><?php echo e(__('Register')); ?></a></p>
									<?php endif; ?>
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
        <script src="<?php echo e(asset('public/assets/js/jquery-3.2.1.min.js')); ?>"></script>
		
		<!-- Bootstrap Core JS -->
        <script src="<?php echo e(asset('public/assets/js/popper.min.js')); ?>"></script>
        <script src="<?php echo e(asset('public/assets/js/bootstrap.min.js')); ?>"></script>
		
		<!-- Custom JS -->
		<script src="<?php echo e(asset('public/assets/js/app.js')); ?>"></script>
		
    </body>
</html><?php /**PATH D:\php7\htdocs\laravel\CME\resources\views/auth/login.blade.php ENDPATH**/ ?>