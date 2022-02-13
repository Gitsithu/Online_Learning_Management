@include('layouts.header')
<main id="main">

    <!-- ======= Breadcrumbs ======= -->
    <div class="breadcrumbs" data-aos="fade-in">
      <div class="container">
        <h2>Profile Edit</h2>
        
      </div>
    </div><!-- End Breadcrumbs -->

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
  
    <!-- ======= Contact Section ======= -->
    <section id="contact" class="contact">

      <div class="container" data-aos="fade-up">

        <div class="row mt-5">

          <div class="col-lg-4">
            <div class="info">
              <div class="address">
                <i class="bi bi-geo-alt"></i>
                <h4>{{$user->address}}</h4>
                <p></p>
              </div>

              <div class="email">
                <i class="bi bi-envelope"></i>
                <h4>Email:</h4>
                <p>{{$user->email}}</p>
              </div>

              <div class="phone">
                <i class="bi bi-phone"></i>
                <h4>Call:</h4>
                <p>{{$user->phone}}</p>
              </div>
            </div>

          </div>

          <div class="col-lg-8 mt-5 mt-lg-0">

          <form action="/frontend/users/{{ isset($user)? $user->id:0 }}" method="post" enctype="multipart/form-data">
                    <!-- <input type="hidden" name="_token" value="<?php echo csrf_token(); ?>"> -->
                    {{csrf_field()}}
                    {{ method_field('PATCH') }}
              <div class="row">
                <div class="col-md-6 form-group">
                  <input type="text" value="{{ isset($user)? $user->name:Request::old('name') }}" name="name" class="form-control" id="name" placeholder="Your Name" required>
                </div>
                <div class="col-md-6 form-group mt-3 mt-md-0">
                  <input type="email" class="form-control" value="{{ isset($user)? $user->email:Request::old('email') }}" name="email" id="email" placeholder="Your Email" required>
                </div>
              </div>

              <div class="row">
              <div class=" col-md-6 form-group mt-3">
                <input type="password" class="form-control" name="password" id="subject" placeholder="Password" required>
              </div>

              <div class=" col-md-6 form-group mt-3">
                <input type="password" class="form-control" name="password_confirmation" id="subject" placeholder="Confirm Password" required>
              </div>
              </div>

              <div class="row">

              <div class="col-md-6 form-group mt-3">
                <input type="text" class="form-control" value="{{ isset($user)? $user->phone:Request::old('phone') }}" name="phone" id="subject" placeholder="Phone" required>
              </div>

              <div class="col-md-6 form-group mt-3">
              <select class="form-control" name="status" id="status">
 <?php
                                        if(isset($user)){
                                        ?>
            
                                            <option value="" selected disabled>Select Status</option>
                                            <option value="1" <?php if ($user->status == 1){ echo 'selected'; } ?> style="color:green;" >Active</option>
                                            <option value="0" <?php if ($user->status == 0){ echo 'selected'; } ?> style="color:red;" >In-Active</option>
            
                                        <?php
                                        }
                                        else{
                                        ?>
                                            <option value="" selected disabled>Select Status</option>
                                            <option value="1" style="color:green;">Active</option>
                                            <option value="0" style="color:red;">Inactive</option>
                                        <?php 
                                        }
                                        ?>                                           </select>
              </div>

              </div>

              <div class=" form-group mt-3">
                <input type="file" class="form-control" name="image" id="subject" placeholder="Image" required>
              </div>

              <div class="form-group mt-3">
                <textarea class="form-control" name="address" rows="5" placeholder="Address" required>{{ isset($user)? $user->address:Request::old('address') }}</textarea>
              </div>
              <br>
              <div class="text-center"><button type="submit" style="background-color:lightgreen;"  onclick="myFunction1()" >Update</button></div>
            </form>

          </div>

        </div>

      </div>
    </section><!-- End Contact Section -->

  </main><!-- End #main -->

@include('layouts.footer')