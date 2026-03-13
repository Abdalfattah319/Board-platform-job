<?php

namespace Database\Seeders;

use App\Models\Company;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Faker\Factory as Faker;

class CompanySeeder extends Seeder
{
    public function run(): void
    {
        // الحصول على مستخدمي employer
        $employers = User::where('role', 'employer')->get();
        
        // إنشاء شركات محددة لكل employer
        $companies = [
            [
                'user_id' => $employers->where('email', 'tech@seenstore.com')->first()->id ?? 1,
                'name' => 'شركة التقنية المتقدمة',
                'description' => 'شركة رائدة في مجال تكنولوجيا المعلومات والحلول الرقمية المبتكرة. نقدم خدمات تطوير البرمجيات والاستشارات التقنية للشركات في جميع أنحاء المنطقة.',
                'website' => 'https://advancedtech.com',
            ],
            [
                'user_id' => $employers->where('email', 'digital@seenstore.com')->first()->id ?? 2,
                'name' => 'شركة الحلول الرقمية',
                'description' => 'متخصصون في التحول الرقمي وحلول الأعمال الذكية. نساعد الشركات على تبني التقنيات الحديثة لتحسين كفاءتها ونموها.',
                'website' => 'https://digitalsolutions.com',
            ],
            [
                'user_id' => $employers->where('email', 'future@seenstore.com')->first()->id ?? 3,
                'name' => 'مؤسسة المستقبل',
                'description' => 'مؤسسة رائدة في مجال التعليم والتدريب المهني. نقدم برامج تدريبية متخصصة وشهادات معتمدة في مختلف المجالات.',
                'website' => 'https://futureinst.com',
            ],
        ];

        foreach ($companies as $company) {
            Company::create([
                'user_id' => $company['user_id'],
                'name' => $company['name'],
                'description' => $company['description'],
                'website' => $company['website'],
                'logo' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }

        // إنشاء شركات إضافية عشوائية
        $faker = Faker::create('ar_SA');
        $additionalCompanies = [
            'شركة الأمل للتجارة',
            'مجموعة النخبة',
            'شركة النور للخدمات',
            'مؤسسة الرواد',
            'شركة الصداقة',
        ];

        foreach ($additionalCompanies as $companyName) {
            Company::create([
                'user_id' => $employers->random()->id,
                'name' => $companyName,
                'description' => $faker->paragraph(3),
                'website' => 'https://' . Str::slug($companyName) . '.com',
                'logo' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }

        $this->command->info('✅ تم إنشاء ' . (count($companies) + count($additionalCompanies)) . ' شركة');
    }
}
