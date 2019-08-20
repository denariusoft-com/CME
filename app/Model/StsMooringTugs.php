<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use App\Helpers\CommonHelper;

class StsMooringTugs extends Model
{
    protected $table = 'ts_mooring_tugs';
	protected $fillable = ['mt_id','ts_id','mr_tug_name','mr_tug_firstline','mr_tug_allfast','mr_tug_noraccepted'];
	public $timestamps = true;
	
	public function saveData($data=array())
    {
       //dd($data[0]['ts_id']);
	   $ts_id = $data[0]['ts_id'];
        for($i=0; $i< count($data['mr_tug_name']); $i++) {            

        $dataar = [ 
            'ts_id' => $ts_id,
            'mr_tug_name' => $data['mr_tug_name'][$i], 
            'mr_tug_firstline' => CommonHelper::convert_date_database($data['mr_tug_firstline'][$i]), 
            'mr_tug_allfast' => CommonHelper::convert_date_database($data['mr_tug_allfast'][$i]),
            'mr_tug_noraccepted' => CommonHelper::convert_date_database($data['mr_tug_noraccepted'][$i])
        ];
            if (!empty($data['id'])) {
                $savedata = StsMooringTugs::find($data['id'])->update($dataar);
            } else {
               $savedata = StsMooringTugs::create($dataar);
            }
          
        }   
       
        return $savedata;     
    }
}
