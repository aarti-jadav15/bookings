<!DOCTYPE HTML>
<html>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Booking system - Register</title>
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="" />
    <meta name="keywords" content="" />
    <meta name="author" content="" />
    <link rel="stylesheet" type="text/css" href="//fonts.googleapis.com/css?family=Roboto+Sans:400,700|Playfair+Display:400,700">
    <link rel="stylesheet" href="{{URL::to('assets/css/bootstrap.min.css')}}">
    <link rel="stylesheet" href="{{URL::to('assets/css/animate.css')}}">
    <link rel="stylesheet" href="{{URL::to('assets/css/owl.carousel.min.css')}}">
    <link rel="stylesheet" href="{{URL::to('assets/css/aos.css')}}">
    <link rel="stylesheet" href="{{URL::to('assets/css/bootstrap-datepicker.css')}}">
    <link rel="stylesheet" href="{{URL::to('assets/css/jquery.timepicker.css')}}">
    <link rel="stylesheet" href="{{URL::to('assets/css/fancybox.min.css')}}">
    <link rel="stylesheet" href="{{URL::to('assets/fonts/ionicons/css/ionicons.min.css')}}">
    <link rel="stylesheet" href="{{URL::to('assets/fonts/fontawesome/css/font-awesome.min.css')}}">
    <link rel="stylesheet" href="{{URL::to('assets/css/style.css')}}">
  </head>
  <body>

    <section class="section contact-section" id="next">
      <div class="container">
        <div class="row">
          <div class="col-md-2"></div>
          <div class="col-md-8" data-aos="fade-up" data-aos-delay="100">
            <form action="{{URL::to('registerstore')}}" method="post" class="bg-white p-md-5 p-4 mb-5 border">
                @csrf
                <h4 class="text-center mb-4">Registration Form</h4>
                
                <div class="row">
                  <div class="col-md-6 form-group">
                    <label for="name">First Name</label>
                    <input type="text" name="f_name" class="form-control @error('f_name') is-invalid @enderror" value="{{ old('f_name') }}">
                    @error('f_name')
                      <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                  </div>
                  <div class="col-md-6 form-group">
                    <label for="phone">Last Name</label>
                    <input type="text" name="l_name" class="form-control @error('l_name') is-invalid @enderror" value="{{ old('l_name') }}">
                    @error('l_name')
                      <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                  </div>
                </div>
          
                <div class="row">
                  <div class="col-md-6 form-group">
                    <label for="email">Email</label>
                    <input type="email" name="email" class="form-control @error('email') is-invalid @enderror" value="{{ old('email') }}">
                    @error('email')
                      <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                  </div>
                 
                  <div class="col-md-6 form-group">
                    <label for="password">Password</label>
                    <input type="password" name="password" class="form-control @error('password') is-invalid @enderror">
                    @error('password')
                      <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                  </div>
                </div>
                
                <div class="row">
                  <div class="col-md-12 form-group">
                      <a href="{{URL::to('loginform')}}" style="float:right;">Already have an Account? Click here</a>
                  </div>
                </div>

                <div class="row">
                  <div class="col-md-12 form-group">
                    <input type="submit" style="float:right;" value="Register" class="btn btn-primary text-white font-weight-bold">
                  </div>
                </div>
            </form>

          </div>
          <div class="col-md-2"></div>
        </div>
      </div>
    </section>
    
    <script src="{{URL::to('assets/js/jquery-3.3.1.min.js')}}"></script>
    <script src="{{URL::to('assets/js/jquery-migrate-3.0.1.min.js')}}"></script>
    <script src="{{URL::to('assets/js/popper.min.js')}}"></script>
    <script src="{{URL::to('assets/js/bootstrap.min.js')}}"></script>
    <script src="{{URL::to('assets/js/owl.carousel.min.js')}}"></script>
    <script src="{{URL::to('assets/js/jquery.stellar.min.js')}}"></script>
    <script src="{{URL::to('assets/js/jquery.fancybox.min.js')}}"></script>
    <script src="{{URL::to('assets/js/aos.js')}}"></script>
    <script src="{{URL::to('assets/js/bootstrap-datepicker.js')}}"></script> 
    <script src="{{URL::to('assets/js/jquery.timepicker.min.js')}}"></script> 
    <script src="{{URL::to('assets/js/main.js')}}"></script>
  </body>
</html>
