                <div class="content container-fluid">
				
					<!-- Page Title -->
					<div class="row">
						<div class="col">
							<h4 class="page-title">Rate Master List
						
							</h4>
						</div>
						<div class="col-12 text-right m-b-30">
							<a href="{{ route('ratemasters.index')}}" class="btn add-btn" ><i class="fa fa-list"></i> List </a>
						</div>
					</div>
					<!-- /Page Title -->
					<div class="row">
						<div class="col-md-12">
							<div class="card">
								<div class="card-body">
								
									<form method="post" action="{{ route('ratemasters.store') }}" id="ratemaster_list_validation">
										@csrf		
										<input type="hidden" name="id" id="updateid" value="{{ isset($data['master_rate']->id) ? $data['master_rate']->id : '' }}">																				
										<div class="row">
											<div class="col-md-12">
												<div class="form-group">
													<label>Mooring Master Name <span class="text-danger">*</span></label>
													@php
													//var_dump($data['user_view']);
													@endphp

													<select name="user_id" id="user_id" class="form-control">
													 <option value="">Select name</option>
													 
														 @foreach($data['user_view'] as $row)
														 @php 
														 $profrec = CommonHelper::moor_detail($row->id);
														 $prec = strtoupper(" ( ".$profrec->short_code." )");
														 $prr = ucfirst($row->name).$prec;
														 @endphp
														 <option value="{{ $row->id}}" @if((isset($data['master_rate']->user_id) == $row->id)){{ "selected" }} @endif>{{ $prr }}</option>
														 @endforeach
													</select>
												</div>
											</div>
										</div>
										<div class="row">
											<div class="col-md-12">
												<label>Category Rate <span class="text-danger">*</span></label>
											</div>
											<div class="col-md-12">
												<div class="table-responsive">
													<table class="table table-bordered table-review review-table" id="table_achievements" style="width:100%">
														<thead>
															<tr>
																<th>Category Name</th>
																<th>Rate Name</th>
																<th>Timing(Hr)</th>
																<th>Price(RM)</th>
																<th style="width: 64px;">
																@php
																if(!isset($data['master_rate']->id)){
																@endphp
																<button type="button" class="btn btn-primary btn-add-row"><i class="fa fa-plus"></i></button>
																
																@php	
																}
																@endphp
																</th>
															</tr>
														</thead>
														<tbody id="table_achievements_tbody">
															<tr>
																<td>
																	<select name="category_id[]" id="category_id" class="form-control">
																		 <option value="">Select Category</option>
																		 @foreach($data['category_view'] as $row)
																		 <option value="{{ $row->id }}" @if((isset($data['master_rate']->cat_id) == $row->id)){{ "selected" }} @endif>{{ $row->category_name }}</option>
																		 @endforeach
																	</select>
																</td>
																<td>
																	<select class="form-control" name="rate_id[]" id="rate_id">
																		<option label="select rate name" value=""></option>
																		@foreach($data['rate_view'] as $value)
																		 <option value="{{$value->id}}"  @if((isset($data['master_rate']->rate_id) == $value->id)){{ "selected" }} @endif>
																				{{$value->rate_name}}
																		</option>
																		@endforeach
																	</select>
																</td>
																<td><input type="text" class="form-control" name="timing[]" id="timing" value="{{ isset($data['master_rate']->timing) ? $data['master_rate']->timing : '' }}"></td>
																<td><input type="text" class="form-control" name="price[]" id="price" value="{{ isset($data['master_rate']->price) ? $data['master_rate']->price : '' }}"></td>
																<td></td>
															</tr>
														</tbody>
													</table>
												</div>
											</div>
										</div>
										<div class="row">
											<div class="col-md-12">
												<div class="submit-section">
													<button class="btn btn-warning submit-btn edit_hide_btn "
														type="submit" name="action" style="float: right;">Update
													</button>
														
													<button class="btn btn-primary submit-btn add_hide" style="display:none;float: right;" type="submit" name="action">Add</button>
												</div>
											</div>
										</div>
									</form>
								</div> 
							</div>
						</div>
					</div>
                </div>
				<!-- /Page Content -->	

<script>
$(function () {
	$(document).on("click", '.btn-add-row', function () {
		var id = $(this).closest("table.table-review").attr('id');  // Id of particular table
		console.log(id);
		var div = $("<tr />");
		div.html(GetDynamicTextBox(id));
		$("#"+id+"_tbody").append(div);
	});
	$(document).on("click", "#comments_remove", function () {
		$(this).closest("tr").prev().find('td:last-child').html('<button type="button" class="btn btn-danger" id="comments_remove"><i class="fa fa-trash-o"></i></button>');
		$(this).closest("tr").remove();
	});
	function GetDynamicTextBox(table_id) {
		$('#comments_remove').remove();
		var rowsLength = document.getElementById(table_id).getElementsByTagName("tbody")[0].getElementsByTagName("tr").length+1;
		var cancat = ""; 

		cancat = '<td><select name="category_id[]" id="category_id" class="form-control"><option value="">Select Category</option>';
		@foreach($data['category_view'] as $row) 
		cancat +='<option value="{{ $row->id }}">{{ $row->category_name }}</option>';
		@endforeach
		cancat +='</select></td><td><select class="form-control" name="rate_id[]" id="rate_id"><option label="select rate name" value=""></option>';
		@foreach($data['rate_view'] as $row)
		cancat +='<option value="{{ $row->id }}">{{ $row->rate_name }}</option>';
		@endforeach 
		cancat +='</select></td><td><input type="text" name = "timing[]" class="form-control" value = "" ></td><td><input type="text" name = "price[]" class="form-control" value = "" ></td>' + '<td><button type="button" class="btn btn-danger" id="comments_remove"><i class="fa fa-trash-o"></i></button></td>';

		return cancat
	}
});
</script>
				
<script>
	$(document).ready(function () {

	  $('#ratemaster_list_validation').validate({
	    rules: {
			"user_id" : {
				required: true
			},
			"category_id[]" : {
				required: true
			},
			"rate_id[]" : {
				required: true,
				remote: {
					url: "{{ url('/findRateMasterExists')}}",
					data: {
						user_id: function() {
							return $("#user_id").val();
						},
						cat_id: function() {
							return $("#category_id").val();
						},
						rate_id: function() {
							return $("#rate_id").val();
						},
						_token: "{{csrf_token()}}",
						rate_name: $(this).data('rate_name')
					},
					type: "GET",
				},
			},
			"timing[]" : {
				required: true
			},
			"price[]" : {
				required: true
			}
	    },
	    messages: {
			"user_id": {
				required: "user name is required"
			},
			"category_id[]": {
				required: "category name is required"
			},			
			"rate_id[]": {
				required: "Rate name is required",
				remote: "Already Rate Exist for Moor.Master category"
			},
			"timing[]": {
				required: "timing is required"
			},
			"price[]": {
				required: "price is required"
			}
	    }
	  });

	});
</script>			
