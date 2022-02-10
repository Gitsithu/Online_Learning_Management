

<html class="html">
    <head>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet" >
        <link href="https://use.fontawesome.com/releases/v5.7.2/css/all.css" rel="stylesheet">
        <link href="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js">
        <style>
            @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@500&family=Work+Sans:wght@800&display=swap');

* {
    padding: 0;
    margin: 0;
    box-sizing: border-box
}

body {
    padding: 15px;
    background-color: #ddc3c3
}

.container {
    margin: 20px auto;
    max-width: 1000px;
    background-color: white;
    padding: 0
}

.form-control {
    height: 25px;
    width: 150px;
    border: none;
    border-radius: 0;
    font-weight: 800;
    padding: 0 0 5px 0;
    background-color: transparent;
    box-shadow: none;
    outline: none;
    border-bottom: 2px solid #ccc;
    margin: 0;
    font-size: 14px
}

.form-control:focus {
    box-shadow: none;
    border-bottom: 2px solid #ccc;
    background-color: transparent
}

.form-control2 {
    font-size: 14px;
    height: 20px;
    width: 55px;
    border: none;
    border-radius: 0;
    font-weight: 800;
    padding: 0 0 5px 0;
    background-color: transparent;
    box-shadow: none;
    outline: none;
    border-bottom: 2px solid #ccc;
    margin: 0
}

.form-control2:focus {
    box-shadow: none;
    border-bottom: 2px solid #ccc;
    background-color: transparent
}

.form-control3 {
    font-size: 14px;
    height: 20px;
    width: 30px;
    border: none;
    border-radius: 0;
    font-weight: 800;
    padding: 0 0 5px 0;
    background-color: transparent;
    box-shadow: none;
    outline: none;
    border-bottom: 2px solid #ccc;
    margin: 0
}

.form-control3:focus {
    box-shadow: none;
    border-bottom: 2px solid #ccc;
    background-color: transparent
}

p {
    margin: 0
}

img {
    width: 100%;
    height: 100%;
    object-fit: fill
}

.text-muted {
    font-size: 10px
}

.textmuted {
    color: #6c757d;
    font-size: 13px
}

.fs-14 {
    font-size: 14px
}

.btn.btn-primary {
    width: 100%;
    height: 55px;
    border-radius: 0;
    padding: 13px 0;
    background-color: black;
    border: none;
    font-weight: 600
}

.btn.btn-primary:hover .fas {
    transform: translateX(10px);
    transition: transform 0.5s ease
}

.fw-900 {
    font-weight: 900
}

::placeholder {
    font-size: 12px
}

.ps-30 {
    padding-left: 30px
}

.h4 {
    font-family: 'Work Sans', sans-serif !important;
    font-weight: 800 !important
}

.textmuted,
h5,
.text-muted {
    font-family: 'Poppins', sans-serif
}


        </style>
    </head>
    <body>
    <div class="container">
    <div class="row m-0">
    @foreach($courses as $course)
        <div class="col-lg-7 pb-5 pe-lg-5">
            <div class="row">
                
                <div class="col-12 p-5"> <img src="{{ $course->Image}}" alt=""> </div>
                <div class="row m-0 bg-light">
                    <div class="col-md-4 col-6 ps-30 pe-0 my-4">
                        <p class="text-muted">Category Name</p>
                        <p class="h5">{{ $course->name}}<span class="ps-1"></span></p>
                    </div>
                    <div class="col-md-4 col-6 ps-30 my-4">
                        <p class="text-muted">Course Name</p>
                        <p class="h5 m-0">{{ $course->title}}</p>
                    </div>
                    <div class="col-md-4 col-6 ps-30 my-4">
                        <p class="text-muted">Course Author</p>
                        <p class="h5 m-0">{{ $course->author}}</p>
                    </div>
                    <div class="col-md-4 col-6 ps-30 my-4">
                        <p class="text-muted">Course Fees</p>
                        <p class="h5 m-0">{{ $course->fee}} mmk</p>
                    </div>
                    <div class="col-md-4 col-6 ps-30 my-4">
                        <p class="text-muted">Course Duration</p>
                        <p class="h5 m-0">{{ $course->duration}}</p>
                    </div>
                    <div class="col-md-4 col-6 ps-30 my-4">
                        <p class="text-muted">Published Date</p>
                        <p class="h5 m-0">{{ $course->published_date}}</p>
                    </div>
                </div>
            </div>

        </div>
        <div class="col-lg-5 p-0 ps-lg-4">
            <div class="row m-0">
            <form action="/frontend/enroll/thein" method="post"  enctype="multipart/form-data">
                                @csrf

                    <input type="hidden" name="course_id" value="{{$course->id}}">
                    @endforeach
                <div class="col-12 px-4">
                    <div class="d-flex align-items-end mt-4 mb-2">
                        <p class="h4 m-0"><span class="pe-1">Online Learning</span></p>
                    </div>
                    <div class="d-flex justify-content-between mb-2">
                        <p class="textmuted">Price</p>
                        <input type="text"  name="amount" placeholder="Enter payable amount" required class="form-control">
                    </div>
                    <div class="d-flex justify-content-between mb-2">
                        <p class="textmuted">Screenshot</p>
                        <input type="file" class="form-control" name="image" required>
                    </div>
                    <div class="d-flex justify-content-between mb-3">
                        <p class="textmuted fw-bold">Total</p>
                        <div class="d-flex align-text-top "><span class="h4">{{ $course->fee}}- mmk</span> </div>
                    </div>
                </div>
                
                <div class="col-12 px-0">
                
                    <div class="row bg-light m-0">

                        <div class="col-12 px-4 my-4">
                            <p class="fw-bold">Payment detail</p>
                        </div>
                        
                        <div class="col-12 px-4">
                        
                            <div class="d-flex mb-4"> <span class="">
                                    <p class="text-muted">Card number</p> 
                                    
                                    <select name="payment_id" class="form-control"  id="">
                                    @foreach($payments as $pay)
                                        <option value="{{$pay->id}}">{{$pay->payment_number}}</option>
                                        @endforeach
                                    </select>
                                    
                                </span>
                                <div class=" w-100 d-flex flex-column align-items-end">
                                    <p class="text-muted">Bank Name</p> 
                                    
                                    <select class="form-control"  id="">
                                    @foreach($payments as $pay)
                                        <option value="">{{$pay->name}}</option>
                                        @endforeach
                                    </select>
                                    
                                </div>
                            </div>

                            <div class="d-flex mb-5"> <span class="me-5">
                                    <p class="text-muted">Username</p>
                                    <select class="form-control"  id="">
                                        @foreach($payments as $pay)
                                        <option value="">{{$pay->user_name}}</option>
                                        @endforeach
                                    </select>
                                </span>
                                
                            </div>
                            
                        </div>
                        
                        
                    </div>
                    
                    <div class="row m-0">
                        <div class="col-12 mb-4 p-0">
                            <button type="submit" class="btn btn-primary">Purchase<span class="fas fa-arrow-right ps-2"></span> </button>
                        </div>
                    </div>
                </div>
                </form>
            </div>
        </div>
    </div>
</div>


    </body>
</html>
