<?php


namespace App\Http\Controllers;


use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use DB;


class RoleController extends Controller
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
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $roles = Role::orderBy('id','DESC')->paginate(5);
        $permission = Permission::get();
        return view('settings.roles',compact('roles','permission'))
            ->with('i', ($request->input('page', 1) - 1) * 5);
    }
    public function store(Request $request)
    {
        if(!empty($request->input('id'))){
            $this->validate($request, [
                'name' => 'required',
                //'permission' => 'required',
            ]);
            $id = $request->input('id');           
            $role = Role::find($id);
            $role->name = $request->input('name');
            $role->save();  
            $role->syncPermissions($request->input('permission'));
            $message = 'Role updated successfully';           
        }else{       
            $this->validate($request, [
                'name' => 'required|unique:roles,name',
                //'permission' => 'required',
            ]);    
            $role = Role::create(['name' => $request->input('name')]);
            $role->syncPermissions($request->input('permission'));
            $message = 'Role created successfully';           
        }
        return redirect()->route('roles.index')
        ->with('success',$message);
    }
    public function show(Request $request)
    {
        $id = $request->id;
        $role=array();
        $role = Role::find($id);
        $permission = Permission::get();
        $rolePermissions = Permission::join("role_has_permissions","role_has_permissions.permission_id","=","permissions.id")
            ->where("role_has_permissions.role_id",$id)
            ->get();
         $role['permission_detail'] =  $rolePermissions;
       
        return json_encode($role);
    }  
    public function destroy($id)
    {
        DB::table("roles")->where('id',$id)->delete();
        return redirect()->route('roles.index')
                        ->with('success','Role deleted successfully');
    }
}