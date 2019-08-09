<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Status extends Model
{
    protected $table = 'statuses';
	protected $fillable = ['id','status_name','status','created_by','updated_by'];
	public $timestamps = true;
	
	public function saveData($data=array())
    {
        if (!empty($data['id'])) {
            $savedata = Status::find($data['id'])->update($data);
        } else {
            $savedata = Status::create($data);
        }
        return $savedata;
    }
}
