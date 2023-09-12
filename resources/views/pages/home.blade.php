{{-- TRANG HOMEPAGE CỦA WEBSITE XEM PHIM --}}

@extends('layout')
@section('content')

<!-- VIDEO ĐẦU TRANG -->
<div class="banner-movie">
    <div class="banner">
        <div class="movie">
            <video width="100%" height="100%" src="{{asset('movie/'. $homeFirstVideo->trailer)}}" muted="false" autoplay="true" loop poster="{{ asset('uploads/poster/'.$homeFirstVideo->poster) }}"></video>
            <div class="container">
                <div class="movie-content">
                    <div class="movie-title">{{$homeFirstVideo->title}}</div>
                    <div class="movie-genre">
                        <a href="" class="genre">{{$homeFirstVideo->title_eng}}</a>
                        <a href="" class="genre">{{$homeFirstVideo->year}}</a>
                        <a href="" class="genre">{{$homeFirstVideo->duration}} phút</a>
                    </div>
                    <div class="movie-details">
                        {{$homeFirstVideo->description}}
                    </div>
                    <div class="button-movie">
                        <a href="{{route('movie',$homeFirstVideo->slug)}}" title="{{$homeFirstVideo->title}}" class="button">
                            <ion-icon name="play-outline"></ion-icon>
                            <span>Xem ngay</span>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- SLIDE PHIM THỊNH HÀNH -->
<div class="card-movie">
    <div class="container">
        <h4>THỊNH HÀNH</h4>       
        <div class="card swiper-wrapper">
            @foreach($hot10Movie as $key => $mov)
            <div class="movie swiper-slide">
                <a style="color:#ffff" href="{{route('movie',$mov->slug)}}" title="{{$mov->title}}">
                <img
                    src={{asset('uploads/poster/'.$mov->poster)}}
                    alt={{$mov->title}}
                    onclick="window.location.href='{{route('movie',$mov->slug)}}'"
                />
                <div class="rest-card">
                    <video src={{asset('movie/'.$mov->trailer)}} muted></video>
                    <div class="content">
                        <div class="sub" style="margin-top: -20px;">
                            <p>{{$mov->year}}</p>
                            <p>{{$mov->title}}</p>
                            <p>
                                @if($mov->subtitle==1)
                                    Thuyết Minh
                                @elseif($mov->subtitle==0)
                                    Vietsub
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
            </a>
        </div>
        @endforeach
        </div>
        <div class="swiper-button-next"></div>
        <div class="swiper-button-prev"></div>
    </div>
</div>
<!-- SLIDE PHIM HÀN QUỐC -->
<div class="card-movie">
    <div class="container">
        <h4>PHIM HÀN QUỐC MỚI NHẤT</h4>
        <div class="card swiper-wrapper">
            @foreach($korean_movie as $key => $mov)
            <div class="movie swiper-slide">
                <a style="color:#ffff" href="{{route('movie',$mov->slug)}}" title="{{$mov->title}}">
                <img
                    src={{asset('uploads/poster/'.$mov->poster)}}
                    alt={{$mov->title}}
                    onclick="window.location.href='{{route('movie',$mov->slug)}}'"
                />
                <div class="rest-card">
                    <video src={{asset('movie/'.$mov->trailer)}} muted></video>
                    <div class="content">
                        <div class="sub" style="margin-top: -20px;">
                            <p>{{$mov->year}}</p>
                            <p>{{$mov->title}}</p>
                            <p>
                                @if($mov->subtitle==1)
                                    Thuyết Minh
                                @elseif($mov->subtitle==0)
                                    Vietsub
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
            </a>
        </div>
        @endforeach
        </div>
        <div class="swiper-button-next"></div>
        <div class="swiper-button-prev"></div>
    </div>
</div>

<!-- SLIDE PHIM ÂU MỸ -->
<div class="card-movie">
    <div class="container">
        <h4>PHIM ÂU MỸ MỚI NHẤT</h4>
        <div class="card swiper-wrapper">
            @foreach($country_home as $key => $home)
            @foreach($home->movie->sortByDesc('id')->take(7) as $key => $mov)
            <div class="movie swiper-slide">
                <a style="color:#ffff" href="{{route('movie',$mov->slug)}}" title="{{$mov->title}}">
                <img
                    src={{asset('uploads/poster/'.$mov->poster)}}
                    alt={{$mov->title}}
                    onclick="window.location.href='{{route('movie',$mov->slug)}}'"
                />
                <div class="rest-card">
                    <video src={{asset('movie/'.$mov->trailer)}} muted></video>
                    <div class="content">
                        <div class="sub" style="margin-top: -20px;">
                            <p>{{$mov->year}}</p>
                            <p>{{$mov->title}}</p>
                            <p>
                                @if($mov->subtitle==1)
                                    Thuyết Minh
                                @elseif($mov->subtitle==0)
                                    Vietsub
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
            </a>
        </div>
        @endforeach
        @endforeach
        </div>
        <div class="swiper-button-next"></div>
        <div class="swiper-button-prev"></div>
    </div>
