                <div class="content container-fluid">
				
					<!-- Page Title -->
					<div class="row">
						<div class="col">
							<h4 class="page-title">Client List</h4>
						</div>
						<div class="col-12 text-right m-b-30">
							<a href="#" class="btn add-btn" data-toggle="modal" data-target="#add_todaywork"><i class="fa fa-plus"></i> Add Today Work</a>
						</div>
					</div>
					<!-- /Page Title -->
					
					<div class="row">
						<div class="col-md-12">
							<div class="table-responsive">
								<table class="table table-striped custom-table mb-0 datatable">
									<thead>
										<tr>
											<th>S.No</th>
											<th>Client Name</th>
											<th>Status</th>
										</tr>
									</thead>
									<tbody>
										<tr>
											<td>
												<h2 class="table-avatar">
													<a href="profile.html" class="avatar"><img alt="" src="assets\img\profiles\avatar-02.jpg"></a>
													<a href="profile.html">John Doe <span>Web Designer</span></a>
												</h2>
											</td>
											<td>8 Mar 2019</td>
											<td>
												<h2>Office Management</h2>
											</td>
											
										</tr>
									</tbody>
								</table>
							</div>
						</div>
					</div>
                </div>
				<!-- /Page Content -->
				
				<!-- Add Today Work Modal -->
				<div id="add_todaywork" class="modal custom-modal fade" role="dialog">
					<div class="modal-dialog modal-dialog-centered modal-lg" role="document">
						<div class="modal-content">
							<div class="modal-header">
								<h5 class="modal-title">Add Today Work details</h5>
								<button type="button" class="close" data-dismiss="modal" aria-label="Close">
									<span aria-hidden="true">&times;</span>
								</button>
							</div>
							<div class="modal-body">
								<form>
									<div class="row">
										<div class="form-group col-sm-6">
											<label>Project <span class="text-danger">*</span></label>
											<select class="select">
												<option>Office Management</option>
												<option>Project Management</option>
												<option>Video Calling App</option>
												<option>Hospital Administration</option>
											</select>
										</div>
									</div>
									<div class="row">
										<div class="form-group col-sm-4">
											<label>Deadline <span class="text-danger">*</span></label>
											<div class="cal-icon">
												<input class="form-control" type="text" value="5 May 2019" readonly="">
											</div>
										</div>
										<div class="form-group col-sm-4">
											<label>Total Hours <span class="text-danger">*</span></label>
											<input class="form-control" type="text" value="100" readonly="">
										</div>
										<div class="form-group col-sm-4">
											<label>Remaining Hours <span class="text-danger">*</span></label>
											<input class="form-control" type="text" value="60" readonly="">
										</div>
									</div>
									<div class="row">
										<div class="form-group col-sm-6">
											<label>Date <span class="text-danger">*</span></label>
											<div class="cal-icon">
												<input class="form-control datetimepicker" type="text">
											</div>
										</div>
										<div class="form-group col-sm-6">
											<label>Hours <span class="text-danger">*</span></label>
											<input class="form-control" type="text">
										</div>
									</div>
									<div class="form-group">
										<label>Description <span class="text-danger">*</span></label>
										<textarea rows="4" class="form-control"></textarea>
									</div>
									<div class="submit-section">
										<button class="btn btn-primary submit-btn">Submit</button>
									</div>
								</form>
							</div>
						</div>
					</div>
				</div>
				<!-- /Add Today Work Modal -->
				
				<!-- Edit Today Work Modal -->
				<div id="edit_todaywork" class="modal custom-modal fade" role="dialog">
					<div class="modal-dialog modal-dialog-centered modal-lg" role="document">
						<div class="modal-content">
							<div class="modal-header">
								<h5 class="modal-title">Edit Work Details</h5>
								<button type="button" class="close" data-dismiss="modal" aria-label="Close">
									<span aria-hidden="true">&times;</span>
								</button>
							</div>
							<div class="modal-body">
								<form>
									<div class="row">
										<div class="form-group col-sm-6">
											<label>Project <span class="text-danger">*</span></label>
											<select class="select">
												<option>Office Management</option>
												<option>Project Management</option>
												<option>Video Calling App</option>
												<option>Hospital Administration</option>
											</select>
										</div>
									</div>
									<div class="row">
										<div class="form-group col-sm-4">
											<label>Deadline <span class="text-danger">*</span></label>
											<div class="cal-icon">
												<input class="form-control" type="text" value="5 May 2019" readonly="">
											</div>
										</div>
										<div class="form-group col-sm-4">
											<label>Total Hours <span class="text-danger">*</span></label>
											<input class="form-control" type="text" value="100" readonly="">
										</div>
										<div class="form-group col-sm-4">
											<label>Remaining Hours <span class="text-danger">*</span></label>
											<input class="form-control" type="text" value="60" readonly="">
										</div>
									</div>
									<div class="row">
										<div class="form-group col-sm-6">
											<label>Date <span class="text-danger">*</span></label>
											<div class="cal-icon">
												<input class="form-control datetimepicker" value="03/03/2019" type="text">
											</div>
										</div>
										<div class="form-group col-sm-6">
											<label>Hours <span class="text-danger">*</span></label>
											<input class="form-control" type="text" value="9">
										</div>
									</div>
									<div class="form-group">
										<label>Description <span class="text-danger">*</span></label>
										<textarea rows="4" class="form-control">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec vel elit neque.</textarea>
									</div>
									<div class="submit-section">
										<button class="btn btn-primary submit-btn">Save</button>
									</div>
								</form>
							</div>
						</div>
					</div>
				</div>
				<!-- /Edit Today Work Modal -->
				
				<!-- Delete Today Work Modal -->
				<div class="modal custom-modal fade" id="delete_workdetail" role="dialog">
					<div class="modal-dialog modal-dialog-centered">
						<div class="modal-content">
							<div class="modal-body">
								<div class="form-header">
									<h3>Delete Work Details</h3>
									<p>Are you sure want to delete?</p>
								</div>
								<div class="modal-btn delete-action">
									<div class="row">
										<div class="col-6">
											<a href="javascript:void(0);" class="btn btn-primary continue-btn">Delete</a>
										</div>
										<div class="col-6">
											<a href="javascript:void(0);" data-dismiss="modal" class="btn btn-primary cancel-btn">Cancel</a>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
				<!-- Delete Today Work Modal -->

<script>
// Datatable

	if($('.datatable').length > 0) {
		$('.datatable').DataTable({
			"bFilter": true,
		});
	}
</script>