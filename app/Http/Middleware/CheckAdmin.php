<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class CheckAdmin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (Auth::check() && Auth::user()->is_admin == 1 && Auth::user()->status == 1) {
            return $next($request);
        }
        Auth::logout();
        return redirect()->route('login')->with('error', 'Tên đăng nhập hoặc mật khẩu chưa đúng hoặc bạn không có quyền truy cập vào phần này!');
    }
}
