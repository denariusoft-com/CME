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




class ReportController extends Controller
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
    public function index()
    {
         return view('reports.summaryreport');
    }
  
    /*          end theme       */
   public function show(){

   }
}