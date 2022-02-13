@include('layouts.partial.header')
  <main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg ">
    <div class="container-fluid py-4">
      <div class="row">
        <div class="col-12">
          <div class="card my-4">
            <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
              <div class="bg-gradient-primary shadow-primary border-radius-lg pt-4 pb-3">
                <h6 class="text-white text-capitalize ps-3">Student's Enrollment Report</h6>
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
                      <td>
                        <div class="d-flex px-2 py-1">
                          <div>
                            <img src="{{$enroll->Image}}" class="avatar avatar-sm me-3 border-radius-lg" alt="user1">
                          </div>
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
                        <!-- <span class="badge badge-sm bg-gradient-success">Online</span> -->
                        @if($enroll->status == 2)
                                              <span class="badge badge-sm bg-gradient-success">  Approve </span>
                                                @elseif($enroll->status == 1)
                                               <span class="badge badge-sm bg-gradient-secondary"> Pending</span>
                                               @else
                                               <span class="badge badge-sm bg-gradient-danger"> Rejected</span>
                                                @endif
                      </td>
                      <td class="align-middle text-center">
                        <span class="text-secondary text-xs font-weight-bold">{{$enroll->created_at}}</span>
                      </td>
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
    
      @include('layouts.partial.footer')