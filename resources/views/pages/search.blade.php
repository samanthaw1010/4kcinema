@extends('layout')
@section('content')
<!-- VIDEO ĐẦU TRANG -->
<div class="banner-movie">
   <div class="banner">
      @if(session('success'))
         <div class="alert alert-success">
         {{session('success')}}
         </div>
      @elseif(session('error'))
         <div class="alert alert-error">
         {{session('error')}}
         </div>
      @endif 
       <div class="movie">
         @if(isset($searchFirstVideo->trailer))
           <video width="100%" height="100%" src="{{asset('movie/'.$searchFirstVideo->trailer)}}" muted="false" autoplay="true" loop></video>
           <div class="container">
               <div class="movie-content">
                   <div class="movie-title">{{$searchFirstVideo->title}}</div>
                   <div class="movie-genre">
                     <a href="" class="genre">{{$searchFirstVideo->title_eng}}</a>
                     <a href="" class="genre">{{$searchFirstVideo->year}}</a>
                     <a href="" class="genre">{{$searchFirstVideo->duration}}</a>
                   </div>
                   <div class="movie-details">
                     {{$searchFirstVideo->description}}
                   </div>
                   <div class="button-movie">
                       <a href="{{route('movie',$searchFirstVideo->slug)}}" title="{{$searchFirstVideo->title}}" class="button">
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
      <h3 class="section-title"><span>Kết quả tìm kiếm với từ khóa: "{{$search}}"</span></h3>
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