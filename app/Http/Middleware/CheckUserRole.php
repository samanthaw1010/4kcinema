<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class CheckUserRole
{
    public function handle($request, Closure $next)
    {
        // Kiểm tra nếu role của người dùng không phù hợp, chuyển hướng về trang homepage
        if (Auth::check() && Auth::user()->role == 2) {
            return redirect('/');
        }

        return $next($request);
    }
}