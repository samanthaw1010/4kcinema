{{-- TRANG ADMIN NÀY LÀ FORM ĐỂ THÊM MỘT QUỐC GIA MỚI --}}

@extends('layouts.app')
@section('content')
<!-- DANH SÁCH TẤT CẢ QUỐC GIA  -->
<div id="content-page" class="content-page">
    <div class="container-fluid">
       <div class="row">
          <div class="col-sm-12">
             <div class="iq-card">
                <div class="iq-card-header d-flex justify-content-between">
                   <div class="iq-header-title">
                      <h4 class="card-title">DANH SÁCH QUỐC GIA</h4>
                   </div>
                   <div class="iq-card-header-toolbar d-flex align-items-center">
                      <a href="{{route('country.create')}}" class="btn btn-primary add-country-btn">Thêm quốc gia</a>
                   </div>
                </div>
                <div class="iq-card-body">
                   <div class="table-view">
                      <table class="data-tables table movie_table " style="width:100%">
                         <thead>
                            <tr>
                               <th style="width:10%;">STT</th>
                               <th style="width:20%;">Tên quốc gia</th>
                               <th style="width:40%;">Mô tả quốc gia</th>
                               <th style="width:10%;">Trạng thái</th>
                               <th style="width:20%;">Quản lý</th>
                            </tr>
                         </thead>
                         <tbody>
                            @foreach($list as $key => $cate)
                            <tr>
                               <td>{{$key+1}}</td>
                               <td>{{$cate->title}}</td>
                               <td>
                                  <p>{{$cate->description}}</p>
                               </td>
                               <td>
                                {{-- ẨN --}}
                                @if($cate->status == 1)
                                {!! Form::open([
                                    'method'=>'POST',
                                    'route'=>['hide_country',$cate->id],
                                    'onsubmit'=>'return confirm("Bạn muốn ẩn quốc gia này?")',
                                    'class'=>'d-inline-block'
                                    ]) !!}
                                    {!! Form::button('<i class="fa-solid fa-eye" style="color:#a5ffa3; font-size: 25px"></i>', ['type' => 'submit', 'class'=>'d-inline-block btn-icon']) !!}
                                    {!! Form::close() !!}
                                @elseif($cate->status == 0)
                                    {!! Form::open([
                                    'method'=>'POST',
                                    'route'=>['show_country',$cate->id],
                                    'onsubmit'=>'return confirm("Bạn muốn hiển thị quốc gia này?")',
                                    'class'=>'d-inline-block'
                                ]) !!}
                                {!! Form::button('<i class="fa-solid fa-eye-slash" style="color:#a5ffa3; font-size: 25px"></i>', ['type' => 'submit', 'class'=>'d-inline-block btn-icon']) !!}
                                {!! Form::close() !!}
                                @endif
                               </td>
                               <td>
                                  <div class="flex align-items-center list-user-action">
                                    {{-- SỬA --}}
                                    <a href="{{route('country.edit', $cate->id)}}" class="d-inline-block"><i class="fa-solid fa-square-pen" style="color: #b0efff; font-size: 28px"></i></a>
                                  </div>
                               </td>
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

{{-- <script type="text/javascript">
    $(".add-country-btn").click(function(e){
       e.preventDefault();
       var aid = $(this).attr("href");
       $('html, body').animate({scrollTop: $(aid).offset().top}, 'slow');
    });
 </script> --}}
@endsection