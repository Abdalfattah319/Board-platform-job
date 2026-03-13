<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Str;

class Job extends Model
{
    /**
     * الحقول التي يمكن تعبئتها بشكل جماعي (Mass Assignment)
     *
     * @var array
     */

    // Updated fillable to match latest migrations (صاحب العمل هو الأساس)
    protected $fillable = [
        'company_id', // اختياري - إذا كان لديه شركة
        'user_id', // أساسي - صاحب العمل
        'title',
        'slug',
        'description',
        'requirements',
        'type',
        'location',
        'salary_min',
        'salary_max',
        'is_active',
        'deadline',
    ];

    /**
     * Get translated job type in Arabic
     *
     * @return string
     */
    public function getTypeArabicAttribute()
    {
        $types = [
            'full_time' => 'دوام كامل',
            'part_time' => 'دوام جزئي',
            'remote' => 'عن بعد',
            'contract' => 'عقد',
        ];

        return $types[$this->type] ?? $this->type;
    }

    /**
     * يتم تنفيذ هذا الكود عند بدء تشغيل النموذج
     *
     * @return void
     */
    protected static function boot()
    {
        parent::boot();

        // عند إنشاء وظيفة جديدة، يتم إنشاء رابط نصي (slug) تلقائياً إذا لم يتم تحديده
        static::creating(function ($job) {
            // if (empty($job->slug)) {
            //     $job->slug = Str::slug($job->title) . '-' . uniqid();
            // }
        });
    }

    

    /**
     * نطاق (scope) لاسترجاع الوظائف النشطة فقط
     *
     * @param  \Illuminate\Database\Eloquent\Builder  $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    /**
     * نطاق (scope) لتصفية نتائج البحث
     *
     * @param  \Illuminate\Database\Eloquent\Builder  $query
     * @param  array  $filters
     * @return \Illuminate\Database\Eloquent\Builder;
     */
    public function scopeFilter($query, array $filters)
    {
        // تصفية حسب كلمة البحث (في العنوان أو الوصف أو المتطلبات)
        $query->when($filters['search'] ?? null, function ($query, $search) {
            $query->where(function ($query) use ($search) {
                $query->where('title', 'like', '%'.$search.'%')
                    ->orWhere('description', 'like', '%'.$search.'%');
                    // ->orWhere('requirements', 'like', '%'.$search.'%')
            });
        })->when($filters['type'] ?? null, function ($query, $type) {
            // تصفية حسب نوع الوظيفة (request uses 'type' parameter)
            $query->where('type', $type);
        })->when($filters['location'] ?? null, function ($query, $location) {
            // تصفية حسب الموقع
            $query->where('location', $location);
        });
    }

    /**
     * العلاقة مع نموذج الشركة (وظيفة واحدة تنتمي لشركة واحدة)
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function company()
    {
        return $this->belongsTo(Company::class);
    }

    /**
     * العلاقة مع نموذج المستخدم (وظيفة واحدة تنتمي لمستخدم واحد)
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * العلاقة مع نموذج طلبات التقديم (وظيفة واحدة لها عدة طلبات تقديم)
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function applications()
    {
        return $this->hasMany(JobApplication::class);
    }

    /**
     * الحصول على اسم العمود المستخدم في ربط النموذج (Route Model Binding)
     *
     * @return string
     */
    public function getRouteKeyName()
    {
        return 'slug'; // استخدام حقل slug بدلاً من id في الروابط
    }

    /**
     * الحصول على وظائف مشابهة للوظيفة الحالية
     *
     * @param  int  $limit عدد الوظائف المطلوب استرجاعها
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function similarJobs($limit = 3)
    {
        return static::where('id', '!=', $this->id)
            ->where(function($query) {
                $query->where('type', $this->type)
                      ->orWhere('location', $this->location);
            })
            ->with('company') // تحميل بيانات الشركة مع كل وظيفة
            ->active() // فقط الوظائف النشطة
            ->inRandomOrder() // ترتيب عشوائي
            ->limit($limit) // تحديد عدد النتائج
            ->get();
    }
}
