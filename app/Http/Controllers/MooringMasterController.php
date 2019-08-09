<?php

namespace App\Http\Controllers;

use App\Model\Mooring_master;
use App\Model\Status;
use App\Model\Ratemaster;
use App\Model\Rate;
use App\Model\Category;
use Illuminate\Http\Request;

class MooringMasterController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
	public function __construct() {
		
        $this->Mooring_master = new Mooring_master;
        $this->Status = new Status;
        $this->Category = new Category;
        $this->Rate = new Rate;
        $this->Ratemaster = new Ratemaster;
       
    }
    public function index()
    {
        return view('master.mooring_master.list');
    }
	public function get_mooringmaster_list(Request $request)
	{
		$columns = array( 
            0 => 'address', 
            1 => 'phone_no', 
            2 => 'email', 
            3 => 'company_id', 
            4 => 'salary', 
            5 => 'options'
        );
        $totalData = Mooring_master::where('status','=','1')
        ->count();
        $totalFiltered = $totalData; 
        $limit = $request->input('length');
        
        $start = $request->input('start');
        $order = $columns[$request->input('order.0.column')];
        $dir = $request->input('order.0.dir');
		if(empty($request->input('search.value')))
        {            
            if( $limit == -1){
                $mooring_masters = Mooring_master::select('id','address','phone_no','email','company_id','salary')->orderBy($order,$dir)
                ->where('status','=','1')
                ->get()->toArray();
            }else{
                $mooring_masters = Mooring_master::select('id','address','phone_no','email','company_id','salary')->offset($start)
                ->limit($limit)
                ->orderBy($order,$dir)
                ->where('status','=','1')
                ->get()->toArray();
            }
        }
		else {
        $search = $request->input('search.value'); 
        if( $limit == -1){
            $mooring_masters     =  Mooring_master::select('id','address','phone_no','email','company_id','salary')
						->where('id','LIKE',"%{$search}%")
                        ->orWhere('address', 'LIKE',"%{$search}%")
                        ->orWhere('phone_no', 'LIKE',"%{$search}%")
                        ->orWhere('email', 'LIKE',"%{$search}%")
                        ->orWhere('company_id', 'LIKE',"%{$search}%")
                        ->orWhere('salary', 'LIKE',"%{$search}%")
                        ->where('status','=','1')
                        ->orderBy($order,$dir)
                        ->get()->toArray();
        }else{
            $mooring_masters      = Mooring_master::select('id','address','phone_no','email','company_id','salary')
						->where('id','LIKE',"%{$search}%")
                        ->orWhere('address', 'LIKE',"%{$search}%")
                        ->orWhere('phone_no', 'LIKE',"%{$search}%")
                        ->orWhere('email', 'LIKE',"%{$search}%")
                        ->orWhere('company_id', 'LIKE',"%{$search}%")
                        ->orWhere('salary', 'LIKE',"%{$search}%")
                        ->offset($start)
                        ->limit($limit)
                        ->where('status','=','1')
                        ->orderBy($order,$dir)
                        ->get()->toArray();
        }
        $totalFiltered = Mooring_master::where('id','LIKE',"%{$search}%")
                    ->orWhere('address', 'LIKE',"%{$search}%")
                    ->orWhere('phone_no', 'LIKE',"%{$search}%")
                    ->orWhere('email', 'LIKE',"%{$search}%")
                    ->orWhere('company_id', 'LIKE',"%{$search}%")
                    ->orWhere('salary', 'LIKE',"%{$search}%")
                    ->where('status','=','1')
                    ->count();
        }
		
		$data = array();
        if(!empty($mooring_masters))
        {
            foreach ($mooring_masters as $mooring_master)
            {
                $delete =  route('mooring_masters.destroy',$mooring_master['id']);
                $edit =  route('mooring_masters.store',$mooring_master['id']);
				$autoid = $mooring_master['id'];
                $nestedData['address'] = $mooring_master['address'];
                $nestedData['phone_no'] = $mooring_master['phone_no'];
                $nestedData['email'] = $mooring_master['email'];
                $nestedData['company_id'] = $mooring_master['company_id'];
                $nestedData['salary'] = $mooring_master['salary'];
                $nestedData['options'] = "&emsp;<a style='float: left;' href='{$edit}' title='EDIT' id='#add_edit_modal' data-toggle='modal' class='btn btn-primary' onClick='showeditForm($autoid);'><i class='fa fa-pencil'></i></a>";
                $nestedData['options'] .="<form style='float: left;margin-left: 10px;' action='{$delete}' method='POST'>".method_field('DELETE').csrf_field();
                $nestedData['options'] .="<button type='submit' class='btn btn-danger'  onclick='return ConfirmDeletion()'><i class='fa fa-trash'></i></button> </form>
										";
                $data[] = $nestedData;

            }
        }
		$json_data = array(

            "draw"            => intval($request->input('draw')),  
            "recordsTotal"    => intval($totalData),  
            "recordsFiltered" => intval($totalFiltered), 
            "data"            => $data   
            );
        echo json_encode($json_data);
		
	}
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data['status_detail'] = Status::all();
        $data['category_detail'] = Category::all();
        $data['rate_detail'] = Rate::all();
        return view('master.mooring_master.add_edit')->with('data',$data);
    }
	public function getRateList(Request $request)
    {
        $ratemaster = Ratemaster::where("cat_id",$request->category_id)
							->get();
			$success_data = array('rate_id' => $ratemaster->rate_id, 'price'=>$ratemaster->price);
			return response()->json($success_data);
		
		//echo $success_data;
		//die;
        
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Model\Mooring_master  $mooring_master
     * @return \Illuminate\Http\Response
     */
    public function show(Mooring_master $mooring_master)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Model\Mooring_master  $mooring_master
     * @return \Illuminate\Http\Response
     */
    public function edit(Mooring_master $mooring_master)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Model\Mooring_master  $mooring_master
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Mooring_master $mooring_master)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Model\Mooring_master  $mooring_master
     * @return \Illuminate\Http\Response
     */
    public function destroy(Mooring_master $mooring_master)
    {
        //
    }
}
