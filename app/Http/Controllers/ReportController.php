<?php


namespace App\Http\Controllers;


use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use DB;
use App\Model\Companysetting;
use App\Model\Themesetting;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Input;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use \Illuminate\Filesystem\FilesystemManager;
use Illuminate\Contracts\Filesystem\Factory as Filesystem;
use Carbon\Carbon;
use Illuminate\Http\File;
use App\Helpers\CommonHelper;
use App\Model\StsTimesheet;
use App\User;



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
        $join["sts_ts_additional as sts_add"] =array("sts.id","sts_add.ts_id");
        $join["sts_mr_addition as sts_mradd"] =array("sts.id","sts_mradd.ts_id");
        $select = array('sts.user_id', 'sts.location');
       
        $summarylist = new StsTimesheet();
        $overallsummarylist = $summarylist->getTimesheet_data($select="", $where, $or_where,$or_where_in, $join);
       
        //dd($overallsummarylist);
        //$overallsummaryhead = ;
        //dd($overallsummarylist);
        return view('reports.summaryreport', compact('overallsummarylist'));
    }
  
    /*          end theme       */
   public function show(){

   }
   public function store(){

} 
public function destroy(){

} 
}