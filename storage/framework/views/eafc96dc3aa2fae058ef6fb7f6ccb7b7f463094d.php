<?php
$result=array();
	if(!empty(CommonHelper::client_count())){
		$client_tot = CommonHelper::client_count();
	}
	else{
		$client_tot="0";
		
	}
//	echo $client_tot;
if(!empty(CommonHelper::mooring_count())){
						$moor_tot = CommonHelper::mooring_count();
					}
					else{
						$moor_tot="0";
						
					}
				//	echo $moor_tot;
	if(isset($overallsummarylist)){			
	?>

	<?php $__currentLoopData = $overallsummarylist; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $summary): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
	<?php
	$uid=$summary->user_id;
	if(!empty(CommonHelper::profile_img($uid))){
		$profrec = CommonHelper::profile_img($uid);
	}
	else{
		$profrec="";
	}
	if(!empty($profrec->name)){
	$name = $profrec->name;
	}
	else{
	$name ="";
	}

	$datecom = strtotime($summary->commence_operation); 
	$newformat_com = date('d',$datecom);
	$datecomp = strtotime($summary->complete_operation); 
	$newformat_datecomp = date('d',$datecomp);
	$tothours = $datecomp - $datecom;
	$tothrs = round(($datecomp - $datecom)/3600,2); 
	if($tothrs>48){
	$totexcedd = round($tothrs-48,2);
	}else { $totexcedd =0;  }

	$result[] = "{ y : '".$name."'".","." a : ".$tothrs.","." b : ".$totexcedd." }";
	?>
	<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

	<?php
	
	$arrayelm = json_encode($result);
	}
	else{

	}
	$arrayelm = str_replace('"', '', $arrayelm);
	//echo $arrayelm;
	?>
	
