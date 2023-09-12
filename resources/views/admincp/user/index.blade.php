{{-- TRANG ADMIN NÀY QUẢN LÝ TOÀN BỘ NGƯỜI DÙNG --}}

@extends('layouts.app')
@section('content')
<!-- THÊM NGƯỜI DÙNG MỚI  -->
<div id="content-page" class="content-page" >
    <!-- DANH SÁCH TẤT CẢ TÀI KHOẢN  -->
    <div class="container-fluid">
        <div class="row">
           <div class="col-sm-12">
              <div class="iq-card">
                 <div class="iq-card-header d-flex justify-content-between">
                    <div class="iq-header-title">
                       <h4 class="card-title">DANH SÁCH TÀI KHOẢN</h4>
                    </div>
                    <div class="iq-card-header-toolbar d-flex align-items-center">
                        <a href="{{route('manageUser.create')}}" class="btn btn-primary add-genre-btn">Thêm tài khoản</a>
                     </div>
                 </div>
                 <div class="iq-card-body">
                    <div class="table-view">
                       <table class="data-tables table movie_table " style="width:100%">
                          <thead>
                             <tr>
                                 <th scope="col">#</th>
                                 <th scope="col">Tên tài khoản</th>
                                 <th scope="col">EMAIL</th>
                                 {{-- <th scope="col">PASSWORD</th> --}}
                                 <th scope="col">Quyền</th>
                                 <th scope="col">Trạng thái</th>
                                 @if(Auth::check())
                                    @if(Auth::user()->role==0)
                                        <th scope="col">Quản lý</th>
                                    @endif                                 
                                 @endif
                             </tr>
                          </thead>
                          <tbody>
                             @foreach($list as $key => $cate)
                             <tr>
                                 <th scope="row">{{$key+1}}</th>
                                 <td>{{$cate->name}}</td>
                                 <td>{{$cate->email}}</td>
                                 <td>
                                     {{ $cate->role == 1 ? 'ADMIN' : 'USER' }}
                                 </td>
                                 <td>
                                    {{-- ẨN --}}
                                    @if($cate->status == 1)
                                    {!! Form::open([
                                        'method'=>'POST',
                                        'route'=>['inactive_user',$cate->id],
                                        'onsubmit'=>'return confirm("Bạn muốn khóa tài khoản này?")',
                                        'class'=>'d-inline-block'
                                        ]) !!}
                                        {!! Form::button('<i class="fa-solid fa-lock-open" style="color:#c1ecc0; font-size: 25px"></i>', ['type' => 'submit', 'class'=>'d-inline-block btn-icon']) !!}
                                        {!! Form::close() !!}
                                    @elseif($cate->status == 0)
                                        {!! Form::open([
                                        'method'=>'POST',
                                        'route'=>['active_user',$cate->id],
                                        'onsubmit'=>'return confirm("Bạn muốn mở khóa tài khoản này?")',
                                        'class'=>'d-inline-block'
                                    ]) !!}
                                    {!! Form::button('<i class="fa-solid fa-lock" style="color:#ffa8a3; font-size: 25px"></i>', ['type' => 'submit', 'class'=>'d-inline-block btn-icon']) !!}
                                    {!! Form::close() !!}
                                    @endif
                                   </td>
                                @if(Auth::check())
                                    @if(Auth::user()->role==0)
                                    <td>
                                    <div class="flex align-items-center list-user-action">
                                        {{-- CHỈNH SỬA --}}
                                        <a href="{{route('manageUser.edit', $cate->id)}}" class="d-inline-block"><i class="fa-solid fa-square-pen" style="color: #cfe7ed; font-size: 28px"></i></a>
                                    </div>
                                    </td>
                                    @endif
                                @endif
                             </tr>
                             @endforeach
                          </tbody>
                       </table>
                    </div>
                 </div>
              </div>
           </div>
        </div>
     </div>
