<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Upload extends Model
{
    // fields: user_id, filename, path, mime, size
    protected $fillable = ['user_id', 'filename', 'path', 'mime', 'size'];

    // Upload belongs to a user
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
}
