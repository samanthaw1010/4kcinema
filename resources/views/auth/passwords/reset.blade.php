{{-- TRANG RESET PASSWORD --}}
<!doctype html>
<html lang="en">
<head>
      <!-- Required meta tags -->
      <meta charset="utf-8">
      <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
      <title>4K Cinema Reset Password</title>
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
                           <form class="mt-4" method="POST" action="{{ route('password_reset') }}">
                            @csrf
                            <input type="hidden" name="token" value="{{ $token }}">
                            {{-- IN RA THÔNG BÁO --}}
                            @if (session('status'))
                                <div class="alert alert-success" role="alert">
                                    {{ session('status') }}
                                </div>
                            @endif
                            
                            {{-- NHẬP EMAIL --}}
                              <div class="form-group">                                
                                 <input id="user_email" type="email" class="form-control mb-0 @error('email') is-invalid @enderror" readonly name="reset_email" value="{{ $email ?? old('email') }}" autocomplete="email">

                                 @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                 @enderror
                              </div>

                            {{-- NHẬP PASSWORD --}}
                              <div class="form-group">
                                <label for="inputPassword">Mật khẩu mới</label>
                                <input type="password" class="form-control mb-0 btn-border @error('password') is-invalid @enderror" id="user_password" name="reset_password" placeholder="Nhập mật khẩu mới" autocomplete="new-password" required onkeyup="validatePassword()">
                                
                                <p style="color:rgb(163, 36, 17)" id="result3"></p>
                                @error('password')
                                   <span class="invalid-feedback" role="alert">
                                       <strong>{{ $message }}</strong>
                                   </span>
                                @enderror
                             </div>

                            {{-- NHẬP LẠI PASSWORD --}}
                             <div class="form-group">
                                <label for="repeatPassword">Nhập lại mật khẩu</label>
                                <input type="password" class="form-control mb-0 btn-border" id="user_retype_password" name="password_confirmation" placeholder="Nhập lại mật khẩu" required autocomplete="new-password" onkeyup="validateRetypePassword()">
                                
                                <p style="color:rgb(163, 36, 17)" id="result4"></p>
                             </div>
                                <div class="sign-info">
                                    {{-- BẤM ĐỂ RESET PASSWORD MỚI --}}
                                    <button type="submit" class="btn btn-primary" style="margin-left: 25%">ĐỔI MẬT KHẨU</button>
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

    {{-- VALIDATE PASSWORD INPUT --}}
      {{-- Mật khẩu cần dài ít nhất 6 ký tự và có 1 ký tự in hoa --}}
      <script>
        function validatePassword() {
        var password = document.getElementById("user_password").value;
        var uppercaseRegex = /[A-Z]/;
        var resultElement = document.getElementById("result3");
        
        if (password.length >= 8 && uppercaseRegex.test(password)) {
           resultElement.innerHTML = "";
        } else {
           resultElement.innerHTML = "Mật khẩu cần từ 8 ký tự và có 1 ký tự in hoa!";
        }
        }
     </script>

     {{-- VALIDATE RETYPE PASSWORD --}}
     {{-- Mật khẩu nhập lại cần phải giống như mật khẩu ban đầu --}}
     <script>
        function validateRetypePassword() {
        var password = document.getElementById("user_password").value;
        var retypePassword = document.getElementById("user_retype_password").value;
        var passwordMatchElement = document.getElementById("result4");
        
        if (password === retypePassword) {
           passwordMatchElement.innerHTML = "";
        } else {
           passwordMatchElement.innerHTML = "Mật khẩu không khớp!";
        }
        }
     </script>
   </body>
</html>