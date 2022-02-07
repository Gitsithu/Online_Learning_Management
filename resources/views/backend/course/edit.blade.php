@include('layouts.partial.header')

<section class="content">
        <div class="container-fluid">
             <div class="row">
                 @if (session('success'))
                 <div class="flash-message col-md-12">
                     <div class="alert alert-success ">
                         {{session('success')}}
                     </div>
                 </div>
                 @elseif(session('fail'))
                 <div class="flash-message col-md-12">
                     <div class="alert alert-danger">
                         {{session('fail')}}
                     </div>
                 </div>

                 @endif
                       @if (count($errors) > 0)
                                       <div class="content mt-3">
                                           <!-- div class=row content start -->
                                           <div class="animated fadeIn">
                                               <!-- div class=FadeIn start -->
                                               <div class="card">
                                                   <!-- card start -->

                                                   <div class="card-body">
                                                       <!-- card-body start -->


                                                       <div class="row">
                                                           <!-- div class=row One start -->
                                                           @foreach ($errors->all() as $error)
                                                           <div class="col-md-12">
                                                               <!-- div class=col 12 One start -->
                                                               <p class="text-danger">* {{ $error }}</p>
                                                           </div><!-- div class=col 12 One end -->
                                                           @endforeach
                                                       </div><!-- div class=row One end -->


                                                   </div> <!-- card-body end -->

                                               </div><!-- card end -->
                                           </div><!-- div class=FadeIn start -->
                                       </div><!-- div class=row content end -->
                                       @endif
             </div>

</section>
    <!-- End Navbar -->
    <div class="container-fluid py-2">
      <div class="row">
         <div class="col-12">
          <div class="card my-2" >
       <form action="/admin/course/{{ isset($course)? $course->id:0 }}" method="post"  enctype="multipart/form-data">
                    <!-- <input type="hidden" name="_token" value="<?php echo csrf_token(); ?>"> -->
                    {{csrf_field()}}
                    {{ method_field('PATCH') }}

                           <div class="container">
                            <div class="row" style="padding-top:5%;">

                             <div class="col-md-4">
                             <label>Category</label>
                                <div class="input-group input-group-outline mb-3">
                                                <select class="form-control" name="Categories_ID" >
                                                   @foreach($categories as $category)
                                                                            @if($course->Categories_ID == $category->id)
                                                                                <option value="{{$category->id}}" selected>{{$category->name}}</option>
                                                                            @else
                                                                                <option value="{{$category->id}}">{{$category->name}}</option>
                                                                            @endif
                                                                        @endforeach
                                                </select>
                                            
                                    </div>
                                </div>

                                <div class="col-md-4">
                                <label>Title</label>
                                <div class="input-group input-group-outline mb-3">
                                            <input type="text" value="{{ isset($course)? $course->title:Request::old('title') }}" name="title" class="form-control" placeholder="Course Title">
                                    </div>
                                </div>
                                  <div class="col-md-4">
                                  <label>Status</label>
                                 <div class="input-group input-group-outline mb-3">

                                    <select class="form-control" name="status" id="status">
 <?php
                                        if(isset($course)){
                                        ?>
            
                                            <option value="" selected disabled>Select Status</option>
                                            <option value="1" <?php if ($course->status == 1){ echo 'selected'; } ?> style="color:green;" >Active</option>
                                            <option value="0" <?php if ($course->status == 0){ echo 'selected'; } ?> style="color:red;" >In-Active</option>
            
                                        <?php
                                        }
                                        else{
                                        ?>
                                            <option value="" selected disabled>Select Status</option>
                                            <option value="1" style="color:green;">Active</option>
                                            <option value="0" style="color:red;">Inactive</option>
                                        <?php 
                                        }
                                        ?>                                           </select>

                                </div>

                            </div>
                         
                                 
                               
                                
                               
                                 </div>
                            <div class="row">
                            <div class="col-md-3">
                            <label>Author</label>
                                <div class="input-group input-group-outline mb-3">
                                            <input type="text" value="{{ isset($course)? $course->author:Request::old('author') }}" name="author" class="form-control" placeholder="Course Author">
                                    </div>
                                </div>

                            <div class="col-md-3">
                            <label>Course Fee</label>
                                <div class="input-group input-group-outline mb-3">
                                            <input type="text" value="{{ isset($course)? $course->fee:Request::old('fee') }}" name="fee" class="form-control" placeholder="Course Fee">
                                    </div>
                                </div>

                                <div class="col-md-3">
                                <label>Course Duration</label>
                                <div class="input-group input-group-outline mb-3">
                                            <input type="text" value="{{ isset($course)? $course->duration:Request::old('duration') }}" name="duration" class="form-control" placeholder="Coures Duration">
                                    </div>
                                </div>

                                <div class="col-md-3">
                                <label>Published Date</label>
                                <div class="input-group input-group-outline mb-3">
                                            <input type="date" value="{{ isset($course)? $course->published_date:Request::old('published_date') }}" name="published_date" class="form-control" placeholder="Course Published Date">
                                    </div>
                                </div>
                        </div>
                              <div class="row">  

                              <div class="col-md-6">
                                <label>Video</label>
                                <div class="input-group input-group-outline mb-3">
                                            <input type="file" value="{{ isset($course)? $course->video:Request::old('video') }}" accept=" video/*" name="video" class="form-control" >
                                    </div>
                                </div> 

                                <div class="col-md-6">
                                <label>Image</label>
                                <div class="input-group input-group-outline mb-3">
                                            <input type="file" value="{{ isset($course)? $course->Image:Request::old('image') }}" name="image" class="form-control" >
                                    </div>
                                </div> 

                            <div class="col-md-12">
                                <div class="input-group input-group-outline mb-3">
                                    <textarea value="" name="description" class="form-control" placeholder="Course Description" id="" cols="30" rows="5" >{{ isset($course)? $course->description:Request::old('description') }}</textarea>
                        
                                    </div>
                                </div>

                                <div class="col-md-12">
                                <div class="input-group input-group-outline mb-3">
                                    <textarea value="" name="remark" class="form-control" placeholder="Course Remark" id="" cols="30" rows="5">{{ isset($course)? $course->remark:Request::old('remark') }}</textarea>
                        
                                    </div>
                                </div>

                            </div>
                        
                            <div class="container">

                            <div class="row">

                            <div class="card-footer">
                                               <button type="submit" onclick="myFunction1()" class="btn btn-fill btn-primary"> <i class="tim-icons icon-send"></i> Update</button>
                                             </div>
                                             </div>
                            </div>

                        </form>
        </div>
      </div>
      </div>
      </div>
      

      @include('layouts.partial.footer')
                                                                            {{-- dynamic looping--}}
                                                                       