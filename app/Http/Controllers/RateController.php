<?php

namespace App\Http\Controllers;

use App\Model\Rate;
use Illuminate\Http\Request;

class RateController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
	public function __construct() {
		
        $this->Rate = new Rate;
       
    }
    public function index()
    {
        return view('master.rate.list');
    }
	public function get_rate_list(Request $request)
	{
		$columns = array( 
            0 => 'rate_name', 
            1 => 'status', 
            2 => 'options'
        );
        $totalData = Rate::where('status','=','1')
        ->count();
        $totalFiltered = $totalData; 
        $limit = $request->input('length');
        
        $start = $request->input('start');
        $order = $columns[$request->input('order.0.column')];
        $dir = $request->input('order.0.dir');
		if(empty($request->input('search.value')))
        {            
            if( $limit == -1){
                $rates = Rate::select('id','rate_name','status')->orderBy($order,$dir)
                ->where('status','=','1')
                ->get()->toArray();
            }else{
                $rates = Rate::select('id','rate_name','status')->offset($start)
                ->limit($limit)
                ->orderBy($order,$dir)
                ->where('status','=','1')
                ->get()->toArray();
            }
        }
		else {
        $search = $request->input('search.value'); 
        if( $limit == -1){
            $rates     =  Rate::select('id','rate_name','status')
						->where('id','LIKE',"%{$search}%")
                        ->orWhere('rate_name', 'LIKE',"%{$search}%")
                        ->orWhere('status', 'LIKE',"%{$search}%")
                        ->where('status','=','1')
                        ->orderBy($order,$dir)
                        ->get()->toArray();
        }else{
            $rates      = Rate::select('id','rate_name','status')
						->where('id','LIKE',"%{$search}%")
                        ->orWhere('rate_name', 'LIKE',"%{$search}%")
                        ->orWhere('status', 'LIKE',"%{$search}%")
                        ->offset($start)
                        ->limit($limit)
                        ->where('status','=','1')
                        ->orderBy($order,$dir)
                        ->get()->toArray();
        }
        $totalFiltered = Rate::where('id','LIKE',"%{$search}%")
                    ->orWhere('rate_name', 'LIKE',"%{$search}%")
                    ->orWhere('status', 'LIKE',"%{$search}%")
                    ->where('status','=','1')
                    ->count();
        }
		
		$data = array();
        if(!empty($rates))
        {
            foreach ($rates as $rate)
            {
                $delete =  route('rates.destroy',$rate['id']);
                $edit =  route('rates.store',$rate['id']);
				$autoid = $rate['id'];
                $nestedData['rate_name'] = $rate['rate_name'];
                $nestedData['status'] = $rate['status'] ? '<span class="text-success text-bold text-center">Active</span>' : '<span class="text-danger text-bold text-center">Deactive</span>';
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
	public function findNameExists(Request $request)
    { 
         $rate_name =  $request->input('rate_name');
         $id = $request->input('rate_id');
        if(!empty($id))
        { 
            $data_exists = Rate::where([
                  ['rate_name','=',$rate_name],
                  ['id','!=',$id],
                  ['status','=','1']
                  ])->count();
        }
        else
        {   
            $data_exists = Rate::where([
                ['rate_name','=',$rate_name],
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
	public function get_rate_detail(Request $request)
    {
        $id = $request->id;
        $data = Rate::find($id);
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
                'rate_name' => 'required'
            ], 
            [
                'rate_name.required' => 'please enter rate name'
            ]
        );
		$saveData = $this->Rate->saveData($data);
		if($saveData == true)
		{
			return  redirect('/rates')->with('type', 'Success!')->with('message', 'Rate details inserted successfully!')->with('alertClass', 'alert alert-success');
		}
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Model\Rate  $rate
     * @return \Illuminate\Http\Response
     */
    public function show(Rate $rate)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Model\Rate  $rate
     * @return \Illuminate\Http\Response
     */
    public function edit(Rate $rate)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Model\Rate  $rate
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Rate $rate)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Model\Rate  $rate
     * @return \Illuminate\Http\Response
     */
    public function destroy(Rate $rate)
    {
        $id = $rate->id;
        $rate = new Rate();
        $rate = Rate::find($id);
        $rate->where('id','=',$id)->update(['status'=>'0']);
        return  redirect('/rates')->with('type', 'Danger!')->with('message', 'Rate details deleted successfully!')->with('alertClass', 'alert alert-danger');
    }
}
