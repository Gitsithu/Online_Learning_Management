@include('layouts.header')

  <main id="main" data-aos="fade-in">

    <!-- ======= Breadcrumbs ======= -->
    <div class="breadcrumbs">
      <div class="container">
        <h2>Customer Profile</h2>
      </div>
    </div><!-- End Breadcrumbs -->

    <!-- ======= Trainers Section ======= -->
    <section id="trainers" class="trainers">
      <div class="container" data-aos="fade-up">

        <div class="row" data-aos="zoom-in" data-aos-delay="100">
          <div class="col-lg-4 col-md-12 d-flex align-items-stretch" style="align-items: center !important;">
            <div class="member">
                @foreach($users as $user)
              <img src="{{$user->image}}" class="img-fluid" alt="">
              <div class="member-content">
                <h4>{{$user->name}}</h4>
                <span>{{$user->email}}</span>
                <p>
                  {{$user->address}}
                </p>
                <div class="social">
                <a onclick="return myFunction();" href='/frontend/user/{{ $user->id }}/edit'><i class="bx bx-user">Edit</i></a>
                </div>
              </div>
              @endforeach
            </div>
          </div>

        </div>

      </div>
    </section><!-- End Trainers Section -->

  </main><!-- End #main -->

@include('layouts.footer')