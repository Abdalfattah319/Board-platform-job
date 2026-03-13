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
        // تأكد أن الجدول غير موجود قبل الإنشاء
        
            Schema::create('jobs', function (Blueprint $table) {
                $table->id();
                $table->unsignedBigInteger('company_id');
                $table->unsignedBigInteger('categorie_id')->nullable();
                $table->unsignedBigInteger('user_id'); // أعمدة مفقودة أصلحتها
                $table->string('title');
                $table->string('slug')->unique();
                $table->text('description');
                $table->text('requirements');
                $table->string('location')->nullable();
                $table->enum('type', ['part_time','full_time','contract','remote'])->default('full_time');
                $table->integer('salary_min')->nullable();
                $table->integer('salary_max')->nullable();
                $table->timestamp('deadline')->nullable();
                $table->boolean('is_active')->default(true);
                $table->timestamps();
                $table->softDeletes();
                
                // الـ foreign keys ستضاف لاحقاً
            }); // <-- هذا يغلق Schema::create
       
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('jobs');
    }
};
