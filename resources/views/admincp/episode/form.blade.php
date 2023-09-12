{{-- TRANG ADMIN NÀY LÀ FORM ĐỂ THÊM /SỬA MỘT PHIM MỚI --}}

@extends('layouts.app')

@section('content')
<div id="content-page" class="content-page">
    <div class="container-fluid">
       <div class="row">
          <div class="col-sm-12">
             <div class="iq-card">
                <div class="iq-card-header d-flex justify-content-between">
                   <div class="iq-header-title">
                      <h4 class="card-title">THÊM / SỬA TẬP PHIM</h4>
                   </div>
                   <div class="iq-card-header-toolbar d-flex align-items-center">
                    <a href="{{route('movies.index')}}" class="btn btn-primary">Danh sách phim</a>
                   </div>
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
                        // Tự động ẩn thông báo sau 3 giây
                        setTimeout(function(){
                        document.getElementById('login-alert').style.display = 'none';
                        }, 4000);
                    </script>
                @endif
            <div class="card card-responsive">    
                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    <!--Lưu ý bên dưới là form của Laravel Collective: giúp rút gọn code-->
                    {{-- FORM THÊM MỚI MỘT TẬP PHIM --}}
                    @if(!isset($episode))
                        {!! Form::open(['route'=>'episode.store', 'method'=>'POST', 'enctype'=>'multipart/form-data', 'files' => true]) !!}
                    @else
                        {!! Form::open(['route'=>['episode.update', $episode->id], 'method'=>'PUT', 'enctype'=>'multipart/form-data', 'files' => true]) !!} 
                    @endif

                    {{-- Tên phim --}}
                        <div class=form-group>
                            {!! Form::label('movie_title', 'Movie Title', []) !!}
                            {!! Form::text('movie_title', isset($movie) ? $movie->title : '',
                                ['class'=>'form-control', 'readonly']) !!}
                            {!! Form::hidden('movie_id', isset($movie) ? $movie->id : '') !!}
                        </div>
                    {{-- Chất lượng phim tối đa --}}
                        <div class=form-group>
                            {!! Form::label('resolution', 'Chất lượng tối đa', []) !!}
                            {!! Form::text('resolution', ($movie->resolution == 0) ? '720p' : (($movie->resolution == 1) ? '1080p' : (($movie->resolution == 2) ? '4K' : 'Chưa cập nhật')), ['class'=>'form-control', 'readonly']) !!}
                        </div>
                    <!--Video Phim tải lên từ máy tính-->
                        <div class=form-group>
                            {!! Form::label('video720', 'Video 720p', []) !!}
                            {!! Form::file('video720',['class'=>'form-control', 'placeholder'=>'Upload video 720p from computer']) !!}
                        </div>
                        <div class=form-group>
                            {!! Form::label('video1080', 'Video 1080p', []) !!}
                            {!! Form::file('video1080', ['class'=>'form-control', 'placeholder'=>'Upload video 1080p from computer']) !!}
                        </div>
                        <div class=form-group>
                            {!! Form::label('video4k', 'Video 4K', []) !!}
                            {!! Form::file('video4k', ['class'=>'form-control', 'placeholder'=>'Upload video 4K from computer']) !!}
                        </div>
                    <!--Poster của mỗi tập phim-->
                    <div class=form-group>               
                        @if(isset($episode))
                            <span>Poster hiện tại</span><br>
                            @if(isset($episode->ep_poster))
                            <img width="80px" src="{{asset('uploads/ep-poster/'.$episode->ep_poster)}}" alt=""><br>
                            @endif
                            <span style="color: rgb(120, 120, 252)">Đổi poster?</span><br>
                            <input type="file" name="ep_poster_change" onchange="previewFile(this)" class="form-control poster_preview">
                            <img id="preview_poster" width="80px" src=""><br>
                        @else
                            {!! Form::label('ep_poster', 'Poster của tập phim', []) !!}
                            <input type="file" name="ep_poster" onchange="previewFile(this)" required class="form-control poster_preview">
                            <img id="preview_poster" width="80px" src=""><br>
                        @endif
                    </div>
                    {{-- Preview hình ảnh trước khi upload hoặc edit --}}
                    <script type="text/javascript">
                        function previewFile(input){
                            var file = $(".poster_preview").get(0).files[0];
                            if(file){
                                var reader = new FileReader();
                                reader.onload = function(){
                                    $("#preview_poster").attr("src", reader.result);
                                }
                                reader.readAsDataURL(file);
                            }
                        }
                    </script>
                    <!--Tập Phim / khi cập nhật thì không được sửa tập phim-->
                        @if(isset($episode))
                            <div class=form-group>
                                {!! Form::label('episode', 'Tập phim', []) !!}
                                {!! Form::text('episode', isset($episode) ? $episode->episode : '',
                                    ['class'=>'form-control', isset($episode) ? 'readonly' : '']) !!}
                            </div>                                
                        @else
                            <div class=form-group>
                                {!! Form::label('episode', 'Tập phim', []) !!}
                                {!! Form::selectRange('episode', 1, $movie->total_episode, $movie->total_episode, ['class'=>'form-control']) !!}
                            </div>                                 
                        @endif
                    <!--Submit-->
                        @if(!isset($episode))
                            {!! Form::submit('Thêm mới', ['class'=>'btn btn-primary']) !!}
                        @else
                            {!! Form::submit('Cập nhật', ['class'=>'btn btn-primary']) !!}
                        @endif
                    {!! Form::close() !!}
                </div>
            </div>
        </div>
        {{-- HIỂN THỊ TOÀN BỘ DANH SÁCH CÁC TẬP PHIM --}}
        <div class="iq-card-header d-flex justify-content-between">
            <div class="iq-header-title">
               <h4 class="card-title" >DANH SÁCH CÁC TẬP</h4>
            </div>
         </div>
        <table class="table" id="tableMovie">
            <thead>
              <tr>
                <th scope="col">#</th>
                <th scope="col">Tên phim</th>
                <th scope="col">Poster</th>
                <th scope="col">Tập phim</th>
                <th scope="col">Video 720p</th>
                <th scope="col">Video 1080p</th>
                <th scope="col">Video 4K</th>
                {{-- <th scope="col">Active/Inactive</th> --}} 
                <th scope="col">Quản lý</th>
              </tr>
            </thead>
            {{-- đặt class: order-position để drag các danh mục bằng sortable --}}
            <tbody class="order_position"> 
                @foreach($list_episode as $key => $ep)
                {{-- trong thẻ tr lấy id của danh mục ra để drag --}}
                <tr id="{{$ep->movie->id}}">
                    <th scope="row">{{$key+1}}</th>
                    <td>{{$ep->movie->title}}</td>
                    <td><img width="90px" height="50px" src="{{asset('uploads/ep-poster/'.$ep->ep_poster)}}" alt=""></td>
                    <td>{{$ep->episode}}</td>
                    {{-- Lưu ý trong laravel, các thành phần có chứa html cần được đặt trong dấu {!! !!} --}}
                    {{-- còn nếu muốn hiển thị link phim kiểu text thôi thì gõ như bên dưới, web đỡ load video --}}
                    <td>{{ $ep->video720 ? $ep->video720 : 'Chưa có' }}</td>
                    <td>{{ $ep->video1080 ? $ep->video1080 : 'Chưa có' }}</td>
                    <td>{{ $ep->video4k ? $ep->video4k : 'Chưa có' }}</td>
                    <td>
                        {{-- EDIT --}}
                        <a href="{{route('episode.edit', $ep->id)}}" class="d-inline-block"><i class="fa-solid fa-square-pen" style="color: #027a00; font-size: 28px"></i></a>
                        {{-- DELETE --}}
                        {!! Form::open([
                            'method'=>'DELETE',
                            'route'=>['episode.destroy',$ep->id],
                            'onsubmit'=>'return confirm("Bạn muốn xóa dữ liệu của tập phim này?")',
                            'class'=>'d-inline-block'
                        ]) !!}
                        {!! Form::button('<i class="fa-solid fa-square-xmark" style="color: #d60000; font-size: 25px"></i>', ['type' => 'submit', 'class'=>'d-inline-block btn-icon']) !!}
                        {!! Form::close() !!}
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
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
    td {
    text-align: center !important;
    }    
</style>
@endsection