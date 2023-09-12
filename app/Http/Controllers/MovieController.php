<?php
//=====NƠI QUẢN LÝ TẤT CẢ CÁC CHỨC NĂNG Ở ADMIN PAGE=====
namespace App\Http\Controllers;


use App\Models\User;
use Illuminate\Http\Request;
use App\Models\Movie;
use App\Models\Movie_Genre;
use App\Models\Episode;
use App\Models\Genre;
use App\Models\Country;
use Carbon\Carbon; //cái này dùng để xử lý thời gian
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File; //cái này dùng để thao tác với tệp tin


class MovieController extends Controller
{

    //Lấy dữ liệu ra, hiển thị ở trang "Liệt kê tất cả phim" của Admin
    public function index()
    {
        // $currentUserId = Auth::id();

        // // Sử dụng ID để làm việc với người dùng
        // $user = User::find($currentUserId);

        $list = Movie::with('genre', 'movie_genre', 'country')->withCount('episode')->orderBy('id', 'DESC')->get(); //genre, country, movie_genre là các hàm bên Model: Movie.php,
        // withCount('episode') là đếm trong hàm episode() ở Model Movie.php, xem đã có bao nhiêu tập đã upload

        //Chỗ này có thể in ra màn hình để test thử dữ liệu lấy ra đúng chưa, bằng cách:
        //return response()->json($list);
        $country = Country::pluck('title', 'id');

        //Tự động tạo file json với dữ liệu là các phim trên database:
        $path = public_path() . "/json/"; //đường dẫn đến thư mục nơi lưu file json
        if (!is_dir($path)) {
            mkdir($path, 0777, true); //đoạn if này nghĩa là nếu thư mục lưu file json chưa có, thì tạo 1 thư mục mới, 0777 nghĩa là toàn quyền thêm/sửa/xóa
        }
        File::put($path . 'movies.json', json_encode($list, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE)); //json_encode($list) nghĩa là bên trên mình dùng $list lấy dữ liệu database ra rồi, thì lấy toàn bộ dữ liệu này encode ra để tạo thành file json
        //Cuối cùng ta được: mỗi lần vào admin bấm liệt kê phim hoặc refresh page liệt kê, thì file json sẽ được tạo mới
        //Lưu ý: việc Pretty Print cho json sẽ làm nặng dữ liệu hơn, nên nếu không quan trọng thì không nên dùng, và máy phải hỗ trợ UTF-8 để giữ nguyên tiếng Việt có dấu

        return view('admincp.movie.index', compact('list', 'country'));
    }


    //Hiển thị danh sách các danh mục, thể loại, và quốc gia trong form tạo mới phim:
    public function create()
    {
        $genre = Genre::pluck('title', 'id');
        $list_genre = Genre::all(); //list này cho phép chọn 1 phim thuộc nhiều thể loại
        $country = Country::pluck('title', 'id');
        return view('admincp.movie.form', compact('genre', 'country', 'list_genre'));
    }

