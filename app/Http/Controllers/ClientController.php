<?php

namespace App\Http\Controllers;

use App\Model\Client;
use Illuminate\Http\Request;

class ClientController extends Controller
{
	public function __construct() {
		
        $this->Client = new Client;
       
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //$clients = Client::all();
		return view('master.client.list');
    }
	public function get_client_list(Request $request)
	{
		$columns = array( 
            0 => 'client_name', 
            1 => 'client_shortcode', 
            2 => 'status', 
            3 => 'options'
        );
        $totalData = Client::where('status','=','1')
        ->count();
        $totalFiltered = $totalData; 
        $limit = $request->input('length');
        
        $start = $request->input('start');
        $order = $columns[$request->input('order.0.column')];
        $dir = $request->input('order.0.dir');
		if(empty($request->input('search.value')))
        {            
            if( $limit == -1){
                $clients = Client::select('id','client_name','client_shortcode','status')->orderBy($order,$dir)
                ->where('status','=','1')
                ->get()->toArray();
            }else{
                $clients = Client::select('id','client_name','client_shortcode','status')->offset($start)
                ->limit($limit)
                ->orderBy($order,$dir)
                ->where('status','=','1')
                ->get()->toArray();
            }
        }
		else {
        $search = $request->input('search.value'); 
        if( $limit == -1){
            $clients     =  Client::select('id','client_name','client_shortcode','status')
						->where('id','LIKE',"%{$search}%")
                        ->orWhere('client_name', 'LIKE',"%{$search}%")
                        ->orWhere('client_shortcode', 'LIKE',"%{$search}%")
                        ->orWhere('status', 'LIKE',"%{$search}%")
                        ->where('status','=','1')
                        ->orderBy($order,$dir)
                        ->get()->toArray();
        }else{
            $clients      = Client::select('id','client_name','client_shortcode','status')
						->where('id','LIKE',"%{$search}%")
                        ->orWhere('client_name', 'LIKE',"%{$search}%")
                        ->orWhere('client_shortcode', 'LIKE',"%{$search}%")
                        ->orWhere('status', 'LIKE',"%{$search}%")
                        ->offset($start)
                        ->limit($limit)
                        ->where('status','=','1')
                        ->orderBy($order,$dir)
                        ->get()->toArray();
        }
        $totalFiltered = Client::where('id','LIKE',"%{$search}%")
                    ->orWhere('client_name', 'LIKE',"%{$search}%")
                    ->orWhere('client_shortcode', 'LIKE',"%{$search}%")
                    ->orWhere('status', 'LIKE',"%{$search}%")
                    ->where('status','=','1')
                    ->count();
        }
		
		$data = array();
        if(!empty($clients))
        {
            foreach ($clients as $client)
            {
                $delete =  route('clients.destroy',$client['id']);
                $edit =  route('clients.store',$client['id']);
				$autoid = $client['id'];
                $nestedData['client_name'] = $client['client_name'];
                $nestedData['client_shortcode'] = $client['client_shortcode'];
                $nestedData['status'] = $client['status'] ? '<span class="text-success text-bold text-center">Active</span>' : '<span class="text-danger text-bold text-center">Deactive</span>';
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
         $client_name =  $request->input('client_name');
         $id = $request->input('client_id');
        if(!empty($id))
        { 
            $data_exists = Client::where([
                  ['client_name','=',$client_name],
                  ['id','!=',$id],
                  ['status','=','1']
                  ])->count();
        }
        else
        {   
            $data_exists = Client::where([
                ['client_name','=',$client_name],
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

	public function get_client_detail(Request $request)
    {
        $id = $request->id;
        //$client = new Client();
        $data = Client::find($id);
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
                'client_name' => 'required',
                'client_shortcode' => 'required'
            ], 
            [
                'client_name.required' => 'please enter client name',
                'client_shortcode.required' => 'please enter client short code'
            ]
        );

		$saveData = $this->Client->saveData($data);
            
		 if($saveData == true)
		 {
			return  redirect('/clients')->with('type', 'Success!')->with('message', 'Client details inserted successfully!')->with('alertClass', 'alert alert-success');
		 }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Client  $client
     * @return \Illuminate\Http\Response
     */
    public function show(Client $client)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Client  $client
     * @return \Illuminate\Http\Response
     */
    public function edit(Client $client)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Client  $client
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Client $client)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Client  $client
     * @return \Illuminate\Http\Response
     */
    public function destroy(Client $client)
    {
        $id = $client->id;
        $client = new Client();
        $client = Client::find($id);
        $client->where('id','=',$id)->update(['status'=>'0']);
        return  redirect('/clients')->with('type', 'Danger!')->with('message', 'Client details deleted successfully!')->with('alertClass', 'alert alert-danger');
    }
}
