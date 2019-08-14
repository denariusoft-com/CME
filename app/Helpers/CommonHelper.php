<?php // Code within app\Helpers\Helper.php
namespace App\Helpers;
use DB;
use Carbon\Carbon;
use App\User;
use Auth;
use App\Model\Client;

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
        $mooringct = DB::table('mooring_masters')->count();
        return $mooringct;
    } 
    public static function profile_img($id)
    {
        $profset = user::find($id);
        $userprof = isset($profset) ? $profset : ""; 
        return $userprof;
    } 
    public static function client_detail($id)
    {
        $clientset = client::find($id);
        $clientprof = isset($clientset) ? $clientset : ""; 
        return $clientprof;
    } 
    public static function convert_date_database($date){
       // $date = "02/2022";
        $date_array = explode("/",$date);  
        $length = strlen($date_array[1]);
        $time[0] = substr($date_array[1], 0, 2);
        $time[1] = substr($date_array[1], 2, $length );  

        $date_format = date('Y')."-".date('m')."-".$date_array[0]." ".$time[0].":". $time[1];       							
        //$converted_date = date('Y-m-d H:i', strtotime($date_format));
        return $date_format;
     }
}