<!DOCTYPE html>
<html lang="fa" dir="rtl">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $title ?? 'آموزشگاه فنی و حرفه‌ای آرمان گستر' }}</title>
        @vite(['resources/css/app.css', 'resources/js/app.js'])
 
    <link href="https://fonts.googleapis.com/css2?family=Vazirmatn:wght@300;400;500;600;700;800;900&family=JetBrains+Mono:wght@500;700&display=swap" rel="stylesheet">
    <style>
        html {
            scroll-behavior: smooth;
        }

        ::selection {
            background: #F5A623;
            color: #1C2024;
        }

        .grain {
            background-color: #1C2024;
            background-image:
                radial-gradient(circle at 10% 10%, rgba(245, 166, 35, 0.06), transparent 35%),
                radial-gradient(circle at 90% 80%, rgba(193, 56, 31, 0.10), transparent 40%);
        }

        .flap-row {
            perspective: 400px;
        }

        .flap-inner {
            transform-style: preserve-3d;
            transition: transform .28s cubic-bezier(.5, 0, .5, 1);
            transform-origin: center;
        }

        .flap-inner.flip {
            transform: rotateX(-90deg);
        }

        @keyframes pulseDot {

            0%,
            100% {
                opacity: 1
            }

            50% {
                opacity: .3
            }
        }

        .pulse-dot {
            animation: pulseDot 2s ease-in-out infinite;
        }

        @media (prefers-reduced-motion: reduce) {

            .flap-inner,
            .pulse-dot {
                animation: none !important;
                transition: none !important;
            }
        }

        .card-hover {
            transition: transform .25s ease;
        }

        .card-hover:hover {
            transform: translateY(-4px);
        }

        .underline-grow {
            position: relative;
        }

        .underline-grow::after {
            content: '';
            position: absolute;
            right: 0;
            bottom: -3px;
            height: 2px;
            width: 0%;
            background: #F5A623;
            transition: width .3s ease;
        }

        .underline-grow:hover::after {
            width: 100%;
        }
    </style>
</head>

