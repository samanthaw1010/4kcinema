{{-- TRANG USER INFORMATION CỦA WEBSITE XEM PHIM --}}

@extends('layout')
@section('content')

<!-- SETTING -->
<div class="setting-account">
    <div class="container">
        <header>Trang cá nhân</header>
        <input type="radio" name="slider" checked id="setting-1" />
        <input type="radio" name="slider" id="setting-2" />
        <input type="radio" name="slider" id="setting-3" />
        <nav>
            <label for="setting-1" class="setting-1">Tài khoản và Cài đặt</label>
            <label for="setting-2" class="setting-2">Gói đã mua</label>
            <label for="setting-3" class="setting-3">Bookmark</label>
            <!-- <div class="slider"></div> -->
        </nav>

        <div class="setting">
            <div class="content content-1">
                <br>
                {{-- In ra thông báo --}}
                @if(Session::has('success'))
                <div id="login-alert" style="color:rgb(214, 0, 0); background-color:rgba(255, 255, 255, 0.825)" role="alert">
                {{Session::get('success')}}
                </div>
                @elseif(Session::has('error'))
                <div id="login-alert" style="color:rgb(214, 0, 0); background-color:rgba(255, 255, 255, 0.825)"  role="alert">
                {{Session::get('error')}}
                </div>
                <script>
                // Tự động ẩn thông báo sau 2 giây
                setTimeout(function(){
                document.getElementById('login-alert').style.display = 'none';
                }, 2500);
                </script>
                @endif
                
                <div class="content-1-1">
                    <div class="title">Thông tin cá nhân</div>
                    <div class="content-1-2">                        
                        <div class="content-setting">
                            <div class="content-acc">
                                <div class="title">Chủ tài khoản:</div>
                                <span style="color:rgb(255, 255, 255)">{{$user->name}}</span>
                            </div>
                        </div>

                        <div class="content-setting">
                            <div class="content-acc">
                                <div class="title">Email:</div>
                                <span style="color:rgb(255, 255, 255)">{{$user->email}}</span>
                            </div>
                        </div>

                        <div class="content-setting">
                            <div class="content-acc">
                                <div class="title">Gói đang sử dụng:</div>
                                <span style="color:rgb(255, 255, 255)">
                                    @if($user->package_id == 1)
                                        FREE
                                    @elseif($user->package_id == 2)
                                        GOLD
                                    @elseif($user->package_id == 4)
                                        PLATINUM
                                    @endif
                                </span>                                
                            </div>
                        </div>

                        <div class="content-setting">
                            <div class="content-acc">
                                <div class="title">Mật khẩu:</div>
                                <a style="color:rgba(225, 0, 0, 0.825)" href="{{ route('password.request') }}"><span>&#160; Đổi Mật Khẩu</span></a>
                            </div>
                        </div>
                        
                    </div>
                    
                </div>
                <a href="{{ route('edit_information', ['id' => $user->id]) }}" class="button" style="margin-left:30%; ">
                    <ion-icon name="play-outline"></ion-icon>
                    <span>Chỉnh Sửa Thông Tin</span>
                </a>
                <br><br>
                <br>
            </div>
            
            <div class="content content-2">
                <div class="content-1-1-2">
                    <table class="data-tables table table-responsive">
                    <caption style="padding:20px">GÓI ĐANG SỬ DỤNG</caption>
                    @if($user->package_id != 1)
                        @if(isset($current_package))
                        <tr>
                            <th>Tên gói</th>
                            <th>Thời hạn</th>
                            <th>Giá gói</th>
                            <th>Tổng tiền thanh toán</th>
                            <th>Thời gian giao dịch</th>
                            <th>Hình thức thanh toán</th>
                            <th>Hủy gói</th>
                        </tr>
                        <tr>
                            <td style="color:red; font-weight:bold">{{$current_package->name}}</td>
                            @if($user->package_id != 1)
                                <td>{{$current_package->purchase_total / $current_package->price}} tháng</td>
                            @else
                                <td>Không có</td>
                            @endif
                            <td>{{number_format($current_package->price)}} đồng</td>
                            <td>{{number_format($current_package->purchase_total)}} đồng</td>
                            <td>{{$current_package->purchase_date}}</td>
                            <td>{{$current_package->payment_method}}</td>
                            <td>
                                @if($user->package_id != 1)
                                {!! Form::open([
                                    'method'=>'POST',
                                    'route'=>['cancel-package',$user->id],
                                    'onsubmit'=>'return confirm("Tiền sẽ không được hoàn trả, bạn có muốn hủy gói?")',
                                    'class'=>'d-inline-block'
                                ]) !!}
                                {!! Form::button('<i class="fa-solid fa-square-xmark" style="color: #d60000; font-size: 25px"></i>', ['type' => 'submit', 'class'=>'d-inline-block btn-icon', 'id'=>'cancelPackageBtn']) !!}
                                {!! Form::close() !!}
                                @endif
                            </td>
                        </tr>
                        @else
                            Chưa mua gói
                        @endif
                    @else
                        <tr>
                            <th>Tên gói</th>
                            <th>Thời hạn</th>
                            <th>Giá gói</th>
                            <th>Tổng tiền thanh toán</th>
                            <th>Thời gian giao dịch</th>
                            <th>Hình thức thanh toán</th>
                            <th>Trạng thái</th>
                        </tr>
                        <tr>
                            <td>FREE</td>
                            <td>Không có</td>
                            <td>0</td>
                            <td>0</td>
                            <td>Không có</td>
                            <td>Không có</td>
                            <td>ĐANG SỬ DỤNG</td>
                        </tr>
                    </table>
                    @endif
                </div>
                
                <div class="content-1-1-2">
                    @if(isset($past_package))
                        <table class="data-tables table table-responsive">
                            <caption style="padding:20px">CÁC GÓI ĐÃ TỪNG MUA</caption>                    
                            <tr>
                                <th>Tên gói</th>
                                <th>Thời hạn</th>
                                <th>Giá gói</th>
                                <th>Tổng tiền thanh toán</th>
                                <th>Thời gian giao dịch</th>
                                <th>Hình thức thanh toán</th>
                                <th>Trạng thái</th>
                            </tr>
                            @foreach($past_package as $key => $item)
                            <tr>
                                <td>{{$item->name}}</td>
                                <td>{{$item->purchase_total / $item->price}} tháng</td>
                                <td>{{number_format($item->price)}} đồng</td>
                                <td>{{number_format($item->purchase_total)}} đồng</td>
                                <td>{{$item->purchase_date}}</td>
                                <td>{{$item->payment_method}}</td>
                                <td>
                                    ĐÃ HỦY
                                </td>
                            </tr>
                            @endforeach                        
                        </table>
                    @endif
                    <br><br><br><br><br><br>
                </div>
            </div>
            {{-- BOOKMARK --}}
            <div class="content content-3">
                <div class="card-movie-category">
                    <div class="container">
                        <div class="card">
                            @if ($bookmarkedMovies->isEmpty())
                                <p>Chưa có bookmark nào.</p>
                            @else
                            @foreach ($bookmarkedMovies as $key => $bm_movie)
                            <div class="movie">
                                <a style="color:#ffff" href="{{route('movie',$bm_movie->slug)}}" title="{{$bm_movie->title}}">
                                <img
                                    src="{{asset('uploads/poster/'.$bm_movie->poster)}}"
                                    alt="{{$bm_movie->title}}"
                                    title="{{$bm_movie->title}}"
                                    onclick="window.location.href='{{route('movie',$bm_movie->slug)}}'"
                                />
                                <div class="rest-card">
                                    <video src="{{asset('movie/'.$bm_movie->trailer)}}" muted></video>
                                    <div class="content">
                                        <div class="sub">
                                            <p>{{$bm_movie->year}}</p>
                                            <p>{{$bm_movie->title}}</p>
                                            <p>
                                               @if($bm_movie->subtitle==1)
                                                  Thuyết minh
                                               @elseif($bm_movie->subtitle==0)
                                                  Vietsub
                                               @endif
                                            </p>
                                            <p>
                                               @if($bm_movie->type==1)
                                                  Phim lẻ
                                               @elseif($bm_movie->type==2)
                                                  Phim bộ
                                               @endif
                                            </p>
                                            <p>
                                               @if($bm_movie->resolution==0)
                                                  720p
                                               @elseif($bm_movie->resolution==1)
                                                  1080p
                                               @elseif($bm_movie->resolution==2)
                                                  4K
                                               @else
                                                  Trailer
                                               @endif
                                            </p>
                                        </div>
                                        <div class="button-movie">
                                            <a href="{{route('movie',$bm_movie->slug)}}" title="{{$bm_movie->title}}" class="button">
                                                <ion-icon name="play-outline"></ion-icon>
                                                Xem ngay
                                            </a>
                                            <form action="{{route('delete_bookmark',$bm_movie->id)}}" method="POST">
                                            @csrf
                                                
                                                <button style="background-color: #d60000" class="button" type="submit"><ion-icon name="play-outline"></ion-icon> Xóa Bookmark</button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @endforeach
                            @endif
                        </div>
                    </div>
                    <br><br><br><br><br><br><br><br><br>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- SETTING --end -->
{{-- VALIDATE NAME INPUT --}}
{{-- Điều kiện: tên có ít nhất 2 ký tự và không chứa số hoặc ký tự đặc biệt --}}
<script>
    function validateName() {
        var name = document.getElementById("edit_name").value;
        var pattern = /^[a-zA-Z\s]+$/;
        var resultElement = document.getElementById("result1");
        
        if (name.length >= 2 && pattern.test(name) && name.value !="") {
        resultElement.innerHTML = "";
        } else {
        resultElement.innerHTML = "Tên cần ít nhất 2 ký tự và không chứa số, ký tự đặc biệt!";
        }
    }
</script>

{{-- VALIDATE EMAIL INPUT --}}
{{-- Check theo pattern --}}
<script>
    function validateEmail() {
        var email = document.getElementById("edit_email").value;
        var pattern = /^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,})+$/;
        var resultElement = document.getElementById("result2");
        
        if (pattern.test(email) && email.value !="") {
        resultElement.innerHTML = "";
        } else {
        resultElement.innerHTML = "Email không hợp lệ!";
        }
    }
</script>

<script>
    $(document).ready(function() {
    $("#cancelPackageBtn").click(function() {
        $.ajax({
            url: "/cancel-package",
            type: "POST",
            data: {
                user: {{$user->id}}
            },
            success: function(response) {
                if (response.success) {
                    alert("Thay đổi thành công");
                } else {
                    alert("Không thể thực hiện yêu cầu. Vui lòng thử lại sau.");
                }
            },
            error: function() {
                alert("Đã xảy ra lỗi. Vui lòng thử lại sau.");
            }
        });
    });
});

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