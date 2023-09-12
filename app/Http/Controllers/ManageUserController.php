<?php

namespace App\Http\Controllers;

use App\Models\Package;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class ManageUserController extends Controller
{
    public function create()
    {
        $list = User::all(); //lấy tất cả dữ liệu ra
        $user = Auth::user();
        $package = Package::all();
        return view('admincp.user.form', compact('list', 'package', 'user')); //thực hiện gửi list danh sách vào country form
    }
    public function index()
    {
        if (Auth::user()->role == 0) {
            $list = User::where('role', '1')->where('role', '<>', '0')->get();
        }
        $list = User::where('role', '2')->where('role', '<>', '0')->where('role', '<>', '1')->get();

        $user = Auth::user();
        $package = Package::all();
        return view('admincp.user.index', compact('list', 'package', 'user')); //thực hiện gửi list danh sách vào country form
    }

    public function store(Request $request)
    {
        $data = $request->all();
        $email_check_exist = User::where('email', $data['email'])->count();
        if ($email_check_exist) {
            return redirect()->back()->with('error', 'Email này đã tồn tại trong hệ thống!');
        } else {
            $user = new User();
            $user->name = $data['name'];
            $user->email = $data['email'];
            $user->password = Hash::make($data['password']);
            $user->role = $data['role'];
            $user->remember_token = Str::random(50);
            $user->save(); //Lưu vào bảng users trong DB
            return redirect()->route('manageUser.index')->with('success', 'Thêm tài khoản thành công!');
        }
    }

    public function edit($id)
    {
        $user = User::find($id);
        if (Auth::user()->role == 0) {
            $list = User::where('role', '1')->where('role', '<>', '0')->get();
        }
        $list = User::where('role', '2')->where('role', '<>', '0')->where('role', '<>', '1')->get();
        // Kiểm tra mật khẩu nguyên bản
        if (Hash::check('password', $user->password)) {
            // Mật khẩu khớp
            $plainPassword = 'password';
        } else {
            // Mật khẩu không khớp
            $plainPassword = null;
        }
        // Hiển thị mật khẩu nguyên bản
        echo $plainPassword;
        if (!$user) {
            abort(404);
        }
        return view('admincp.user.index', compact('list', 'user', 'plainPassword')); //thực hiện gửi list danh sách vào user form
    }

    public function update(Request $request, $id)
    {
        $data = $request->all();
        $user = User::find($id);
        if (isset($data['role'])) {
            $user->role = $data['role'];
        }
        $user->role = $user->role;
        $user->remember_token = Str::random(50);
        $user->save(); //Lưu vào bảng users trong DB
        return redirect()->route('manageUser.index')->with('success', 'Thay đổi thông tin thành công!');
    }

    public function inactive_user($id)
    {
        $user = User::find($id);
        $user->status = 0;
        $user->save();
        return redirect()->route('manageUser.index');
    }
    public function active_user($id)
    {
        $user = User::find($id);
        $user->status = 1;
        $user->save();
        return redirect()->route('manageUser.index');
    }
}