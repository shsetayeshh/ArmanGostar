<x-app-layout>
    <div class="max-w-3xl mx-auto px-4 py-12">

        <div class="bg-steel/40 border border-paper/10 rounded-2xl p-8">
            <h2 class="text-2xl font-bold mb-2">ویرایش پروفایل</h2>
            <p class="text-paper/50 text-sm mb-8">اطلاعات حساب کاربری خود را مدیریت کنید.</p>

            <form method="POST" action="/profile/update" class="space-y-6">
                @csrf
                @method('PUT') 

                <div>
                    <label class="block text-paper/70 text-sm mb-2">نام و نام خانوادگی</label>
                    <input type="text" name="name" value="{{ Auth::user()->name }}" required
                        class="w-full bg-paper/10 border border-paper/20 text-paper placeholder-paper/40 rounded px-4 py-3 focus:outline-none focus:border-amber tech-label text-sm">
                </div>

                
                <div>
                    <label class="block text-paper/70 text-sm mb-2">ایمیل</label>
                    <input type="email" name="email" value="{{ Auth::user()->email }}" required
                        class="w-full bg-paper/10 border border-paper/20 text-paper placeholder-paper/40 rounded px-4 py-3 focus:outline-none focus:border-amber tech-label text-sm">
                </div>

                <!-- دکمه ذخیره -->
                <div class="flex items-center justify-end gap-4">
                    <a href="/" class="text-paper/50 hover:text-amber text-sm transition">انصراف</a>
                    <button type="submit" class="bg-amber hover:bg-[#ffb845] text-graphite font-bold px-8 py-3 rounded transition">
                        ذخیره تغییرات
                    </button>
                </div>
            </form>
        </div>
        <!-- لیست دوره‌های من -->
        <div class="bg-steel/40 border border-paper/10 rounded-2xl p-8 mt-8">
            <h2 class="text-2xl font-bold mb-6">دوره‌های من</h2>

            @if(auth()->user()->enrollments->count() > 0)
            <div class="space-y-4">
                @foreach(auth()->user()->enrollments as $enrollment)
                <div class="flex items-center justify-between bg-paper/5 rounded-xl p-4 border border-paper/10">
                    <div>
                        <h3 class="font-bold text-paper">{{ $enrollment->course->title }}</h3>
                        <p class="text-paper/50 text-sm mt-1 tech-label">تاریخ درخواست: {{ $enrollment->created_at->format('Y/m/d') }}</p>
                    </div>
                    <div class="text-left">
                        @if($enrollment->status == 'approved')
                        <span class="bg-green-900/30 text-green-400 text-xs px-3 py-1 rounded-full">تایید شده</span>
                        @elseif($enrollment->status == 'rejected')
                        <span class="bg-red-900/30 text-red-400 text-xs px-3 py-1 rounded-full">رد شده</span>
                        @else
                        <span class="bg-yellow-900/30 text-yellow-400 text-xs px-3 py-1 rounded-full">در انتظار بررسی</span>
                        @endif
                    </div>
                </div>
                @endforeach
            </div>
            @else
            <p class="text-paper/50 text-sm">شما هنوز برای هیچ دوره‌ای درخواست ثبت‌نام نداده‌اید.</p>
            @endif
        </div>

        <!-- پیام موفقیت آمیز -->
        @if(session('success'))
        <div class="mt-4 text-center text-sm text-green-400 bg-green-900/20 border border-green-400/30 rounded px-4 py-3">
            {{ session('success') }}
        </div>
        @endif

    </div>
</x-app-layout>