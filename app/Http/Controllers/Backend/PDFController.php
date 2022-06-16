<?php

namespace App\Http\Controllers\Backend;
use PDF;
use Maatwebsite\Excel\Facades\Excel;
use DB;
use Auth;
use App\Models\User;
use App\Models\Enroll;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class PDFController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function generatePDF()
    {
        
        $enrolls = DB::table('enrolls')
        ->join('courses', 'courses.id', '=', 'enrolls.Course_ID')
        ->join('users', 'users.id', '=', 'enrolls.User_ID')
        ->join('payments', 'payments.id', '=', 'enrolls.Payment_ID')
        ->select('enrolls.id',
        'courses.title', 'courses.author', 'courses.fee', 'courses.duration', 'courses.published_date', 'courses.video', 'enrolls.image', 'courses.description', 'courses.remark', 'enrolls.status',
         'courses.created_at','courses.updated_at', 'enrolls.amount', 'users.name','payments.name as bank_name')
        ->get();
        $pdf = PDF::loadView('backend.report.myPDF', compact('enrolls',$enrolls));
    
        return $pdf->download('enrollment.pdf');
    }

    public function generateAPPPDF()
    {
        
        $enrolls = DB::table('enrolls')
        ->join('courses', 'courses.id', '=', 'enrolls.Course_ID')
        ->join('users', 'users.id', '=', 'enrolls.User_ID')
        ->join('payments', 'payments.id', '=', 'enrolls.Payment_ID')
        ->select('enrolls.id',
        'courses.title', 'courses.author', 'courses.fee', 'courses.duration', 'courses.published_date', 'courses.video', 'enrolls.image', 'courses.description', 'courses.remark', 'enrolls.status',
         'courses.created_at','courses.updated_at', 'enrolls.amount', 'users.name','payments.name as bank_name')
        ->where('enrolls.status',2)
         ->get();
        $pdf = PDF::loadView('backend.user_report.appPDF', compact('enrolls',$enrolls));
    
        return $pdf->download('enrollmentapprove.pdf');
    }

    public function generateREPDF()
    {
        
        $enrolls = DB::table('enrolls')
        ->join('courses', 'courses.id', '=', 'enrolls.Course_ID')
        ->join('users', 'users.id', '=', 'enrolls.User_ID')
        ->join('payments', 'payments.id', '=', 'enrolls.Payment_ID')
        ->select('enrolls.id',
        'courses.title', 'courses.author', 'courses.fee', 'courses.duration', 'courses.published_date', 'courses.video', 'enrolls.image', 'courses.description', 'courses.remark', 'enrolls.status',
         'courses.created_at','courses.updated_at', 'enrolls.amount', 'users.name','payments.name as bank_name')
        ->where('enrolls.status',3)
         ->get();
        $pdf = PDF::loadView('backend.user_report.rePDF', compact('enrolls',$enrolls));
    
        return $pdf->download('enrollmentreject.pdf');
    }

    public function generatePENDPDF()
    {
        
        $enrolls = DB::table('enrolls')
        ->join('courses', 'courses.id', '=', 'enrolls.Course_ID')
        ->join('users', 'users.id', '=', 'enrolls.User_ID')
        ->join('payments', 'payments.id', '=', 'enrolls.Payment_ID')
        ->select('enrolls.id',
        'courses.title', 'courses.author', 'courses.fee', 'courses.duration', 'courses.published_date', 'courses.video', 'enrolls.image', 'courses.description', 'courses.remark', 'enrolls.status',
         'courses.created_at','courses.updated_at', 'enrolls.amount', 'users.name','payments.name as bank_name')
        ->where('enrolls.status',1)
         ->get();
        $pdf = PDF::loadView('backend.user_report.pendPDF', compact('enrolls',$enrolls));
    
        return $pdf->download('enrollmentpending.pdf');
    }

    public function generateUSERPDF()
    {
        
        $users = User::where('Role_ID', 2)->get();
        $pdf = PDF::loadView('backend.user_report.myPDF', compact('users',$users));
    
        return $pdf->download('users.pdf');
    }

    public function generateEXCEL()
    {
        
        $enrolls = DB::table('enrolls')
        ->join('courses', 'courses.id', '=', 'enrolls.Course_ID')
        ->join('users', 'users.id', '=', 'enrolls.User_ID')
        ->join('payments', 'payments.id', '=', 'enrolls.Payment_ID')
        ->select('enrolls.id',
        'courses.title', 'courses.author', 'courses.fee', 'courses.duration', 'courses.published_date', 'courses.video', 'enrolls.image', 'courses.description', 'courses.remark', 'enrolls.status',
         'courses.created_at','courses.updated_at', 'enrolls.amount', 'users.name','payments.name as bank_name')
        ->get();
        $excel = Excel::loadView('backend.report.myEXCEL', compact('enrolls',$enrolls));
    
        return $excel->download('enrollment.xlsx');
    }
}
