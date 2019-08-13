<?php

namespace App\Http\Controllers;

use App\Model\Category;
use App\Model\Rate;
use App\Model\Ratemaster;
use App\Model\Mooring_master;
use App\User;
use Illuminate\Http\Request;
use DB;

class RatemasterController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
	public function __construct() {
		
        $this->Ratemaster = new Ratemaster;
        $this->Mooring_master = new Mooring_master;
        $this->User = new User;
       
    }
    public function index()
    {
		return view('master.ratemaster.list');
    }
	public function get_ratemaster_list(Request $request)
	{
		$columns = array( 
            0 => 'cat_id', 
            1 => 'rate_id', 
            2 => 'price', 
            3 => 'options'
        );
        $totalData = Ratemaster::where('status','=','1')
        ->count();
        $totalFiltered = $totalData; 
        $limit = $request->input('length');
        
        $start = $request->input('start');
        $order = $columns[$request->input('order.0.column')];
        $dir = $request->input('order.0.dir');
		if(empty($request->input('search.value')))
        {            
            if( $limit == -1){
                $ratemasters = Ratemaster::select('id','cat_id','rate_id','price')->orderBy($order,$dir)
				->where('status','=','1')
                ->get()->toArray();
            }else{
                $ratemasters = Ratemaster::select('id','cat_id','rate_id','price')->offset($start)
                ->limit($limit)
                ->orderBy($order,$dir)
				->where('status','=','1')
                ->get()->toArray();
            }
        }
		else {
        $search = $request->input('search.value'); 
        if( $limit == -1){
            $ratemasters =  Ratemaster::select('id','cat_id','rate_id','price')
						->where('id','LIKE',"%{$search}%")
                        ->orWhere('cat_id', 'LIKE',"%{$search}%")
                        ->orWhere('rate_id', 'LIKE',"%{$search}%")
                        ->orWhere('price', 'LIKE',"%{$search}%")
                        ->orderBy($order,$dir)
						->where('status','=','1')
                        ->get()->toArray();
        }else{
            $ratemasters      = Ratemaster::select('id','cat_id','rate_id','price')
						->where('id','LIKE',"%{$search}%")
                        ->orWhere('cat_id', 'LIKE',"%{$search}%")
                        ->orWhere('rate_id', 'LIKE',"%{$search}%")
                        ->orWhere('price', 'LIKE',"%{$search}%")
                        ->offset($start)
                        ->limit($limit)
						->where('status','=','1')
                        ->orderBy($order,$dir)
                        ->get()->toArray();
        }
        $totalFiltered = Ratemaster::where('id','LIKE',"%{$search}%")
                    ->orWhere('cat_id', 'LIKE',"%{$search}%")
                    ->orWhere('rate_id', 'LIKE',"%{$search}%")
                    ->orWhere('price', 'LIKE',"%{$search}%")
					->where('status','=','1')
                    ->count();
        }
		
		$data = array();
        if(!empty($ratemasters))
        {
            foreach ($ratemasters as $ratemaster)
            {
                $delete =  route('ratemasters.destroy',$ratemaster['id']);
                $edit =  route('ratemasters.store',$ratemaster['id']);
				$autoid = $ratemaster['id'];
                $nestedData['cat_id'] = Category::where('id','=', $ratemaster['cat_id'])->first()->category_name;
                $nestedData['rate_id'] = Rate::where('id','=', $ratemaster['rate_id'])->first()->rate_name;
                $nestedData['price'] = $ratemaster['price'];
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
         $price =  $request->input('price');
         $id = $request->input('price_id');
        if(!empty($id))
        { 
            $data_exists = Ratemaster::where([
                  ['price','=',$price],
                  ['id','!=',$id],
                  ['status','=','1']
                  ])->count();
        }
        else
        {   
            $data_exists = Ratemaster::where([
                ['price','=',$price],
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
	public function get_ratemaster_detail(Request $request)
    {
        $id = $request->id;
        $data = Ratemaster::find($id);
        return $data;
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data['category_view'] = Category::all();
        $data['rate_view'] = Rate::all();
		$data['user_view'] = DB::table('mooring_masters')
				->join('users', 'users.id', '=', 'mooring_masters.user_id')
				->get();
				
		//$data['user_view'] = Mooring_master::find(1)->ratemasters()->get();
		return view('master.ratemaster.add_edit')->with('data',$data);
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
                'cat_id' => 'required',
                'rate_id' => 'required',
                'price' => 'required'
            ], 
            [
                'cat_id.required' => 'please enter category name',
                'rate_id.required' => 'please enter rate name',
                'price.required' => 'please enter price name'
            ]
        );
		$saveData = $this->Ratemaster->saveData($data);
		if($saveData == true)
		{
			return  redirect('/ratemasters')->with('type', 'Success!')->with('message', 'Rate master details inserted successfully!')->with('alertClass', 'alert alert-success');
		}
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Mooring_ratemaster  $mooring_ratemaster
     * @return \Illuminate\Http\Response
     */
    public function show(Ratemaster $ratemaster)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Mooring_ratemaster  $mooring_ratemaster
     * @return \Illuminate\Http\Response
     */
    public function edit(Ratemaster $ratemaster)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Mooring_ratemaster  $mooring_ratemaster
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Ratemaster $ratemaster)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Mooring_ratemaster  $mooring_ratemaster
     * @return \Illuminate\Http\Response
     */
    public function destroy(Ratemaster $ratemaster)
    {
        $id = $ratemaster->id;
        $ratemaster = new Ratemaster();
        $ratemaster = Ratemaster::find($id);
        $ratemaster->where('id','=',$id)->update(['status'=>'0']);
        return  redirect('/ratemasters')->with('type', 'Danger!')->with('message', 'Rate master deleted successfully!')->with('alertClass', 'alert alert-danger');
    }
}
