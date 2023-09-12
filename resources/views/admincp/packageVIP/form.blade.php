{{-- TRANG ADMIN NÀY LÀ FORM ĐỂ THÊM MỘT GÓI VIP MỚI --}}

@extends('layouts.app')
@section('content')

<!-- THÊM GÓI MỚI  -->
<div id="content-page" class="content-page" >
   <!-- DANH SÁCH TẤT CẢ GÓI VIP  -->
   <div class="container-fluid">
      <div class="row">
         <div class="col-sm-12">
            <div class="iq-card">
               <div class="iq-card-header d-flex justify-content-between">
                  <div class="iq-header-title">
                     <h4 class="card-title">DANH SÁCH GÓI VIP</h4>
                  </div>
               </div>
               <div class="iq-card-body">
                  <div class="table-view">
                     <table class="data-tables table movie_table " style="width:100%">
                        <thead>
                           <tr>
                              <th>STT</th>
                              <th>Tên gói</th>
                              <th>Giá gói</th>
                              <th>Chất lượng phim</th>
                              <th>Chat với Admin</th>
                              <th>Bookmark phim</th>
                              {{-- <th>Đánh giá phim</th> --}}
                              @if(Auth::user()->role==1 || Auth::user()->role==0)
                                 <th>Trạng thái</th>
                              @endif
                              @if(Auth::user()->role==0)
                                 <th>Quản lý</th>
                              @endif
                           </tr>
                        </thead>
                        <tbody>
                           @foreach($list as $key => $pack)
                           <tr>
                              <td>{{$key+1}}</td>
                              <td>{{$pack->name}}</td>
                              <td>{{$pack->price}}</td>
                              <td>
                                @if($pack->quality == 0)
                                   Tối đa 720p
                                @elseif($pack->quality == 1)
                                   Tối đa 1080p
                                @elseif($pack->quality == 2)
                                   Tối đa 4K
                                @endif
                              </td>
                              <td>{{ $pack->chat ? 'Có' : 'Không' }}</td>
                              <td>{{ $pack->bookmark ? 'Có' : 'Không' }}</td>
                              @if(Auth::user()->role==1 || Auth::user()->role==0)
                              <td>
                                 {{-- ẨN --}}
                                 @if($pack->status == 1)
                                 {!! Form::open([
                                     'method'=>'POST',
                                     'route'=>['hide_package',$pack->id],
                                     'onsubmit'=>'return confirm("Bạn muốn ẩn gói này?")',
                                     'class'=>'d-inline-block'
                                     ]) !!}
                                     {!! Form::button('<i class="fa-solid fa-eye" style="color:#a5ffa3; font-size: 25px"></i>', ['type' => 'submit', 'class'=>'d-inline-block btn-icon']) !!}
                                     {!! Form::close() !!}
                                 @elseif($pack->status == 0)
                                     {!! Form::open([
                                     'method'=>'POST',
                                     'route'=>['show_package',$pack->id],
                                     'onsubmit'=>'return confirm("Bạn muốn hiển thị gói này?")',
                                     'class'=>'d-inline-block'
                                 ]) !!}
                                 {!! Form::button('<i class="fa-solid fa-eye-slash" style="color:#a5ffa3; font-size: 25px"></i>', ['type' => 'submit', 'class'=>'d-inline-block btn-icon']) !!}
                                 {!! Form::close() !!}
                                 @endif
                                </td>
                              @endif
                              @if(Auth::user()->role==0)
                              <td>
                                 <div class="flex align-items-center list-user-action">
                                   {{-- SỬA --}}
                                   <a href="{{route('packageVIP.edit', $pack->id)}}" class="d-inline-block"><i class="fa-solid fa-square-pen" style="color: #b0efff; font-size: 28px"></i></a>
                                 </div>
                              </td>
                              @endif
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
   @if(Auth::user()->role==0)
    <div class="container-fluid" id="addGenre">
       <div class="row" >
          <div class="col-sm-12">
             <div class="iq-card">
                <div class="iq-card-header d-flex justify-content-between">
                   <div class="iq-header-title">
                      <h4 class="card-title" >CHỈNH SỬA GÓI VIP</h4>
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
                        
                     @if(isset($package))  
                        {!! Form::open(['route'=>['packageVIP.update', $package->id], 'method'=>'PUT']) !!} 
                     @endif
                        {{-- TÊN GÓI --}}
                        <div class=form-group>
                            {!! Form::label('pack_name', 'Tên gói', []) !!}
                            {!! Form::text(
                                'pack_name', 
                                isset($package) ? $package->name : '',
                                ['class'=>'form-control', 'placeholder'=>'Nhập tên gói',
                                'autofocus'=>'true', 'id'=>'pack_name']) !!}
                        </div>
                        {{-- GIÁ GÓI --}}
                        <div class=form-group>
                            {!! Form::label('pack_price', 'Giá gói', []) !!}
                            {!! Form::text(
                            'pack_price',
                            isset($package) ? $package->price : '',
                            ['class'=>'form-control', 'placeholder'=>'Nhập giá gói',
                            'id'=>'pack_price']) !!}
                        </div>
                        {{-- LỰA CHỌN CHẤT LƯỢNG PHIM --}}
                        <div class=form-group>
                            {!! Form::label('pack_quality', 'Chất lượng phim', []) !!}
                            {!! Form::select('pack_quality',
                            ['0'=>'Tối đa 720p', '1'=>'Tối đa 1080p', '2'=>'Tối đa 4K'],isset($package) ? $package->quality : 'Tối đa 720p',
                            ['class'=>'form-control']) !!}
                        </div>
                        {{-- CHAT VỚI ADMIN --}}
                        <div class=form-group>
                            {!! Form::label('pack_chat', 'Chat với Admin', []) !!}
                            {!! Form::select('pack_chat',
                            ['0'=>'Không', '1'=>'Có'],isset($package) ? $package->chat : 'Có',
                            ['class'=>'form-control']) !!}
                        </div>
                        {{-- BOOKMARK PHIM --}}
                        <div class=form-group>
                            {!! Form::label('pack_bookmark', 'Bookmark phim yêu thích', []) !!}
                            {!! Form::select('pack_bookmark',
                            ['0'=>'Không', '1'=>'Có'],isset($package) ? $package->bookmark : 'Không',
                            ['class'=>'form-control']) !!}
                        </div>

                        @if(isset($package))
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
   @endif
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