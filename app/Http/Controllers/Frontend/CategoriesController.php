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
        //
        $categories = Categories::where('deleted_at', NULL)->get();
        $data = Categories::latest()->paginate(5);
        
        return view('layouts.header')
            ->with('categories', $categories)
            ->with('data', $data);

    }

    public function second()
    {
        //
        $categories = Categories::where('deleted_at', NULL)->get();
        $data = Categories::latest()->paginate(5);
        
        return view('welcome')
            ->with('categories', $categories)
            ->with('data', $data);

    }

    public function show($id)
    {
        //
    }   
}
