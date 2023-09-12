<?php
//NƠI QUẢN LÝ CÁC CHỨC NĂNG Ở LANDING PAGE:
namespace App\Http\Controllers;

use App\Models\Bookmark;
use App\Models\Notification;
use App\Models\Package;
use App\Models\Viewreport;
use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Genre;
use App\Models\Movie_Genre;
use App\Models\Country;
use App\Models\Movie;
use App\Models\Episode;
use App\Models\User;
use App\Models\Rating;
use App\Models\ViewMovie;
use App\Models\ViewPage;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use Illuminate\Support\Facades\Session;

class IndexController extends Controller
{
    //Tìm kiếm phim
    public function searchMovie()
    {
        if (isset($_GET['search'])) {
            $search = $_GET['search'];
            $genre = Genre::orderBy('id', 'DESC')->where('status', 1)->get();
            $country = Country::orderBy('id', 'DESC')->where('status', 1)->get();
            $hot_trailer = Movie::where('resolution', 3)->where('status', 1)->orderBy('updated_at', 'DESC')->take(4)->get();
            $hot_sidebar = Movie::where('isHotMovie', 1)->where('status', 1)->orderBy('updated_at', 'DESC')->take(4)->get();

            $movie = Movie::where(function ($query) use ($search) {
                $query->where('movies.year', 'LIKE', '%' . $search . '%')
                    ->orWhere('movies.title', 'LIKE', '%' . $search . '%')
                    ->orWhere('movies.title_eng', 'LIKE', '%' . $search . '%');
            })
                ->orWhereHas('country', function ($query) use ($search) {
                    $query->where('countries.title', 'LIKE', '%' . $search . '%');
                })
                ->orWhere(function ($query) use ($search) {
                    $query->whereIn('id', function ($subQuery) use ($search) {
                        $subQuery->select('movie_id')
                            ->from('movie_genre')
                            ->join('genres', 'movie_genre.genre_id', '=', 'genres.id')
                            ->where('genres.title', 'LIKE', '%' . $search . '%');
                    });
                })
                ->orderBy('movies.updated_at', 'DESC')
                ->paginate(16);

            $searchFirstVideo = $movie->first();
            //thay vì get() để lấy hết thì ta dùng paginate() để phân trang, ví dụ paginate(2) có nghĩa là hiển thị 2 phim trên mỗi trang
            $user = Auth::user();
            $package = Package::where('status', 1)->get();
            if ($user) {
                // Lấy thông báo khi có user đang đăng nhập, và có expired_at lớn hơn ngày hiện tại
                $notification = Notification::where('package_id', $user->package_id)
                    ->where('expired_at', '>', Carbon::now())
                    ->get();
            } else {
                $notification = [];
            }
            // Đếm số lượng thông báo
            $notificationCount = count($notification);
            return view('pages.search', compact('genre', 'country', 'search', 'movie', 'hot_sidebar', 'hot_trailer', 'user', 'package', 'notification', 'notificationCount', 'searchFirstVideo'));
            // pages.search là đường dẫn tới view search.blade.php, compact() là để truyền các biến tới view search.blade.php này
        } else {
            return redirect()->to('/');
        }

    }
    public function view_notification()
    {
        $genre = Genre::orderBy('id', 'DESC')->where('status', 1)->get();
        $country = Country::orderBy('id', 'DESC')->where('status', 1)->get();
        $user = Auth::user();
        $package = Package::where('status', 1)->get();
        if ($user) {
            // Lấy thông báo khi có user đang đăng nhập, và có expired_at lớn hơn ngày hiện tại
            $notification = Notification::where('package_id', $user->package_id)
                ->where('expired_at', '>', Carbon::now())
                ->get();
        } else {
            $notification = [];
        }
        // Đếm số lượng thông báo
        $notificationCount = count($notification);
        return view('pages.notification', compact('notification', 'genre', 'country', 'user', 'package', 'notification', 'notificationCount'));
    }

