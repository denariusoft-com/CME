<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
	protected $table = 'clients';
	protected $fillable = ['id','client_name','client_shortcode','status','created_by','updated_by'];
	public $timestamps = true;
	
	public function saveData($data=array())
    {
        if (!empty($data['id'])) {
            $savedata = Client::find($data['id'])->update($data);
        } else {
            $savedata = Client::create($data);
        }
        return $savedata;
    }
}
