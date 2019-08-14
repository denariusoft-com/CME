<?php

namespace App\Http\Controllers;

use App\Model\Mooring_master;
use App\Model\Status;
use App\Model\Ratemaster;
use App\Model\Rate;
use App\Model\Category;
use App\User;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

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
        $this->User = new User;
       
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
                $edit =  route('mooring_masters.edit',$mooring_master['id']);
				$autoid = $mooring_master['id'];
                $nestedData['address'] = $mooring_master['address'];
                $nestedData['phone_no'] = $mooring_master['phone_no'];
                $nestedData['email'] = $mooring_master['email'];
                $nestedData['company_id'] = $mooring_master['company_id'];
                $nestedData['salary'] = $mooring_master['salary'];
                $nestedData['options'] = "&emsp;<a style='float: left;' href='{$edit}' title='EDIT' class='btn btn-primary'><i class='fa fa-pencil'></i></a>";
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
		$data = $request->all();
		
       /* $request->validate(
            [
                'user_id' => 'required',
                'short_code' => 'required',
                'address' => 'required',
                'phone_no' => 'required',
                'email' => 'required',
                'company_id' => 'required',
                'acc_no' => 'required',
                'salary' => 'required',
                'status_id' => 'required',
                'date_recruit' => 'required'
                //'category_id' => 'required',
                //'rate_id' => 'required',
                //'mooring_rate_id' => 'required'
            ], 
            [
                'user_id.required' => 'please enter user name',
                'short_code.required' => 'please enter short code',
                'address.required' => 'please enter address name',
                'phone_no.required' => 'please enter phone number',
                'email.required' => 'please enter email name',
                'company_id.required' => 'please enter company name',
                'acc_no.required' => 'please enter account number',
                'salary.required' => 'please enter salary',
                'status_id.required' => 'please select status',
                'date_recruit.required' => 'please select date recruit'
                //'category_id.required' => 'please select category name',
                //'rate_id.required' => 'please select rate name',
                //'mooring_rate_id.required' => 'please enter price name'
            ]
        );*/
		//dd($data);
        $auto_id = $request->input('auto_id');
       
        //$data['user_id'] = $request->input('user_id');
        
        //$data['category_id'] = $request->input('category_id');
        //$data['rate_id'] = $request->input('rate_id');
        //$data['mooring_rate_id'] = $request->input('mooring_rate_id');
        $files = $request->file('resume');  
		$resume_name="";
        if(!empty($files))
        {
            $resume_name = time().'.'.$files->getClientOriginalExtension();
            $files->move('public/images/resume/',$resume_name);
            //$data['resume'] = $resume_name;
        }
		
        $data['address'] = $request->input('address');
        $data['short_code'] = $request->input('short_code');
        $data['phone_no'] = $request->input('phone_no');
        $data['email'] = $request->input('email');
        $data['company_id'] = $request->input('company_id');
        $data['acc_no'] = $request->input('acc_no');
        $data['salary'] = $request->input('salary');
        $data['status_id'] = $request->input('status_id');
        $data['created_by'] = $request->input('created_by');
        $data['updated_by'] = $request->input('updated_by');
        $data['resume'] = $resume_name; 
		$date = str_replace('/', '-', $request->input('date_recruit'));
		$data['date_recruit'] = date("Y-m-d", strtotime($date));
		//dd($data);
        if($auto_id == "")
        {
			
            //$random = str_shuffle('abcdefghjklmnopqrstuvwxyzABCDEFGHJKLMNOPQRSTUVWXYZ1234567890!$%^&!$%^&');
            //$randompass = substr($random, 0, 10);
            $user_data = new User();
            $user_data['name'] = $request->input('user_id');
            $user_data['email'] = $request->input('email');
            $user_data['password'] = bcrypt('moor12345');
            $user_data->save();
            //$user = User::create($user_data);
            //$user_id = $user->id;
            $user_data->assignRole('Mooring Master');
            $data['user_id'] = $user_data->id;
             $saveData = $this->Mooring_master->saveData($data);
            if($saveData == true)
            {
                return  redirect('/mooring_masters')->with('type', 'Success!')->with('message', 'Mooring master details inserted successfully!')->with('alertClass', 'alert alert-success');
            }
        }
        else
        {
			
            $data['user_id'] = $request->input('auto_id');
            $updateData = $this->Mooring_master->saveData($data);
            if($updateData == true)
            {
                return  redirect('/mooring_masters')->with('type', 'Update!')->with('message', 'Mooring master details updated successfully!')->with('alertClass', 'alert alert-warning');
            }
        }
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
        $id = $mooring_master->id;
		$data['editData'] = Mooring_master::find($id);
		$data['status_detail'] = Status::all();
        return view('master.mooring_master.add_edit')->with('data',$data);
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
        $id = $mooring_master->id;
        $mooring_master = new Mooring_master();
        $mooring_master = Mooring_master::find($id);
		$mooring_master->where('id','=',$id)->update(['status'=>'0']);
		
		$user_id = $mooring_master->user_id;
		//$user = new User();
        $user = User::where('id','=',$user_id)->update(['status'=>'0']);
		
        return  redirect('/mooring_masters')->with('type', 'Danger!')->with('message', 'Mooring master detail deleted successfully!')->with('alertClass', 'alert alert-danger');
    }
}
