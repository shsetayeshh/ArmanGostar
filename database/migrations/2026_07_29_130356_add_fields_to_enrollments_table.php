<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('enrollments', function (Blueprint $table) {
            $table->string('name')->nullable()->after('course_id');
            $table->string('phone')->nullable()->after('name');
            $table->integer('age')->nullable()->after('phone');
            $table->string('referral')->nullable()->after('age');
        });
    }

    public function down(): void
    {
        Schema::table('enrollments', function (Blueprint $table) {
            $table->dropColumn(['name', 'phone', 'age', 'referral']);
        });
    }
};