    //Tạo và lưu 1 phim mới:
    public function store(Request $request)
    {
        $data = $request->all();
        $movie = new Movie();
        $movie->title = $data['title'];
        $movie->title_eng = $data['title_eng'];
        $movie->season = $data['season'];
        $movie->description = $data['description'];
        // Upload video trailer:
        if ($request->hasFile('trailer')) {
            $file = $request->file('trailer');
            $path = 'movie/';
            $getName = $file->getClientOriginalName();
            $setName = current(explode('.', $getName));
            $videoTrailer = $setName . rand(0, 999) . '.' . $file->getClientOriginalExtension();
            $file->move($path, $videoTrailer);
            $movie->trailer = $videoTrailer;
        }

        $movie->total_episode = $data['total_episode'];
        $movie->tags = $data['tags'];
        $movie->actor = $data['actor'];
        $movie->director = $data['director'];
        $movie->duration = $data['duration'];
        $movie->resolution = $data['resolution'];
        $movie->subtitle = $data['subtitle'];
        $movie->slug = $data['slug'];
        $movie->year = $data['year'];
        $movie->status = $data['status'];
        $movie->isHotMovie = $data['isHotMovie'];
        $movie->created_at = Carbon::now('Asia/Ho_Chi_Minh');
        $movie->updated_at = Carbon::now('Asia/Ho_Chi_Minh');
        $movie->type = $data['type'];
        $movie->country_id = $data['country_id'];

        //Một phim có nhiều thể loại:
        foreach ($data['genre'] as $key => $gen) {
            $movie->genre_id = $gen[0];
        }

        //Thêm hình ảnh:
        $get_poster = $request->file('poster');

        $path = 'uploads/poster/';

        if ($get_poster) {
            $get_name_poster = $get_poster->getClientOriginalName(); //hinhanh1.png (lấy ra tên của file ảnh)
            $name_poster = current(explode('.', $get_name_poster)); //[0]=>hinhanh1 . [1]=>png (nghĩa là tách tên ra dựa trên dâu chấm, tạo thành mảng) sau đó current sẽ lẩy giá trị của index thứ 0 trong mảng này. Nếu dùng end sẽ lấy giá trị của index cuối cùng.
            $new_poster = $name_poster . rand(0, 999) . '.' . $get_poster->getClientOriginalExtension(); //dùng hàm rand tạo 3 số ngẫu nhiên sau tên file ảnh, để tránh trường hợp trùng tên. Sau đó hàm extension sẽ lấy phần đuôi file ảnh ví dụ png để ghép vào. Ex: hinhanh12345.png
            //Cách khác để không trùng lặp tên ảnh là dùng hàm time()
            $get_poster->move($path, $new_poster); //Sao chép hình ảnh mới upload vào đường dẫn $path
            $movie->poster = $new_poster;
        }
        //Thêm ảnh TOP10:
        $get_top10 = $request->file('top10');

        $path = 'uploads/top/';

        if ($get_top10) {
            $get_name_top10 = $get_top10->getClientOriginalName(); //hinhanh1.png (lấy ra tên của file ảnh)
            $name_top10 = current(explode('.', $get_name_top10)); //[0]=>hinhanh1 . [1]=>png (nghĩa là tách tên ra dựa trên dâu chấm, tạo thành mảng) sau đó current sẽ lẩy giá trị của index thứ 0 trong mảng này. Nếu dùng end sẽ lấy giá trị của index cuối cùng.
            $new_top10 = $name_top10 . rand(0, 999) . '.' . $get_top10->getClientOriginalExtension(); //dùng hàm rand tạo 3 số ngẫu nhiên sau tên file ảnh, để tránh trường hợp trùng tên. Sau đó hàm extension sẽ lấy phần đuôi file ảnh ví dụ png để ghép vào. Ex: hinhanh12345.png
            //Cách khác để không trùng lặp tên ảnh là dùng hàm time()
            $get_top10->move($path, $new_top10); //Sao chép hình ảnh mới upload vào đường dẫn $path
            $movie->top10 = $new_top10;
        }
        $movie->save();

        //Thêm nhiều thể loại cho phim: (lưu dữ liệu vào bảng trung gian movie_genre nơi có các cặp khóa ngoại tương ứng giữa 2 bảng movies và genres)
        $movie->movie_genre()->attach($data['genre']);

        return redirect()->back()->with('success', 'Đã thêm phim thành công!');
    }

    public function show($id)
    {
        //
    }

    //Mở ra form cho phép sửa dữ liệu, có hiển thị ra các dữ liệu đã có lưu từ trước
    public function edit($id)
    {
        $movie = Movie::find($id);
        $genre = Genre::pluck('title', 'id');
        $list_genre = Genre::all();
        $country = Country::pluck('title', 'id');
        $movie_genre = $movie->movie_genre;
        return view('admincp.movie.form', compact('country', 'movie', 'genre', 'list_genre', 'movie_genre'));
    }

