<!-- Plugin Custom Stylesheet -->
<link rel="stylesheet" href="{{ asset('public/assets/form-wizard-blue.css') }}">
<link href="{{ asset('public/assets/css/inputmask.css') }}" rel="stylesheet" type="text/css">
<!-- Plugin Custom JS -->
<script src="{{ asset('public/assets/form-wizard.js') }}"></script>	

<style type="text/css" media="screen">
	.header-button-group, .body-button-group {
		float: left;
		width: 100%;
		height: auto;
		display: block;
		text-align: center;
		overflow: hidden;
	}

	.header-button-group h2, .body-button-group h2{
		font-size: 20px;
		color: #2b2b2b;
		text-transform: uppercase;
		padding: 8px 0;
	}

	.header-button-group button, .body-button-group button{
		background: #6753D8;
		padding: 7px 15px;
		color: #fff;
		font-weight: 500;
		text-transform: uppercase;
	}
</style>
	
<div class="content container-fluid">
				
					<!-- Page Title -->
					<div class="row">
						<div class="col">
							<h4 class="page-title">Time Sheet</h4>
						</div>
						<!--div class="col-12 text-right m-b-30">
							<a href="{{ route('ratemasters.index')}}" class="btn add-btn" ><i class="fa fa-list"></i> List </a>
						</div-->
					</div>
					<!-- /Page Title -->
					<div class="row">
						<div class="col-md-12">
							<!-- main content -->
        <section class="form-box">
            <div class="container">
                
                <div class="row">
                    <div class="col-sm-12 col-md-12 col-lg-12 ">
					
						<!-- Form Wizard -->
						<div class="form-wizard form-header-classic form-body-stylist">
						
                    	<form role="form" action="{{ URL::to('timesheet/timesheet_save') }}" method="post" id="timesheet_add_edit_validation">
							@csrf
							<input type="hidden" name="id" />
                    		<!--h3>Sign Up Your Bank Account</h3-->
                    		<p>Fill all field to go next step</p>
							
							<!-- Form progress -->
                    		<div class="form-wizard-steps form-wizard-tolal-steps-4">
                    			<div class="form-wizard-progress">
                    			    <div class="form-wizard-progress-line" data-now-value="10.00" data-number-of-steps="5" style="width: 10.00%;"></div>
                    			</div>
								<!-- Step 1 -->
                    			<div class="form-wizard-step active">
                    				<div class="form-wizard-step-icon"><i class="fa fa-user" aria-hidden="true"></i></div>
                    				<p>General</p>
                    			</div>
								<!-- Step 1 -->
								
								<!-- Step 2 -->
                    			<div class="form-wizard-step">
                    				<div class="form-wizard-step-icon"><i class="fa fa-user" aria-hidden="true"></i></div>
                    				<p>Timings</p>
                    			</div>
								<!-- Step 2 -->
								
								<!-- Step 3 -->
                    		    <div class="form-wizard-step">
                    				<div class="form-wizard-step-icon"><i class="fa fa-university" aria-hidden="true"></i></div>
                    				<p>Mooring</p>
                    			</div>
								<!-- Step 3 -->
								
								<!-- Step 4 -->
								<div class="form-wizard-step">
                    				<div class="form-wizard-step-icon"><i class="fa fa-file-text" aria-hidden="true"></i></div>
                    				<p>Un Mooring</p>
                    			</div>
								<!-- Step 4 -->
								
								<!-- Step 5 -->
								<div class="form-wizard-step">
                    				<div class="form-wizard-step-icon"><i class="fa fa-file-text" aria-hidden="true"></i></div>
                    				<p>Additional Info</p>
                    			</div>
								<!-- Step 5 -->
								
                    		</div>
							<!-- Form progress -->
                    		
							
							<!-- Form Step 1 -->
                    		<fieldset>
								<!-- Progress Bar -->
								<div class="progress">
								  <div class="progress-bar progress-bar-striped active" role="progressbar" aria-valuenow="20" aria-valuemin="0" aria-valuemax="100" style="width: 20%">
								  </div>
								</div>
								<!-- Progress Bar -->
                    		    <h4>General Information: <span>Step 1 - 4</span></h4>
                    			<div class="form-group col-md-4">
                    			    <label></label>                                 
									
                                </div>    
								<div class="form-group col-md-4">
                    			   <!-- <label>Client Name: <span>*</span></label>
                                    <select name="general[client_id]" id="client_id" class="form-control required">
										 <option value="">Select name</option>
										 @foreach($data['user_view'] as $row)
										 <option value="{{ $row->id}}">{{ $row->name }}</option>
										 @endforeach
									</select>
									-->
                                </div>     
								<div class="row">
									<div class="col-md-6">
										<div class="form-group">
										<label>STS Superintendent: <span>*</span></label>
										<select name="general[user_id]" id="user_id" class="form-control required">
										 <option value="">Select name</option>
										 @foreach($data['user_view'] as $row)
										 <option value="{{ $row->id}}">{{ $row->name }}</option>
										 @endforeach
									</select>
										</div>
									</div>
									<div class="col-md-6">
										<div class="form-group">
										<label>Client Name: <span>*</span></label>
										<select name="general[client_id]" id="client_id" class="form-control required">
										 <option value="">Select Client Name</option>
										 @foreach($data['client'] as $row)
										 <option value="{{ $row->id}}">{{ $row->client_name }}</option>
										 @endforeach
									</select>
											</div>
									</div>
								</div>                    
								<div class="row">
									<div class="col-md-6">
										<div class="form-group">
											<label>Location: <span>*</span></label>
											<input type="text" name="general[location]" id="location" placeholder="Enter location" class="form-control ">
										</div>
									</div>
									<div class="col-md-6">
										<div class="form-group">
											<label>Job Ref Number: <span>*</span></label>
											<input type="text" name="general[job_ref_id]" id="job_ref_id" placeholder="Enter job reference number" class="form-control ">
										</div>
									</div>
								</div>
								<div class="row">
									<div class="col-md-6">
										<div class="form-group">
											<label>Mother V/L: <span>*</span></label>
											<input type="text" name="general[mother_vessel]" id="mother_vessel" placeholder="Enter mother V/L" class="form-control required">
										</div>
									</div>
									<div class="col-md-6">
										<div class="form-group">
											<label>SDWT: <span>*</span></label>
											<input type="text" name="general[mother_sdwt]" id="mother_sdwt" placeholder="Enter SDWT" class="form-control ">
										</div>
									</div>
								</div>
								<div class="row">
									<div class="col-md-6">
										<div class="form-group">
											<label>LOA: <span>*</span></label>
											<input type="text" name="general[mother_loa]" id="mother_loa" placeholder="Enter LOA" class="form-control ">
										</div>
									</div>
									<div class="col-md-6">
										<div class="form-group">
											<label>Anchored / NORT: <span>*</span></label>
											<input type="text" name="general[anchored_nort]" id="anchored_nort" placeholder="Enter NORT" class="form-control ">
										</div>
									</div>
								</div>
								<div class="row">
									<div class="col-md-6">
										<div class="form-group">
											<label>Manoeuvring V/L: <span>*</span></label>
											<input type="text" name="general[maneuvring_vessel]" id="maneuvring_vessel" placeholder="Enter Manoeuvring V/L" class="form-control required">
										</div>
									</div>
									<div class="col-md-6">
										<div class="form-group">
											<label>SDWT: <span>*</span></label>
											<input type="text" name="general[manoeuvring_sdwt]" id="manoeuvring_sdwt" placeholder="Enter SDWT" class="form-control ">
										</div>
									</div>
								</div>
								<div class="row">
									<div class="col-md-6">
										<div class="form-group">
											<label>LOA: <span>*</span></label>
											<input type="text" name="general[manoeuvring_loa]" id="manoeuvring_loa" placeholder="Enter LOA" class="form-control ">
										</div>
									</div>
									<div class="col-md-6">
										<div class="form-group">
											<label>Arrival / NORT: <span>*</span></label>
											<input type="text" name="general[arrival_nort]" id="arrival_nort" placeholder="Enter Arrival NORT" class="form-control dt-masktext">
										</div>
									</div>
								</div>
								<div class="row">
									<div class="col-md-6">
										<div class="form-group">
											<label>Max Draft In: <span>*</span></label>
											<input type="datetime" pattern="(0[0-9]|1[0-9]|2[0-3])(:[0-5][0-9]){2}" name="general[maneuvring_max_draft_in]" id="maneuvring_max_draft_in" placeholder="Enter Max Draft In" class="form-control ">
										</div>
									</div>
									<div class="col-md-6">
										<div class="form-group">
											<label>Out: <span>*</span></label>
											<input type="text" name="general[maneuvring_max_draft_out]" id="maneuvring_max_draft_out" placeholder="Enter Max Draft Out" class="form-control ">
										</div>
									</div>
								</div>
								<div class="row">
									<div class="col-md-6">
										<div class="form-group">
											<label>Date / Time Onboard (IN): <span>*</span></label>
											<input type="text" name="general[dt_onboard_in]" id="dt_onboard_in" placeholder="Choose Onboard" class="form-control required dt-masktext">
										</div>
									</div>
									<div class="col-md-6">
										<div class="form-group">
											<label>Date / Time Disembark (OUT): <span>*</span></label>
											<input type="text" name="general[dt_disembark_out]" id="dt_disembark_out" placeholder="Choose Disembark" class="form-control required  dt-masktext">
										</div>
									</div>
								</div>
								<div class="row">
									<div class="col-md-6">
										<div class="form-group">
											<label>Cargo: <span>*</span></label>
											<input type="text" name="general[cargo]" id="cargo" placeholder="Enter cargo name" class="form-control ">
										</div>
									</div>
									<div class="col-md-6">
										<div class="form-group">
											<label>FSU or SPOT: <span>*</span></label>
											<input type="text" name="general[client_fsu_spot]" id="client_fsu_spot" placeholder="Enter FSU or SPOT" class="form-control ">
										</div>
									</div>
								</div>
                                <div class="form-wizard-buttons">
                                    <button type="button" class="btn btn-next">Next</button>
                                </div>
                            </fieldset>
							<!-- Form Step 1 -->

							
							<!-- Form Step 2 -->
                            <fieldset>
								<!-- Progress Bar -->
								<div class="progress">
								  <div class="progress-bar progress-bar-striped active" role="progressbar" aria-valuenow="40" aria-valuemin="0" aria-valuemax="100" style="width: 40%">
								  </div>
								</div>
								<!-- Progress Bar -->
                                <h4>Operational Information : <span>Step 2 - 4</span></h4>
								<div class="form-group">&nbsp;</div>
								<div class="row">
									<div class="col-md-4">
										<div class="form-group">
											<label>Support Craft Transit Start: <span>*</span></label>
											<input type="text" name="oper[support_craft_transit_start]" id="support_craft_transit_start" placeholder="Support Craft Transit Start" class="form-control dt-masktext">
										</div>
									</div>
									<div class="col-md-4">
										<div class="form-group">
											<label>Support Craft Transit Finish: <span>*</span></label>
											<input type="text" name="oper[support_craft_transit_finish]" id="support_craft_transit_finish" placeholder="Support Craft Transit Finish" class="form-control dt-masktext">
										</div>
									</div>
									<div class="col-md-4">
										<div class="form-group">
											<label>Support Craft Transit Notes: <span>*</span></label>
											<input type="text" name="oper[support_craft_transit_notes]" id="support_craft_transit_notes" placeholder="Support Craft Transit Notes" class="form-control dt-masktext">
										</div>
									</div>
								</div>
								<div class="row">
									<div class="col-md-4">
										<div class="form-group">
											<label>Fendering Start: <span>*</span></label>
											<input type="text" name="oper[fendering_start]" id="fendering_start" placeholder="Fendering Start" class="form-control dt-masktext">
										</div>
									</div>
									<div class="col-md-4">
										<div class="form-group">
											<label>Fendering Finish: <span>*</span></label>
											<input type="text" name="oper[fendering_finish]" id="fendering_finish" placeholder="Fendering Finish" class="form-control dt-masktext">
										</div>
									</div>
									<div class="col-md-4">
										<div class="form-group">
											<label>Fendering Notes: <span>*</span></label>
											<input type="text" name="oper[fendering_notes]" id="fendering_notes" placeholder="Fendering Notes" class="form-control dt-masktext">
										</div>
									</div>
								</div>
								<div class="row">
									<div class="col-md-4">
										<div class="form-group">
											<label>Checklist2 Start: <span>*</span></label>
											<input type="text" name="oper[checklist2_start]" id="checklist2_start" placeholder="Checklist2 Start" class="form-control dt-masktext">
										</div>
									</div>
									<div class="col-md-4">
										<div class="form-group">
											<label>Checklist2 Finish: <span>*</span></label>
											<input type="text" name="oper[checklist2_finish]" id="checklist2_finish" placeholder="Checklist2 Finish" class="form-control dt-masktext">
										</div>
									</div>
									<div class="col-md-4">
										<div class="form-group">
											<label>Checklist2 Notes: <span>*</span></label>
											<input type="text" name="oper[checklist2_notes]" id="checklist2_notes" placeholder="Checklist2 Notes" class="form-control dt-masktext">
										</div>
									</div>
								</div>
								<div class="row">
									<div class="col-md-4">
										<div class="form-group">
											<label>Checklist3 Start: <span>*</span></label>
											<input type="text" name="oper[checklist3_start]" id="checklist3_start" placeholder="Checklist3 Start" class="form-control dt-masktext">
										</div>
									</div>
									<div class="col-md-4">
										<div class="form-group">
											<label>Checklist3 Finish: <span>*</span></label>
											<input type="text" name="oper[checklist3_finish]" id="checklist3_finish" placeholder="Checklist3 Finish" class="form-control dt-masktext">
										</div>
									</div>
									<div class="col-md-4">
										<div class="form-group">
											<label>Checklist3 Notes: <span>*</span></label>
											<input type="text" name="oper[checklist3_notes]" id="checklist3_notes" placeholder="Checklist3 Notes" class="form-control dt-masktext">
										</div>
									</div>
								</div>
								
								<div style="clear:both;"></div>
                                <div class="form-wizard-buttons">
                                    <button type="button" class="btn btn-previous">Previous</button>
                                    <button type="button" class="btn btn-next">Next</button>
                                </div>
                            </fieldset>
							<!-- Form Step 2 -->

							
							<!-- Form Step 3 -->
                            <fieldset>
								<!-- Progress Bar -->
								<div class="progress">
								  <div class="progress-bar progress-bar-striped active" role="progressbar" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100" style="width: 60%">
								  </div>
								</div>
								<!-- Progress Bar -->
                                <h4>Mooring Information: <span>Step 3 - 4</span></h4>
                                <div class="form-group">&nbsp;</div>
								<div class="row">
									<div class="col-md-4">
										<div class="form-group">
											<label>Mooring First Line: <span>*</span></label>
											<input type="text" name="oper[mooring_firstline]" id="mooring_firstline" placeholder="Mooring First Line" class="form-control dt-masktext">
										</div>
									</div>
									<div class="col-md-4">
										<div class="form-group">
											<label>Mooring All Fast: <span>*</span></label>
											<input type="text" name="oper[mooring_allfast]" id="mooring_allfast" placeholder="Mooring All Fast" class="form-control dt-masktext">
										</div>
									</div>
									<div class="col-md-4">
										<div class="form-group">
											<label>Mooring NOR Accepted: <span>*</span></label>
											<input type="text" name="oper[mooring_noraccepted]" id="mooring_noraccepted" placeholder="Mooring NOR Accepted" class="form-control dt-masktext">
										</div>
									</div>
								</div>
								<h3 style="line-height: 60px;font-size: 20px;font-weight: bold;">Tugs Used : </h3>
								<div class="row">
									<div class="col-md-12">
										<div class="table-responsive">
											<table class="table table-bordered table_mooring review-table" id="table_achievements" style="width:100%">
												<thead>
													<tr>
														<th>Tugs Name</th>
														<th>Tugs First Line</th>
														<th>Tugs All Fast</th>
														<th>Nor Accepted</th>
														<th style="width: 64px;"><button type="button" class="btn btn-primary btn_row_mooring"><i class="fa fa-plus"></i></button></th>
													</tr>
												</thead>
												<tbody id="table_achievements_tbody">
													<tr>
														<td>
															<input type="text" class="form-control" name="mooring['mr_tug_name']" id="mr_tug_name">
														</td>
														<td>
															<input type="text" class="form-control" name="mooring['mr_tug_firstline']" id="mr_tug_firstline">
														</td>
														<td><input type="text" class="form-control" name="mooring['mr_tug_allfast']" id="mr_tug_allfast"></td>
														<td><input type="text" class="form-control" name="mooring['mr_tug_noraccepted']" id="mr_tug_noraccepted"></td>
														<td></td>
													</tr>
												</tbody>
											</table>
										</div>
									</div>
								</div>
								<div class="row">
									<div class="col-md-4">
										<div class="form-group">
											<label>Hose Connection First Line: <span>*</span></label>
											<input type="text" name="hose_con_fl" id="hose_con_fl" placeholder="Hose Connection First Line" class="form-control dt-masktext">
										</div>
									</div>
									<div class="col-md-4">
										<div class="form-group">
											<label>Hose Connection All Fast: <span>*</span></label>
											<input type="text" name="hose_con_af" id="hose_con_af" placeholder="Hose Connection All Fast" class="form-control dt-masktext">
										</div>
									</div>
									<div class="col-md-4">
										<div class="form-group">
											<label>Hose Connection NOR Accepted: <span>*</span></label>
											<input type="text" name="hose_con_na" id="hose_con_na" placeholder="Hose Connection NOR Accepted" class="form-control dt-masktext">
										</div>
									</div>
								</div>
								<div class="row">
									<div class="col-md-4">
										<div class="form-group">
											<label>Gauging ETC First Line: <span>*</span></label>
											<input type="text" name="con_gauge_etc_fl" id="con_gauge_etc_fl" placeholder="Gauging ETC First Line" class="form-control dt-masktext">
										</div>
									</div>
									<div class="col-md-4">
										<div class="form-group">
											<label>Gauging ETC All Fast: <span>*</span></label>
											<input type="text" name="con_gauge_etc_af" id="con_gauge_etc_af" placeholder="Gauging ETC All Fast" class="form-control dt-masktext">
										</div>
									</div>
									<div class="col-md-4">
										<div class="form-group">
											<label>Gauging ETC NOR Accepted: <span>*</span></label>
											<input type="text" name="con_gauge_etc_na" id="con_gauge_etc_na" placeholder="Gauging ETC NOR Accepted" class="form-control dt-masktext">
										</div>
									</div>
								</div>
								<div class="row">
									<div class="col-md-4">
										<div class="form-group">
											<label>Checklist4 First Line: <span>*</span></label>
											<input type="text" name="checklist4_fl" id="checklist4_fl" placeholder="Checklist4 First Line" class="form-control dt-masktext">
										</div>
									</div>
									<div class="col-md-4">
										<div class="form-group">
											<label>Checklist4 All Fast: <span>*</span></label>
											<input type="text" name="checklist4_af" id="checklist4_af" placeholder="Checklist4 All Fast" class="form-control dt-masktext">
										</div>
									</div>
									<div class="col-md-4">
										<div class="form-group">
											<label>Checklist4 NOR Accepted: <span>*</span></label>
											<input type="text" name="checklist4_na" id="checklist4_na" placeholder="Checklist4 NOR Accepted" class="form-control dt-masktext">
										</div>
									</div>
								</div>
								<div class="row">
									<div class="col-md-4">
										<div class="form-group">
											<label>Cargo Operations First Line: <span>*</span></label>
											<input type="text" name="cargo_oper_fl" id="cargo_oper_fl" placeholder="Cargo Operations First Line" class="form-control dt-masktext">
										</div>
									</div>
									<div class="col-md-4">
										<div class="form-group">
											<label>Cargo Operations All Fast: <span>*</span></label>
											<input type="text" name="cargo_oper_af" id="cargo_oper_af" placeholder="Cargo Operations All Fast" class="form-control dt-masktext">
										</div>
									</div>
									<div class="col-md-4">
										<div class="form-group">
											<label>Cargo Operations NOR Accepted: <span>*</span></label>
											<input type="text" name="cargo_oper_na" id="cargo_oper_na" placeholder="Cargo Operations NOR Accepted" class="form-control dt-masktext">
										</div>
									</div>
								</div>
								<div class="row">
									<div class="col-md-4">
										<div class="form-group">
											<label>Hose Disconnection First Line: <span>*</span></label>
											<input type="text" name="hose_discon_fl" id="hose_discon_fl" placeholder="Hose Disconnection First Line" class="form-control dt-masktext">
										</div>
									</div>
									<div class="col-md-4">
										<div class="form-group">
											<label>Hose Disconnection All Fast: <span>*</span></label>
											<input type="text" name="hose_discon_af" id="hose_discon_af" placeholder="Hose Disconnection All Fast" class="form-control dt-masktext">
										</div>
									</div>
									<div class="col-md-4">
										<div class="form-group">
											<label>Hose Disconnection NOR Accepted: <span>*</span></label>
											<input type="text" name="hose_discon_na" id="hose_discon_na" placeholder="Hose Disconnection NOR Accepted" class="form-control dt-masktext">
										</div>
									</div>
								</div>
								<div class="row">
									<div class="col-md-4">
										<div class="form-group">
											<label>Gauging ETC First Line: <span>*</span></label>
											<input type="text" name="discon_gauge_etc_fl" id="discon_gauge_etc_fl" placeholder="Disconnection Gauging ETC First Line" class="form-control dt-masktext">
										</div>
									</div>
									<div class="col-md-4">
										<div class="form-group">
											<label>Gauging ETC All Fast: <span>*</span></label>
											<input type="text" name="discon_gauge_etc_af" id="discon_gauge_etc_af" placeholder="Disconnection Gauging ETC All Fast" class="form-control dt-masktext">
										</div>
									</div>
									<div class="col-md-4">
										<div class="form-group">
											<label>Gauging ETC NOR Accepted: <span>*</span></label>
											<input type="text" name="discon_gauge_etc_na" id="discon_gauge_etc_na" placeholder="Disconnection Gauging ETC NOR Accepted" class="form-control dt-masktext">
										</div>
									</div>
								</div>
								<div class="row">
									<div class="col-md-4">
										<div class="form-group">
											<label>Checklist5 First Line: <span>*</span></label>
											<input type="text" name="checklist5_fl" id="checklist5_fl" placeholder="Checklist5 First Line" class="form-control dt-masktext">
										</div>
									</div>
									<div class="col-md-4">
										<div class="form-group">
											<label>Checklist5 All Fast: <span>*</span></label>
											<input type="text" name="checklist5_af" id="checklist5_af" placeholder="Checklist5 All Fast" class="form-control dt-masktext">
										</div>
									</div>
									<div class="col-md-4">
										<div class="form-group">
											<label>Checklist5 NOR Accepted: <span>*</span></label>
											<input type="text" name="checklist5_na" id="checklist5_na" placeholder="Checklist5 NOR Accepted" class="form-control dt-masktext">
										</div>
									</div>
								</div>
								<br/>
                                <div class="form-wizard-buttons">
                                    <button type="button" class="btn btn-previous">Previous</button>
                                    <button type="button" class="btn btn-next">Next</button>
                                </div>
                            </fieldset>
							<!-- Form Step 3 -->
							
							
							<!-- Form Step 4 -->
							<fieldset>
								<!-- Progress Bar -->
								<div class="progress">
								  <div class="progress-bar progress-bar-striped active" role="progressbar" aria-valuenow="80" aria-valuemin="0" aria-valuemax="100" style="width: 80%">
								  </div>
								</div>
								<!-- Progress Bar -->
                                <h4>Unmooring Information: <span>Step 3 - 4</span></h4>
                                <div class="form-group">&nbsp;</div>
								<div class="row">
									<div class="col-md-4">
										<div class="form-group">
											<label>Unmooring First Line: <span>*</span></label>
											<input type="text" name="oper['mooring_firstline']" id="mooring_firstline" placeholder="Unmooring First Line" class="form-control dt-masktext">
										</div>
									</div>
									<div class="col-md-4">
										<div class="form-group">
											<label>Unmooring All Fast: <span>*</span></label>
											<input type="text" name="oper['mooring_allfast']" id="mooring_allfast" placeholder="Unmooring All Fast" class="form-control dt-masktext">
										</div>
									</div>
									<div class="col-md-4">
										<div class="form-group">
											<label>Unmooring NOR Accepted: <span>*</span></label>
											<input type="text" name="oper['mooring_noraccepted']" id="mooring_noraccepted" placeholder="Unmooring NOR Accepted" class="form-control dt-masktext">
										</div>
									</div>
								</div>
								<div class="row">
									<div class="col-md-12">
										<div class="table-responsive">
											<table class="table table-bordered table_unmooring review-table" id="table_achievements_unmooring" style="width:100%">
												<thead>
													<tr>
														<th>Tugs Name</th>
														<th>Tugs First Line</th>
														<th>Tugs All Fast</th>
														<th>Nor Accepted</th>
														<th style="width: 64px;"><button type="button" class="btn btn-primary btn_add_row_unmooring"><i class="fa fa-plus"></i></button></th>
													</tr>
												</thead>
												<tbody id="table_achievements_tbody_unmooring">
													<tr>
														<td>
															<input type="text" class="form-control" name="unmooring['unmr_tug_name']" id="unmr_tug_name">
														</td>
														<td>
															<input type="text" class="form-control" name="unmooring['unmr_tug_fl']" id="unmr_tug_fl">
														</td>
														<td><input type="text" class="form-control" name="unmooring['unmr_tug_af']" id="unmr_tug_af"></td>
														<td><input type="text" class="form-control" name="unmooring['unmr_tug_na']" id="unmr_tug_na"></td>
														<td></td>
													</tr>
												</tbody>
											</table>
										</div>
									</div>
								</div>
								<div class="row">
									<div class="col-md-4">
										<div class="form-group">
											<label>Unfendering First Line: <span>*</span></label>
											<input type="text" name="unfendering_fl" id="unfendering_fl" placeholder="Unfendering First Line" class="form-control dt-masktext">
										</div>
									</div>
									<div class="col-md-4">
										<div class="form-group">
											<label>Unfendering All Fast: <span>*</span></label>
											<input type="text" name="unfendering_af" id="unfendering_af" placeholder="Unfendering All Fast" class="form-control dt-masktext">
										</div>
									</div>
									<div class="col-md-4">
										<div class="form-group">
											<label>Unfendering NOR Accepted: <span>*</span></label>
											<input type="text" name="unfendering_na" id="unfendering_na" placeholder="Unfendering NOR Accepted" class="form-control dt-masktext">
										</div>
									</div>
								</div>
								<div class="row">
									<div class="col-md-4">
										<div class="form-group">
											<label>SCT First Line: <span>*</span></label>
											<input type="text" name="unmr_support_craft_fl" id="unmr_support_craft_fl" placeholder="Support Craft Transit First Line" class="form-control dt-masktext">
										</div>
									</div>
									<div class="col-md-4">
										<div class="form-group">
											<label>SCT All Fast: <span>*</span></label>
											<input type="text" name="unmr_support_craft_af" id="unmr_support_craft_af" placeholder="Support Craft Transit All Fast" class="form-control dt-masktext">
										</div>
									</div>
									<div class="col-md-4">
										<div class="form-group">
											<label>SCT NOR Accepted: <span>*</span></label>
											<input type="text" name="unmr_support_craft_na" id="unmr_support_craft_na" placeholder="Support Craft Transit NOR Accepted" class="form-control dt-masktext">
										</div>
									</div>
								</div>
								<div class="row">
									<div class="col-md-4">
										<div class="form-group">
											<label>Rigging Ashore First Line: <span>*</span></label>
											<input type="text" name="rigging_ashore_fl" id="rigging_ashore_fl" placeholder="Rigging Ashore First Line" class="form-control dt-masktext">
										</div>
									</div>
									<div class="col-md-4">
										<div class="form-group">
											<label>Rigging Ashore All Fast: <span>*</span></label>
											<input type="text" name="rigging_ashore_af" id="rigging_ashore_af" placeholder="Rigging Ashore All Fast" class="form-control dt-masktext">
										</div>
									</div>
									<div class="col-md-4">
										<div class="form-group">
											<label>Rigging Ashore NOR Accepted: <span>*</span></label>
											<input type="text" name="rigging_ashore_na" id="rigging_ashore_na" placeholder="Rigging Ashore NOR Accepted" class="form-control dt-masktext">
										</div>
									</div>
								</div>
                                <div class="form-wizard-buttons">
                                    <button type="button" class="btn btn-previous">Previous</button>
                                    <button type="button" class="btn btn-next">Next</button>
                                </div>
                            </fieldset>
							<!-- Form Step 4 -->
							
							<!-- Form Step 5 -->
							<fieldset>
								<!-- Progress Bar -->
								<div class="progress">
								  <div class="progress-bar progress-bar-striped active" role="progressbar" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100" style="width: 100%">
								  </div>
								</div>
								<!-- Progress Bar -->
                                <h4>Additional Information: <span>Step 4 - 5</span></h4>
                                <div class="form-group">&nbsp;</div>
								<h3 style="line-height: 60px;font-size: 20px;font-weight: bold;">Significant Weather Causing Delay </h3>
								<div class="row">
									<div class="col-md-4">
										<div class="form-group">
											<label>Wind: <span>*</span></label>
											<input type="text" name="wind" id="wind" placeholder="Wind" class="form-control ">
										</div>
									</div>
									<div class="col-md-4">
										<div class="form-group">
											<label>Sea: <span>*</span></label>
											<input type="text" name="sea" id="sea" placeholder="sea" class="form-control ">
										</div>
									</div>
									<div class="col-md-4">
										<div class="form-group">
											<label>Swell: <span>*</span></label>
											<input type="text" name="Swell" id="Swell" placeholder="Swell" class="form-control ">
										</div>
									</div>
								</div>
								<h3 style="line-height: 60px;font-size: 20px;font-weight: bold;">Cargo Transferred </h3>
								<div class="row">
									<div class="col-md-12">
										<div class="form-group">
											<label>Product: <span>*</span></label>
											<input type="text" name="product" id="product" placeholder="product" class="form-control ">
										</div>
									</div>
								</div>
								<div class="row">
									<div class="col-md-6">
										<div class="form-group">
											<label>Tonnes in Metrics Discharge: <span>*</span></label>
											<input type="text" name="tonnes_discharge" id="tonnes_discharge" placeholder="Tonnes in Metrics Discharge" class="form-control ">
										</div>
									</div>
									<div class="col-md-6">
										<div class="form-group">
											<label>Tonnes in Metrics Loading: <span>*</span></label>
											<input type="text" name="tonnes_loading" id="tonnes_loading" placeholder="Tonnes in Metrics Loading" class="form-control ">
										</div>
									</div>
								</div>
								<div class="row">
									<div class="col-md-6">
										<div class="form-group">
											<label>Barrels Discharge: <span>*</span></label>
											<input type="text" name="barrels_discharge" id="barrels_discharge" placeholder="Barrels Discharge" class="form-control ">
										</div>
									</div>
									<div class="col-md-6">
										<div class="form-group">
											<label>Barrels Loading: <span>*</span></label>
											<input type="text" name="barrels_loading" id="barrels_loading" placeholder="Barrels Loading" class="form-control ">
										</div>
									</div>
								</div>
								<div class="row">
									<div class="col-md-12">
										<div class="form-group">
											<label>Incident Occurred: <span>*</span></label>
											<input type="text" name="incident_occured" id="incident_occured" placeholder="Incident Occurred" class="form-control ">
										</div>
									</div>
								</div>
								<div class="row">
									<div class="col-md-12">
										<div class="form-group">
											<label>Overtime Remarks: <span>*</span></label>
											<input type="text" name="overtime_remarks" id="overtime_remarks" placeholder="Overtime Remarks" class="form-control ">
										</div>
									</div>
								</div>
								<div class="row">
									<div class="col-md-4">
										<div class="form-group">
											<label>Commence Operation: <span>*</span></label>
											<input type="text" name="additional[commence_operation]" id="commence_operation" placeholder="Commence Operation" class="form-control required dt-masktext">
										</div>
									</div>
									<div class="col-md-4">
										<div class="form-group">
											<label>Complete Operation: <span>*</span></label>
											<input type="text" name="additional[complete_operation]" id="complete_operation" placeholder="Complete Operation" class="form-control required dt-masktext">
										</div>
									</div>
									<div class="col-md-4">
										<div class="form-group">
											<label>Total Exceeding Hours: <span>*</span></label>
											<input type="text" name="additional[total_exceed_hrs]" id="total_exceed_hrs" diabled placeholder="Total Exceeding Hours" class="form-control ">
										</div>
									</div>
								</div>
								<div class="row">
									<div class="col-md-12">
										<div class="form-group">
											<label>Delays and Remarks: <span>*</span></label>
											<textarea name="delays_remark" id="delays_remark" class="form-control "></textarea>
										</div>
									</div>
								</div>
                                <div class="form-wizard-buttons">
                                    <button type="button" class="btn btn-previous">Previous</button>
                                    <button type="submit" class="btn btn-submit">Submit</button>
                                </div>
                            </fieldset>
							<!-- Form Step 5 -->
							
                    	</form>
						
						</div>
						<!-- Form Wizard -->
                    </div>
                </div>
                    
            </div>
        </section>
		<!-- main content -->
						</div>
					</div>
                </div>
				<!-- /Page Content -->	
