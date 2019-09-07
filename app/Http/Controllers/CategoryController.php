<?php

namespace App\Http\Controllers;

use App\Model\Category;
use Illuminate\Http\Request;
use App\Helpers\CommonHelper;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
	public function __construct() {
		
        $this->Category = new Category;
       
    }
    public function index()
    {
        return view('master.category.list');
    }
	public function get_category_list(Request $request)
	{
		$columns = array( 
            0 => 'category_name', 
            1 => 'status', 
            2 => 'options'
        );
        $totalData = Category::where('status','=','1')
        ->count();
        $totalFiltered = $totalData; 
        $limit = $request->input('length');
        
        $start = $request->input('start');
        $order = $columns[$request->input('order.0.column')];
        $dir = $request->input('order.0.dir');
		if(empty($request->input('search.value')))
        {            
            if( $limit == -1){
                $categories = Category::select('id','category_name','status')->orderBy($order,$dir)
                ->where('status','=','1')
                ->get()->toArray();
            }else{
                $categories = Category::select('id','category_name','status')->offset($start)
                ->limit($limit)
                ->orderBy($order,$dir)
                ->where('status','=','1')
                ->get()->toArray();
            }
        }
		else {
        $search = $request->input('search.value'); 
        if( $limit == -1){
            $categories     =  Category::select('id','category_name','status')
						->where('id','LIKE',"%{$search}%")
                        ->orWhere('category_name', 'LIKE',"%{$search}%")
                        ->orWhere('status', 'LIKE',"%{$search}%")
                        ->where('status','=','1')
                        ->orderBy($order,$dir)
                        ->get()->toArray();
        }else{
            $categories      = Category::select('id','category_name','status')
						->where('id','LIKE',"%{$search}%")
                        ->orWhere('category_name', 'LIKE',"%{$search}%")
                        ->orWhere('status', 'LIKE',"%{$search}%")
                        ->offset($start)
                        ->limit($limit)
                        ->where('status','=','1')
                        ->orderBy($order,$dir)
                        ->get()->toArray();
        }
        $totalFiltered = Category::where('id','LIKE',"%{$search}%")
                    ->orWhere('category_name', 'LIKE',"%{$search}%")
                    ->orWhere('status', 'LIKE',"%{$search}%")
                    ->where('status','=','1')
                    ->count();
        }
		
		$data = array();
        if(!empty($categories))
        {
            foreach ($categories as $category)
            {
                $delete =  route('categories.destroy',$category['id']);
                $edit =  route('categories.store',$category['id']);
				$autoid = $category['id'];
                $nestedData['category_name'] = $category['category_name'];
                $nestedData['status'] = $category['status'] ? '<span class="text-success text-bold text-center">Active</span>' : '<span class="text-danger text-bold text-center">Deactive</span>';
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
         $category_name =  $request->input('category_name');
         $id = $request->input('category_id');
        if(!empty($id))
        { 
            $data_exists = Category::where([
                  ['category_name','=',$category_name],
                  ['id','!=',$id],
                  ['status','=','1']
                  ])->count();
        }
        else
        {   
            $data_exists = Category::where([
                ['category_name','=',$category_name],
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
	public function get_category_detail(Request $request)
    {
        $id = $request->id;
        $data = Category::find($id);
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
                'category_name' => 'required'
            ], 
            [
                'category_name.required' => 'please enter category name'
            ]
        );

		$saveData = $this->Category->saveData($data);
            
		if($saveData == true)
		{
			return  redirect('/categories')->with('type', 'Success!')->with('message', 'Category details inserted successfully!')->with('alertClass', 'alert alert-success');
		}
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Model\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function show(Category $category)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Model\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function edit(Category $category)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Model\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Category $category)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Model\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function destroy(Category $category)
    {
        $id = $category->id;
        $category = new Category();
        $category = Category::find($id);
        $category->where('id','=',$id)->update(['status'=>'0']);
        return  redirect('/categories')->with('type', 'Danger!')->with('message', 'Category details deleted successfully!')->with('alertClass', 'alert alert-danger');
    }
}
