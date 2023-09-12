{{-- ĐÂY LÀ KHUNG SƯỜN GIAO DIỆN CỦA ADMIN PAGE --}}
<!doctype html>
<html lang="en">
<head>
   <!-- Required meta tags -->
   <meta charset="utf-8">
   <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
   <title>4K Cinema Admin</title>
   <!-- CSRF Token -->
   <meta name="csrf-token" content="{{ csrf_token() }}">
   <!-- Favicon -->
   <link rel="shortcut icon" href="{{asset('imgs/img-logo/logo-mini.png')}}" />
   <!-- Bootstrap CSS -->
   <link rel="stylesheet" href="{{asset('cssAdmin/bootstrap.min.css')}}">
   <!--datatable CSS -->
   <link rel="stylesheet" href="{{asset('cssAdmin/dataTables.bootstrap4.min.css')}}">
   <!-- Typography CSS -->
   <link rel="stylesheet" href="{{asset('cssAdmin/typography.css')}}">
   <!-- Style CSS -->
   <link rel="stylesheet" href="{{asset('cssAdmin/style.css')}}">
   <!-- Responsive CSS -->
   <link rel="stylesheet" href="{{asset('cssAdmin/responsive.css')}}">
   <!-- Font Awesome -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
   <script src="https://kit.fontawesome.com/9eb8b4698c.js" crossorigin="anonymous"></script>
   {{-- Sorttable css lấy từ jqueryui.com--}}
   <link rel="stylesheet" href="https://code.jquery.com/ui/1.13.0/themes/base/jquery-ui.css">
   {{-- Datatables.net giúp tìm kiếm dữ liệu --}}
   <link rel="stylesheet" href="https://cdn.datatables.net/1.13.4/css/jquery.dataTables.min.css">
   <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>
<body>
   <!-- Wrapper Start -->
   <div class="wrapper">
      {{-- Menu --}}
      @include('layouts.navbar')
      {{-- Phần nội dung thay đổi giữa các page --}}
      @yield('content')
   </div>
   <!-- Wrapper END -->
   <!-- Footer -->
   <footer class="iq-footer">
      <div class="container-fluid">
         <div class="row">
            <div class="col-lg-6">
               <ul class="list-inline mb-0">
                  {{-- <li class="list-inline-item"><a href="privacy-policy.html"><i class="fa-solid fa-circle-info"></i> Chính sách & Điều khoản sử dụng</a></li> --}}
               </ul>
            </div>
            <div class="col-lg-6 text-right">
               Copyright 2023 <a href="#">4K CINEMA</a> All Rights Reserved.
            </div>
         </div>
      </div>
   </footer>
   <!-- Footer END -->
   <!-- Optional JavaScript -->
   <!-- jQuery first, then Popper.js, then Bootstrap JS -->
   <script src="{{asset('jsAdmin/jquery.min.js')}}"></script>
   <script src="{{asset('jsAdmin/popper.min.js')}}"></script>
   <script src="{{asset('jsAdmin/bootstrap.min.js')}}"></script>
   <script src="{{asset('jsAdmin/jquery.dataTables.min.js')}}"></script>
   <script src="{{asset('jsAdmin/dataTables.bootstrap4.min.js')}}"></script>
   <!-- Appear JavaScript -->
   <script src="{{asset('jsAdmin/jquery.appear.js')}}"></script>
   <!-- Countdown JavaScript -->
   <script src="{{asset('jsAdmin/countdown.min.js')}}"></script>
   <!-- Select2 JavaScript -->
   <script src="{{asset('jsAdmin/select2.min.js')}}"></script>
   <!-- Counterup JavaScript -->
   <script src="{{asset('jsAdmin/waypoints.min.js')}}"></script>
   <script src="{{asset('jsAdmin/jquery.counterup.min.js')}}"></script>
   <!-- Wow JavaScript -->
   <script src="{{asset('jsAdmin/wow.min.js')}}"></script>
   <!-- Slick JavaScript -->
   <script src="{{asset('jsAdmin/slick.min.js')}}"></script>
   <!-- Owl Carousel JavaScript -->
   <script src="{{asset('jsAdmin/owl.carousel.min.js')}}"></script>
   <!-- Magnific Popup JavaScript -->
   <script src="{{asset('jsAdmin/jquery.magnific-popup.min.js')}}"></script>
   <!-- Smooth Scrollbar JavaScript -->
   <script src="{{asset('jsAdmin/smooth-scrollbar.js')}}"></script>
   <!-- apex Custom JavaScript -->
   <script src="{{asset('jsAdmin/apexcharts.js')}}"></script>
   <!-- Chart Custom JavaScript -->
   <script src="{{asset('jsAdmin/chart-custom.js')}}"></script>
   <!-- Custom JavaScript -->
   <script src="{{asset('jsAdmin/custom.js')}}"></script>
   <script src="{{asset('jsAdmin/rtl.js')}}"></script>

