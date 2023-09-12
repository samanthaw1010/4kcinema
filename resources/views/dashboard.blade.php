{{-- TRANG NÀY HIỂN THỊ KHI VỪA MỚI LOGIN ADMIN THÀNH CÔNG --}}
@extends('layouts.app')

@section('content')

<!-- Page Content  -->
<div id="content-page" class="content-page">
   <div class="container-fluid">
      <div class="row">
         <div class="col-lg-12">
            <div class="row">

               <div class="col-sm-6 col-lg-6 col-xl-3">
                  <div class="iq-card iq-card-block iq-card-stretch iq-card-height">
                     <div class="iq-card-body">
                        <div class="d-flex align-items-center justify-content-between">
                           <div class="iq-cart-text text-capitalize">
                              <p class="mb-0 font-size-6" style="font-weight:bold; font-size:15px; color: rgb(212, 2, 2)">
                                 LƯỢT XEM TRANG CHỦ
                              </p>
                           </div>

                           <div class="iq-custom-select">
                              <select name="cars" class="form-control season-select" id="select-option">
                                 <option value="view1">Hôm nay <i class="fa-solid fa-caret-down" style="color:white"></i></option>
                                 <option value="view7">Hôm qua</option>
                                 <option value="view30">7 ngày qua</option>
                              </select>
                           </div>

                           {{-- <div>
                              <select id="select-option" data-toggle="dropdown" style="width:110px; height:10px;">
                                 <option value="view1">Hôm nay<i class="fa-solid fa-caret-down" style="color:black"></i></option>
                                 <option value="view7">Hôm qua</option>
                                 <option value="view30">7 ngày qua</option>
                              </select>
                           </div> --}}
                           
                        </div>
                        <div class="d-flex align-items-center justify-content-between mt-3">
                           <h4 style="color: rgb(212, 2, 2)" class=" mb-0 view-page" data-value="view1">{{$view_0_day}} lượt</h4>
                           <h4 style="color: rgb(207, 2, 2)" class=" mb-0 view-page" data-value="view7">{{$view_1_day}} lượt</h4>
                           <h4 style="color: rgb(202, 3, 3)" class=" mb-0 view-page" data-value="view30">{{$view_7_day}} lượt</h4>
                        </div>
                     </div>
                  </div>
               </div>

               {{-- Doanh thu --}}
               <div class="col-sm-6 col-lg-6 col-xl-3">
                  <div class="iq-card iq-card-block iq-card-stretch iq-card-height">
                     <div class="iq-card-body">
                        <div class="d-flex align-items-center justify-content-between">
                           <div class="iq-cart-text text-capitalize">
                              <p class="mb-0 font-size-6" style="font-weight:bold; font-size:15px; color: rgb(255, 200, 0)">
                                 DOANH THU
                              </p>
                           </div>
                           <div class="iq-custom-select ">
                              <select name="cars" class="form-control season-select" id="select-date">
                                 <option value="revenue1">Hôm nay</option>
                                 <option value="revenue7">Hôm qua</option>
                                 <option value="revenue30">7 ngày qua</option>
                                 <option value="revenue100">Tổng cộng</option>
                              </select>
                           </div>
                        </div>
                        <div class="d-flex align-items-center justify-content-between mt-3">
                           <h4 style="color: rgb(255, 200, 0)" class=" mb-0 view-revenue" data-value="revenue1">{{number_format($revenue_0_day)}} đồng</h4>
                           <h4 style="color: rgb(255, 200, 0)" class=" mb-0 view-revenue" data-value="revenue7">{{number_format($revenue_1_day)}} đồng</h4>
                           <h4 style="color: rgb(255, 200, 0)" class=" mb-0 view-revenue" data-value="revenue30">{{number_format($revenue_7_day)}} đồng</h4>
                           <h4 style="color: rgb(255, 200, 0)" class=" mb-0 view-revenue" data-value="revenue100">{{number_format($revenue_all_day)}} đồng</h4>
                        </div>
                     </div>
                  </div>
               </div> 

               {{-- Gói Gold --}}
               <div class="col-sm-6 col-lg-6 col-xl-3">
                  <div class="iq-card iq-card-block iq-card-stretch iq-card-height">
                     <div class="iq-card-body">
                        <div class="d-flex align-items-center justify-content-between">
                           <div class="iq-cart-text text-capitalize">
                              <p class="mb-0 font-size-6" style="font-weight:bold; font-size:15px; color: rgb(2, 61, 255)">
                                 GOLD - LƯỢT MUA
                              </p>
                           </div>
                           <div class="iq-custom-select ">
                              <select name="cars" class="form-control season-select" id="select-gold">
                                 <option value="gold0">Hôm nay</option>
                                 <option value="gold1">Hôm qua</option>
                                 <option value="gold7">7 ngày qua</option>
                              </select>
                           </div>
                        </div>
                        <div class="d-flex align-items-center justify-content-between mt-3">
                           <h4 style="color: rgb(2, 61, 255)" class=" mb-0 view-gold" data-value="gold0">{{number_format($gold_0_day)}} lượt</h4>
                           <h4 style="color: rgb(2, 61, 255)" class=" mb-0 view-gold" data-value="gold1">{{number_format($gold_1_day)}} lượt</h4>
                           <h4 style="color: rgb(2, 61, 255)" class=" mb-0 view-gold" data-value="gold7">{{number_format($gold_7_day)}} lượt</h4>
                        </div>
                     </div>
                  </div>
               </div> 

               {{-- Gói Platinum --}}
               <div class="col-sm-6 col-lg-6 col-xl-3">
                  <div class="iq-card iq-card-block iq-card-stretch iq-card-height">
                     <div class="iq-card-body">
                        <div class="d-flex align-items-center justify-content-between">
                           <div class="iq-cart-text text-capitalize">
                              <p class="mb-0 font-size-6" style="font-weight:bold; font-size:15px; color: rgb(0, 216, 0)">
                                 PLATINUM - LƯỢT MUA
                              </p>
                           </div>
                           <div class="iq-custom-select ">
                              <select name="cars" class="form-control season-select" id="select-platinum">
                                 <option value="platinum0">Hôm nay</option>
                                 <option value="platinum1">Hôm qua</option>
                                 <option value="platinum7">7 ngày qua</option>
                              </select>
                           </div>
                        </div>
                        <div class="d-flex align-items-center justify-content-between mt-3">
                           <h4 style="color: rgb(0, 216, 0)" class=" mb-0 view-platinum" data-value="platinum0">{{number_format($platinum_0_day)}} lượt</h4>
                           <h4 style="color: rgb(0, 216, 0)" class=" mb-0 view-platinum" data-value="platinum1">{{number_format($platinum_1_day)}} lượt</h4>
                           <h4 style="color: rgb(0, 216, 0)" class=" mb-0 view-platinum" data-value="platinum7">{{number_format($platinum_7_day)}} lượt</h4>
                        </div>
                     </div>
                  </div>
               </div> 

            </div>

            {{-- TOP HOT PHIM --}}
            <div class="iq-card">
               <div class="iq-card-header d-flex justify-content-between align-items-center">
                  <div class="iq-header-title">
                     <h4 class="card-title">Top phim được xem nhiều nhất</h4>
                  </div>
                  <div id="top-rated-item-slick-arrow" class="slick-aerrow-block  iq-rtl-direction"></div>
               </div>
               <div class="iq-card-body">
                  <ul class="list-unstyled row top-rated-item mb-0 iq-rtl-direction">
                     @foreach($hotMovie as $key => $mov)
                     <li class="col-sm-6 col-lg-4 col-xl-3 iq-rated-box">
                        <div class="iq-card mb-0">
                           <div class="iq-card-body p-0">
                              <div class="iq-thumb">
                                 <a href="javascript:void(0)">
                                    <img src="{{asset('uploads/poster/'.$mov->poster)}}" class="img-fluid w-100 img-border-radius" alt="">
                                 </a>
                              </div>
                              <div class="iq-feature-list">
                                 <h6 class="font-weight-600 mb-0">{{$mov->title}}</h6>
                                 <div class="d-flex align-items-center my-2 iq-ltr-direction">
                                    <p class="mb-0 mr-2"><i class="fa-solid fa-eye"></i> {{$mov->view_count}}</p>
                                 </div>
                              </div>
                           </div>
                        </div>
                     </li>
                     @endforeach
                  </ul>
               </div>
            </div>
            
            

         </div>
      </div>
   </div>
