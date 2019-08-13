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
    public function index()
    {
       // $select = array();
        $where = array();
        $or_where = array();
        $join =array(); 
        $or_where_in = '';
        $join["sts_ts_additional as sts_add"] =array("sts.id","sts_add.ts_id");
        $join["sts_mr_addition as sts_mradd"] =array("sts.id","sts_mradd.ts_id");
        $select = array('sts.user_id', 'sts.location');
        $summarylist = new StsTimesheet();
        $overallsummarylist = $summarylist->getTimesheet_data($select="", $where, $or_where, $join);
        return view('reports.summaryreport', compact('overallsummarylist'));
    }
  
    /*          end theme       */
   public function show(){

   }
   

}