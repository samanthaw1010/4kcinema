@extends('layout')
@section('content')
<!-- VIDEO ĐẦU TRANG -->
<div class="banner-movie">
    <div class="banner">
        <div class="movie">
            @if(isset($countryFirstVideo->trailer))
                <video width="100%" height="100%" src="{{asset('movie/'.$countryFirstVideo->trailer)}}" muted="false" autoplay="true" loop poster="{{ asset('uploads/poster/'.$countryFirstVideo->poster) }}"></video>
            
            <div class="container">
                <div class="movie-content">
                    <div class="movie-title">{{$countryFirstVideo->title}}</div>
                    <div class="movie-genre">
                        <a href="" class="genre">{{$countryFirstVideo->title_eng}}</a>
                        <a href="" class="genre">{{$countryFirstVideo->year}}</a>
                        <a href="" class="genre">{{$countryFirstVideo->duration}}</a>
                    </div>
                    <div class="movie-details">
                        {{$countryFirstVideo->description}}
                    </div>
                    <div class="button-movie">
                        <a href="{{route('movie',$countryFirstVideo->slug)}}" title="{{$countryFirstVideo->title}}" class="button">
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
<div class="pr" style="background-color: rgb(0, 0, 0)" >
    <div class="container">
        <h5>PHIM {{$country_slug->title}}</h5>
        <p style="color: rgb(255, 208, 208)">{{$country_slug->description}}</p>
    </div>
</div>

<!-- CARD -->
<div class="card-movie-category" >
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
                        <div class="sub" style="margin-bottom: 10px">
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