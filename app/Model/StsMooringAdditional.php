<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class StsMooringAdditional extends Model
{
    protected $table = 'sts_mr_addition';
	protected $fillable = ['mra_id','ts_id','hose_con_fl','hose_con_af','hose_con_na','con_gauge_etc_fl','con_gauge_etc_af','con_gauge_etc_na','checklist4_fl','checklist4_af','checklist4_na','cargo_oper_fl','cargo_oper_af','cargo_oper_na','hose_discon_fl','hose_discon_af','hose_discon_na','discon_gauge_etc_fl','discon_gauge_etc_af','discon_gauge_etc_na','checklist5_fl','checklist5_af','checklist5_na'];
	public $timestamps = true;
}
