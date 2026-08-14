<!DOCTYPE html>
<html lang="fa" dir="rtl">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'Laravel') }}</title>
    @vite(['resources/css/app.css'])
    <link href="https://fonts.googleapis.com/css2?family=Vazirmatn:wght@300;400;500;600;700;800;900&family=JetBrains+Mono:wght@500;700&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Vazirmatn', sans-serif; }
        .tech-label { font-family: 'JetBrains Mono', monospace; }
    </style>
</head>
<body class="bg-graphite text-paper antialiased">
    
    <div class="min-h-screen flex flex-col items-center justify-center px-4 py-12">
        <!-- لوگوی آرمان گستر -->
        <a href="/" class="flex items-center gap-2 mb-10">
            <span class="w-10 h-10 bg-amber rounded flex items-center justify-center text-graphite font-black tech-label text-lg">آ</span>
            <span class="text-paper font-bold text-xl">آموزشگاه آرمان گستر</span>
        </a>

        <div class="w-full max-w-md">
            {{ $slot }}
        </div>
    </div>
</body>
</html>