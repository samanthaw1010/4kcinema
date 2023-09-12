@extends('layout')
@section('content')
<!-- VIDEO ĐẦU TRANG -->
<div class="banner-movie">
   <div class="banner">
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
       <div class="movie">
         @if(isset($tagFirstVideo->trailer))
           <video width="100%" height="100%" src="{{asset('movie/'.$tagFirstVideo->trailer)}}" muted="false" autoplay="true" loop></video>
           <div class="container">
               <div class="movie-content">
                   <div class="movie-title">{{$tagFirstVideo->title}}</div>
                   <div class="movie-genre">
                     <a href="" class="genre">{{$tagFirstVideo->title_eng}}</a>
                     <a href="" class="genre">{{$tagFirstVideo->year}}</a>
                     <a href="" class="genre">{{$tagFirstVideo->duration}}</a>
                   </div>
                   <div class="movie-details">
                     {{$tagFirstVideo->description}}
                   </div>
                   <div class="button-movie">
                       <a href="{{route('movie',$tagFirstVideo->slug)}}" title="{{$tagFirstVideo->title}}" class="button">
                           <ion-icon name="play-outline"></ion-icon>
                           <span>Xem ngay</span>
                       </a>
                   </div>
               </div>
           </div>
           @endif
       </div>
   </div>
</div>
<div class="card-movie-category">
   <div class="container">
      <h3 class="section-title"><span>Phim theo từ khóa "{{$tag}}"</span></h3>
       <div class="card">
         @foreach($movie as $key => $mov)
           <div class="movie">
            <a style="color:#ffff" href="{{route('movie',$mov->slug)}}" title="{{$mov->title}}">
               <img
                   src={{asset('uploads/poster/'.$mov->poster)}}
                   alt={{$mov->title}}
                   title={{$mov->title}}
                   onclick="window.location.href='{{route('movie',$mov->slug)}}'"
               />
               <div class="rest-card">
                   <video src="{{asset('movie/'.$mov->trailer)}}" muted></video>
                   <div class="content">
                       <div class="sub" style="margin-top: -20px">
                           <p>{{$mov->year}}</p>
                           <p>{{$mov->title}}</p>
                           <p>
                              @if($mov->subtitle==1)
                                 Thuyết minh
                              @elseif($mov->subtitle==0)
                                 Vietsub
                              @endif
                           </p>
                           <p>
                              @if($mov->type==1)
                                 Phim lẻ
                              @elseif($mov->type==2)
                                 Phim bộ
                              @endif
                           </p>
                           <p>
                              @if($mov->resolution==0)
                                 720p
                              @elseif($mov->resolution==1)
                                 1080p
                              @elseif($mov->resolution==2)
                                 4K
                              @else
                                 Trailer
                              @endif
                           </p>
                       </div>
                   </div>
               </div>
           </div>
         @endforeach
      </div>
   </div>
</div>
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