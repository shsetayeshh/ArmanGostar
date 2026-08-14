<?php

use Illuminate\Http\Request;

define('LARAVEL_START', microtime(true));

// چک کردن حالت تعمیر سایت
if (file_exists($maintenance = __DIR__.'/../storage/framework/maintenance.php')) {
    require $maintenance;
}

// لود کردن پکیج‌ها
require __DIR__.'/../vendor/autoload.php';

// اجرای لاراول
(require_once __DIR__.'/../bootstrap/app.php')
    ->handleRequest(Request::capture());