@extends('layout')
@section('content')
<style>
    .banner-movie{
        display: none;
    }
    /* Hiệu ứng hover khi người dùng di chuột qua sao đánh giá */
    .stars .fa-star:hover,
    .stars .fa-star:hover ~ .fa-star {
    color: yellow;
    }
</style>
<!-- CHI TIẾT -->
    <label class="close-btn fas fa-times" title="close" onclick="toggleDetail()"></label>
    <div class="film">
        <div class="container"  >
            <div class="video-banner">
                <div class="container" style="width: 100%; margin: 0 -1.1rem;">
                    <div class="video-box">
                        {{-- TRAILER PHIM --}}
                        @if(isset($movie->trailer))
                            <!-- Chiếu Trailer -->
                            <video src={{asset('movie/'.$movie->trailer)}} muted="false" autoplay="true" loop controls></video>
                        @endif
                    </div>
                    <div class="video-banner-text">
                        <div class="title-banner">{{$movie->title}}</div>
                        <div class="genre-banner">
                            <a href="" class="genre">{{$movie->year}}</a>                            
                            <a href="" class="genre">{{$movie->country->title}}</a>
                            <a href="" class="genre">
                                @if($movie->type==1)
                                    Phim Lẻ
                                @elseif($movie->type==2)
                                    Phim Bộ
                                @endif
                            </a>
                            <a href="" class="genre">{{$movie->duration}} phút</a>
                            <a href="" class="genre">
                                @if($movie->resolution==0)
                                    720p
                                @elseif($movie->resolution==1)
                                    1080p
                                @elseif($movie->resolution==2)
                                    4K
                                @else
                                    Trailer
                                @endif
                            </a>
                        </div>
                        <div class="details-banner" style="color:rgb(202, 0, 0); font-weight:bolder">
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
                        <div class="button-video">
                            @if(isset($episode_first))
                            <a href="{{url('xem-phim/'.$movie->slug.'/tap-'.$episode_first->episode)}}" title={{$movie->title}} class="button">
                                <ion-icon name="play-outline"></ion-icon>
                                <span>Xem ngay</span>
                            </a> 
                            @endif                           
                        </div>
                        <br>
                        <div class="button-video" >
                        {{-- BOOKMARK PHIM --}}
                        @if (Auth::check())
                            @if($user->package_id!=1 && !($user->bookmark->contains('movie_id', $movie->id)))
                            
                                <form action="{{ route('add_bookmark') }}" method="POST">
                                    @csrf
                                    <input type="hidden" name="movieID_post" value="{{ $movie->id }}">
                                    <button type="submit"><a class="button-bookmark button" onclick="toggleDetail()">
                                        <ion-icon name="alert-circle-outline"></ion-icon>
                                        <span>Bookmark</span>
                                        </a>
                                    </button>
                                </form>
                            @elseif($user->package_id==1)
                                <form action="{{ route('package') }}">
                                    @csrf
                                    <input type="hidden" name="movieID_post" value="{{ $movie->id }}">
                                    <button type="submit"><a class="button-bookmark button" onclick="toggleDetail()">
                                        <ion-icon name="alert-circle-outline"></ion-icon>
                                        <span>Bookmark</span>
                                        </a>
                                    </button>
                                </form> 
                            @endif 
                        @elseif(!(Auth::check()))
                            <form action="{{ route('package') }}">
                                @csrf
                                <input type="hidden" name="movieID_post" value="{{ $movie->id }}">
                                <button type="submit"><a class="button-bookmark button" onclick="toggleDetail()">
                                    <ion-icon name="alert-circle-outline"></ion-icon>
                                    <span>Bookmark</span>
                                    </a>
                                </button>
                            </form>   
                        @endif
                        </div>
                    </div>
                </div>
            </div>
            <div class="video-content">                
                <div class="content-left">
                    <div class="title-vn">{{$movie->title_eng}}</div>
                    {{-- <div class="title-eng">{{$movie->title_eng}}</div> --}}
                    <div class="rating-box">
                        <div class="view">{{$viewMovie}} lượt xem</div>
                        {{-- ĐÁNH GIÁ PHIM --}}
                        <div class="stars">
                            <span class="total-start">5.0</span>
                            <i class="fa-solid fa-star"></i>
                            <i class="fa-solid fa-star"></i>
                            <i class="fa-solid fa-star"></i>
                            <i class="fa-solid fa-star"></i>
                            <i class="fa-solid fa-star"></i>
                        </div>
                    </div>
                    {{-- <div class="genre">
                        <a style="color: rgb(202, 0, 0)" href="{{url('nam/'.$movie->year)}}">{{$movie->year}}</a>
                        <a style="color: rgb(202, 0, 0)" href="{{route('country',$movie->country->slug)}}">{{$movie->country->title}}</a>
                        <a>
                         @if($movie->type==1)
                             Phim Lẻ
                         @elseif($movie->type==2)
                             Phim Bộ
                         @endif
                        </a>
                        <a>
                         @if($movie->resolution==0)
                             720p
                         @elseif($movie->resolution==1)
                             1080p
                         @elseif($movie->resolution==2)
                             4K
                         @else
                             Trailer
                         @endif
                        </a>
                    </div> --}}
                    <div class="details">{{$movie->description}}</div>
                </div>
                <div class="content-right">
                    <div class="center">
                        <p>
                            Diễn viên:
                            {{$movie->actor}}
                        </p>
                    </div>
                    <div class="middle">
                        <p>
                            Đạo diễn:
                            {{$movie->director}}
                        </p>
                    </div>
                    <div class="bottom">
                        <p>
                            Thể loại:
                            <!-- Lấy ra các thể loại của phim này -->
                            @foreach($movie->movie_genre as $gen)
                             <a style="color: rgb(202, 0, 0)" href="{{route('genre',$gen->slug)}}" rel="category tag">
                             {{$gen->title}}</a>
                            @endforeach 
                        </p>
                        <p>
                             Từ khóa tìm kiếm: 
                             {{-- Chuyển đổi các từ khóa thành links --}}
                             @if($movie->tags != NULL)
                                 @php
                                 // Cho các từ khóa vào 1 mảng
                                 $tags = [];
                                 // Tách từng từ khóa ra bằng dấu phẩy
                                 $tags = explode(',',$movie->tags);
                                 @endphp
     
                                 @foreach($tags as $key => $tag)
                                 <a style="color: rgb(202, 0, 0)" href="{{url('tag/'.$tag)}}">{{$tag}}</a>
                                 @endforeach
                             @else
                                 {{$movie->title}}
                             @endif
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
<!-- CHI TIẾT --end -->

