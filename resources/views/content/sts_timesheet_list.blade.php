                <div class="content container-fluid">
				
					<!-- Page Title -->
					<div class="row">
						<div class="col">
							<h4 class="page-title">STS Timesheet List</h4>
						</div>
						<div class="col-12 text-right m-b-30">
							<a href="{{ route('mooring_masters.create') }}" class="btn add-btn" ><i class="fa fa-plus"></i> Add </a>
						</div>
					</div>
					<!-- /Page Title -->
					<div class="row">
						@if(session()->has('message'))
							<div class="{{ session()->get('alertClass') }} alert-dismissible fade show" role="alert" id="msg">
								<strong>{{ session()->get('type') }}</strong> {{ session()->get('message') }}
								<button type="button" class="close" data-dismiss="alert" aria-label="Close">
									<span aria-hidden="true">×</span>
								</button>
							</div>
						@endif
					</div>
					<div class="row">
						<div class="col-md-12">
							<div class="table-responsive">
								<table class="table table-striped custom-table mb-0 datatable" id="mooringmaster_datatable_list" style="width:100%">
									<thead>
										<tr>
											<th>Name</th>
											<th>Address</th>
											<th>Phone No</th>
											<th>Email</th>
											<th>Company</th>
											<th>Salary</th>
											<th>Action</th>
										</tr>
									</thead>
									<tbody>
										
									</tbody>
								</table>
							</div>
						</div>
					</div>
                </div>
				<!-- /Page Content -->			
			<div id="delete_data" class="modal custom-modal_delete fade"  role="dialog">
					<div class="modal-dialog modal-dialog-centered modal-md">
						<form action="" id="deleteForm" method="post" style="width: 100%;">
							<div class="modal-content" style="border-radius: 1rem;padding: 20px;">
								<div class="modal-body">
									{{ csrf_field() }}
									{{ method_field('DELETE') }}
									<div class="form-header">
										<h3>Mooring Master Detail</h3>
										<p>Are you sure want to delete?</p>
									</div>
									<div class="modal-btn delete-action">
										<div class="row">
											<div class="col-6">
												<!--a href="javascript:void(0);" class="btn btn-primary continue-btn">Delete</a-->
												<button type="submit" name="" class="btn btn-danger continue-btn" data-dismiss="modal" onclick="formSubmit()" style="width: 100%;background: #F44336;border: 1px solid #f44336;color: #fff;">Yes, Delete</button>
											</div>
											<div class="col-6">
												<a href="javascript:void(0);" data-dismiss="modal" class="btn btn-primary cancel-btn" style="background: #ff9b44;color: #fff;">Cancel</a>
											</div>
										</div>
									</div>
								</div>
							</div>
						</form>
					</div>
				</div>

<script>
	$(document).ready(function () {

	  $('#client_list_validation').validate({
	    rules: {
			"client_name": {
				required: true,
				remote: {
					url: "{{ url('/findClientNameExists')}}",
					data: {
						client_id: function() {
							return $("#updateid").val();
						},
						_token: "{{csrf_token()}}",
						client_name: $(this).data('client_name')
					},
					type: "GET",
				},
			},
	    },
	    messages: {
			"client_name": {
				required: "Client name is required",
				remote: "Already name exist"
			}
	    }
	  });

	});
</script>
<script type="text/javascript">
// Datatable	
$(document).ready(function() {
	
		$('#mooringmaster_datatable_list').DataTable({
			responsive: true,
			processing: true,
			serverSide: true,
			lengthMenu: [
				[10, 25, 50, 100],
				[10, 25, 50, 100]
			],
			ajax: {
				"url": "{{ url('/get_mooringmaster_list') }}",
				"dataType": "json",
				"type": "POST",
				"data": {
					_token: "{{csrf_token()}}"
				}
			},
			columns: [
				{
					"data": "user_id"
				},
				{
					"data": "address"
				},
				{
					"data": "phone_no"
				},
				{
					"data": "email"
				},
				{
					"data": "company_id"
				},
				{
					"data": "salary"
				},
				{
					"data": "options"
				}
			]
		});
});


function ConfirmDeletion(deleteID) {
	$('.custom-modal_delete').modal();
    var id = deleteID;
	var url = '{{ route("mooring_masters.destroy", ":id") }}';
	url = url.replace(':id', id);
	$("#deleteForm").attr('action', url);
	
}
function formSubmit()
 {
	 $("#deleteForm").submit();
 }

</script>