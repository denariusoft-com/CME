<style>
.buttons-excel
{
	background:#027b3d;
	border:1px solid #027b3d;
	  -webkit-box-shadow: 0 10px 20px rgba(0, 0, 0, 0.19), 0 6px 6px rgba(0, 0, 0, 0.23);
  -moz-box-shadow: 0 10px 20px rgba(0, 0, 0, 0.19), 0 6px 6px rgba(0, 0, 0, 0.23);
  -ms-box-shadow: 0 10px 20px rgba(0, 0, 0, 0.19), 0 6px 6px rgba(0, 0, 0, 0.23);
  -o-box-shadow: 0 10px 20px rgba(0, 0, 0, 0.19), 0 6px 6px rgba(0, 0, 0, 0.23);
  box-shadow: 0 1px 3px rgba(0,0,0,0.12), 0 1px 2px rgba(0,0,0,0.24);
  transition: all 0.3s cubic-bezier(.25,.8,.25,1);
}
.buttons-excel:hover {
  box-shadow: 0 14px 28px rgba(0,0,0,0.25), 0 10px 10px rgba(0,0,0,0.22);
}
.buttons-pdf
{
	background:#dd1f29;
	border:1px solid #dd1f29;
	 -webkit-box-shadow: 0 10px 20px rgba(0, 0, 0, 0.19), 0 6px 6px rgba(0, 0, 0, 0.23);
  -moz-box-shadow: 0 10px 20px rgba(0, 0, 0, 0.19), 0 6px 6px rgba(0, 0, 0, 0.23);
  -ms-box-shadow: 0 10px 20px rgba(0, 0, 0, 0.19), 0 6px 6px rgba(0, 0, 0, 0.23);
  -o-box-shadow: 0 10px 20px rgba(0, 0, 0, 0.19), 0 6px 6px rgba(0, 0, 0, 0.23);
	box-shadow: 0 1px 3px rgba(0,0,0,0.12), 0 1px 2px rgba(0,0,0,0.24);
	transition: all 0.3s cubic-bezier(.25,.8,.25,1);
}
.buttons-pdf:hover {
  box-shadow: 0 14px 28px rgba(0,0,0,0.25), 0 10px 10px rgba(0,0,0,0.22);
}
</style>
<!-- Page Content -->
<div class="content container-fluid">
					<div class="row">
						<div class="col-sm-8 col-6">
							<h4 class="page-title">STS Summary Report</h4>
						</div>
						<div class="col-sm-4 col-6 text-right m-b-30">
							<!--<a href="#" class="btn add-btn" data-toggle="modal" data-target="#add_asset"><i class="fa fa-plus"></i> Add Asset</a>
						--></div>
					</div>
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
					<!-- Search Filter -->
					<form method="GET" action="{{ route('reports.index') }}">
						@csrf
					<div class="row filter-row">
					
						<div class="col-sm-6 col-md-3">  
							<div class="form-group form-focus">
								<input type="text" class="form-control floating" name="name_moor">
								<label class="focus-label">Mooring Master Name</label>
							</div>
						</div>
						<!--<div class="col-sm-6 col-md-3"> 
							<div class="form-group form-focus select-focus">
								<select class="select floating"> 
									<option value=""> -- Select -- </option>
									<option value="0"> Pending </option>
									<option value="1"> Approved </option>
									<option value="2"> Returned </option>
								</select>
								<label class="focus-label">Status</label>
							</div>
						</div>-->
						
						<div class="col-sm-12 col-md-4">  
						   <div class="row">  
							   <div class="col-md-6 col-sm-6">  
									<div class="form-group form-focus">
										<div class="cal-icon">
											<input class="form-control floating datetimepicker" type="text" name="fromdate">
										</div>
										<label class="focus-label">From</label>
									</div>
								</div>
							   <div class="col-md-6 col-sm-6">  
									<div class="form-group form-focus">
										<div class="cal-icon">
											<input class="form-control floating datetimepicker" type="text" name="todate">
										</div>
										<label class="focus-label">To</label>
									</div>
								</div>
							</div>
						</div>
						<div class="col-sm-6 col-md-2">  
						<button type="submit" class="btn btn-success">Search</button>
							<!--<a href="#" class="btn btn-success btn-block" > Search </a>  -->
						</div>     
                    </div>
					</form>
					<!-- /Search Filter -->
					<div class="row">
						<div class="col-md-12">
							<div class="table-responsive">
								<table id="statusmaster_datatable_list" class="table table-striped custom-table mb-0 datatable">
									<thead>
										<tr>
											<th>SLNO</th>
											<th>Date</th>
											<th>SHIP NAME</th>
											<th>STS SUPT</th>
											<th>CLIENT</th>
											<th>FM/FS</th>
											<th>NO REF</th>
											<th>STATUS</th>

											<th>Action</th>
											
										</tr>
									</thead>
									<tbody>
								    @php $i = 0; @endphp
									@foreach ($overallsummarylist as $summary)
									@php 
									$datecom = strtotime($summary->commence_operation); 
									$newformat_com = date('d',$datecom);
									
									$datecomp = strtotime($summary->complete_operation); 
									$newformat_datecomp = date('d',$datecomp);
									$tothours = $datecomp - $datecom;
									$tothrs = round(($datecomp - $datecom)/3600,2); 
									if($tothrs>48){
									$totexcedd = round($tothrs-48,2);
									}else { $totexcedd =0;  }
									
									//echo $tothrs;
									$uid=$summary->user_id;
									if(!empty(CommonHelper::profile_img($uid))){
										$profrec1 = CommonHelper::profile_img($uid);
										$profrec = CommonHelper::moor_detail($profrec1->id);
										//dd($profrec->short_code);
									}
									else{
										$profrec="";
									}
									$clientid=$summary->client_id;
									if(!empty(CommonHelper::client_detail($clientid))){
										$clientrec = CommonHelper::client_detail($clientid);
									}
									else{
										$clientrec="";
									}
									@endphp
								
										<tr>
											<td>{{ ++$i }}</td>
											<td>{{ $newformat_com. " - ". $newformat_datecomp }}
											</td>
											<td style="text-transform:capitalize" ><strong>{{ $summary->mother_vessel }} / {{ $summary->maneuvring_vessel }}</strong>
											</br>
											Commence Operation :{{ date('d',strtotime($summary->commence_operation))."/".date('Hi',strtotime($summary->commence_operation)) }}
											</br>
											Complete Operation :{{ date('d',strtotime($summary->complete_operation))."/".date('Hi',strtotime($summary->complete_operation)) }}
											</br>
											Total Exceeding Hours: {{ $totexcedd }}</td>
											<td style="text-transform:uppercase">@isset($profrec->short_code){{$profrec->short_code}}@endisset</td>
											<td>@isset($clientrec->client_shortcode){{$clientrec->client_shortcode}}@endisset</td>
											<td>{{ $summary->client_fsu_spot }}</td>
											<td>{{ $summary->work_ref_no }}</td>
											<td>
											@if($summary->status == 3)
												<a style='padding: 1px 7px;font-size: 14px;' href='#' title='STATUS' data-target='#statusUpdate' data-toggle='modal' class='btn btn-primary' >Pending</a>
											@endif
											@if($summary->status == 1)
												<label style="color: #fff;background: #05b159;padding: 1px 5px;border-radius: 3px;font-size: 14px;">Approved</label>
											@endif
											@if($summary->status == 2)
												<label style="color: #fff;background: #dd1f29;padding: 1px 5px;border-radius: 3px;font-size: 14px;">Rejected</label>
											@endif
											@if($summary->status == 0)
												<a style='padding: 1px 7px;font-size: 14px;' href='#' title='VERIFY' data-target='#statusVERIFY' data-toggle='modal' class='btn btn-primary' >Verify</a>
											@endif
											<!--button type="button" class="btn btn-primary btn-sm">Pending</button-->
											</td>
											@if($summary->status == 1 || $summary->status == 2)
											<td><a href="{{ URL::to('timesheet_pdf/'.$summary->t_id) }}" ><i class="fa fa-file-pdf-o fa-lg" style="font-weight:bold;color:red"></i></a></td>
											@endif
										
										</tr>
										
										
										
										<div id="statusVERIFY" class="modal custom-modal_delete fade"  role="dialog">
											<div class="modal-dialog modal-md">
												<form action="{{ route('reports.store_refno')}}" method="POST" style="width: 100%;" id="reference_number_validation">
													@csrf
													<input type="hidden" name="timesheet_id" id="timesheet_id" value="{{ isset($summary->t_id) ? $summary->t_id : '' }}">
													<div class="modal-content" style="border-radius: 1rem;padding: 20px;">
														<div class="modal-body">
															<div class="modal-header" style="border-bottom:none;padding:0px;">
																<button type="button" class="close" data-dismiss="modal" aria-label="Close">
																	<span aria-hidden="true">&times;</span>
																</button>
															</div>
															<div class="form-header">
																<div class="row">
																	<div class="col-md-12" style="text-align: left;">
																			<div class="form-group">
																			  <label for="Reference" >Reference No:</label>
																			  <input type="number" class="form-control" id="reference_no" min="0" placeholder="Enter reference no" name="reference_no">
																			</div>
																	</div>
																</div>
															</div>
															
															<div class="modal-btn delete-action">
																<div class="row">
																	<div class="col-12">
																		<input type="submit" name="submit_ref_number" value="Submit" class="btn btn-success">
																		<input type="reset" name="reset" value="Reset" class="btn btn-danger">
																	</div>
																</div>
															</div>
														</div>
													</div>
												</form>
											</div>
										</div>
				
										@endforeach
									</tbody>
								</table>
							</div>
						</div>
					</div>
                </div>

				<div id="statusUpdate" class="modal custom-modal_delete fade"  role="dialog">
					<div class="modal-dialog modal-dialog-centered modal-md">
						<form action="" id="deleteForm" method="post" style="width: 100%;">
							<div class="modal-content" style="border-radius: 1rem;padding: 20px;">
								<div class="modal-body">
									<div class="modal-header" style="border-bottom:none;padding:0px;">
										<button type="button" class="close" data-dismiss="modal" aria-label="Close">
											<span aria-hidden="true">&times;</span>
										</button>
									</div>
									<div class="form-header">
										<h3>STS Summary</h3>
										<p>Are you sure want to move?</p>
									</div>
									
									<div class="modal-btn delete-action">
										<div class="row">
											<div class="col-6">
												<!--a href="javascript:void(0);" class="btn btn-primary continue-btn">Delete</a-->
												<a href="{{ URL::to('sts_approvedstatusUpdate/'.$summary->t_id) }}" class="btn btn-danger continue-btn" style="width: 100%;background: #05b159;border: 1px solid #05b159;color: #fff;">Approved</a>
											</div>
											<div class="col-6">
												<a href="{{ URL::to('sts_rejectedstatusUpdate/'.$summary->t_id) }}" class="btn btn-primary cancel-btn" style="background: #dd1f29;border: 1px solid #dd1f29;color: #fff;">Rejected</a>
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

	  $('#reference_number_validation').validate({
	    rules: {
			"reference_no": {
				required: true,
				remote: {
					url: "{{ url('/findReferenceNumberExists')}}",
					data: {
						timesheet_id: function() {
							return $("#timesheet_id").val();
						},
						_token: "{{csrf_token()}}",
						reference_no: $(this).data('reference_no')
					},
					type: "GET",
				},
			},
	    },
	    messages: {
			"reference_no": {
				required: "Reference number is required",
				remote: "Already number exist"
			}
	    }
	  });

	});
</script>

				<!-- /Page Content -->
				<script type="text/javascript">
				$(document).ready(function() {
					 var table = $('#statusmaster_datatable_list').DataTable( {
						dom: 'Blfrtip',
						paging:   false,
						buttons : [ 
						{
							extend : 'excel',
							text : '<i class="fa fa-file-excel-o" aria-hidden="true" style="color:#fff"> Excel</i>',
							exportOptions: {
								columns: [ 0, 1, 2, 3, 4, 5 ]
							}
						},
						{
							extend : 'pdf',
							text : '<i class="fa fa-file-pdf-o" aria-hidden="true" style="color:#fff"> Pdf</i>',
							exportOptions: {
								columns: [ 0, 1, 2, 3, 4, 5 ]
							}
						}

						]
					} );
					table.buttons().container()
					.appendTo( '#statusmaster_datatable_list .col-md-6:eq(0)' );
				} );
// Datatable	

				</script>

