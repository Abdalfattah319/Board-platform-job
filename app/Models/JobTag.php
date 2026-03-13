<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class JobTag extends Model
{
    // pivot model (optional). Kept minimal. If you don't need a model for pivot, you can remove this file.
    protected $table = 'job_tag';
    public $timestamps = false;
}
