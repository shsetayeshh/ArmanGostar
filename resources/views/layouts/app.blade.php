<!DOCTYPE html>
<html lang="fa" dir="rtl">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'آموزشگاه آرمان گستر') }}</title>
     @vite(['resources/css/app.css', 'resources/js/app.js'])
  
    <link href="https://fonts.googleapis.com/css2?family=Vazirmatn:wght@300;400;500;600;700;800;900&family=JetBrains+Mono:wght@500;700&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Vazirmatn', sans-serif; }
        .tech-label { font-family: 'JetBrains Mono', monospace; }
    </style>
</head>
<body class="min-h-screen bg-graphite text-paper">
    
    <!-- هدر سایت برای کاربران لاگین شده -->
    <header class="sticky top-0 z-50 bg-graphite/95 backdrop-blur border-b border-amber/20">
        <div class="max-w-7xl mx-auto px-6 lg:px-10 h-20 flex items-center justify-between">
            <!-- لوگوی آرمان گستر به جای لاراول -->
            <a href="/" class="flex items-center gap-2">
                <span class="w-9 h-9 bg-amber rounded flex items-center justify-center text-graphite font-black tech-label text-sm">آ</span>
                <span class="text-paper font-bold text-lg">آموزشگاه آرمان گستر</span>
            </a>

            <div class="flex items-center gap-4">
                <a href="/" class="text-paper/60 hover:text-amber text-sm transition">بازگشت به سایت</a>
                
                <!-- منوی کاربر -->
                <div class="relative" x-data="{ open: false }">
                    <button @click="open = !open" class="flex items-center gap-2 text-paper/80 hover:text-amber transition">
                        <span class="text-sm font-medium">{{ Auth::user()->name }}</span>
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg>
                    </button>

                    <!-- منوی کشویی -->
                    <div x-show="open" @click.away="open = false" x-transition class="absolute left-0 mt-2 w-48 bg-steel border border-paper/10 rounded-xl shadow-xl overflow-hidden">
                        <a href="/profile" class="block px-4 py-3 text-sm text-paper/70 hover:bg-amber/10 hover:text-amber transition">پروفایل من</a>
                        <form method="POST" action="/logout" class="block">
                            @csrf
                            <button type="submit" class="w-full text-right px-4 py-3 text-sm text-crimson hover:bg-red-900/20 transition">خروج از حساب</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </header>

    <!-- محتوای صفحه -->
    <main>
        {{ $slot }}
    </main>
</body>
</html>