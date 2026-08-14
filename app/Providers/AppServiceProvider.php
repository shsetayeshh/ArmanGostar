<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
        public static function redirectAfterLogin(): string
    {
        return '/'; // کاربر بعد از لاگین برگرده به صفحه اصلی سایت
    }
}
