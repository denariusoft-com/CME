                <div class="content container-fluid">
				
					<!-- Page Title -->
					<div class="row">
						<div class="col">
							<h4 class="page-title">Client List</h4>
						</div>
						<div class="col-12 text-right m-b-30">
							<a href="#add_edit_modal" class="btn add-btn" data-toggle="modal" onClick="showaddForm();"><i class="fa fa-plus"></i> Add </a>
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
								<table class="table table-striped custom-table mb-0 datatable" id="clientmaster_datatable_list">
									<thead>
										<tr>
											<th>Client Name</th>
											<th>Short Code</th>
											<th>Status</th>
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
				<!-- Add Today Work Modal -->
				<div id="add_edit_modal" class="modal custom-modal fade" role="dialog">
					<div class="modal-dialog modal-dialog-centered modal-md" role="document">
						<div class="modal-content" >
							<div class="modal-header">
								<h5 class="modal-title">Client List</h5>
								<button type="button" class="close" data-dismiss="modal" aria-label="Close">
									<span aria-hidden="true">&times;</span>
								</button>
							</div>
							<div class="modal-body">
								<form method="post" action="{{ route('clients.store') }}" id="client_list_validation">
									@csrf
                                    <input type="hidden" name="id" id="updateid">
                                    @php
                                    	$created_by = Auth::user()->id;
                                    	$updated_by = Auth::user()->id;
                                    @endphp
                                    <input type="hidden" name="created_by" id="created_by" value="{{ $created_by }}">
                                    <input type="hidden" name="updated_by" id="updated_by" value="{{ $updated_by }}">
									
									<div class="form-group">
										<label>Client Name <span class="text-danger">*</span></label>
										<input type="text" name="client_name" id="client_name" class="form-control">
									</div>
									<div class="form-group">
										<label>Short Code (client) <span class="text-danger">*</span></label>
										<input type="text" name="client_shortcode" id="client_shortcode" class="form-control">
									</div>
									<div class="submit-section">
										<button class="btn btn-warning submit-btn edit_hide_btn "
											type="submit" name="action">Update
										</button>
											
										<button class="btn btn-primary submit-btn add_hide" style="display:none;" type="submit" name="action">Add</button>
									</div>
								</form>
							</div>
						</div>
					</div>
				</div>	
					
				<!-- Delete Holiday Modal -->
				<div id="delete_data" class="modal custom-modal_delete fade"  role="dialog">
					<div class="modal-dialog modal-dialog-centered modal-md">
						<form action="" id="deleteForm" method="post" style="width: 100%;">
							<div class="modal-content" style="border-radius: 1rem;padding: 20px;">
								<div class="modal-body">
									{{ csrf_field() }}
									{{ method_field('DELETE') }}
									<div class="form-header">
										<h3>Client Detail</h3>
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
				<!-- /Delete Holiday Modal -->
			

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
			"client_shortcode": {
				required: true,
			}
	    },
	    messages: {
			"client_name": {
				required: "Client name is required",
				remote: "Already name exist"
			},
			"client_shortcode": {
				required: "Client short code is required"
			}
	    }
	  });

	});
</script>
<script type="text/javascript">
// Datatable	
$(document).ready(function() {
	
		$('#clientmaster_datatable_list').DataTable({
			responsive: true,
			processing: true,
			serverSide: true,
			lengthMenu: [
				[10, 25, 50, 100],
				[10, 25, 50, 100]
			],
			ajax: {
				"url": "{{ url('/get_client_list') }}",
				"dataType": "json",
				"type": "POST",
				"data": {
					_token: "{{csrf_token()}}"
				}
			},
			columns: [
				{
					"data": "client_name"
				},
				{
					"data": "client_shortcode"
				},
				{
					"data": "status"
				},
				{
					"data": "options"
				}
			]
		});
});


function ConfirmDeletion(deleteID) {
	
    var id = deleteID;
	var url = '{{ route("clients.destroy", ":id") }}';
	url = url.replace(':id', id);
	$("#deleteForm").attr('action', url);
	$('.custom-modal_delete').modal();
}
function formSubmit()
 {
	 $("#deleteForm").submit();
 }

function showaddForm() {
   // $('.edit_hide').show();
    $('.add_hide').show();
    $('.edit_hide_btn').hide();
    $('#delete_data').hide();
    $('#client_name').val("");
    $('#client_shortcode').val("");
    $('.custom-modal_add_edit').modal();
}

function showeditForm(dataID) {
    //$('.edit_hide').hide();
    $('.add_hide').hide();
    $('.edit_hide_btn').show();
    $('.custom-modal_add_edit').modal();
    var url = "{{ url('/get_client_detail') }}" + '?id=' + dataID;
    $.ajax({
        url: url,
        type: "GET",
        success: function(result) {
            //console.log(result);
            $('#updateid').val(result.id);
            $('#client_name').val(result.client_name);
			$('#client_shortcode').val(result.client_shortcode);
        }
    });
}

</script>