</div>

{{-- Lượt xem trang chủ --}}
<script>
   $(document).ready(function () {
       // Ẩn tất cả các phần tử có class "view-page" ban đầu
       $(".view-page").hide();

       // Mặc định hiển thị {{$view_1_day}}
       var defaultSelectedValue = "view1";
       $(".view-page[data-value='" + defaultSelectedValue + "']").show();

       // Xử lý sự kiện khi người dùng thay đổi giá trị của select
       $("#select-option").change(function () {
           var selectedValue = $(this).val(); // Lấy giá trị đã chọn
           $(".view-page").hide(); // Ẩn tất cả các phần tử có class "view-page"
           $(".view-page[data-value='" + selectedValue + "']").show(); // Hiển thị phần tử tương ứng với giá trị đã chọn
       });
   });
</script>

{{-- Doanh thu --}}
<script>
   $(document).ready(function () {
       // Ẩn tất cả các phần tử có class "view-revenue" ban đầu
       $(".view-revenue").hide();

       // Mặc định hiển thị {{$revenue_0_day}}
       var defaultSelectedValue = "revenue1";
       $(".view-revenue[data-value='" + defaultSelectedValue + "']").show();

       // Xử lý sự kiện khi người dùng thay đổi giá trị của select
       $("#select-date").change(function () {
           var selectedValue = $(this).val(); // Lấy giá trị đã chọn
           $(".view-revenue").hide(); // Ẩn tất cả các phần tử có class "view-revenue"
           $(".view-revenue[data-value='" + selectedValue + "']").show(); // Hiển thị phần tử tương ứng với giá trị đã chọn
       });
   });
