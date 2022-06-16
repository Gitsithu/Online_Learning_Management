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

class AboutController extends Controller
{
    public function index()
    {
        //
        $categories = Categories::where('deleted_at', NULL)->get();
        $data = Categories::latest()->paginate(5);
        
        return view('about')
            ->with('categories', $categories)
            ->with('data', $data);

    }
}
