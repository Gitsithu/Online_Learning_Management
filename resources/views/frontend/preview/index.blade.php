@include('layouts.header');

  <main id="main" data-aos="fade-in">

    <!-- ======= Breadcrumbs ======= -->
    <div class="breadcrumbs">
      <div class="container">
        <h2>Courses</h2>
      </div>
    </div><!-- End Breadcrumbs -->

    <!-- ======= Courses Section ======= -->
    <section id="courses" class="courses">
      <div class="container" data-aos="fade-up">

        <div class="row" data-aos="zoom-in" data-aos-delay="100">
    @foreach($enrolls as $enroll)
          <div class="col-lg-4 col-md-6 d-flex align-items-stretch">
            <div class="course-item">
              <img src="{{ $enroll->Image}}" class="img-fluid" alt="...">
              <div class="course-content">
                <div class="d-flex justify-content-between align-items-center mb-3">
                    @if($enroll->status==2)
                  <a href="/enroll/{{$enroll->id}}/pre"><h4>Detail</h4></a>
                  @elseif($enroll->status==1)
                  <h4 style="background-color: #17a2b8;">Pending</h4>
                  @else
                  <h4 style="background-color: red !important;">Rejected</h4>
                  @endif
                  <p class="price">{{ $enroll->fee }} - mmk</p>
                </div>


                <h3>{{ $enroll->title}}</h3>
                <p>{{ $enroll->description}}</p>
                <div class="trainer d-flex justify-content-between align-items-center">
                  <div class="trainer-profile d-flex align-items-center">
                    <!-- <img src="assets/img/trainers/trainer-1.jpg" class="img-fluid" alt=""> -->
                    <span>{{ $enroll->author}}</span>
                  </div>
                  <div class="trainer-rank d-flex align-items-center">
                    <i class="bx bx-user"></i>&nbsp;50
                    &nbsp;&nbsp;
                    <i class="bx bx-heart"></i>&nbsp;65
                  </div>
                </div>
              </div>
            </div>
          </div> <!-- End Course Item-->
@endforeach
        </div>

      </div>
    </section><!-- End Courses Section -->

  </main><!-- End #main -->

@include('layouts.footer');