    //Cập nhật phim:
    public function update(Request $request, $id)
    {
        $data = $request->all();

        //Cách hiển thị dữ liệu ra màn hình để test thử mình lấy dữ liệu đúng chưa:
        // return response()->json($data['genre']);

        $movie = Movie::find($id);
        $movie->title = $data['title'];
        $movie->title_eng = $data['title_eng'];
        $movie->season = $data['season'];
        $movie->description = $data['description'];
        $fileTrailer = $request->file('trailer');
        $path = 'movie/';
        // Upload video trailer:
        if ($fileTrailer) {
            if (file_exists($path . $movie->trailer)) {
                unlink($path . $movie->trailer);
                $getName = $fileTrailer->getClientOriginalName();
                $setName = current(explode('.', $getName));
                $videoTrailer = $setName . rand(0, 999) . '.' . $fileTrailer->getClientOriginalExtension();
                $fileTrailer->move($path, $videoTrailer);
                $movie->trailer = $videoTrailer;
            } else {
                $getName = $fileTrailer->getClientOriginalName();
                $setName = current(explode('.', $getName));
                $videoTrailer = $setName . rand(0, 999) . '.' . $fileTrailer->getClientOriginalExtension();
                $fileTrailer->move($path, $videoTrailer);
                $movie->trailer = $videoTrailer;
            }
        }
        // elseif (!$fileTrailer) {
        //     $movie->trailer = $movie->trailer;
        // }
        $movie->total_episode = $data['total_episode'];
        $movie->tags = $data['tags'];
        $movie->actor = $data['actor'];
        $movie->director = $data['director'];
        $movie->duration = $data['duration'];
        $movie->resolution = $data['resolution'];
        $movie->subtitle = $data['subtitle'];
        $movie->slug = $data['slug'];
        $movie->year = $data['year'];
        $movie->status = $data['status'];
        $movie->isHotMovie = $data['isHotMovie'];
        $movie->updated_at = Carbon::now('Asia/Ho_Chi_Minh');
        $movie->type = $data['type'];
        $movie->country_id = $data['country_id'];

        //Một phim thuộc nhiều thể loại:
        foreach ($data['genre'] as $key => $gen) {
            $movie->genre_id = $gen[0];
        }

        //Sửa hình ảnh:
        $get_poster = $request->file('poster_change');

        $path = 'uploads/poster/';

        if ($get_poster) {
            if (file_exists($path . $movie->poster)) {
                unlink($path . $movie->poster);
                $get_name_poster = $get_poster->getClientOriginalName(); //hinhanh1.png (lấy ra tên của file ảnh)
                $name_poster = current(explode('.', $get_name_poster)); //[0]=>hinhanh1 . [1]=>png (nghĩa là tách tên ra dựa trên dâu chấm, tạo thành mảng) sau đó current sẽ lẩy giá trị của index thứ 0 trong mảng này (nghĩa là chỉ cho phép tải lên 1 ảnh poster thôi). (Nếu dùng end sẽ lấy giá trị của index cuối cùng.)
                $new_poster = $name_poster . rand(0, 999) . '.' . $get_poster->getClientOriginalExtension(); //dùng hàm rand tạo 3 số ngẫu nhiên sau tên file ảnh, để tránh trường hợp trùng tên. Sau đó hàm extension sẽ lấy phần đuôi file ảnh ví dụ png để ghép vào. Ex: hinhanh12345.png
                $get_poster->move($path, $new_poster); //Sao chép hình ảnh mới upload vào đường dẫn $path

                $movie->poster = $new_poster;
            } else {
                $get_name_poster = $get_poster->getClientOriginalName(); //hinhanh1.png (lấy ra tên của file ảnh)
                $name_poster = current(explode('.', $get_name_poster)); //[0]=>hinhanh1 . [1]=>png (nghĩa là tách tên ra dựa trên dâu chấm, tạo thành mảng) sau đó current sẽ lẩy giá trị của index thứ 0 trong mảng này (nghĩa là chỉ cho phép tải lên 1 ảnh poster thôi). (Nếu dùng end sẽ lấy giá trị của index cuối cùng.)
                $new_poster = $name_poster . rand(0, 999) . '.' . $get_poster->getClientOriginalExtension(); //dùng hàm rand tạo 3 số ngẫu nhiên sau tên file ảnh, để tránh trường hợp trùng tên. Sau đó hàm extension sẽ lấy phần đuôi file ảnh ví dụ png để ghép vào. Ex: hinhanh12345.png
                $get_poster->move($path, $new_poster); //Sao chép hình ảnh mới upload vào đường dẫn $path

                $movie->poster = $new_poster;
            }
        }
        // elseif (!$get_poster) {
        //     // Nếu người dùng không chọn tệp mới, giữ nguyên tên tệp cũ
        //     $movie->poster = $movie->poster;
        // }
        //Sửa ảnh top10:
        $get_new_top10 = $request->file('top10_change');

        $path_2 = 'uploads/top/';

        if ($get_new_top10) {
            if (file_exists($path_2 . $movie->top10)) {
                unlink($path_2 . $movie->top10);
                $get_new_name_top10 = $get_new_top10->getClientOriginalName(); //hinhanh1.png (lấy ra tên của file ảnh)
                $name_new_top10 = current(explode('.', $get_new_name_top10)); //[0]=>hinhanh1 . [1]=>png (nghĩa là tách tên ra dựa trên dâu chấm, tạo thành mảng) sau đó current sẽ lẩy giá trị của index thứ 0 trong mảng này (nghĩa là chỉ cho phép tải lên 1 ảnh poster thôi). (Nếu dùng end sẽ lấy giá trị của index cuối cùng.)
                $new_top10_2 = $name_new_top10 . rand(0, 999) . '.' . $get_new_top10->getClientOriginalExtension(); //dùng hàm rand tạo 3 số ngẫu nhiên sau tên file ảnh, để tránh trường hợp trùng tên. Sau đó hàm extension sẽ lấy phần đuôi file ảnh ví dụ png để ghép vào. Ex: hinhanh12345.png
                $get_new_top10->move($path_2, $new_top10_2); //Sao chép hình ảnh mới upload vào đường dẫn $path
                $movie->top10 = $new_top10_2;
            } else {
                $get_new_name_top10 = $get_new_top10->getClientOriginalName(); //hinhanh1.png (lấy ra tên của file ảnh)
                $name_new_top10 = current(explode('.', $get_new_name_top10)); //[0]=>hinhanh1 . [1]=>png (nghĩa là tách tên ra dựa trên dâu chấm, tạo thành mảng) sau đó current sẽ lẩy giá trị của index thứ 0 trong mảng này (nghĩa là chỉ cho phép tải lên 1 ảnh poster thôi). (Nếu dùng end sẽ lấy giá trị của index cuối cùng.)
                $new_top10_2 = $name_new_top10 . rand(0, 999) . '.' . $get_new_top10->getClientOriginalExtension(); //dùng hàm rand tạo 3 số ngẫu nhiên sau tên file ảnh, để tránh trường hợp trùng tên. Sau đó hàm extension sẽ lấy phần đuôi file ảnh ví dụ png để ghép vào. Ex: hinhanh12345.png
                $get_new_top10->move($path_2, $new_top10_2); //Sao chép hình ảnh mới upload vào đường dẫn $path
                $movie->top10 = $new_top10_2;
            }
        }
        // elseif (!$get_new_top10) {
        //     // Nếu người dùng không chọn tệp mới, giữ nguyên tên tệp cũ
        //     $movie->top10 = $movie->top10;
        // }

        $movie->save();
        $movie->movie_genre()->detach(); //attach nghĩa là xóa tất cả Thể loại cũ
        $movie->movie_genre()->sync($data['genre']); // sync nghĩa là cập nhật các Thể loại mới => không xảy ra tình trạng mất hoặc trùng Thể loại
        return redirect()->route('movies.index')->with('success', 'Cập nhật thành công!');
    }

