<?php

namespace App\Http\Controllers\Backend;
use DB;
use Auth;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Courses;
class CourseController extends Controller
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
        $courses = DB::table('courses')->join('categories', 'courses.Categories_ID', '=', 'categories.id')->select('categories.name', 'courses.id', 'courses.Categories_ID',
         'courses.title', 'courses.author', 'courses.fee', 'courses.duration', 'courses.published_date', 'courses.video', 'courses.description', 'courses.remark', 'courses.status', 'courses.created_at','courses.updated_at')->where('courses.deleted_at',NULL)->get();
        $data = Courses::latest()->paginate(5);
        
        return view('backend.course.index')
            ->with('courses', $courses)
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
        $categories=DB::select('SELECT * from categories where deleted_at is null');
        return view('backend.course.create')
        ->with('users', $users)
        ->with('categories',$categories);
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
            'Categories_ID' => 'required',
            'title' => 'required',
            'author' => 'required',
            'fee' => 'required',
            'duration' => 'required',
            'published_date' => 'required',
            'description' => 'required',
            'status' => 'required'
            
        ]);
            
        $categories = $request->input('Categories_ID');
        $title = $request->input('title');
        $author = $request->input('author');
        $fee = $request->input('fee');
        $duration = $request->input('duration');
        $published_date = $request->input('published_date');

        // video
        $video =$request->file('video');
        $new_name = rand() . '.' . $video->getClientOriginalExtension();
        $video->move(public_path('video'), $new_name);
        $video_file = "/video/" . $new_name;
        // 

        // image
        $image =$request->file('image');
        $new_name = rand() . '.' . $image->getClientOriginalExtension();
        $image->move(public_path('course'), $new_name);
        $image_file = "/course/" . $new_name;
        //

        $description = $request->input('description');
        $remark = $request->input('remark');
        $status = $request->input('status');
        
        $created_at = date("Y-m-d H:i:s");

        try{

            // to create the folder path when it save images
            // if($image = $request->file('image')){

            //     $new_name = rand() . '.' . $image->getClientOriginalExtension();
            //     $image->move(public_path('profile'), $new_name);
            //     $image_file = "/profile/" . $new_name;
            //     DB::update('update users set  name = ?, email = ?,  password = ?, phone = ?, address = ?, nrc = ?, specialization_id = ?, description = ?, degree = ?, image = ?, updated_at = ? where id = ?', [$name,$email,$password,$phone,$address,$nrc,$special,$description,$degree,$image_file,$updated_at,$id]);
            // }
            // else{
            //     DB::update('update users set  name = ?, email = ?,  password = ?, phone = ?, address = ?, nrc = ?, specialization_id = ?, description = ?, degree = ?, updated_at = ? where id = ?', [$name,$email,$password,$phone,$address,$nrc,$special,$description,$degree,$updated_at,$id]);
            // }

            

            $new_obj = new Courses();
        
            $new_obj->Categories_ID = $categories;
            $new_obj->title = $title;
            $new_obj->author = $author;
            $new_obj->fee = $fee;
            $new_obj->duration = $duration;
            $new_obj->published_date = $published_date;
            $new_obj->video = $video_file;
            $new_obj->Image = $image_file;
            $new_obj->description = $description;
            $new_obj->remark = $remark;
            $new_obj->status = $status;
            $new_obj->created_at = $created_at;
            $new_obj->save();
        
                $message = 'Success, Course created successfully ...!';
                $request->session()->flash('success', $message);
    
                // return redirect()->route('backend/car_type');
                // return redirect()->action(
                //     'UserController@profile', ['id' => 1]
                    // );
    
                return redirect()->route(
                    'course.index'
                );
        }
            
    
        catch(Exception $e){
            
            $smessage = 'Fail, Error in course creating ...!';
            $request->session()->flash('fail', $smessage);

            return redirect()->route(
                'course.index'
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
        $course = DB::table('courses')->where('id', $id)->first();
        $categories = DB::table('categories')->get();
        return view('backend.course.edit', ['course' => $course],['categories'=>$categories]);
    
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
            'Categories_ID' => 'required',
            'title' => 'required',
            'description' => 'required',
            'status' => 'required',
            
        ]);
        $categories = $request->input('Categories_ID');
        $title = $request->input('title');
        $author = $request->input('author');
        $fee = $request->input('fee');
        $duration = $request->input('duration');
        $published_date = $request->input('published_date');
        // video
       
        // 
        $description = $request->input('description');
        $remark = $request->input('remark');
        $status = $request->input('status');
        
        $updated_at = date("Y-m-d H:i:s");

        try{

            $video =$request->file('video');  
            $image =$request->file('image'); 
            if ($video != null & $image !=null){ 
            $new_name = rand() . '.' . $video->getClientOriginalExtension();
            $video->move(public_path('video'), $new_name);
            $video_file = "/video/" . $new_name;

            
            $new_name = rand() . '.' . $video->getClientOriginalExtension();
            $image->move(public_path('course'), $new_name);
            $image_file = "/course/" . $new_name;
            
            $new_obj = Courses::find($id);
            $new_obj->Categories_ID = $categories;
            $new_obj->title = $title;
            $new_obj->author = $author;
            $new_obj->fee = $fee;
            $new_obj->duration = $duration;
            $new_obj->published_date = $published_date;
            $new_obj->description = $description;
            $new_obj->video = $video_file;
            $new_obj->Image = $image_file;
            $new_obj->remark = $remark;
            $new_obj->status = $status;
            $new_obj->updated_at = $updated_at;
            $new_obj->save();
            }
            else {

                $new_obj = Courses::find($id);
                $new_obj->Categories_ID = $categories;
                $new_obj->title = $title;
                $new_obj->author = $author;
                $new_obj->fee = $fee;
                $new_obj->duration = $duration;
                $new_obj->published_date = $published_date;
                $new_obj->description = $description;
                $new_obj->remark = $remark;
                $new_obj->status = $status;
                $new_obj->updated_at = $updated_at;
                $new_obj->save();
            }
        
                $message = 'Success, course updated successfully ...!';
                $request->session()->flash('success', $message);
    
                // return redirect()->route('backend/car_type');
                // return redirect()->action(
                //     'UserController@profile', ['id' => 1]
                    // );
    
                    return redirect()->route(
                        'course.index'
                    );
            
    
        }
        catch(Exception $e){
            
            $smessage = 'Fail, Error in course updating ...!';
            $request->session()->flash('fail', $smessage);

            return redirect()->route(
                'course.index'
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
        $obj = Courses::find($id);
        $obj->delete();
        if ($obj->trashed()) {            
            $message = 'Success, ' . $obj->title .' deleted successfully ...!';
            $request->session()->flash('fail', $message);

            return redirect()->action(
                'admin\CourseController@index'
            );
        }
        else{
            
            $message = 'Fail, ' . $obj->title .' cannot delete ..... !';
            $request->session()->flash('fail', $message);

            return redirect()->action(
                'admin\CourseController@index'
            );
        }
    }
    public function delete(Request $request,$id)
    {
        $deleted_at = date("Y-m-d H:i:s");
        try{

        $new_obj = Courses::find($id);
        $new_obj->deleted_at = $deleted_at;
        $new_obj->save();
        
        $message = 'Success, ' . $new_obj->title .' deleted successfully ...!';
        $request->session()->flash('fail', $message);

        return redirect()->route(
            'course.index'
        );
    }
    catch(Exception $e){
            
        $message = 'Fail, ' . $new_obj->title .' cannot delete ..... !';
        $request->session()->flash('fail', $smessage);

        return redirect()->route(
            'course.index'
        );
  
}

    }
  
    }
