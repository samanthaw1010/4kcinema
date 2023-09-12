<?php
//QUẢN LÝ CÁC CHỨC NĂNG Ở TRANG ADMIN TẬP PHIM
namespace App\Http\Controllers;

use App\Models\Video;
use Carbon\Carbon; //quản lý thời gian/thứ/ngày/tháng
use Illuminate\Http\Request;
use App\Models\Movie;
use App\Models\Episode;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Str;

class EpisodeController extends Controller
{
    public function index()
    {
        $list_episode = Episode::with('movie')->orderBy('movie_id', 'DESC')->get(); //pluck chỉ lấy ra title và id của phim thôi
        return view('admincp.episode.index', compact('list_episode'));
    }
    public function create()
    {
        $list_movie = Movie::orderBy('id', 'DESC')->pluck('title', 'id', 'episode'); //pluck chỉ lấy ra title và id của phim thôi
        return view('admincp.episode.form', compact('list_movie'));
    }
    public function add_episode($id)
    {
        $movie = Movie::find($id);
        $list_episode = Episode::with('movie')->where('movie_id', $id)->orderBy('id', 'DESC')->get();
        return view('admincp.episode.add_episode', compact('list_episode', 'movie'));
    }
    public function store(Request $request)
    //Hàm này sau này hãy tự làm lại bằng ajax để không cần reload page
    {
        $data = $request->all();
        $episode_check_exist = Episode::where('episode', $data['episode'])->where('movie_id', $data['movie_id'])->count();
        if ($episode_check_exist) {
            return redirect()->back()->with('error', 'Tập phim này đã thêm video trước đó! Hãy tìm tập phim và chỉnh sửa nhé!');
        } else {
            $episode = new Episode();
            $episode->movie_id = $data['movie_id']; //cột "movie_id" trong DB nhận giá trị của phần tử có name "movie_id" trong html
            $episode->episode = $data['episode'];
            // Lưu trữ tệp tin video vào thư mục trên máy chủ
            if ($request->hasFile('video720')) {
                $file = $request->file('video720');
                // Tạo tên file video 720 theo format
                $slug = Movie::where('id', $episode->movie_id)->value('slug'); // Lấy slug từ tên phim
                $fileName = $slug . '_' . $episode->episode . '_' . '720' . '.mp4';

                $file->move(public_path('uploads/video'), $fileName); // Di chuyển tệp tin vào thư mục lưu trữ của bạn
                $episode->video720 = 'uploads/video/' . $fileName; // Lưu đường dẫn tới tệp tin vào cơ sở dữ liệu
            }
            if ($request->hasFile('video1080')) {
                $file = $request->file('video1080');
                // Tạo tên file video 1080 theo format
                $slug = Movie::where('id', $episode->movie_id)->value('slug'); // Lấy slug từ tên phim
                $fileName = $slug . '_' . $episode->episode . '_' . '1080' . '.mp4';

                $file->move(public_path('uploads/video'), $fileName); // Di chuyển tệp tin vào thư mục lưu trữ của bạn
                $episode->video1080 = 'uploads/video/' . $fileName; // Lưu đường dẫn tới tệp tin vào cơ sở dữ liệu
            }
            if ($request->hasFile('video4k')) {
                $file = $request->file('video4k');
                // Tạo tên file video 4K theo format
                $slug = Movie::where('id', $episode->movie_id)->value('slug'); // Lấy slug từ tên phim
                $fileName = $slug . '_' . $episode->episode . '_' . '4K' . '.mp4';

                $file->move(public_path('uploads/video'), $fileName); // Di chuyển tệp tin vào thư mục lưu trữ của bạn
                $episode->video4k = 'uploads/video/' . $fileName; // Lưu đường dẫn tới tệp tin vào cơ sở dữ liệu
            }
            //Thêm hình ảnh:
            $get_poster = $request->file('ep_poster');

            $path = 'uploads/ep-poster/';

            if ($get_poster) {
                $get_name_poster = $get_poster->getClientOriginalName(); //hinhanh1.png (lấy ra tên của file ảnh)
                $name_poster = current(explode('.', $get_name_poster)); //[0]=>hinhanh1 . [1]=>png (nghĩa là tách tên ra dựa trên dâu chấm, tạo thành mảng) sau đó current sẽ lẩy giá trị của index thứ 0 trong mảng này. Nếu dùng end sẽ lấy giá trị của index cuối cùng.
                $new_poster = $name_poster . rand(0, 999) . '.' . $get_poster->getClientOriginalExtension(); //dùng hàm rand tạo 3 số ngẫu nhiên sau tên file ảnh, để tránh trường hợp trùng tên. Sau đó hàm extension sẽ lấy phần đuôi file ảnh ví dụ png để ghép vào. Ex: hinhanh12345.png
                //Cách khác để không trùng lặp tên ảnh là dùng hàm time()
                $get_poster->move($path, $new_poster); //Sao chép hình ảnh mới upload vào đường dẫn $path
                $episode->ep_poster = $new_poster;
            }

            $episode->updated_at = Carbon::now('Asia/Ho_Chi_Minh');
            $episode->created_at = Carbon::now('Asia/Ho_Chi_Minh');
            $episode->save();
        }
        return redirect()->back()->with('success', 'Thêm tập phim thành công');
    }


