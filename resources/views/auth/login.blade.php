{{-- TRANG ĐĂNG NHẬP --}}
<!doctype html>
<html lang="en">
<head>
      <!-- Required meta tags -->
      <meta charset="utf-8">
      <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
      <title>4K Cinema Log in</title>
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
                           <h3 class="mb-3 text-center">ĐĂNG NHẬP</h3>
                           <form class="mt-4" method="POST" action="{{ route('log_in') }}">
                            @csrf
                            {{-- In ra thông báo --}}
                              @if(Session::has('success'))
                                 <div id="login-alert" class="alert alert-success" role="alert">
                                       {{Session::get('success')}}
                                 </div>
                              @elseif(Session::has('error'))
                                 <div id="login-alert" class="alert alert-primary" role="alert">
                                       {{Session::get('error')}}
                                 </div>
                                 <script>
                                       // Tự động ẩn thông báo sau 3 giây
                                       setTimeout(function(){
                                       document.getElementById('login-alert').style.display = 'none';
                                       }, 4000);
                                 </script>
                              @endif
                            {{-- NHẬP EMAIL --}}
                              <div class="form-group">                                 
                                 <input id="email" type="email" class="form-control mb-0 @error('email') is-invalid @enderror" autofocus placeholder="Nhập email" name="login_email" value="{{ old('email') }}" autocomplete="email" required>

                                 @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                 @enderror
                              </div>

                            {{-- NHẬP PASSWORD --}}
                              <div class="form-group">                                 
                                 <input id="password" type="password" class="form-control mb-0 @error('password') is-invalid @enderror" name="login_password" placeholder="Nhập mật khẩu" autocomplete="current-password" required>

                                 @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                 @enderror
                              </div>

                                 <div class="sign-info">
                                    {{-- BẤM ĐĂNG NHẬP --}}
                                    <button type="submit" class="btn btn-primary">ĐĂNG NHẬP</button>

                                    {{-- GHI NHỚ ĐĂNG NHẬP --}}
                                    <div class="custom-control custom-checkbox d-inline-block">
                                       <input type="checkbox" class="custom-control-input" id="customCheck" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                                       <label class="custom-control-label" for="customCheck">Ghi nhớ đăng nhập</label>
                                    </div> 

                                 </div>                                    
                           </form>
                        </div>
                     </div>
                     <div class="mt-3">
                        <div class="d-flex justify-content-center links">
                           Chưa có tài khoản? <a href="{{ route('register_get') }}" class="text-primary ml-2">Đăng ký</a>
                        </div>
                        <div class="d-flex justify-content-center links">
                            @if (Route::has('password.request'))
                                <a class="f-link" href="{{ route('password.request') }}">
                                    Quên mật khẩu?
                                </a>
                            @endif
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


