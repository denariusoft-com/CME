<?php

namespace App\Http\Controllers;

use App\Model\Timesheet;
use Illuminate\Http\Request;
use DB;
use Auth;
use App\Model\StsTimesheet;
use App\Model\Client;
use App\Model\StsAdditional;
use App\Model\StsOperational;
use App\Model\StsMooringAdditional;
use App\Model\StsMooringTugs;
use App\Model\StsUnmooringAdditional;
use App\Model\StsUnmooringTugs;
use App\Helpers\CommonHelper;


class TimesheetController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct() {
        $this->StsTimesheet = new StsTimesheet;
        $this->StsAdditional = new StsAdditional;
        $this->StsOperational = new StsOperational;
        $this->StsMooringAdditional = new StsMooringAdditional;
        $this->StsMooringTugs = new StsMooringTugs;
        $this->StsUnmooringAdditional = new StsUnmooringAdditional;
        $this->StsUnmooringTugs = new StsUnmooringTugs;
    }
    
    public function index()
    {
       
		$data['user_view'] = DB::table('mooring_masters')
				->join('users', 'users.id', '=', 'mooring_masters.user_id')
                ->get();
        $data['client'] =Client::where('status','=','1')->get();
        return view('timesheet.add_edit')->with('data',$data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        
        //$pdf->stream("dompdf_out.pdf", array("Attachment" => false));
        //return $pdf->download('timesheet.pdf');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        dd($request->input->all());
    }
    public function timesheet_save(Request $request)
    {
        $data = $request->all(); 
     
        $data['general']['dt_onboard_in'] =  CommonHelper::convert_date_database($data['general']['dt_onboard_in']);
        $data['general']['arrival_nort'] =  CommonHelper::convert_date_database($data['general']['arrival_nort']);
        $data['general']['dt_disembark_out'] =  CommonHelper::convert_date_database($data['general']['dt_disembark_out']);
        $data['general']['sts_date'] =  CommonHelper::convert_databaseformat($data['general']['sts_date']);
       // $data['general']['dt_disembark_out'] =  CommonHelper::convert_date_database($data['general']['dt_disembark_out']);
       // $data['general']['arrival_nort'] =  CommonHelper::convert_date_database($data['general']['arrival_nort']);
        // dd($data['general']);general[arrival_nort]
        if(!empty($data['id'])){
            $data['general']['updated_by'] = Auth::user()->id;
          }   
        else{
            $data['general']['created_by'] = Auth::user()->id;
            $data['general']['updated_by'] = Auth::user()->id;
        }
          //$StsTimesheet = new StsTimesheet();
         // $tsgneral_data =  $data['general'];
          //dd($tsgneral_data);        
         $savedata = StsTimesheet::create($data['general']);
		 // dd($savedata);
         $data['additional']['ts_id'] = $savedata->id;
		 
         $data['additional']['commence_operation'] =  CommonHelper::convert_date_database($data['additional']['commence_operation']);
         $data['additional']['complete_operation'] =  CommonHelper::convert_date_database($data['additional']['complete_operation']);
         $savedataadd = StsAdditional::create($data['additional']);
		// dd($data['oper']);
		 $data['oper']['ts_id'] = $savedata->id;
		
		 $data['oper']['support_craft_transit_start'] =  CommonHelper::convert_date_database($data['oper']['support_craft_transit_start']);
		 $data['oper']['support_craft_transit_finish'] =  CommonHelper::convert_date_database($data['oper']['support_craft_transit_finish']);
		 $data['oper']['support_craft_transit_notes'] =  CommonHelper::convert_date_database($data['oper']['support_craft_transit_notes']);
		 
		 $data['oper']['fendering_start'] =  CommonHelper::convert_date_database($data['oper']['fendering_start']);
		 $data['oper']['fendering_finish'] =  CommonHelper::convert_date_database($data['oper']['fendering_finish']);
		 $data['oper']['fendering_notes'] =  CommonHelper::convert_date_database($data['oper']['fendering_notes']);
		 $data['oper']['checklist2_start'] =  CommonHelper::convert_date_database($data['oper']['checklist2_start']);
		 $data['oper']['checklist2_finish'] =  CommonHelper::convert_date_database($data['oper']['checklist2_finish']);
		 $data['oper']['checklist2_notes'] =  CommonHelper::convert_date_database($data['oper']['checklist2_notes']);
		 $data['oper']['checklist3_start'] =  CommonHelper::convert_date_database($data['oper']['checklist3_start']);
		 $data['oper']['checklist3_finish'] =  CommonHelper::convert_date_database($data['oper']['checklist3_finish']);
		 $data['oper']['checklist3_notes'] =  CommonHelper::convert_date_database($data['oper']['checklist3_notes']);
		 $data['oper']['mooring_firstline'] =  CommonHelper::convert_date_database($data['oper']['mooring_firstline']);
		 $data['oper']['mooring_allfast'] =  CommonHelper::convert_date_database($data['oper']['mooring_allfast']);
		 $data['oper']['mooring_noraccepted'] =  CommonHelper::convert_date_database($data['oper']['mooring_noraccepted']);
         $savedata_operational = StsOperational::create($data['oper']);
		 
		
		$data['mooringtugs'][]['ts_id'] = $savedata->id;
		$data['mooringtugs']['mr_tug_name'] =  $data['mooringtugs']['mr_tug_name'];
		//dd($data['mooringtugs']['mr_tug_firstline']);
		//$date_array = explode("/",$data['mooringtugs']['mr_tug_firstline']);
		//dd($date_array);
		//$data['mooringtugs']['mr_tug_firstline'] =  CommonHelper::convert_date_database($data['mooringtugs']['mr_tug_firstline']);
		//dd($data['mooringtugs']);
		
		//$data['mooringtugs']['mr_tug_allfast'] =  CommonHelper::convert_date_database($data['mooringtugs']['mr_tug_allfast']);
		//$data['mooringtugs']['mr_tug_noraccepted'] =  CommonHelper::convert_date_database($data['mooringtugs']['mr_tug_noraccepted']);
		
		
		$savedata_mooringtugs = $this->StsMooringTugs->saveData($data['mooringtugs']);
		//dd($savedata_mooringtugs->id);
		$data['mooringaddition']['ts_id'] = $savedata->id;
		$data['mooringaddition']['hose_con_fl'] =  CommonHelper::convert_date_database($data['mooringaddition']['hose_con_fl']);
		$data['mooringaddition']['hose_con_af'] =  CommonHelper::convert_date_database($data['mooringaddition']['hose_con_af']);
		$data['mooringaddition']['hose_con_na'] =  CommonHelper::convert_date_database($data['mooringaddition']['hose_con_na']);
		$data['mooringaddition']['con_gauge_etc_fl'] =  CommonHelper::convert_date_database($data['mooringaddition']['con_gauge_etc_fl']);
		$data['mooringaddition']['con_gauge_etc_af'] =  CommonHelper::convert_date_database($data['mooringaddition']['con_gauge_etc_af']);
		$data['mooringaddition']['con_gauge_etc_na'] =  CommonHelper::convert_date_database($data['mooringaddition']['con_gauge_etc_na']);
		$data['mooringaddition']['checklist4_fl'] =  CommonHelper::convert_date_database($data['mooringaddition']['checklist4_fl']);
		$data['mooringaddition']['checklist4_af'] =  CommonHelper::convert_date_database($data['mooringaddition']['checklist4_af']);
		$data['mooringaddition']['checklist4_na'] =  CommonHelper::convert_date_database($data['mooringaddition']['checklist4_na']);
		$data['mooringaddition']['cargo_oper_fl'] =  CommonHelper::convert_date_database($data['mooringaddition']['cargo_oper_fl']);
		$data['mooringaddition']['cargo_oper_af'] =  CommonHelper::convert_date_database($data['mooringaddition']['cargo_oper_af']);
		$data['mooringaddition']['cargo_oper_na'] =  CommonHelper::convert_date_database($data['mooringaddition']['cargo_oper_na']);
		$data['mooringaddition']['hose_discon_fl'] =  CommonHelper::convert_date_database($data['mooringaddition']['hose_discon_fl']);
		$data['mooringaddition']['hose_discon_af'] =  CommonHelper::convert_date_database($data['mooringaddition']['hose_discon_af']);
		$data['mooringaddition']['hose_discon_na'] =  CommonHelper::convert_date_database($data['mooringaddition']['hose_discon_na']);
		$data['mooringaddition']['discon_gauge_etc_fl'] =  CommonHelper::convert_date_database($data['mooringaddition']['discon_gauge_etc_fl']);
		$data['mooringaddition']['discon_gauge_etc_af'] =  CommonHelper::convert_date_database($data['mooringaddition']['discon_gauge_etc_af']);
		$data['mooringaddition']['discon_gauge_etc_na'] =  CommonHelper::convert_date_database($data['mooringaddition']['discon_gauge_etc_na']);
		$data['mooringaddition']['checklist5_fl'] =  CommonHelper::convert_date_database($data['mooringaddition']['checklist5_fl']);
		$data['mooringaddition']['checklist5_af'] =  CommonHelper::convert_date_database($data['mooringaddition']['checklist5_af']);
		$data['mooringaddition']['checklist5_na'] =  CommonHelper::convert_date_database($data['mooringaddition']['checklist5_na']);
		$savedata_mooringaddition = StsMooringAdditional::create($data['mooringaddition']);
		 
		$data['unmooring'][]['ts_id'] = $savedata->id;
		//$data['unmooring']['unmr_tug_name'] =  $data['unmooring']['unmr_tug_name'];
		$savedata_unmooringtugs = $this->StsUnmooringTugs->saveData($data['unmooring']);
		 
		$data['unmr_addition']['ts_id'] = $savedata->id;
		$data['unmr_addition']['unmooring_firstline'] =  CommonHelper::convert_date_database($data['unmr_addition']['unmooring_firstline']);
		$data['unmr_addition']['unmooring_allfast'] =  CommonHelper::convert_date_database($data['unmr_addition']['unmooring_allfast']);
		$data['unmr_addition']['unmooring_noraccepted'] =  CommonHelper::convert_date_database($data['unmr_addition']['unmooring_noraccepted']);
		$data['unmr_addition']['unfendering_fl'] =  CommonHelper::convert_date_database($data['unmr_addition']['unfendering_fl']);
		$data['unmr_addition']['unfendering_af'] =  CommonHelper::convert_date_database($data['unmr_addition']['unfendering_af']);
		$data['unmr_addition']['unfendering_na'] =  CommonHelper::convert_date_database($data['unmr_addition']['unfendering_na']);
		$data['unmr_addition']['unmr_support_craft_fl'] =  CommonHelper::convert_date_database($data['unmr_addition']['unmr_support_craft_fl']);
		$data['unmr_addition']['unmr_support_craft_af'] =  CommonHelper::convert_date_database($data['unmr_addition']['unmr_support_craft_af']);
		$data['unmr_addition']['unmr_support_craft_na'] =  CommonHelper::convert_date_database($data['unmr_addition']['unmr_support_craft_na']);
		$data['unmr_addition']['rigging_ashore_fl'] =  CommonHelper::convert_date_database($data['unmr_addition']['rigging_ashore_fl']);
		$data['unmr_addition']['rigging_ashore_af'] =  CommonHelper::convert_date_database($data['unmr_addition']['rigging_ashore_af']);
		$data['unmr_addition']['rigging_ashore_na'] =  CommonHelper::convert_date_database($data['unmr_addition']['rigging_ashore_na']);
		$savedata_unmr_addition = StsUnmooringAdditional::create($data['unmr_addition']);
		
        return  redirect('/timesheet')->with('type', 'Success!')->with('message', 'Timesheet details inserted successfully!')->with('alertClass', 'alert alert-success');
		
		//return back();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Model\Timesheet  $timesheet
     * @return \Illuminate\Http\Response
     */
    public function show(Timesheet $timesheet)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Model\Timesheet  $timesheet
     * @return \Illuminate\Http\Response
     */
    public function edit(Timesheet $timesheet)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Model\Timesheet  $timesheet
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Timesheet $timesheet)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Model\Timesheet  $timesheet
     * @return \Illuminate\Http\Response
     */
    public function destroy(Timesheet $timesheet)
    {
        //
    }
   
    
}
