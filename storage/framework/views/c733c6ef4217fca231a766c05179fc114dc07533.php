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
							<h4 class="page-title">Summary Report</h4>
						</div>
						<div class="col-sm-4 col-6 text-right m-b-30">
							<!--<a href="#" class="btn add-btn" data-toggle="modal" data-target="#add_asset"><i class="fa fa-plus"></i> Add Asset</a>
						--></div>
					</div>
					
					<!-- Search Filter -->
					<form method="GET" action="<?php echo e(route('reports.index')); ?>">
						<?php echo csrf_field(); ?>
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
								    <?php $i = 0; ?>
									<?php $__currentLoopData = $overallsummarylist; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $summary): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
									<?php 
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
									?>
								
									<tr>
											<td><?php echo e(++$i); ?></td>
											<td><?php echo e($newformat_com. " - ". $newformat_datecomp); ?>

											</td>
											<td style="text-transform:capitalize" ><strong><?php echo e($summary->mother_vessel); ?> / <?php echo e($summary->maneuvring_vessel); ?></strong>
											</br>
											Commence Operation :<?php echo e(date('d',strtotime($summary->commence_operation))."/".date('Hi',strtotime($summary->commence_operation))); ?>

											</br>
											Complete Operation :<?php echo e(date('d',strtotime($summary->complete_operation))."/".date('Hi',strtotime($summary->complete_operation))); ?>

											</br>
											Total Exceeding Hours: <?php echo e($totexcedd); ?></td>
											<td style="text-transform:uppercase"><?php if(isset($profrec->short_code)): ?><?php echo e($profrec->short_code); ?><?php endif; ?></td>
											<td><?php if(isset($clientrec->client_shortcode)): ?><?php echo e($clientrec->client_shortcode); ?><?php endif; ?></td>
											<td><?php echo e($summary->client_fsu_spot); ?></td>
											<td></td>
											<td><button type="button" class="btn btn-primary btn-sm">Pending</button></td>
											<td><a href="<?php echo e(URL::to('timesheet_pdf/'.$summary->t_id)); ?>" ><i class="fa fa-file-pdf-o fa-lg" style="font-weight:bold;color:red"></i></a></td>
										
										</tr>
										<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
									</tbody>
								</table>
							</div>
						</div>
					</div>
                </div>
				<!-- /Page Content -->
				<script type="text/javascript">
				$(document).ready(function() {
					 var table = $('#statusmaster_datatable_list').DataTable( {
						dom: 'Blfrtip',
						paging:   false,
						buttons : [ 
						{
							extend : 'excel',
							text : '<i class="fa fa-file-excel-o" aria-hidden="true" style="color:#fff"> Excel</i>'
						},
						{
							extend : 'pdf',
							text : '<i class="fa fa-file-pdf-o" aria-hidden="true" style="color:#fff"> Pdf</i>'
						}

						]
					} );
					table.buttons().container()
					.appendTo( '#statusmaster_datatable_list .col-md-6:eq(0)' );
				} );
// Datatable	

				</script>			<?php /**PATH D:\php7\htdocs\laravel\CME\resources\views/content/reports/summaryreport.blade.php ENDPATH**/ ?>