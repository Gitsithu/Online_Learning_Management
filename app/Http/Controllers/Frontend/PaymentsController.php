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
    $categories = DB::table('categories')->get();
    return view('frontend.payment.index')
    ->with('categories',$categories)
        ->with('payments', $payments)
        ->with('courses', $courses)
        ->with('data', $data);
    }

    public function bankname(request $request)
    {
        $payment_id = $request->payment_id;
        $bank = Payments::where('id',$payment_id)->where('deleted_at',null)->get();
        $pay=" ";
        foreach($bank as $ban){
            $money=$ban->id;
            $sol = '<option value='."$money".'>' .$ban->payment_number.'</option>';
            $pay = $pay.$sol;
        }

        $msg= $pay;

        return response()->json(array('msg' => $msg), 200);
    }

    public function bankname_2(request $request)
    {
        $payment_id = $request->payment_id;
        $bank = Payments::where('id',$payment_id)->where('deleted_at',null)->get();
        $pay_1=" ";
        foreach($bank as $ban){
            $money=$ban->id;
            $sol_1 = '<option value='."$money".'>' .$ban->user_name.'</option>';
            $pay_1 = $pay_1.$sol_1;
        }

        $msg= $pay_1;

        return response()->json(array('msg' => $msg), 200);
    }
}
