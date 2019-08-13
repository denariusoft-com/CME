<?php


namespace App\Http\Controllers;


use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use DB;
use App\Model\Companysetting;


class SettingController extends Controller
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
         $this->Companysetting = new Companysetting;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    /*                   company setting                 */
    public function index(Request $request)
    {
        $companyset = DB::table('companysetting')->where('status', '1')->latest()->first();
        $companyrecord = isset($companyset) ? $companyset : "";     
        //dd($companyrecord);   
        return view('settings.companysettings')->with('cmpyrec', $companyrecord);
		
    }
    public function saveCompanysetting(Request $request)
    {    
     $data = $request->all();     
     $request->validate([
        'company_name' => 'required',
            ], [
        'company_name.required' => 'please enter Company name',
    ]);   
    $saveCmpy_set = $this->Companysetting->save_companysetting($data);
    if ($saveCmpy_set == true) {
        
        if(!empty($request->id))
        {
            $message = 'Company Name Updated Succesfully';
        }
        else{
            $message = 'Company Name Added Succesfully';
        }        
        return redirect('/settings')->with('type', 'Success!')->with('message', $message)->with('alertClass', 'alert alert-success');
    }
    }
    /*               end company set */
    /*      theme setting           */
    public function themesettings()
    {
        return view('settings.themesettings');
    }
    /*          end theme       */
   public function show(){

   }
}