    public function edit($id)
    {
        $episode = Episode::find($id);
        $movie = Movie::where('id', $episode->movie_id)->first();
        $list_episode = Episode::with('movie')->where('movie_id', $movie->id)->orderBy('id', 'DESC')->get();
        return view('admincp.episode.form', compact('episode', 'movie', 'list_episode'));
    }
    public function update(Request $request, $id)
    //hàm này sau này nhớ tự làm lại bằng ajax để không cần reload page nhé
    {
        $data = $request->all();
        $episode = Episode::find($id);
        $episode->movie_id = $data['movie_id']; //cột "movie_id" trong DB nhận giá trị của phần tử có name "movie_id" trong html
        $episode->episode = $data['episode'];
        if ($request->hasFile('video720')) {
            $file = $request->file('video720');
            // Tạo tên file video 720 theo format
            $slug = Movie::where('id', $episode->movie_id)->value('slug'); // Lấy slug từ tên phim
            $fileName1 = $slug . '_' . $episode->episode . '_' . '720' . '.mp4';

            $file->move(public_path('uploads/video'), $fileName1); // Di chuyển tệp tin vào thư mục lưu trữ của bạn
            $episode->video720 = 'uploads/video/' . $fileName1; // Lưu đường dẫn tới tệp tin vào cơ sở dữ liệu
        } else {
            $episode->video720 = $episode->video720;
        }
        if ($request->hasFile('video1080')) {
            $file = $request->file('video1080');
            // Tạo tên file video 1080 theo format
            $slug = Movie::where('id', $episode->movie_id)->value('slug'); // Lấy slug từ tên phim
            $fileName2 = $slug . '_' . $episode->episode . '_' . '1080' . '.mp4';

            $file->move(public_path('uploads/video'), $fileName2); // Di chuyển tệp tin vào thư mục lưu trữ của bạn
            $episode->video1080 = 'uploads/video/' . $fileName2; // Lưu đường dẫn tới tệp tin vào cơ sở dữ liệu
        } else {
            $episode->video1080 = $episode->video1080;
        }
        if ($request->hasFile('video4k')) {
            $file = $request->file('video4k');
            // Tạo tên file video 4K theo format
            $slug = Movie::where('id', $episode->movie_id)->value('slug'); // Lấy slug từ tên phim
            $fileName3 = $slug . '_' . $episode->episode . '_' . '4K' . '.mp4';

            $file->move(public_path('uploads/video'), $fileName3); // Di chuyển tệp tin vào thư mục lưu trữ của bạn
            $episode->video4k = 'uploads/video/' . $fileName3; // Lưu đường dẫn tới tệp tin vào cơ sở dữ liệu
        } else {
            $episode->video4k = $episode->video4k;
        }
        //Sửa hình ảnh:
        $get_poster = $request->file('ep_poster_change');

        $path = 'uploads/ep-poster/';

        if ($get_poster) {
            if (file_exists($path . $episode->ep_poster)) {
                unlink($path . $episode->ep_poster);
                $get_name_poster = $get_poster->getClientOriginalName(); //hinhanh1.png (lấy ra tên của file ảnh)
                $name_poster = current(explode('.', $get_name_poster)); //[0]=>hinhanh1 . [1]=>png (nghĩa là tách tên ra dựa trên dâu chấm, tạo thành mảng) sau đó current sẽ lẩy giá trị của index thứ 0 trong mảng này (nghĩa là chỉ cho phép tải lên 1 ảnh poster thôi). (Nếu dùng end sẽ lấy giá trị của index cuối cùng.)
                $new_poster = $name_poster . rand(0, 999) . '.' . $get_poster->getClientOriginalExtension(); //dùng hàm rand tạo 3 số ngẫu nhiên sau tên file ảnh, để tránh trường hợp trùng tên. Sau đó hàm extension sẽ lấy phần đuôi file ảnh ví dụ png để ghép vào. Ex: hinhanh12345.png
                $get_poster->move($path, $new_poster); //Sao chép hình ảnh mới upload vào đường dẫn $path

                $episode->ep_poster = $new_poster;
            } else {
                $get_name_poster = $get_poster->getClientOriginalName(); //hinhanh1.png (lấy ra tên của file ảnh)
                $name_poster = current(explode('.', $get_name_poster)); //[0]=>hinhanh1 . [1]=>png (nghĩa là tách tên ra dựa trên dâu chấm, tạo thành mảng) sau đó current sẽ lẩy giá trị của index thứ 0 trong mảng này (nghĩa là chỉ cho phép tải lên 1 ảnh poster thôi). (Nếu dùng end sẽ lấy giá trị của index cuối cùng.)
                $new_poster = $name_poster . rand(0, 999) . '.' . $get_poster->getClientOriginalExtension(); //dùng hàm rand tạo 3 số ngẫu nhiên sau tên file ảnh, để tránh trường hợp trùng tên. Sau đó hàm extension sẽ lấy phần đuôi file ảnh ví dụ png để ghép vào. Ex: hinhanh12345.png
                $get_poster->move($path, $new_poster); //Sao chép hình ảnh mới upload vào đường dẫn $path

                $episode->ep_poster = $new_poster;
            }
        }
        $episode->updated_at = Carbon::now('Asia/Ho_Chi_Minh');
        $episode->created_at = Carbon::now('Asia/Ho_Chi_Minh');
        $episode->save();
        return redirect()->back()->with('success', 'Cập nhật thành công!');
    }
    public function destroy($id)
    {
        $episode = Episode::find($id)->delete();
        return redirect()->back();
    }

    public function select_movie()
    {
        $id = $_GET['id'];
        $movie = Movie::find($id);
        $output = '';
        if ($movie->type == '2') {
            for ($i = 1; $i <= $movie->episode; $i++) {
                $output .= '<option value="' . $i . '">' . $i . '</option>'; // .= nghĩa là nối chuỗi
            }
        } else {
            $output = '<option value="1">Phim Lẻ</option>';
        }

        echo $output;
    }

}