<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
	protected $table = 'clients';
	protected $fillable = ['id','client_name','status','created_by','updated_by'];
	public $timestamps = true;
}