    //Hiển thị toàn bộ phim ra trang chủ:
    public function home(Request $request)
    {

        $userIp = $_SERVER['REMOTE_ADDR'];
        // Kiểm tra xem đã có bản ghi cho IP này vào ngày hôm nay chưa
        $existingRecord = ViewPage::where('ip_address', $userIp)
            ->whereDate('created_at', Carbon::now('Asia/Ho_Chi_Minh'))
            ->first();

        if (!$existingRecord) {
            // Tạo bản ghi mới cho IP này vào ngày hôm nay
            $newRecord = new ViewPage();
            $newRecord->ip_address = $userIp;
            $newRecord->view_count = 1;
            $newRecord->created_at = Carbon::now('Asia/Ho_Chi_Minh');
            $newRecord->updated_at = Carbon::now('Asia/Ho_Chi_Minh');
            $newRecord->save();
        } else {
            $existingRecord->update(['view_count' => DB::raw('view_count + 1')]);
        }
        $view_count = ViewPage::sum('view_count');

        // Nếu muốn lấy view_count theo ngày hôm nay:
        // $view_count_today = ViewPage::whereDate('created_at', now())->sum('view_count');

        // Những phim hiển thị ở slider đầu trang:
        $hot10Movie = Movie::where('isHotMovie', 1)->where('status', 1)->orderBy('updated_at', 'DESC')->take(10)->get();
        $homeFirstVideo = $hot10Movie->first();
        // Những phim sắp chiếu, hiển thị bên phải màn hình, ở trên:
        $hot_trailer = Movie::where('resolution', 3)->where('status', 1)->orderBy('updated_at', 'DESC')->get();

        $homeMiddleVideo = Movie::where('topView', 3)->where('status', 1)->first();
        $top_view_day = Movie::where('topView', 2)->where('status', 1)->get();
        $top_view_week = Movie::where('topView', 1)->where('status', 1)->get();
        //Bắt đầu lấy các dữ liệu khác ra:    
        $country_home = Country::with('movie')->orderBy('id', 'DESC')->where('id', 9)->where('status', 1)->get();
        $korean_movie = Movie::where('country_id', 12)->orderBy('id', 'DESC')->where('status', 1)->get();
        $action_movie = Movie::whereHas('movie_genre', function ($query) {
            $query->where('genre_id', 32);
        })->get();
        $costume_movie = Movie::whereHas('movie_genre', function ($query) {
            $query->where('genre_id', 24);
        })->get();
        $cartoon_movie = Movie::whereHas('movie_genre', function ($query) {
            $query->where('genre_id', 28);
        })->get();
        $horror_movie = Movie::whereHas('movie_genre', function ($query) {
            $query->where('genre_id', 27);
        })->get();
        $genre = Genre::orderBy('id', 'DESC')->where('status', 1)->get();
        $country = Country::orderBy('id', 'DESC')->where('status', 1)->get();
        $user = Auth::user();
        $package = Package::where('status', 1)->get();
        if ($user) {
            // Lấy thông báo khi có user đang đăng nhập, có mua gói và có expired_at lớn hơn ngày hiện tại
            $notification = Notification::where('package_id', $user->package_id)
                ->where('expired_at', '>', Carbon::now())
                ->get();
        } else {
            $notification = [];
        }
        // Đếm số lượng thông báo
        $notificationCount = count($notification);

        $compactData = [
            'genre',
            'korean_movie',
            'action_movie',
            'costume_movie',
            'country_home',
            'cartoon_movie',
            'horror_movie',
            'country',
            'hot10Movie',
            'hot_trailer',
            'homeMiddleVideo',
            'user',
            'notification',
            'notificationCount',
            'homeFirstVideo',
            'view_count',
            'top_view_day',
            'top_view_week'
        ];

        if ($user) {
            $bookmark = Bookmark::where('user_id', $user->id)->get();
            $compactData[] = 'bookmark';
        }

        return view('pages.home', compact($compactData));
        //gửi data của genre và country, lên cái view home... mục đích để bên view, tức là bên file home.blade.php có thể dùng được
    }

