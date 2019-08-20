<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use App\Helpers\CommonHelper;

class StsUnmooringTugs extends Model
{
    protected $table = 'ts_unmooring_tugs';
	protected $fillable = ['umt_id','ts_id','unmr_tug_name','unmr_tug_fl','unmr_tug_af','unmr_tug_na'];
	public $timestamps = true;
	public function saveData($data=array())
    {
       $ts_id = $data[0]['ts_id'];
        for($i=0; $i< count($data['unmr_tug_name']); $i++) {            
           // if(empty($data['cat_id'][$i]) || !is_numeric($data['cat_id'][$i])) continue;
         
        $dataar = [ 
            'ts_id' => $ts_id,
            'unmr_tug_name' => $data['unmr_tug_name'][$i], 
            'unmr_tug_fl' => CommonHelper::convert_date_database($data['unmr_tug_fl'][$i]), 
            'unmr_tug_af' => CommonHelper::convert_date_database($data['unmr_tug_af'][$i]),
            'unmr_tug_na' => CommonHelper::convert_date_database($data['unmr_tug_na'][$i])
        ];
            //var_dump($data);
            if (!empty($data['id'])) {
                $savedata = StsUnmooringTugs::find($data['id'])->update($dataar);
            } else {
               $savedata = StsUnmooringTugs::create($dataar);
            }
          
        }   
       
        return $savedata;     
    }
}
