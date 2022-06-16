@include('layouts.header')

  <!-- ======= Hero Section ======= -->
  <section id="hero" class="d-flex justify-content-center align-items-center">
    <div class="container position-relative" data-aos="zoom-in" data-aos-delay="100">
      <h1>Learning Today,<br>Leading Tomorrow</h1>
      <h2>We are team of talented designers making websites with Bootstrap</h2>
      <form action="/search">
      {{ csrf_field() }}
      <div class="row">
        <div class="col-md-6">
            <input type="search" name="search"  class="form-control mt-3" placeholder="search">
        </div>
      <div class="col-md-6" style="margin-left:-18px; margin-top:16px;">
      <button type="submit" class="btn btn-success my-2 my-sm-0">Search</button>
</div>
      
      </div>
      </form>
    </div>
  </section><!-- End Hero --> 

  <main id="main">

    <!-- ======= About Section ======= -->
    <section id="about" class="about">
      <div class="container" data-aos="fade-up">

        <div class="row">
          <div class="col-lg-6 order-1 order-lg-2" data-aos="fade-left" data-aos-delay="100">
            <img src="assets/img/about.jpg" class="img-fluid" alt="">
          </div>

        </div>

      </div>
    </section><!-- End About Section -->

    <!-- ======= Why Us Section ======= -->
    <!-- ======= Popular Courses Section ======= -->



    <section id="popular-courses" class="courses" style="margin-top: -130px;">
      <div class="container" data-aos="fade-up">

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
        <div class="section-title">
          <h2>Courses</h2>
          <p>Popular Courses</p>
        </div>

        <div class="row" data-aos="zoom-in" data-aos-delay="100">
    @foreach($courses as $i=>$course)
          <div class="col-lg-4 col-md-6 d-flex align-items-stretch">
            <div class="course-item">
              <img src="{{ $course->Image}}" class="img-fluid" alt="...">
               <div class="course-content">
              @if(Auth::check())
                <div class="d-flex justify-content-between align-items-center mb-3">
                  <a href="/payment/{{$course->id}}/payment"><h4>Enroll</h4></a>
                  <p class="price">{{ $course->fee }} - mmk</p>
                </div>
                @else
                <div class="d-flex justify-content-between align-items-center mb-3">
                <a href="{{ route('login') }}"><h4>Enroll</h4></a>
                  <p class="price">{{ $course->fee }} - mmk</p>
                </div>
                @endif

                <h3><a href="#">{{ $course->title}}</a></h3>
                <p>{{ $course->description}}</p>
                <div class="trainer d-flex justify-content-between align-items-center">
                  <div class="trainer-profile d-flex align-items-center">
                    <!-- <img src="assets/img/trainers/trainer-1.jpg" class="img-fluid" alt=""> -->
                    <span>{{ $course->author}}</span>
                  </div>
                  <div class="trainer-rank d-flex align-items-center">
                    <i class="bx bx-user"></i>&nbsp;50
                    &nbsp;&nbsp;
                    @if(Auth::check())
                        <input type="hidden" id="checkExist{{$course->id}}" value="{{ $favouriteOrNot[$i ?? ''] > 0 ? 1 : 2 }}">
                        <i class="{{ $favouriteOrNot[$i ?? ''] > 0 ? 'bx bx-heart' : 'bx bx-heart' }} " id="course{{$course->id}}" onclick="togglefavourite({{$course->id}})">&nbsp;{{$count[$i]}}</i>
                        
                    @else
                      <i class="bx bx-heart" onclick="login()" id="course{{$course->id}}" >&nbsp;{{$count[$i]}}</i>
                    @endif
                  </div>
                </div>
              </div>
            </div>
          </div> <!-- End Course Item-->
@endforeach
        </div>

      </div>
    </section><!-- End Popular Courses Section -->



        <!-- ======= Trainers Section ======= -->
    <section id="trainers" class="trainers">
      <div class="container" data-aos="fade-up">

        <div class="row" data-aos="zoom-in" data-aos-delay="100">
          <div class="col-lg-4 col-md-6 d-flex align-items-stretch">
            <div class="member">
              <img src="/frontend/assets/img/trainers/trainer-1.jpg" class="img-fluid" alt="">
              <div class="member-content">
                <h4>Walter White</h4>
                <span>Web Development</span>
                <p>
                  Magni qui quod omnis unde et eos fuga et exercitationem. Odio veritatis perspiciatis quaerat qui aut aut aut
                </p>
                <div class="social">
                  <a href=""><i class="bi bi-twitter"></i></a>
                  <a href=""><i class="bi bi-facebook"></i></a>
                  <a href=""><i class="bi bi-instagram"></i></a>
                  <a href=""><i class="bi bi-linkedin"></i></a>
                </div>
              </div>
            </div>
          </div>

          <div class="col-lg-4 col-md-6 d-flex align-items-stretch">
            <div class="member">
              <img src="/frontend/assets/img/trainers/trainer-2.jpg" class="img-fluid" alt="">
              <div class="member-content">
                <h4>Sarah Jhinson</h4>
                <span>Marketing</span>
                <p>
                  Repellat fugiat adipisci nemo illum nesciunt voluptas repellendus. In architecto rerum rerum temporibus
                </p>
                <div class="social">
                  <a href=""><i class="bi bi-twitter"></i></a>
                  <a href=""><i class="bi bi-facebook"></i></a>
                  <a href=""><i class="bi bi-instagram"></i></a>
                  <a href=""><i class="bi bi-linkedin"></i></a>
                </div>
              </div>
            </div>
          </div>

          <div class="col-lg-4 col-md-6 d-flex align-items-stretch">
            <div class="member">
              <img src="/frontend/assets/img/trainers/trainer-3.jpg" class="img-fluid" alt="">
              <div class="member-content">
                <h4>William Anderson</h4>
                <span>Content</span>
                <p>
                  Voluptas necessitatibus occaecati quia. Earum totam consequuntur qui porro et laborum toro des clara
                </p>
                <div class="social">
                  <a href=""><i class="bi bi-twitter"></i></a>
                  <a href=""><i class="bi bi-facebook"></i></a>
                  <a href=""><i class="bi bi-instagram"></i></a>
                  <a href=""><i class="bi bi-linkedin"></i></a>
                </div>
              </div>
            </div>
          </div>

        </div>

      </div>
    </section><!-- End Trainers Section -->

  </main><!-- End #main -->


<script>

function login() {
                    if(!confirm("Firstly! you need to login to do this"))
                    event.preventDefault();
                }

  function togglefavourite(id)
  {
    var checkExist = $("#checkExist"+id).val();
    
        $.ajax({
            type: 'POST',
            url: '/frontend/favourite/add',
            data: {
                _token: "{{csrf_token()}}",
                course_id: id
            },
            dataType: 'json',
            success: function(data) {

              let temp_data = data.returned_obj;
              console.log(temp_data);
              console.log(temp_data.objs);
            $("#course"+id).html("&nbsp;"+temp_data.objs);
            if(checkExist == 2)
            {
              $("#checkExist"+id).val(1);
              $("#course"+id).removeClass("bx bx-heart").css("color", "grey");
              $("#course"+id).addClass("bx bx-heart-circle").css("color", "red");

            }
            else if(checkExist == 1)
            {
              $("#checkExist"+id).val(2);
              $("#course"+id).removeClass("bx bx-heart-circle").css("color", "red");
              $("#course"+id).addClass("bx bx-heart").css("color", "grey");
            }
            $("#course"+id).trigger("chosen:updated");
            }
        });


  }
  </script>

@include('layouts.footer')