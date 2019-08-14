<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class StsAdditional extends Model
{
    protected $table = 'sts_ts_additional';
	protected $fillable = ['ts_id','commence_operation','complete_operation'];
	public $timestamps = true;
}
