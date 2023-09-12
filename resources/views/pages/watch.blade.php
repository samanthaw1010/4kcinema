@extends('layout')
@section('content')
<style>
.banner-movie{
    display: none;
}
/* CSS cho thanh điều khiển tùy chỉnh */
.video-container {
    position: relative;
}

.main-video {
    width: 100%;
}

.custom-controls {
    position: absolute;
    bottom: 0;
    left: 0;
    width: 100%;
    background-color: rgba(255, 255, 255, 0.5);
    display: flex;
    align-items: center;
    padding: 5px;
}

.custom-controls button,
.custom-controls input {
    margin: 5px;
}

.current-time,
.duration {
    margin: 0 5px;
    color: #000000;
}

.volume-bar{
    width: 100px;
}
.seek-bar {
    width: 1500px;
}

</style>
<!-- XEM PHIM -->
<div class="film">
   <div class="container">
       <div class="container_video" id="up">
           <div class="video_player">
            <video preload="metadata" class="main-video" id="videoPlayer">
                
            
                @if(Auth::check())
                    @if($user->package_id==4)
                        @if(isset($episode->video4k))
                            <source id="videoSource" src="{{ asset($episode->video4k) }}" size="Full HD" type="video/mp4"/>
                        @endif
                        @if(isset($episode->video1080))
                            <source id="videoSource" src="{{ asset($episode->video1080) }}" size="HD" type="video/mp4"/>
                        @endif
                            <source id="videoSource" src="{{ asset($episode->video720) }}" size="SD" type="video/mp4"/>
                    @elseif($user->package_id==2)
                        @if(isset($episode->video1080))
                            <source id="videoSource" src="{{ asset($episode->video1080) }}" size="HD" type="video/mp4"/>
                        @endif
                            <source id="videoSource" src="{{ asset($episode->video720) }}" size="SD" type="video/mp4"/>
                    @elseif($user->package_id==1)
                        <source id="videoSource" src="{{ asset($episode->video720) }}" size="SD" type="video/mp4"/>
                    @endif
                @else
                    <source id="videoSource" src="{{ asset($episode->video720) }}" size="SD" type="video/mp4"/>
                @endif
            </video>
            

               <!-- Thanh điều khiển tùy chỉnh -->
                <div class="custom-controls">
                    <button class="play-button" onclick="togglePlayPause()"><i style="font-size: 20px; color:#000000" class="fa-solid fa-play"></i></button>
                    <input class="seek-bar" type="range" min="0" step="1" />
                    <span class="current-time">0:00</span> / <span class="duration">0:00</span>
                    <button class="mute-button" onclick="toggleMute()"><i style="font-size: 20px; color:#000000" class="fa-solid fa-volume-high"></i></button>
                    <input class="volume-bar" type="range" min="0" max="1" step="0.1" />
                    <!-- Nút chọn chất lượng video -->
                    {{-- <select style="font-size: 20px" class="quality-select" onchange="changeQuality()">
                        <option value="" disabled selected hidden>Chất lượng</option>
                        <option value="SD">720p</option>

                        @if(Auth::check() && $user->package_id == 2)
                            @if(isset($episode->video1080))
                                <option value="HD">1080p</option>
                            @endif
                        @endif


                        @if(Auth::check() && $user->package_id == 4)
                            @if(isset($episode->video4k))
                                <option value="Full HD">4K</option>
                            @endif
                        @endif
                    </select> --}}
                    {{-- Hiển thị thông tin chất lượng video --}}
                    <div style="font-size: 20px" class="quality-select">
                        @if(Auth::check())
                            @if($user->package_id==4 && isset($episode->video4k))
                                <p style="margin-right: 5px">4K</p>
                            @elseif(($user->package_id==4 || $user->package_id==2) && isset($episode->video1080))
                                <p style="margin-right: 5px">1080p</p>
                            @elseif($user->package_id==1)
                                <p style="margin-right: 5px">720p</p>
                            @endif
                        @else
                            <p style="margin-right: 5px">720p </p>
                        @endif
                    </div>
                    <!-- Nút chọn tốc độ phát video -->
                    <select style="font-size: 20px" class="speed-select" onchange="changeSpeed()">
                        <option value="0.5">0.5x</option>
                        <option value="1" selected>1x</option>
                        <option value="2">2x</option>
                    </select>
                    {{-- Nút phóng to màn hình --}}
                    <button class="fullscreen-toggle-button" onclick="toggleFullscreen()">
                        <i style="font-size: 20px; color: #000000" class="fa-solid fa-expand"></i>
                        <i style="font-size: 20px; color: #000000; display: none;" class="fa-solid fa-compress" id="compressIcon"></i>
                    </button>
                    
                </div>
                
           </div>
       </div>
       <div class="video-content">
           <div class="content-left">
               <div class="title-vn">{{$movie->title}}</div>
               <div class="title-eng">{{$movie->title_eng}}</div>
               {{-- LƯỢT XEM VÀ ĐÁNH GIÁ PHIM --}}
               <div class="rating-box">
                   <div class="view">{{$viewMovie}} lượt xem</div>
                   <div class="stars">
                       <span class="total-start">5.0</span>
                       <i class="fa-solid fa-star"></i>
                       <i class="fa-solid fa-star"></i>
                       <i class="fa-solid fa-star"></i>
                       <i class="fa-solid fa-star"></i>
                       <i class="fa-solid fa-star"></i>
                   </div>
               </div>
               <div class="genre">
                   <a style="color: rgb(202, 0, 0)" href="{{url('nam/'.$movie->year)}}">{{$movie->year}}</a>
                   <a style="color: rgb(202, 0, 0)" href="{{route('country',$movie->country->slug)}}">{{$movie->country->title}}</a>
                   <a>
                    @if($movie->type==1)
                        Phim lẻ
                    @elseif($movie->type==2)
                        Phim bộ
                    @endif
                   </a>
                   <a>
                    @if($movie->resolution==0)
                        720p
                    @elseif($movie->resolution==1)
                        1080p
                    @elseif($movie->resolution==2)
                        4K  
                        @if(!isset($user) || $user->package_id !=4)
                        <a style="color:rgb(202, 0, 0)" href="{{route('package')}}">Đăng Ký Gói Để Xem Phim Với Chất Lượng 4K</a>
                        @endif
                    @else
                        Trailer
                    @endif
                   </a>
                   
               </div>
               <div class="details">{{$movie->description}}</div>
           </div>
           <div class="content-right">
               <div class="top">
               </div>
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

