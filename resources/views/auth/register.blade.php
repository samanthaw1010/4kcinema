{{-- TRANG ĐĂNG KÝ TÀI KHOẢN MỚI --}}
<!doctype html>
<html lang="en">
<head>
   <!-- Required meta tags -->
   <meta charset="utf-8">
   <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
   <title>4K Cinema Register</title>
   <meta name="csrf-token" content="{{csrf_token()}}"/>
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
   <!-- Font Awesome -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
   <script src="https://kit.fontawesome.com/9eb8b4698c.js" crossorigin="anonymous"></script>
   <style>
      #submit:disabled{
         opacity:0.5;
      }
   </style>
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
               <div class=" align-self-center col-md-12 col-lg-7 form-padding">
                  <div class="sign-user_card ">                    
                     <div class="sign-in-page-data">
                        <div class="sign-in-from w-100 m-auto">
                           <h3 class="mb-3 text-center">ĐĂNG KÝ</h3>
                           @if(session('error'))
                              <div class="alert alert-error" style="color:rgb(220, 30, 1); justify-content:center;">
                              {{session('error')}}
                              </div>
                           @endif
                           <form class="row" method="POST" action="{{ route('register_post') }}">
                              @csrf

                              {{-- NHẬP TÊN --}}
                              <div class="form-group col-md-6">                                 
                                 <label for="inputUsername">Tên tài khoản</label>
                                 <input type="text" class="form-control mb-0 btn-border @error('name') is-invalid @enderror" id="user_name" name="name" value="{{ old('name') }}" placeholder="Nhập tên tài khoản" autocomplete="name" required autofocus onkeyup="validateName()"> 

                                 <p style="color:rgb(163, 36, 17)" id="result1"></p>    
                                 @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                 @enderror        
                              </div>

                              {{-- NHẬP EMAIL --}}
                              <div class="form-group col-md-6"> 
                                 {{-- <form action="{{ route('check_email') }}" method="POST">                                 --}}
                                 <label for="inputEmail">E-mail</label>                                 
                                 <input type="email" class="form-control mb-0 btn-border @error('email') is-invalid @enderror" id="user_email" name="email" value="{{ old('email') }}" placeholder="Nhập email" autocomplete="email" required onkeyup="validateEmail()"> 
                                 {{-- <button type="submit" style="font-size: 10px"><i class="fa-solid fa-question"></i></button>
                                 </form> --}}

                                 <p style="color:rgb(163, 36, 17)" id="result2"></p>
                                 @error('email')
                                    <span class="invalid-feedback" role="alert" id="email-error" style="display: none">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                 @enderror          
                              </div>

                              {{-- NHẬP PASSWORD --}}
                              <div class="form-group col-md-6">
                                 <label for="inputPassword">Mật khẩu</label>
                                 <input type="password" class="form-control mb-0 btn-border @error('password') is-invalid @enderror" id="user_password" name="password" placeholder="Nhập mật khẩu" autocomplete="new-password" required onkeyup="validatePassword()">
                                 
                                 <p style="color:rgb(163, 36, 17)" id="result3"></p>
                                 @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                 @enderror
                              </div>

                              {{-- NHẬP LẠI PASSWORD --}}
                              <div class="form-group col-md-6">
                                 <label for="repeatPassword">Nhập lại mật khẩu</label>
                                 <input type="password" class="form-control mb-0 btn-border" id="user_retype_password" name="password_confirmation" placeholder="Nhập lại mật khẩu" required autocomplete="new-password" onkeyup="validateRetypePassword()">
                                 
                                 <p style="color:rgb(163, 36, 17)" id="result4"></p>
                              </div>
                              {{-- BẤM ĐĂNG KÝ --}}
                              <button type="submit" class="btn btn-primary my-2" style="margin-left: 40%">ĐĂNG KÝ</button>
                           </form>           
                        </div>
                     </div>  
                     
                     {{-- ĐÃ CÓ TÀI KHOẢN? CHUYỂN ĐẾN TRANG ĐĂNG NHẬP --}}
                     <div class="mt-3">
                        <div class="d-flex justify-content-center links">
                           Đã có tài khoản? <a href="{{ route('login') }}" class="text-primary ml-2">Đăng nhập</a>
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
      <script src="{{asset('jsAdmin/countdown.min.js')}}"></script>
      <!-- Counterup JavaScript -->
      <script src="{{asset('jsAdmin/waypoints.min.js')}}"></script>
      <script src="{{asset('jsAdmin/jquery.counterup.min.js')}}"></script>
      <!-- Wow JavaScript -->
      <script src="{{asset('jsAdmin/wow.min.j')}}s"></script>
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

      {{-- VALIDATE NAME INPUT --}}
      {{-- Điều kiện: tên có ít nhất 2 ký tự và không chứa số hoặc ký tự đặc biệt --}}
      <script>
         function validateName() {
            var name = document.getElementById("user_name").value;
            var pattern = /^[a-zA-Z\s]+$/;
            var resultElement = document.getElementById("result1");
            
            if (name.length >= 2 && pattern.test(name)) {
            resultElement.innerHTML = "";
            } else {
            resultElement.innerHTML = "Tên cần ít nhất 2 ký tự và không chứa số, ký tự đặc biệt!";
            }
         }
      </script>

      {{-- VALIDATE EMAIL INPUT --}}
      {{-- Check theo pattern --}}
      <script>
         function validateEmail() {
            var email = document.getElementById("user_email").value;
            var pattern = /^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,})+$/;
            var resultElement = document.getElementById("result2");
            
            if (pattern.test(email)) {
            resultElement.innerHTML = "";
            } else {
            resultElement.innerHTML = "Email không hợp lệ!";
            }
         }
      </script>
      {{-- Gửi Ajax kiểm tra trùng Email --}}
      <script>
         function checkExistEmail() {
             const email = document.getElementById('user_email').value;
             const emailError = document.getElementById('email-error');
             const resultMessage = document.getElementById('result2');
     
             if (email.trim() === '') {
                 emailError.style.display = 'none';
                 resultMessage.innerText = '';
                 return;
             }
     
             fetch("{{ route('check_email') }}", {
                 method: 'POST',
                 headers: {
                     'X-CSRF-TOKEN': '{{ csrf_token() }}',
                     'Content-Type': 'application/json',
                     'Accept': 'application/json',
                 },
                 body: JSON.stringify({ email: email }),
             })
             .then(response => response.json())
             .then(data => {
                 if (data.exists) {
                     emailError.style.display = 'block';
                     emailError.innerHTML = '<strong>Email đã tồn tại trong hệ thống.</strong>';
                     resultMessage.innerText = '';
                 } else {
                     emailError.style.display = 'none';
                     resultMessage.innerText = 'Email có thể sử dụng.';
                 }
             });
         }
     </script>

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


