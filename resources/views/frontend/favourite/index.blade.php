@include('layouts.header');

  <main id="main" data-aos="fade-in">

    <!-- ======= Breadcrumbs ======= -->
    <div class="breadcrumbs">
      <div class="container">
        <h2>Favourite</h2>
      </div>
    </div><!-- End Breadcrumbs -->

    <!-- ======= Courses Section ======= -->
    <section id="courses" class="courses">
      <div class="container" data-aos="fade-up">

        <div class="row" data-aos="zoom-in" data-aos-delay="100">
    @foreach($favourites as $favourite)
          <div class="col-lg-4 col-md-6 d-flex align-items-stretch">
            <div class="course-item">
              <img src="{{ $favourite->Image}}" class="img-fluid" alt="...">
              <div class="course-content">
              @if(Auth::check())
                <div class="d-flex justify-content-between align-items-center mb-3">
                  <a href="/payment/{{$favourite->id}}/payment"><h4>Enroll</h4></a>
                  <p class="price">{{ $favourite->fee }} - mmk</p>
                </div>
                @else
                <div class="d-flex justify-content-between align-items-center mb-3">
                <a href="{{ route('login') }}"><h4>Enroll</h4></a>
                  <p class="price">{{ $favourite->fee }} - mmk</p>
                </div>
                @endif


                <h3>{{ $favourite->title}}</h3>
                <p>{{ $favourite->description}}</p>
                <div class="trainer d-flex justify-content-between align-items-center">
                  <div class="trainer-profile d-flex align-items-center">
                    <!-- <img src="assets/img/trainers/trainer-1.jpg" class="img-fluid" alt=""> -->
                    <span>{{ $favourite->author}}</span>
                  </div>
                  <div class="trainer-rank d-flex align-items-center">
                    <!-- <i class="bx bx-user"></i>&nbsp;50
                    &nbsp;&nbsp;
                    <i class="bx bx-heart"></i>&nbsp;65 -->
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