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


      <div class="container-fluid py-4">
      <div class="row">
        <div class="col-12">
          <div class="card my-4">

            <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">

              <div class="bg-gradient-primary shadow-primary border-radius-lg pt-4 pb-3">
                <h6 class="text-white text-capitalize ps-3">Student's Enrollment</h6>
                <!-- <a class="btn btn-link text-dark px-3 mb-0" href="{{ route('export') }}" method="POST" enctype="multipart/form-data"><i class="material-icons text-sm me-2">pdf</i>Excel</a> -->
              </div>
            </div>
            <div class="card-body px-0 pb-2">
              <div class="table-responsive p-0">
                <table class="table align-items-center mb-0">
                  <!-- <thead>
                    <tr>
                      <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Author</th>
                      <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Function</th>
                      <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Status</th>
                      <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Employed</th>
                      <th class="text-secondary opacity-7"></th>
                    </tr>
                  </thead> -->
                  <tbody>
                  @foreach($enrolls as $enroll)
                    <tr>
                    <td class="align-middle text-center">
                        <span class="text-secondary text-xs font-weight-bold">{{$enroll->created_at}}</span>
                      </td>
                      
                      <td>
                        <div class="d-flex px-2 py-1">
                          <div class="d-flex flex-column justify-content-center">
                            <h6 class="mb-0 text-sm">{{ $enroll->name}}</h6>
                            <p class="text-xs text-secondary mb-0">{{$enroll->title}}</p>
                          </div>
                        </div>
                      </td>
                      <td>
                        <p class="text-xs font-weight-bold mb-0">{{$enroll->bank_name}}</p>
                        <p class="text-xs text-secondary mb-0">{{$enroll->amount}} -mmk</p>
                      </td>

                      <td class="align-middle text-center text-sm">
                        <span class="badge badge-sm"><a href="{{$enroll -> image}}">Click to Download Slip</a></span>
                        
                      </td>
                      <td class="align-middle text-center text-sm">
                        <!-- <span class="badge badge-sm bg-gradient-success">Online</span> -->
                        @if($enroll->status == 2)
                                              <span class="badge badge-sm bg-gradient-success">  Approve </span>
                                                @elseif($enroll->status == 1)
                                               <span class="badge badge-sm bg-gradient-secondary"> Pending</span>
                                               @else
                                               <span class="badge badge-sm bg-gradient-danger"> Rejected</span>
                                                @endif
                      </td>
                      @if($enroll->status==1)
                      <td class="align-middle text-center text-sm">
                      
                        <!-- <span class="badge badge-sm bg-gradient-success">Online</span> -->
                        <a class="btn btn-link text-danger text-gradient px-3 mb-0" onclick="return myFunction1();" href='/admin/enrollment/{{ $enroll->id }}/reject'><i class="material-icons text-sm me-2">cancel</i>Reject</a>

                    <a class="btn btn-link text-dark px-3 mb-0" onclick="return myFunction();" href='/admin/enrollment/{{ $enroll->id }}/approve'><i class="material-icons text-sm me-2">check</i>Approve</a>
                      </td>
                      @else
                      @endif

                      
                      <!-- <td class="align-middle">
                        <a href="javascript:;" class="text-secondary font-weight-bold text-xs" data-toggle="tooltip" data-original-title="Edit user">
                          Edit
                        </a>
                      </td> -->
                    </tr>
                    @endforeach
                  </tbody>
                </table>

              </div>
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