<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Rate extends Model
{
    protected $table = 'rates';
	protected $fillable = ['id','rate_name','status','created_by','updated_by'];
	public $timestamps = true;
	
	public function saveData($data=array())
    {
        if (!empty($data['id'])) {
            $savedata = Rate::find($data['id'])->update($data);
        } else {
            $savedata = Rate::create($data);
        }
        return $savedata;
    }
}

