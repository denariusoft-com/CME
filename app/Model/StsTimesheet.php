<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class StsTimesheet extends Model
{
    protected $table = 'sts_timesheet';
	protected $fillable = ['user_id','location','job_ref_id'];
	public $timestamps = true;
    //
    /*public function save_themesetting($data){
        if (!empty($data['id'])) {			
            $savedata = Themesetting::find($data['id'])->update($data);    
        } else {
            $data['status'] =1;
            $savedata = Themesetting::create($data);
        }
        return $savedata;
         if($select == "") $select = "can.*";
              $this->db->select($select);        
              $this->db->from("candidates as can");        

        
    }*/
    public function getTimesheet_data( $select = "*", $where = array(), $or_where = array(),$join ="",$orderby = array(), $limit="", $offset = 0) {
          \DB::enableQueryLog();
          $query = StsTimesheet::query();
          if ($select == "") $select = "*";
          $query->select($select);
          $query->from("sts_timesheet as sts"); 
          if (is_array($where)) {
              if (!empty($where))
                  $query->where($where);
          } elseif ($where != "") {
              $query->where($where);
          }
          if (!empty($or_where)) {
              $whereor = "";
              foreach ($or_where as $orw) {
                  $query->orWhere($orw[0], $orw[1], $orw[2]);
               }
          }
         if(is_array($join) && !empty($join)) {
            foreach($join as $k=>$v){
                if(is_array($v)) $query->leftjoin($k, $v[0],'=', $v[1]);
                else $query->leftjoin($k, $v);
            }
         }
         if(is_array($orderby) && !empty($orderby)) {
              $query->orderBy($orderby[0], $orderby[1]);
         }
           if((int)$limit != 0) $query->limit($limit, $offset);
          $scrapper = $query->get();
          return $scrapper;
          //$query = \DB::getQueryLog();
          //return $query;
      }
}
