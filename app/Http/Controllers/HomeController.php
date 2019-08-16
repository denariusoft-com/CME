<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Model\StsTimesheet;
use Auth;
use App\User;
use DB;
use App\Model\Client;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use App\Helpers\CommonHelper;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $user = Auth::user()->getRoleNames();
        foreach($user as $v)
       // dd($v);
        if($v=="Admin")
        {
        $where = array();
        $or_where = array();
        $join =array(); 
        $or_where_in = '';
        $join["sts_ts_additional as sts_add"] =array("sts.id","sts_add.ts_id");
        $join["sts_mr_addition as sts_mradd"] =array("sts.id","sts_mradd.ts_id");
        $select = array('sts.user_id', 'sts.location');
        $summarylist = new StsTimesheet();
        //$overallsummarylist = $summarylist->getTimesheet_data($select="", $where, $or_where, $join);
        $overallsummarylist = $summarylist->getTimesheet_data($select="", $where, $or_where,$or_where_in, $join);
       
        return view('dashboard/dashboard', compact('overallsummarylist'));
        }
        else{
            $data['user_view'] = DB::table('mooring_masters')
            ->join('users', 'users.id', '=', 'mooring_masters.user_id')
            ->get();
            $data['client'] =Client::where('status','=','1')->get();
             return view('timesheet.add_edit')->with('data',$data);
        }
       
    }
}