</script>

{{-- Gói Gold --}}
<script>
   $(document).ready(function () {
       // Ẩn tất cả các phần tử có class "view-gold" ban đầu
       $(".view-gold").hide();

       // Mặc định hiển thị {{$gold_0_day}}
       var defaultSelectedValue = "gold0";
       $(".view-gold[data-value='" + defaultSelectedValue + "']").show();

       // Xử lý sự kiện khi người dùng thay đổi giá trị của select
       $("#select-gold").change(function () {
           var selectedValue = $(this).val(); // Lấy giá trị đã chọn
           $(".view-gold").hide(); // Ẩn tất cả các phần tử có class "view-revenue"
           $(".view-gold[data-value='" + selectedValue + "']").show(); // Hiển thị phần tử tương ứng với giá trị đã chọn
       });
   });
</script>

{{-- Gói Platinum --}}
<script>
   $(document).ready(function () {
       // Ẩn tất cả các phần tử có class "view-platinum" ban đầu
       $(".view-platinum").hide();

       // Mặc định hiển thị {{$platinum_0_day}}
       var defaultSelectedValue = "platinum0";
       $(".view-platinum[data-value='" + defaultSelectedValue + "']").show();

       // Xử lý sự kiện khi người dùng thay đổi giá trị của select
       $("#select-platinum").change(function () {
           var selectedValue = $(this).val(); // Lấy giá trị đã chọn
           $(".view-platinum").hide(); // Ẩn tất cả các phần tử có class "view-revenue"
           $(".view-platinum[data-value='" + selectedValue + "']").show(); // Hiển thị phần tử tương ứng với giá trị đã chọn
       });
   });
</script>
@endsection
