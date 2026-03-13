<?php

namespace Database\Seeders;

use App\Models\Company;
use App\Models\Job;
use App\Models\Category;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use Faker\Factory as Faker;

class JobSeeder extends Seeder
{
    public function run(): void
    {
        $faker = Faker::create('ar_SA');
        
        // الحصول على الشركات والمستخدمين
        $companies = Company::all();
        $employers = User::where('role', 'employer')->get();
        
        // إنشاء وظائف محددة وواقعية
        $jobs = [
            [
                'user_id' => $employers->where('email', 'tech@seenstore.com')->first()->id ?? 1,
                'company_id' => $companies->where('name', 'شركة التقنية المتقدمة')->first()->id ?? 1,
                'title' => 'مطور Laravel متقدم',
                'type' => 'full_time',
                'location' => 'الرياض، السعودية',
                'salary_min' => 8000,
                'salary_max' => 15000,
                'description' => $this->generateJobDescription('مطور Laravel متقدم', 'شركة التقنية المتقدمة', 'laravel'),
                'requirements' => $this->generateJobRequirements('laravel'),
            ],
            [
                'user_id' => $employers->where('email', 'tech@seenstore.com')->first()->id ?? 1,
                'company_id' => $companies->where('name', 'شركة التقنية المتقدمة')->first()->id ?? 1,
                'title' => 'مطور واجهات أمامية (Frontend)',
                'type' => 'remote',
                'location' => 'عن بعد',
                'salary_min' => 6000,
                'salary_max' => 12000,
                'description' => $this->generateJobDescription('مطور واجهات أمامية', 'شركة التقنية المتقدمة', 'frontend'),
                'requirements' => $this->generateJobRequirements('frontend'),
            ],
            [
                'user_id' => $employers->where('email', 'digital@seenstore.com')->first()->id ?? 2,
                'company_id' => $companies->where('name', 'شركة الحلول الرقمية')->first()->id ?? 2,
                'title' => 'خبير تحويل رقمي',
                'type' => 'full_time',
                'location' => 'دبي، الإمارات',
                'salary_min' => 12000,
                'salary_max' => 20000,
                'description' => $this->generateJobDescription('خبير تحويل رقمي', 'شركة الحلول الرقمية', 'digital'),
                'requirements' => $this->generateJobRequirements('digital'),
            ],
            [
                'user_id' => $employers->where('email', 'future@seenstore.com')->first()->id ?? 3,
                'company_id' => $companies->where('name', 'مؤسسة المستقبل')->first()->id ?? 3,
                'title' => 'مدرب تطوير ويب',
                'type' => 'part_time',
                'location' => 'القاهرة، مصر',
                'salary_min' => 4000,
                'salary_max' => 8000,
                'description' => $this->generateJobDescription('مدرب تطوير ويب', 'مؤسسة المستقبل', 'training'),
                'requirements' => $this->generateJobRequirements('training'),
            ],
            [
                'user_id' => $employers->where('email', 'future@seenstore.com')->first()->id ?? 3,
                'company_id' => $companies->where('name', 'مؤسسة المستقبل')->first()->id ?? 3,
                'title' => 'مصمم تعليمي',
                'type' => 'remote',
                'location' => 'عن بعد',
                'salary_min' => 5000,
                'salary_max' => 9000,
                'description' => $this->generateJobDescription('مصمم تعليمي', 'مؤسسة المستقبل', 'design'),
                'requirements' => $this->generateJobRequirements('design'),
            ],
        ];

        foreach ($jobs as $job) {
            Job::create([
                'user_id' => $job['user_id'],
                'company_id' => $job['company_id'],
                'title' => $job['title'],
                'slug' => Str::slug($job['title']) . '-' . Str::random(6),
                'description' => $job['description'],
                'requirements' => $job['requirements'],
                'type' => $job['type'],
                'location' => $job['location'],
                'salary_min' => $job['salary_min'],
                'salary_max' => $job['salary_max'],
                'is_active' => true,
                'deadline' => $faker->dateTimeBetween('now', '+3 months'),
                'created_at' => $faker->dateTimeBetween('-2 weeks', 'now'),
                'updated_at' => now(),
            ]);
        }

        // إنشاء وظائف إضافية عشوائية
        $additionalJobs = [
            ['محاسب', 'full_time', 'الرياض', 5000, 8000],
            ['مدير تسويق', 'full_time', 'دبي', 7000, 12000],
            ['مطور موبايل', 'remote', 'عن بعد', 8000, 14000],
            ['مصمم جرافيك', 'part_time', 'القاهرة', 3000, 6000],
            ['مدير مشروع', 'full_time', 'جدة', 9000, 15000],
            ['محلل بيانات', 'remote', 'عن بعد', 6000, 11000],
            ['مطور Python', 'full_time', 'الرياض', 7000, 13000],
            ['خبير أمن سيبراني', 'full_time', 'دبي', 10000, 18000],
        ];

        foreach ($additionalJobs as [$title, $type, $location, $minSalary, $maxSalary]) {
            Job::create([
                'user_id' => $employers->random()->id,
                'company_id' => $companies->random()->id,
                'title' => $title,
                'slug' => Str::slug($title) . '-' . Str::random(6),
                'description' => $this->generateJobDescription($title, 'شركة محلية', 'general'),
                'requirements' => $this->generateJobRequirements('general'),
                'type' => $type,
                'location' => $location,
                'salary_min' => $minSalary,
                'salary_max' => $maxSalary,
                'is_active' => true,
                'deadline' => $faker->dateTimeBetween('now', '+3 months'),
                'created_at' => $faker->dateTimeBetween('-1 month', 'now'),
                'updated_at' => now(),
            ]);
        }

        $this->command->info('✅ تم إنشاء ' . (count($jobs) + count($additionalJobs)) . ' وظيفة');
    }
    
