<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    public function run(): void
    {
        $categories = [
            ['name' => 'تكنولوجيا المعلومات', 'description' => 'وظائف في البرمجة وتطوير المواقع'],
            ['name' => 'التسويق والتسويق', 'description' => 'وظائف في المبيعات والتسويق'],
            ['name' => 'المالية والمحاسبة', 'description' => 'وظائف المحاسبة والمالية'],
            ['name' => 'الموارد البشرية', 'description' => 'وظائف الموارد البشرية'],
            ['name' => 'الهندسة', 'description' => 'وظائف الهندسة المختلفة'],
            ['name' => 'التعليم', 'description' => 'وظائف في قطاع التعليم'],
            ['name' => 'الصحة', 'description' => 'وظائف في القطاع الصحي'],
            ['name' => 'الخدمات اللوجستية', 'description' => 'وظائف الخدمات اللوجستية'],
            ['name' => 'الإنتاج', 'description' => 'وظائف في التصنيع والإنتاج'],
            ['name' => 'البيع بالتجزئة', 'description' => 'وظائف في البيع والمبيعات'],
            ['name' => 'الإعلام', 'description' => 'وظائف في الإعلام والاتصالات'],
        ];

        foreach ($categories as $category) {
            Category::create($category);
        }
    }
}
