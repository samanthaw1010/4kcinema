{{-- TRANG ADMIN NÀY LIỆT KÊ DANH SÁCH TOÀN BỘ PHIM --}}

@extends('layouts.app')

@section('content')
<div id="content-page" class="content-page">
    <div class="container-fluid">
       <div class="row">
          <div class="col-sm-12">
             <div class="iq-card">
                <div class="iq-card-header d-flex justify-content-between">
                   <div class="iq-header-title">
                      <h4 class="card-title">DANH SÁCH PHIM</h4>
                   </div>
                   <div class="iq-card-header-toolbar d-flex align-items-center">
                      <a href="{{route('movies.create')}}" class="btn btn-primary">Thêm phim mới</a>
                   </div>
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

            {{-- HIỂN THỊ DANH SÁCH TOÀN BỘ PHIM --}}
            <table class="data-tables table table-responsive" id="tableMovie">
                <thead>
                  <tr>
                    <th scope="col">STT</th>
                    <th scope="col">Quản lý</th>
                    <th scope="col">Tên</th>
                    <th scope="col">Poster</th>
                    <th scope="col">Loại phim</th>
                    <th scope="col">Trailer</th>
                    <th scope="col">Season</th>
                    <th scope="col">Thời lượng</th>
                    <th scope="col">Chất lượng</th>
                    <th scope="col">Phụ đề</th>
                    <th scope="col">Số tập</th>
                    <th scope="col">Phim Hot</th>
                    <th scope="col">Top View</th>
                    <th scope="col">Trạng thái</th>
                    <th scope="col">Ngày tạo</th>
                    <th scope="col">Ngày sửa</th>
                    <th scope="col">Năm phát hành</th>                    
                    <th scope="col">Thể loại</th>
                    <th scope="col">Quốc gia</th>                    
                  </tr>
                </thead>
                <tbody>
                    @foreach($list as $key => $mov)
                    <tr>
                    {{-- Số thứ tự --}}
                        <th scope="row">{{$key+1}}</th>
                    {{-- 2 nút chức năng: Sửa và Xóa --}}
                    <td>
                        {{-- EDIT --}}
                        <a href="{{route('movies.edit', $mov->id)}}" class="d-inline-block"><i class="fa-solid fa-square-pen" style="color: #027a00; font-size: 28px"></i></a>
                        {{-- DELETE --}}
                        {!! Form::open([
                            'method'=>'DELETE',
                            'route'=>['movies.destroy',$mov->id],
                            'onsubmit'=>'return confirm("Bạn muốn xóa phim này?")',
                            'class'=>'d-inline-block'
                        ]) !!}
                        {!! Form::button('<i class="fa-solid fa-square-xmark" style="color: #d60000; font-size: 25px"></i>', ['type' => 'submit', 'class'=>'d-inline-block btn-icon']) !!}
                        {!! Form::close() !!}
                    </td>
                    {{-- Tên phim --}}
                        <td>{{$mov->title}}</td>
                    {{-- Poster của phim --}}
                        <td><img width="70px" src="{{asset('uploads/poster/'.$mov->poster)}}" alt=""></td>
                    {{-- Thuộc phim lẻ hay phim bộ, mục đích để bên trang chiếu phim có hiển thị tập phim hay không --}}
                        <td>
                            @if($mov->type == '1')
                                Phim lẻ
                            @else
                                Phim bộ                            
                            @endif
                        </td>
                    {{-- Trailer phim --}}
                        <td>
                            @if($mov->trailer!=NULL)
                                Đã upload
                            @else
                                Chưa có 
                            @endif
                        </td>
                    {{-- Season phim --}}
                        <td>
                            {!! Form::selectRange('season', 0, 26, isset($mov->season) ? $mov->season : '', ['class'=>'select_season', 'id'=>$mov->id]) !!}
                        </td> 
                    {{-- Thời lượng phim --}}
                        <td>{{$mov->duration}} phút</td>
                    {{-- Chất lượng phim --}}
                        <td>
                            @if($mov->resolution==0)
                                720p
                            @elseif($mov->resolution==1)
                                1080p
                            @elseif($mov->resolution==2)
                                4K
                            @else
                                Trailer
                            @endif
                            {{-- Ta có thể viết theo switch case nhưng dài hơn nên thôi viết if-else --}}
                        </td>
                    {{-- Phụ đề hay thuyết minh --}}
                        <td>
                            {{ $mov->subtitle ? 'Thuyết minh' : 'Vietsub' }}
                        </td>
                    {{-- Số Tập của Phim --}}
                        <td>
                            @if($mov->type == '1')
                                {{$mov->episode_count}}<br>
                                <a href="{{route('add-episode', [$mov->id])}}" class="btn-sm btn btn-warning">
                                    Thêm/Sửa Tập Phim </a>
                            @else
                                {{$mov->episode_count}}/{{$mov->total_episode}}<br><a href="{{route('add-episode', [$mov->id])}}" class="btn-sm btn btn-warning">Thêm/Sửa Tập Phim </a>                           
                            @endif
                        </td>
                        {{-- Lưu ý hậu tố _count ở episode_count được sử dụng cho bất ký tên cột nào trong bảng mà bạn muốn nhờ Laravel đếm dùm, miễn sao bên controller, khi lấy dữ liệu từ 1 bảng, bạn dùng withCount() thay vì with() --}}
                    {{-- Phim HOT hiển thị ở slider đầu website --}}
                        <td>
                            {{ $mov->isHotMovie ? 'Có' : 'Không' }}
                        </td>
                    {{-- Top Views --}}
                        <td> 
                            {!! Form::select('topview',
                            ['0'=>'Ngày', '1'=>'Tuần', '2'=>'Tháng'],isset($mov->topView) ? $mov->topView : '',
                            ['class'=>'topview_choose','id'=>$mov->id]) !!}
                        </td>
                    {{-- Status Hiển Thị hoặc Ẩn --}}
                        <td>
                            {{ $mov->status ? 'Hiển thị' : 'Ẩn' }}
                        </td>
                    {{-- Ngày tạo --}}
                        <td>{{$mov->created_at}}</td>
                    {{-- Ngày cập nhật --}}
                        <td>{{$mov->updated_at}}</td>
                    {{-- Năm phát hành --}}
                        <td>
                            {!! Form::selectYear('year', 1980, 2023, isset($mov->year) ? $mov->year : '', ['class'=>'select_year', 'id'=>$mov->id]) !!}
                        </td>                     
                    {{-- Thuộc Những Thể Loại nào? --}}
                        <td>
                            @foreach($mov->movie_genre as $gen)
                                <span class="badge badge-dark">{{$gen->title}}</span>
                            @endforeach
                        </td>
                        <!-- Thường khi dùng foreach ta hay thấy có $key để lưu index của các phần tử trong vòng lặp, để ta dễ dàng truy cập lấy các phần tử đó. Còn ở mục thể loại này, ta liệt kê ra hết chứ không có làm gì khác, nên không cần dùng $key  -->

                    {{-- Thuộc Quốc Gia nào? --}}
                        {{-- <td>{{$mov->country->title}}</td> --}}
                        <td>
                            {!! Form::select('country_id', $country,
                            isset($mov) ? $mov->country->id : '',
                            ['class'=>'country_choose', 'id' => $mov->id]) !!}
                        </td>                    
                    </tr>
                    @endforeach
                </tbody>
              </table>
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
    td {
    text-align: center !important;
    }    
</style>
@endsection