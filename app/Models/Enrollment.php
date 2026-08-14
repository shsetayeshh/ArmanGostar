<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Enrollment extends Model
{
    use HasFactory;

       protected $fillable = [
        'user_id',
        'course_id',
        'name',
        'phone',
        'age',
        'referral',
        'status',
        'payment_status',
        'amount',
        'admin_note',
    ];

  
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // ارتباط با جدول دوره‌ها
    public function course()
    {
        return $this->belongsTo(Course::class);
    }
}