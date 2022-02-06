@include('layouts.header')

  <main id="main">

    <!-- ======= Breadcrumbs ======= -->
    <div class="breadcrumbs" data-aos="fade-in">
      <div class="container">
        <h2>Blog</h2>
      </div>
    </div><!-- End Breadcrumbs -->

    <!-- ======= Events Section ======= -->
    <section id="events" class="events">
      <div class="container" data-aos="fade-up">

      
        <div class="row">
        @foreach($blogs as $blog)
          <div class="col-md-6 d-flex align-items-stretch">
          
            <div class="card">
              <div class="card-img">
                <img src="assets/img/events-1.jpg" alt="...">
              </div>
              
              <div class="card-body">
              
                <h5 class="card-title"><a href="">{{$blog->title}}</a></h5>
                <p class="fst-italic text-center">{{ $blog->name}}</p>
                <p class="card-text">{{$blog->description}}</p>
                
            </div>
              
            </div>
            
          </div>
          @endforeach 
        </div>
        
      </div>
    </section><!-- End Events Section -->

  </main><!-- End #main -->

 @include('layouts.footer')