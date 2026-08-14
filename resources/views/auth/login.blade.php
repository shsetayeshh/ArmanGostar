<x-guest-layout  title="ورود">
    @if(session('status'))
        <div class="mb-4 font-medium text-sm text-green-400 bg-green-900/20 border border-green-400/30 rounded px-4 py-3 text-center">
            {{ session('status') }}
        </div>
    @endif

    <div class="bg-steel/40 border border-paper/10 rounded-2xl p-8">
        <h2 class="text-2xl font-bold mb-6">ورود به حساب کاربری</h2>

        <form method="POST" action="{{ route('login') }}">
            @csrf

            <!-- ایمیل -->
            <div class="mb-4">
                <label class="block text-paper/70 text-sm mb-2">ایمیل</label>
                <input type="email" name="email" value="{{ old('email') }}" required autofocus
                       class="w-full bg-paper/10 border border-paper/20 text-paper placeholder-paper/40 rounded px-4 py-3 focus:outline-none focus:border-amber tech-label text-sm">
                @error('email')
                    <p class="text-crimson text-xs mt-2">{{ $message }}</p>
                @enderror
            </div>

            <!-- رمز عبور -->
            <div class="mb-6">
                <label class="block text-paper/70 text-sm mb-2">رمز عبور</label>
                <input type="password" name="password" required
                       class="w-full bg-paper/10 border border-paper/20 text-paper placeholder-paper/40 rounded px-4 py-3 focus:outline-none focus:border-amber tech-label text-sm">
                @error('password')
                    <p class="text-crimson text-xs mt-2">{{ $message }}</p>
                @enderror
            </div>

            <button type="submit" class="w-full bg-amber hover:bg-[#ffb845] text-graphite font-bold py-3 rounded transition">
                ورود
            </button>

            <div class="flex items-center justify-between mt-6 text-sm">
                @if (Route::has('password.request'))
                    <a href="{{ route('password.request') }}" class="text-amber/70 hover:text-amber transition">فراموشی رمز عبور؟</a>
                @else
                    <div></div>
                @endif
                <a href="/register" class="text-paper/50 hover:text-amber transition">ثبت‌نام نکرده‌اید؟</a>
            </div>
        </form>
    </div>
</x-guest-layout>