@if(Auth::check())
    @if(Auth::user()->role==0)
    <div class="container-fluid" id="addGenre">
       <div class="row" >
          <div class="col-sm-12">
             <div class="iq-card">
                <div class="iq-card-header d-flex justify-content-between">
                   <div class="iq-header-title">
                      <h4 class="card-title" >CHỈNH SỬA TÀI KHOẢN</h4>
                   </div>
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
                        // Tự động ẩn thông báo sau 4 giây
                        setTimeout(function(){
                        document.getElementById('login-alert').style.display = 'none';
                        }, 4000);
                    </script>
                    @endif
                </div>
                <div class="iq-card-body">
                   <div class="row">
                      <div class="col-lg-12">
                        {!! Form::open(['route'=>['manageUser.update', $user->id], 'method'=>'PUT']) !!} 
                        <!--Tên-->
                        <div class=form-group>
                            {!! Form::label('name', 'Tên tài khoản', []) !!}
                            {!! Form::text(
                                'name', 
                                isset($user) ? $user->name : '',
                                [
                                    'class'=>'form-control', 
                                    'placeholder'=>'Input user name',
                                    'required' => 'required',
                                    'id' => 'userName',
                                    'onkeyup' => 'validateName()',
                                    'readonly'=>'readonly'
                                ]) 
                            !!}
                            <p style="color:rgb(163, 36, 17)" id="result1"></p>
                        </div>
                        <!--Email-->
                        <div class=form-group>
                            {!! Form::label('email', 'Email', []) !!}
                            {!! Form::text(
                                'email', 
                                isset($user) ? $user->email : '',
                                [
                                    'class'=>'form-control', 
                                    'placeholder'=>'Input email',
                                    'required' => 'required',
                                    'id' => 'userEmail',
                                    'onkeyup' => 'validateEmail()',
                                    'readonly'=>'readonly'
                                ]) 
                            !!}
                            <p style="color:rgb(163, 36, 17)" id="result2"></p>
                        </div>
                        <!--Quyền truy cập-->
                        <div class=form-group>
                            {!! Form::label('role', 'Quyền', []) !!}
                            @if(Auth::user()->role==0)
                                {!! Form::select('role', 
                                ['1' => 'ADMIN', '2' => 'USER'], 
                                isset($user) ? $user->role : '',
                                ['class' => 'form-control']
                                )!!}
                            @elseif(Auth::user()->role==1)
                                {!! Form::select('role', 
                                ['2' => 'USER'], 
                                isset($user) ? $user->role : '',
                                ['class' => 'form-control']
                                )!!}
                            @endif 
                        </div>
                        <!--Trạng thái-->
                        <div class=form-group>
                            {!! Form::label('status', 'Trạng thái', []) !!}
                            {!! Form::select('status',
                            ['1'=>'Hiển thị', '0'=>'Ẩn'],
                            isset($user) ? $user->status : 'Hiển thị',
                            ['class'=>'form-control']) !!}
                        </div>
                        
                        {!! Form::submit('Cập nhật', ['class'=>'btn btn-primary']) !!}
                        {!! Form::close() !!}
                      </div>
                   </div>
                </div>
             </div>
          </div>
       </div>
    </div>
    @endif
@endif
</div>

<style>
    /* Xóa background mặc định của button */
    .btn-icon {
    background-color: transparent;
    border: none;
    padding: 0; /* Xóa padding mặc định của button*/
    }
    th {
    text-align: center !important;
    }    
</style>

{{-- <script type="text/javascript">
    $(".add-genre-btn").click(function(e){
        e.preventDefault();
        var aid = $(this).attr("href");
        $('html, body').animate({scrollTop: $(aid).offset().top}, 'slow');
    });
</script> --}}
<script type='text/javascript' src='{{asset('js/bootstrap.min.js?ver=5.7.2')}}' id='bootstrap-js'></script>
<script type='text/javascript' src='{{asset('js/owl.carousel.min.js?ver=5.7.2')}}' id='carousel-js'></script>

<script type='text/javascript' src='{{asset('js/halimtheme-core.min.js?ver=1626273138')}}' id='halim-init-js'></script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
{{-- Hiển thị / Ẩn mật khẩu bằng dấu chấm tròn --}}
<script>
    function showPassword(button) {
        var passwordPlaceholder = button.parentNode.querySelector('.password-placeholder');
        var passwordOriginal = button.parentNode.querySelector('.password-original');
        var hideButton = button.parentNode.querySelector('.hide-password-btn');

        passwordPlaceholder.textContent = passwordOriginal.textContent;
        passwordPlaceholder.style.display = 'inline';
        passwordOriginal.style.display = 'none';

        button.style.display = 'none';
        hideButton.style.display = 'inline';
    }

    function hidePassword(button) {
        var passwordPlaceholder = button.parentNode.querySelector('.password-placeholder');
        var passwordOriginal = button.parentNode.querySelector('.password-original');
        var showButton = button.parentNode.querySelector('.show-password-btn');

        passwordPlaceholder.textContent = '*******';
        passwordPlaceholder.style.display = 'inline';
        passwordOriginal.style.display = 'none';

        button.style.display = 'none';
        showButton.style.display = 'inline';
    }
</script>
{{-- VALIDATE NAME INPUT --}}
{{-- Điều kiện: tên có ít nhất 2 ký tự và không chứa số hoặc ký tự đặc biệt --}}
<script>
    function validateName() {
        var name = document.getElementById("userName").value;
        var pattern = /^[a-zA-Z\s]+$/;
        var resultElement = document.getElementById("result1");
        
        if (name.length >= 2 && pattern.test(name) && name.value !="") {
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
        var email = document.getElementById("userEmail").value;
        var pattern = /^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,})+$/;
        var resultElement = document.getElementById("result2");
        
        if (pattern.test(email) && email.value !="") {
        resultElement.innerHTML = "";
        } else {
        resultElement.innerHTML = "Email không hợp lệ!";
        }
    }
</script>

{{-- VALIDATE PASSWORD INPUT --}}
{{-- Mật khẩu cần dài ít nhất 6 ký tự và có 1 ký tự in hoa --}}
<script>
    function validatePassword() {
    var password = document.getElementById("userPassword").value;
    var uppercaseRegex = /[A-Z]/;
    var resultElement = document.getElementById("result3");
    
    if (password.length >= 8 && uppercaseRegex.test(password)) {
        resultElement.innerHTML = "";
    } else {
        resultElement.innerHTML = "Mật khẩu cần từ 8 ký tự và có 1 ký tự hoa!";
    }
    }
</script>
@endsection