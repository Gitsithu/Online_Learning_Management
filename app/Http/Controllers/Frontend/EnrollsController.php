<?php

namespace App\Http\Controllers\Frontend;
use DB;
use Auth;
use App\Models\Enroll;
use App\Models\User;
use App\Models\Payments;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class EnrollsController extends Controller
{
    public function index()
    {
    
        // $users = User::where('deleted_at', NULL)->get();
        // $payments = Payments::where('deleted_at', NULL)->get();
        $enrolls = DB::table('enrolls')
        ->join('courses', 'courses.id', '=', 'enrolls.Course_ID')
        ->join('users', 'users.id', '=', 'enrolls.User_ID')
        ->join('payments', 'payments.id', '=', 'enrolls.Payment_ID')
        ->select('courses.id',
        'courses.title', 'courses.author', 'courses.fee', 'courses.duration', 'courses.published_date', 'courses.video', 'courses.Image', 'courses.description', 'courses.remark', 'courses.status',
         'courses.created_at','courses.updated_at', 'enrolls.amount', 'users.name')
        ->get();

        $data = Enroll::latest()->paginate(5);
        
        
        return view('frontend.enroll.index')
            ->with('enrolls', $enrolls)
            ->with('data', $data);

    }

    public function thein(Request $request)
    {
        $this->validate($request, [
   
        ]);
        
        
           
        $loginUser = Auth::user();
        $user_id = $loginUser->id;

        $payment_id = $request->input('payment_id');

        $amount = $request->input('amount');
        // image
        $image =$request->file('image');
        $new_names = rand() . '.' . $image->getClientOriginalExtension();
        $image->move(public_path('enroll'), $new_names);
        $image_file = "/enroll/" . $new_names;
        //
        
        $created_at = date("Y-m-d H:i:s");
   
        $course_id = $request->input('course_id');
        $validate= DB::select("select * from enrolls where Course_ID='$course_id' and User_ID=".$user_id);
        if(!$validate)
        {

        
        
           
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
        }

        else{
            $smessage = 'Fail, You have already enrolled ...!';
            $request->session()->flash('fail', $smessage);
   
            return redirect()->route(
                'enroll.index'
            );
        }
            
    
                    
            
      
        
    }

    public function show()
    {
        //
    }

    public function update()
    {

    }
}