</div>

<!-- BANNER-WEB -->
<div class="banner-web">
    <div class="banners swiper-wrapper">
        <a href="{{route('package')}}" class="item swiper-slide">
            <img src="{{asset('imgs/img-banner/culuanenduyen.webp')}}" alt="" />
        </a>
        <a href="{{route('package')}}" class="item swiper-slide">
            <img src="{{asset('imgs/img-banner/khiemhayvephiaanh.webp')}}" alt="" />
        </a>
    </div>
</div>
<!-- SLIDE PHIM HÀNH ĐỘNG -->
<div class="card-movie">
    <div class="container">
        <h4>PHIM HÀNH ĐỘNG GAY CẤN</h4>
        <div class="card swiper-wrapper">
            @foreach($action_movie as $key => $mov)
            <div class="movie swiper-slide">
                <a style="color:#ffff" href="{{route('movie',$mov->slug)}}" title="{{$mov->title}}">
                <img
                    src={{asset('uploads/poster/'.$mov->poster)}}
                    alt={{$mov->title}}
                    onclick="window.location.href='{{route('movie',$mov->slug)}}'"
                />
                <div class="rest-card">
                    <video src={{asset('movie/'.$mov->trailer)}} muted></video>
                    <div class="content">
                        <div class="sub" style="margin-top: -20px;">
                            <p>{{$mov->year}}</p>
                            <p>{{$mov->title}}</p>
                            <p>
                                @if($mov->subtitle==1)
                                    Thuyết Minh
                                @elseif($mov->subtitle==0)
                                    Vietsub
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
            </a>
        </div>
        @endforeach
        </div>
        <div class="swiper-button-next"></div>
        <div class="swiper-button-prev"></div>
    </div>
</div>



<!-- SLIDE SẮP CHIẾU -->
<div class="card-movie">
    <div class="container">
        <h4>PHIM SẮP CHIẾU</h4>
        <div class="card swiper-wrapper">
            @foreach($hot_trailer as $key => $mov)
            <div class="movie swiper-slide">
                <a style="color:#ffff" href="{{route('movie',$mov->slug)}}" title="{{$mov->title}}">
                <img
                    src={{asset('uploads/poster/'.$mov->poster)}}
                    alt={{$mov->title}}
                    onclick="window.location.href='{{route('movie',$mov->slug)}}'"
                />
                <div class="rest-card">
                    <video src={{asset('movie/'.$mov->trailer)}} muted></video>
                    <div class="content">
                        <div class="sub" style="margin-top: -20px;">
                            <p>{{$mov->year}}</p>
                            <p>{{$mov->title}}</p>
                            <p>
                                @if($mov->subtitle==1)
                                    Thuyết Minh
                                @elseif($mov->subtitle==0)
                                    Vietsub
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
            </a>
        </div>
        @endforeach
        </div>
        <div class="swiper-button-next"></div>
        <div class="swiper-button-prev"></div>
    </div>
</div>

<!-- VIDEO GIỮA TRANG -->
@if(isset($homeMiddleVideo->trailer))
    <div class="video-banner">
        <div class="container">
            <div class="video-box">
                <video src={{asset('movie/'.$homeMiddleVideo->trailer)}} muted="false" autoplay="false" loop controls></video>
            </div>
            <div class="video-banner-text">
                <div class="title-banner">{{$homeMiddleVideo->title_eng}}</div>
                <div class="genre-banner">
                    <a href="" class="genre">{{$homeMiddleVideo->year}}</a>
                    <a href="" class="genre">
                        @if($homeMiddleVideo->subtitle==1)
                            Thuyết Minh
                        @elseif($homeMiddleVideo->subtitle==0)
                            Vietsub
                        @endif
                    </a>
                    <a href="" class="genre">
                        @if($homeMiddleVideo->resolution==0)
                            720p
                        @elseif($homeMiddleVideo->resolution==1)
                            1080p
                        @elseif($homeMiddleVideo->resolution==2)
                            4K
                        @else
                            Trailer
                        @endif
                    </a>
                    <a href="" class="genre">{{$homeMiddleVideo->duration}}</a>
                </div>
                <div class="details-banner">
                    {{$homeMiddleVideo->description}}
                </div>
                <div class="button-video">
                    <a href="{{route('movie',$homeMiddleVideo->slug)}}" title="Carl's Date" class="button">
                        <ion-icon name="play-outline"></ion-icon>
                        <span>Xem ngay</span>
                    </a>
                </div>
            </div>
        </div>
    </div>
