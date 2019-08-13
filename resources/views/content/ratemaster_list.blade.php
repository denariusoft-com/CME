                <div class="content container-fluid">
				
					<!-- Page Title -->
					<div class="row">
						<div class="col">
							<h4 class="page-title">Rate Master List</h4>
						</div>
						<div class="col-12 text-right m-b-30">
							<a href="{{ route('ratemasters.create')}}" class="btn add-btn" ><i class="fa fa-plus"></i> Add </a>
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