    //Menu Năm phát hành:
    public function year($year)
    {
        $user = Auth::user();
        $genre = Genre::orderBy('id', 'DESC')->where('status', 1)->get();
        $country = Country::orderBy('id', 'DESC')->where('status', 1)->get();
        $hot_trailer = Movie::where('resolution', 5)->where('status', 1)->orderBy('updated_at', 'DESC')->take(4)->get();
        $hot_sidebar = Movie::where('isHotMovie', 1)->where('status', 1)->orderBy('updated_at', 'DESC')->take(4)->get();
        $year = $year;
        $movie = Movie::where('year', $year)->orderBy('updated_at', 'DESC')->paginate(16);
        $yearFirstVideo = $movie->first();
        $user = Auth::user();
        $package = Package::where('status', 1)->get();
        if ($user) {
            // Lấy thông báo khi có user đang đăng nhập, có mua gói và có expired_at lớn hơn ngày hiện tại
            $notification = Notification::where('package_id', $user->package_id)
                ->where('expired_at', '>', Carbon::now())
                ->get();
        } else {
            $notification = [];
        }
        // Đếm số lượng thông báo
        $notificationCount = count($notification);
        //thay vì get() để lấy hết thì ta dùng paginate() để phân trang, ví dụ paginate(16) có nghĩa là hiển thị 16 phim trên mỗi trang
        return view('pages.year', compact('genre', 'country', 'year', 'movie', 'hot_sidebar', 'hot_trailer', 'user', 'yearFirstVideo', 'user', 'package', 'notification', 'notificationCount'));
    }
    //Menu Từ Khóa Tìm Kiếm (Tags)
    public function tag($tag)
    {
        $user = Auth::user();
        $genre = Genre::orderBy('id', 'DESC')->where('status', 1)->get();
        $country = Country::orderBy('id', 'DESC')->where('status', 1)->get();
        $hot_trailer = Movie::where('resolution', 5)->where('status', 1)->orderBy('updated_at', 'DESC')->take(4)->get();
        $hot_sidebar = Movie::where('isHotMovie', 1)->where('status', 1)->orderBy('updated_at', 'DESC')->take(4)->get();
        $tag = $tag;
        $movie = Movie::where('tags', 'LIKE', '%' . $tag . '%')->orderBy('updated_at', 'DESC')->paginate(16);
        $tagFirstVideo = $movie->first();
        $user = Auth::user();
        $package = Package::where('status', 1)->get();
        if ($user) {
            // Lấy thông báo khi có user đang đăng nhập, có mua gói và có expired_at lớn hơn ngày hiện tại
            $notification = Notification::where('package_id', $user->package_id)
                ->where('expired_at', '>', Carbon::now())
                ->get();
        } else {
            $notification = [];
        }
        // Đếm số lượng thông báo
        $notificationCount = count($notification);
        //thay vì get() để lấy hết thì ta dùng paginate() để phân trang, ví dụ paginate(2) có nghĩa là hiển thị 2 phim trên mỗi trang
        return view('pages.tag', compact('genre', 'country', 'tag', 'movie', 'hot_sidebar', 'hot_trailer', 'user', 'tagFirstVideo', 'user', 'package', 'notification', 'notificationCount'));
    }

