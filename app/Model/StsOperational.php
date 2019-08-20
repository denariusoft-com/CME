<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class StsOperational extends Model
{
    protected $table = 'sts_ts_oper_timings';
	protected $fillable = ['stot_id','ts_id','support_craft_transit_start','support_craft_transit_finish','support_craft_transit_notes','fendering_start','fendering_finish','fendering_notes','checklist2_start','checklist2_finish','checklist2_notes','checklist3_start','checklist3_finish','checklist3_notes','mooring_firstline','mooring_allfast','mooring_noraccepted'];
	public $timestamps = true;
}
