<?php

namespace App\Http\Controllers\Backend;
use DB;
use Auth;
use App\Models\Categories;
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
        $courses = DB::table('courses')->join('categories', 'courses.Categories_ID', '=', 'categories.id')->select('categories.name', 'courses.id', 'courses.Categories_ID',
         'courses.title', 'courses.author', 'courses.fee', 'courses.duration', 'courses.published_date', 'courses.video', 'courses.description', 'courses.remark', 'courses.status', 'courses.created_at','courses.updated_at')->where('courses.deleted_at',NULL)->latest()->paginate(6);
        $data = Courses::latest()->paginate(6);
        
        return view('backend.course.index')
            ->with('courses', $courses)
            ->with('data', $data);

    }
}
