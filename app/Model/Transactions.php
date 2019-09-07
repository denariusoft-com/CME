<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Transactions extends Model
{
    protected $table = 'transactions';
	protected $fillable = ['moor_mas_id','ts_id','datetime','client_id','ratemas_id','tot_hrs','exceed_hrs','bas_sal_amt','exhrs_amt','totpay_amt','status','created_by','updated_by','complete_operation'];
	public $timestamps = true;
}
