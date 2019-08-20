<!-- Page Content -->
<div class="content container-fluid">
					<div class="row">
						<div class="col-sm-8 col-6">
							<h4 class="page-title">Summary Report</h4>
						</div>
						<div class="col-sm-4 col-6 text-right m-b-30">
							<!--<a href="#" class="btn add-btn" data-toggle="modal" data-target="#add_asset"><i class="fa fa-plus"></i> Add Asset</a>
						--></div>
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
											<td></td>
											<td><button type="button" class="btn btn-primary btn-sm">Pending</button></td>
											<td><a href="{{ URL::to('timesheet_pdf/'.$summary->t_id) }}" target="_blank">PDF</a></td>
										
										</tr>
										@endforeach
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
	
		$('#statusmaster_datatable_list').DataTable();
});
</script>			