<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminMiddleware
{
    public function handle(Request $request, Closure $next)
    {
        // اگر کاربر لاگین نکرده بفرستش به صفحه لاگین ادمین
        if (!Auth::check()) {
            return redirect()->route('filament.admin.auth.login');
        }

        // اگر کاربر لاگین کرده ولی ادمین نیست، بفرستش بیرون!
        if (Auth::user()->is_admin != true) {
            // کاربر رو از تمام SESSION ها خارج کن (از سایت لاگ اوتش می‌کنه)
            Auth::logout();
            
            // بهش پیام بده دسترسی نداره و بفرستش به صفحه اصلی
            return redirect('/')->with('error', 'شما دسترسی به این بخش ندارید.');
        }

        return $next($request);
    }
}