<script>
$(function () {
	$(document).on("click", '.btn_row_mooring', function () {
		var id = $(this).closest("table.table_mooring").attr('id');  // Id of particular table
		//alert(id);
		console.log(id);
		var div = $("<tr />");
		div.html(GetDynamicTextBox(id));
		$("#"+id+"_tbody").append(div);
	});
	$(document).on("click", "#timesheet_remove", function () {
		$(this).closest("tr").prev().find('td:last-child').html('<button type="button" class="btn btn-danger" id="timesheet_remove"><i class="fa fa-trash-o"></i></button>');
		$(this).closest("tr").remove();
	});
	function GetDynamicTextBox(table_id) {
		$('#timesheet_remove').remove();
		var rowsLength = document.getElementById(table_id).getElementsByTagName("tbody")[0].getElementsByTagName("tr").length+1;
		return '<td><input type="text" class="form-control" name="mooring["mr_tug_name"]" id="mr_tug_name"></td><td><input type="text" class="form-control" name="mooring["mr_tug_firstline"]" id="mr_tug_firstline"></td><td><input type="text" class="form-control" name="mooring["mr_tug_allfast"]" id="mr_tug_allfast"></td><td><input type="text" class="form-control" name="mooring["mr_tug_noraccepted"]" id="mr_tug_noraccepted"></td><td><button type="button" class="btn btn-danger" id="timesheet_remove"><i class="fa fa-trash-o"></i></button></td>'
		//return cancat
	}
});

