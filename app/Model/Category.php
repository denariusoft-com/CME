<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $table = 'categories';
	protected $fillable = ['id','category_name','status','created_by','updated_by'];
	public $timestamps = true;
	
	public function saveData($data=array())
    {
        if (!empty($data['id'])) {
            $savedata = Category::find($data['id'])->update($data);
        } else {
            $savedata = Category::create($data);
        }
        return $savedata;
    }
	
	

}
