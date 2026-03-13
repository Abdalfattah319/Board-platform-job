<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Article;
use Illuminate\Support\Facades\DB;

class ArticleSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('articles')->delete();

        $articles = [
            [
                'title' => 'كيفية كتابة سيرة ذاتية احترافية',
                'content' => 'تعتبر السيرة الذاتية من أهم الأدوات التي تساعدك على الحصول على وظيفة أحلامك. في هذا المقال، سنتعلم كيفية كتابة سيرة ذاتية احترافية تجذب انتباه أصحاب العمل...',
                'slug' => 'how-to-write-professional-cv',
                'author' => 'أحمد محمد',
                'image' => null,
                'published' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'title' => 'أفضل 10 مهارات مطلوبة في سوق العمل 2024',
                'content' => 'مع تطور سوق العمل، هناك مهارات جديدة أصبحت مطلوبة بشكل كبير. في هذا المقال، نستعرض أفضل 10 مهارات تحتاجها للنجاح في مسيرتك المهنية...',
                'slug' => 'top-10-skills-job-market-2024',
                'author' => 'سارة أحمد',
                'image' => null,
                'published' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'title' => 'نصائح للمقابلة الشخصية الناجحة',
                'content' => 'المقابلة الشخصية هي الخطوة الأخيرة قبل الحصول على الوظيفة. في هذا المقال، نقدم لك نصائح هامة لنجاح المقابلة الشخصية والحصول على الوظيفة...',
                'slug' => 'tips-for-successful-job-interview',
                'author' => 'محمد علي',
                'image' => null,
                'published' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'title' => 'كيفية البحث عن وظيفة في العصر الرقمي',
                'content' => 'أصبح البحث عن وظيفة أسهل مع التكنولوجيا الحديثة. في هذا المقال، نستعرض أفضل الطرق والمنصات للبحث عن وظيفة في العصر الرقمي...',
                'slug' => 'how-to-search-job-digital-age',
                'author' => 'فاطمة محمود',
                'image' => null,
                'published' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'title' => 'التطوير المهني المستمر مفتاح النجاح',
                'content' => 'التطوير المهني المستمر هو عملية مستمرة طوال حياتك المهنية. في هذا المقال، نوضح أهمية التطوير المهني وكيفية تحقيقه...',
                'slug' => 'continuous-professional-development-key-success',
                'author' => 'خالد سعيد',
                'image' => null,
                'published' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ];

        Article::insert($articles);
    }
}