$(function () {
	$(document).on("click", '.btn_add_row_unmooring', function () {
		var id_unmooring = $(this).closest("table.table_unmooring").attr('id');  // Id of particular table
		//alert(id_unmooring);
		console.log(id_unmooring);
		var div = $("<tr />");
		div.html(GetDynamicTextBox_unmooring(id_unmooring));
		$("#"+id_unmooring+"_tbody").append(div);
	});
	$(document).on("click", "#timesheetunmooring_remove", function () {
		$(this).closest("tr").prev().find('td:last-child').html('<button type="button" class="btn btn-danger" id="timesheetunmooring_remove"><i class="fa fa-trash-o"></i></button>');
		$(this).closest("tr").remove();
	});
	function GetDynamicTextBox_unmooring(table_id_unmooring) {
		$('#timesheetunmooring_remove').remove();
		var rowsLength = document.getElementById(table_id_unmooring).getElementsByTagName("tbody")[0].getElementsByTagName("tr").length+1;
		return '<td><input type="text" class="form-control" name="unmooring["unmr_tug_name"]" id="unmr_tug_name"></td><td><input type="text" class="form-control" name="unmooring["unmr_tug_fl"]" id="unmr_tug_fl"></td><td><input type="text" class="form-control" name="unmooring["unmr_tug_af"]" id="unmr_tug_af"></td><td><input type="text" class="form-control" name="unmooring["unmr_tug_na"]" id="unmr_tug_na"></td><td><button type="button" class="btn btn-danger" id="timesheetunmooring_remove"><i class="fa fa-trash-o"></i></button></td>'
		//return cancat
	}
});
</script>				
<script>
	$(document).ready(function () {

	  $('#timesheet_add_edit_validation').validate({
	    rules: {			
			"rate_id" : {
				required: true
			},
			'general[user_id]':{
				required: true
				},

	    },
	    messages: {
			'general[user_id]': {
				required: "please select mooring master name"
			},
			"rate_id": {
				required: "Rate name is required"
			},
			"price": {
				required: "Price name is required",
				remote: "Already name exist",
				number: "This field can only contain numbers"
			}
	    },
		highlight: function (input) {
            $(input).parents('.form-control').addClass('error');
        },
        unhighlight: function (input) {
            $(input).parents('.form-control').removeClass('error');
        },
        errorPlacement: function (error, element) {
            $(element).parents('.form-control').append(error);
        },
	  });
	$('#complete_operation').keyup(function()
	{
	 var complete = $('#complete_operation').val();
	 var date_array = complete.split('/');
	 var time = [];
        length = date_array[1].length;
		time[0] =date_array[1].substr(0, 2);
		time[1] =date_array[1].substr(0, 2, length);
       //commence
	   var commence = $('#commence_operation').val();
	 	var date_arrayc = commence.split('/');
		 var timec = [];
        lengthc = date_arrayc[1].length;
		timec[0] =date_arrayc[1].substr(0, 2);
		timec[1] =date_arrayc[1].substr(0, 2, lengthc);
        var currentYear = (new Date).getFullYear();
		var currentMonth = (new Date).getMonth() + 1;
        //date_format =currentYear+"-"+currentMonth+"-"+date_array[0]+" "+time[0]+":"+ time[1];       							
		
		var commence = currentMonth+"/"+date_arrayc[0]+"/"+ currentYear +" "+timec[0]+":"+ timec[1];   
		var complete = currentMonth+"/"+date_array[0]+"/"+ currentYear +" "+time[0]+":"+ time[1];   
		
		var start_actual_time  =  commence;
		var end_actual_time    =  complete;

		start_actual_time = new Date(start_actual_time);
		end_actual_time = new Date(end_actual_time);

		var diff = end_actual_time - start_actual_time;

		var diffSeconds = diff/1000;
		var HH = Math.floor(diffSeconds/3600);
		var MM = Math.floor(diffSeconds%3600)/60;

		var formatted = ((HH < 10)?("0" + HH):HH) + ":" + ((MM < 10)?("0" + MM):MM);
		if(formatted > 48){
		var toth = parseInt(formatted)-48 ;
		$('#total_exceed_hrs').val(toth);
		}
		$('#total_exceed_hrs').val("0");
	});
	});
</script>		
<script type="text/javascript" src="{{ asset('public/assets/dist/jquery.inputmask.js') }}" charset="utf-8"></script>
<script>
	//console.log(navigator.userAgent);
	var $input = $('.dt-masktext');
	$input.inputmask("datetime", {
        inputFormat: "dd/HHMM",
        outputFormat: "mm-yyyy-dd",
        inputEventOnly: true		
    });
	//var text = $input.inputmask('setvalue', outputFormat);
	//var text = $input.val('Value');
	//console.log(text);
</script>
