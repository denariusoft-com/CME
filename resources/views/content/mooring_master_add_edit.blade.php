                <div class="content container-fluid">
				
					<!-- Page Title -->
					<div class="row">
						<div class="col">
							<h4 class="page-title">Mooring Master List</h4>
						</div>
						<div class="col-12 text-right m-b-30">
							<a href="#add_edit_modal" class="btn add-btn" ><i class="fa fa-plus"></i> Add </a>
						</div>
					</div>
					<!-- /Page Title -->
					<div class="row">
						<div class="col-md-12">
							<div class="card">
								<div class="card-body">
									<form method="post" action="{{ route('mooring_masters.store') }}">
										<div class="row">
											<div class="col-md-12">
												<div class="form-group">
													<label>Address <span class="text-danger">*</span></label>
													<textarea rows="4" class="form-control"></textarea>
												</div>
											</div>
										</div>
										<div class="row">
											<div class="col-md-6">
												<div class="form-group">
													<label>Phone No <span class="text-danger">*</span></label>
													<input class="form-control" type="text">
												</div>
											</div>
											<div class="col-md-6">
												<div class="form-group">
													<label>Email <span class="text-danger">*</span></label>
													<input class="form-control" type="text">
												</div>
											</div>
										</div>
										<div class="row">
											<div class="col-md-6">
												<div class="form-group">
													<label>Company Name <span class="text-danger">*</span></label>
													<input class="form-control" type="text">
												</div>
											</div>
											<div class="col-md-6">
												<div class="form-group">
													<label>Account No <span class="text-danger">*</span></label>
													<input class="form-control" type="text">
												</div>
											</div>
										</div>
										<div class="row">
											<div class="col-md-6">
												<div class="form-group">
													<label>Salary <span class="text-danger">*</span></label>
													<input class="form-control" type="text">
												</div>
											</div>
											<div class="col-md-6">
												<div class="form-group">
													<label>Status <span class="text-danger">*</span></label>
													<select class="form-control" name="status_id" id="status_id">
														<option label="select status" value=""></option>
														@foreach($data['status_detail'] as $row)
														<option value="{{ $row->id }}">{{ $row->status_name }}</option>
														@endforeach
													</select>
												</div>
											</div>
										</div>
										<div class="row">
											<div class="col-md-12">
												<div class="form-group">
													<label>Resume</label>
													<input class="form-control" type="file">
												</div>
											</div>
										</div>
										<div class="row">
											<div class="col-md-6">
												<div class="form-group">
													<label>Date Recruit <span class="text-danger">*</span></label>
													<div class="cal-icon"><input class="form-control datetimepicker" type="text"></div>
												</div>
											</div>
											<div class="col-md-6">
												<div class="form-group">
													<label>Category Name<span class="text-danger">*</span></label>
													<select name="category_id" id="category_id" class="form-control">
														 <option value="">Select Category</option>
														 @foreach($data['category_detail'] as $row)
														 <option value="{{ $row->id}}">{{ $row->category_name }}</option>
														 @endforeach
													</select>
												</div>
											</div>
										</div>
										<div class="row">
											<div class="col-md-6">
												<div class="form-group">
													<label>Rate Name <span class="text-danger">*</span></label>
													<select name="rate_id" id="rate_id" class="form-control">
														<option value="">Select Rate</option>
														 @foreach($data['rate_detail'] as $row)
														 <option value="{{ $row->id}}">{{ $row->rate_name }}</option>
														 @endforeach
													</select>
												</div>
											</div>
											<div class="col-md-6">
												<div class="form-group">
													<label>Mooring Price (Rate) <span class="text-danger">*</span></label>
													<input class="form-control" type="text" name="mooring_rate_id" id="mooring_rate_id">
												</div>
											</div>
										</div>	
										<div class="submit-section">
											<button class="btn btn-primary submit-btn">Submit</button>
										</div>
									</form>
								</div> 
							</div>
						</div>
					</div>
                </div>
				<!-- /Page Content -->			
			
<script type="text/javascript">
    $('#category_id').change(function(){
    var categoryID = $(this).val();    
    if(categoryID){
        $.ajax({
           type:"GET",
           url:"{{url('/get-rate-list')}}?category_id="+categoryID,
           success:function(res){               
            if(res){
                //$("#rate_id").empty();
                //$("#rate_id").append('<option>Select</option>');
                //$.each(res,function(key,value){
                   // $("#rate_id").append('<option value="'+key+'">'+value+'</option>');
                //});
				$("#rate_id").val(res.rate_id);
				$("#mooring_rate_id").val(res.price);
            }else{
               $("#rate_id").empty();
			   $("#mooring_rate_id").empty();
            }
           }
        });
    }else{
        $("#rate_id").empty();
        $("#mooring_rate_id").empty();
    }      
   });
   
    $('#state').on('change',function(){
    var stateID = $(this).val();    
    if(stateID){
        $.ajax({
           type:"GET",
           url:"{{url('api/get-city-list')}}?state_id="+stateID,
           success:function(res){               
            if(res){
                $("#city").empty();
                $.each(res,function(key,value){
                    $("#city").append('<option value="'+key+'">'+value+'</option>');
                });
           
            }else{
               $("#city").empty();
            }
           }
        });
    }else{
        $("#city").empty();
    }
        
   });
</script>

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