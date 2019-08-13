<?php
namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Ratemaster extends Model
{
    protected $table = 'ratemasters';
	protected $fillable = ['id','user_id','cat_id','rate_id','timing','price','status','created_by','updated_by'];
	public $timestamps = true;
	
	public function saveData($data=array())
    {
       
        for($i=0; $i< count($data['category_id']); $i++) {            
           // if(empty($data['cat_id'][$i]) || !is_numeric($data['cat_id'][$i])) continue;
         
          $dataar = [ 
            'user_id' => $data['user_id'],
            'cat_id' => $data['category_id'][$i], 
            'rate_id' => $data['rate_id'][$i], 
            'timing' => $data['timing'][$i],
            'price' => $data['price'][$i],
            'updated_by' => $data['updated_by'] 
         ];
            //var_dump($data);
            if (!empty($data['id'])) {
                $savedata = Ratemaster::find($data['id'])->update($dataar);
            } else {
               $dataar['created_by'] = $data['created_by'];
               $savedata = Ratemaster::create($dataar);
            }
          
        }   
       
        return $savedata;     
    }
	public function user()
    {
        return $this->belongsTo(User::class);
    }
	public function mooring_master()
    {
        return $this->belongsTo(Mooring_master::class);
    }
}