<body class="bg-paper text-graphite">

   <header class="sticky top-0 z-50 bg-graphite/95 backdrop-blur border-b border-amber/20" x-data="{ mobileMenuOpen: false }">
    <div class="max-w-7xl mx-auto px-6 lg:px-10 h-20 flex items-center justify-between">
        <a href="{{ url('/') }}" class="flex items-center gap-2">
            <span class="w-9 h-9 bg-amber rounded flex items-center justify-center text-graphite font-black tech-label text-sm">آ</span>
            <span class="text-paper font-bold text-lg">آموزشگاه آرمان گستر</span>
        </a>

        <!-- منوی دسکتاپ -->
        <nav class="hidden md:flex items-center gap-9 text-paper/75 text-sm font-medium">
            <a href="{{ url('/') }}#top" class="underline-grow hover:text-amber transition">خانه</a>
            <a href="{{ url('/') }}#courses" class="underline-grow hover:text-amber transition">دوره‌ها</a>
            <a href="{{ url('/') }}#why" class="underline-grow hover:text-amber transition">چرا آرمان</a>
            <a href="{{ url('/') }}#contact" class="underline-grow hover:text-amber transition">تماس با ما</a>
        </nav>

        <!-- دکمه‌های سمت راست، فقط دسکتاپ -->
        <div class="hidden md:flex items-center gap-3">
            <a href="{{ url('/') }}#contact" class="bg-amber text-graphite font-bold px-5 py-2.5 rounded text-sm hover:bg-[#ffb845] transition whitespace-nowrap">
                مشاوره رایگان
            </a>

            @guest
                <a href="/login" class="text-paper/60 hover:text-amber text-sm font-medium transition whitespace-nowrap">
                    ورود | ثبت‌نام
                </a>
            @endguest

            @auth
                @if(auth()->user()->is_admin)
                    <a href="/admin" class="text-paper/60 hover:text-amber text-sm font-medium transition whitespace-nowrap">
                        ورود به پنل مدیریت
                    </a>
                @else
                    <a href="/profile" class="text-paper/60 hover:text-amber text-sm font-medium transition whitespace-nowrap">
                        {{ Auth::user()->name }}
                    </a>
                @endif

                <form method="POST" action="/logout" class="inline">
                    @csrf
                    <button type="submit" class="text-crimson hover:text-red-400 text-sm font-medium transition whitespace-nowrap">
                        خروج
                    </button>
                </form>
            @endauth
        </div>

        <!-- دکمه‌ی همبرگر، فقط موبایل -->
        <button @click="mobileMenuOpen = !mobileMenuOpen" class="md:hidden text-paper p-2">
            <svg x-show="!mobileMenuOpen" class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path>
            </svg>
            <svg x-show="mobileMenuOpen" x-cloak class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
            </svg>
        </button>
    </div>

    <!-- پنل کشویی موبایل -->
    <div x-show="mobileMenuOpen" x-cloak x-transition
         @click.away="mobileMenuOpen = false"
         class="md:hidden bg-graphite border-t border-amber/10 px-6 py-6 flex flex-col gap-5 text-paper/80 text-sm font-medium">

        <a href="{{ url('/') }}#top" class="hover:text-amber transition">خانه</a>
        <a href="{{ url('/') }}#courses" class="hover:text-amber transition">دوره‌ها</a>
        <a href="{{ url('/') }}#why" class="hover:text-amber transition">چرا آرمان</a>
        <a href="{{ url('/') }}#contact" class="hover:text-amber transition">تماس با ما</a>

        <a href="{{ url('/') }}#contact" class="bg-amber text-graphite font-bold px-5 py-3 rounded text-sm text-center hover:bg-[#ffb845] transition">
            مشاوره رایگان
        </a>

        <div class="border-t border-paper/10 pt-5 flex flex-col gap-4">
            @guest
                <a href="/login" class="text-paper/60 hover:text-amber transition">ورود | ثبت‌نام</a>
            @endguest

            @auth
                @if(auth()->user()->is_admin)
                    <a href="/admin" class="text-paper/60 hover:text-amber transition">ورود به پنل مدیریت</a>
                @else
                    <a href="/profile" class="text-paper/60 hover:text-amber transition">{{ Auth::user()->name }}</a>
                @endif

                <form method="POST" action="/logout">
                    @csrf
                    <button type="submit" class="text-crimson hover:text-red-400 transition">خروج</button>
                </form>
            @endauth
        </div>
    </div>
</header>

    <main>
        {{ $slot }}
    </main>
    <!-- پاپ‌آپ ثبت‌نام ترم جدید -->
