<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('job_alerts', function (Blueprint $table) {
            $table->id();
            
            // العلاقة مع المستخدم
            $table->foreignId('user_id')->constrained()->cascadeOnDelete();
            
            // معايير البحث
            $table->string('keywords'); // الكلمات المفتاحية
            $table->string('location')->nullable(); // الموقع
            $table->enum('type', ['full_time', 'part_time', 'remote', 'contract'])->nullable(); // نوع العمل
            
            // نطاق الراتب
            $table->integer('salary_min')->nullable(); // الحد الأدنى للراتب
            $table->integer('salary_max')->nullable(); // الحد الأعلى للراتب
            
            // الحالة
            $table->boolean('is_active')->default(true); // هل الإنذار نشط
            
            $table->timestamps();
            
            // Indexes for better performance
            $table->index(['user_id', 'is_active']);
            $table->index('keywords');
            $table->index('location');
            $table->index('type');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('job_alerts');
    }
};
