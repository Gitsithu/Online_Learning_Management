<?php

namespace App\Http\Controllers\Frontend;
use DB;
use Auth;
use App\Models\Categories;
use App\Models\Feedback;
use App\Http\Controllers\Controller;
use App\Models\Courses;
use Illuminate\Http\Request;

class FeedbackController extends Controller
{
    public function index()
    {
        //
        $loginUser=Auth::user();
        $loginUserId=$loginUser->id;
        $users = DB::table('users')->select('name','id')
                    ->where('id',$loginUserId)->get();

        $feed = DB::table('courses')->select('id','title')
                    ->where('deleted_at',null)->get();
        $categories = Categories::where('deleted_at', NULL)->get();
        $data = Feedback::latest()->paginate(6);
        
        return view('frontend.feedback.index')
        ->with('users', $users)
        ->with('categories', $categories)
            ->with('feed', $feed)
            ->with('data', $data);

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('frontend.feedback.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function save(Request $request)
    {
        //

        $this->validate($request, [
            'message' => 'required'
            
        ]);
        try{
            
     
        $user_id = $request->input('user_id');
        $course_id = $request->input('course_id');
        $message = $request->input('message');
        
        $created_at = date("Y-m-d H:i:s");

           
            $new_obj = new Feedback();
        
           
            $new_obj->User_ID = $user_id;
            $new_obj->Course_ID = $course_id;
            $new_obj->message = $message;
            $new_obj->created_at = $created_at;
            $new_obj->save();
        
                $message = 'Success, Feedback created successfully ...!';
                $request->session()->flash('success', $message);
    
                // return redirect()->route('backend/car_type');
                // return redirect()->action(
                //     'UserController@profile', ['id' => 1]
                    // );
    
                return redirect()->route(
                    'feedback.index'
                );
            
            
    
        }
        catch(Exception $e){
            
            $smessage = 'Fail, Error in feedback creating ...!';
            $request->session()->flash('fail', $smessage);

            return redirect()->route(
                'feedback.index'
            );
      
        }
    }

    public function show()
    {

    }
}
