<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Core\ReturnMessage as ReturnMessage;
use App\Models\Favourite;
use App\Models\Categories;
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

            $existOrNot = DB::table('favourites')->select('id')->where('Course_ID',$course_id)->where('User_ID',$loginUserId)->count();

            if($existOrNot)
            {
                $favourite = DB::table('favourites')->select('id')->where('Course_ID',$course_id)->where('User_ID',$loginUserId)->get();

                foreach($favourite as $f)
                {
                    $userFavourite = Favourite::find($f->id);
                    $userFavourite->forceDelete();
                }
            }
            else
            {
            $new_obj            = new Favourite();
            $new_obj->User_ID   = $loginUserId;
            $new_obj->Course_ID = $course_id;
            $new_obj->status    = 1;
            $new_obj->created_at= $created_at;
            $new_obj->save();
            }
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

    // public function remove(Request $request)
    // {
    // try {
    //         $course_id      = $request->get('course_id');
    //         $loginUser      = Auth::user();
    //         $loginUserId    = $loginUser->id;
    //         // $created_at     = date("Y-m-d H:i:s");

           
    //         $favourite = DB::table('favourites')->select('id')->where('Course_ID',$course_id)->where('User_ID',$loginUserId)->get();

    //         foreach($favourite as $f){
    //             $userFavourite = Favourite::find($f->id);
    //             $userFavourite->forceDelete();
    //         }
    //         $count = DB::table('favourites')->where('Course_ID',$course_id)->count();

    //         $returned_obj['objs']           = $count;
    //         $returned_obj['status_code']    = ReturnMessage::OK;
    //         $returned_obj['status_message'] = "Syncs down process completed successfully !";
    //         $returned_obj['data']           = $count;
            

    //         return response()->json(array('returned_obj'=> $returned_obj), ReturnMessage::OK);
    //     } catch (\Exception $e) {
    //         $returned_obj['status_code'] = ReturnMessage::INTERNAL_SERVER_ERROR;
    //         $returned_obj['status_message'] = $e->getMessage();
    //         $returned_obj['data'] = array();
    //         $returned_obj['objs'] = "";
            
    //         return response()->json(array('returned_obj'=> $returned_obj), ReturnMessage::INTERNAL_SERVER_ERROR);
    //     }
    // }

    public function view()
    {
        $loginUser      = Auth::user();
            $loginUserId    = $loginUser->id;
        $categories = Categories::where('deleted_at', NULL)->get();
        $favourites = DB::table('favourites')
        ->join('courses', 'courses.id', '=', 'favourites.Course_ID')
        ->join('users', 'users.id', '=', 'favourites.User_ID')
        ->select(
        'courses.id','courses.title','courses.Categories_ID', 'courses.author', 'courses.fee', 'courses.duration', 'courses.published_date', 'courses.video', 'courses.Image', 'courses.description', 'courses.remark', 
         'courses.created_at','courses.updated_at', 'users.name')
         ->where('favourites.User_ID',$loginUserId)
        ->latest()->paginate(6);
        $data = Favourite::latest()->paginate(6);
        
        return view('frontend.favourite.index')
            ->with('favourites', $favourites)
            ->with('categories', $categories)
            ->with('data', $data);
    }
}
