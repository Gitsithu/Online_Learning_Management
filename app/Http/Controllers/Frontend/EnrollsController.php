<?php

namespace App\Http\Controllers\Frontend;
use DB;
use Auth;
use App\Models\Enroll;
use App\Models\User;
use App\Models\Payments;
use App\Models\Categories;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class EnrollsController extends Controller
{
    public function pre($id)
    {
        // $users = User::where('deleted_at', NULL)->get();
        // $payments = Payments::where('deleted_at', NULL)->get();
        $loginUser = Auth::user();
        $loginUserId = $loginUser->id;
        $enrolls = DB::table('enrolls')
        ->join('courses', 'courses.id', '=', 'enrolls.Course_ID')
        ->join('users', 'users.id', '=', 'enrolls.User_ID')
        ->join('payments', 'payments.id', '=', 'enrolls.Payment_ID')
        ->select('courses.id',
        'courses.title', 'courses.author', 'courses.fee', 'courses.duration', 'courses.published_date', 'courses.video', 'courses.Image', 'courses.description', 'courses.remark', 'enrolls.status',
         'courses.created_at','courses.updated_at', 'enrolls.amount', 'users.name')
        ->where('enrolls.User_ID',$loginUserId)
        ->where('enrolls.Course_ID',$id)
        ->where('enrolls.status',2)
         ->get();
        $categories = Categories::where('deleted_at', NULL)->get();

        $data = Enroll::latest()->paginate(5);
        
        
        return view('frontend.enroll.index')
            ->with('categories', $categories)
            ->with('enrolls', $enrolls)
            ->with('data', $data);

    }

    public function thein(Request $request)
    {
        $this->validate($request, [
            'image' => 'required',
            'payment_id' => 'required',

   
        ]);

        $loginUser = Auth::user();
        $user_id = $loginUser->id;
       
        $enrolls = DB::table('enrolls')
        ->join('courses', 'courses.id', '=', 'enrolls.Course_ID')
        ->join('users', 'users.id', '=', 'enrolls.User_ID')
        ->join('payments', 'payments.id', '=', 'enrolls.Payment_ID')
        ->select('courses.id',
        'courses.title', 'courses.author', 'courses.fee', 'courses.duration', 'courses.published_date', 'courses.video', 'courses.Image', 'courses.description', 'courses.remark', 'enrolls.status',
         'courses.created_at','courses.updated_at', 'enrolls.amount', 'users.name')
        ->where('enrolls.User_ID',$user_id)
         ->get();
        $categories = Categories::where('deleted_at', NULL)->get();
        
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
        $swal = DB::table('courses')->select('fee')->where('id',$course_id)->get();
        $fee = $swal[0]->fee;
        if($fee==$amount){


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
    
                    return redirect()->route('preview.index')
                    ->with('categories', $categories)
            ->with('enrolls', $enrolls);
        }
    }

    if($amount>$fee||$amount<$fee){

        $rules = [
            'amount' => "required",
            'amount' => "min:'$fee'",
            'amount' =>  "max:'$fee'",
        ];
    
        $customMessages = [
            'required' => 'The payable ammount is required.',
            'min' => "The payable amount must at least '$fee' mmk.",
            'max' => "The payable amount must at max '$fee' mmk.",

        ];
        $this->validate($request, $rules, $customMessages);

    //     $this->validate($request, [
    //         'amount' => "min:'$fee'|max:'$fee'",
            
   
    //     ]);
     }
    

        else{
            $courses = DB::table('courses')->join('categories', 'courses.Categories_ID', '=', 'categories.id')->select('categories.name', 'courses.id', 'courses.Categories_ID',
            'courses.title', 'courses.author', 'courses.fee', 'courses.duration', 'courses.published_date', 'courses.video', 'courses.Image', 'courses.description', 'courses.remark', 'courses.status', 'courses.created_at','courses.updated_at')
            ->where('courses.deleted_at',NULL)->get();
            $count = array();
            foreach($courses as $i=>$course){
            $course_id = $course->id;
            
            $count[] = DB::table('favourites')->where('Course_ID',$course_id)->count();
            
            }
            $favouriteOrNot = array();
            if(Auth::check())
            {
                $loginUserId = Auth::user()->id;    
                foreach($courses as $i=>$course)
                {
                    $course_id = $course->id;
            
                    $favouriteOrNot[] = DB::table('favourites')->where('User_ID',$loginUserId)->where('Course_ID',$course_id)->count();
            
                }
            }
            $smessage = 'Fail, You have already enrolled ...!';
            $request->session()->flash('fail', $smessage);
   
            return redirect()->route('welcome')
            ->with('count',$count) 
            ->with('favouriteOrNot', $favouriteOrNot)  
            ;
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
