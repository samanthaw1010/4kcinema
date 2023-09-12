<?php

namespace App\Http\Controllers;

use App\Models\Movie;
use App\Models\Bookmark;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BookmarkController extends Controller
{
    public function add_bookmark(Request $request)
    {
        $movieId = $request->input('movieID_post');
        $user = Auth::user();
        $movie = Movie::findOrFail($movieId);

        // Kiểm tra xem movie đã được thêm vào bookmark chưa
        // chỗ này sẽ không dùng where vì phần tử trả về từ phương thức where() là một Collection (tập hợp), không phải là một giá trị đơn lẻ, sẽ không dùng phép so sánh true false được
        if ($user->bookmark->contains('movie_id', $movieId)) {
            return redirect()->back()->with('error', 'Phim này đã tồn tại trong Bookmark.');
        }
        // Lấy danh sách phim yêu thích của người dùng
        $bookmarkedMovies = $user->bookmark->pluck('movie');

        // Tạo bản ghi Bookmark mới và lưu vào cơ sở dữ liệu
        $add = new Bookmark();
        $add->user_id = $user->id;
        $add->movie_id = $movie->id;
        $add->save();
        return redirect()->back()
            ->with('success', 'Thêm phim vào Bookmark thành công!')
            ->with('bookmarkedMovies', $bookmarkedMovies);
    }
    public function delete_bookmark($id)
    {
        $bookmark = Bookmark::where('movie_id', $id)->first();

        if (!$bookmark) {
            return redirect()->back()->with('error', 'Bookmark không tồn tại.');
        }

        $bookmark->delete();

        return redirect()->back()->with('success', 'Bookmark đã được xóa thành công.');
    }

    // ADMIN
    public function crud_bookmark()
    {
        $user = User::with('bookmark')->get();
        $many_user = [];
        foreach ($user as $key => $item) {
            $many_user[] = $item->id;
        }

        $movie = Movie::with('bookmark')->get();
        $many_movie = [];
        foreach ($movie as $key => $item) {
            $many_movie[] = $item->id;
        }

        $bookmarkCounts = Bookmark::whereIn('user_id', $many_user)
            ->whereIn('movie_id', $many_movie)
            ->groupBy('user_id')
            ->selectRaw('user_id, count(movie_id) as movie_count')
            ->get();

        return view('admincp.bookmark.index', compact('user', 'movie', 'bookmarkCounts'));
    }

}