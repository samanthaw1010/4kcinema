{{-- TRANG ADMIN NÀY LÀ FORM ĐỂ THÊM MỘT QUỐC GIA MỚI --}}

@extends('layouts.app')
@section('content')
<!-- THÊM QUỐC GIA MỚI  -->
<div id="content-page" class="content-page" >
   <div class="container-fluid" id="addCountry">
      <div class="row" >
         <div class="col-sm-12">
            <div class="iq-card">
               <div class="iq-card-header d-flex justify-content-between">
                  <div class="iq-header-title">
                     <h4 class="card-title" >THÊM / CHỈNH SỬA THỂ LOẠI</h4>
                  </div>
                  <div class="iq-card-header-toolbar d-flex align-items-center">
                     <a href="{{route('genre.index')}}" class="btn btn-primary add-country-btn">Danh sách thể loại</a>
                  </div>
                  {{-- In ra thông báo --}}
                    @if(Session::has('success'))
                    <div id="login-alert" class="alert alert-success" role="alert">
                       {{Session::get('success')}}
                    </div>
                    @elseif(Session::has('error'))
                    <div id="login-alert" class="alert alert-primary" role="alert">
                       {{Session::get('error')}}
                    </div>
                    <script>
                       // Tự động ẩn thông báo sau 4 giây
                       setTimeout(function(){
                       document.getElementById('login-alert').style.display = 'none';
                       }, 4000);
                    </script>
                    @endif
               </div>
               <div class="iq-card-body">
                  <div class="row">
                     <div class="col-lg-12">
                       @if(!isset($genre))
                           {!! Form::open(['route'=>'genre.store', 'method'=>'POST']) !!}
                       @else
                           {!! Form::open(['route'=>['genre.update', $genre->id], 'method'=>'PUT']) !!} 
                       @endif
                       {{-- TÊN THỂ LOẠI --}}
                       <div class=form-group>
                           {!! Form::label('title', 'Tên thể loại', []) !!}
                           {!! Form::text(
                               'title', 
                               isset($genre) ? $genre->title : '',
                               ['class'=>'form-control', 'placeholder'=>'Nhập tên thể loại',
                               'id'=>'slug', 'onkeyup'=>'ChangeToSlug()']) !!}
                       </div>
                       {{-- SLUG ĐƯỢC TẠO TỰ ĐỘNG --}}
                       <div class=form-group>
                           {!! Form::label('slug', 'Slug', []) !!}
                           {!! Form::text(
                               'slug', 
                               isset($genre) ? $genre->slug : '',
                               ['class'=>'form-control', 'placeholder'=>'Slug này được tạo tự động',
                               'id'=>'convert_slug']) !!}
                       </div>
                       {{-- MÔ TẢ THỂ LOẠI --}}
                       <div class=form-group>
                           {!! Form::label('description', 'Mô tả thể loại', []) !!}
                           {!! Form::textarea(
                           'description',
                           isset($genre) ? $genre->description : '',
                           ['style'=>'resize:none','class'=>'form-control',
                           'placeholder'=>'Mô tả về nền điện ảnh của thể loại này',
                           'id'=>'description']) !!}
                       </div>
                       {{-- TRẠNG THÁI HIỂN THỊ / ẨN --}}
                       <div class=form-group>
                           {!! Form::label('active', 'Trạng thái', []) !!}
                           {!! Form::select('status',
                           ['1'=>'Hiển thị', '0'=>'Ẩn'],isset($genre) ? $genre->status : 'Hiển thị',
                           ['class'=>'form-control']) !!}
                       </div>

                       @if(!isset($genre))
                           {!! Form::submit('Thêm mới', ['class'=>'btn btn-primary']) !!}
                       @else
                           {!! Form::submit('Cập nhật', ['class'=>'btn btn-primary']) !!}
                       @endif
                       {!! Form::close() !!}
                     </div>
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