<?php

namespace App\Http\Controllers;

use App\Model\Timesheet;
use Illuminate\Http\Request;
use DB;
use Auth;
use App\Model\StsTimesheet;
use App\Model\Client;
use App\Model\StsAdditional;
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
        //
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
       //dd($data['general']);
        $data['general']['dt_onboard_in'] =  CommonHelper::convert_date_database($data['general']['dt_onboard_in']);
       // $data['general']['dt_disembark_out'] =  CommonHelper::convert_date_database($data['general']['dt_disembark_out']);
       // $data['general']['arrival_nort'] =  CommonHelper::convert_date_database($data['general']['arrival_nort']);
        // dd($data['general']);general[arrival_nort]
        if(!empty($data['id'])){
            $data['updated_by'] = Auth::user()->id;
          }   
          else{
            $data['created_by'] = Auth::user()->id;
            $data['updated_by'] = Auth::user()->id;
          }
          //$StsTimesheet = new StsTimesheet();
         // $tsgneral_data =  $data['general'];
          //dd($tsgneral_data);        
         $savedata = StsTimesheet::create($data['general']);
         $data['additional']['ts_id'] = $savedata->id;
         $data['additional']['commence_operation'] =  CommonHelper::convert_date_database($data['additional']['commence_operation']);
         $data['additional']['complete_operation'] =  CommonHelper::convert_date_database($data['additional']['complete_operation']);
         //dd($data['additional']);
         
        
         $savedataadd = StsAdditional::create($data['additional']);
         return back();
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
