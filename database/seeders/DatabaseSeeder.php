<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->command->info('🚀 بدأ إنشاء البيانات التجريبية...');

        // تشغيل الـ Seeders بالترتيب الصحيح
        $this->call([
            UserSeeder::class,
            CompanySeeder::class,
            JobSeeder::class,
        ]);

        $this->command->info('✅ تم إنشاء جميع البيانات التجريبية بنجاح!');
        $this->command->info('📊 إحصائيات البيانات:');
        $this->command->info('   - المستخدمين: ' . User::count());
        $this->command->info('   - الشركات: ' . \App\Models\Company::count());
        $this->command->info('   - الوظائف: ' . \App\Models\Job::count());
        
        $this->command->info('');
        $this->command->info('🔐 بيانات تسجيل الدخول:');
        $this->command->info('   Admin: admin@seenstore.com / password');
        $this->command->info('   Employer: tech@seenstore.com / password');
        $this->command->info('   Applicant: mohammed@seenstore.com / password');
    }
}
