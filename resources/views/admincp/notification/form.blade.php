{{-- TRANG ADMIN NÀY LÀ FORM ĐỂ QUẢN LÝ THÔNG BÁO --}}

@extends('layouts.app')
@section('content')

<!-- THÊM THÔNG BÁO MỚI -->
<div id="content-page" class="content-page" >
   <!-- DANH SÁCH TẤT CẢ THÔNG BÁO  -->
   <div class="container-fluid">
      <div class="row">
         <div class="col-sm-12">
            <div class="iq-card">
               <div class="iq-card-header d-flex justify-content-between">
                  <div class="iq-header-title">
                     <h4 class="card-title">DANH SÁCH THÔNG BÁO</h4>
                  </div>
               </div>
               <div class="iq-card-body">
                  <div class="table-view">
                     <table class="data-tables table movie_table " style="width:100%">
                        <thead>
                           <tr>
                              <th>STT</th>
                              <th>Ảnh minh họa</th>
                              <th>Tên</th>
                              <th>Nội dung</th>
                              <th>Ngày tạo</th>
                              <th>Ngày hết hạn</th>
                              <th>Gói áp dụng</th>
                              <th>Quản lý</th>
                           </tr>
                        </thead>
                        <tbody>
                           @foreach($list as $key => $note)
                           <tr>
                             <td>{{$key+1}}</td>
                             <td><img width="70px" src="{{asset('uploads/notification/'.$note->image_notification)}}" alt=""></td>
                             <td>{{$note->title}}</td>
                             <td>{{$note->content}}</td>
                             <td>{{$note->created_at}}</td>
                             <td>{{$note->expired_at}}</td>
                              <td>
                                @if($note->package_id == 1)
                                   FREE
                                @elseif($note->package_id == 2)
                                   GOLD
                                @elseif($note->package_id == 4)
                                   PLATINUM
                                @endif
                              </td>
                              <td>
                                 <div class="flex align-items-center list-user-action">
                                   {{-- EDIT --}}
                                   <a href="{{route('notification.edit', $note->id)}}" class="d-inline-block"><i class="fa-solid fa-square-pen" style="color: #027a00; font-size: 28px"></i></a>
                                   {{-- DELETE --}}
                                   {!! Form::open([
                                       'method'=>'DELETE',
                                       'route'=>['notification.destroy',$note->id],
                                       'onsubmit'=>'return confirm("Bạn muốn xóa thông báo này?")',
                                       'class'=>'d-inline-block'
                                   ]) !!}
                                   {!! Form::button('<i class="fa-solid fa-square-xmark" style="color: #d60000; font-size: 25px"></i>', ['type' => 'submit', 'class'=>'d-inline-block btn-icon']) !!}
                                   {!! Form::close() !!}
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
   <br><br><br>
    <div class="container-fluid" id="addGenre">
       <div class="row" >
          <div class="col-sm-12">
             <div class="iq-card">
                <div class="iq-card-header d-flex justify-content-between">
                   <div class="iq-header-title">
                      <h4 class="card-title" >THÊM / CHỈNH SỬA THÔNG BÁO</h4>
                   </div>
                   {{-- In ra thông báo --}}
                  @if(Session::has('success'))
                     <div id="movie-index-alert" class="alert alert-success" role="alert">
                        {{Session::get('success')}}
                     </div>
                  @elseif(Session::has('error'))
                     <div id="movie-index-alert" class="alert alert-primary" role="alert">
                        {{Session::get('error')}}
                     </div>
                     <script>
                        // Tự động ẩn thông báo sau 3 giây
                        setTimeout(function(){
                        document.getElementById('movie-index-alert').style.display = 'none';
                        }, 4000);
                     </script>
                  @endif
                </div>
                <div class="iq-card-body">
                   <div class="row">
                      <div class="col-lg-12">
                        @if(!isset($notification))
                            {!! Form::open(['route'=>'notification.store', 'method'=>'POST', 'enctype'=>'multipart/form-data']) !!}
                        @else
                            {!! Form::open(['route'=>['notification.update', $notification->id], 'method'=>'PUT', 'enctype'=>'multipart/form-data']) !!} 
                        @endif
                        {{-- TÊN THÔNG BÁO --}}
                        <div class=form-group>
                            {!! Form::label('title', 'Tên thông báo', []) !!}
                            {!! Form::text(
                                'title', 
                                isset($notification) ? $notification->title : '',
                                ['class'=>'form-control', 'placeholder'=>'Nhập tên thông báo',
                                'autofocus'=>'true', 'id'=>'title']) !!}
                        </div>
                        {{-- NỘI DUNG THÔNG BÁO --}}
                        <div class=form-group>
                            {!! Form::label('content', 'Nội dung', []) !!}
                            {!! Form::text(
                            'content',
                            isset($notification) ? $notification->content : '',
                            ['class'=>'form-control', 'placeholder'=>'Nhập nội dung thông báo',
                            'id'=>'content']) !!}
                        </div>
                        <!--ẢNH MINH HỌA CHO THÔNG BÁO-->
                        <div class="form-group">          
                           @if(isset($notification))
                               <span>Ảnh minh họa:</span><br>
                               @if(isset($notification->image_notification))
                               <img width="200px" src="{{asset('uploads/notification/'.$notification->image_notification)}}" alt=""><br>
                               @endif
                               <span style="color: rgb(120, 120, 252)">Đổi ảnh?</span><br>
                               <input type="file" name="image_notification_change" onchange="previewImage(this)" class="form-control image_preview">
                               <img id="preview_image" width="200px" src=""><br>
                           @else
                               {!! Form::label('image', 'Ảnh minh họa', []) !!}
                               <input type="file" name="image_notification" onchange="previewImage(this)" required class="form-control image_preview">
                               <img id="preview_image" width="200px" src=""><br>
                           @endif
                       </div>
                       {{-- Preview hình ảnh trước khi upload hoặc edit --}}
                       <script type="text/javascript">
                           function previewImage(input){
                               var file = $(".image_preview").get(0).files[0];
                               if(file){
                                   var reader = new FileReader();
                                   reader.onload = function(){
                                       $("#preview_image").attr("src", reader.result);
                                   }
                                   reader.readAsDataURL(file);
                               }
                           }
                       </script>
                        {{-- ÁP DỤNG CHO GÓI NÀO --}}
                        <div class="col-sm-3 form-group" style="margin-left:-15px;">
                            {!! Form::label('package_id', 'Gói áp dụng', []) !!}
                            {!! Form::select('package_id',
                            ['1'=>'FREE', '2'=>'GOLD', '4'=>'PLATINUM'],isset($notification) ? $notification->package_id : 'FREE',
                            ['class'=>'form-control']) !!}
                        </div>
                        {{-- NGÀY HẾT HẠN --}}
                        <div class="col-sm-3 form-group" style="margin-left:-15px;">
                            {!! Form::label('expired_at', 'Ngày hết hạn', []) !!}
                            {!! Form::input('date', 'expired_at', isset($notification) ? $notification->expired_at : date('Y-d-m'), ['class' => 'form-control']) !!}
                        </div>
                        <!--Submit-->
                        @if(!isset($notification))
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

<script type="text/javascript">
    $(".add-genre-btn").click(function(e){
       e.preventDefault();
       var aid = $(this).attr("href");
       $('html, body').animate({scrollTop: $(aid).offset().top}, 'slow');
    });
 </script>
@endsection