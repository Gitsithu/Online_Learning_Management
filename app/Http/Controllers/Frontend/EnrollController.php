<?php

namespace App\Http\Controllers\Frontend;
use DB;
use Auth;
use App\Models\Enroll;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class EnrollController extends Controller
{

    public function thein(Request $request)
    {
        $this->validate($request, [
   
        ]);
        
        
           
        $loginUser = Auth::user();
        $user_id = $loginUser->id;

        $payment_id = $request->input('payment_id');

        $course_id = $request->input('course_id');

        $amount = $request->input('amount');
        // image
        $image =$request->file('image');
        $new_names = rand() . '.' . $image->getClientOriginalExtension();
        $image->move(public_path('enroll'), $new_names);
        $image_file = "/enroll/" . $new_names;
        //
        
        $created_at = date("Y-m-d H:i:s");
   
           
            $new_obj = new Enroll();
        
           
            $new_obj->User_ID = $user_id;
            $new_obj->Course_ID = $course_id;
            $new_obj->Payment_ID = $payment_id;
            $new_obj->User_ID = $user_id;
            $new_obj->amount = $amount;
            $new_obj->image = $image_file;
            $new_obj->created_at = $created_at;
            $new_obj->save();
        
                $message = 'Success, Enroll created successfully ...!';
                $request->session()->flash('success', $message);
    
                // return redirect()->route('backend/car_type');
                // return redirect()->action(
                //     'UserController@profile', ['id' => 1]
                    // );
    
                return redirect()->route(
                    'enroll.index'
                );
            
            
    
                    
            $smessage = 'Fail, Error in Enroll info creating ...!';
            $request->session()->flash('fail', $smessage);
   
            return redirect()->route(
                'enroll.index'
            );
      
        
    }

    public function show()
    {
        //
    }

    public function update()
    {

    }
}