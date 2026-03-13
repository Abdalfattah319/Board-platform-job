<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Application extends Model
{
    // corrected $fillable and field names to match migrations
    protected $fillable = [
        'job_id', 'user_id', 'resume', 'cover_letter', 'status',
    ];
    public function getStatusLabelAttribute()
{
    return [
        'applied'      => 'مقدّم',
        'under_review' => 'قيد المراجعة',
        'shortlisted'  => 'ضمن القائمة المختصرة',
        'rejected'     => 'مرفوض',
        'hired'        => 'تم التوظيف',
    ][$this->status];
}


    // Application belongs to a job
    public function job(): BelongsTo
    {
        return $this->belongsTo(Job::class, 'job_id', 'id');
    }

    // Application belongs to a user (applicant)
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
}
