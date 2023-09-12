{{-- TRANG ADMIN NÀY HIỂN THỊ TOÀN BỘ DANH SÁCH TẬP PHIM --}}

@extends('layouts.app')

@section('content')
<div id="content-page" class="content-page">
    <div class="container-fluid">
       <div class="row">
          <div class="col-sm-12">
             <div class="iq-card">
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
                
            {{-- HIỂN THỊ TOÀN BỘ DANH SÁCH CÁC TẬP PHIM --}}
            <div class="iq-card-header d-flex justify-content-between">
                <div class="iq-header-title">
                   <h4 class="card-title" >DANH SÁCH CÁC TẬP</h4>
                </div>
                <div class="iq-card-header-toolbar d-flex align-items-center">
                    <a href="{{route('movies.index')}}" class="btn btn-primary">Danh sách phim</a>
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
                                'onsubmit'=>'return confirm("Bạn có chắc muốn xóa tập phim?")',
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
</div>
@endsection