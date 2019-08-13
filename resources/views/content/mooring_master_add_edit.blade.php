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
									<form method="post" id="mooring_master_validation" action="{{ route('mooring_masters.store') }}" enctype="multipart/form-data">
										@csrf
                                        <input type="hidden" name="auto_id" id="auto_id">
                                        @php
	                                    	$created_by = Auth::user()->id;
	                                    	$updated_by = Auth::user()->id;
	                                    @endphp
	                                    <input type="hidden" name="created_by" id="created_by" value="{{ $created_by }}">
	                                    <input type="hidden" name="updated_by" id="updated_by" value="{{ $updated_by }}">
										<div class="row">
											<div class="col-md-12">
												<div class="form-group">
													<label>Name <span class="text-danger">*</span></label>
													<input class="form-control" type="text" name="user_id" id="user_id">
												</div>
											</div>
										</div>
										<div class="row">
											<div class="col-md-12">
												<div class="form-group">
													<label>Address <span class="text-danger">*</span></label>
													<textarea rows="4" class="form-control" name="address" id="address"></textarea>
												</div>
											</div>
										</div>
										<div class="row">
											<div class="col-md-6">
												<div class="form-group">
													<label>Phone No <span class="text-danger">*</span></label>
													<input class="form-control" type="text" name="phone_no" id="phone_no">
												</div>
											</div>
											<div class="col-md-6">
												<div class="form-group">
													<label>Email <span class="text-danger">*</span></label>
													<input class="form-control" type="text" name="email" id="email">
												</div>
											</div>
										</div>
										<div class="row">
											<div class="col-md-6">
												<div class="form-group">
													<label>Company Name <span class="text-danger">*</span></label>
													<input class="form-control" type="text" name="company_id" id="company_id">
												</div>
											</div>
											<div class="col-md-6">
												<div class="form-group">
													<label>Account No <span class="text-danger">*</span></label>
													<input class="form-control" type="text" name="acc_no" id="acc_no">
												</div>
											</div>
										</div>
										<div class="row">
											<div class="col-md-6">
												<div class="form-group">
													<label>Salary <span class="text-danger">*</span></label>
													<input class="form-control" type="text" name="salary" id="salary">
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
											<div class="col-md-6">
												<div class="form-group">
													<label>Resume</label>
													<input class="form-control" type="file" name="resume" id="resume">
												</div>
											</div>
											<div class="col-md-6">
												<div class="form-group">
													<label>Date Recruit <span class="text-danger">*</span></label>
													<div class="cal-icon"><input class="form-control datetimepicker" type="text" name="date_recruit" id="date_recruit"></div>
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

	  $('#mooring_master_validation').validate({
	    rules: {
	    	"user_id": {
				required: true,
				remote: {
					url: "{{ url('/findMooringMasterNameExists')}}",
					data: {
						u_id: function() {
							return $("#auto_id").val();
						},
						_token: "{{csrf_token()}}",
						user_id: $(this).data('user_id')
					},
					type: "GET",
				},
			},
	    	"address" : {
	    		required: true,
	    	},
	    	"phone_no" : {
	    		required: true,
	    		number:true
	    	},
	    	"email" : {
	    		required: true,
	    		email:true
	    	},
	    	"company_id" : {
	    		required: true,
	    	},
	    	"acc_no" : {
	    		required: true,
	    	},
	    	"salary" : {
	    		required: true,
	    		number:true
	    	},
	    	"resume" : {
	    		required: true,
	    		extension: "pdf|docx|doc"
	    	},
	    	"status_id" : {
	    		required: true,
	    	},
	    	"date_recruit" : {
	    		required: true,
	    		date: true
	    	},
	    	"category_id" : {
	    		required: true,
	    	},
	    	"rate_id" : {
	    		required: true,
	    	},
	    	"mooring_rate_id" : {
	    		required: true,
	    		number:true
	    	},
			
	    },
	    messages: {
			"user_id": {
				required: "please enter username.",
				remote: "already name exist"
			},
			"address": {
				required: "please enter address."
			},
			"phone_no": {
				required: "please enter phone number.",
				number: "please enter number only"
			},
			"email": {
				required: "please enter email id.",
				email: "please enter valid format"
			},
			"company_id": {
				required: "please enter company name."
			},
			"acc_no": {
				required: "please enter account number."
			},
			"salary": {
				required: "please enter salary.",
				number: "please enter number only"
			},
			"resume": {
				required: "please choose resume.",
				extension: "please select valid format only"
			},
			"status_id": {
				required: "please select status."
			},
			"date_recruit": {
				required: "please select date."
			},
			"category_id": {
				required: "please select category name."
			},
			"rate_id": {
				required: "please select rate name."
			},
			"mooring_rate_id": {
				required: "please enter mooring price.",
				number:"please enter number only"
			}
	    }
	  });

	});
</script>