<div class="list-movie">
   <div class="container">
    @if($movie->total_episode > 1) 
       <div class="movie-content">
            <div class="title">Danh sách tập:</div>
            <div class="full-ep">
                <li class="list-info-group-item"> 
                    {{$episode_uploaded_count}}/{{$movie->total_episode}} Tập - 
                    @if($episode_uploaded_count==$movie->total_episode)
                        Hoàn tất
                    @else
                        Đang cập nhật
                    @endif
                </li>
            </div>
       </div>
       
         
       {{-- DANH SÁCH CÁC TẬP --}}
        <div class="list-video">
            <div class="list swiper-wrapper">
                @foreach($movie->episode as $key => $eps)
                
                    <div class="vid swiper-slide">
                        <a href="{{url('xem-phim/'.$movie->slug.'/tap-'.$eps->episode)}}">
                        <img
                            src="{{asset('uploads/ep-poster/'.$eps->ep_poster)}}"
                            alt="{{$movie->title}}"
                            title="{{$movie->title}}"
                            style="width: 250px; height: 150px"
                            onclick="window.location.href='{{url('xem-phim/'.$movie->slug.'/tap-'.$eps->episode)}}'"
                        />
                        <div class="vid-content">
                            @if($getEpisode==$eps->episode)
                                <div class="ep" style="font-weight:bold; color:rgb(210, 0, 0)">Tập {{$eps->episode}}</div>
                            @else
                                <div class="ep">Tập {{$eps->episode}}</div>
                            @endif
                        </div>
                        </a>
                    </div>
                
                @endforeach
            </div>
            <div class="swiper-button-next"></div>
            <div class="swiper-button-prev"></div>
        </div>
    @endif
   </div>
</div>
<!-- MOVIE --end -->

<!-- CARD -->
<div class="card-movie">
   <div class="container">
       <h4>CÓ THỂ BẠN MUỐN XEM:</h4>
       <div class="card swiper-wrapper">
        @foreach($related as $key => $hot)
           <div class="movie swiper-slide">
            <a style="color:#ffff" href="{{route('movie',$hot->slug)}}" title="{{$hot->title}}">
               <img
                   src="{{asset('uploads/poster/'.$hot->poster)}}"
                   alt="{{$hot->title}}"
                   title="{{$hot->title}}"
                   onclick="window.location.href='{{route('movie',$hot->slug)}}'"
               />
               <div class="rest-card">
                   <video src="{{asset('movie/'.$hot->trailer)}}" muted></video>
                   <div class="content">
                       <div class="sub" style="margin-top:-15px; margin-left: -10px">
                           <p>{{$hot->year}}</p>
                           <p>{{$hot->title}}</p>
                           <p>
                            @if($hot->type==1)
                                Phim lẻ
                            @elseif($hot->type==2)
                                Phim bộ
                            @endif
                           </p>
                           <p>
                            @if($hot->resolution==0)
                                720p
                            @elseif($hot->resolution==1)
                                1080p
                            @elseif($hot->resolution==2)
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
<!-- CARD --end -->


