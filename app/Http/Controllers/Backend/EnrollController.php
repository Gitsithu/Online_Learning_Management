<?php

namespace App\Http\Controllers\Backend;
use DB;
use Auth;
use App\Models\Enroll;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class EnrollController extends Controller
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
         'courses.created_at','courses.updated_at', 'enrolls.amount', 'users.name')
        ->get();
        $data = Enroll::latest()->paginate(5);
        
        return view('backend.enrollment.index')
            ->with('enrolls', $enrolls)
            ->with('data', $data);

    }

    public function approve(Request $request,$id){
        $enrolls = DB::table('enrolls')->where('id', $id)->get();
        try{
        

            $status = 2;
                
            DB::update("update enrolls set status = '$status' where id = '$id'");
            
 
                        // to alert message when it sucessfully created
            $smessage = 'Success, Enrollment Approve successfully ...!';
            $request->session()->flash('success', $smessage);


            return redirect()->route(
                'enrollment.index'
            );
                    }
        catch(Exception $e){
            
            // to alert message when it fail creating
            $smessage = 'Fail, Error in Approving Enrollment ...!';
            $request->session()->flash('fail', $smessage);

            return redirect()->route(
                'enrollment.index'
            );
        }
    }

    public function reject(Request $request,$id){
        
        try{
        

            $status = 3;

                
            DB::update("update enrolls set status = '$status' where id = '$id'");
            
            
 
                        // to alert message when it sucessfully created
            $smessage = 'Success, Enrollment Reject successfully ...!';
            $request->session()->flash('fail', $smessage);


            return redirect()->route(
                'enrollment.index'
            );
                    }
        catch(Exception $e){
            
            // to alert message when it fail creating
            $smessage = 'Fail, Error in Rejecting Enrollment ...!';
            $request->session()->flash('fail', $smessage);

            return redirect()->route(
                'enrollment.index'
            );
        }
    }
}