    private function generateJobDescription($title, $companyName, $type): string
    {
        $descriptions = [
            'laravel' => "نبحث عن مطور Laravel محترف للانضمام إلى فريق تطوير الويب. يجب أن تكون لديك خبرة في بناء تطبيقات ويب معقدة باستخدام Laravel 8+.",
            'frontend' => "نحتاج إلى مطور واجهات أمامية مبدع لإنشاء تجارب مستخدم رائعة. الخبرة في React/Vue.js مطلوبة.",
            'digital' => "نبحث عن خبير في التحول الرقمي لمساعدة الشركات على تبني التقنيات الحديثة وتحسين عملياتها.",
            'training' => "نحتاج إلى مدرب متخصص في تطوير الويب لتدريب المهنيين الجدد على أحدث التقنيات.",
            'design' => "نبحث عن مصمم تعليمي لإنشاء محتوى تعليمي تفاعلي وجذاب لمنصاتنا التعليمية.",
            'general' => "فرصة ممتازة للانضمام إلى فريقنا الديناميكي والعمل في بيئة محفزة للنمو والتطور."
        ];

        $baseDescription = $descriptions[$type] ?? $descriptions['general'];
        
        return "<p><strong>الوصف:</strong></p><p>{$baseDescription}</p>
                <p><strong>المسؤوليات:</strong></p>
                <ul>
                    <li>تطوير وصيانة التطبيقات والأنظمة</li>
                    <li>العمل مع الفريق لتحقيق أهداف المشروع</li>
                    <li>إعداد التقارير والمستندات الفنية</li>
                    <li>المشاركة في اجتماعات التخطيط والمراجعة</li>
                    <li>تحسين الأداء وجودة الكود</li>
                </ul>
                <p><strong>لماذا تنضم إلينا؟</strong></p>
                <p>نحن نقدم بيئة عمل محفزة، فرص للتطور المهني، ومزايا تنافسية.</p>";
    }
    
    private function generateJobRequirements($type): string
    {
        $requirements = [
            'laravel' => [
                'خبرة لا تقل عن 3 سنوات في Laravel',
                'إجادة Laravel 8+ و PHP 8+',
                'خبرة في MySQL و PostgreSQL',
                'معرفة بـ RESTful APIs',
                'خبرة في Git و GitHub',
                'مهارات حل المشكلات',
            ],
            'frontend' => [
                'خبرة في React.js أو Vue.js',
                'إجادة HTML5, CSS3, JavaScript ES6+',
                'خبرة في TailwindCSS أو Bootstrap',
                'معرفة بـ Responsive Design',
                'خبرة في أدوات البناء (Webpack/Vite)',
                'مهارات التصميم و UX/UI',
            ],
            'digital' => [
                'خبرة 5+ سنوات في التحول الرقمي',
                'شهادات في إدارة المشاريع',
                'خبرة في الاستشارات التقنية',
                'مهارات تحليلية قوية',
                'القدرة على قيادة الفرق',
                'إجادة اللغتين العربية والإنجليزية',
            ],
            'training' => [
                'خبرة في تطوير الويب 3+ سنوات',
                'مهارات التدريب والتعليم',
                'شهادات تقنية معتمدة',
                'قدرة على تبسيط المفاهيم المعقدة',
                'مهارات عرض وتقديم ممتازة',
                'الصبر والقدرة على التعامل مع المتعلمين',
            ],
            'design' => [
                'خبرة في التصميم التعليمي',
                'إجادة أدوات التصميم (Adobe Creative Suite)',
                'معرفة بـ eLearning platforms',
                'مهارات كتابة المحتوى التعليمي',
                'خبرة في تصميم الرسوم المتحركة',
                'القدرة على العمل مع المطورين',
            ],
            'general' => [
                'شهادة جامعية في المجال ذي الصلة',
                'خبرة لا تقل عن سنتين',
                'مهارات تواصل ممتازة',
                'القدرة على العمل ضمن فريق',
                'إجادة اللغة الإنجليزية',
                'مهارات تنظيمية وإدارية',
            ],
        ];

        $selectedRequirements = $requirements[$type] ?? $requirements['general'];
        
        $html = "<ul>";
        foreach ($selectedRequirements as $requirement) {
            $html .= "<li>{$requirement}</li>";
        }
        $html .= "</ul>";
        
        return $html;
    }
}
