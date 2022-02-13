<?php

namespace App\Http\Controllers\Frontend;
use DB;
use App\Models\Categories;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class CategoriesController extends Controller
{
    public function index()
    {
        $courses = DB::table('courses')->join('categories', 'courses.Categories_ID', '=', 'categories.id')->select('categories.name', 'courses.id', 'courses.Categories_ID',
        'courses.title', 'courses.author', 'courses.fee', 'courses.duration', 'courses.published_date', 'courses.video', 'courses.Image', 'courses.description', 'courses.remark', 'courses.status', 'courses.created_at','courses.updated_at')
        ->where('courses.Categories_ID',$id)
        ->where('courses.deleted_at',NULL)->get();
       $data = Courses::latest()->paginate(5);
       $categories = Categories::where('deleted_at', NULL)->get();

       
       $count = array();
       foreach($courses as $i=>$course){
       $course_id = $course->id;
       
       $count[] = DB::table('favourites')->where('Course_ID',$course_id)->count();
       
       }

       $loginUser = Auth::user();
       $loginUserId = $loginUser->id;

       $favouriteOrNot = array();
       foreach($courses as $i=>$course){
       $course_id = $course->id;
       
       $favouriteOrNot[] = DB::table('favourites')->where('User_ID',$loginUserId)->where('Course_ID',$course_id)->count();
       
       }

       return view('layouts.header')
       ->with('favouriteOrNot',$favouriteOrNot)
       ->with('count',$count)
       ->with('categories',$categories)
           ->with('courses', $courses);
        //
        
      
    }

    // public function second()
    // {
    //     //
    //     $categories = Categories::where('deleted_at', NULL)->get();
    //     $data = Categories::latest()->paginate(5);
        
    //     return view('welcome')
    //         ->with('categories', $categories)
    //         ->with('data', $data);

    // }

    

    public function show($id)
    {
        //
    }   
}
