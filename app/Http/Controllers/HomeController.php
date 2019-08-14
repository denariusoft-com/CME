<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Model\StsTimesheet;

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
        $where = array();
        $or_where = array();
        $join =array(); 
        $or_where_in = '';
        $join["sts_ts_additional as sts_add"] =array("sts.id","sts_add.ts_id");
        $join["sts_mr_addition as sts_mradd"] =array("sts.id","sts_mradd.ts_id");
        $select = array('sts.user_id', 'sts.location');
        $summarylist = new StsTimesheet();
        $overallsummarylist = $summarylist->getTimesheet_data($select="", $where, $or_where, $join);
        return view('dashboard/dashboard', compact('overallsummarylist'));
       
    }
}
