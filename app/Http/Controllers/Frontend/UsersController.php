<?php

namespace App\Http\Controllers\Frontend;
use DB;
use Auth;
use App\Models\User;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class UsersController extends Controller
{
    public function index()
    {
        $loginUser = Auth::user();
        $loginUserId = $loginUser->id;
        $users=DB::select('SELECT * from users where role_id=2 and id='.$loginUserId);
        $data = User::latest()->paginate(5);
        
        return view('frontend.user.index')
            ->with('users', $users)
            ->with('data', $data);

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        $user=DB::select('SELECT * from users where deleted_at is null');
        return view('frontend.user.edit')
        ->with('user', $user);
    }

    public function edit($id)
    {
        //
        $user = DB::table('users')->where('id', $id)->first();
        return view('frontend.user.edit', ['user' => $user]);
    
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function Update(Request $request, $id)
    {
        //
        $this->validate($request, [
            'name' => 'required',
                'password' => 'required|min:8|confirmed',
                'phone' => 'required|min:8|regex:/^([0-9\s\-\+\(\)]*)$/|min:8',
            
        ]);
            
            $name = $request->input('name');
            $email = $request->input('email');
            $password = bcrypt($request->input('password'));
            $phone = $request->input('phone');
            $address = $request->input('address');

            
            // 
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

            // image
            
                $image =$request->file('image');
                if ($image != null){ 
                $new_name = rand() . '.' . $image->getClientOriginalExtension();
                $image->move(public_path('image'), $new_name);
                $image_file = "/image/" . $new_name;

            $new_obj = User::find($id);
            $new_obj->name = $name;
            $new_obj->email = $email;
            $new_obj->password = $password;
            $new_obj->phone = $phone;
            $new_obj->address = $address;
            $new_obj->image = $image_file;
            $new_obj->status = $status;
            $new_obj->created_at = $created_at;
            $new_obj->save();
                }
                else{
                    $new_obj = User::find($id);
                    $new_obj->name = $name;
                    $new_obj->email = $email;
                    $new_obj->password = $password;
                    $new_obj->phone = $phone;
                    $new_obj->address = $address;
                    $new_obj->status = $status;
                    $new_obj->created_at = $created_at;
                    $new_obj->save();
                }
        
                $message = 'Success, User created successfully ...!';
                $request->session()->flash('success', $message);
    
                // return redirect()->route('backend/car_type');
                // return redirect()->action(
                //     'UserController@profile', ['id' => 1]
                    // );
    
                return redirect()->route(
                    'frontend.user.index'
                );
        }
            
    
        catch(Exception $e){
            
            $smessage = 'Fail, Error in course creating ...!';
            $request->session()->flash('fail', $smessage);

            return redirect()->route(
                'frontend.user.index'
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


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request,$id)
    {
        // to delect the data from database
        $obj = User::find($id);
        $obj->delete();
        if ($obj->trashed()) {            
            $message = 'Success, ' . $obj->title .' deleted successfully ...!';
            $request->session()->flash('fail', $message);

            return redirect()->action(
                'frontend\CourseController@index'
            );
        }
        else{
            
            $message = 'Fail, ' . $obj->title .' cannot delete ..... !';
            $request->session()->flash('fail', $message);

            return redirect()->action(
                'frontend\CourseController@index'
            );
        }
    }
//     public function delete(Request $request,$id)
//     {
//         $deleted_at = date("Y-m-d H:i:s");
//         try{

//         $new_obj = Courses::find($id);
//         $new_obj->deleted_at = $deleted_at;
//         $new_obj->save();
        
//         $message = 'Success, ' . $new_obj->title .' deleted successfully ...!';
//         $request->session()->flash('fail', $message);

//         return redirect()->route(
//             'course.index'
//         );
//     }
//     catch(Exception $e){
            
//         $message = 'Fail, ' . $new_obj->title .' cannot delete ..... !';
//         $request->session()->flash('fail', $smessage);

//         return redirect()->route(
//             'course.index'
//         );
  
// }

//     }
  
    }