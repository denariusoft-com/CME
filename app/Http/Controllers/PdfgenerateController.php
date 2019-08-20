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
use App\Model\StsTimesheet;
use App\User;
use PDF;

class PdfgenerateController extends Controller
{
    public function timesheet_pdf($id)
    {
         $data = ['title' => 'Welcome to HDTuto.com'];
         $data['timesheet_details'] = CommonHelper::timesheet_id($id);
         dd($data['timesheet_details']);
         exit;
         $pdf = PDF::loadView('content.reports.timesheetpdf', $data);
         return  $pdf->stream();
    }
}
