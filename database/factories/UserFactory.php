<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class UserFactory extends Factory
{
    protected $model = User::class;
    protected static ?string $password;
    
    // Arabic names for more realistic data
    protected $arabicFirstNames = [
        'محمد', 'أحمد', 'علي', 'عمر', 'يوسف', 'إبراهيم', 'مصطفى', 'خالد', 'عبدالله', 'عبدالرحمن',
        'فاطمة', 'مريم', 'سارة', 'آمنة', 'زينب', 'حفصة', 'عائشة', 'هاجر', 'نور', 'لمى'
    ];
    
    protected $arabicLastNames = [
        'العمري', 'الزهراني', 'الغامدي', 'الحربي', 'القرشي', 'الأنصاري', 'المالكي', 'الزهيري',
        'السلمي', 'القرني', 'الغفيلي', 'السهلي', 'الرشيدي', 'الجعفري', 'النجار', 'الخالدي'
    ];
    
    protected $arabicCities = [
        'الرياض', 'جدة', 'مكة المكرمة', 'المدينة المنورة', 'الدمام', 'الخبر', 'الظهران', 'الطائف',
        'تبوك', 'بريدة', 'حائل', 'أبها', 'نجران', 'جازان', 'الجبيل', 'ينبع', 'الخرج', 'حفر الباطن'
    ];

    public function definition(): array
    {
        $firstName = $this->faker->randomElement($this->arabicFirstNames);
        $lastName = $this->faker->randomElement($this->arabicLastNames);
        $username = Str::slug($firstName . '_' . $lastName . '_' . Str::random(3), '');
        
        return [
            'name' => $firstName . ' ' . $lastName,
            'email' => $username . '@example.com',
            'email_verified_at' => now(),
            'password' => static::$password ??= Hash::make('password'),
            'role' => $this->faker->randomElement(['applicant', 'employer']),
            'remember_token' => Str::random(10),
        ];
    }

    public function unverified(): static
    {
        return $this->state(fn (array $attributes) => [
            'email_verified_at' => null,
        ]);
    }
    
    public function admin(): static
    {
        return $this->state([
            'name' => 'مدير النظام',
            'email' => 'admin@example.com',
            'role' => 'admin',
        ]);
    }
    
    public function employer(): static
    {
        return $this->state([
            'role' => 'employer',
        ]);
    }
    
    public function jobSeeker(): static
    {
        return $this->state([
            'role' => 'job_seeker',
        ]);
    }
}