<!-- SLIDE PHIM CÓ LIÊN QUAN -->
<div class="card-movie">
    <div class="container">
        <h4>CÓ THỂ BẠN MUỐN XEM:</h4>
        <div class="card swiper-wrapper">
            @foreach($related as $key => $mov)
            <div class="movie swiper-slide">
                <a style="color:#ffff" href="{{route('movie',$mov->slug)}}" title="{{$mov->title}}">
                <img
                    src={{asset('uploads/poster/'.$mov->poster)}}
                    alt={{$mov->title}}
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
            </div>
            @endforeach
        </div>
        <div class="swiper-button-next"></div>
        <div class="swiper-button-prev"></div>
    </div>
</div>

{{-- ĐÁNH GIÁ PHIM --}}
<script type="text/javascript">
    function remove_background(movie_id){
       for(var count = 1; count <= 5; count ++){
          $('#'+movie_id+'-'+count).css('color','#ccc');
       }
    }
    // Hover chuột đánh giá sao
    $(document).on('mouseenter', '.rating', function(){
       var index = $(this).data("index");
       var movie_id = $(this).data('movie_id');
 
       remove_background(movie_id);
       for(var count = 1; count <= index; count++){
          $('#'+movie_id+'-'+count).css('color', '#ffcc00');
       }
    });
    // Nhả chuột không đánh giá
    $(document).on('mouseleave', '.rating', function(){
       var index = $(this).data("index");
       var movie_id = $(this).data('movie_id');
       var rating = $(this).data("rating");
       remove_background(movie_id);
 
       for(var count = 1; count <= rating; count++){
          $('#'+'movie_id'+'-'+count).css('color', '#ffcc00');
       }
    });
 
    // Click đánh giá sao
    $(document).on('click', '.rating', function(){
       var index = $(this).data("index");
       var movie_id = $(this).data('movie_id');
 
       $.ajax({
          url: "{{route('add-rating')}}",
          method: "POST",
          data: {index: index, movie_id: movie_id},
             headers: {
                'X-CSRF-TOKEN': $('meta[name = "csrf-token"]').attr('content')
             },
          success: function(data){
             if(data == 'done'){
                alert("Bạn đã đánh giá " + index + " trên 5 sao. Xin cảm ơn!");
                location.reload();
             } else if (data == 'exist') {
                alert("Bạn đã đánh giá phim này trước đó rồi ạ!");
                location.reload();
             } else {
                alert("Có lỗi xảy ra rồi, bạn vui lòng đánh giá sau nhé!");
                location.reload();
             }
          }
       });
    });
 </script>

{{-- Comment FACEBOOK --}}
<h2><span style="color:#9e0000; margin-left: 30px">Bình luận</span></h2><br>
@php
    $current_url = Request::url();
@endphp
<div style="background-color: rgb(111, 111, 111)">
    <div>
    <article>
        <div class="fb-comments" data-href="{{$current_url}}" data-width="100%" data-numposts="10"></div>
    </article>
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