<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // إنشاء مستخدم admin
        if (!User::where('email', 'admin@seenstore.com')->exists()) {
            User::create([
                'name' => 'أحمد محمد',
                'email' => 'admin@seenstore.com',
                'password' => Hash::make('password'),
                'role' => 'admin',
            ]);
        }

        // إنشاء مستخدمين employer
        $employers = [
            [
                'name' => 'شركة التقنية المتقدمة',
                'email' => 'tech@seenstore.com',
                'password' => Hash::make('password'),
                'role' => 'employer',
            ],
            [
                'name' => 'شركة الحلول الرقمية',
                'email' => 'digital@seenstore.com',
                'password' => Hash::make('password'),
                'role' => 'employer',
            ],
            [
                'name' => 'مؤسسة المستقبل',
                'email' => 'future@seenstore.com',
                'password' => Hash::make('password'),
                'role' => 'employer',
            ],
        ];

        foreach ($employers as $employer) {
            if (!User::where('email', $employer['email'])->exists()) {
                User::create($employer);
            }
        }

        // إنشاء مستخدمين applicant
        $applicants = [
            [
                'name' => 'محمد عبدالله',
                'email' => 'mohammed@seenstore.com',
                'password' => Hash::make('password'),
                'role' => 'applicant',
            ],
            [
                'name' => 'فاطمة أحمد',
                'email' => 'fatima@seenstore.com',
                'password' => Hash::make('password'),
                'role' => 'applicant',
            ],
            [
                'name' => 'علي سالم',
                'email' => 'ali@seenstore.com',
                'password' => Hash::make('password'),
                'role' => 'applicant',
            ],
            [
                'name' => 'نورا خالد',
                'email' => 'nora@seenstore.com',
                'password' => Hash::make('password'),
                'role' => 'applicant',
            ],
            [
                'name' => 'خالد عمر',
                'email' => 'khalid@seenstore.com',
                'password' => Hash::make('password'),
                'role' => 'applicant',
            ],
        ];

        foreach ($applicants as $applicant) {
            if (!User::where('email', $applicant['email'])->exists()) {
                User::create($applicant);
            }
        }

        $this->command->info('✅ تم إنشاء 9 مستخدمين (1 admin, 3 employers, 5 applicants)');
    }
}
