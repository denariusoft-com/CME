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
							<h4 class="page-title">Pilotage Summary Report</h4>
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
								<table id="pilotagesummary_datatable_list" class="table table-striped custom-table mb-0 datatable">
									<thead>
										<tr>
											<th>S. No</th>
											<th>Date</th>
											<th>SHIP NAME</th>
											<th>JOB DESCRIPTION</th>
											<th>PILOT</th>
											<th>RATE (SGD)</th>
											<th>NO REF</th>
											<th>STATUS</th>
											<th>Action</th>
											
										</tr>
									</thead>
									<tbody>
										<tr>
											<td></td>
											<td></td>
											<td></td>
											<td></td>
											<td></td>
											<td></td>
											<td></td>
											<td></td>
											<td></td>
										</tr>
									</tbody>
								</table>
							</div>
						</div>
					</div>
                </div>
				<!-- /Page Content -->
				<script type="text/javascript">
				$(document).ready(function() {
					 var table = $('#pilotagesummary_datatable_list').DataTable( {
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
					.appendTo( '#pilotagesummary_datatable_list .col-md-6:eq(0)' );
				} );
// Datatable	

				</script>			