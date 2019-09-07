<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;
use App\User;
use App\Model\Category;
use App\Model\Ratemaster;

class JobController extends Controller
{
    public function add()
	{
		$data['user_view'] = DB::table('mooring_masters')
				->join('users', 'users.id', '=', 'mooring_masters.user_id')
                ->get();
		$data['view_category'] = Category::get();
        return view('jobsheet.add')->with('data',$data);
	}
	public function get_transaction_amt(Request $request)
    {
        $category_id = $request->category_id;
        $user_moor_id = $request->user_moor_id;
        $data = Ratemaster::where("cat_id", "=", $category_id)->where("user_id", "=", $user_moor_id)->where("rate_id", "=", 1)->first();
		
		return response()->json([
			'rate_amt' => $data->price,
			'ratemas_id' => $data->id
		]);
        //return $data;
    }
}
