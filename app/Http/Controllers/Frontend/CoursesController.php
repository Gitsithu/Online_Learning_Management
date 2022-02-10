<?php

namespace App\Http\Controllers\Frontend;
use DB;
use Auth;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Courses;
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
}