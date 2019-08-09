<?php
namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Ratemaster extends Model
{
    protected $table = 'ratemasters';
	protected $fillable = ['id','cat_id','rate_id','price','status','created_by','updated_by'];
	public $timestamps = true;
	
	public function saveData($data=array())
    {
        if (!empty($data['id'])) {
            $savedata = Ratemaster::find($data['id'])->update($data);
        } else {
            $savedata = Ratemaster::create($data);
        }
        return $savedata;
    }
}
