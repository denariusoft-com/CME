                <div class="content container-fluid">
				
					<!-- Page Title -->
					<div class="row">
						<div class="col">
							<h4 class="page-title">Rate Master List</h4>
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
								<table class="table table-striped custom-table mb-0 datatable" id="ratemaster_datatable_list" style="width:100%">
									<thead>
										<tr>
											<th>Category Name</th>
											<th>Rate Name</th>
											<th>Price</th>
											<th style="text-align:center">Action</th>
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
								<h5 class="modal-title">Rate Master details</h5>
								<button type="button" class="close" data-dismiss="modal" aria-label="Close">
									<span aria-hidden="true">&times;</span>
								</button>
							</div>
							<div class="modal-body">
								<form method="post" action="{{ route('ratemasters.store') }}" id="ratemaster_list_validation">
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
										<select class="form-control" name="cat_id" id="cat_id">
											<option label="select category name" value=""></option>
											@foreach($data['category_view'] as $value)
											 <option value="{{$value->id}}" >
                                                    {{$value->category_name}}
											</option>
                                            @endforeach
										</select>
									</div>
									<div class="form-group">
										<label>Rate Name <span class="text-danger">*</span></label>
										<select class="form-control" name="rate_id" id="rate_id">
											<option label="select rate name" value=""></option>
											@foreach($data['rate_view'] as $value)
											 <option value="{{$value->id}}" >
                                                    {{$value->rate_name}}
											</option>
                                            @endforeach
										</select>
									</div>
									<div class="form-group">
										<label>Price <span class="text-danger">*</span></label>
										<input type="text" name="price" id="price" class="form-control">
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

	  $('#ratemaster_list_validation').validate({
	    rules: {
			"cat_id" : {
				required: true
			},
			"rate_id" : {
				required: true
			},
			"price": {
				required: true,
				number: true,
				remote: {
					url: "{{ url('/findRatemasterNameExists')}}",
					data: {
						price_id: function() {
							return $("#updateid").val();
						},
						_token: "{{csrf_token()}}",
						price: $(this).data('price')
					},
					type: "GET",
				},
			},
	    },
	    messages: {
			"cat_id": {
				required: "Category name is required"
			},
			"rate_id": {
				required: "Rate name is required"
			},
			"price": {
				required: "Price name is required",
				remote: "Already name exist",
				number: "This field can only contain numbers"
			}
	    }
	  });

	});
</script>
<script type="text/javascript">
// Datatable	
$(document).ready(function() {
	
		$('#ratemaster_datatable_list').DataTable({
			responsive: true,
			processing: true,
			serverSide: true,
			lengthMenu: [
				[10, 25, 50, 100],
				[10, 25, 50, 100]
			],
			ajax: {
				"url": "{{ url('/get_ratemaster_list') }}",
				"dataType": "json",
				"type": "POST",
				"data": {
					_token: "{{csrf_token()}}"
				}
			},
			columns: [
				{
					"data": "cat_id"
				},
				{
					"data": "rate_id"
				},
				{
					"data": "price"
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
    $('#cat_id').val("");
    $('#rate_id').val("");
    $('#price').val("");
    $('.modal').modal();
}

function showeditForm(ratemasterID) {
    //$('.edit_hide').hide();
    $('.add_hide').hide();
    $('.edit_hide_btn').show();
    $('.modal').modal();
    var url = "{{ url('/get_ratemaster_detail') }}" + '?id=' + ratemasterID;
    $.ajax({
        url: url,
        type: "GET",
        success: function(result) {
            //console.log(result);
            $('#updateid').val(result.id);
            $('#cat_id').val(result.cat_id);
            $('#rate_id').val(result.rate_id);
            $('#price').val(result.price);
        }
    });
}

</script>