    //Năm phát hành:
    public function update_year(Request $request)
    {
        $data = $request->all();
        $movie = Movie::find($data['movieID']);
        $movie->year = $data['year'];
        $movie->save();
    }
    // Thay đổi quốc gia phim ngay tại trang index, không cần bấm vào "Sửa":
    public function update_country_ajax(Request $request)
    {
        $data = $request->all();
        $movie = Movie::find($data['movie_id']);
        $movie->country_id = $data['country_id'];
        $movie->save();
    }

    //Season phim:
    public function update_season(Request $request)
    {
        $data = $request->all();
        $movie = Movie::find($data['movieID']);
        $movie->season = $data['season'];
        $movie->save();
    }

    //Top View:
    public function update_topview(Request $request)
    {
        $data = $request->all();
        $movie = Movie::find($data['movie_id']);
        $movie->topview = $data['top_view'];
        $movie->save();
    }

    //Filter top views:
    public function filter_topview(Request $request)
    {
        $data = $request->all();
        $movie = Movie::where('topView', $data['value'])->orderBy('updated_at', 'DESC')->take(3)->get();
        $output = '';
        foreach ($movie as $key => $mov) {
            if ($mov->resolution == 2) {
                $text = '4K';
            } else if ($mov->resolution == 1) {
                $text = '1080p';
            } else if ($mov->resolution == 0) {
                $text = '720p';
            } else {
                $text = 'Trailer';
            }
            $output .= '<div class="item">
                        <a href="' . url('phim/' . $mov->slug) . '" title=" ' . $mov->title . ' ">
                            <div class="item-link">
                                <img src=" ' . url('uploads/movie/' . $mov->poster) . ' " class="lazy post-thumb" alt=" ' . $mov->title . ' " title=" ' . $mov->title . ' " />
                                <span class="is_trailer">' . $text . '</span>
                            </div>
                            <p class="title"> ' . $mov->title . ' </p>
                        </a>
                        <div class="viewsCount" style="color: #9d9d9d;">3.2K lượt xem</div>
                        <div style="float: left;">
                            <span class="user-rate-image post-large-rate stars-large-vang" style="display: block;/* width: 100%; */">
                                <span style="width: 0%"></span>
                            </span>
                        </div>
                        </div>';
        }
        echo $output;
    }
    //Filter top views - default:
    public function filter_default(Request $request)
    {
        $data = $request->all();
        $movie = Movie::where('topView', 0)->orderBy('updated_at', 'DESC')->take(3)->get();
        $output = '';
        foreach ($movie as $key => $mov) {
            if ($mov->resolution == 2) {
                $text = '4K';
            } else if ($mov->resolution == 1) {
                $text = '1080p';
            } else if ($mov->resolution == 0) {
                $text = '720p';
            } else {
                $text = 'Trailer';
            }
            $output .= '<div class="item post-37176">
                        <a href="' . url('phim/' . $mov->slug) . '" title=" ' . $mov->title . ' ">
                            <div class="item-link">
                                <img src=" ' . url('uploads/movie/' . $mov->poster) . ' " class="lazy post-thumb" alt=" ' . $mov->title . ' " title=" ' . $mov->title . ' " />
                                <span class="is_trailer">' . $text . '</span>
                            </div>
                            <p class="title"> ' . $mov->title . ' </p>
                        </a>
                        <div class="viewsCount" style="color: #9d9d9d;">3.2K lượt xem</div>
                        <div style="float: left;">
                            <span class="user-rate-image post-large-rate stars-large-vang" style="display: block;/* width: 100%; */">
                                <span style="width: 0%"></span>
                            </span>
                        </div>
                        </div>';
        }
        echo $output;
    }

