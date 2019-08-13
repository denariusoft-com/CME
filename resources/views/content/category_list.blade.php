                <div class="content container-fluid">
				
					<!-- Page Title -->
					<div class="row">
						<div class="col">
							<h4 class="page-title">Category List</h4>
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
								<table class="table table-striped custom-table mb-0 datatable" id="categorymaster_datatable_list">
									<thead>
										<tr>
											<th>Category Name</th>
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
						<div class="modal-content">
							<div class="modal-header">
								<h5 class="modal-title">Category List</h5>
								<button type="button" class="close" data-dismiss="modal" aria-label="Close">
									<span aria-hidden="true">&times;</span>
								</button>
							</div>
							<div class="modal-body">
								<form method="post" action="{{ route('categories.store') }}" id="category_list_validation">
									@csrf
                                    <input type="hidden" name="id" id="updateid">
                                    @php
                                    	$created_by = Auth::user()->id;
                                    	$updated_by = Auth::user()->id;
                                    @endphp
                                    <input type="hidden" name="created_by" id="created_by" value="{{ $created_by }}">
                                    <input type="hidden" name="updated_by" id="updated_by" value="{{ $updated_by }}">
									
									<div class="form-group">
										<label>Category Name <span class="text-danger">*</span></label>
										<input type="text" name="category_name" id="category_name" class="form-control">
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
			

<script>
	$(document).ready(function () {

	  $('#category_list_validation').validate({
	    rules: {
			"category_name": {
				required: true,
				remote: {
					url: "{{ url('/findCategoryNameExists')}}",
					data: {
						category_id: function() {
							return $("#updateid").val();
						},
						_token: "{{csrf_token()}}",
						category_name: $(this).data('category_name')
					},
					type: "GET",
				},
			},
	    },
	    messages: {
			"category_name": {
				required: "Category name is required",
				remote: "Already name exist"
			}
	    }
	  });

	});
</script>
<script type="text/javascript">
// Datatable	
$(document).ready(function() {
	
		$('#categorymaster_datatable_list').DataTable({
			responsive: true,
			processing: true,
			serverSide: true,
			lengthMenu: [
				[10, 25, 50, 100],
				[10, 25, 50, 100]
			],
			ajax: {
				"url": "{{ url('/get_category_list') }}",
				"dataType": "json",
				"type": "POST",
				"data": {
					_token: "{{csrf_token()}}"
				}
			},
			columns: [
				{
					"data": "category_name"
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
    $('#category_name').val("");
    $('.modal').modal();
}

function showeditForm(dataID) {
    //$('.edit_hide').hide();
    $('.add_hide').hide();
    $('.edit_hide_btn').show();
    $('.modal').modal();
    var url = "{{ url('/get_category_detail') }}" + '?id=' + dataID;
    $.ajax({
        url: url,
        type: "GET",
        success: function(result) {
            //console.log(result);
            $('#updateid').val(result.id);
            $('#category_name').val(result.category_name);
        }
    });
}

</script>