<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        if (Auth::check())
        {
            if (Auth::user() -> role == 'Admin')
            {
                return $next($request);
            }
            else
            {
                return redirect('/home/dashboard')->with('message', 'Bạn không có quyền truy cập trang này');
            }
        }
        else
        {
            return redirect('/login')->with('message', 'Bạn vui lòng đăng nhập tài khoản');
        }
    }
}
