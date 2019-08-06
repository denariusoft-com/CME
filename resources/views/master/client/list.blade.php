<!DOCTYPE html>
<html lang="en">
    <head>
		@include('header.head-script')
		<!-- Datatable CSS -->
		@include('header.datatable-header')

    </head>
    <body>
		<!-- Main Wrapper -->
        <div class="main-wrapper">
			@include('header.header')
			<!-- Sidebar -->
			@include('header.sidebar')
            <!-- /Sidebar -->
			<!-- Page Wrapper -->
            <div class="page-wrapper">
				<!-- Page Content -->
				@include('content.client_list')
                <!-- /Page Content -->
            </div>
			<!-- /Page Wrapper -->

        </div>
		<!-- /Main Wrapper -->
		@include('footer.footer')
		
		@include('footer.datatable-footer')
		
    </body>
</html>