<div x-data="{
        show: false,
        countdownText: '',
        init() {
            if (!sessionStorage.getItem('termPopupSeen')) {
                setTimeout(() => { this.show = true; sessionStorage.setItem('termPopupSeen', '1'); }, 1200);
            }
            this.updateCountdown();
            setInterval(() => this.updateCountdown(), 1000);
        },
        updateCountdown() {
            const target = new Date('2026-09-15T00:00:00');
            const now = new Date();
            const diff = target - now;
            if (diff <= 0) { this.countdownText = 'ترم شروع شد'; return; }
            const days = Math.floor(diff / 86400000);
            const hours = Math.floor((diff % 86400000) / 3600000);
            this.countdownText = days + ' روز و ' + hours + ' ساعت مانده';
        }
     }"
     x-show="show"
     x-cloak
     x-transition:enter="transition ease-out duration-300"
     x-transition:enter-start="opacity-0"
     x-transition:enter-end="opacity-100"
     class="fixed inset-0 z-[200] flex items-center justify-center bg-black/70 backdrop-blur-sm p-4"
     @click.self="show = false">

    <div class="relative bg-graphite border border-amber/30 rounded-2xl w-full max-w-md p-8 text-center shadow-2xl overflow-hidden"
         x-transition:enter="transition ease-out duration-300 delay-100"
         x-transition:enter-start="opacity-0 scale-95"
         x-transition:enter-end="opacity-100 scale-100">

        <!-- افکت پس‌زمینه -->
        <div class="absolute -top-10 -right-10 w-40 h-40 bg-amber/20 rounded-full blur-3xl"></div>
        <div class="absolute -bottom-10 -left-10 w-40 h-40 bg-crimson/20 rounded-full blur-3xl"></div>

        <button @click="show = false" class="absolute top-4 left-4 text-paper/40 hover:text-amber text-xl">&times;</button>

        <span class="tech-label text-amber text-xs mb-4 inline-block">ثبت‌نام ترم جدید آغاز شد</span>
        <h2 class="text-paper font-black text-3xl mb-3 leading-tight">جای خودت رو<br/>رزرو کن</h2>
        <p class="text-paper/60 text-sm mb-6">ظرفیت کارگاه‌های ترم جدید محدوده. زودتر ثبت‌نام کنی، زودتر مهارتت رو شروع می‌کنی.</p>

        <div class="bg-amber/10 border border-amber/20 rounded-xl py-3 px-4 mb-6">
            <p class="tech-label text-amber font-bold text-lg" x-text="countdownText"></p>
        </div>

        <a href="{{ url('/') }}#contact" @click="show = false"
           class="block w-full bg-amber hover:bg-[#ffb845] text-graphite font-bold py-4 rounded transition">
            رزرو مشاوره‌ی رایگان
        </a>
    </div>
</div>

    <footer class="bg-graphite border-t border-amber/10 py-14">
        <div class="max-w-7xl mx-auto px-6 lg:px-10 grid md:grid-cols-4 gap-10">
            <div>
                <p class="text-paper font-bold text-lg mb-3">آموزشگاه آرمان گستر </p>
                <p class="text-paper/45 text-sm leading-relaxed">اسلامشهر،خیابان امام محمدباقر،کوچه 25 (اوتادی)،پلاک 45 .</p>
            </div>
            <div>
                <p class="text-paper font-semibold mb-3 text-sm">دسترسی سریع</p>
                <ul class="space-y-2 text-paper/45 text-sm">
                    <li><a href="/#courses" class="hover:text-amber">دوره‌ها</a></li>
                    <li><a href="/#why" class="hover:text-amber">چرا آرمان گستر</a></li>
                    <li><a href="/#contact" class="hover:text-amber">ثبت‌ نام</a></li>
                </ul>
            </div>
            <div>
                <p class="text-paper font-semibold mb-3 text-sm">تماس</p>
                <ul class="space-y-2 text-paper/45 text-sm tech-label">
                    <li>021-56341570</li>
                    <li>021-56120519</li>
                    <li>09125249445</li>
                </ul>
            </div>
            <div>
                <p class="text-paper font-semibold mb-3 text-sm">ما را دنبال کنید</p>
                <div class="flex gap-3">
                    <a href="https://instagram.com/armangostar_inst" target="_blank" class="w-9 h-9 rounded border border-paper/15 flex items-center justify-center text-paper/50 hover:text-amber hover:border-amber transition tech-label text-xs">Ig</a>
                    <a href="https://t.me/armangostar_inst"  target="_blank" class="w-9 h-9 rounded border border-paper/15 flex items-center justify-center text-paper/50 hover:text-amber hover:border-amber transition tech-label text-xs">Tg</a>
                </div>
            </div>
        </div>
        <div class="max-w-7xl mx-auto px-6 lg:px-10 mt-10 pt-6 border-t border-paper/10 text-paper/25 text-xs text-center tech-label">
            © 1404 ARMANGOSTAR VOCATIONAL INSTITUTE — تمام حقوق محفوظ است.
        </div>
    </footer>

</body>

</html>