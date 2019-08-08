<?php

namespace App\Model;
use DB;
use Illuminate\Database\Eloquent\Model;

class Companysetting extends Model
{
    protected $table = 'companysetting';
	protected $fillable = ['company_name','contact_person','country','state','city','email','phone_no','website_url','mobile_no','postal_code','address','status'];
	public $timestamps = true;

	public function save_Companysetting($data){
		if (!empty($data['id'])) {			
				$savedata = Companysetting::find($data['id'])->update($data);
			
			} else {
				$data['status'] =1;
				$savedata = Companysetting::create($data);
			}
			return $savedata;
	}
}
