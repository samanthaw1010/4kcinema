<?php
//=====QUẢN LÝ THÔNG TIN NGƯỜI DÙNG Ở LANDING PAGE=====

namespace App\Http\Controllers;

use App\Models\Bookmark;
use App\Models\Country;
use App\Models\Episode;
use App\Models\Genre;
use App\Models\Movie;
use App\Models\Notification;
use App\Models\Package;
use App\Models\User;
use App\Models\User_Package;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;
use Nette\Utils\Image;

class UserController extends Controller
{
    public function setting_info()
    {
        $genre = Genre::orderBy('id', 'DESC')->get();
        $country = Country::orderBy('id', 'DESC')->get();
        $user = Auth::user();
        $user_package = User_Package::where('user_id', $user->id)->orderBy('purchase_date', 'DESC')->get();
        if ($user->package_id != 1) {
            $current_package = $user_package->first(); // Lấy gói mới nhất
            // return response()->json($many_genre);
            $past_package = $user_package->slice(1); // Loại bỏ gói mới nhất
        } else {
            $current_package = $user_package->first();
            $past_package = $user_package->all();
        }
        $many_package = $user_package->pluck('package_id')->toArray();
        // Cách 2:
        // $many_package = [];
        // foreach ($user_package as $key => $item) {
        //     $many_package[] = $item->package_id;
        // }
        $package = Package::whereIn('id', $many_package)->get();

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
        $bookmarkedMovies = $user->bookmark->pluck('movie');
        $bookmarkedMovies_id = $user->bookmark->pluck('movie_id');
        $teaserVideo = Episode::whereIn('movie_id', $bookmarkedMovies_id)->pluck('video720');
        return view('pages.information', compact('user', 'genre', 'country', 'package', 'current_package', 'past_package', 'bookmarkedMovies', 'teaserVideo', 'notification', 'notificationCount'));
    }
    public function back()
    {
        return redirect()->route('setting_info')->with('success', 'Hủy bỏ thay đổi!');
    }
    public function edit_information($id)
    {
        $user = User::find($id);
        $genre = Genre::orderBy('id', 'DESC')->get();
        $country = Country::orderBy('id', 'DESC')->get();
        $package = Package::where('id', $user->package_id)->first();
        if ($user) {
            // Lấy thông báo khi có user đang đăng nhập, có mua gói và có expired_at lớn hơn ngày hiện tại
            $notification = Notification::where('package_id', $user->package_id)
                ->where('expired_at', '>', Carbon::now('Asia/Ho_Chi_Minh'))
                ->get();
        } else {
            $notification = [];
        }
        // Đếm số lượng thông báo
        $notificationCount = count($notification);
        if (!$user) {
            abort("User invalid");
        }
        $bookmarkedMovies = $user->bookmark->pluck('movie');
        $bookmarkedMovies_id = $user->bookmark->pluck('movie_id');
        return view('pages.edit_information', compact('user', 'genre', 'country', 'package', 'notificationCount', 'bookmarkedMovies', 'bookmarkedMovies_id'));
    }

    public function update_information(Request $request, $id)
    {
        $data = $request->all();
        $userId = User::find($id);
        // Kiểm tra xem người dùng đã nhập tên mới khác với tên ban đầu hay không
        if ($data['edit_name'] !== $userId->name) {
            $userId->name = $data['edit_name'];
        } else {
            $userId->name = $userId->name;
        }

        // Kiểm tra xem người dùng đã nhập email mới khác với email ban đầu hay không
        if ($data['edit_email'] !== $userId->email) {
            $userId->email = $data['edit_email'];
        } else {
            $userId->email = $userId->email;
        }
        $userId->save();
        Auth::login($userId);
        return redirect()->route('setting_info')->with('success', 'Thay đổi thông tin thành công!');
    }

    public function log_out()
    {
        Auth::logout();
        return redirect()->to('/log-in');
    }

    public function password_reset(Request $request)
    {
        $data = $request->all();
        $user = User::where('email', $data['reset_email'])->first();
        $user->email = $data['reset_email'];
        $user->password = Hash::make($data['reset_password']);
        $user->save();
        Auth::login($user);
        return redirect()->to('/')->with('success', 'Thay đổi mật khẩu thành công!');
    }

    public function register_get()
    {
        return view('auth.register');
    }
    public function register_post(Request $request)
    {
        // Kiểm tra nếu email đã tồn tại trong DB
        $existingUser = User::where('email', $request->input('email'))->first();

        if ($existingUser) {
            return redirect()->back()->with('error', 'Email đã tồn tại trong hệ thống!');
        }

        // Lưu dữ liệu vào bảng users
        $user = new User();
        $user->name = $request->input('name');
        $user->email = $request->input('email');
        $user->password = bcrypt($request->input('password'));
        $user->remember_token = Str::random(50);
        $user->save();

        Auth::login($user);

        return redirect()->route('homepage');
    }

    public function cancel_package($id)
    {
        $user = User::find($id);
        //xóa package:
        $user->package_id = 1;
        $user->save();
        //xóa bookmark của người đó (vì package đã không còn nữa):
        Bookmark::whereIn('user_id', [$user->id])->delete();
        Auth::login($user);
        return redirect()->back()->with('success', 'Thay đổi thành công');
    }
}