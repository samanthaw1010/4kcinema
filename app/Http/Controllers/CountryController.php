<?php
//QUẢN LÝ CÁC CHỨC NĂNG Ở TRANG ADMIN QUỐC GIA
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Country;

class CountryController extends Controller
{
    public function index()
    {
        $list = Country::all(); //lấy tất cả dữ liệu ra
        return view('admincp.country.index', compact('list')); //thực hiện gửi list danh sách vào country -> form
    }

    public function create()
    {
        return view('admincp.country.form');
    }
    public function store(Request $request)
    {
        $data = $request->all();
        $country_check_exist = Country::where('title', $data['title'])->count();
        if ($country_check_exist) {
            return redirect()->back()->with('error', 'Quốc gia này đã tồn tại trong danh sách!');
        } else {
            $country = new Country();
            $country->title = $data['title'];
            $country->description = $data['description'];
            $country->status = $data['status'];
            $country->slug = $data['slug'];
            $country->save();
            return redirect()->route('country.index')->with('success', 'Thêm quốc gia thành công!');
        }
    }
    public function show($id)
    {
        //
    }
    public function edit($id)
    {
        $country = Country::find($id);
        $list = Country::all(); //lấy tất cả dữ liệu ra
        if (!$country) {
            abort(404);
        }
        return view('admincp.country.form', compact('list', 'country')); //thực hiện gửi list danh sách vào country form
    }
    public function update(Request $request, $id)
    {
        $data = $request->all();
        $country = Country::find($id);
        // Lấy ra tên các quốc gia khác để kiểm tra trùng tên:
        $otherCountry = Country::whereNotIn('title', [$country->title])->pluck('title');
        $isDuplicate = $otherCountry->contains($data['title']);

        if ($isDuplicate) {
            return redirect()->back()->with('error', 'Quốc gia bạn nhập đã tồn tại trong danh sách!');
        }

        // Tiếp tục xử lý khi không có tên trùng
        $country->title = $data['title'];
        $country->description = $data['description'];
        $country->status = $data['status'];
        $country->slug = $data['slug'];
        $country->save();

        return redirect()->route('country.index')->with('success', 'Chỉnh sửa quốc gia thành công!');
    }
    public function hide_country($id)
    {
        $country = Country::find($id);
        $country->status = 0;
        $country->save();
        return redirect()->route('country.index');
    }
    public function show_country($id)
    {
        $country = Country::find($id);
        $country->status = 1;
        $country->save();
        return redirect()->route('country.index');
    }
}