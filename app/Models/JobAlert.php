<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class JobAlert extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'keywords',
        'location',
        'type',
        'salary_min',
        'salary_max',
        'is_active',
    ];

    protected $casts = [
        'salary_min' => 'integer',
        'salary_max' => 'integer',
        'is_active' => 'boolean',
    ];

    /**
     * العلاقة مع المستخدم
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * التحقق مما إذا كان الإنذار يطابق وظيفة معينة
     */
    public function matchesJob(Job $job): bool
    {
        // التحقق من الكلمات المفتاحية
        if (!empty($this->keywords)) {
            $keywords = explode(' ', $this->keywords);
            foreach ($keywords as $keyword) {
                if (stripos($job->title, $keyword) === false && 
                    stripos($job->description, $keyword) === false) {
                    return false;
                }
            }
        }

        // التحقق من الموقع
        if (!empty($this->location) && $job->location !== $this->location) {
            return false;
        }

        // التحقق من نوع العمل
        if (!empty($this->type) && $job->type !== $this->type) {
            return false;
        }

        // التحقق من الحد الأدنى للراتب
        if (!empty($this->salary_min) && $job->salary_min < $this->salary_min) {
            return false;
        }

        // التحقق من الحد الأعلى للراتب
        if (!empty($this->salary_max) && $job->salary_max > $this->salary_max) {
            return false;
        }

        return true;
    }

    /**
     * الحصول على الوظائف المطابقة للإنذار
     */
    public function getMatchingJobs()
    {
        return Job::where('title', 'LIKE', '%' . $this->keywords . '%')
            ->when($this->location, function ($query, $location) {
                return $query->where('location', $location);
            })
            ->when($this->type, function ($query, $type) {
                return $query->where('type', $type);
            })
            ->when($this->salary_min, function ($query, $min) {
                return $query->where('salary_min', '>=', $min);
            })
            ->when($this->salary_max, function ($query, $max) {
                return $query->where('salary_max', '<=', $max);
            })
            ->where('is_active', true)
            ->latest();
    }
}
