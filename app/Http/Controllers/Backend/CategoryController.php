<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;
use App\Models\Categories;

class CategoryController extends Controller
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
        $categories = Categories::where('deleted_at', NULL)->get();
        $data = Categories::latest()->paginate(5);
        
        return view('backend.category.index')
            ->with('categories', $categories)
            ->with('data', $data);

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('backend.category.create');
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
            'name' => 'required',
            'status' => 'required'
            
        ]);
        try{
            
     
        $name = $request->input('name');
        $status = $request->input('status');
        
        $created_at = date("Y-m-d H:i:s");

           
            $new_obj = new Categories();
        
           
            $new_obj->name = $name;
            $new_obj->status = $status;
            $new_obj->created_at = $created_at;
            $new_obj->save();
        
                $message = 'Success, category created successfully ...!';
                $request->session()->flash('success', $message);
    
                // return redirect()->route('backend/car_type');
                // return redirect()->action(
                //     'UserController@profile', ['id' => 1]
                    // );
    
                return redirect()->route(
                    'category.index'
                );
            
            
    
        }
        catch(Exception $e){
            
            $smessage = 'Fail, Error in category creating ...!';
            $request->session()->flash('fail', $smessage);

            return redirect()->route(
                'category.index'
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
        $category = DB::table('categories')->where('id', $id)->first();
        return view('backend.category.edit', ['category' => $category]);
    
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
            
            'status' => 'required',
            
        ]);

        $name = $request->input('name');
        $status = $request->input('status');
        
        $updated_at = date("Y-m-d H:i:s");

        try{
            
            $new_obj = Categories::find($id);
            $new_obj->name = $name;
            $new_obj->status = $status;
            $new_obj->updated_at = $updated_at;
            $new_obj->save();
        
                $message = 'Success, category updated successfully ...!';
                $request->session()->flash('success', $message);
    
                // return redirect()->route('backend/car_type');
                // return redirect()->action(
                //     'UserController@profile', ['id' => 1]
                    // );
    
                    return redirect()->route(
                        'category.index'
                    );
            
    
        }
        catch(Exception $e){
            
            $smessage = 'Fail, Error in brand updating ...!';
            $request->session()->flash('fail', $smessage);

            return redirect()->route(
                'category.index'
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
        //
        $obj = Categories::find($id);
        
        // Very Dangerous - Fully Delete Action
        // If no need to destory permanently, u should not use it
        // System will crash in other parts
        // CarType::destroy($id);

        // $status = 0;
        // $updated_at = date("Y-m-d H:i:s");
        // DB::update('update car_type set status = ?, updated_at = ? where id = ?', [$status, $updated_at, $id]);

        // https://laravel.com/docs/5.8/eloquent#soft-deleting

        // $notes = CarType::withTrashed()->get();
        // $obj = CarType::withTrashed()
        //         ->where('id', $id)
        //         ->get();
        // $post = App\Post::withTrashed()->whereId(2)->restore();

        $obj->delete();
        if ($obj->trashed()) {            
            $message = 'Success, ' . $obj->name .' deleted successfully ...!';
            $request->session()->flash('fail', $message);

            return redirect()->route(
                'category.index'
            );
        }
        else{
            
            $message = 'Fail, ' . $obj->name .' cannot delete ..... !';
            $request->session()->flash('fail', $message);

            return redirect()->route(
                'category.index'
            );
        }
    }
  
    public function delete(Request $request,$id)
    {
        $deleted_at = date("Y-m-d H:i:s");
        try{

        $new_obj = Categories::find($id);
        $new_obj->deleted_at = $deleted_at;
        $new_obj->save();
        
        $message = 'Success, ' . $new_obj->name .' deleted successfully ...!';
        $request->session()->flash('fail', $message);

        return redirect()->route(
            'category.index'
        );
    }
    catch(Exception $e){
            
        $message = 'Fail, ' . $new_obj->name .' cannot delete ..... !';
        $request->session()->flash('fail', $smessage);

        return redirect()->route(
            'category.index'
        );
  
}

    }
}
