                <div class="content container-fluid">
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
					<!-- Page Title -->
					<div class="row">
						<div class="col">
							<h4 class="page-title">Jobsheet Details</h4>
						</div>
					</div>
					<!-- /Page Title -->
					<div class="row">
						<div class="col-md-12">
							<div class="card">
								<div class="card-body">
									<form method="post" id="jobsheet_validation" action="{{ route('timesheet.store') }}" enctype="multipart/form-data">
										@csrf
                                        
                                        @php
	                                    	$created_by = Auth::user()->id;
	                                    	$updated_by = Auth::user()->id;
	                                    @endphp
										@php
										$data['user_view'] = DB::table('mooring_masters')
										->join('users', 'users.id', '=', 'mooring_masters.user_id')
										->get();
										@endphp
										<!--input type="hidden" name="auto_id" id="auto_id" value="@isset($row){{$row->id}}@endisset" -->
	                                    <input type="hidden" name="created_by" id="created_by" value="{{ $created_by }}">
	                                    <input type="hidden" name="updated_by" id="updated_by" value="{{ $updated_by }}">
										<div class="row">
											<div class="col-md-6">
												<div class="form-group">
													<select name="moor_mas_id" id="moor_mas_id" class="form-control " required>
														<option value="">Select name</option>
															
														 @foreach($data['user_view'] as $row)
															@php 
															$profrec = CommonHelper::moor_detail($row->id);
															$prec = strtoupper(" ( ".$profrec->short_code." )");
															$prr = ucfirst($row->name).$prec;
															@endphp
														<option value="{{ $row->id}}" >{{ $prr }}</option>
														
														 @endforeach
													</select>
												</div>
											</div>
											<div class="col-md-6">
												<div class="form-group">
													<select name="transaction_type" id="transaction_type" class="form-control " required>
														<!--option value="">Select option</option-->
														<option value="1">Self</option>
													</select>
												</div>
											</div>
											<div class="col-md-6">
												<div class="form-group">
													<select name="transaction_category" id="transaction_category" class="form-control " required>
														<option value="">Select option</option>
														@foreach($data['view_category'] as $row_cat)
														<option value="{{ $row_cat->id}}">{{ $row_cat->category_name}}</option>
														@endforeach
													</select>
												</div>
											</div>
											<div class="col-md-6">
												<div class="form-group">
													<input type="text" name="rate_amt" id="rate_amt" class="form-control" readonly>
													<input type="hidden" name="ratemaster_id" id="ratemaster_id" class="form-control" value="">
												</div>
											</div>
										</div>
										
											
										<div class="submit-section" style="float:right">
											<button class="btn btn-primary submit-btn" type="submit">Submit</button>
										</div>
									</form>
								</div> 
							</div>
						</div>
					</div>
                </div>
				<!-- /Page Content -->			
			


<script>
	$(document).ready(function () {

	  $('#jobsheet_validation').validate({
	    rules: {
	    	"moor_mas_id": {
				required: true,
			},
	    	"transaction_type" : {
	    		required: true,
	    	},
			"transaction_category" : {
	    		required: true,
	    	}
			
	    },
	    messages: {
			"moor_mas_id": {
				required: "please select mooring master name."
			},
			"transaction_type": {
				required: "please select jobsheet type."
			},
			"transaction_category": {
				required: "please select jobsheet category."
			}
	    }
	  });

	});
	
	
	
	$('#transaction_category').change(function(){
		//alert("test");
		var transaction_category=$('#transaction_category').val();
		var user_moor=$('#moor_mas_id').val();
		if((transaction_category!="") && (user_moor!="")){
		getCategory(transaction_category, user_moor);
		}
		else{
			if(transaction_category==""){
				alert("Please select category");
			}
			else{
				alert("Please select Mooring master");
			}
			
		}
		//console.log(transaction_category);
		
	});
	$('#moor_mas_id').change(function(){
		//alert("hjkhhk");
		var user_moor=$('#moor_mas_id').val();
		var transaction_category=$('#transaction_category').val();
		if((transaction_category!="") && (user_moor!="")){
		getCategory(transaction_category, user_moor);
		}
		else{
			if(transaction_category==""){
				alert("Please select category");
			}
			else{
				alert("Please select Mooring master");
			}
			
		}
		//console.log(user_moor + transaction_category);
		
	});
	
	function getCategory(transaction_category, user_moor){
		//alert(transaction_category);
		var url = "{{ url('/get_transaction_amt') }}";
		$.ajax({
			url: url,
			type: "GET",
			data:{category_id:transaction_category, user_moor_id:user_moor},
			success: function(data) {
				$('#rate_amt').val(data.rate_amt);
				$('#ratemaster_id').val(data.ratemas_id);
			}
		});
	}
	
</script>