    //Menu Thể Loại:
    public function genre($slug)
    {
        $user = Auth::user();
        $country = Country::orderBy('id', 'DESC')->where('status', 1)->get();
        $hot_trailer = Movie::where('resolution', 5)->where('status', 1)->orderBy('updated_at', 'DESC')->take(4)->get();
        $hot_sidebar = Movie::where('isHotMovie', 1)->where('status', 1)->orderBy('updated_at', 'DESC')->take(4)->get();

        $genre = Genre::orderBy('id', 'DESC')->where('status', 1)->get();
        $genre_slug = Genre::where('slug', $slug)->first();
        //Lọc ra trong 1 thể loại có những phim nào:
        $movie_genre = Movie_Genre::where('genre_id', $genre_slug->id)->get();
        $many_genre = [];
        foreach ($movie_genre as $key => $item) {
            $many_genre[] = $item->movie_id;
        }
        // return response()->json($many_genre); //kiểm tra thử lấy dữ liệu ra đã đúng chưa

        $movie = Movie::whereIn('id', $many_genre)->where('status', 1)->orderBy('updated_at', 'DESC')->paginate(16);
        $genreFirstVideo = $movie->first();
        // Cách 2:
        // foreach($movie_genre as $item){
        //     $many_genre[] = $item->movie_id;
        // }
        // $movie = Movie::with('genre','category')->whereIn('id',$many_genre)->where('status',1)->orderBy('ngay_cap_nhat', 'DESC')->paginate(10);
        $user = Auth::user();
        $package = Package::where('status', 1)->get();
        if ($user) {
            // Lấy thông báo khi có user đang đăng nhập, có mua gói và có expired_at lớn hơn ngày hiện tại
            $notification = Notification::where('package_id', $user->package_id)
                ->where('expired_at', '>', Carbon::now())
                ->get();
        } else {
            $notification = [];
        }
        // Đếm số lượng thông báo
        $notificationCount = count($notification);
        return view('pages.genre', compact('genre', 'country', 'genre_slug', 'movie', 'hot_sidebar', 'hot_trailer', 'user', 'genreFirstVideo', 'user', 'package', 'notification', 'notificationCount'));
    }

    //Menu Quốc Gia:
    public function country($slug)
    {
        $user = Auth::user();
        $genre = Genre::orderBy('id', 'DESC')->where('status', 1)->get();
        $country = Country::orderBy('id', 'DESC')->where('status', 1)->get();
        $country_slug = Country::where('slug', $slug)->first();
        $hot_trailer = Movie::where('resolution', 5)->where('status', 1)->orderBy('updated_at', 'DESC')->take(4)->get();
        $hot_sidebar = Movie::where('isHotMovie', 1)->where('status', 1)->orderBy('updated_at', 'DESC')->take(4)->get();
        // Phim sẽ được chiếu ở video đầu trang:
        $countryFirstVideo = Movie::where('country_id', $country_slug->id)->where('status', 1)->first();
        $movie = Movie::where('country_id', $country_slug->id)->orderBy('updated_at', 'DESC')->paginate(16);
        $user = Auth::user();
        $package = Package::where('status', 1)->get();
        if ($user) {
            // Lấy thông báo khi có user đang đăng nhập, có mua gói và có expired_at lớn hơn ngày hiện tại
            $notification = Notification::where('package_id', $user->package_id)
                ->where('expired_at', '>', Carbon::now())
                ->get();
        } else {
            $notification = [];
        }
        // Đếm số lượng thông báo
        $notificationCount = count($notification);
        return view('pages.country', compact('genre', 'country', 'country_slug', 'movie', 'hot_sidebar', 'hot_trailer', 'user', 'countryFirstVideo', 'user', 'package', 'notification', 'notificationCount'));
    }



