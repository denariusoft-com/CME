<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class StsAdditional extends Model
{
    protected $table = 'sts_ts_additional';
	protected $fillable = ['sta_id','ts_id','wind','sea','swell','product','tonnes_discharge','tonnes_loading','barrels_discharge','barrels_loading','incident_occured','overtime_remarks','commence_operation','complete_operation','total_exceed_hrs','delays_remark'];
	public $timestamps = true;
}