    //Xóa phim:
    public function destroy($id)
    {
        $movie = Movie::find($id);
        //Xóa ảnh:
        if (file_exists('uploads/poster/' . $movie->poster)) {
            unlink('uploads/poster/' . $movie->poster);
        }
        //Xóa các thể loại của phim đó (nằm trong bảng Movie_Genre)
        Movie_Genre::whereIn('movie_id', [$movie->id])->delete(); //where là xóa 1 cái, còn whereIn là xóa 1 mảng với điều kiện nào đó
        //Lưu ý nếu mình có cài đặt Foreign key cho 2 bảng movies và movie_genre với thuộc tính Cascade rồi,
        //thì khi xóa (hoặc update) 1 dòng trong bảng cha, tự động nó tham chiếu đến dòng trong bảng con và xóa (update) luôn
        //và không cần phải viết dòng lệnh Xóa movie_id này nhé

        //Xóa các tập phim của phim đó:
        //Cách 1: thiết lập relation ship trong DB với khóa chính là id của bảng movies, khóa ngoại là movie_id của bảng episodes
        //Đầu tiên là thiết lập chỉ mục khóa ngoại cho movie_id, sau đó vào "Bộ thiết kế" để thiết lập relationship với cài đặt Cascade
        //Cách 2: tự code như bên dưới
        Episode::whereIn('movie_id', [$movie->id])->delete();

        //Cuối cùng, sau khi đã xóa xong các dữ liệu liên quan đến id của phim, ta xóa phim đó:
        $movie->delete();
        return redirect()->back();
    }


}