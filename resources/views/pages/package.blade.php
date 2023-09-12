{{-- CHỌN GÓI VIP --}}
@extends('layout')
@section('content')

@if(session('success'))
    <div class="alert alert-success">
    {{session('success')}}
    </div>
@elseif(session('error'))
    <div class="alert alert-error">
    {{session('error')}}
    </div>
@endif 
<style>
    .banner-movie{
        display: none;
    }
</style>
<!-- Required meta tags -->
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
<title>4K Cinema VIP Packages</title>
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
<!-- Thông tin từng gói VIP  -->
<div id="content-page" style="margin-top: 100px;">
    <div class="container-fluid">
       <div class="row">
          <div class="col-lg-12">
             <div class="iq-card">
                <div class="iq-card-body">
                   <div class="table-responsive pricing pt-2">
                     @if(isset($user))
                        @if($user->package_id != 1)
                        <div class="alert alert-primary">
                           XIN LƯU Ý: KHI CHUYỂN ĐỔI GÓI, GÓI HIỆN TẠI SẼ BỊ HỦY. 
                           VÀ SỐ TIỀN CỦA GÓI SẼ KHÔNG ĐƯỢC HOÀN TRẢ!
                        </div>
                        @endif 
                     @endif 
                      <table id="my-table" class="table">
                         <thead>
                            <tr>
                               <th class="text-center prc-wrap"></th>
                               @foreach($package as $key => $pack)
                               <th class="text-center prc-wrap">
                                  <div class="prc-box">
                                    <br>
                                     <div class="h3 pt-4 text-white">{{$pack->price}}<small> đ/ tháng</small></div>
                                     <span class="type">{{$pack->name}}</span>
                                  </div>
                               </th>
                               @endforeach
                            </tr>
                         </thead>
                         <tbody>
                            <tr>
                               <th class="text-center" scope="row">Chat với chúng tôi</th>
                                @foreach($package as $key => $pack)
                                    @if($pack->chat == 0)
                                    <td class="text-center child-cell"><i class="fa-solid fa-xmark"></i></td>
                                    @elseif($pack->chat == 1)
                                    <td class="text-center child-cell active"><i class="fa-solid fa-check"></i></td>
                                    @endif
                                @endforeach
                            </tr>
                            <tr>
                               <th class="text-center" scope="row">Nhận thông báo</th>
                                @foreach($package as $key => $pack)
                                    <td class="text-center child-cell active"><i class="fa-solid fa-check"></i></td>
                                @endforeach
                            </tr>
                            <tr>
                               <th class="text-center" scope="row">Bookmark phim yêu thích</th>
                               @foreach($package as $key => $pack)
                                    @if($pack->bookmark == 0)
                                    <td class="text-center child-cell"><i class="fa-solid fa-xmark"></i></td>
                                    @elseif($pack->bookmark == 1)
                                    <td class="text-center child-cell active"><i class="fa-solid fa-check"></i></td>
                                    @endif
                                @endforeach
                            </tr>
                            {{-- <tr>
                               <th class="text-center" scope="row">Đánh giá phim</th>
                               @foreach($package as $key => $pack)
                                    @if($pack->rating == 0)
                                    <td class="text-center child-cell"><i class="fa-solid fa-xmark"></i></td>
                                    @elseif($pack->rating == 1)
                                    <td class="text-center child-cell active"><i class="fa-solid fa-check"></i></td>
                                    @endif
                                @endforeach
                            </tr> --}}
                            <tr>
                               <th class="text-center" scope="row">Chất lượng phim</th>
                               @foreach($package as $key => $pack)
                                    @if($pack->quality == 0)
                                    <td class="text-center child-cell">720p</i></td>
                                    @elseif($pack->quality == 1)
                                    <td class="text-center child-cell active">Upto 1080p</td>
                                    @elseif($pack->quality == 2)
                                    <td class="text-center child-cell active">Upto 4K</td>
                                    @endif
                                @endforeach
                            </tr>
                            <tr>
                               <td class="text-center"><i class="fa-solid fa-arrow-right" style="color: #ffffff;"></i></td>
                                @foreach($package as $key => $pack)
                                    @if($pack->price != 0)
                                       <td class="text-center">                               
                                          <form action="{{ route('check_out', ['id' => $pack->id]) }}" method="POST">
                                             @csrf
                                             @method('POST')
                                             <input type="hidden" name="pack_id" value="{{ $pack->id }}">

                                             <button type="submit" class="btn btn-primary mt-3" name="submit">Chọn gói này</button>
                                          </form>
                                       </td>
                                    @elseif($pack->price == 0)
                                       <td><br></td>                           
                                    @endif
                                @endforeach
                            </tr>
                         </tbody>
                      </table>
                   </div>
                </div>
             </div>
          </div>
       </div>
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
