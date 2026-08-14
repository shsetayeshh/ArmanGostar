<x-guest-layout title="ثبت نام">
    <div class="bg-steel/40 border border-paper/10 rounded-2xl p-8">
        <h2 class="text-2xl font-bold mb-6">ایجاد حساب کاربری</h2>

        <form method="POST" action="{{ route('register') }}">
            @csrf

            <!-- نام -->
            <div class="mb-4">
                <label class="block text-paper/70 text-sm mb-2">نام و نام خانوادگی</label>
                <input type="text" name="name" value="{{ old('name') }}" required autofocus
                       class="w-full bg-paper/10 border border-paper/20 text-paper placeholder-paper/40 rounded px-4 py-3 focus:outline-none focus:border-amber tech-label text-sm">
                @error('name')
                    <p class="text-crimson text-xs mt-2">{{ $message }}</p>
                @enderror
            </div>

            <!-- ایمیل -->
            <div class="mb-4">
                <label class="block text-paper/70 text-sm mb-2">ایمیل</label>
                <input type="email" name="email" value="{{ old('email') }}" required
                       class="w-full bg-paper/10 border border-paper/20 text-paper placeholder-paper/40 rounded px-4 py-3 focus:outline-none focus:border-amber tech-label text-sm">
                @error('email')
                    <p class="text-crimson text-xs mt-2">{{ $message }}</p>
                @enderror
            </div>

            <!-- رمز عبور -->
            <div class="mb-4">
                <label class="block text-paper/70 text-sm mb-2">رمز عبور</label>
                <input type="password" name="password" required
                       class="w-full bg-paper/10 border border-paper/20 text-paper placeholder-paper/40 rounded px-4 py-3 focus:outline-none focus:border-amber tech-label text-sm">
                @error('password')
                    <p class="text-crimson text-xs mt-2">{{ $message }}</p>
                @enderror
            </div>

            <!-- تکرار رمز عبور -->
            <div class="mb-6">
                <label class="block text-paper/70 text-sm mb-2">تکرار رمز عبور</label>
                <input type="password" name="password_confirmation" required
                       class="w-full bg-paper/10 border border-paper/20 text-paper placeholder-paper/40 rounded px-4 py-3 focus:outline-none focus:border-amber tech-label text-sm">
                @error('password_confirmation')
                    <p class="text-crimson text-xs mt-2">{{ $message }}</p>
                @enderror
            </div>

            <!-- دکمه ثبت نام -->
            <button type="submit" class="w-full bg-amber hover:bg-[#ffb845] text-graphite font-bold py-3 rounded transition">
                ثبت‌نام
            </button>

            <p class="mt-6 text-center text-sm text-paper/50">
                قبلاً ثبت‌نام کرده‌اید؟ 
                <a href="/login" class="text-amber hover:text-[#ffb845] transition">وارد شوید</a>
            </p>
        </form>
    </div>
</x-guest-layout>