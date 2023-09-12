{{-- TRANG ADMIN NÀY QUẢN LÝ TOÀN BỘ NGƯỜI DÙNG --}}

@extends('layouts.app')
@section('content')
<!-- THÊM NGƯỜI DÙNG MỚI  -->
<div id="content-page" class="content-page" >
    <div class="container-fluid" id="addGenre">
       <div class="row" >
          <div class="col-sm-12">
             <div class="iq-card">
                <div class="iq-card-header d-flex justify-content-between">
                   <div class="iq-header-title">
                      <h4 class="card-title" >THÊM TÀI KHOẢN MỚI</h4>
                   </div>
                   <div class="iq-card-header-toolbar d-flex align-items-center">
                    <a href="{{route('manageUser.index')}}" class="btn btn-primary add-genre-btn">Danh sách tài khoản</a>
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
                        {!! Form::open(['route'=>'manageUser.store', 'method'=>'POST']) !!}
                        <!--Tên-->
                        <div class=form-group>
                            {!! Form::label('name', 'Tên tài khoản', []) !!}
                            {!! Form::text(
                                'name', 
                                '',
                                [
                                    'class'=>'form-control', 
                                    'placeholder'=>'Nhập tên tài khoản',
                                    'required' => 'required',
                                    'id' => 'userName',
                                    'autofocus' => 'autofocus',
                                    'onkeyup' => 'validateName()'
                                ]) 
                            !!}
                            <p style="color:rgb(163, 36, 17)" id="result1"></p>
                        </div>
                        <!--Email-->
                        <div class=form-group>
                            {!! Form::label('email', 'Email', []) !!}
                            {!! Form::text(
                                'email', 
                                '',
                                [
                                    'class'=>'form-control', 
                                    'placeholder'=>'Nhập email',
                                    'required' => 'required',
                                    'id' => 'userEmail',
                                    'onkeyup' => 'validateEmail()'
                                ]) 
                            !!}
                            <p style="color:rgb(163, 36, 17)" id="result2"></p>
                        </div>
                        <!--Mật khẩu-->
                        <div class="form-group password-toggle">
                            {!! Form::label('password', 'Mật khẩu', []) !!}
                            {!! Form::password('password', 
                                [
                                    'class' => 'form-control', 
                                    'placeholder' => 'Nhập mật khẩu', 
                                    'id' => 'userPassword',
                                    'required' => 'required',
                                    'onkeyup' => 'validatePassword()'
                                ]) 
                            !!}
                            <p style="color:rgb(163, 36, 17)" id="result3"></p>
                        </div>
                        <!--Quyền truy cập-->
                        <div class=form-group>
                            {!! Form::label('role', 'Quyền truy cập', []) !!}
                            @if(Auth::user()->role==0)
                                {!! Form::select('role', 
                                ['1' => 'AGENT', '2' => 'USER'], 
                                '',
                                ['class' => 'form-control']
                                )!!}
                            @elseif(Auth::user()->role==1)
                                {!! Form::select('role', 
                                ['2' => 'USER'], 
                                '',
                                ['class' => 'form-control']
                                )!!}
                            @endif
                        </div>
                        <!--Trạng thái-->
                        <div class=form-group>
                            {!! Form::label('status', 'Trạng thái', []) !!}
                            {!! Form::select('status',
                            ['1'=>'Hiển thị', '0'=>'Ẩn'],
                            'Hiển thị',
                            ['class'=>'form-control']) !!}
                        </div>
                        
                        {!! Form::submit('Thêm mới', ['class'=>'btn btn-primary']) !!}
                        {!! Form::close() !!}
                      </div>
                   </div>
                </div>
             </div>
          </div>
       </div>
    </div>
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

{{-- VALIDATE NAME INPUT --}}
{{-- Điều kiện: tên có ít nhất 2 ký tự và không chứa số hoặc ký tự đặc biệt --}}
<script>
    function validateName() {
        var name = document.getElementById("userName").value;
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
        var email = document.getElementById("userEmail").value;
        var pattern = /^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,})+$/;
        var resultElement = document.getElementById("result2");
        
        if (pattern.test(email)) {
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
        resultElement.innerHTML = "Mật khẩu cần từ 8 ký tự và có 1 ký tự in hoa!";
    }
    }
</script>

@endsection