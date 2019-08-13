<?php

namespace App\Model;
use DB;
use Illuminate\Database\Eloquent\Model;

class Themesetting extends Model
{
    protected $table = 'themesetting';
	protected $fillable = ['logo','favicon','status'];
	public $timestamps = true;
    //
public function save_themesetting($data){
    if (!empty($data['id'])) {			
        $savedata = Themesetting::find($data['id'])->update($data);    
    } else {
        $data['status'] =1;
        $savedata = Themesetting::create($data);
    }
    return $savedata;
    
}
}
