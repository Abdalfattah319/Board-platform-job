<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Article extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'content',
        'author',
        'image',
        'user_id',
        'published_at',
    ];

    protected $casts = [
        'published_at' => 'datetime',
    ];

    /**
     * Get the user that owns the article.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get the likes for the article.
     */
    public function likes()
    {
        return $this->hasMany(Like::class);
    }

    /**
     * Check if the article is liked by the current user.
     */
    public function isLikedByUser()
    {
        if (!auth()->check()) {
            return false;
        }
        
        return $this->likes()->where('user_id', auth()->id())->exists();
    }

    /**
     * Get the author name (fallback to author field).
     */
    public function getAuthorAttribute($value)
    {
        if ($this->user) {
            return $this->user->name;
        }
        return $value;
    }
}
