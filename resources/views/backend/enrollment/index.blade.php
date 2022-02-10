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

    </div>
    </div>
      <div class="row">
         <div class="col-12">
          <div class="card my-2" >
              <div class="container">

             <div class="row">
        @foreach ($enrolls as $enroll)

        <div class="col-md-6 mt-4">
          <div class="card">
            <div class="card-body pt-4 p-3">
              <ul class="list-group">
                <li class="list-group-item border-0 d-flex p-4 mb-2 bg-gray-100 border-radius-lg">
                  <div class="d-flex flex-column">
                    <h6 class="mb-3 text-sm">{{ \Carbon\Carbon::parse($enroll->created_at)->diffForHumans() }}</h6>
                    <span class="mb-2 text-xs">Category Name: <span class="text-dark font-weight-bold ms-sm-2">{{$enroll -> name}}</span></span>
                    <span class="mb-2 text-xs">Category Status: <span class="text-dark ms-sm-2 font-weight-bold">
                        
                      @if($enroll->status == 1)
                                              <span class="text-info ms-sm-2 font-weight-bold">  Pending </span>
                                                @elseif($enroll->status == 3)
                                               <span class="text-success ms-sm-2 font-weight-bold"> Approve</span>
                                               @else
                                               <span class="text-danger ms-sm-2 font-weight-bold"> Reject</span>
                                                @endif
                                              
                    </span></span>
                  </div>
                  @if($enroll->status==1)
                  <div class="ms-auto text-end">
                    <a class="btn btn-link text-danger text-gradient px-3 mb-0" onclick="return myFunction1();" href='/admin/enrollment/{{ $enroll->id }}/reject'><i class="material-icons text-sm me-2">cancel</i>Reject</a>

                    <a class="btn btn-link text-dark px-3 mb-0" onclick="return myFunction();" href='/admin/enrollment/{{ $enroll->id }}/approve'><i class="material-icons text-sm me-2">check</i>Approve</a>
                  </div>
                  @else
                  @endif
                </li>
                
                </div>
                
                </div>
                <br>
            
                </div>
                
            @endforeach
            
        </div>
              {{ $enrolls->links() }}

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