{{-- CHUYỂN ĐỔI TIÊU ĐỀ TIẾNG VIỆT CÓ DẤU THÀNH KHÔNG DẤU CÓ GẠCH NỐI (Slug) --}}
<script type="text/javascript">
   function ChangeToSlug() { 
       var slug;
       //Lấy text từ thẻ input title
       slug = document.getElementById("slug").value;
       slug = slug.toLowerCase();
       //Đổi ký tự có dấu thành không dấu
           slug = slug.replace(/á|à|ả|ã|ạ|ă|ắ|ằ|ẳ|ẵ|ặ|â|ấ|ầ|ẩ|ẫ|ậ/gi, 'a');
           slug = slug.replace(/é|è|ẻ|ẽ|ẹ|ê|ế|ề|ể|ễ|ệ/gi, 'e');
           slug = slug.replace(/í|ì|ỉ|ĩ|ị/gi, 'i');
           slug = slug.replace(/ó|ò|ỏ|õ|ọ|ô|ố|ồ|ổ|ỗ|ộ|ơ|ớ|ờ|ở|ỡ|ợ/gi, 'o');
           slug = slug.replace(/ú|ù|ủ|ũ|ụ|ư|ứ|ừ|ử|ữ|ự/gi, 'u');
           slug = slug.replace(/ý|ỳ|ỷ|ỹ|ỵ/gi, 'y');
           slug = slug.replace(/đ/gi, 'd');
       //Xóa các ký tự đặc biệt
           slug = slug.replace(/\`|\~|\!|\@|\#|\||\$|\%|\^|\&|\*|\(|\)|\+|\= |\,|\.|\/|\?|\>|\< |\'|\"|\:|\;|_/gi, '');
       //Đổi khoảng trắng thành ký tự gạch ngang
           slug = slug.replace(/ /gi, "-");
       //Đổi nhiều ký tự gạch ngang liên tiếp thành 1 ký tự gạch ngang
       //Phòng trường hợp user nhập vào quá nhiều ký tự trắng
           slug = slug.replace(/\-\-\-\-\-/gi, '-');
           slug = slug.replace(/\-\-\-\-/gi, '-');
           slug = slug.replace(/\-\-\-/gi, '-');
           slug = slug.replace(/\-\-/gi, '-');
       //Xóa các ký tự gạch ngang ở đầu và cuối
           slug = '@' + slug + '@';
           slug = slug.replace(/\@\- |\-\@|\@/gi, '');
       //In slug ra textbox có id "convert_slug_vi"
           document.getElementById("convert_slug").value = slug;
    }
</script>

{{-- Thay đổi NĂM PHÁT HÀNH PHIM --}}
<script type="text/javascript">
   $('.select_year').change(function(){
       var year = $(this).find(':selected').val();
       var movieID = $(this).attr('id');
       // Khi đang viết jQuery có thể dùng alert để kiểm tra mình đã lấy được dữ liệu đúng chưa
       // alert(year);
       // alert(id_phim);
       $.ajax({
           url:"{{url('/update-year-phim')}}",
           method: "GET",
           data:{year: year, movieID: movieID},
           success:function(){
               alert('Thay đổi năm phát hành: ' + year + ' thành công!');
           }
       });
   })
</script>

{{-- Thay đổi SEASON PHIM --}}
<script type="text/javascript">
   $('.select_season').change(function(){
       var season = $(this).find(':selected').val();
       var movieID = $(this).attr('id');
       $.ajax({
           url:"{{url('/update-season-phim')}}",
           method: "GET",
           data:{season: season, movieID: movieID},
           success:function(){
               alert('Phim đã được cập nhật thành mùa ' + season + '!');
           }
       });
   })
</script>

{{-- Thay đổi TOP VIEWS PHIM ajax--}}
<script type="text/javascript">
   $('.topview_choose').change(function(){
       var top_view = $(this).find(':selected').val();
       var movie_id = $(this).attr('id');
       
       $.ajax({
           url:"{{url('/update-topview-phim')}}",
           method: "GET",
           data:{top_view: top_view, movie_id: movie_id},
           success:function(){
               alert('Thay đổi top view phim thành công!');
           }
       });
   })
</script>

{{-- Thay đổi danh mục phim ajax --}}
<script type="text/javascript">
   $('.category_choose').change(function(){
   var category_id = $(this).val();
   var movie_id = $(this).attr('id');
   
   $.ajax({
       url:"{{route('update_category_ajax')}}",
       method:"GET",
       data:{category_id:category_id, movie_id:movie_id},
       success:function(data){
           alert('Thay đổi thành công!');
       }
   });
});
</script>

{{-- Thay đổi quốc gia phim ajax --}}
<script type="text/javascript">
   $('.country_choose').change(function(){
   var country_id = $(this).val();
   var movie_id = $(this).attr('id');
   
   $.ajax({
       url:"{{route('update_country_ajax')}}",
       method:"GET",
       data:{country_id:country_id, movie_id:movie_id},
       success:function(data){
           alert('Thay đổi thành công!');
       }
   });
});
</script>

{{-- Chọn phim và cập nhật tập phim mới --}}
<script type="text/javascript">
   $('.select_movie').change(function(){
       var id = $(this).val();        
       $.ajax({
           url:"{{route('select-movie')}}",
           method: "GET",
           data:{id: id},
           success:function(data)
           {
               $('#show_episode').html(data);
           }
       });
   })
</script> 


</body>
</html>



