<x-layout title="آموزشگاه فنی و حرفه‌ای آرمان گستر">

    <!-- HERO -->
    <section id="top" class="grain relative overflow-hidden py-20">
        <div class="max-w-7xl mx-auto px-6 lg:px-10 grid lg:grid-cols-2 gap-14 items-center">
            <div>
                <p class="tech-label text-amber text-xs mb-5 flex items-center gap-2">
                    <span class="w-2 h-2 rounded-full bg-amber pulse-dot"></span>
                    مجوز رسمی سازمان فنی و حرفه‌ای کشور
                </p>
                <h1 class="font-black text-paper text-5xl md:text-6xl leading-[1.2] mb-6">
                    مهارتی که<br/><span class="text-amber">کار می‌شود</span>
                </h1>
                <p class="text-paper/65 text-lg leading-relaxed max-w-md mb-10">
                    از کارگاه برنامه‌نویسی تا کارگاه اتومکانیک؛ آرمان گستر جایی‌ست که دانش تئوری، زیر دست شما به یک مهارت قابل‌ارائه در بازار کار تبدیل می‌شود.
                </p>
                <div class="flex flex-wrap gap-4 mb-14">
                    <a href="#courses" class="bg-amber hover:bg-[#ffb845] text-graphite font-bold px-8 py-4 rounded transition">مشاهده‌ی دوره‌ها</a>
                    <a href="#contact" class="border border-paper/25 text-paper px-8 py-4 rounded hover:border-amber hover:text-amber transition">ثبت‌نام حضوری</a>
                </div>
                <div class="flex gap-10 text-paper">
                    <div><p class="font-black text-3xl text-amber tech-label">+2400</p><p class="text-paper/50 text-sm mt-1">فارغ‌التحصیل</p></div>
                    <div><p class="font-black text-3xl text-amber tech-label">10</p><p class="text-paper/50 text-sm mt-1">رشته‌ی فعال</p></div>
                    <div><p class="font-black text-3xl text-amber tech-label">%87</p><p class="text-paper/50 text-sm mt-1">اشتغال پس از دوره</p></div>
                </div>
            </div>

            <div>
                <div class="bg-steel/40 border border-paper/10 rounded-2xl p-3 md:p-4 shadow-2xl shadow-black/40">
                    <div class="flex items-center justify-between px-2 pb-3 mb-2 border-b border-paper/10">
                        <span class="tech-label text-paper/40 text-xs">تابلوی کارگاه‌ها — امروز</span>
                        <span class="tech-label text-amber text-xs">LIVE</span>
                    </div>
                    <div id="flapBoard" class="flex flex-col gap-1.5"></div>
                </div>
                <p class="tech-label text-paper/30 text-xs text-center mt-3">ظرفیت کلاس‌ها به‌صورت لحظه‌ای به‌روزرسانی می‌شود</p>
            </div>
        </div>
    </section>

    <!-- COURSES (روشن) -->
    <section id="courses" class="py-24 bg-paper">
        <div class="max-w-7xl mx-auto px-6 lg:px-10">
            <div class="flex items-end justify-between mb-14 flex-wrap gap-4">
                <div>
                    <p class="tech-label text-crimson text-xs mb-3">نقشه‌ی کارگاه‌ها</p>
                    <h2 class="font-black text-4xl">رشته‌های آموزشی</h2>
                </div>
                <a href="#contact" class="text-steel hover:text-crimson font-semibold underline-grow">مشاوره‌ی انتخاب رشته ←</a>
            </div>

            <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-5">
               
                
                
                @foreach($courses as $course)
                <div class="card-hover bg-crimson rounded-2xl p-7 border border-crimson flex flex-col justify-between">
                    <div>
                        <span class="tech-label text-paper/70 text-xs block mb-8">{{ $course->workshop_number }}</span>
                        <h3 class="text-paper font-bold text-xl mb-2">{{ $course->title }}</h3>
                        <p class="text-paper/70 text-sm leading-relaxed mb-5">{{ \Str::limit($course->description, 100) }} ...</p>
                    </div>
                    <a href="{{ route('course.show', $course->slug) }}" class="tech-label text-paper text-xs underline">مشاهده‌ی لیست کامل ←</a>
                </div>
                @endforeach
    </section>

    <!-- WHY US (روشن‌شده) -->
    <section id="why" class="bg-white py-24 border-t border-graphite/5">
        <div class="max-w-7xl mx-auto px-6 lg:px-10">
            <p class="tech-label text-crimson text-xs mb-3">قبل از ثبت‌نام بدانید</p>
            <h2 class="font-black text-4xl text-graphite mb-14">چرا آرمان گستر؟</h2>
            <div class="grid md:grid-cols-4 gap-8">
                <div class="border-t-2 border-amber pt-5">
                    <h3 class="text-graphite font-bold text-lg mb-2">مدرک رسمی</h3>
                    <p class="text-graphite/55 text-sm leading-relaxed">مدرک معتبر و قابل استعلام از سازمان فنی و حرفه‌ای کشور.</p>
                </div>
                <div class="border-t-2 border-amber pt-5">
                    <h3 class="text-graphite font-bold text-lg mb-2">اساتید شاغل در صنعت</h3>
                    <p class="text-graphite/55 text-sm leading-relaxed">مدرسان ما هم‌زمان در حرفه‌ی خودشان فعال‌اند، نه فقط مدرّس.</p>
                </div>
                <div class="border-t-2 border-amber pt-5">
                    <h3 class="text-graphite font-bold text-lg mb-2">کارگاه عملی</h3>
                    <p class="text-graphite/55 text-sm leading-relaxed">حداقل ۶۰٪ ساعت هر دوره، کار عملی روی پروژه یا تجهیزات واقعی است.</p>
                </div>
                <div class="border-t-2 border-amber pt-5">
                    <h3 class="text-graphite font-bold text-lg mb-2">پرداخت اقساطی</h3>
                    <p class="text-graphite/55 text-sm leading-relaxed">امکان پرداخت شهریه در ۲ تا ۴ قسط، متناسب با هر دوره.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- CONTACT (تیره) -->
   <!-- CONTACT / مشاوره رایگان -->
    <section id="contact" class="grain py-24">
        <div class="max-w-md mx-auto px-6 text-center">
            <p class="tech-label text-amber text-xs mb-4">ظرفیت ترم جدید محدود است</p>
            <h2 class="font-black text-3xl md:text-4xl text-paper mb-5">برای مشاوره‌ی رایگان ثبت‌نام کنید</h2>
            <p class="text-paper/60 mb-10">کارشناس ما با شما تماس می‌گیرد و بهترین رشته را متناسب با هدف شغلی‌تان پیشنهاد می‌دهد.</p>

            @if(session('success'))
                <div class="mb-6 text-sm text-green-400 bg-green-900/20 border border-green-400/30 rounded px-4 py-3">
                    {{ session('success') }}
                </div>
            @endif

            @auth
            <form method="POST" action="{{ route('consultation.request') }}" class="space-y-3">
                @csrf
                <input type="text" name="name" required placeholder="نام و نام خانوادگی"
                       class="w-full bg-paper/10 border border-paper/20 text-paper placeholder-paper/40 rounded px-5 py-3 focus:outline-none focus:border-amber tech-label text-sm">
                @error('name') <p class="text-crimson text-xs text-right">{{ $message }}</p> @enderror

                <input type="tel" name="phone" required placeholder="شماره تماس"
                       class="w-full bg-paper/10 border border-paper/20 text-paper placeholder-paper/40 rounded px-5 py-3 focus:outline-none focus:border-amber tech-label text-sm">
                @error('phone') <p class="text-crimson text-xs text-right">{{ $message }}</p> @enderror

                <select name="course_id" required
                        class="w-full bg-paper/10 border border-paper/20 text-paper rounded px-5 py-3 focus:outline-none focus:border-amber tech-label text-sm appearance-none">
                    <option value="" disabled selected class="text-graphite">دوره‌ی مدنظرتان</option>
                    @foreach($courses as $course)
                        <option value="{{ $course->id }}" class="text-graphite">{{ $course->title }}</option>
                    @endforeach
                </select>
                @error('course_id') <p class="text-crimson text-xs text-right">{{ $message }}</p> @enderror

                <button class="w-full bg-amber hover:bg-[#ffb845] text-graphite font-bold px-6 py-3 rounded transition">
                    درخواست مشاوره
                </button>
            </form>
            @else
            <a href="/login" class="inline-block bg-amber hover:bg-[#ffb845] text-graphite font-bold px-8 py-4 rounded transition">
                برای درخواست مشاوره، ابتدا وارد حساب کاربری شوید
            </a>
            @endauth
        </div>
    </section>

    <script>
        const rows = [
            { icon: '💻', name: 'برنامه‌نویسی', a: 'ثبت‌نام باز', b: 'ظرفیت: ۶ نفر' },
            { icon: '🤖', name: 'هوش مصنوعی', a: 'ثبت‌نام باز', b: 'ظرفیت: ۴ نفر' },
            { icon: '🔧', name: 'اتومکانیک', a: 'ثبت‌نام باز', b: 'ظرفیت: ۸ نفر' },
            { icon: '📊', name: 'حسابداری', a: 'ثبت‌نام باز', b: 'ظرفیت: ۱۰ نفر' },
            { icon: '🖥️', name: 'ICDL', a: 'ثبت‌نام باز', b: 'ظرفیت: ۱۲ نفر' },
            { icon: '📐', name: 'نقشه‌کشی', a: 'ثبت‌نام باز', b: 'ظرفیت: ۵ نفر' },
        ];
        const board = document.getElementById('flapBoard');
        const states = [];
        rows.forEach((r) => {
            const row = document.createElement('div');
            row.className = 'flap-row bg-graphite rounded-lg overflow-hidden';
            row.innerHTML = `<div class="flap-inner flex items-center justify-between px-4 py-3">
                <span class="flex items-center gap-3">
                    <span class="text-lg">${r.icon}</span>
                    <span class="text-paper font-semibold text-sm">${r.name}</span>
                </span>
                <span class="tech-label text-amber text-xs data-state">${r.a}</span>
            </div>`;
            board.appendChild(row);
            states.push(false);
        });
        function flipRow(i) {
            const row = board.children[i];
            const inner = row.querySelector('.flap-inner');
            const stateEl = row.querySelector('.data-state');
            inner.classList.add('flip');
            setTimeout(() => {
                states[i] = !states[i];
                stateEl.textContent = states[i] ? rows[i].b : rows[i].a;
                inner.classList.remove('flip');
            }, 280);
        }
        rows.forEach((r, i) => setInterval(() => flipRow(i), 3500 + i * 600));
    </script>

</x-layout>