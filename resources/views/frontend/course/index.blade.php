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
                        <input type="hidden" id="checkExist{{$course->id}}" value="{{ $favouriteOrNot[$i] > 0 ? 1 : 2 }}">
                        <i class="{{ $favouriteOrNot[$i] > 0 ? 'bx bx-user' : 'bx bx-heart' }} " id="course{{$course->id}}" onclick="togglefavourite({{$course->id}})">&nbsp;{{$count[$i]}}</i>
                        
                    @else
                      <i class="bx bx-heart" id="course{{$course->id}}" >&nbsp;{{$count[$i]}}</i>
                    @endif
                   
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

<script>
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
              $("#course"+id).removeClass("bx bx-heart");
              $("#course"+id).addClass("bx bx-user");

            }
            else if(checkExist == 1)
            {
              $("#checkExist"+id).val(2);
              $("#course"+id).removeClass("bx bx-user");
              $("#course"+id).addClass("bx bx-heart");
            }
            $("#course"+id).trigger("chosen:updated");
            }
        });


  }

  // function unfavourite(id)
  // {

  //       $.ajax({
  //           type: 'POST',
  //           url: '/frontend/unfavourite/add',
  //           data: {
  //               _token: "{{csrf_token()}}",
  //               course_id: id
  //           },
  //           dataType: 'json',
  //           success: function(data) {
  //             let temp_data = data.returned_obj;
  //             console.log(temp_data);
  //             console.log(temp_data.objs);
  //           $("#course"+id).html("&nbsp;"+temp_data.objs);
  //           $("#course"+id).trigger("chosen:updated");
  //           }
  //       });
  // }
</script>

@include('layouts.footer');