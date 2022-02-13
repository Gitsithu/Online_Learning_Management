<?php

namespace App\Http\Controllers\Backend;
use DB;
use Auth;
use App\Models\Courses;
use App\Models\Feedback;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class FeedController extends Controller
{
    //
    public function __construct()
    {
        $this->middleware('auth');
        // $this->middleware('log')->only('index');
        // $this->middleware('subscribed')->except('store');
    }
    public function index()
    {
        //
        $feedback = DB::table('feedback')
                    ->join('users', 'feedback.User_ID', '=', 'users.id')
                    ->join('courses', 'feedback.Course_ID', '=', 'courses.id')
                    ->select('users.name','courses.title','feedback.message','feedback.status','feedback.created_at')->where('feedback.deleted_at',NULL)->latest()->paginate(6);
        $data = Feedback::latest()->paginate(6);
        
        return view('backend.feed.index')
            ->with('feedback', $feedback)
            ->with('data', $data);

    }
}
