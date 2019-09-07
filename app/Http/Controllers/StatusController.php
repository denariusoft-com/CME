<?php

namespace App\Http\Controllers;

use App\Model\Status;
use Illuminate\Http\Request;
use App\Helpers\CommonHelper;
class StatusController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
	public function __construct() {
		
        $this->Status = new Status;
       
    }
    public function index()
    {
        return view('master.status.list');
    }
	public function get_status_list(Request $request)
	{
		$columns = array( 
            0 => 'status_name', 
            1 => 'status', 
            2 => 'options'
        );
        $totalData = Status::where('status','=','1')
        ->count();
        $totalFiltered = $totalData; 
        $limit = $request->input('length');
        
        $start = $request->input('start');
        $order = $columns[$request->input('order.0.column')];
        $dir = $request->input('order.0.dir');
		if(empty($request->input('search.value')))
        {            
            if( $limit == -1){
                $statuses = Status::select('id','status_name','status')->orderBy($order,$dir)
                ->where('status','=','1')
                ->get()->toArray();
            }else{
                $statuses = Status::select('id','status_name','status')->offset($start)
                ->limit($limit)
                ->orderBy($order,$dir)
                ->where('status','=','1')
                ->get()->toArray();
            }
        }
		else {
        $search = $request->input('search.value'); 
        if( $limit == -1){
            $statuses     =  Status::select('id','status_name','status')
						->where('id','LIKE',"%{$search}%")
                        ->orWhere('status_name', 'LIKE',"%{$search}%")
                        ->orWhere('status', 'LIKE',"%{$search}%")
                        ->where('status','=','1')
                        ->orderBy($order,$dir)
                        ->get()->toArray();
        }else{
            $statuses      = Status::select('id','status_name','status')
						->where('id','LIKE',"%{$search}%")
                        ->orWhere('status_name', 'LIKE',"%{$search}%")
                        ->orWhere('status', 'LIKE',"%{$search}%")
                        ->offset($start)
                        ->limit($limit)
                        ->where('status','=','1')
                        ->orderBy($order,$dir)
                        ->get()->toArray();
        }
        $totalFiltered = Status::where('id','LIKE',"%{$search}%")
                    ->orWhere('status_name', 'LIKE',"%{$search}%")
                    ->orWhere('status', 'LIKE',"%{$search}%")
                    ->where('status','=','1')
                    ->count();
        }
		
		$data = array();
        if(!empty($statuses))
        {
            foreach ($statuses as $status)
            {
                $delete =  route('statuses.destroy',$status['id']);
                $edit =  route('statuses.store',$status['id']);
				$autoid = $status['id'];
                $nestedData['status_name'] = $status['status_name'];
                $nestedData['status'] = $status['status'] ? '<span class="text-success text-bold text-center">Active</span>' : '<span class="text-danger text-bold text-center">Deactive</span>';
                $nestedData['options'] = CommonHelper::get_action($edit, $autoid, "modal");
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
	public function findNameExists(Request $request)
    { 
         $status_name =  $request->input('status_name');
         $id = $request->input('status_id');
        if(!empty($id))
        { 
            $data_exists = Status::where([
                  ['status_name','=',$status_name],
                  ['id','!=',$id],
                  ['status','=','1']
                  ])->count();
        }
        else
        {   
            $data_exists = Status::where([
                ['status_name','=',$status_name],
                ['status','=','1'],
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
	public function get_status_detail(Request $request)
    {
        $id = $request->id;
        $data = Status::find($id);
        return $data;
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
        $data = $request->all();
        $request->validate(
            [
                'status_name' => 'required'
            ], 
            [
                'status_name.required' => 'please enter status name'
            ]
        );
		$saveData = $this->Status->saveData($data);
		if($saveData == true)
		{
			return  redirect('/statuses')->with('type', 'Success!')->with('message', ' Status details inserted successfully!')->with('alertClass', 'alert alert-success');
		}
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Model\Status  $status
     * @return \Illuminate\Http\Response
     */
    public function show(Status $status)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Model\Status  $status
     * @return \Illuminate\Http\Response
     */
    public function edit(Status $status)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Model\Status  $status
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Status $status)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Model\Status  $status
     * @return \Illuminate\Http\Response
     */
    public function destroy(Status $status)
    {
        $id = $status->id;
        $status = new Status();
        $status = Status::find($id);
        $status->where('id','=',$id)->update(['status'=>'0']);
        return  redirect('/statuses')->with('type', 'Danger!')->with('message', 'Status details deleted successfully!')->with('alertClass', 'alert alert-danger');
    }
}
