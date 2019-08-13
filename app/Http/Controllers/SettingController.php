<?php


namespace App\Http\Controllers;


use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use DB;
use App\Model\Companysetting;
use App\Model\Themesetting;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Input;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use \Illuminate\Filesystem\FilesystemManager;
use Illuminate\Contracts\Filesystem\Factory as Filesystem;
use Carbon\Carbon;
use Illuminate\Http\File;
use App\Helpers\CommonHelper;




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
         $this->Themesetting = new Themesetting;
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
    /*      end company set         */
    /*      theme setting           */
    public function themesettings()
    {
        return view('settings.themesettings');
    }
    public function themesettingsave(Request $request)
    {    
    $data = $request->all();  
    $allowed_ext = ['PNG','JPG','jpg','JPEG','png'];
    $directoryPath = storage_path('app/public/images');
    if ($request->hasFile('logo')) {
        $filesize = $request->file('logo')->getClientSize();
        $filetype = $request->file('logo')->getClientOriginalExtension();
        $check_ext = in_array($filetype, $allowed_ext);
        $mydt = Carbon::now()->timestamp;
        if($check_ext) {            
            $logofilename = $mydt . "_". "logo".".".$filetype;
            $dir = (is_dir($directoryPath)) ? $request->file('logo')->storeAS('images', $logofilename, 'public') : mkdir($directoryPath, 0777, true);
            $data['logo'] = $logofilename;
        }
    }
    if ($request->hasFile('favicon')) {
        $favfilesize = $request->file('favicon')->getClientSize();
        $favfiletype = $request->file('favicon')->getClientOriginalExtension();        
        $check_extfav = in_array($favfiletype, $allowed_ext);
        $mydt = Carbon::now()->timestamp;
        if($check_extfav) {          
            $favfilename = $mydt . "_". "favicon".".".$favfiletype;
            $dir = (is_dir($directoryPath)) ? $request->file('favicon')->storeAS('images', $favfilename, 'public') : mkdir($directoryPath, 0777, true);
            $data['favicon'] = $favfilename;
        }
    }
    //dd($data);
    $savetheme_set = $this->Themesetting->save_themesetting($data);
    if ($savetheme_set == true) {
        if(!empty($request->id))
        {
            $message = 'Theme setting Updated Succesfully';
        }
        else{
            $message = 'Theme Setting Added Succesfully';
        }        
        return redirect('/settings/themesettings')->with('success', $message);
    }
    }
    /*          end theme       */
   public function show(){

   }
}