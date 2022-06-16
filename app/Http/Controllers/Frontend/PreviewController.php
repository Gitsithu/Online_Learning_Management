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

class PreviewController extends Controller
{
    public function index()
    {
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
         ->get();
        $categories = Categories::where('deleted_at', NULL)->get();

        $data = Enroll::latest()->paginate(5);
        
        
        return view('frontend.preview.index')
            ->with('categories', $categories)
            ->with('enrolls', $enrolls)
            ->with('data', $data);
    }
}
