{{-- TRANG ADMIN NÀY HIỂN THỊ DANH SÁCH BOOKMARK --}}

@extends('layouts.app')
@section('content')
<!-- DANH SÁCH TẤT CẢ BOOKMARK  -->
<div id="content-page" class="content-page">
    <div class="container-fluid">
       <div class="row">
          <div class="col-sm-12">
             <div class="iq-card">
                <div class="iq-card-header d-flex justify-content-between">
                   <div class="iq-header-title">
                      <h4 class="card-title">THỐNG KÊ BOOKMARK</h4>
                   </div>
                </div>
                <div class="iq-card-body">
                   <div class="table-view">
                      <table class="data-tables table movie_table " style="width:100%">
                         <thead>
                            <tr>
                               <th style="width:10%;">STT</th>
                               <th style="width:20%;">Tên tài khoản</th>
                               <th style="width:30%;">Số lượng bookmark</th>
                               <th style="width:40%;">Ngày tạo</th>
                               <th style="width:40%;">Ngày cập nhật</th>
                            </tr>
                         </thead>
                         <tbody>
                           @foreach ($bookmarkCounts as $key => $bookmarkCount)
                           <tr>
                               <td style="width:10%;">{{$key+1}}</td>
                               <td style="width:20%;">{{ $bookmarkCount->user->name }}</td>
                               <td style="width:20%;">{{ $bookmarkCount->movie_count }}</td>
                               <td style="width:30%;">{{ $bookmarkCount->user->created_at }}</td>
                               <td style="width:30%;">{{ $bookmarkCount->user->updated_at }}</td>
                           </tr>
                           @endforeach
                         </tbody>
                      </table>
                   </div>
                </div>
             </div>
          </div>
       </div>
    </div>
</div>
<style>
    /* Xóa background mặc định của button */
    .btn-icon {
    background-color: transparent;
    border: none;
    padding: 0; /* Xóa padding mặc định của button*/
    }
    th {
    text-align: center !important;
    }    
</style>

<script type="text/javascript">
    $(".add-country-btn").click(function(e){
       e.preventDefault();
       var aid = $(this).attr("href");
       $('html, body').animate({scrollTop: $(aid).offset().top}, 'slow');
    });
 </script>
@endsection