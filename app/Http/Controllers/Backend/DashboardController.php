<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Auth;
use DB;
class DashboardController extends Controller
{
    //
    public function index(){
    
    if (Auth::check()) {

            
        // Start - Searching clinic Count Process
            $category_count_raw = DB::select('SELECT count(id) AS category_count from categories where status = 1');

            if (isset($category_count_raw) && count($category_count_raw)>0) {
                $category_count = $category_count_raw[0]->category_count;
            } else {
                $category_count = 0;
            }

            // to count the total number of users
            $course_count_raw = DB::select('SELECT count(id) AS course_count from courses where status = 1 and deleted_at is null');

            if (isset($course_count_raw) && count($course_count_raw)>0) {
                $course_count = $course_count_raw[0]->course_count;
            } else {
                $course_count = 0;
            }

            // to count the number of doctor
            $user_count_raw = DB::select('SELECT count(id) AS user_count from users where role_id = 1');

            if (isset($user_count_raw) && count($user_count_raw)>0) {
                $user_count = $user_count_raw[0]->user_count;
            } else {
                $user_count = 0;
            }

            // to count the number of customer
            $user_count_raws = DB::select('SELECT count(id) AS user_counts from users where role_id = 2');

            if (isset($user_count_raws) && count($user_count_raws)>0) {
                $user_counts = $user_count_raws[0]->user_counts;
            } else {
                $user_counts = 0;
            }

            // to count the number of Customer' appointment
            $enroll_count_raw = DB::select('SELECT count(id) AS enroll_count from enrolls where deleted_at is null');

            if (isset($enroll_count_raw) && count($enroll_count_raw)>0) {
                $enroll_count = $enroll_count_raw[0]->enroll_count;
            } else {
                $enroll_count = 0;
            }
            
            // to count the number of Customer' appointment
            $blog_count_raw= DB::select('SELECT count(id) AS blog_count from blogs where status = 1 and deleted_at is null');

            if (isset($blog_count_raw) && count($blog_count_raw)>0) {
                $blog_count = $blog_count_raw[0]->blog_count;
            } else {
                $blog_count = 0;
            }

            // $most_count_raw= DB::select('SELECT MAX (most_count) 
            // FROM (SELECT Course_ID,COUNT(Course_ID) most_count 
            // FROM enrolls 
            // GROUP BY Course_ID)');

            // if (isset($most_count_raw) && count($most_count_raw)>0) {
            //     $most_count = $most_count_raw[0]->most_count;
            // } else {
            //     $most_count = 0;
            // }


            $loginUser = Auth::user();
            $loginUserId = $loginUser->id ;



           $users = DB::select('select * from users');



           return view ('backend.dashboard')
           ->with('users', $users)
        //    ->with('most_count', $most_count)
            ->with('blog_count', $blog_count)
            ->with('enroll_count', $enroll_count)
            ->with('user_count', $user_count)
            ->with('user_counts', $user_counts)
            ->with('category_count', $category_count)
            ->with('course_count', $course_count);
          //   ->with('submission_countss', $submission_countss)


        }
        else{
            return redirect()->route('login');
        }

     }
}