@endif
<!-- SLIDE PHIM CỔ TRANG -->
<div class="card-movie">
    <div class="container">
        <h4>PHIM CỔ TRANG MỚI NHẤT</h4>
        <div class="card swiper-wrapper">
            @foreach($costume_movie as $key => $mov)
            <div class="movie swiper-slide">
                <a style="color:#ffff" href="{{route('movie',$mov->slug)}}" title="{{$mov->title}}">
                <img
                    src={{asset('uploads/poster/'.$mov->poster)}}
                    alt={{$mov->title}}
                    onclick="window.location.href='{{route('movie',$mov->slug)}}'"
                />
                <div class="rest-card">
                    <video src={{asset('movie/'.$mov->trailer)}} muted></video>
                    <div class="content">
                        <div class="sub" style="margin-top: -20px;">
                            <p>{{$mov->year}}</p>
                            <p>{{$mov->title}}</p>
                            <p>
                                @if($mov->subtitle==1)
                                    Thuyết Minh
                                @elseif($mov->subtitle==0)
                                    Vietsub
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
            </a>
        </div>
        @endforeach
        </div>
        <div class="swiper-button-next"></div>
        <div class="swiper-button-prev"></div>
    </div>
</div>

<!-- TOP 10 NETFLIX -->
<div class="wrapper" style="padding-top:20px">
    <div class="top-movie">
        <div class="container">
            <h4>ĐƯỢC XEM NHIỀU NHẤT</h4>
            <div class="card swiper-wrapper">
                @php
                    $number = 1;
                @endphp
                @foreach($hot10Movie as $key => $top)    
                    <div class="movie swiper-slide">
                        <a style="color:#ffff" href="{{route('movie',$top->slug)}}" title="{{$top->title}}">
                        <div class="movie-rating">
                            {{-- <img src="{{asset('imgs/img-number/number_001.svg')}}" alt="" /> --}}
                            <img src="{{ asset('imgs/img-number/number_' . str_pad($number, 3, '0', STR_PAD_LEFT) . '.svg') }}" alt="" />
                        </div>
                        <div class="movie-item">
                            <img
                                src="{{asset('uploads/top/'.$top->top10)}}"
                                alt="{{$top->title}}"
                                title="{{$top->title}}"
                                onclick="window.location.href='{{route('movie',$top->slug)}}'"
                            />
                            <div class="rest-card">
                                <video src="{{asset('movie/'.$top->trailer)}}" muted></video>
                                <div class="content">
                                    <div class="sub" style="margin-top:-20px">
                                        <p>{{$top->year}}</p>
                                        <p>{{$top->title_eng}}</p>
                                        <p>
                                            @if($top->subtitle==1)
                                                Thuyết Minh
                                            @elseif($top->subtitle==0)
                                                Vietsub
                                            @endif 
                                        </p>
                                        <p>
                                            @if($top->resolution==0)
                                                720p
                                            @elseif($top->resolution==1)
                                                1080p
                                            @elseif($top->resolution==2)
                                                4K
                                            @else
                                                Trailer
                                            @endif
                                        </p>

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    @php
                        $number++;
                    @endphp
                @endforeach 
            </div>
            <div class="swiper-button-next"></div>
            <div class="swiper-button-prev"></div>
        </div>
    </div>
</div>
<!-- TOP 10 NETFLIX --end -->

