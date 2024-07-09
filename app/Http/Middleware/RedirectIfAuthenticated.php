<?php

namespace App\Http\Middleware;

use App\Providers\RouteServiceProvider;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class RedirectIfAuthenticated
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, ...$guards): Response
    {
        $guards = empty($guards) ? [null] : $guards;

        foreach ($guards as $guard) {
            if (Auth::guard($guard)->check()) {
                // Thay đổi điều hướng ở đây
                if ($request->routeIs('password.reset')) {
                    // Nếu là yêu cầu đặt lại mật khẩu, không chuyển hướng
                    return $next($request);
                } else {
                    // Nếu là yêu cầu khác, chuyển hướng về trang chủ
                    return redirect(RouteServiceProvider::HOME);
                }
            }
        }

        return $next($request);
    }
}

