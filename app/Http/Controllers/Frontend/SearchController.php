<?php

namespace App\Http\Controllers\Frontend;
use App\Models\Courses;
use App\Models\Categories;
use DB;
use Auth;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class SearchController extends Controller
{
    public function index(request $request)
    {
        $categories = DB::table('categories')->get();
        $search = $request->input('search');
        $courses = DB::table('courses')->join('categories', 'courses.Categories_ID', '=', 'categories.id')->select('categories.name', 'courses.id', 'courses.Categories_ID',
         'courses.title', 'courses.author', 'courses.fee', 'courses.duration', 'courses.published_date', 'courses.video', 'courses.Image', 'courses.description', 'courses.remark', 'courses.status', 'courses.created_at','courses.updated_at')
         ->where('name','LIKE','%'.$search.'%')
         ->where('courses.deleted_at',NULL)->get();
            
                return view('frontend.course.index')
                ->with('categories',$categories)
                ->with('courses',$courses);
    }
}
