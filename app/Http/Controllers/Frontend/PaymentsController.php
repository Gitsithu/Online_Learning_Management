<?php

namespace App\Http\Controllers\Frontend;
use DB;
use App\Models\Payments;
use App\Models\Courses;
use App\Models\Categories;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class PaymentsController extends Controller
{
    Public function payment($id)
    {

    $payments = Payments::where('deleted_at', NULL)->get();
    $courses = DB::table('courses')
    ->join('categories', 'courses.Categories_ID', '=', 'categories.id')
    ->select('categories.name', 'courses.id', 'courses.Categories_ID',
    'courses.title', 'courses.author', 'courses.fee', 'courses.duration', 'courses.published_date', 'courses.video', 'courses.Image', 'courses.description', 'courses.remark', 'courses.status', 'courses.created_at','courses.updated_at')
    ->where('courses.id',$id)->get();


    $data = Payments::latest()->paginate(5);
    
    return view('frontend.payment.index')
        ->with('payments', $payments)
        ->with('courses', $courses)
        ->with('data', $data);
    }
}
