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
					<div class="row filter-row">
						<div class="col-sm-6 col-md-3">  
							<div class="form-group form-focus">
								<input type="text" class="form-control floating">
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
											<input class="form-control floating datetimepicker" type="text">
										</div>
										<label class="focus-label">From</label>
									</div>
								</div>
							   <div class="col-md-6 col-sm-6">  
									<div class="form-group form-focus">
										<div class="cal-icon">
											<input class="form-control floating datetimepicker" type="text">
										</div>
										<label class="focus-label">To</label>
									</div>
								</div>
							</div>
						</div>
						<div class="col-sm-6 col-md-2">  
							<a href="#" class="btn btn-success btn-block"> Search </a>  
						</div>     
                    </div>
					<!-- /Search Filter -->
					<div class="row">
						<div class="col-md-12">
							<div class="table-responsive">
								<table class="table table-striped custom-table mb-0 datatable">
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
											<th class="text-center">Action</th>
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
									$tothrs = ($datecomp - $datecom)/3600; 
									if($tothrs>48){
									$totexcedd = $tothrs-48;
									}else { $totexcedd =0;  }
									
									//echo $tothrs;
									@endphp
									
								
									<tr>
											<td>{{ ++$i }}</td>
											<td>{{ $newformat_com. " - ". $newformat_datecomp }}
											</td>
											<td></br>
											Total Exceeding Hours: {{ $totexcedd }}</td>
											<td>{{ $summary->user_id }}</td>
											<td></td>
											<td></td>
											<td></td>
											<td></td>
											<td class="text-center"></td>
										</tr>
										@endforeach
									</tbody>
								</table>
							</div>
						</div>
					</div>
                </div>
				<!-- /Page Content -->
			