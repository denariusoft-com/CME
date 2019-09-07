<!DOCTYPE html>
<html lang="en">
    <head>
		<?php echo $__env->make('header.head-script', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
		<!-- Datatable CSS -->
		<?php echo $__env->make('header.datatable-header', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    </head>
    <body>
		<!-- Main Wrapper -->
        <div class="main-wrapper">
			<?php echo $__env->make('header.header', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
			<!-- Sidebar -->
			<?php echo $__env->make('header.sidebar', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
            <!-- /Sidebar -->
			<!-- Page Wrapper -->
            <div class="page-wrapper">
				<!-- Page Content -->
				<?php echo $__env->make('content.jobsheet_add', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                <!-- /Page Content -->
            </div>
			<!-- /Page Wrapper -->

        </div>
		<!-- /Main Wrapper -->
		<?php echo $__env->make('footer.footer', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
		
		<?php echo $__env->make('footer.datatable-footer', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
		
    </body>
</html><?php /**PATH D:\php7\htdocs\laravel\CME\resources\views/jobsheet/add.blade.php ENDPATH**/ ?>