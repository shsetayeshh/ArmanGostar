<x-layout title="{{ $course->title }} - آموزشگاه آرمان گستر">

    <section class="grain py-20 min-h-screen">
        <div class="max-w-7xl mx-auto px-6 lg:px-10">

            <div class="text-paper/50 text-sm mb-10 flex items-center gap-2 tech-label">
                <a href="/" class="hover:text-amber transition">خانه</a>
                <span>/</span>
                <a href="/#courses" class="hover:text-amber transition">دوره‌ها</a>
                <span>/</span>
                <span class="text-amber">{{ $course->title }}</span>
            </div>

            <div class="grid lg:grid-cols-5 gap-12">

                <div class="lg:col-span-3">
                    <span class="tech-label text-amber text-xs mb-4 block">{{ $course->workshop_number }}</span>
                    <h1 class="text-paper font-black text-4xl md:text-5xl mb-6">{{ $course->title }}</h1>
                    <p class="text-paper/65 text-lg leading-relaxed mb-10">
                        {{ $course->description }}
                    </p>

                    <div class="flex flex-wrap gap-4 mb-12">
                        <a href="/#contact" class="bg-amber hover:bg-[#ffb845] text-graphite font-bold px-8 py-4 rounded transition">ثبت‌نام در دوره</a>
                        <a href="tel:02156342570" class="border border-paper/25 text-paper px-8 py-4 rounded hover:border-amber hover:text-amber transition tech-label">۰۲۱-۵۶۳۴۲۵۷۰</a>
                    </div>

                    <div class="border-t border-paper/10 pt-10">
                        <h2 class="text-paper font-bold text-2xl mb-6">سرفصل‌ها و حرفه‌های این رشته</h2>
                        <div class="grid md:grid-cols-2 gap-4">
                            @foreach($course->items as $item)
                            <div class="bg-graphite rounded-xl p-5 border border-graphite card-hover">
                                <h3 class="text-paper font-semibold text-sm">{{ is_array($item) ? $item['item'] : $item }}</h3>
                            </div>
                            @endforeach
                        </div>
                    </div>
                </div>

                <div class="lg:col-span-2">
                    <div class="bg-graphite rounded-2xl border border-paper/10 p-7 sticky top-28">
                        <div class="bg-steel/40 rounded-xl h-48 overflow-hidden mb-6 border border-paper/5">
                            @if($course->image)
                            <img src="{{ asset('storage/' . $course->image) }}" alt="{{ $course->title }}" class="w-full h-full object-cover">
                            @else
                            <div class="w-full h-full flex items-center justify-center text-paper/20 tech-label text-sm">
                                تصویری ثبت نشده
                            </div>
                            @endif
                        </div>
                        <ul class="space-y-4 text-sm text-paper/70 mb-8">
                            <li class="flex justify-between border-b border-paper/10 pb-3">
                                <span>مدرک:</span> <span class="text-paper font-semibold">فنی و حرفه‌ای</span>
                            </li>
                            <li class="flex justify-between border-b border-paper/10 pb-3">
                                <span>نوع آموزش:</span> <span class="text-paper font-semibold">عملی و کارگاهی</span>
                            </li>
                            <li class="flex justify-between">
                                <span>ظرفیت باقیمانده:</span> <span class="text-amber font-bold">محدود</span>
                            </li>
                        </ul>

                        <!-- شروع بخش آلپاین -->
                        <!-- شروع بخش آلپاین -->
                        <div x-data="{ showModal: false, requestType: 'consultation' }">

                            <button @click="showModal = true" class="block w-full text-center bg-crimson hover:bg-red-700 text-paper font-bold px-5 py-4 rounded transition">
                                درخواست مشاوره یا ثبت‌نام
                            </button>

                            @if(session('success'))
                            <div class="mt-4 text-center text-sm text-green-400 bg-green-900/20 border border-green-400/30 rounded px-4 py-3">
                                {{ session('success') }}
                            </div>
                            @endif
                            @if($errors->any())
                            <div class="mt-4 text-center text-sm text-red-400 bg-red-900/20 border border-red-400/30 rounded px-4 py-3">
                                {{ $errors->first('msg') }}
                            </div>
                            @endif

                            <!-- بقیه‌ی مودال دست‌نخورده می‌مونه -->
                            <!-- پنجره پاپ آپ (کاملاً ریسپانسیو) -->
                            <div x-cloak
                                x-show="showModal"
                                x-transition:enter="transition ease-out duration-300"
                                x-transition:enter-start="opacity-0"
                                x-transition:enter-end="opacity-100"
                                x-transition:leave="transition ease-in duration-200"
                                x-transition:leave-start="opacity-100"
                                x-transition:leave-end="opacity-0"
                                class="fixed inset-0 z-[100] flex items-center justify-center bg-black/70 backdrop-blur-sm p-4"
                                @click.away="showModal = false">

                                <!-- کادر محتوا -->
                                <div class="bg-graphite border border-paper/10 rounded-2xl w-full max-w-md shadow-2xl flex flex-col max-h-[85vh] overflow-hidden relative" @click.stop>

                                    <!-- هدر ثابت (اسکرول نمیخوره) -->
                                    <div class="flex justify-between items-center p-6 pb-4 border-b border-paper/10 shrink-0">
                                        <h2 class="text-paper font-bold text-xl">فرم درخواست</h2>
                                        <button @click="showModal = false" class="w-8 h-8 flex items-center justify-center rounded-full bg-paper/10 text-paper/50 hover:text-amber hover:bg-paper/20 transition text-xl cursor-pointer">
                                            &times;
                                        </button>
                                    </div>

                                    <!-- بدنه فرم (فقط اینجا اسکرول میخوره) -->
                                    <div class="p-6 pt-4 overflow-y-auto flex-grow space-y-4">
                                        <form id="consultForm" method="POST" action="{{ route('course.enroll.request', $course->slug) }}" class="space-y-4">
                                            @csrf
                                            <!-- فیلد مخفی که مشخص میکنه کدوم دکمه زده شده -->
                                            <input type="hidden" name="request_type" x-model="requestType">

                                            <div>
                                                <label class="block text-paper/70 text-sm mb-2">نام و نام خانوادگی <span class="text-crimson">*</span></label>
                                                <input type="text" name="name" value="{{ old('name') }}" required placeholder="نام خود را وارد کنید"
                                                    class="w-full bg-[#2A2E35] border border-paper/20 text-paper placeholder-paper/40 rounded px-4 py-3 focus:outline-none focus:border-amber tech-label text-sm">
                                            </div>

                                            <div>
                                                <label class="block text-paper/70 text-sm mb-2">شماره تماس <span class="text-crimson">*</span></label>
                                                <input type="text" name="phone" value="{{ old('phone') }}" required placeholder="09123456789"
                                                    class="w-full bg-[#2A2E35] border border-paper/20 text-paper placeholder-paper/40 rounded px-4 py-3 focus:outline-none focus:border-amber tech-label text-sm">
                                            </div>

                                            <div>
                                                <label class="block text-paper/70 text-sm mb-2">سن <span class="text-crimson">*</span></label>
                                                <input type="number" name="age" value="{{ old('age') }}" required placeholder="مثلا 22"
                                                    class="w-full bg-[#2A2E35] border border-paper/20 text-paper placeholder-paper/40 rounded px-4 py-3 focus:outline-none focus:border-amber tech-label text-sm">
                                            </div>

                                            <div>
                                                <label class="block text-paper/70 text-sm mb-2">نحوه آشنایی با ما <span class="text-crimson">*</span></label>
                                                <select name="referral" required
                                                    class="w-full bg-[#2A2E35] border border-paper/20 text-paper rounded px-4 py-3 focus:outline-none focus:border-amber tech-label text-sm appearance-none">
                                                    <option value="" disabled selected>لطفا انتخاب کنید...</option>
                                                    <option value="friends">دوستان و آشنایان</option>
                                                    <option value="google">جستجو در گوگل</option>
                                                    <option value="sms">پیامک</option>
                                                    <option value="social">فضای مجازی (اینستاگرام، تلگرام)</option>
                                                </select>
                                            </div>

                                            <div class="bg-amber/10 border border-amber/20 rounded-lg p-4">
                                                <p class="text-amber text-sm leading-relaxed">
                                                    در صورت تصمیم قطعی ثبت نام روی دکمه "ثبت نام قطعی" کلیک کنید تا اسم شما رزرو شود.
                                                </p>
                                            </div>
                                    </div> <!-- پایان بدنه فرم -->

                                    <!-- فوتر فرم (ثابت و پایین کادر) -->
                                    <!-- فوتر فرم -->
                                    <div class="p-6 pt-4 border-t border-paper/10 shrink-0 space-y-3">
                                        <button type="submit" @click="requestType = 'consultation'" class="w-full border-2 border-paper/20 text-paper hover:bg-paper/5 font-bold py-3 rounded transition">
                                            ثبت اطلاعات برای مشاوره
                                        </button>
                                        <button type="submit" @click="requestType = 'registration'" class="w-full bg-amber hover:bg-[#ffb845] text-graphite font-bold py-3 rounded transition">
                                            ثبت نام قطعی و رزرو نام
                                        </button>
                                    </div>
                                    </form>
                                </div>
                            </div>
                        </div>

                    </div> <!-- پایان لفاف آلپاین -->
                </div>
            </div>

        </div>
        </div>
    </section>

</x-layout>