<!-- SLIDE PHIM HOẠT HÌNH -->
<div class="card-movie">
    <div class="container">
        <h4>PHIM HOẠT HÌNH HẤP DẪN</h4>
        <div class="card swiper-wrapper">
            @foreach($cartoon_movie as $key => $mov)
            <div class="movie swiper-slide">
                <a style="color:#ffff" href="{{route('movie',$mov->slug)}}" title="{{$mov->title}}">
                <img
                    src={{asset('uploads/poster/'.$mov->poster)}}
                    alt={{$mov->title}}
                    onclick="window.location.href='{{route('movie',$mov->slug)}}'"
                />
                <div class="rest-card">
                    <video src={{asset('movie/'.$mov->trailer)}} muted></video>
                    <div class="content">
                        <div class="sub" style="margin-top: -20px;">
                            <p>{{$mov->year}}</p>
                            <p>{{$mov->title}}</p>
                            <p>
                                @if($mov->subtitle==1)
                                    Thuyết Minh
                                @elseif($mov->subtitle==0)
                                    Vietsub
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
            </a>
        </div>
        @endforeach
        </div>
        <div class="swiper-button-next"></div>
        <div class="swiper-button-prev"></div>
    </div>
</div>
<!-- SLIDE PHIM KINH DỊ -->
<div class="card-movie">
    <div class="container">
        <h4>PHIM KINH DỊ MỚI NHẤT</h4>
        <div class="card swiper-wrapper">
            @foreach($horror_movie as $key => $mov)
            <div class="movie swiper-slide">
                <a style="color:#ffff" href="{{route('movie',$mov->slug)}}" title="{{$mov->title}}">
                <img
                    src={{asset('uploads/poster/'.$mov->poster)}}
                    alt={{$mov->title}}
                    onclick="window.location.href='{{route('movie',$mov->slug)}}'"
                />
                <div class="rest-card">
                    <video src={{asset('movie/'.$mov->trailer)}} muted></video>
                    <div class="content">
                        <div class="sub" style="margin-top: -20px;">
                            <p>{{$mov->year}}</p>
                            <p>{{$mov->title}}</p>
                            <p>
                                @if($mov->subtitle==1)
                                    Thuyết Minh
                                @elseif($mov->subtitle==0)
                                    Vietsub
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
            </a>
        </div>
        @endforeach
        </div>
        <div class="swiper-button-next"></div>
        <div class="swiper-button-prev"></div>
    </div>
</div>
<!-- SLIDE PHIM TOP VIEW NGÀY -->
<div class="card-movie">
    <div class="container">
        <h4>PHIM NỔI BẬT TRONG NGÀY</h4>       
        <div class="card swiper-wrapper">
            @foreach($top_view_day as $key => $mov)
            <div class="movie swiper-slide">
                <a style="color:#ffff" href="{{route('movie',$mov->slug)}}" title="{{$mov->title}}">
                <img
                    src={{asset('uploads/poster/'.$mov->poster)}}
                    alt={{$mov->title}}
                    onclick="window.location.href='{{route('movie',$mov->slug)}}'"
                />
                <div class="rest-card">
                    <video src={{asset('movie/'.$mov->trailer)}} muted></video>
                    <div class="content">
                        <div class="sub" style="margin-top: -20px;">
                            <p>{{$mov->year}}</p>
                            <p>{{$mov->title}}</p>
                            <p>
                                @if($mov->subtitle==1)
                                    Thuyết Minh
                                @elseif($mov->subtitle==0)
                                    Vietsub
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
            </a>
        </div>
        @endforeach
        </div>
        <div class="swiper-button-next"></div>
        <div class="swiper-button-prev"></div>
    </div>
</div>
<!-- SLIDE PHIM TOP VIEW TUẦN -->
<div class="card-movie">
    <div class="container">
        <h4>PHIM NỔI BẬT TRONG TUẦN</h4>       
        <div class="card swiper-wrapper">
            @foreach($top_view_week as $key => $mov)
            <div class="movie swiper-slide">
                <a style="color:#ffff" href="{{route('movie',$mov->slug)}}" title="{{$mov->title}}">
                <img
                    src={{asset('uploads/poster/'.$mov->poster)}}
                    alt={{$mov->title}}
                    onclick="window.location.href='{{route('movie',$mov->slug)}}'"
                />
                <div class="rest-card">
                    <video src={{asset('movie/'.$mov->trailer)}} muted></video>
                    <div class="content">
                        <div class="sub" style="margin-top: -20px;">
                            <p>{{$mov->year}}</p>
                            <p>{{$mov->title}}</p>
                            <p>
                                @if($mov->subtitle==1)
                                    Thuyết Minh
                                @elseif($mov->subtitle==0)
                                    Vietsub
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
            </a>
        </div>
        @endforeach
        </div>
        <div class="swiper-button-next"></div>
        <div class="swiper-button-prev"></div>
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