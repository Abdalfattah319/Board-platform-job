<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    // fields: name, description, slug
    protected $fillable = [
        'name', 'description', 'slug'
    ];

    // A category has many jobs (FK: categorie_id)
    public function jobs()
    {
        return $this->hasMany(Job::class, 'categorie_id', 'id');
    }
}
