<!DOCTYPE HTML>
<html>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Booking System - Dashboard</title>
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="" />
    <meta name="keywords" content="" />
    <meta name="author" content="" />
    <link rel="stylesheet" type="text/css" href="//fonts.googleapis.com/css?family=|Roboto+Sans:400,700|Playfair+Display:400,700">

    <link rel="stylesheet" href="{{URL::to('assets/css/bootstrap.min.css')}}">
    <link rel="stylesheet" href="{{URL::to('assets/css/animate.css')}}">
    <link rel="stylesheet" href="{{URL::to('assets/css/owl.carousel.min.css')}}">
    <link rel="stylesheet" href="{{URL::to('assets/css/aos.css')}}">
    <link rel="stylesheet" href="{{URL::to('assets/css/bootstrap-datepicker.css')}}">
    <link rel="stylesheet" href="{{URL::to('assets/css/jquery.timepicker.css')}}">
    <link rel="stylesheet" href="{{URL::to('assets/css/fancybox.min.css')}}">
    
    <link rel="stylesheet" href="{{URL::to('assets/fonts/ionicons/css/ionicons.min.css')}}">
    <link rel="stylesheet" href="{{URL::to('assets/fonts/fontawesome/css/font-awesome.min.css')}}">

    <!-- Theme Style -->
    <link rel="stylesheet" href="{{URL::to('assets/css/style.css')}}">
  </head>
  <body>
    
   
  <section class="site-hero overlay" style="background-image: url(images/hero_4.jpg)" data-stellar-background-ratio="0.5">
  <div class="container position-relative">
    <!-- Logout Button (Top-Left Corner) -->
    <div class="position-absolute top-0 start-0 mt-3 ms-3">
      <form action="{{ route('logout') }}" method="POST">
        @csrf
        <button type="submit" class="btn btn-danger">Logout</button>
      </form>
    </div>

  </div>
</section>

    <section class="section bg-light pb-0"  style="background-image: url(images/hero_4.jpg)">
      <div class="container">
        
        <div class="row check-availabilty" id="next">
          <div class="block-32" data-aos="fade-up" data-aos-offset="-200">
          @if(session('error'))
            <div class="alert alert-danger">{{ session('error') }}</div>
        @endif

        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif
            <form action="{{URL::to('store_bookings')}}" method="post">
                @csrf
                <h4 class="text-center">Booking Form</h4>
                <div class="row">
                    <div class="col-md-4 mb-3 mb-lg-0 col-lg-4">
                        <label for="checkin_date" class="font-weight-bold text-black">Customer Name</label>
                        <div class="field-icon-wrap">
                            <input type="text" name="customer_name" class="form-control">
                        </div>
                    </div>
                    <div class="col-md-4 mb-3 mb-lg-0 col-lg-4">
                        <label for="checkout_date" class="font-weight-bold text-black">Customer Email</label>
                        <div class="field-icon-wrap">
                            <input type="text" name="customer_email" class="form-control">
                        </div>
                    </div>
                    <div class="col-md-4 mb-3 mb-lg-0 col-lg-4">
                        <label for="checkout_date" class="font-weight-bold text-black">Booking Date</label>
                        <div class="field-icon-wrap">
                            <input type="date" name="booking_date" class="form-control">
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12 mb-3 mb-md-0 col-lg-12">
                      <label for="adults" class="font-weight-bold text-black">Booking Type</label>
                      <div class="field-icon-wrap">
                            <div class="icon"><span class="ion-ios-arrow-down"></span></div>
                            <select name="booking_type" id="booking_type" class="form-control">
                            <option value="">Select Booking Type</option>
                            <option value="full_day">Full Day</option>
                            <option value="half_day">Half Day</option>
                            <option value="custom">custom</option>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="row" id="booking_slot_row" style="display: none;">
                    <div class="col-md-12 mb-3 mb-md-0 col-lg-12">
                      <label for="adults" class="font-weight-bold text-black">Booking Slot</label>
                      <div class="field-icon-wrap">
                            <div class="icon"><span class="ion-ios-arrow-down"></span></div>
                            <select name="booking_slot" id="booking_slot" class="form-control">
                            <option value="">Select Booking Slots</option>
                            <option value="first_half">First Half</option>
                            <option value="second_half">Second Half</option>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="row" id="booking_time_row" style="display: none;">
                    <div class="col-md-6 mb-3 mb-md-0 col-lg-6">
                        <label for="adults" class="font-weight-bold text-black">Booking From Time</label>
                        <div class="field-icon-wrap">
                            <input type="time" name="booking_from_time" class="form-control">
                        </div>
                    </div>
                    <div class="col-md-6 mb-3 mb-md-0 col-lg-6">
                        <label for="adults" class="font-weight-bold text-black">Booking To Time</label>
                        <div class="field-icon-wrap">
                            <input type="time" name="booking_to_time" class="form-control">
                        </div>
                    </div>
                </div>
                <div class="row mt-5" >
                    <div class="col-md-12 mb-3 mb-md-0 col-lg-12">
                    <input type="submit" value="Book Now" style="float:right;" class="btn btn-primary text-white font-weight-bold">
                    </div>
                </div>
              </div>
            </form>
          </div>
        </div>
      </div>
    </section>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function () {
            $('#booking_type').change(function () {
                if ($(this).val() === 'half_day') {
                    $('#booking_slot_row').show(); // Show the slot dropdown
                }else if ($(this).val() === 'custom') {
                    $('#booking_time_row').show(); // Show the slot dropdown
                    $('#booking_slot_row').hide();
                } else {
                    $('#booking_slot_row').hide();
                    $('#booking_time_row').hide(); // Hide it if another option is selected
                }
            });
        });
    </script>
    
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