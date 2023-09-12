{{-- TRANG HOMEPAGE CỦA WEBSITE XEM PHIM --}}

@extends('layout')
@section('content')
<!-- Required meta tags -->
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
<title>4K Cinema Notifications</title>
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
<!-- Page Content  -->

<div class="container-fluid" style="margin-top:100px;">
    <div class="row">
        @foreach($notification as $key => $note)
        @php
            $bgColors = ['bg-1', 'bg-2', 'bg-3', 'bg-4', 'bg-5', 'bg-6', 'bg-7', 'bg-8', 'bg-9', 'bg-10'];
            $randomColor = $bgColors[array_rand($bgColors)];
        @endphp
            <div class="col-lg-12">
                <div class="iq-card iq-card-block iq-card-stretch iq-card-height iq-mb-3 {{$randomColor}}">                
                    <div class="row no-gutters">
                        @if(isset($note->image_notification))
                        <div class="col-md-4">
                        <img height="200px" src="{{asset('uploads/notification/'.$note->image_notification)}}" class="card-img" alt="{{$note->title}}">
                        </div>
                        @endif
                        <div class="col-md-8">
                        <div class="iq-card-body">
                            <h4 class="card-title">{{$note->title}}</h4>
                            <p class="card-text">{{$note->content}}</p>
                            <p class="card-text"><small class="text-muted">Last updated: {{$note->updated_at}}</small></p>
                        </div>
                        </div>
                    </div>                
                </div>
            </div>
            @if($randomColor == 'bg-1')
                <style>
                    .bg-1 {
                        background-color: rgb(49, 21, 21);
                    }
                </style>
            @endif
            @if($randomColor == 'bg-2')
                <style>
                    .bg-2 {
                        background-color: rgb(41, 30, 8);
                    }
                </style>
            @endif
            @if($randomColor == 'bg-3')
                <style>
                    .bg-3 {
                        background-color: rgb(29, 37, 14);
                    }
                </style>
            @endif
            @if($randomColor == 'bg-4')
                <style>
                    .bg-4 {
                        background-color: rgb(7, 31, 34);
                    }
                </style>
            @endif
            @if($randomColor == 'bg-5')
                <style>
                    .bg-5 {
                        background-color: rgb(4, 33, 32);
                    }
                </style>
            @endif
            @if($randomColor == 'bg-6')
                <style>
                    .bg-6 {
                        background-color: rgb(21, 18, 22);
                    }
                </style>
            @endif
            @if($randomColor == 'bg-7')
                <style>
                    .bg-7 {
                        background-color: rgb(23, 16, 22);
                    }
                </style>
            @endif
            @if($randomColor == 'bg-8')
                <style>
                    .bg-8 {
                        background-color: rgb(34, 23, 24);
                    }
                </style>
            @endif
            @if($randomColor == 'bg-9')
                <style>
                    .bg-9 {
                        background-color: rgb(27, 19, 15);
                    }
                </style>
            @endif
            @if($randomColor == 'bg-10')
                <style>
                    .bg-10 {
                        background-color: rgb(20, 17, 21);
                    }
                </style>
            @endif 
        @endforeach
        <div style="padding:150px"></div>
    </div>
</div>
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