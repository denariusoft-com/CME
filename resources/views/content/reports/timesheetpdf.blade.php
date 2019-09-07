<!DOCTYPE html>
<html>
<head>
	<title>STS Time Sheet</title>
	
	<style>
	
	</style>
</head>
<body>
	<p align="center"><img src="{{ url('/public/assets/img/logo.png') }}" width="120" /></p>
	<h4 align="center">CENTRE OF MARITIME EXCELLENCE SDN BHD <br> <u>STS TIME SHEET</u></h4>
	
	<table border="1" width="100%">
		<tr style="background:#c1c1c1;">
			<td colspan="6" align="center">
				<b>GENERAL DETAILS</b>
			</td>
		</tr>
		<tr>
			<td colspan="2">
				<b>STS Superintendent</b>
			</td>
			<td colspan="4" align="center">
				@php 
					$user_name = CommonHelper::profile_img($timesheet_details->user_id);
				@endphp
				{{ $user_name->name }}
			</td>
		</tr>
		<tr>
			<td><b>Location</b></td>
			<td align="center">{{ isset($timesheet_details->location) ? $timesheet_details->location : "-" }}</td>
			<td ><b>Job Ref Number</b></td>
			<td align="center" >{{ isset($timesheet_details->job_ref_id) ? $timesheet_details->job_ref_id : "-" }}</td>
			<td ><b>Timesheet Work Date</b></td>
			<td align="center">{{ isset($timesheet_details->sts_date) ? date("d/m/Y", strtotime($timesheet_details->sts_date)) : "-" }}</td>
		</tr>
		<tr>
			<td colspan="3">
				<table>
					<tr>
						<td><b>Mother V/L : </b></td>
						<td>{{ isset($timesheet_details->mother_vessel) ? $timesheet_details->mother_vessel : "-" }}</td>
					</tr>
					<tr>
						<td><b>SDWT : </b></td>
						<td>{{ isset($timesheet_details->mother_sdwt) ? $timesheet_details->mother_sdwt : "-" }}</td>
					</tr>
					<tr>
						<td><b>LOA : </b></td>
						<td>{{ isset($timesheet_details->mother_loa) ? $timesheet_details->mother_loa : "-" }}</td>
					</tr>
					<tr>
						<td><b>Anchored / NORT : </b></td>
						<td>{{ isset($timesheet_details->anchored_nort) ? $timesheet_details->anchored_nort : "-" }}</td>
					</tr>
				</table>
			</td>
			<td colspan="3">
				<table>
					<tr>
						<td colspan="2"><b>Manoeuvring V/L : </b></td>
						<td colspan="2">{{ isset($timesheet_details->maneuvring_vessel) ? $timesheet_details->maneuvring_vessel : "-" }}</td>
					</tr>
					<tr>
						<td><b>SDWT : </b></td>
						<td>{{ isset($timesheet_details->manoeuvring_sdwt) ? $timesheet_details->manoeuvring_sdwt : "-" }}</td>
						<td><b>LOA</b></td>
						<td>{{ isset($timesheet_details->manoeuvring_loa) ? $timesheet_details->manoeuvring_loa : "-" }}</td>
					</tr>
					<tr>
						<td><b>Max Draft In : </b></td>
						<td>{{ isset($timesheet_details->maneuvring_max_draft_in) ? $timesheet_details->maneuvring_max_draft_in : "-" }}</td>
						<td><b>Out : </b></td>
						<td>{{ isset($timesheet_details->maneuvring_max_draft_out) ? $timesheet_details->maneuvring_max_draft_out : "-" }}</td>
					</tr>
					<tr>
						<td colspan="2"><b>Arrival / NORT : </b></td>
						<td colspan="2">{{ isset($timesheet_details->arrival_nort) ? date("d/hm", strtotime($timesheet_details->arrival_nort)) : "-" }}</td>
					</tr>
				</table>
			</td>
		</tr>
		<tr>
			<td colspan="3">
				<b>Date / Time Onboard (IN)</b>
			</td>
			<td colspan="3">
				<b>Date / Time Disembark (OUT)</b>
			</td>
		</tr>
		<tr>
			<td colspan="3" align="center">
			{{ isset($timesheet_details->dt_onboard_in) ? date("d/hm", strtotime($timesheet_details->dt_onboard_in)) : "-" }}
			</td>
			<td colspan="3" align="center">
			{{ isset($timesheet_details->dt_disembark_out) ? date("d/hm", strtotime($timesheet_details->dt_disembark_out)) : "-" }}
			</td>
		</tr>
		<tr>
			<td><b>Cargo</b></td>
			<td align="center">{{ isset($timesheet_details->cargo) ? $timesheet_details->cargo : "-" }}</td>
			<td><b>FSU or SPOT</b></td>
			<td align="center" colspan="3">{{ isset($timesheet_details->cargo) ? $timesheet_details->client_fsu_spot : "-" }}</td>
		</tr>
		<tr style="background:#c1c1c1;">
			<td colspan="6" align="center">
				<b>OPERATIONAL TIMINGS</b>
			</td>
		</tr>
		<tr>
			<td ><b>ACTIVITY</b></td>
			<td align="center"><b>START</b></td>
			<td align="center"><b>FINISH</b></td>
			<td align="center" colspan="3"><b>NOTES</b></td>
		</tr>
		<tr>
			<td ><b>Support Craft Transit</b></td>
			<td align="center">{{ isset($oper_timings->support_craft_transit_start) ? date("d/hm", strtotime($oper_timings->support_craft_transit_start)) : "-" }}</td>
			<td align="center">{{ isset($oper_timings->support_craft_transit_finish) ? date("d/hm", strtotime($oper_timings->support_craft_transit_finish)) : "-" }}</td>
			<td align="center" colspan="3">{{ isset($oper_timings->support_craft_transit_notes) ? date("d/hm", strtotime($oper_timings->support_craft_transit_notes)) : "-" }}</td>
		</tr>
		<tr>
			<td ><b>Fendering</b></td>
			<td align="center">{{ isset($oper_timings->fendering_start) ? date("d/hm", strtotime($oper_timings->fendering_start)) : "-" }}</td>
			<td align="center">{{ isset($oper_timings->fendering_finish) ? date("d/hm", strtotime($oper_timings->fendering_finish)) : "-" }}</td>
			<td align="center" colspan="3">{{ isset($oper_timings->fendering_notes) ? date("d/hm", strtotime($oper_timings->fendering_notes)) : "-" }}</td>
		</tr>
		<tr>
			<td ><b>Checklist 2</b></td>
			<td align="center">{{ isset($oper_timings->checklist2_start) ? date("d/hm", strtotime($oper_timings->checklist2_start)) : "-" }}</td>
			<td align="center">{{ isset($oper_timings->checklist2_finish) ? date("d/hm", strtotime($oper_timings->checklist2_finish)) : "-" }}</td>
			<td align="center" colspan="3">{{ isset($oper_timings->checklist2_notes) ? date("d/hm", strtotime($oper_timings->checklist2_notes)) : "-" }}</td>
		</tr>
		<tr>
			<td ><b>Checklist 3</b></td>
			<td align="center">{{ isset($oper_timings->checklist3_start) ? date("d/hm", strtotime($oper_timings->checklist3_start)) : "-" }}</td>
			<td align="center">{{ isset($oper_timings->checklist3_finish) ? date("d/hm", strtotime($oper_timings->checklist3_finish)) : "-" }}</td>
			<td align="center" colspan="3">{{ isset($oper_timings->checklist3_notes) ? date("d/hm", strtotime($oper_timings->checklist3_notes)) : "-" }}</td>
		</tr>
		<tr>
			<td rowspan="2"><b>Mooring</b></td>
			<td align="center"><b>First Line</b></td>
			<td align="center"><b>All Fast</b></td>
			<td align="center" colspan="3"><b>NOR Accepted</b></td>
		</tr>
		<tr>
			<td align="center">{{ isset($oper_timings->mooring_firstline) ? date("d/hm", strtotime($oper_timings->mooring_firstline)) : "-" }}</td>
			<td align="center">{{ isset($oper_timings->mooring_allfast) ? date("d/hm", strtotime($oper_timings->mooring_allfast)) : "-" }}</td>
			<td colspan="3" align="center">{{ isset($oper_timings->mooring_noraccepted) ? date("d/hm", strtotime($oper_timings->mooring_noraccepted)) : "-" }}</td>
		</tr>
		<tr style="background:#c1c1c1;">
			<td colspan="6">
				<b>Tugs used : </b>
			</td>
		</tr>
		@php $mt_id = 1; @endphp
		@foreach($mooringtugs_details as $row_mt)
		<tr>
			<td ><b>Tug {{ $mt_id }} : </b> {{ isset($row_mt->mr_tug_name) ? $row_mt->mr_tug_name : "-" }}</td>
			<td align="center">{{ isset($row_mt->mr_tug_firstline) ? date("d/hm", strtotime($row_mt->mr_tug_firstline)) : "-" }}</td>
			<td align="center">{{ isset($row_mt->mr_tug_allfast) ? date("d/hm", strtotime($row_mt->mr_tug_allfast)) : "-" }}</td>
			<td align="center" colspan="3">{{ isset($row_mt->mr_tug_noraccepted) ? date("d/hm", strtotime($row_mt->mr_tug_noraccepted)) : "-" }}</td>
		</tr>
		@php $mt_id++; @endphp
		@endforeach
		
		<tr>
			<td ><b>Hose Connection </b></td>
			<td align="center">{{ isset($mooring_additional_details->hose_con_fl) ? date("d/hm", strtotime($mooring_additional_details->hose_con_fl)) : "-" }}</td>
			<td align="center">{{ isset($mooring_additional_details->hose_con_af) ? date("d/hm", strtotime($mooring_additional_details->hose_con_af)) : "-" }}</td>
			<td align="center" colspan="3">{{ isset($mooring_additional_details->hose_con_na) ? date("d/hm", strtotime($mooring_additional_details->hose_con_na)) : "-" }}</td>
		</tr>
		<tr>
			<td ><b>Gauging ETC </b></td>
			<td align="center">{{ isset($mooring_additional_details->con_gauge_etc_fl) ? date("d/hm", strtotime($mooring_additional_details->con_gauge_etc_fl)) : "-" }}</td>
			<td align="center">{{ isset($mooring_additional_details->con_gauge_etc_af) ? date("d/hm", strtotime($mooring_additional_details->con_gauge_etc_af)) : "-" }}</td>
			<td align="center" colspan="3">{{ isset($mooring_additional_details->con_gauge_etc_na) ? date("d/hm", strtotime($mooring_additional_details->con_gauge_etc_na)) : "-" }}</td>
		</tr>
		<tr>
			<td ><b>Checklist 4 </b></td>
			<td align="center">{{ isset($mooring_additional_details->checklist4_fl) ? date("d/hm", strtotime($mooring_additional_details->checklist4_fl)) : "-" }}</td>
			<td align="center">{{ isset($mooring_additional_details->checklist4_af) ? date("d/hm", strtotime($mooring_additional_details->checklist4_af)) : "-" }}</td>
			<td align="center" colspan="3">{{ isset($mooring_additional_details->checklist4_na) ? date("d/hm", strtotime($mooring_additional_details->checklist4_na)) : "-" }}</td>
		</tr>
		<tr>
			<td ><b>Cargo Operations </b></td>
			<td align="center">{{ isset($mooring_additional_details->cargo_oper_fl) ? date("d/hm", strtotime($mooring_additional_details->cargo_oper_fl)) : "-" }}</td>
			<td align="center">{{ isset($mooring_additional_details->cargo_oper_af) ? date("d/hm", strtotime($mooring_additional_details->cargo_oper_af)) : "-" }}</td>
			<td align="center" colspan="3">{{ isset($mooring_additional_details->cargo_oper_na) ? date("d/hm", strtotime($mooring_additional_details->cargo_oper_na)) : "-" }}</td>
		</tr>
		<tr>
			<td ><b>Hose Disconnection </b></td>
			<td align="center">{{ isset($mooring_additional_details->hose_discon_fl) ? date("d/hm", strtotime($mooring_additional_details->hose_discon_fl)) : "-" }}</td>
			<td align="center">{{ isset($mooring_additional_details->hose_discon_af) ? date("d/hm", strtotime($mooring_additional_details->hose_discon_af)) : "-" }}</td>
			<td align="center" colspan="3">{{ isset($mooring_additional_details->hose_discon_na) ? date("d/hm", strtotime($mooring_additional_details->hose_discon_na)) : "-" }}</td>
		</tr>
		<tr>
			<td ><b>Gauging ETC </b></td>
			<td align="center">{{ isset($mooring_additional_details->discon_gauge_etc_fl) ? date("d/hm", strtotime($mooring_additional_details->discon_gauge_etc_fl)) : "-" }}</td>
			<td align="center">{{ isset($mooring_additional_details->discon_gauge_etc_af) ? date("d/hm", strtotime($mooring_additional_details->discon_gauge_etc_af)) : "-" }}</td>
			<td align="center" colspan="3">{{ isset($mooring_additional_details->discon_gauge_etc_na) ? date("d/hm", strtotime($mooring_additional_details->discon_gauge_etc_na)) : "-" }}</td>
		</tr>
		<tr>
			<td ><b>Checklist 5 </b></td>
			<td align="center">{{ isset($mooring_additional_details->checklist5_fl) ? date("d/hm", strtotime($mooring_additional_details->checklist5_fl)) : "-" }}</td>
			<td align="center">{{ isset($mooring_additional_details->checklist5_af) ? date("d/hm", strtotime($mooring_additional_details->checklist5_af)) : "-" }}</td>
			<td align="center" colspan="3">{{ isset($mooring_additional_details->checklist5_na) ? date("d/hm", strtotime($mooring_additional_details->checklist5_na)) : "-" }}</td>
		</tr>
		<tr>
			<td ><b>Unmooring </b></td>
			<td align="center">{{ isset($unmooring_additional_details->unmooring_firstline) ? date("d/hm", strtotime($unmooring_additional_details->unmooring_firstline)) : "-" }}</td>
			<td align="center">{{ isset($unmooring_additional_details->unmooring_allfast) ? date("d/hm", strtotime($unmooring_additional_details->unmooring_allfast)) : "-" }}</td>
			<td align="center" colspan="3">{{ isset($unmooring_additional_details->unmooring_noraccepted) ? date("d/hm", strtotime($unmooring_additional_details->unmooring_noraccepted)) : "-" }}</td>
		</tr>
		<tr style="background:#c1c1c1;">
			<td colspan="6">
				<b>Tugs used : </b>
			</td>
		</tr>
		@php $umt_id = 1; @endphp
		@foreach($unmooringtugs_details as $row_umt)
		<tr>
			<td ><b>Tug {{ $umt_id }} : </b> {{ isset($row_umt->unmr_tug_name) ? $row_umt->unmr_tug_name : "-" }}</td>
			<td align="center">{{ isset($row_umt->unmr_tug_fl) ? date("d/hm", strtotime($row_umt->unmr_tug_fl)) : "-" }}</td>
			<td align="center">{{ isset($row_umt->unmr_tug_af) ? date("d/hm", strtotime($row_umt->unmr_tug_af)) : "-" }}</td>
			<td align="center" colspan="3">{{ isset($row_umt->unmr_tug_na) ? date("d/hm", strtotime($row_umt->unmr_tug_na)) : "-" }}</td>
		</tr>
		@php $umt_id++; @endphp
		@endforeach
		<tr>
			<td ><b>Unfendering</b></td>
			<td align="center">{{ isset($unmooring_additional_details->unfendering_fl) ? date("d/hm", strtotime($unmooring_additional_details->unfendering_fl)) : "-" }}</td>
			<td align="center">{{ isset($unmooring_additional_details->unfendering_af) ? date("d/hm", strtotime($unmooring_additional_details->unfendering_af)) : "-" }}</td>
			<td align="center" colspan="3">{{ isset($unmooring_additional_details->unfendering_na) ? date("d/hm", strtotime($unmooring_additional_details->unfendering_na)) : "-" }}</td>
		</tr>
		<tr>
			<td ><b>Support Craft Transit</b></td>
			<td align="center">{{ isset($unmooring_additional_details->unmr_support_craft_fl) ? date("d/hm", strtotime($unmooring_additional_details->unmr_support_craft_fl)) : "-" }}</td>
			<td align="center">{{ isset($unmooring_additional_details->unmr_support_craft_af) ? date("d/hm", strtotime($unmooring_additional_details->unmr_support_craft_af)) : "-" }}</td>
			<td align="center" colspan="3">{{ isset($unmooring_additional_details->unmr_support_craft_na) ? date("d/hm", strtotime($unmooring_additional_details->unmr_support_craft_na)) : "-" }}</td>
		</tr>
		<tr>
			<td ><b>Rigging Ashore</b></td>
			<td align="center">{{ isset($unmooring_additional_details->rigging_ashore_fl) ? date("d/hm", strtotime($unmooring_additional_details->rigging_ashore_fl)) : "-" }}</td>
			<td align="center">{{ isset($unmooring_additional_details->rigging_ashore_af) ? date("d/hm", strtotime($unmooring_additional_details->rigging_ashore_af)) : "-" }}</td>
			<td align="center" colspan="3">{{ isset($unmooring_additional_details->rigging_ashore_na) ? date("d/hm", strtotime($unmooring_additional_details->rigging_ashore_na)) : "-" }}</td>
		</tr>
		<tr style="background:#c1c1c1;">
			<td colspan="2"><b>Significant Weather Causing Delay</b></td>
			<td colspan="4"><b>Cargo Transferred</b></td>
		</tr>
		<tr>
			<td ><b>Wind</b></td>
			<td align="center">{{ isset($additional_details->wind) ? $additional_details->wind : "-" }}</td>
			<td ><b>Product</b></td>
			<td align="center">{{ isset($additional_details->product) ? $additional_details->product : "-" }}</td>
			<td align="center"><b>Discharge </b></td>
			<td align="center"><b>Loading </b></td>
		</tr>
		<tr>
			<td ><b>Sea</b></td>
			<td align="center">{{ isset($additional_details->sea) ? $additional_details->sea : "-" }}</td>
			<td colspan="2"><b>Tonnes in Metrics</b></td>
			<td align="center">{{ isset($additional_details->tonnes_discharge) ? number_format($additional_details->tonnes_discharge, 3) : "-" }}</td>
			<td align="center">{{ isset($additional_details->tonnes_loading) ? number_format($additional_details->tonnes_loading, 3) : "-" }}</td>
		</tr>
		<tr>
			<td ><b>Swell</b></td>
			<td align="center">{{ isset($additional_details->swell) ? $additional_details->swell : "-" }}</td>
			<td colspan="2"><b>Barrels</b></td>
			<td align="center">{{ isset($additional_details->barrels_discharge) ? number_format($additional_details->barrels_discharge, 3) : "-" }}</td>
			<td align="center">{{ isset($additional_details->barrels_loading) ? number_format($additional_details->barrels_loading, 3) : "-" }}</td>
		</tr>
		<tr >
			<td >
				<b>Incident Occurred  </b>
			</td>
			<td colspan="5" align="left">{{ isset($additional_details->incident_occured) ? $additional_details->incident_occured : "-" }}</td>
		</tr>
		<tr >
			<td >
				<b>Overtime Remarks  </b>
			</td>
			<td colspan="5" align="left">{{ isset($additional_details->overtime_remarks) ? $additional_details->overtime_remarks : "-" }}</td>
		</tr>
		<tr>
			<td colspan="2"><b>Commence Operation</b></td>
			<td colspan="2"><b>Complete Operation</b></td>
			<td colspan="2"><b>Total Exceeding Hours</b></td>
		</tr>
		<tr>
			<td colspan="2" align="center">{{ isset($additional_details->commence_operation) ? date("d/hm", strtotime($additional_details->commence_operation)) : "-" }}</td>
			<td colspan="2" align="center">{{ isset($additional_details->complete_operation) ? date("d/hm", strtotime($additional_details->complete_operation)) : "-" }}</td>
			<td colspan="2" align="center">{{ isset($additional_details->total_exceed_hrs) ? number_format($additional_details->total_exceed_hrs, 3) : "-" }}</td>
		</tr>
		<tr >
			<td colspan="6">
				<b>Delays and Remarks  </b>
			</td>
		</tr>
		<tr >
			<td colspan="6" align="left">
				{{ isset($additional_details->delays_remark) ? $additional_details->delays_remark : "-" }}
			</td>
		</tr>
	</table>
	
	<table>
		<tr >
			<td colspan="6" >
				&nbsp;
			</td>
		</tr>
		<tr>
			<td colspan="1">
				<b>STS SUPERINTENDENT <br>(SIGNED) :</b>
			</td>
			<td colspan="2">
			.................................................
			</td>
			<td colspan="1">
				<b>DATE :</b>
			</td>
			<td colspan="2">
			...........................................................
			</td>
		</tr>
		<tr >
			<td colspan="6" >
				&nbsp;
			</td>
		</tr>
		<tr>
			<td colspan="1">
				<b>MASTER (SIGNED) :</b>
			</td>
			<td colspan="2">
			.................................................
			</td>
			<td colspan="1">
				<b>SHIP'S STAMP :</b>
			</td>
			<td colspan="2">
			...........................................................
			</td>
		</tr>
	</table>
</body>
</html>