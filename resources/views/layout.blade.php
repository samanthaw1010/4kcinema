{{-- ĐÂY LÀ KHUNG SƯỜN GIAO DIỆN CỦA LANDING PAGE --}}
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8" />
        <meta name="csrf-token" content="{{csrf_token()}}"/>
        <link rel="shortcut icon" href={{ asset('imgs/img-logo/logo-mini.png') }} type="image/x-icon" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <title>4K CINEMA High Quality Movies</title>

        <!-- Ionicons -->
        <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
        <script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>
        <!-- Icon google -->
        <link href="https://fonts.googleapis.com/css2?family=Material+Icons" rel="stylesheet" />
        <link
            rel="stylesheet"
            href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@48,400,0,0"
        />
        <link
            rel="stylesheet"
            href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css"
            integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw=="
            crossorigin="anonymous"
            referrerpolicy="no-referrer"
        />
        <!-- Font Awesome -->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
        <script src="https://kit.fontawesome.com/9eb8b4698c.js" crossorigin="anonymous"></script>

        <!-- CSS -->
        <link rel="stylesheet" href="{{asset('css/styleMain.css')}}" />
        <link rel="stylesheet" href="{{asset('css/responsiveMain.css')}}" />

        <!-- Link Swiper's CSS -->
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@9/swiper-bundle.min.css" />
        <!-- Owl-Carousel-2 CSS -->
        <link
            rel="stylesheet"
            href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.min.css"
            integrity="sha512-tS3S5qG0BlhnQROyJXvNjeEM4UpMXHrQfTGmbQ1gKmelCxlSEBUaxhRBj/EFTzpbP4RVSrpEikbmdJobCvhE3g=="
            crossorigin="anonymous"
            referrerpolicy="no-referrer"
        />
        <link
            rel="stylesheet"
            href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.theme.default.min.css"
            integrity="sha512-sMXtMNL1zRzolHYKEujM2AqCLUR9F2C4/05cdbxjjLSRvMQIciEPCQZo++nk7go3BtSuK9kfa/s+a4f4i5pLkw=="
            crossorigin="anonymous"
            referrerpolicy="no-referrer"
        />
    </head>
    <style>
        .footer-banner {
            width: 100%;
            overflow: hidden;
            background-color: #0b0b0b; /* Thay đổi màu nền tùy ý */
        }

        .banner-content {
            display: inline-block;
            white-space: nowrap;
            animation: scroll 18s linear infinite; /* Thay đổi tốc độ chạy bằng cách thay đổi giá trị thời gian (10s) */
        }

        .banner-content img {
            display: inline-block;
        }

        @keyframes scroll {
            from {
                transform: translateX(100%);
            }
            to {
                transform: translateX(-100%);
            }
        }
    </style>
    <body>
        <!-- HEADER -->
        <div class="header">
            <div class="container">
                <div class="header-left">
                    <div class="menuToggle">
                        <ion-icon name="menu-outline"></ion-icon>
                    </div>
                    <a href="{{url('/')}}" class="logo-brand">
                        <img src="{{asset('imgs/img-logo/logo.png')}}" alt="logo" />
                    </a>
                    <!-- header-links -->
                    <ul class="header-links">
                        <li class="dropdown">
                            <a class="header-link">
                                THỂ LOẠI
                                <ion-icon name="caret-down-outline"></ion-icon>
                            </a>
                            <ul class="dropdown-menu-mega">
                                @foreach($genre as $key => $cate)
                                   <li><a title="{{$cate->title}}" href="{{route('genre',$cate->slug)}}">{{$cate->title}}</a></li>
                                @endforeach
                            </ul>
                        </li>
                        <li class="dropdown">
                            <a class="header-link">
                                QUỐC GIA
                                <ion-icon name="caret-down-outline"></ion-icon>
                            </a>
                            <ul class="dropdown-menu-mega">
                                @foreach($country as $key => $cate)
                                   <li><a title="{{$cate->title}}" href="{{route('country',$cate->slug)}}">{{$cate->title}}</a></li>
                                @endforeach
                            </ul>
                        </li>
                        <li class="dropdown">
                            <a class="header-link">
                                NĂM PHÁT HÀNH
                                <ion-icon name="caret-down-outline"></ion-icon>
                            </a>
                            <ul class="dropdown-menu-mega">
                                @for($year=1990; $year<=2023; $year++)
                                   <li><a title="{{$year}}" href="{{url('nam/'.$year)}}">{{$year}}</a></li>
                                @endfor
                            </ul>
                        </li>
                    </ul>
                    <!-- header-links --end -->
                </div>
                <div class="header-right">
                    {{-- TÌM KIẾM PHIM --}}
                    <div class="header-search">
                        <ion-icon name="search-outline" class="searchBtn" style="font-size: 25px"></ion-icon>
                        <div class="searchBox">
                            <form action="{{route('tim-kiem')}}" method="GET">
                                <input type="text" name="search" id="timkiem" placeholder="Nhập tên phim..." class="searchInput" autofocus/>
                                <button type="submit" name="search-outline" class="search"><i class="fas fa-search"></i></button>
                                <div class="searchMovie" id="resultSearch">
                                    
                                </div>
                            </form>
                        </div>
                    </div>
                    {{-- QUẢNG CÁO GÓI VIP --}}
                    <div class="header-vip">
                        @if(Auth::check() && $user->package_id == 1)
                            <a href="{{route('package')}}">ĐĂNG KÝ GÓI</a>
                        @elseif(Auth::check() && $user->package_id != 1)
                            <a href="{{route('package')}}">CHUYỂN ĐỔI GÓI</a>
                        @else
                            <a href="{{route('login')}}">ĐĂNG KÝ GÓI</a>
                        @endif
                            <div class="details">
                                <h6>Đăng ký gói ngay hôm nay để tận hưởng quyền lợi</h6>
                                <p>
                                    <ion-icon name="heart-outline"></ion-icon>
                                    Phim chất lượng cao lên đến 4K
                                </p>
                                <p>
                                    <ion-icon name="heart-outline"></ion-icon>
                                    Lưu lại phim yêu thích để xem sau
                                </p>                                
                            </div>                        
                    </div>
                    {{-- THÔNG BÁO --}}
                    <div class="notification-icon">
                        <a href="{{route('view_notification')}}">
                            <i class="fa-regular fa-bell" style="font-size: 30px; color: white;"></i>
                            @if(isset($notification))
                            <span class="notification-count" onclick="hide()">{{ $notificationCount }}</span>
                            @endif
                        </a>
                    </div>
                    {{-- USER --}}
                    @if (Auth::check())
                    <div class="header-user">
                        @if(isset($user))
                        <a class="userBtn"><h4 style="color:rgb(231, 61, 61)">{{ strtoupper($user->name) }}&nbsp;<i class="fa-solid fa-caret-down" style="color:rgb(255, 255, 255)"></i>
                        </h4></a>
                        {{-- <a><i class="fa-regular fa-user userBtn" style="font-size: 25px"></i></a> --}}
                        <div class="profile">
                            <div class="content">
                                <div class="user-info">
                                
                                    <h6 style="color:yellow">
                                        @if($user->package_id==1)
                                             FREE 
                                        @elseif($user->package_id==2)
                                             GOLD 
                                        @elseif($user->package_id==4)
                                             PLATINUM 
                                        @else
                                             PREMIUM 
                                        @endif
                                    </h6><br><br> 
                                                       
                                </div>
                                <hr />
                                @if($user->role==1 || $user->role==0)                                          
                                        <a href="{{route('dashboard')}}" class="profile-link">
                                            <i class="fa-solid fa-hat-cowboy"></i>
                                            <p>&nbsp; Trang Admin</p>
                                        </a> 
                                        @endif 
                                <a href="{{route('setting_info')}}" class="profile-link">
                                    <i class="fa-solid fa-circle-info"></i>
                                    <p>&nbsp; Quản lý tài khoản </p>
                                </a>
                                <a href="{{route('log_out')}}" class="profile-link">
                                    <i class="fa-solid fa-right-from-bracket"></i>
                                    <p>&nbsp; Thoát</p>
                                </a>
                                @endif
                            </div>
                        </div>
                    </div>
                    @else
                    <div class="header-form">
                        <ion-icon name="person-circle-outline" class="formBtn" style="font-size: 30px"></ion-icon>
                        <div class="formBox">
                            <div>
                                <a href="{{route('log_in')}}" style="color: red;"><button>Đăng nhập</button></a>
                            </div>
                            <div>
                                <a href="{{route('register_get')}}" style="color: red;"><button>Đăng ký</button></a>
                            </div>
                        </div>
                    </div>
                    @endif

                </div>
            </div>
        </div>
        <!-- HEADER --end -->

        {{-- ===============Đây là phần content thay đổi giữa các page=============== --}}
        <div class="container">
            @yield('content')
        </div>  

        <!-- FOOTER -->
        <footer>
            <div class="container">
                <div class="top">
                    <div class="footer-banner">
                        <div class="banner-content">
                        <img src="{{asset('imgs/img-banner/banner1.png')}}" alt="Image 1">&nbsp;&nbsp;&nbsp;&nbsp;
                        <img src="{{asset('imgs/img-banner/banner2.png')}}" alt="Image 1">&nbsp;&nbsp;&nbsp;&nbsp;
                        <img src="{{asset('imgs/img-banner/banner3.png')}}" alt="Image 1">&nbsp;&nbsp;&nbsp;&nbsp;
                        <img src="{{asset('imgs/img-banner/banner4.png')}}" alt="Image 1">&nbsp;&nbsp;&nbsp;&nbsp;
                        <img src="{{asset('imgs/img-banner/banner5.png')}}" alt="Image 1">&nbsp;&nbsp;&nbsp;&nbsp;
                        <img src="{{asset('imgs/img-banner/banner6.png')}}" alt="Image 1">&nbsp;&nbsp;&nbsp;&nbsp;
                        </div>
                    </div>
                </div>
                <div class="link-boxes">
                    <ul class="box">
                        <li class="link_name"></li>
                        <li><img src="{{asset('imgs/img-logo/logo.png')}}" alt="logo"></li>
                        <li><a href="#"></a></li>
                        <li><a href="#"></a></li>
                        <li><a href="#"></a></li>
                    </ul>
                    <ul class="box">
                        <li class="link_name"></li>
                        <li><a href="#"></a></li>
                        <li><a href="#"></a></li>
                        <li><a href="#"></a></li>
                        <li><a href="#"></a></li>
                    </ul>
                    <ul class="box">
                        <li class="link_name">Phim Hay Mỗi Ngày</li>
                        <li><a href="{{route('genre','hanh-dong')}}">Phim hành động</a></li>
                        <li><a href="{{route('genre','tinh-cam')}}">Phim tình cảm</a></li>
                        <li><a href="{{route('genre','kinh-di')}}">Phim kinh dị</a></li>
                        <li><a href="{{route('genre','co-trang')}}">Phim cổ trang</a></li>
                    </ul>
                    <ul class="box">
                        <li class="link_name">Về Chúng Tôi</li>
                        <li><a href="{{route('policy')}}">Chính sách và quy định</a></li>
                        <li><a href="{{route('term')}}">Điều khoản sử dụng</a></li>
                        <li><a href="https://www.facebook.com/people/4K-Cinema/100095292381990/">Liên hệ với chúng tôi</a></li>
                        <li><a href="#"></a></li>
                        <li><a href="#"></a></li>
                    </ul>
                    @if(Auth::check())
                        @if($user->package_id==1)
                            <ul class="box input-box">
                                <li class="link_name" style="font-size:16px">Tận hưởng chất lượng 4K siêu nét</li>
                                <a href="{{route('package')}}"><li><input type="button" value="Đăng ký gói" /></li></a>
                            </ul>
                        @endif
                    @elseif(!(Auth::check()))
                        <ul class="box input-box">
                            <li class="link_name" style="font-size:16px">Tận hưởng chất lượng 4K siêu nét</li>
                            <a href="{{route('package')}}"><li><input type="button" value="Đăng ký gói" /></li></a>
                        </ul>
                    @endif
                </div>
            </div>
            <div class="bottom-details container">
                <div class="bottom_text">                    
                    <span class="copyright_text">Copyright © 2023 <a href="{{route('homepage')}}">4K Cinema</a>All rights reserved</span>                    
                </div>
            </div>
        </footer>
        <!-- FOOTER --end -->

        <!-- Jquery -->
        <script
            src="https://code.jquery.com/jquery-3.7.0.min.js"
            integrity="sha256-2Pmvv0kuTBOenSvLm6bvfBSSHrUJ+3A7x6P5Ebd07/g="
            crossorigin="anonymous"
        ></script>

        <!-- Swiper JS -->
        <script src="https://cdn.jsdelivr.net/npm/swiper@9/swiper-bundle.min.js"></script>

        <script src="{{asset('js/javascript.js')}}"></script>
        <script src="{{asset('js/form.js')}}"></script>
        <script src="{{asset('js/movie.js')}}"></script>
        <script src="{{asset('js/goi-vip.js')}}"></script>
        <script>
            var swiper = new Swiper('.card-movie .container', {
                slidesPerView: 1.6,
                spaceBetween: 10,
                navigation: {
                    nextEl: '.swiper-button-next',
                    prevEl: '.swiper-button-prev',
                },
                breakpoints: {
                    640: {
                        slidesPerView: 3,
                        spaceBetween: 10,
                    },
                    768: {
                        slidesPerView: 4,
                        spaceBetween: 10,
                    },
                    1024: {
                        slidesPerView: 5.3,
                        spaceBetween: 10,
                    },
                },
            });

            var swiper = new Swiper('.banner-web', {
                slidesPerView: 1,
                autoplay: {
                    delay: 2500,
                    disableOnInteraction: false,
                },
                loop: true,
            });

            var swiper = new Swiper('.top-movie .container', {
                slidesPerView: 1.6,
                spaceBetween: 10,
                navigation: {
                    nextEl: '.swiper-button-next',
                    prevEl: '.swiper-button-prev',
                },
                breakpoints: {
                    640: {
                        slidesPerView: 3,
                        spaceBetween: 10,
                    },
                    768: {
                        slidesPerView: 4,
                        spaceBetween: 10,
                    },
                    1024: {
                        slidesPerView: 6.3,
                        spaceBetween: 10,
                    },
                },
            });
        </script>

        <!-- TÌM KIẾM PHIM -->
        <script type="text/javascript">
            $(document).ready(function(){
               $('#timkiem').keyup(function(){ 
                  
                  var search = $('#timkiem').val();
                  if(search != ''){
                     $('#resultSearch').css('display', 'inherit');
                     var expression = new RegExp(search, "i");
                     $.getJSON('/json/movies.json', function(data){
                        $('#resultSearch').html('');
                        $.each(data, function(key, value){
                           if(value.title.search(expression) != -1){
                              $('#resultSearch').append('<a style="cursor: pointer; list-style-type: none;" class="movie" onmouseover="this.style.backgroundColor=\'#ffed4d\'" onmouseout="this.style.backgroundColor=\'\'"><img src="/uploads/poster/' + value.image + '" height="20" width="20"/>' + ' ' + value.title + '<br/> * <span>'+ 'Phim ' + value.genre.title + ' ' + value.country.title + ' ' + value.duration + '</span></a>');
                              }
                           });
                        });
                     }else{
                        $('#resultSearch').css('display', 'none');
                     }
                  });
                  $('#resultSearch').on('click', 'a', function(){
                     var click_text = $(this).text().split('*');
                     $('#timkiem').val($.trim(click_text[0]));
                     $('#resultSearch').html('');
                  });
               });
         </script>

        {{-- Information --}}
        <script>
            function toggleName() {
                var toggleName = document.getElementById('popup-setting-name');
                toggleName.classList.toggle('active');
            }

            function toggleEmail() {
                var toggleEmail = document.getElementById('popup-setting-email');
                toggleEmail.classList.toggle('active');
            }

            function togglePassword() {
                var togglePassword = document.getElementById('popup-setting-password');
                togglePassword.classList.toggle('active');
            }

            
            function toggleNotif() {
                const notif1 = document.getElementsByClassName('setting-acc notif')[0];
                const notif2 = document.querySelector('.content-acc .span-notif'); // Use querySelector to select by class name

                if (notif1.classList.contains('active')) {
                    notif1.classList.remove('active');
                    notif1.innerText = 'Tắt';
                    notif2.innerText = 'Có';
                } else {
                    notif1.classList.add('active');
                    notif1.innerText = 'Bật';
                    notif2.innerText = 'Không';
                }
            }
        </script>

        {{-- Bình luận Facebook --}}
        <div id="fb-root"></div>
        <script async defer crossorigin="anonymous" src="https://connect.facebook.net/vi_VN/sdk.js#xfbml=1&version=v17.0" nonce="FTPo5UB8"></script>

        {{--Cuộn Page đến chỗ xem Trailer Youtube --}}
        <script type="text/javascript">
            $(".watch_trailer").click(function(e){
               e.preventDefault();
               var aid = $(this).attr("href");
               $('html, body').animate({scrollTop: $(aid).offset().top}, 'slow');
            });
         </script>

        {{-- Cập nhật số lượng thông báo --}}
        <script>
        
            // Cập nhật số lượng thông báo
            var notificationCountElement = document.querySelector('.notification-count');
            notificationCountElement.textContent = notificationCount;
        </script>
        
        {{-- Dòng chữ thông báo chạy ở Footer --}}
        <script>
            document.querySelector(".footer-banner").addEventListener("mouseenter", function () {
                this.style.animationPlayState = "paused";
            });

            document.querySelector(".footer-banner").addEventListener("mouseleave", function () {
                this.style.animationPlayState = "running";
            });
        </script>
    </body>
</html>



