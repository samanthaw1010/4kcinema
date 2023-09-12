<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    // protected $redirectTo = RouteServiceProvider::HOME;

    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    public function log_in()
    {
        return view('auth.login');
    }

    public function log_in_post(Request $request)
    {
        $check_data = [
            'email' => $request->login_email,
            'password' => $request->login_password,
            'status' => 1, // Chỉ cho những tài khoản có status = 1 được login thôi
        ];

        $remember = $request->has('remember'); // Chỗ này dùng để "Ghi nhớ đăng nhập" nè

        if (Auth::attempt($check_data, $remember)) {
            // Xác thực thành công thì lấy thông tin để kiểm tra quyền truy cập bằng "role":
            $user = Auth::user();

            if ($user->role == 1 || $user->role == 0) {
                return redirect()->route('dashboard')->with('success', 'Welcome back ' . $user->name . '!');
            } elseif ($user->role == 2) {
                return redirect()->back()->with('success', 'Welcome back ' . $user->name . '!');
            }
        } else {
            return back()->with('error', 'Sai thông tin hoặc tài khoản đã bị khóa!');
        }
    }

}