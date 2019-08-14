                <div class="content container-fluid">
				
					<!-- Page Title -->
					<div class="row">
						<div class="col">
							<h4 class="page-title">Mooring Master List</h4>
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


function ConfirmDeletion() {
    if (confirm("{{ __('Are you sure you want to delete?') }}")) {
        return true;
    } else {
        return false;
    }
}

function showaddForm() {
   // $('.edit_hide').show();
    $('.add_hide').show();
    $('.edit_hide_btn').hide();
    $('#client_name').val("");
    $('.modal').modal();
}

function showeditForm(dataID) {
    //$('.edit_hide').hide();
    $('.add_hide').hide();
    $('.edit_hide_btn').show();
    $('.modal').modal();
    var url = "{{ url('/get_client_detail') }}" + '?id=' + dataID;
    $.ajax({
        url: url,
        type: "GET",
        success: function(result) {
            //console.log(result);
            $('#updateid').val(result.id);
            $('#client_name').val(result.client_name);
        }
    });
}

</script>