<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>Online Management System</title>
  <meta content="" name="description">
  <meta content="" name="keywords">

  <!-- Favicons -->
  <link href="/frontend/assets/img/favicon.png" rel="icon">
  <link href="/frontend/assets/img/apple-touch-icon.png" rel="apple-touch-icon">

  <!-- Google Fonts -->
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Raleway:300,300i,400,400i,500,500i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">

  <!-- Vendor CSS Files -->
  <link href="/frontend/assets/vendor/animate.css/animate.min.css" rel="stylesheet">
  <link href="/frontend/assets/vendor/aos/aos.css" rel="stylesheet">
  <link href="/frontend/assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="/frontend/assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
  <link href="/frontend/assets/vendor/boxicons/css/boxicons.min.css" rel="stylesheet">
  <link href="/frontend/assets/vendor/remixicon/remixicon.css" rel="stylesheet">
  <link href="/frontend/assets/vendor/swiper/swiper-bundle.min.css" rel="stylesheet">

  <!-- Template Main CSS File -->
  <link href="/frontend/assets/css/style.css" rel="stylesheet">

  <!-- =======================================================
  * Template Name: Mentor - v4.7.0
  * Template URL: https://bootstrapmade.com/mentor-free-education-bootstrap-theme/
  * Author: BootstrapMade.com
  * License: https://bootstrapmade.com/license/
  ======================================================== -->
</head>

<body>

  <!-- ======= Header ======= -->
  <header id="header" class="fixed-top">
    <div class="container d-flex align-items-center">

      <h1 class="logo me-auto"><a href="/">Hill Online Learning</a></h1>
      <!-- Uncomment below if you prefer to use an image logo -->
      <!-- <a href="index.html" class="logo me-auto"><img src="assets/img/logo.png" alt="" class="img-fluid"></a>-->

      <nav id="navbar" class="navbar order-last order-lg-0">
        <ul>
          <li><a class="{{ request()->route()->getName() === 'welcome' ? 'active' : '' }}" href="/">Home</a></li>
          <li><a class="{{ request()->route()->getName() === 'course.index'|| request()->route()->getName() === 'search.index' }}" href="/frontend/course">Courses</a></li>
          <li><a class="{{ request()->route()->getName() === 'blog.index' ? 'active' : '' }}" href="/frontend/blog">Blog</a></li>
          <li class="dropdown"><a href="#" class="{{ request()->route()->getName() === 'frontend.course.show' ? 'active' : '' }}"><span>Category</span> <i class="bi bi-chevron-down"></i></a>
            <ul>
              @foreach($categories as $category)
              <li><a class="{{ request()->route()->getName() === 'frontend.course.show' ? 'active' : '' }}" href="/frontend/course/{{$category->id}}/show">{{$category->name}}</a></li>
              @endforeach
            </ul>
          </li>

        </ul>
        <i class="bi bi-list mobile-nav-toggle"></i>
      </nav><!-- .navbar -->
      @if(Auth::check())
      <nav id="navbar" class="navbar order-last order-lg-0">
        <ul>
      <li><a class="{{ request()->route()->getName() === 'preview.index' ? 'active' : '' }}" href="/frontend/preview">Enroll</a></li>
      <li><a class="{{ request()->route()->getName() === 'frontend.favourite.view' ? 'active' : '' }}" href="/frontend/favourite/view">Favourite</a></li>
      <li><a class="{{ request()->route()->getName() === 'feedback.index' ? 'active' : '' }}"href="/frontend/feedback">Feedback</a></li>
        </ul>
      </nav>
      @else
      @endif
      @guest
      <a href="/login" class="get-started-btn">Login</a>
      @if (Route::has('register'))
      <a href="/register" class="get-started-btn">register</a>

      @endif
      @else
      <nav id="navbar" class="navbar order-last order-lg-0">
        <ul>
      <li class="dropdown">
      <a href="#" class="{{ request()->route()->getName() === 'users.index'||request()->route()->getName() === 'users.edit' ? 'active' : '' }}"><span>Profile</span> <i class="bi bi-chevron-down"></i></a>
                <ul>
                  <li><a href="/frontend/users" class="{{ request()->route()->getName() === 'users.index'||request()->route()->getName() === 'users.edit' ? 'active' : '' }}">{{ Auth::user()->name }}</a></li>
                  <li><a href="{{ route('logout') }}" onclick="event.preventDefault();document.getElementById('logout-form').submit();">logout</a></li>
                  <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                            @csrf
                                        </form> 
                </ul>
              </li>
        </ul>
      </nav>
    @endguest
    </div>
  </header><!-- End Header -->