    //Menu Chi Tiết Phim:
    public function movie($slug)
    {
        $user = Auth::user();
        $genre = Genre::orderBy('id', 'DESC')->where('status', 1)->get();
        $country = Country::orderBy('id', 'DESC')->where('status', 1)->get();
        $package = Package::where('status', 1)->get();
        if ($user) {
            // Lấy thông báo khi có user đang đăng nhập, có mua gói và có expired_at lớn hơn ngày hiện tại
            $notification = Notification::where('package_id', $user->package_id)
                ->where('expired_at', '>', Carbon::now())
                ->get();
        } else {
            $notification = [];
        }
        // Đếm số lượng thông báo
        $notificationCount = count($notification);
        $hot_trailer = Movie::where('resolution', 5)->where('status', 1)->orderBy('updated_at', 'DESC')->take(4)->get();
        $hot_sidebar = Movie::where('isHotMovie', 1)->where('status', 1)->orderBy('updated_at', 'DESC')->take(4)->get();
        $movie = Movie::with('genre', 'country', 'movie_genre')->where('slug', $slug)->where('status', 1)->first();
        $episode_first = Episode::with('movie')->where('movie_id', $movie->id)->orderBy('episode', 'ASC')->take(1)->first(); //lấy ra 1 tập đầu tiên
        $episode = Episode::with('movie')->where('movie_id', $movie->id)->orderBy('episode', 'ASC')->get();
        $episode_uploaded = Episode::with('movie')->where('movie_id', $movie->id)->get();
        $episode_uploaded_count = $episode_uploaded->count(); //đếm xem mình đã upload lên bao nhiêu tập phim rồi
        $related = Movie::with('genre', 'country')->where('country_id', $movie->country->id)->orderBy(DB::raw('RAND()'))->whereNotIn('slug', [$slug])->get();
        //Mục đích: hiển thị slider các phim có liên quan, ở đây lấy các phim có cùng country như phim đang chiếu, cho random ngẫu nhiên chứ không lấy ASC hay DESC, và whereNotIn slug nghĩa là hiển thị ra các phim liên quan thì phải trừ ra cái phim đang chiếu

        // Tăng số lượt xem của phim và lưu vào DB:
        DB::table('viewmovies')->updateOrInsert(
            ['movie_id' => $movie->id],
            ['view_count' => DB::raw('view_count + 1')]
        );
        // Lấy giá trị view_count của phim
        $viewMovie = ViewMovie::where('movie_id', $movie->id)->value('view_count');
        //Đánh giá phim:
        $rating = Rating::where('movie_id', $movie->id)->avg('rating'); //avg (average: tính trung bình)
        $rating = round($rating); //round (làm tròn số)
        $count_total = Rating::where('movie_id', $movie->id)->count(); //tổng số lượt đánh giá

        return view('pages.movie', compact('genre', 'country', 'movie', 'episode', 'episode_first', 'episode_uploaded_count', 'related', 'hot_sidebar', 'hot_trailer', 'rating', 'count_total', 'user', 'viewMovie', 'package', 'notification', 'notificationCount'));
    }

    public function add_rating(Request $request)
    {
        // đối với hàm này, chỉ cho 1 địa chỉ ip thực hiện rating 1 lần duy nhất
        $data = $request->all();
        $user_id = $request->id();
        $rating_count = Rating::where('movie_id', $data['movie_id'])->where('user_id', $user_id)->count();
        if ($rating_count > 0) {
            echo 'exist';
        } else {
            $rating = new Rating();
            $rating->movie_id = $data['movie_id'];
            $rating->rating = $data['index'];
            $rating->user_id = $user_id;
            $rating->save();
            echo 'done';
        }
    }

