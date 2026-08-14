<?php

use Illuminate\Support\Facades\Route;
use App\Models\Course;

// صفحه اصلی سایت
Route::get('/', function () {
    $courses = Course::where('is_active', true)->orderBy('id', 'asc')->get();
    return view('home', compact('courses'));
});

// صفحه تک دوره
Route::get('/course/{slug}', function ($slug) {
    $course = Course::where('slug', $slug)->firstOrFail();
    return view('single-course', compact('course'));
})->name('course.show');
// دریافت درخواست ثبت نام از طرف کاربر
// دریافت فرم مشاوره و ثبت نام همزمان
// دریافت فرم درخواست (هم مشاوره هم ثبت نام قطعی اینجا مدیریت میشه)
Route::post('/course/{slug}/enroll-request', function ($slug, \Illuminate\Http\Request $request) {
    $course = \App\Models\Course::where('slug', $slug)->firstOrFail();

    $request->validate([
        'name' => 'required|string|max:255',
        'phone' => 'required|string|max:15',
        'age' => 'required|integer|min:10|max:99',
        'referral' => 'required|string',
        'request_type' => 'required|in:consultation,registration'
    ]);

    // اگه ثبت‌نام قطعی زده ولی لاگین نیست، بفرستش صفحه‌ی لاگین
    if ($request->request_type === 'registration' && !auth()->check()) {
        return redirect('/login')->with('error', 'برای ثبت‌نام قطعی، ابتدا وارد حساب کاربری شوید.');
    }

    if ($request->request_type === 'registration') {
        $exists = \App\Models\Enrollment::where('user_id', auth()->id())
            ->where('course_id', $course->id)
            ->where('status', 'pending_registration')
            ->exists();
        if ($exists) {
            return back()->withErrors(['msg' => 'شما قبلاً درخواست ثبت‌نام قطعی برای این دوره داده‌اید.']);
        }
    }

    \App\Models\Enrollment::create([
        'user_id' => auth()->id(), // برای مهمان null می‌مونه
        'course_id' => $course->id,
        'name' => $request->name,
        'phone' => $request->phone,
        'age' => $request->age,
        'referral' => $request->referral,
        'status' => $request->request_type == 'consultation' ? 'consultation' : 'pending_registration',
        'payment_status' => 'unpaid',
    ]);

    $message = $request->request_type == 'consultation'
        ? 'درخواست مشاوره شما ثبت شد.'
        : 'درخواست شما ثبت و نام شما رزرو شد.';

    return back()->with('success', $message);
})->name('course.enroll.request');

// مسیرهای مربوط به لاگین و ثبت نام (اینها رو breeze اضافه کرده)
Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');



// نمایش فرم پروفایل
Route::get('/profile', function () {
    return view('profile');
})->middleware('auth')->name('profile.edit');

// ذخیره کردن اطلاعات پروفایل
Route::put('/profile/update', function (\Illuminate\Http\Request $request) {
    // اعتبارسنجی اطلاعات
    $request->validate([
        'name' => 'required|string|max:255',
        'email' => 'required|string|email|max:255|unique:users,email,' . auth()->id(),
    ]);

    // آپدیت کردن اطلاعات کاربر فعلی
    auth()->user()->update([
        'name' => $request->name,
        'email' => $request->email,
    ]);

    // برگشت به صفحه پروفایل با پیام موفقیت
    return redirect()->back()->with('success', 'اطلاعات شما با موفقیت به‌روزرسانی شد.');
})->middleware('auth');

Route::post('/consultation-request', function (\Illuminate\Http\Request $request) {
    $request->validate([
        'name'      => 'required|string|max:255',
        'phone'     => 'required|string|max:15',
        'course_id' => 'required|exists:courses,id',
    ]);

    \App\Models\Enrollment::create([
        'user_id'    => auth()->id(),
        'course_id'  => $request->course_id,
        'name'       => $request->name,
        'phone'      => $request->phone,
        'age'        => null,
        'referral'   => 'homepage-consultation',
        'status'     => 'consultation',
        'payment_status' => 'unpaid',
    ]);

    return back()->with('success', 'درخواست شما ثبت شد. کارشناسان ما به‌زودی تماس می‌گیرند.');
})->middleware('auth')->name('consultation.request');
// برای تست اینکه آیا روت‌های Filament کار می‌کنند
Route::get('/test-filament', function() {
    return 'Filament is working!';
});

require __DIR__ . '/auth.php';
