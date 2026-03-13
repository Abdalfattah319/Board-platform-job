<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Company extends Model
{
    // fields: user_id, name, description, website, logo
    protected $fillable = [
        'user_id',
        'name', 
        'description', 
        'website', 
        'logo',
    ];

    // Company belongs to a user (owner)
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    // Company has many jobs
    public function jobs(): HasMany
    {
        return $this->hasMany(Job::class, 'company_id', 'id');
    }

    // Get jobs count attribute
    public function getJobsCountAttribute()
    {
        return $this->jobs()->count();
    }
}