    //Menu chiếu phim để xem:
    public function watch($slug, $ep)
    {
        $genre = Genre::orderBy('id', 'DESC')->where('status', 1)->get();
        $country = Country::orderBy('id', 'DESC')->where('status', 1)->get();
        $hot_trailer = Movie::where('resolution', 5)->where('status', 1)->orderBy('updated_at', 'DESC')->take(4)->get();
        $hot_sidebar = Movie::where('isHotMovie', 1)->where('status', 1)->orderBy('updated_at', 'DESC')->take(4)->get();
        $movie = Movie::with('genre', 'country', 'movie_genre', 'episode')->where('slug', $slug)->where('status', 1)->first();
        $episode_first = Episode::with('movie')->where('movie_id', $movie->id)->orderBy('episode', 'ASC')->take(1)->first(); //lấy ra 1 tập đầu tiên
        $episode = Episode::with('movie')->where('movie_id', $movie->id)->orderBy('episode', 'ASC')->get();
        $episode_uploaded = Episode::with('movie')->where('movie_id', $movie->id)->get();
        $episode_uploaded_count = $episode_uploaded->count(); //đếm xem mình đã upload lên bao nhiêu tập phim rồi
        if (isset($ep)) {
            $getEpisode = $ep;
            $getEpisode = substr($ep, 4, 20); //cắt chuỗi, với mong muốn chỉ lấy số 1,2,3,15,16... trong chuỗi "tap-15" xuất hiện trong đường dẫn tại trang watch:
            //http://127.0.0.1:8000/xem-phim/doraemon-chu-meo-may-den-tu-tuong-lai/tap-15
            //muốn kiểm tra lấy đúng dữ liệu cần lấy hay chưa, thì gõ lệnh:
            //dd($tapphim);
            $episode = Episode::where('movie_id', $movie->id)->where('episode', $getEpisode)->first();
        } else {
            $getEpisode = 1;
            $episode = Episode::where('movie_id', $movie->id)->where('episode', $getEpisode)->first();
        }
        $related = Movie::with('genre', 'country')->where('country_id', $movie->country->id)->orderBy(DB::raw('RAND()'))->whereNotIn('slug', [$slug])->get();
        //Mục đích: hiển thị slider các phim có liên quan, ở đây lấy các phim có cùng category như phim đang chiếu, cho random ngẫu nhiên chứ không lấy ASC hay DESC, và whereNotIn slug nghĩa là hiển thị ra các phim liên quan thì phải trừ ra cái phim đang chiếu

        $userId = Auth::id();
        $user = User::find($userId);
        $package = Package::where('status', 1)->get();
        if ($user) {
            // Lấy thông báo khi có user đang đăng nhập, có mua gói và có expired_at lớn hơn ngày hiện tại
            $notification = Notification::where('package_id', $user->package_id)
                ->where('expired_at', '>', Carbon::now())
                ->get();
        } else {
            $notification = [];
        }
        // Đếm số lượng thông báo
        $notificationCount = count($notification);
        //Đánh giá phim:
        $rating = Rating::where('movie_id', $movie->id)->avg('rating'); //avg (average: tính trung bình)
        $rating = round($rating); //round (làm tròn số)
        $count_total = Rating::where('movie_id', $movie->id)->count(); //tổng số lượt đánh giá
        // Lấy giá trị view_count của phim
        $viewMovie = ViewMovie::where('movie_id', $movie->id)->value('view_count');

        return view('pages.watch', compact('getEpisode', 'genre', 'country', 'movie', 'episode', 'hot_sidebar', 'hot_trailer', 'related', 'userId', 'user', 'episode_first', 'rating', 'count_total', 'episode', 'episode_uploaded', 'episode_uploaded_count', 'package', 'notification', 'notificationCount', 'viewMovie'));
    }

    public function policy_page()
    {
        $genre = Genre::orderBy('id', 'DESC')->where('status', 1)->get();
        $country = Country::orderBy('id', 'DESC')->where('status', 1)->get();
        $user = Auth::user();
        $package = Package::where('status', 1)->get();
        if ($user) {
            // Lấy thông báo khi có user đang đăng nhập, có mua gói và có expired_at lớn hơn ngày hiện tại
            $notification = Notification::where('package_id', $user->package_id)
                ->where('expired_at', '>', Carbon::now())
                ->get();
        } else {
            $notification = [];
        }
        // Đếm số lượng thông báo
        $notificationCount = count($notification);
        return view('pages.policy', compact('genre', 'country', 'user', 'package', 'notification', 'notificationCount'));
    }
    public function term_page()
    {
        $genre = Genre::orderBy('id', 'DESC')->where('status', 1)->get();
        $country = Country::orderBy('id', 'DESC')->where('status', 1)->get();
        $user = Auth::user();
        $package = Package::where('status', 1)->get();
        if ($user) {
            // Lấy thông báo khi có user đang đăng nhập, có mua gói và có expired_at lớn hơn ngày hiện tại
            $notification = Notification::where('package_id', $user->package_id)
                ->where('expired_at', '>', Carbon::now())
                ->get();
        } else {
            $notification = [];
        }
        // Đếm số lượng thông báo
        $notificationCount = count($notification);
        return view('pages.term', compact('genre', 'country', 'user', 'package', 'notification', 'notificationCount'));
    }

}