<script>
    // Lấy tham chiếu tới video và các phần tử của thanh điều khiển
    const video = document.querySelector('.main-video');
    const playButton = document.querySelector('.play-button');
    const muteButton = document.querySelector('.mute-button');
    const volumeBar = document.querySelector('.volume-bar');
    const seekBar = document.querySelector('.seek-bar');
    const currentTimeDisplay = document.querySelector('.current-time');
    const durationDisplay = document.querySelector('.duration');

    // Hàm toggle play/pause video
    function togglePlayPause() {
        if (video.paused || video.ended) {
            video.play();
            playButton.innerHTML = '<i class="fa-solid fa-pause" style="font-size: 20px; color:#000000"></i>';
        } else {
            video.pause();
            playButton.innerHTML = '<i class="fa-solid fa-play" style="font-size: 20px; color:#000000"></i>';
        }
    }

    // Hàm toggle mute/unmute video
    function toggleMute() {
        if (video.muted) {
            video.muted = false;
            muteButton.innerHTML = '<i class="fa-solid fa-volume-high" style="font-size: 20px; color:#000000"></i>';
        } else {
            video.muted = true;
            muteButton.innerHTML = '<i class="fa-solid fa-volume-xmark" style="font-size: 20px; color:#000000"></i>';
        }
    }
    // Xử lý sự kiện khi video được tải xong metadata
    video.addEventListener('loadedmetadata', function () {
        const seekBar = document.querySelector(".seek-bar");
        seekBar.value = 0; // Đặt seek-bar về giá trị 0
        seekBar.max = video.duration;
        // Hiển thị tổng thời gian của video
        durationDisplay.textContent = formatTime(video.duration);     

        // Cập nhật thanh seek khi video đang chạy
        video.addEventListener('timeupdate', function () {
            seekBar.value = video.currentTime;
            currentTimeDisplay.textContent = formatTime(video.currentTime);

            // Kiểm tra nếu video đã chạy hết thời gian
            if (Math.abs(video.currentTime - video.duration) <= 0) {
                // Đặt giá trị seek bar bằng giá trị cuối cùng (video.duration)
                seekBar.value = video.duration;
            }
        });

        // Xử lý sự kiện khi người dùng thay đổi âm lượng
        volumeBar.addEventListener('input', function () {
            video.volume = volumeBar.value;
        });
    });

    // Hàm định dạng thời gian từ giây sang phút:giây
    function formatTime(time) {
        const minutes = Math.floor(time / 60);
        const seconds = Math.floor(time % 60);
        return `${minutes}:${String(seconds).padStart(2, '0')}`;
    }

    let currentTimeBeforeChange = 0;
    
    // Hàm thay đổi chất lượng video
    function changeQuality() {
        const qualitySelect = document.querySelector('.quality-select');
        const selectedQuality = qualitySelect.value;
        const sources = video.getElementsByTagName('source');
        const currentTime = video.currentTime; // Lưu thời điểm hiện tại của video trước khi thay đổi chất lượng
        currentTimeBeforeChange = currentTime; // Lưu thời điểm trước khi thay đổi chất lượng

        // Tìm và chọn source có kích thước phù hợp
        for (let i = 0; i < sources.length; i++) {
            const source = sources[i];
            if (source.getAttribute('size') === selectedQuality) {
                video.src = source.getAttribute('src');
                break;
            }
        }
        // Tải lại video với chất lượng mới
        video.load();
        // Đặt lại thời điểm của video sau khi video được tải lại
        video.addEventListener('loadedmetadata', function () {
            video.currentTime = currentTimeBeforeChange; // Chuyển đến thời điểm trước khi thay đổi chất lượng
            video.play();
        });

        
    }

    // Hàm thay đổi tốc độ phát video
    function changeSpeed() {
        const speedSelect = document.querySelector('.speed-select');
        const selectedSpeed = speedSelect.value;
        video.playbackRate = parseFloat(selectedSpeed);
    }
</script>

<script>
    // Mã JavaScript để xử lý chức năng chuyển đổi chế độ toàn màn hình
  
    // Hàm chuyển đổi chế độ toàn màn hình
    function toggleFullscreen() {
      const videoElement = document.getElementById('videoPlayer');
      const fullscreenIcon = document.getElementById('fullscreenIcon');
      const compressIcon = document.getElementById('compressIcon');
  
      if (!document.fullscreenElement) {
        // Nếu video chưa ở chế độ toàn màn hình, thì chuyển sang chế độ toàn màn hình
        if (videoElement.requestFullscreen) {
          videoElement.requestFullscreen();
        } else if (videoElement.webkitRequestFullscreen) { /* Safari */
          videoElement.webkitRequestFullscreen();
        } else if (videoElement.msRequestFullscreen) { /* IE11 */
          videoElement.msRequestFullscreen();
        }
  
        // Hiển thị biểu tượng nén (compress) và ẩn biểu tượng mở rộng (expand)
        compressIcon.style.display = 'inline-block';
        fullscreenIcon.style.display = 'none';
      } else {
        // Nếu video đã ở chế độ toàn màn hình, thì thoát chế độ toàn màn hình
        if (document.exitFullscreen) {
          document.exitFullscreen();
        } else if (document.webkitExitFullscreen) { /* Safari */
          document.webkitExitFullscreen();
        } else if (document.msExitFullscreen) { /* IE11 */
          document.msExitFullscreen();
        }
  
        // Hiển thị biểu tượng mở rộng (expand) và ẩn biểu tượng nén (compress)
        compressIcon.style.display = 'none';
        fullscreenIcon.style.display = 'inline-block';
      }
    }
  </script>
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