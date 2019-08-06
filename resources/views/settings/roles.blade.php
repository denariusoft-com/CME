<!DOCTYPE html>
<html lang="en">
    <head>
		@include('header.head-script')
    </head>
    <body>
		<!-- Main Wrapper -->
        <div class="main-wrapper">
			<!-- Header -->
			@include('header.header')
            <!-- /Header -->
			<!-- Sidebar -->
			@include('header.sidebar')
            <!-- /Sidebar -->
			
			<!-- Page Wrapper -->
            <div class="page-wrapper">
			
				<!-- Page Content -->
				@include('content.roles')
                <!-- /Page Content -->

            </div>
			<!-- /Page Wrapper -->
			
        </div>
		<!-- /Main Wrapper -->
		
		<!-- Sidebar Overlay -->
		@include('footer.footer')
    </body>
</html>