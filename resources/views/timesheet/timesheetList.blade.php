<!DOCTYPE html>
<html lang="en">
    <head>
		@include('header.head-script')
		@include('header.datatable-header')
    </head>
    <body>
		<!-- Main Wrapper -->
        <div class="main-wrapper">
			<!-- Header -->
			@include('header.header')
			<!-- Sidebar -->
			@include('header.sidebar')
            <!-- /Sidebar -->
			
			<!-- Page Wrapper -->
            <div class="page-wrapper">
			
				<!-- Page Content -->
				@include('content.sts_timesheet_list')
                <!-- /Page Content -->

            </div>
			<!-- /Page Wrapper -->
			
        </div>
		<!-- /Main Wrapper -->
		
		<!-- Sidebar Overlay -->
		
		@include('footer.footer')
		@include('footer.datatable-footer')
    </body>
</html>