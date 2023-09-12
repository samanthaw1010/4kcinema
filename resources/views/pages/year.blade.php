@extends('layout')
@section('content')
<!-- VIDEO ĐẦU TRANG -->
<div class="banner-movie">
    <div class="banner">
        <div class="movie">
            @if(isset($yearFirstVideo->trailer))
                <video width="100%" height="100%" src="{{asset('movie/'.$yearFirstVideo->trailer)}}" muted="false" autoplay="true" loop poster="{{ asset('uploads/poster/'.$yearFirstVideo->poster) }}"></video>
            
            <div class="container">
                <div class="movie-content">
                    <div class="movie-title">{{$yearFirstVideo->title}}</div>
                    <div class="movie-genre">
                        <a href="" class="genre">{{$yearFirstVideo->title_eng}}</a>
                        <a href="" class="genre">{{$yearFirstVideo->year}}</a>
                        <a href="" class="genre">{{$yearFirstVideo->duration}}</a>
                    </div>
                    <div class="movie-details">
                        {{$yearFirstVideo->description}}
                    </div>
                    <div class="button-movie">
                        <a href="{{route('movie',$yearFirstVideo->slug)}}" title="{{$yearFirstVideo->title}}" class="button">
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
<!-- PR -->
<div class="pr" style="background-color: rgb(0, 0, 0)">
    <div class="container">
        <h5 style="color: rgb(255, 208, 208)">PHIM HAY NĂM {{$year}}</h5>
    </div>
</div>

<!-- CARD -->
<div class="card-movie-category">
    <div class="container">
        <div class="card">
            @foreach($movie as $key => $mov)
            <div class="movie">
                <a style="color:#ffff" href="{{route('movie',$mov->slug)}}" title="{{$mov->title}}">
                <img
                    src={{asset('uploads/poster/'.$mov->poster)}}
                    alt={{$mov->title}}
                    title={{$mov->title}}
                    onclick="window.location.href='movie.html'"
                />
                <div class="rest-card">
                    <video src="{{asset('movie/'.$mov->trailer)}}" muted autoplay></video>
                    <div class="content">
                        <div class="sub" style="margin-left: 15px; margin-bottom: 10px">
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
<!-- CARD --end -->

<!-- PAGINATION -->
<section class="container">
    <div class="pagination">
        <nav>
            <ul>
                <li class="active"><a href="#">1</a></li>
                <li><a href="#">2</a></li>
                <li><a href="#">3</a></li>
                <li><a href="#">4</a></li>
                <li><a href="#">Next</a></li>
            </ul>
        </nav>
    </div>
</section>
<!-- PAGINATION --end -->

<div class="chi-tiet" id="popup-chitiet">
    <label class="close-btn fas fa-times" title="close" onclick="toggleDetail()"></label>
    <div class="film">
        <div class="container">
            <div class="container_video">
                <video poster="img/cu-lua-nen-duyen-movie/hkdakoaz_1920x1080-culuanenduyen.png"></video>
                <div class="button-movie">
                    <a href="movie.html" title="Người anh hùng yếu đuối" class="button">
                        <ion-icon name="play-outline"></ion-icon>
                        Xem ngay
                    </a>
                    <a href="" title="Người anh hùng yếu đuối" class="button">
                        <ion-icon name="add-outline"></ion-icon>
                        Danh sách
                    </a>
                </div>
                <div class="button-movie">
                    <a href="movie.html" title="Người anh hùng yếu đuối" class="button">
                        <ion-icon name="play-outline"></ion-icon>
                        Xem ngay
                    </a>
                    <a href="" title="Người anh hùng yếu đuối" class="button">
                        <ion-icon name="add-outline"></ion-icon>
                        Danh sách
                    </a>
                </div>
            </div>
            <div class="video-content">
                <div class="content-left">
                    <div class="title-vn">Cú lừa nên duyên</div>
                    <div class="title-eng">Delightly Deceitful</div>
                    <div class="rating-box">
                        <div class="view">943.007 lượt xem</div>
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
                        <a href="">2022</a>
                        <a href="">Hàn Quốc</a>
                        <a href="">1 Phần</a>
                        <a href="">HD</a>
                    </div>

                    <div class="ep-title">Tập 1: Mối duyên</div>
                    <div class="details">
                        Lee Ro Um (Chun Woo Hee) là một kẻ lừa đảo thiên tài, kiếm được bộn tiền nhờ vẻ ngoài
                        xinh đẹp và tài ăn nói khoa trương, nhưng cô lại thiếu khả năng đồng cảm với người khác.
                        Trong khi đó, Han Moo Young (Kim Dong Wook) lại là một luật sư có sự đồng cảm thái quá
                        với mọi người xung quanh, sự vui buồn hay những thương tổn của người khác đều ảnh hưởng
                        sâu sắc đến Moo Young. Một cách tình cờ, hai người trái ngược này lại gặp và hợp tác với
                        nhau vì một mục đích chung: trả thù một thế lực tàn độc.
                    </div>
                </div>
                <div class="content-right">
                    <div class="top">
                        <div class="comment">
                            <i class="fa-solid fa-comments"></i>
                            Bình luận
                        </div>
                        <div class="share">
                            <i class="fa-sharp fa-solid fa-paper-plane"></i>
                            Chia sẻ
                        </div>
                    </div>
                    <div class="center">
                        <p>
                            Diễn viên:
                            <a href="">Chun Woo Hee</a>
                            <a href="">Kim Dong Wook</a>
                            <a href="">Yoon Park</a>
                            <a href="">Park So Jin</a>
                            <a href="">Lee Yeon</a>
                            <a href="">Lee Tea Ran</a>
                        </p>
                    </div>
                    <div class="middle">
                        <p>
                            Đạo diễn:
                            <a href="">Lee Soo Huyn</a>
                        </p>
                    </div>
                    <div class="bottom">
                        <p>
                            Thể loại:
                            <a href="">Phim tâm lý</a>
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    // Phân trang
    let thisPage = 1;
    let limit = 20;
    let list = document.querySelectorAll('.card-movie-category .movie');

    function loadItem() {
        let beginGet = limit * (thisPage - 1);
        let endGet = limit * thisPage - 1;
        list.forEach((item, key) => {
            if (key >= beginGet && key <= endGet) {
                item.style.display = 'block';
            } else {
                item.style.display = 'none';
            }
        });
        pagination();
    }
    loadItem();
    function pagination() {
        let count = Math.ceil(list.length / limit);
        document.querySelector('.pagination').innerHTML = '';

        if (thisPage != 1) {
            let prev = document.createElement('li');
            prev.innerText = 'PREV';
            prev.setAttribute('onclick', 'changePage(' + (thisPage - 1) + ')');
            document.querySelector('.pagination').appendChild(prev);
        }

        for (i = 1; i <= count; i++) {
            let newPage = document.createElement('li');
            newPage.innerText = i;
            if (i == thisPage) {
                newPage.classList.add('active');
            }
            newPage.setAttribute('onclick', 'changePage(' + i + ')');
            document.querySelector('.pagination').appendChild(newPage);
        }

        if (thisPage != count) {
            let next = document.createElement('li');
            next.innerText = 'NEXT';
            next.setAttribute('onclick', 'changePage(' + (thisPage + 1) + ')');
            document.querySelector('.pagination').appendChild(next);
        }
    }
    function changePage(i) {
        thisPage = i;
        loadItem();
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