<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Tag extends Model
{
    protected $fillable = ['name', 'slug'];

    // Many-to-many: tag belongs to many jobs via job_tag pivot
    public function jobs(): BelongsToMany
    {
        return $this->belongsToMany(Job::class, 'job_tag', 'tag_id', 'job_id');
    }
}
