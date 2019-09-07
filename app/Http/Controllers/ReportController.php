<?php


namespace App\Http\Controllers;


use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use DB;
use App\Model\Companysetting;
use App\Model\Themesetting;
use App\Model\StsTimesheet;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Input;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use \Illuminate\Filesystem\FilesystemManager;
use Illuminate\Contracts\Filesystem\Factory as Filesystem;
use Carbon\Carbon;
use Illuminate\Http\File;
use App\Helpers\CommonHelper;
use App\User;
use PDF;


class ReportController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    function __construct()
    {
         $this->middleware('permission:role-list|role-create|role-edit|role-delete', ['only' => ['index','store']]);
         $this->middleware('permission:role-create', ['only' => ['create','store']]);
         $this->middleware('permission:role-edit', ['only' => ['edit','update']]);
         $this->middleware('permission:role-delete', ['only' => ['destroy']]);
         $this->Companysetting = new Companysetting;
         $this->Themesetting = new Themesetting;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    /*                   company setting                 */
    public function index(Request $request)
    {
       //dd($request->input());
       // $select = array();
        $where = array();
        $or_where = array();
        $join =array(); 
        $or_where_in = '';
        $data = $request->all(); 
        if(!empty($data)){
         if ((isset($data['name_moor']) && !empty($data['name_moor'])) || ((isset($data['fromdate']) && !empty($data['fromdate'])) && (isset($data['todate']) && !empty($data['todate'])))) {
            $user_name = $data['name_moor']; 
            $fromdate = $data['fromdate']; 
            $todate = $data['todate']; 
            //dd($fromdate);
            if(!empty($user_name)){
                $usid = User::where('name','LIKE',"%{$user_name}%")->get();   
                if(!empty($usid)){  
                $uname=array();     
                foreach($usid as $usingle){
                    $uname[] = $usingle->id; 
                }
                    $or_where_in = array("user_id", $uname);
                }     
            }
            if((!empty($fromdate)) && (!empty($todate))){
                $fdate = CommonHelper::convert_databaseformat($fromdate);
                $tdate = CommonHelper::convert_databaseformat($todate);
                $todt = date('Y-m-d', strtotime($tdate . ' +1 day'));
                $or_where1 = array("sts.created_at", ">=", "{$fdate}");
                $or_where2 = array("sts.created_at", "<", "{$todt}' +1 day");
                $where = array($or_where1, $or_where2);  
            }
            }
        }
        //$or_where1 = array("sts.created_at", ">=", "{$fdate}");
       // $where = array($or_where1, $or_where2);  
	   
        $join["sts_ts_additional as sts_add"] =array("sts.t_id","sts_add.ts_id");
        $join["sts_mr_addition as sts_mradd"] =array("sts.t_id","sts_mradd.ts_id");
        $join["sts_ts_oper_timings as sts_oprtiming"] =array("sts.t_id","sts_oprtiming.ts_id");
        $join["sts_unmr_addition as sts_unmraddition"] =array("sts.t_id","sts_unmraddition.ts_id");
      //  $join["ts_mooring_tugs as ts_m_tugs"] =array("sts.t_id","ts_m_tugs.ts_id");
       // $join["ts_unmooring_tugs as ts_um_tugs"] =array("sts.t_id","ts_um_tugs.ts_id");
        $select = array('sts.*');
		
		//$selectall = $select1.",".$select2.",".$select3.",".$select4.",".$select5.",".$select6;
       //$select1 = array();
        $summarylist = new StsTimesheet();
        $overallsummarylist = $summarylist->getTimesheet_data($select="", $where, $or_where,$or_where_in, $join);
       
       // $overallsummarylist;
        //$overallsummaryhead = ;
        //dd($overallsummarylist);
        return view('reports.summaryreport', compact('overallsummarylist'));
    }
	public function sts_approvedstatusUpdate($id)
	{
		/* $sts_data = StsTimesheet::where('t_id','=',$id)->first();
		$moor_master_id = User::where('id','=',$sts_data->user_id)->pluck('id');
		$ts_id = $sts_data->t_id;
		$client_id = $sts_data->client_id;
		$datatime = date("Y-m-d h:m:i"); */
			
		
		$updateData = StsTimesheet::where('t_id', $id)->update([
           'status' => 1
        ]);
		if($updateData == true)
		{
			return  redirect('/reports')->with('type', 'Success!')->with('message', 'STS timesheet approved successfully!')->with('alertClass', 'alert alert-success');
		}
	}
	public function sts_rejectedstatusUpdate($id)
	{
		$updateData = StsTimesheet::where('t_id', $id)->update([
           'status' => 2
        ]);
		if($updateData == true)
		{
			return  redirect('/reports')->with('type', 'Danger!')->with('message', 'STS timesheet details rejected!')->with('alertClass', 'alert alert-danger');
		}
	}
	public function pilotage_summary()
	{
		return view('reports.pilotage_summaryreport');
	}
	
	public function store_refno(Request $request)
	{
		$id = $request->input('timesheet_id');
		if($request->input('submit_ref_number'))
		{
			$updateData = StsTimesheet::where('t_id', $id)->update([
			   'work_ref_no' => $request->input('reference_no'),
			   'status' => 3
			]);
			if($updateData == true)
			{
				return  redirect('/reports')->with('type', 'Success!')->with('message', 'STS timesheet reference number created!')->with('alertClass', 'alert alert-success');
			}
		}
		//echo $request->input('reference_no');
		
	}
	public function findReferenceNumberExists(Request $request)
    { 
         $reference_no =  $request->input('reference_no');
         $timesheet_id = $request->input('timesheet_id');
        if(!empty($timesheet_id))
        { 
            $data_exists = StsTimesheet::where([
                  ['job_ref_id','=',$reference_no],
                  ['t_id','!=',$timesheet_id]
                  ])->count();
        }
        else
        {   
            $data_exists = StsTimesheet::where([
                ['job_ref_id','=',$reference_no]
                ])->count(); 
        } 
        if($data_exists > 0)
        {
              return "false";
        }
        else{
              return "true";
        }
    }
    /*          end theme       */
    public function show(){

    }
    public function store(){

    } 
    public function destroy(){

    }
    



}