<script>
$(document).ready(function() {
	Morris.Donut({
		element: 'pie-charts',
		colors: [
			//'#ff9b44',
			'#fc6075',
			'#ffc999',
			//'#fd9ba8'
		],
		data: [
			{label: "Mooring Master", value: <?php echo e($moor_tot); ?> },
			{label: "Clients", value: <?php echo e($client_tot); ?> },
			/*{label: "Projects", value: 45},
			{label: "Tasks", value: 10}*/
		],
		resize: true,
		redraw: true
	});
	Morris.Bar({
		element: 'bar-charts',		
	
		data: <?php echo $arrayelm; ?>,
		//data:<?php echo e($arrayelm); ?>,
		xkey: 'y',
		ykeys: ['a', 'b'],
		labels: ['Total Working Hours', 'Exceeding Hours'],
		lineColors: ['#ff9b44','#fc6075'],
		lineWidth: '3px',
		barColors: ['#ff9b44','#fc6075'],
		resize: true,
		redraw: true
	});
});
</script>
<div class="content container-fluid">
	<div class="row">
		<!--<div class="col-md-6 col-sm-6 col-lg-6 col-xl-3">
			<div class="dash-widget clearfix card-box">
				<span class="dash-widget-icon"><i class="fa fa-cubes"></i></span>
				<div class="dash-widget-info">
					<h3>112</h3>
					<span>Projects</span>
				</div>
			</div>
		</div>-->
		<div class="col-md-6 col-sm-6 col-lg-6 col-xl-4">
			<div class="dash-widget clearfix card-box">
				<span class="dash-widget-icon"><i class="fa fa-usd"></i></span>
				<div class="dash-widget-info">
					<h3>
					<?php
					if(!empty(CommonHelper::client_count())){
						$client_tot = CommonHelper::client_count();
					}
					else{
						$client_tot="0";
						
					}
					echo $client_tot;
					?>
					</h3>
					<span>Clients</span>
				</div>
			</div>
		</div>
		<!--<div class="col-md-6 col-sm-6 col-lg-6 col-xl-3">
			<div class="dash-widget clearfix card-box">
				<span class="dash-widget-icon"><i class="fa fa-diamond"></i></span>
				<div class="dash-widget-info">
					<h3>37</h3>
					<span>Tasks</span>
				</div>
			</div>
		</div>-->
		<div class="col-md-6 col-sm-6 col-lg-6 col-xl-4">
			<div class="dash-widget clearfix card-box">
				<span class="dash-widget-icon"><i class="fa fa-user"></i></span>
				<div class="dash-widget-info">
					<h3><?php
					if(!empty(CommonHelper::mooring_count())){
						$moor_tot = CommonHelper::mooring_count();
					}
					else{
						$moor_tot="0";
						
					}
					echo $moor_tot;
					?></h3>
					<span>Mooring Masters</span>
				</div>
			</div>
		</div>
		<div class="col-md-6 col-sm-6 col-lg-6 col-xl-4">
			<div class="dash-widget clearfix card-box">
				<span class="dash-widget-icon"><i class="la la-files-o"></i></span>
				<div class="dash-widget-info">
					<h3>0</h3>
					<span>Current Transcations</span>
				</div>
			</div>
		</div>
	</div>
	<div class="row">
		<div class="col-md-12">
			<div class="row">
				<div class="col-md-6 text-center">
					<div class="card-box">
						<h3 class="card-title">Mooring Master Timing</h3>
						<div id="bar-charts"></div>
					</div>
				</div>
				<div class="col-md-6 text-center">
					<div class="card-box">
						<h3 class="card-title">Overall Status</h3>
						<div id="pie-charts"></div>
					</div>
				</div>
			
				
			</div>
		</div>
	</div>
	<!--<div class="row">
		<div class="col-md-6">
			<div class="card card-table">
				<div class="card-header">
					<h3 class="card-title mb-0">Invoices</h3>
				</div>
				<div class="card-body">
					<div class="table-responsive">
						<table class="table table-striped table-nowrap custom-table mb-0">
							<thead>
								<tr>
									<th>Invoice ID</th>
									<th>Client</th>
									<th>Due Date</th>
									<th>Total</th>
									<th>Status</th>
								</tr>
							</thead>
							<tbody>
								<tr>
									<td><a href="invoice-view.html">#INV-0001</a></td>
									<td>
										<h2><a href="#">Global Technologies</a></h2>
									</td>
									<td>11 Mar 2019</td>
									<td>$380</td>
									<td>
										<span class="badge badge-warning-border">Partially Paid</span>
									</td>
								</tr>
								<tr>
									<td><a href="invoice-view.html">#INV-0002</a></td>
									<td>
										<h2><a href="#">Delta Infotech</a></h2>
									</td>
									<td>8 Feb 2019</td>
									<td>$500</td>
									<td>
										<span class="badge badge-success-border">Paid</span>
									</td>
								</tr>
								<tr>
									<td><a href="invoice-view.html">#INV-0003</a></td>
									<td>
										<h2><a href="#">Cream Inc</a></h2>
									</td>
									<td>23 Jan 2019</td>
									<td>$60</td>
									<td>
										<span class="badge badge-danger-border">Unpaid</span>
									</td>
								</tr>
							</tbody>
						</table>
					</div>
				</div>
				<div class="card-footer">
					<a href="invoices.html">View all invoices</a>
				</div>
			</div>
		</div>
		<div class="col-md-6">
			<div class="card card-table">
				<div class="card-header">
					<h3 class="card-title mb-0">Payments</h3>
				</div>
				<div class="card-body">
					<div class="table-responsive">	
						<table class="table table-striped custom-table table-nowrap mb-0">
							<thead>
								<tr>
									<th>Invoice ID</th>
									<th>Client</th>
									<th>Payment Type</th>
									<th>Paid Date</th>
									<th>Paid Amount</th>
								</tr>
							</thead>
							<tbody>
								<tr>
									<td><a href="invoice-view.html">#INV-0001</a></td>
									<td>
										<h2><a href="#">Global Technologies</a></h2>
									</td>
									<td>Paypal</td>
									<td>11 Mar 2019</td>
									<td>$380</td>
								</tr>
								<tr>
									<td><a href="invoice-view.html">#INV-0002</a></td>
									<td>
										<h2><a href="#">Delta Infotech</a></h2>
									</td>
									<td>Paypal</td>
									<td>8 Feb 2019</td>
									<td>$500</td>
								</tr>
								<tr>
									<td><a href="invoice-view.html">#INV-0003</a></td>
									<td>
										<h2><a href="#">Cream Inc</a></h2>
									</td>
									<td>Paypal</td>
									<td>23 Jan 2019</td>
									<td>$60</td>
								</tr>
							</tbody>
						</table>
					</div>
				</div>
				<div class="card-footer">
					<a href="payments.html">View all payments</a>
				</div>
			</div>
		</div>
	</div>
	<div class="row">
		<div class="col-md-6">
			<div class="card card-table">
				<div class="card-header">
					<h3 class="card-title mb-0">Clients</h3>
				</div>
				<div class="card-body">
					<div class="table-responsive">
						<table class="table table-striped custom-table mb-0">
							<thead>
								<tr>
									<th>Name</th>
									<th>Email</th>
									<th>Status</th>
									<th class="text-right">Action</th>
								</tr>
							</thead>
							<tbody>
								<tr>
									<td>
										<h2 class="table-avatar">
											<a href="#" class="avatar"><img alt="" src="<?php echo e(asset('public/assets/img/profiles/avatar-19.jpg')); ?>"></a>
											<a href="client-profile.html">Barry Cuda <span>CEO</span></a>
										</h2>
									</td>
									<td><a href="/cdn-cgi/l/email-protection" class="__cf_email__" data-cfemail="d6b4b7a4a4afb5a3b2b796b3aeb7bba6bab3f8b5b9bb">[email&#160;protected]</a></td>
									<td>
										<div class="dropdown action-label">
											<a class="btn btn-white btn-sm btn-rounded dropdown-toggle" href="#" data-toggle="dropdown" aria-expanded="false">
												<i class="fa fa-dot-circle-o text-success"></i> Active
											</a>
											<div class="dropdown-menu dropdown-menu-right">
												<a class="dropdown-item" href="#"><i class="fa fa-dot-circle-o text-success"></i> Active</a>
												<a class="dropdown-item" href="#"><i class="fa fa-dot-circle-o text-danger"></i> Inactive</a>
											</div>
										</div>
									</td>
									<td class="text-right">
										<div class="dropdown dropdown-action">
											<a href="#" class="action-icon dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><i class="material-icons">more_vert</i></a>
											<div class="dropdown-menu dropdown-menu-right">
												<a class="dropdown-item" href="javascript:void(0)"><i class="fa fa-pencil m-r-5"></i> Edit</a>
												<a class="dropdown-item" href="javascript:void(0)"><i class="fa fa-trash-o m-r-5"></i> Delete</a>
											</div>
										</div>
									</td>
								</tr>
								<tr>
									<td>
										<h2 class="table-avatar">
											<a href="#" class="avatar"><img alt="" src="<?php echo e(asset('public/assets/img/profiles/avatar-19.jpg')); ?>"></a>
											<a href="client-profile.html">Tressa Wexler <span>Manager</span></a>
										</h2>
									</td>
									<td><a href="/cdn-cgi/l/email-protection" class="__cf_email__" data-cfemail="f88c8a9d8b8b998f9d80949d8ab89d80999588949dd69b9795">[email&#160;protected]</a></td>
									<td>
										<div class="dropdown action-label">
											<a class="btn btn-white btn-sm btn-rounded dropdown-toggle" href="#" data-toggle="dropdown" aria-expanded="false">
												<i class="fa fa-dot-circle-o text-danger"></i> Inactive
											</a>
											<div class="dropdown-menu dropdown-menu-right">
												<a class="dropdown-item" href="#"><i class="fa fa-dot-circle-o text-success"></i> Active</a>
												<a class="dropdown-item" href="#"><i class="fa fa-dot-circle-o text-danger"></i> Inactive</a>
											</div>
										</div>
									</td>
									<td class="text-right">
										<div class="dropdown dropdown-action">
											<a href="#" class="action-icon dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><i class="material-icons">more_vert</i></a>
											<div class="dropdown-menu dropdown-menu-right">
												<a class="dropdown-item" href="javascript:void(0)"><i class="fa fa-pencil m-r-5"></i> Edit</a>
												<a class="dropdown-item" href="javascript:void(0)"><i class="fa fa-trash-o m-r-5"></i> Delete</a>
											</div>
										</div>
									</td>
								</tr>
								<tr>
									<td>
										<h2 class="table-avatar">
											<a href="client-profile.html" class="avatar"><img alt="" src="<?php echo e(asset('public/assets/img/profiles/avatar-07.jpg')); ?>"></a>
											<a href="client-profile.html">Ruby Bartlett <span>CEO</span></a>
										</h2>
									</td>
									<td><a href="/cdn-cgi/l/email-protection" class="__cf_email__" data-cfemail="daa8afb8a3b8bba8aeb6bfaeae9abfa2bbb7aab6bff4b9b5b7">[email&#160;protected]</a></td>
									<td>
										<div class="dropdown action-label">
											<a class="btn btn-white btn-sm btn-rounded dropdown-toggle" href="#" data-toggle="dropdown" aria-expanded="false">
												<i class="fa fa-dot-circle-o text-danger"></i> Inactive
											</a>
											<div class="dropdown-menu dropdown-menu-right">
												<a class="dropdown-item" href="#"><i class="fa fa-dot-circle-o text-success"></i> Active</a>
												<a class="dropdown-item" href="#"><i class="fa fa-dot-circle-o text-danger"></i> Inactive</a>
											</div>
										</div>
									</td>
									<td class="text-right">
										<div class="dropdown dropdown-action">
											<a href="#" class="action-icon dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><i class="material-icons">more_vert</i></a>
											<div class="dropdown-menu dropdown-menu-right">
												<a class="dropdown-item" href="javascript:void(0)"><i class="fa fa-pencil m-r-5"></i> Edit</a>
												<a class="dropdown-item" href="javascript:void(0)"><i class="fa fa-trash-o m-r-5"></i> Delete</a>
											</div>
										</div>
									</td>
								</tr>
								<tr>
									<td>
										<h2 class="table-avatar">
											<a href="client-profile.html" class="avatar"><img alt="" src="<?php echo e(asset('public/assets/img/profiles/avatar-06.jpg')); ?>"></a>
											<a href="client-profile.html"> Misty Tison <span>CEO</span></a>
										</h2>
									</td>
									<td><a href="/cdn-cgi/l/email-protection" class="__cf_email__" data-cfemail="aec3c7dddad7dac7ddc1c0eecbd6cfc3dec2cb80cdc1c3">[email&#160;protected]</a></td>
									<td>
										<div class="dropdown action-label">
											<a class="btn btn-white btn-sm btn-rounded dropdown-toggle" href="#" data-toggle="dropdown" aria-expanded="false">
												<i class="fa fa-dot-circle-o text-success"></i> Active
											</a>
											<div class="dropdown-menu dropdown-menu-right">
												<a class="dropdown-item" href="#"><i class="fa fa-dot-circle-o text-success"></i> Active</a>
												<a class="dropdown-item" href="#"><i class="fa fa-dot-circle-o text-danger"></i> Inactive</a>
											</div>
										</div>
									</td>
									<td class="text-right">
										<div class="dropdown dropdown-action">
											<a href="#" class="action-icon dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><i class="material-icons">more_vert</i></a>
											<div class="dropdown-menu dropdown-menu-right">
												<a class="dropdown-item" href="javascript:void(0)"><i class="fa fa-pencil m-r-5"></i> Edit</a>
												<a class="dropdown-item" href="javascript:void(0)"><i class="fa fa-trash-o m-r-5"></i> Delete</a>
											</div>
										</div>
									</td>
								</tr>
								<tr>
									<td>
										<h2 class="table-avatar">
											<a href="client-profile.html" class="avatar"><img alt="" src="<?php echo e(asset('public/assets/img/profiles/avatar-14.jpg')); ?>"></a>
											<a href="client-profile.html"> Daniel Deacon <span>CEO</span></a>
										</h2>
									</td>
									<td><a href="/cdn-cgi/l/email-protection" class="__cf_email__" data-cfemail="3c585d5255595058595d5f53527c59445d514c5059125f5351">[email&#160;protected]</a></td>
									<td>
										<div class="dropdown action-label">
											<a class="btn btn-white btn-sm btn-rounded dropdown-toggle" href="#" data-toggle="dropdown" aria-expanded="false">
												<i class="fa fa-dot-circle-o text-danger"></i> Inactive
											</a>
											<div class="dropdown-menu dropdown-menu-right">
												<a class="dropdown-item" href="#"><i class="fa fa-dot-circle-o text-success"></i> Active</a>
												<a class="dropdown-item" href="#"><i class="fa fa-dot-circle-o text-danger"></i> Inactive</a>
											</div>
										</div>
									</td>
									<td class="text-right">
										<div class="dropdown dropdown-action">
											<a href="#" class="action-icon dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><i class="material-icons">more_vert</i></a>
											<div class="dropdown-menu dropdown-menu-right">
												<a class="dropdown-item" href="javascript:void(0)"><i class="fa fa-pencil m-r-5"></i> Edit</a>
												<a class="dropdown-item" href="javascript:void(0)"><i class="fa fa-trash-o m-r-5"></i> Delete</a>
											</div>
										</div>
									</td>
								</tr>
							</tbody>
						</table>
					</div>
				</div>
				<div class="card-footer">
					<a href="clients.html">View all clients</a>
				</div>
			</div>
		</div>
		<div class="col-md-6">
			<div class="card card-table">
				<div class="card-header">
					<h3 class="card-title mb-0">Recent Projects</h3>
				</div>
				<div class="card-body">
					<div class="table-responsive">
						<table class="table table-striped custom-table mb-0">
							<thead>
								<tr>
									<th>Project Name </th>
									<th>Progress</th>
									<th class="text-right">Action</th>
								</tr>
							</thead>
							<tbody>
								<tr>
									<td>
										<h2><a href="project-view.html">Office Management</a></h2>
										<small class="block text-ellipsis">
											<span class="text-xs">1</span> <span class="text-muted">open tasks, </span>
											<span class="text-xs">9</span> <span class="text-muted">tasks completed</span>
										</small>
									</td>
									<td>
										<div class="progress progress-xs progress-striped">
											<div class="progress-bar bg-success" role="progressbar" data-toggle="tooltip" title="65%" style="width: 65%"></div>
										</div>
									</td>
									<td class="text-right">
										<div class="dropdown dropdown-action">
											<a href="#" class="action-icon dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><i class="material-icons">more_vert</i></a>
											<div class="dropdown-menu dropdown-menu-right">
												<a class="dropdown-item" href="javascript:void(0)"><i class="fa fa-pencil m-r-5"></i> Edit</a>
												<a class="dropdown-item" href="javascript:void(0)"><i class="fa fa-trash-o m-r-5"></i> Delete</a>
											</div>
										</div>
									</td>
								</tr>
								<tr>
									<td>
										<h2><a href="project-view.html">Project Management</a></h2>
										<small class="block text-ellipsis">
											<span class="text-xs">2</span> <span class="text-muted">open tasks, </span>
											<span class="text-xs">5</span> <span class="text-muted">tasks completed</span>
										</small>
									</td>
									<td>
										<div class="progress progress-xs progress-striped">
											<div class="progress-bar bg-success" role="progressbar" data-toggle="tooltip" title="15%" style="width: 15%"></div>
										</div>
									</td>
									<td class="text-right">
										<div class="dropdown dropdown-action">
											<a href="#" class="action-icon dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><i class="material-icons">more_vert</i></a>
											<div class="dropdown-menu dropdown-menu-right">
												<a class="dropdown-item" href="javascript:void(0)"><i class="fa fa-pencil m-r-5"></i> Edit</a>
												<a class="dropdown-item" href="javascript:void(0)"><i class="fa fa-trash-o m-r-5"></i> Delete</a>
											</div>
										</div>
									</td>
								</tr>
								<tr>
									<td>
										<h2><a href="project-view.html">Video Calling App</a></h2>
										<small class="block text-ellipsis">
											<span class="text-xs">3</span> <span class="text-muted">open tasks, </span>
											<span class="text-xs">3</span> <span class="text-muted">tasks completed</span>
										</small>
									</td>
									<td>
										<div class="progress progress-xs progress-striped">
											<div class="progress-bar bg-success" role="progressbar" data-toggle="tooltip" title="49%" style="width: 49%"></div>
										</div>
									</td>
									<td class="text-right">
										<div class="dropdown dropdown-action">
											<a href="#" class="action-icon dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><i class="material-icons">more_vert</i></a>
											<div class="dropdown-menu dropdown-menu-right">
												<a class="dropdown-item" href="javascript:void(0)"><i class="fa fa-pencil m-r-5"></i> Edit</a>
												<a class="dropdown-item" href="javascript:void(0)"><i class="fa fa-trash-o m-r-5"></i> Delete</a>
											</div>
										</div>
									</td>
								</tr>
								<tr>
									<td>
										<h2><a href="project-view.html">Hospital Administration</a></h2>
										<small class="block text-ellipsis">
											<span class="text-xs">12</span> <span class="text-muted">open tasks, </span>
											<span class="text-xs">4</span> <span class="text-muted">tasks completed</span>
										</small>
									</td>
									<td>
										<div class="progress progress-xs progress-striped">
											<div class="progress-bar bg-success" role="progressbar" data-toggle="tooltip" title="88%" style="width: 88%"></div>
										</div>
									</td>
									<td class="text-right">
										<div class="dropdown dropdown-action">
											<a href="#" class="action-icon dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><i class="material-icons">more_vert</i></a>
											<div class="dropdown-menu dropdown-menu-right">
												<a class="dropdown-item" href="javascript:void(0)"><i class="fa fa-pencil m-r-5"></i> Edit</a>
												<a class="dropdown-item" href="javascript:void(0)"><i class="fa fa-trash-o m-r-5"></i> Delete</a>
											</div>
										</div>
									</td>
								</tr>
								<tr>
									<td>
										<h2><a href="project-view.html">Digital Marketplace</a></h2>
										<small class="block text-ellipsis">
											<span class="text-xs">7</span> <span class="text-muted">open tasks, </span>
											<span class="text-xs">14</span> <span class="text-muted">tasks completed</span>
										</small>
									</td>
									<td>
										<div class="progress progress-xs progress-striped">
											<div class="progress-bar bg-success" role="progressbar" data-toggle="tooltip" title="100%" style="width: 100%"></div>
										</div>
									</td>
									<td class="text-right">
										<div class="dropdown dropdown-action">
											<a href="#" class="action-icon dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><i class="material-icons">more_vert</i></a>
											<div class="dropdown-menu dropdown-menu-right">
												<a class="dropdown-item" href="javascript:void(0)"><i class="fa fa-pencil m-r-5"></i> Edit</a>
												<a class="dropdown-item" href="javascript:void(0)"><i class="fa fa-trash-o m-r-5"></i> Delete</a>
											</div>
										</div>
									</td>
								</tr>
							</tbody>
						</table>
					</div>
				</div>
				<div class="card-footer">
					<a href="projects.html">View all projects</a>
				</div>
			</div>
		</div>
	</div>-->
</div>
<?php /**PATH D:\php7\htdocs\laravel\CME\resources\views/content/dashboard.blade.php ENDPATH**/ ?>