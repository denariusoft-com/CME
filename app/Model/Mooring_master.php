<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Mooring_master extends Model
{
	protected $table = 'mooring_masters';
	protected $fillable = ['id','user_id','address','phone_no','email','company_id','acc_no','salary','resume','status_id','date_recruit','category_id','rate_id','mooring_rate_id','status','created_by','updated_by'];
	public $timestamps = true;
	
	public function saveData($data=array())
    {
        if (!empty($data['id'])) {
            $savedata = Mooring_master::find($data['id'])->update($data);
        } else {
            $savedata = Mooring_master::create($data);
        }
        return $savedata;
    }
	public function ratemasters()
	{
		return $this->hasMany(Ratemaster::class);
	}
    
}
