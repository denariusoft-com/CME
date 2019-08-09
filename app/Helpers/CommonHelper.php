<?php // Code within app\Helpers\Helper.php
namespace App\Helpers;
use DB;
use Carbon\Carbon;
use App\User;
use Illuminate\Support\Facades\Auth;

class CommonHelper
{
    public static function theme_setting()
    {
        $themeset = DB::table('themesetting')->where('status', '1')->latest()->first();
        $themerecord = isset($themeset) ? $themeset : ""; 
        return $themerecord;
    } 
    public static function cmpy_setting()
    {
        $companyset = DB::table('companysetting')->where('status', '1')->latest()->first();
        $companyrecord = isset($companyset) ? $companyset : "";     
        return $companyrecord;
    } 
    public static function client_count()
    {
        $clientct = DB::table('clients')->count();
        return $clientct;
    } 
	public static function mooring_count()
    {
        $mooringct = DB::table('mooring_details')->count();
        return $mooringct;
    } 
}