<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    use HasFactory;

    // فیلدهایی که اجازه دارن تو دیتابیس ثبت بشن
    protected $fillable = [
        'title',
        'slug',
        'workshop_number',
        'description',
        'items',
        'is_active',
        'capacity',
        'image',
    ];

    // این بخش خیلی باحاله! چون سرفصل هارو به صورت json تو دیتابیس ذخیره کردیم، 
    // لاراول خودکار تبدیلش میکنه به آرایه تا تو سایت راحت باشیم
    protected $casts = [
        'items' => 'array',
        'is_active' => 'boolean',
    ];
}