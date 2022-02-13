<?php

namespace App\Http\Controllers\Backend;
use DB;
use Auth;
use App\Models\Enroll;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ReportController extends Controller
{
    public function index()
    {
        // $users = User::where('deleted_at', NULL)->get();
        // $payments = Payments::where('deleted_at', NULL)->get();
        $enrolls = DB::table('enrolls')
        ->join('courses', 'courses.id', '=', 'enrolls.Course_ID')
        ->join('users', 'users.id', '=', 'enrolls.User_ID')
        ->join('payments', 'payments.id', '=', 'enrolls.Payment_ID')
        ->select('enrolls.id',
        'courses.title', 'courses.author', 'courses.fee', 'courses.duration', 'courses.published_date', 'courses.video', 'courses.Image', 'courses.description', 'courses.remark', 'enrolls.status',
         'courses.created_at','courses.updated_at', 'enrolls.amount', 'users.name','payments.name as bank_name')
        ->latest()->paginate(6);
        $data = Enroll::latest()->paginate(6);
        
        return view('backend.report.index')
            ->with('enrolls', $enrolls)
            ->with('data', $data);

    }
}
