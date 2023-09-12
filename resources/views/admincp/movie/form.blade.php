{{-- TRANG ADMIN NÀY LÀ FORM ĐỂ THÊM /SỬA MỘT PHIM MỚI --}}

@extends('layouts.app')
@section('content')
<!-- Page Content  -->
<div id="content-page" class="content-page">
    <div class="container-fluid">
       <div class="row">
          <div class="col-sm-12">
             <div class="iq-card">
                <div class="iq-card-header d-flex justify-content-between">
                   <div class="iq-header-title">
                      <h4 class="card-title">THÊM / CHỈNH SỬA PHIM</h4>
                   </div>
                   <div class="iq-card-header-toolbar d-flex align-items-center">
                    <a href="{{route('movies.index')}}" class="btn btn-primary">Danh sách phim</a>
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
                </div>
                <div class="iq-card-body">
                    @if(!isset($movie))
                        {!! Form::open(['route'=>'movies.store', 'method'=>'POST', 'enctype'=>'multipart/form-data']) !!}
                    @else
                        {!! Form::open(['route'=>['movies.update', $movie->id], 'method'=>'PUT', 'enctype'=>'multipart/form-data']) !!} 
                    @endif
                      <div class="row">
                         <div class="col-lg-7">
                            <div class="row">
                                <!--Nhập tên phim-->
                                <div class="col-12 form-group">
                                    {!! Form::label('title', 'Tên phim', []) !!}
                                    {!! Form::text(
                                        'title', 
                                        isset($movie) ? $movie->title : '',
                                        ['class'=>'form-control', 'id'=>'slug', 'onkeyup'=>'ChangeToSlug()', 'autofocus'=>'true']) !!}
                                </div>
                                <!--Nhập tên tiếng Anh của phim--> 
                                <div class="col-12 form-group">
                                    {!! Form::label('title_eng', 'Tên phim - tiếng Anh', []) !!}
                                    {!! Form::text(
                                        'title_eng', 
                                        isset($movie) ? $movie->title_eng : '',
                                        ['class'=>'form-control', 'placeholder'=>'Nhập tên tiếng Anh của phim']) !!}
                                </div>
                                <!--Slug của phim được tự động tạo ra-->
                                <div class="col-12 form-group">
                                    {!! Form::label('slug', 'Slug', []) !!}
                                    {!! Form::text(
                                        'slug', 
                                        isset($movie) ? $movie->slug : '',
                                        ['class'=>'form-control', 'placeholder'=>'Slug này được tạo tự động',
                                        'id'=>'convert_slug']) !!}
                                </div>
                                <!--Nhập video trailer-->
                                <div class="col-md-6 form-group">
                                    {!! Form::label('trailer', 'Trailer', []) !!}
                                    @if(isset($movie->trailer))
                                        <br><span style="color: rgb(120, 120, 252)">Lần trước đã upload, thay đổi trailer khác?</span>
                                    @endif
                                    {!! Form::file('trailer',['class'=>'form-control', 'placeholder'=>'Upload trailer video from computer']) !!}
                                </div>
                                <!--Nhập thời lượng phim-->
                                <div class="col-md-6 form-group">
                                    {!! Form::label('duration', 'Thời lượng phim / tập phim (phút)', []) !!}
                                    {{-- {!! Form::text(
                                        'duration', 
                                        isset($movie) ? $movie->duration : '',
                                        ['class'=>'form-control', 'placeholder'=>'Phim/Tập phim dài bao nhiêu phút']) !!} --}}
                                    {!! Form::selectRange('duration', 5, 300, isset($movie) ? $movie->duration : '', ['class'=>'select_season']) !!}
                                </div>
                                <div class="col-md-6 form-group">
                                    <!--Chọn Thuyết Minh hay Phụ Đề-->
                                    <div class=form-group>
                                        {!! Form::label('subtitle', 'Thuyết minh hay Phụ đề?', []) !!}
                                        {!! Form::select('subtitle',
                                        ['1'=>'Thuyết minh', '0'=>'Phụ đề'],isset($movie) ? $movie->subtitle : 'Loading',
                                        ['class'=>'form-control']) !!}
                                    </div>
                                </div>
                                <div class="col-sm-6 form-group">
                                    <!--Chọn chất lượng phim-->
                                    <div class=form-group>
                                        {!! Form::label('resolution', 'Chất lượng phim', []) !!}
                                        {!! Form::select('resolution',
                                        ['0'=>'720p', '1'=>'1080p', '2'=>'4K', '3'=>'Trailer'],isset($movie) ? $movie->resolution : 'Trailer',
                                        ['class'=>'form-control']) !!}
                                    </div>
                                </div> 
                                <div class="col-sm-6 form-group">                               
                                    <!--Thuộc phim lẻ hay phim bộ, mục đích để hiển thị tập phim hoặc không-->
                                    <div class=form-group>
                                        {!! Form::label('type', 'Phim lẻ hay phim bộ?', []) !!}
                                        {!! Form::select('type', ['1'=>'Phim Lẻ', '2'=>'Phim Bộ'], isset($movie) ? $movie->type : '',
                                            ['class'=>'form-control']) !!}
                                    </div>
                                </div>
                                <div class="col-sm-6 form-group">
                                    <!--Chọn trạng thái (1): hiển thị hoặc (0): ẩn-->
                                    <div class=form-group>
                                        {!! Form::label('active', 'Trạng thái', []) !!}
                                        {!! Form::select('status',
                                        ['1'=>'Hiển thị', '0'=>'Ẩn'],isset($movie) ? $movie->status : 'Hiển thị',
                                        ['class'=>'form-control']) !!}
                                    </div> 
                                </div>
                                <div class="col-sm-6 form-group">
                                    <!--Phim thuộc quốc gia nào?-->
                                    <div class=form-group>
                                        {!! Form::label('country', 'Quốc gia', []) !!}
                                        {!! Form::select('country_id', $country,
                                        isset($movie) ? $movie->country_id : '',
                                        ['class'=>'form-control']) !!}
                                    </div>
                                </div>
                                <div class="col-sm-6 form-group">
                                    <!--Phim HOT hiển thị đầu trang hay không?-->
                                    <div class=form-group>
                                        {!! Form::label('isHotMovie', 'Phim HOT', []) !!}
                                        {!! Form::select('isHotMovie', ['1'=>'Có', '0'=>'Không'],isset($movie) ? $movie->isHotMovie : '',
                                        ['class'=>'form-control']) !!}
                                    </div>
                                </div>
                                
                                <!--Số Tập của Phim-->
                                <div class="col-6 form-group">
                                    {!! Form::label('total_episode', 'Tổng số tập phim', []) !!}
                                    {!! Form::select('total_episode', range(0, 1000), isset($movie) ? $movie->total_episode : '1', ['class'=>'select_year']) !!}
                                </div>                              
                                <!-- Năm phát hành phim -->
                                <div class="col-3 form-group">
                                    {!! Form::label('year', 'Năm phát hành', []) !!}
                                    {!! Form::selectYear('year', 1990, 2023, isset($movie) ? $movie->year : '', ['class'=>'select_year']) !!}
                                </div>
                                <!--Season phim-->
                                <div class="col-3 form-group">
                                    {!! Form::label('season', 'Season', []) !!}
                                    {!! Form::selectRange('season', 0, 26, isset($movie) ? $movie->season : '', ['class'=>'select_season']) !!}
                                </div>
                                <div class="col-12 form-group">
                                    <!--Phim thuộc những thể loại nào?-->
                                    <div class=form-group>
                                        {!! Form::label('genre', 'Thể loại', [])!!}<br>                                      
                                        @foreach($list_genre as $key => $gen)
                                        @if(isset($movie))
                                            {!! Form::checkbox('genre[]', $gen->id, isset($movie_genre) && $movie_genre->contains($gen->id) ? true : false ) !!}
                                            <!-- Nếu phim này có tồn tại trong bảng movie_genre (isset(movie_genre)), tức là thuộc nhiều thể loại (contains nhiều genre_id, mà do đã khai báo khóa ngoại, nên trong laravel tự động hiểu là id), thì checked các thể loại đó trong checkbox -->
                                        @else
                                            {!! Form::checkbox('genre[]', $gen->id, '') !!}
                                        @endif
                                        {!! Form::label('genre', $gen->title) !!}
                                        @endforeach
                                    </div>
                                </div>
                                <!--ẢNH ĐỨNG DÀNH CHO TOP10-->
                                <div class="col-6 form-group">                            

                                    @if(isset($movie))
                                        <span>Ảnh bìa TOP 10 hiện tại</span><br>
                                        @if(isset($movie->top10))
                                        <img width="80px" src="{{asset('uploads/top/'.$movie->top10)}}" alt=""><br>
                                        @endif
                                        <span style="color: rgb(120, 120, 252)">Đổi ảnh bìa TOP 10?</span><br>
                                        <input type="file" name="top10_change" onchange="previewTop10(this)" class="form-control top10-review">
                                        <img id="previewTop10" width="80px" src=""><br>
                                    @else
                                        {!! Form::label('top10', 'Ảnh bìa TOP 10', []) !!}
                                        <input type="file" name="top10" onchange="previewTop10(this)" required class="form-control top10-review">
                                        <img id="previewTop10" width="80px" src=""><br>
                                    @endif
                                </div>
                                {{-- Preview hình ảnh trước khi upload hoặc edit --}}
                                <script type="text/javascript">
                                    function previewTop10(input){
                                        var file = $(".top10-review").get(0).files[0];
                                        if(file){
                                            var reader = new FileReader();
                                            reader.onload = function(){
                                                $("#previewTop10").attr("src", reader.result);
                                            }
                                            reader.readAsDataURL(file);
                                        }
                                    }
                                </script>
                                <!--POSTER CỦA PHIM-->
                                <div class="col-6 form-group">                            

                                    @if(isset($movie))
                                        <span>Poster hiện tại</span><br>
                                        @if(isset($movie->poster))
                                        <img width="200px" src="{{asset('uploads/poster/'.$movie->poster)}}" alt=""><br>
                                        @endif
                                        <span style="color: rgb(120, 120, 252)">Đổi poster?</span><br>
                                        <input type="file" name="poster_change" onchange="previewPoster(this)" class="form-control poster_preview_1">
                                        <img id="preview_poster_1" width="200px" src=""><br>
                                    @else
                                        {!! Form::label('poster', 'Poster', []) !!}
                                        <input type="file" name="poster" onchange="previewPoster(this)" required class="form-control poster_preview_1">
                                        <img id="preview_poster_1" width="200px" src=""><br>
                                    @endif
                                </div>
                                {{-- Preview hình ảnh trước khi upload hoặc edit --}}
                                <script type="text/javascript">
                                    function previewPoster(input){
                                        var file = $(".poster_preview_1").get(0).files[0];
                                        if(file){
                                            var reader = new FileReader();
                                            reader.onload = function(){
                                                $("#preview_poster_1").attr("src", reader.result);
                                            }
                                            reader.readAsDataURL(file);
                                        }
                                    }
                                </script>
                            </div>
                         </div>
                         <div class="col-lg-5">
                            <div class="d-block position-relative">
                                <!--Nhập mô tả phim-->
                                <div class=form-group>
                                    {!! Form::label('description', 'Mô tả phim', []) !!}
                                    {!! Form::textarea(
                                    'description',
                                    isset($movie) ? $movie->description : '',
                                    ['style'=>'resize:none','class'=>'form-control',
                                    'placeholder'=>'Bộ phim này nói về...',
                                    'id'=>'description']) !!}
                                </div>
                                <!--Nhập từ khóa tags phim-->
                                <div class=form-group>
                                    {!! Form::label('tags', 'Từ khóa tìm kiếm', []) !!}
                                    {!! Form::textarea(
                                    'tags',
                                    isset($movie) ? $movie->tags : '',
                                    ['class'=>'form-control',
                                    'id'=>'tags']) !!}
                                </div>                              
                                <!--Nhập diễn viên cho phim-->
                                <div class=form-group>
                                    {!! Form::label('actor', 'Diễn viên', []) !!}
                                    {!! Form::textarea(
                                    'actor',
                                    isset($movie) ? $movie->actor : '',
                                    ['class'=>'form-control', 'required'=>'required',
                                    'id'=>'actor']) !!}
                                </div>                              
                                <!--Nhập đạo diễn cho phim-->
                                <div class=form-group>
                                    {!! Form::label('director', 'Đạo diễn', []) !!}
                                    {!! Form::textarea(
                                    'director',
                                    isset($movie) ? $movie->director : '',
                                    ['class'=>'form-control', 'required'=>'required',
                                    'id'=>'director']) !!}
                                </div>                              
                            </div>
                         </div>
                      </div>
                      <div class="row">
                         <div class="col-12 form-group ">
                            <!--Submit-->
                            @if(!isset($movie))
                                {!! Form::submit('Thêm mới', ['class'=>'btn btn-primary']) !!}
                            @else
                                {!! Form::submit('Cập nhật', ['class'=>'btn btn-primary']) !!}
                            @endif
                         </div>
                      </div>
                    {!! Form::close() !!}
                </div>
             </div>
          </div>
       </div>
    </div>
</div>
@endsection