<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class StsUnmooringAdditional extends Model
{
    protected $table = 'sts_unmr_addition';
	protected $fillable = ['sumra_id','ts_id','unmooring_firstline','unmooring_allfast','unmooring_noraccepted','unfendering_fl','unfendering_af','unfendering_na','unmr_support_craft_fl','unmr_support_craft_af','unmr_support_craft_na','rigging_ashore_fl','rigging_ashore_af','rigging_ashore_na'];
	public $timestamps = true;
}
