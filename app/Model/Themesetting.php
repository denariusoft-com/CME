<?php

namespace App\Model;
use DB;
use Illuminate\Database\Eloquent\Model;
use App\User;

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
public function save_profileimg($data){
    $update = User::find($data['id']);
    $update->profile_img = $data['profile_img'];
    $update->save();
    return $update;        
}
}
