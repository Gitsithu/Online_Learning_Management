<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;
use App\Models\Blog;
class BlogsController extends Controller
{
    public function index()
    {
        //
        $blogs = DB::table('blogs')->join('users', 'blogs.User_ID', '=', 'users.id')->select('users.name', 'blogs.id', 'blogs.User_ID', 'blogs.title', 'blogs.description', 'blogs.status', 'blogs.created_at','blogs.updated_at')->where('blogs.deleted_at',NULL)->get();
        $data = Blog::latest()->paginate(5);
        $categories = DB::table('categories')->get();
        return view('frontend.blog.index')
        ->with('categories',$categories)
            ->with('blogs', $blogs)
            ->with('data', $data);

    }

}