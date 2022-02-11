<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Core\ReturnMessage as ReturnMessage;
use App\Models\Favourite;
use Auth;
use DB;

class FavouriteController extends Controller
{
    public function add(Request $request)
    {
    try {
            $course_id      = $request->get('course_id');
            $loginUser      = Auth::user();
            $loginUserId    = $loginUser->id;
            $created_at     = date("Y-m-d H:i:s");

           
            $new_obj            = new Favourite();
            $new_obj->User_ID   = $loginUserId;
            $new_obj->Course_ID = $course_id;
            $new_obj->status    = 1;
            $new_obj->created_at= $created_at;
            $new_obj->save();
        
            $count = DB::table('favourites')->where('Course_ID',$course_id)->count();

            $returned_obj['objs']           = $count;
            $returned_obj['status_code']    = ReturnMessage::OK;
            $returned_obj['status_message'] = "Syncs down process completed successfully !";
            $returned_obj['data']           = $count;
            

            return response()->json(array('returned_obj'=> $returned_obj), ReturnMessage::OK);
        } catch (\Exception $e) {
            $returned_obj['status_code'] = ReturnMessage::INTERNAL_SERVER_ERROR;
            $returned_obj['status_message'] = $e->getMessage();
            $returned_obj['data'] = array();
            $returned_obj['objs'] = "";
            
            return response()->json(array('returned_obj'=> $returned_obj), ReturnMessage::INTERNAL_SERVER_ERROR);
        }
    }
}
