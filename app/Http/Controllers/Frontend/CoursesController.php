<?php

namespace App\Http\Controllers\Frontend;
use DB;
use Auth;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Courses;
use App\Models\Enroll;
class CoursesController extends Controller
{
    public function index()
    {



        $courses = DB::table('courses')->join('categories', 'courses.Categories_ID', '=', 'categories.id')->select('categories.name', 'courses.id', 'courses.Categories_ID',
         'courses.title', 'courses.author', 'courses.fee', 'courses.duration', 'courses.published_date', 'courses.video', 'courses.Image', 'courses.description', 'courses.remark', 'courses.status', 'courses.created_at','courses.updated_at')->where('courses.deleted_at',NULL)->get();
        $data = Courses::latest()->paginate(5);
        $categories = DB::table('categories')->get();
        return view('frontend.course.index')
        ->with('categories',$categories)
            ->with('courses', $courses)
            ->with('data', $data);

        
    }

    public function second()
    {
        $courses = DB::table('courses')->join('categories', 'courses.Categories_ID', '=', 'categories.id')->select('categories.name', 'courses.id', 'courses.Categories_ID',
         'courses.title', 'courses.author', 'courses.fee', 'courses.duration', 'courses.published_date', 'courses.video', 'courses.Image', 'courses.description', 'courses.remark', 'courses.status', 'courses.created_at','courses.updated_at')->where('courses.deleted_at',NULL)->get();
        $data = Courses::latest()->paginate(5);
        
        $categories = DB::table('categories')->get();
        return view('welcome')
            ->with('categories',$categories)
            ->with('courses', $courses)
            ->with('data', $data);
    }

    public function payornot(Request $request,$id)
    {
        $loginUser = Auth::user();
        $loginUserId = $loginUser->id;
        $pay = DB::table('enrolls')->select('enrolls.*')->where('Course_ID',$id)->where('User_ID',$loginUserId)->where('status',2)->get();
        // $pay= Enroll::where(['Course_ID',$id],['User_ID',$loginUserId],['status',2])->get();

        $count = count($pay);
        if($count==1)
        {
            return redirect()->route('frontend.enroll.index', [$id])
            ->with('id',$id);
        }
        else{
            $smessage = 'Fail, You have not yet enroll the course ...!';
            $request->session()->flash('fail', $smessage);
   
            return redirect()->route(
                'welcome'
            );
        }
    }

    public function show($id)
    {
        $courses = DB::table('courses')->join('categories', 'courses.Categories_ID', '=', 'categories.id')->select('categories.name', 'courses.id', 'courses.Categories_ID',
         'courses.title', 'courses.author', 'courses.fee', 'courses.duration', 'courses.published_date', 'courses.video', 'courses.Image', 'courses.description', 'courses.remark', 'courses.status', 'courses.created_at','courses.updated_at')
         ->where('courses.Categories_ID',$id)
         ->where('courses.deleted_at',NULL)->get();
        $data = Courses::latest()->paginate(5);
        $categories = DB::table('categories')->get();
        return view('frontend.course.index')
        ->with('categories',$categories)
            ->with('courses', $courses)
            ->with('data', $data);
    }
}