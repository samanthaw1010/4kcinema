{{-- TRANG NHẬP EMAIL VÀO ĐỂ BẤM GỬI LINK RESET PASSWORD --}}
<!doctype html>
<html lang="en">
<head>
      <!-- Required meta tags -->
      <meta charset="utf-8">
      <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
      <title>4K Cinema Password Request Link</title>
      <!-- Favicon -->
      <link rel="shortcut icon" href="{{asset('imgs/img-logo/logo-mini.png')}}" />
      <!-- Bootstrap CSS -->
      <link rel="stylesheet" href="{{asset('cssAdmin/bootstrap.min.css')}}">
      <!-- Typography CSS -->
      <link rel="stylesheet" href="{{asset('cssAdmin/typography.css')}}">
      <!-- Style CSS -->
      <link rel="stylesheet" href="{{asset('cssAdmin/style.css')}}">
      <!-- Responsive CSS -->
      <link rel="stylesheet" href="{{asset('cssAdmin/responsive.css')}}">
   </head>
   <body>
      <!-- loader Start -->
      <div id="loading">
         <div id="loading-center">
         </div>
      </div>
      <!-- loader END -->
        <!-- Sign in Start -->
        <section class="sign-in-page">
          <div class="container">
            <div class="row justify-content-center align-items-center height-self-center">
               <div class="col-lg-5 col-md-12 align-self-center form-padding">
                  <div class="sign-user_card ">                    
                     <div class="sign-in-page-data">
                        <div class="sign-in-from w-100 m-auto">
                           <h3 class="mb-3 text-center">THAY ĐỔI MẬT KHẨU</h3>
                           <form class="mt-4" method="POST" action="{{ route('password.email') }}">
                            @csrf
                            {{-- IN RA THÔNG BÁO --}}
                            @if (session('status'))
                                <div class="alert alert-success" role="alert">
                                    {{ session('status') }}
                                </div>
                            @endif
                            
                            {{-- NHẬP EMAIL --}}
                              <div class="form-group">  
                                 <label for="resetPassword">Chúng tôi sẽ gửi link đổi mật khẩu qua email của bạn</label>                               
                                 <input id="email" type="email" class="form-control mb-0 @error('email') is-invalid @enderror" autofocus placeholder="Nhập email" name="email" value="{{ old('email') }}" autocomplete="email" required>

                                 @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                 @enderror
                              </div>

                                <div class="sign-info">
                                    {{-- BẤM GỬI LINK --}}
                                    <button type="submit" class="btn btn-primary" style="margin-left: 18%">Gửi Link Qua Email</button>
                                </div>                                    
                           </form>

                        </div>
                     </div>
                  </div>
               </div>
            </div>
            <!-- Sign in END -->
            <!-- color-customizer -->
         </div>
      </section>
        <!-- Sign in END -->
    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="{{asset('jsAdmin/jquery.min.js')}}"></script>
    <script src="{{asset('jsAdmin/popper.min.js')}}"></script>
    <script src="{{asset('jsAdmin/bootstrap.min.js')}}"></script>
    <!-- Appear JavaScript -->
    <script src="{{asset('jsAdmin/jquery.appear.js')}}"></script>
    <!-- Countdown JavaScript -->
    <script src="{{asset('jsAdmin/countdown.min.j')}}s"></script>
    <!-- Counterup JavaScript -->
    <script src="{{asset('jsAdmin/waypoints.min.js')}}"></script>
    <script src="{{asset('jsAdmin/jquery.counterup.min.js')}}"></script>
    <!-- Wow JavaScript -->
    <script src="{{asset('jsAdmin/wow.min.js')}}"></script>
    <!-- Slick JavaScript -->
    <script src="{{asset('jsAdmin/slick.min.js')}}"></script>
    <!-- Owl Carousel JavaScript -->
    <script src="{{asset('jsAdmin/owl.carousel.min.js')}}"></script>
    <!-- Magnific Popup JavaScript -->
    <script src="{{asset('jsAdmin/jquery.magnific-popup.min.js')}}"></script>
    <!-- Smooth Scrollbar JavaScript -->
    <script src="{{asset('jsAdmin/smooth-scrollbar.js')}}"></script>
    <!-- Chart Custom JavaScript -->
    <script src="{{asset('jsAdmin/chart-custom.js')}}"></script>
    <!-- Custom JavaScript -->
    <script src="{{asset('jsAdmin/custom.js')}}"></script>
    <script src="{{asset('jsAdmin/rtl.js')}}"></script>
   </body>
</html>

