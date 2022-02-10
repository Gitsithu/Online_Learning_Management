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
    <div class="container-fluid py-2" style="overflow-x: hidden;">
    <div class="row">
    <div class="col-10 offset-10">
    <a href="/admin/course/create"><button type="submit"  class="btn btn-fill btn-primary"> <i class="tim-icons icon-send"></i>Create</button></a>

    </div>
    </div>
      <div class="row">
         <div class="col-12">
          <div class="card my-2" >
              <div class="container">

             <div class="row">
        @foreach ($courses as $course)

        <div class="col-md-6 mt-4">
          <div class="card">
            <div class="card-body pt-4 p-3">
              <ul class="list-group">
                <li class="list-group-item border-0 d-flex p-4 mb-2 bg-gray-100 border-radius-lg">
                  <div class="d-flex flex-column">
                    <h6 class="mb-3 text-sm">{{ \Carbon\Carbon::parse($course->created_at)->diffForHumans() }}</h6>
                    <span class="mb-2 text-xs">Category Name: <span class="text-dark font-weight-bold ms-sm-2" >{{$course -> name}}</span></span>
                    <span class="mb-2 text-xs">Course Title: <span class="text-dark ms-sm-2 font-weight-bold">{{ $course->title}}</span></span>
                    <span class="mb-2 text-xs">Course Author: <span class="text-dark ms-sm-2 font-weight-bold">{{ $course->author}}</span></span>
                    <span class="mb-2 text-xs">Course Fee: <span class="text-dark ms-sm-2 font-weight-bold">{{ $course->fee}}</span></span>
                    <span class="mb-2 text-xs">Course Duration: <span class="text-dark ms-sm-2 font-weight-bold">{{ $course->duration}}</span></span>
                    <span class="mb-2 text-xs">Course Published Date: <span class="text-dark ms-sm-2 font-weight-bold">{{ $course->published_date}}</span></span>
                    <span class="mb-2 text-xs">Course Status: <span class="text-dark ms-sm-2 font-weight-bold">
                      @if($course->status == 1)
                                              <span class="text-success ms-sm-2 font-weight-bold">  Active </span>
                                                @else
                                               <span class="text-danger ms-sm-2 font-weight-bold"> In-Active
                                                @endif
                                              
                    </span></span>
                    <!-- <span class="mb-2 text-xs">Course Video <span class="text-dark ms-sm-2 font-weight-bold">
                    <video width="200px" height="100px" controls="controls">   
                    <source src="{{ $course->video}}"> 
                </video> 
                    </span></span> -->
                  </div>
                  <div class="ms-auto text-end">
                     <a class="btn btn-link text-danger text-gradient px-3 mb-0" onclick="return myFunction1();" href='/admin/course/{{ $course->id }}/delete'><i class="material-icons text-sm me-2">delete</i>Delete</a>
                    
                    <a class="btn btn-link text-dark px-3 mb-0" onclick="return myFunction();" href='/admin/course/{{ $course->id }}/edit'><i class="material-icons text-sm me-2">edit</i>Edit</a>
                  </div>
                </li>
                
                </div>
                
                </div>
                <br>
            
                </div>
                
            @endforeach
            
        </div>
              {{ $data->links() }}

        </div>
      </div>
      </div>
      </div>
          <script>
                function myFunction() {
                    if(!confirm("Are You Sure to update this ?"))
                    event.preventDefault();
                }
                
                function myFunction1() {
                    if(!confirm("Are You Sure to delete this ?"))
                    event.preventDefault();
                }
                
                </script>                                  
      @include('layouts.partial.footer')