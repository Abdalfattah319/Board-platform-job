<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Relations\HasMany;
use App\Models\Payment;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'role'
    ];
    public function jobs()
    {
        return $this->hasMany(job::class);
    }
    public function getIsAdminAttribute(): bool
    {
        return $this->role==='admin';
    }

    public function getIsEmployerAttribute():bool
    {
        return $this->role==='employer';
    }
    public function getIsApplicantAttribute():bool
    {
        return $this->role ==='applicant';
    }
    // User has many companies (owner/employer accounts)
    public function companies(): HasMany
    {
        return $this->hasMany(Company::class, 'user_id', 'id');
    }
     public function applications()
    {
        return $this->hasMany(Application::class,'user_id','id');
    }
    public function savedJobs()
    {
        return $this->hasMany(SavedJob::class, 'user_id', 'id');
    }

    public function jobAlerts()
    {
        return $this->hasMany(JobAlert::class, 'user_id', 'id');
    }

    public function uploads()
    {
        return $this->hasMany(Upload::class,'user_id','id');
    }

    /**
     * Get all payments for the user.
     */
    public function payments()
    {
        return $this->hasMany(Payment::class);
    }

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    public function setRoleAttribute($value)
    {
        // Ensure role is one of the allowed values
        $allowedRoles = ['admin', 'employer', 'applicant'];
        $this->attributes['role'] = in_array($value, $allowedRoles) ? $value : 'applicant';
    }
}
