{{-- TRANG THANH TOÁN GÓI VIP --}}
@php
    use Illuminate\Support\Facades\Session;
@endphp

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
<!-- BUY VIP -->

<div class="buy-vip" style="background-color: rgb(22, 20, 20)">
    <div class="container">
        <div class="pr">
            <div class="container">
                <h5>THÔNG TIN THANH TOÁN GÓI {{$package->name}}</h5>
            </div>
        </div>
        <div class="buy-vip-bottom">
            <div class="buy-vip-left">
                <div class="box-list-price">
                    <label for="one" class="price-item first checked" style="background-color: aliceblue">
                        <div class="plan">
                            <div class="month">Thời hạn gói</div>
                        </div>
                        <select class="price" name="months" id="months">
                            @for ($i = 1; $i <= 12; $i++)
                                <option value="{{ $i }}">{{ $i }} tháng</option>
                            @endfor
                        </select>
                    </label>
                </div>
                {{-- CHỌN PHƯƠNG THỨC THANH TOÁN --}}
                {{-- <div class="box-list-payment">
                    <h6>Chọn phương thức thanh toán</h6>
                    <input type="radio" name="payment" id="vnpay" value="VNPAY"/>                    
                    <label for="vnpay" class="payment-item first checked">
                        <div class="plan" id="vnpay">
                            <span class="circle"></span>
                            <div class="payment">
                                <img src="{{asset('imgs/img-payment/vnpay_icon.svg')}}" alt="" />
                            </div>
                        </div>
                    </label>
                    <input type="radio" name="payment" id="paypal" value="PAYPAL"/>
                    <label for="paypal" class="payment-item second">
                        <div class="plan" id="paypal">
                            <span class="circle"></span>
                            <div class="payment">
                                <img src="{{asset('imgs/img-payment/paypal-icon.svg')}}" alt="" />
                            </div>
                        </div>
                    </label>
                </div> --}}
                <div class="box-list-payment"></div>
            </div>
            <div class="buy-vip-right">
                <div class="infomation" style="background-color: aliceblue">
                    <div class="title">Thông tin thanh toán</div>
                    <div class="box-list-info">
                        <div class="info-content">
                            <span class="info">
                                <div class="title">Tên người dùng </div>
                                <span> {{$user->name}} </span>
                            </span>
                            <div class="info">
                                <div class="title">Tên gói</div>
                                <span style="color: red;"> {{$package->name}} </span>
                            </div>
                            <div class="info">
                                <div class="title">Số tháng đã chọn</div>
                                <span id="result-month" style="color: red;">{{($months)}}</span>
                            </div>
                            <div class="info">
                                <div class="title">Ngày hiệu lực</div>
                                <span class="effective-date"></span>
                            </div>
                            <div class="info">
                                <div class="title">Sử dụng đến</div>
                                <span class="date-use">Khi bạn hủy hoặc gói hết hạn</span>
                            </div>
                            <div class="info">
                                <div class="title">Trị giá</div>
                                <span id="result-price">{{ number_format($package->price) }}đ/tháng</span>
                            </div>
                        </div>
                        <div class="info-price">
                            <div class="title">Thành tiền</div>
                            <span class="total-price" name="subTotal" id="subTotal">{{($subTotal)}}đ</span>
                        </div>

                        <span>Chọn phương thức thanh toán:</span>
                        {{-- Phương thức thanh toán PayPal --}}
                        <form action="{{ route('processTransaction') }}" method="POST">
                            @csrf
                            <button class="button primary" id="btnThanhToanPaypal">Ví Điện Tử PayPal <img src="{{asset('imgs/img-payment/paypal-icon.svg')}}" style="width=35px; height:25px; margin-top: -18px"></button>
                            <input type="hidden" id="vnd_to_usd" name="vnd_to_usd">
                            <input type="hidden" id="total_paypal" name="total_paypal">
                            <input type="hidden" name="selectedPackage" value="{{$package->id}}">
                            <input type="hidden" name="selectedName" value="{{$package->name}}">
                            <input type="hidden" name="selectedPrice" value="{{$package->price}}">
                        </form>  

                        {{-- Phương thức thanh toán VNPAY --}}
                        <form action="{{route('vnpay_payment')}}" method="POST">
                            @csrf
                            <input type="hidden" name="subTotal_vnpay" id="subTotal_vnpay" value="{{$subTotal}}">
                            <input type="hidden" name="selectedPackage" value="{{$package->id}}">
                            <input type="hidden" name="selectedName" value="{{$package->name}}">
                            <input type="hidden" name="selectedPrice" value="{{$package->price}}">
                            <button class="button primary" id="btnThanhToanVnpay" name="redirect">Ví Điện Tử VN-Pay <img src="{{asset('imgs/img-payment/vnpay_icon.svg')}}" style="width=45px; height:30px; margin-top: -18px"></button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
{{-- LẤY SỐ THÁNG NHÂN VỚI SỐ TIỀN ĐỂ RA TỔNG TIỀN --}}
<script>
    // Hàm cập nhật số tháng mới vào id="result-month"
    function updateResultMonth(months) {
        document.getElementById('result-month').textContent = months;
    }

    // Tính toán và hiển thị tổng tiền mặc định khi trang được tải lên
    document.addEventListener('DOMContentLoaded', function() {
    var months = parseInt(document.getElementById('months').value); // Lấy giá trị số tháng đã chọn mặc định
    updateResultMonth(months);
    var price = parseInt('{{ $package->price }}'); // Lấy giá trị giá gói từ blade template
    var subTotal = months * price; // Tính toán tổng tiền
    document.getElementById('total_paypal').value = subTotal;
    document.getElementById('subTotal').textContent = subTotal.toLocaleString(); // Cập nhật giá trị tổng tiền
    document.getElementById('subTotal_vnpay').value = subTotal;
    var vnd_to_usd = subTotal / 23755; // Tính giá trị USD tương ứng
    document.getElementById('vnd_to_usd').value = vnd_to_usd.toFixed(2);
    });

    // Lắng nghe sự kiện thay đổi của phần tử select
    document.getElementById('months').addEventListener('change', function() {
    var months = parseInt(this.value); // Lấy giá trị số tháng đã chọn
    updateResultMonth(months);
    var price = parseInt('{{ $package->price }}'); // Lấy giá trị giá gói từ blade template
    var subTotal = months * price; // Tính toán tổng tiền
    document.getElementById('total_paypal').value = subTotal;
    document.getElementById('subTotal').textContent = subTotal.toLocaleString(); // Cập nhật giá trị tổng tiền
    document.getElementById('subTotal_vnpay').value = subTotal;
    var vnd_to_usd = subTotal / 23755; // Tính giá trị USD tương ứng
    document.getElementById('vnd_to_usd').value = vnd_to_usd.toFixed(2);
    });
</script>

{{-- LẤY NGÀY HIỆN TẠI LÀM NGÀY HIỆU LỰC --}}
<script>
    // Hàm để định dạng ngày tháng dưới dạng "dd/mm/yyyy"
    function formatDate(date) {
        var day = date.getDate();
        var month = date.getMonth() + 1;
        var year = date.getFullYear();
        return day + '/' + month + '/' + year;
    }

    // Tính toán và hiển thị ngày tháng hôm nay khi trang được tải lên
    document.addEventListener('DOMContentLoaded', function() {
        var currentDate = new Date(); // Lấy ngày tháng hiện tại
        var formattedDate = formatDate(currentDate); // Định dạng ngày tháng
        document.querySelector('.effective-date').textContent = formattedDate; // Cập nhật vào phần tử có class="effective-date"
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