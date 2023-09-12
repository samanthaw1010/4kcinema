<?php
//QUẢN LÝ CÁC CHỨC NĂNG Ở TRANG ADMIN THỂ LOẠI
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Genre;

class GenreController extends Controller
{
    public function index()
    {
        $list = Genre::all(); //lấy tất cả dữ liệu ra
        return view('admincp.genre.index', compact('list')); //thực hiện gửi list danh sách vào country -> form
    }

    public function create()
    {
        return view('admincp.genre.form');
    }

    public function store(Request $request)
    {
        $data = $request->all();
        $genre_check_exist = Genre::where('title', $data['title'])->count();
        if ($genre_check_exist) {
            return redirect()->back()->with('error', 'Thể loại bạn nhập đã tồn tại trong danh sách!');
        } else {
            $genre = new Genre();
            $genre->title = $data['title'];
            $genre->description = $data['description'];
            $genre->status = $data['status'];
            $genre->slug = $data['slug'];
            $genre->save();
            return redirect()->route('genre.index')->with('success', 'Thêm thể loại thành công!');
        }
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        $genre = Genre::find($id);
        $list = Genre::all(); //lấy tất cả dữ liệu ra
        if (!$genre) {
            abort(404);
        }
        return view('admincp.genre.form', compact('list', 'genre')); //thực hiện gửi list danh sách vào form
    }

    public function update(Request $request, $id)
    {
        $data = $request->all();
        $genre = Genre::find($id);
        // Lấy ra tên các thể loại khác để kiểm tra trùng tên:
        $otherGenre = Genre::whereNotIn('title', [$genre->title])->pluck('title');
        $isDuplicate = $otherGenre->contains($data['title']);

        if ($isDuplicate) {
            return redirect()->back()->with('error', 'Tên thể loại đã tồn tại trong danh sách!');
        }

        // Tiếp tục xử lý khi không có tên trùng
        $genre->title = $data['title'];
        $genre->description = $data['description'];
        $genre->status = $data['status'];
        $genre->slug = $data['slug'];
        $genre->save();

        return redirect()->route('genre.index')->with('success', 'Chỉnh sửa thể loại thành công!');
    }

    public function hide_genre($id)
    {
        $genre = Genre::find($id);
        $genre->status = 0;
        $genre->save();
        return redirect()->route('genre.index');
    }
    public function show_genre($id)
    {
        $genre = Genre::find($id);
        $genre->status = 1;
        $genre->save();
        return redirect()->route('genre.index');
    }
}