<?php

namespace App\Http\Controllers\Backend;
use DB;
use Auth;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Blog;
use App\Models\User;
class BlogController extends Controller
{
    //
    public function __construct()
    {
        $this->middleware('auth');
        // $this->middleware('log')->only('index');
        // $this->middleware('subscribed')->except('store');
    }
    public function index()
    {
        //
        $blogs = DB::table('blogs')->join('users', 'blogs.User_ID', '=', 'users.id')->select('users.name', 'blogs.id', 'blogs.User_ID', 'blogs.title', 'blogs.description', 'blogs.status', 'blogs.created_at','blogs.updated_at')->where('blogs.deleted_at',NULL)->get();
        $data = Blog::latest()->paginate(5);
        
        return view('backend.blog.index')
            ->with('blogs', $blogs)
            ->with('data', $data);

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        $users=DB::select('SELECT * from users where deleted_at is null');
        return view('backend.blog.create')
        ->with('users', $users);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //

        $this->validate($request, [
            'title' => 'required',
            'description' => 'required',
            'status' => 'required'
            
        ]);
    
        try{
        $loginUser = Auth::user();
        $loginUserId = Auth::user()->id;        
        $name = $request->input('title');
        $description = $request->input('description');
        $status = $request->input('status');
        
        $created_at = date("Y-m-d H:i:s");

           
            $new_obj = new Blog();
        
            $new_obj->User_ID = $loginUserId;
            $new_obj->title = $name;
            $new_obj->description = $description;
            $new_obj->status = $status;
            $new_obj->created_at = $created_at;
            $new_obj->save();
        
                $message = 'Success, blog created successfully ...!';
                $request->session()->flash('success', $message);
    
                // return redirect()->route('backend/car_type');
                // return redirect()->action(
                //     'UserController@profile', ['id' => 1]
                    // );
    
                return redirect()->route(
                    'blog.index'
                );
            
            
    
        }
        catch(Exception $e){
            
            $smessage = 'Fail, Error in blog creating ...!';
            $request->session()->flash('fail', $smessage);

            return redirect()->route(
                'blog.index'
            );
      
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
        $blog = DB::table('blogs')->where('id', $id)->first();
        return view('backend.blog.edit', ['blog' => $blog]);
    
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
        $this->validate($request, [
            
            'title' => 'required',
            'description' => 'required',
            'status' => 'required',
            
        ]);

        $title = $request->input('title');
        $description = $request->input('description');
        $status = $request->input('status');
        
        $updated_at = date("Y-m-d H:i:s");

        try{
            
            $new_obj = Blog::find($id);
            $new_obj->title = $title;
            $new_obj->description = $description;
            $new_obj->status = $status;
            $new_obj->updated_at = $updated_at;
            $new_obj->save();
        
                $message = 'Success, blog updated successfully ...!';
                $request->session()->flash('success', $message);
    
                // return redirect()->route('backend/car_type');
                // return redirect()->action(
                //     'UserController@profile', ['id' => 1]
                    // );
    
                    return redirect()->route(
                        'blog.index'
                    );
            
    
        }
        catch(Exception $e){
            
            $smessage = 'Fail, Error in blog updating ...!';
            $request->session()->flash('fail', $smessage);

            return redirect()->route(
                'blog.index'
            );
      
    }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request,$id)
    {
        // to delect the data from database
        $obj = Blog::find($id);
        $obj->delete();
        if ($obj->trashed()) {            
            $message = 'Success, ' . $obj->title .' deleted successfully ...!';
            $request->session()->flash('fail', $message);

            return redirect()->action(
                'admin\BlogController@index'
            );
        }
        else{
            
            $message = 'Fail, ' . $obj->title .' cannot delete ..... !';
            $request->session()->flash('fail', $message);

            return redirect()->action(
                'admin\BlogController@index'
            );
        }
    }
  
    public function delete(Request $request,$id)
    {
        $deleted_at = date("Y-m-d H:i:s");
        try{

        $new_obj = Blog::find($id);
        $new_obj->deleted_at = $deleted_at;
        $new_obj->save();
        
        $message = 'Success, ' . $new_obj->title .' deleted successfully ...!';
        $request->session()->flash('fail', $message);

        return redirect()->route(
            'blog.index'
        );
    }
    catch(Exception $e){
            
        $message = 'Fail, ' . $new_obj->title .' cannot delete ..... !';
        $request->session()->flash('fail', $smessage);

        return redirect()->route(
            'blog.index'
        );
  
}

    }
    }
