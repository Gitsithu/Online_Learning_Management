@include('layouts.header');

  <main id="main" data-aos="fade-in">

    <!-- ======= Breadcrumbs ======= -->
    <div class="breadcrumbs">
      <div class="container">
        <h2>Courses</h2>
        <p>Est dolorum ut non facere possimus quibusdam eligendi voluptatem. Quia id aut similique quia voluptas sit quaerat debitis. Rerum omnis ipsam aperiam consequatur laboriosam nemo harum praesentium. </p>
      </div>
    </div><!-- End Breadcrumbs -->

    <!-- ======= Courses Section ======= -->
    <section id="courses" class="courses">
      <div class="container" data-aos="fade-up">

        <div class="row" data-aos="zoom-in" data-aos-delay="100">
    @foreach($courses as $course)
          <div class="col-lg-4 col-md-6 d-flex align-items-stretch">
            <div class="course-item">
              <img src="{{ $course->Image}}" class="img-fluid" alt="...">
              <div class="course-content">
              @if(Auth::check())
                <div class="d-flex justify-content-between align-items-center mb-3">
                  <a href="#"><h4>Enroll</h4></a>
                  <p class="price">{{ $course->fee }} - mmk</p>
                </div>
                @else
                <div class="d-flex justify-content-between align-items-center mb-3">
                <a href="{{ route('login') }}"><h4>Enroll</h4></a>
                  <p class="price">{{ $course->fee }} - mmk</p>
                </div>
                @endif


                <h3><a href="course-details.html">{{ $course->title}}</a></h3>
                <p>{{ $course->description}}</p>
                <div class="trainer d-flex justify-content-between align-items-center">
                  <div class="trainer-profile d-flex align-items-center">
                    <!-- <img src="assets/img/trainers/trainer-1.jpg" class="img-fluid" alt=""> -->
                    <span>{{ $course->author}}</span>
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