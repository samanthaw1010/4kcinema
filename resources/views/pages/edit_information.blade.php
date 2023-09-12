{{-- TRANG USER INFORMATION CỦA WEBSITE XEM PHIM --}}

@extends('layout')
@section('content')
<!-- Required meta tags -->
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
<title>4K Cinema Edit Information</title>
<!-- Favicon -->
<link rel="shortcut icon" href="{{ asset('imgs/img-logo/logo-mini.png') }}" />
<!-- Bootstrap CSS -->
<link rel="stylesheet" href="{{asset('cssAdmin/bootstrap.min.css')}}">
<!-- Typography CSS -->
<link rel="stylesheet" href="{{asset('cssAdmin/typography.css')}}">
<!-- Style CSS -->
<link rel="stylesheet" href="{{asset('cssAdmin/style.css')}}">
<!-- Responsive CSS -->
<link rel="stylesheet" href="{{asset('cssAdmin/responsive.css')}}">
<!-- SETTING -->
<div class="setting-account">
    <div class="container">
        <div class="col-lg-12">
            <div class="iq-card">
            <div class="iq-card-header d-flex justify-content-between">
                <div class="iq-header-title">
                    <h4 class="card-title">Thay Đổi Thông Tin</h4>
                </div>
            </div>
            <div class="iq-card-body">
                <div class="acc-edit">
                    <form action="{{ route('update_information', ['id' => $user->id]) }}" method="POST">
                        @csrf
                        <div class="form-group">
                            <label for="uname">Tên tài khoản:</label>
                            <input type="text" class="form-control" id="edit_name" name="edit_name" placeholder="{{$user->name}}" value="{{$user->name}}">
                        </div>
                        <div class="form-group">
                            <label for="email">Email:</label>
                            <input type="email" class="form-control" id="edit_email" name="edit_email" placeholder="{{$user->email}}" value="{{$user->email}}">
                        </div>
                        
                        <button type="submit" class="btn btn-primary">Gửi yêu cầu</button>
                        
                    </form>
                    <a href="{{route('back')}}"><button style="margin-left:100px; margin-top: -63px" class="btn iq-bg-danger">Hủy thay đổi</button></a>
                </div>
            </div>
            </div>
        </div>        
    </div>
</div>
<!-- SETTING --end -->
{{-- VALIDATE NAME INPUT --}}
{{-- Điều kiện: tên có ít nhất 2 ký tự và không chứa số hoặc ký tự đặc biệt --}}
<script>
    function validateName() {
        var name = document.getElementById("edit_name").value;
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
        var email = document.getElementById("edit_email").value;
        var pattern = /^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,})+$/;
        var resultElement = document.getElementById("result2");
        
        if (pattern.test(email) && email.value !="") {
        resultElement.innerHTML = "";
        } else {
        resultElement.innerHTML = "Email không hợp lệ!";
        }
    }
</script>

<script>
    $(document).ready(function() {
    $("#cancelPackageBtn").click(function() {
        $.ajax({
            url: "/cancel-package",
            type: "POST",
            data: {
                user: {{$user->id}}
            },
            success: function(response) {
                if (response.success) {
                    alert("Thay đổi thành công");
                } else {
                    alert("Không thể thực hiện yêu cầu. Vui lòng thử lại sau.");
                }
            },
            error: function() {
                alert("Đã xảy ra lỗi. Vui lòng thử lại sau.");
            }
        });
    });
});

</script>
<!-- jQuery first, then Popper.js, then Bootstrap JS -->
<script src="{{asset('jsAdmin/jquery.min.js')}}"></script>
<script src="{{asset('jsAdmin/popper.min.js')}}"></script>
<script src="{{asset('jsAdmin/bootstrap.min.j')}}s"></script>
<!-- Appear JavaScript -->
<script src="{{asset('jsAdmin/jquery.appear.js')}}"></script>
<!-- Countdown JavaScript -->
<script src="{{asset('jsAdmin/countdown.min.js')}}"></script>
<!-- Counterup JavaScript -->
<script src="{{asset('jsAdmin/waypoints.min.js')}}"></script>
<script src="{{asset('jsAdmin/jquery.counterup.min.js')}}"></script>
<!-- Wow JavaScript -->
<script src="{{asset('jsAdmin/wow.min.js')}}"></script>
<!-- Slick JavaScript -->
<script src="{{asset('jsAdmin/slick.min.js')}}"></script>
<!-- Owl Carousel JavaScript -->
<script src="{{asset('jsAdmin/owl.carousel.min.j')}}s"></script>
<!-- Magnific Popup JavaScript -->
<script src="{{asset('jsAdmin/jquery.magnific-popup.min.js')}}"></script>
<!-- Smooth Scrollbar JavaScript -->
<script src="{{asset('jsAdmin/smooth-scrollbar.js')}}"></script>
<!-- Chart Custom JavaScript -->
<script src="{{asset('jsAdmin/chart-custom.js')}}"></script>
<!-- Custom JavaScript -->
<script src="{{asset('jsAdmin/custom.js')}}"></script>
<script src="{{asset('jsAdmin/rtl.js')}}"></script>
@if(Auth::check())
    @if($user->package_id != 1)
        {{-- Chat Tawk.to --}}
        <script type="text/javascript">
            var Tawk_API=Tawk_API||{}, Tawk_LoadStart=new Date();
            (function(){
            var s1=document.createElement("script"),s0=document.getElementsByTagName("script")[0];
            s1.async=true;
            s1.src='https://embed.tawk.to/64b14ab894cf5d49dc63936a/1h5a8noec';
            s1.charset='UTF-8';
            s1.setAttribute('crossorigin','*');
            s0.parentNode.insertBefore(s1,s0);
            })();
        </script>
    @endif
@endif
@endsection