<?php

namespace App\Providers;

use App\Models\Job;
use App\Models\User;
use App\Policies\JobPolicy;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The model to policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        Job::class => JobPolicy::class,
    ];

    /**
     * Register any authentication / authorization services.
     */
    public function boot(): void
    {
        $this->registerPolicies();

        Gate::define('create.job',function(User $user){
                               
            return $user->id == $job->user_id || $user->role == 'admin';
        });
        
        Gate::define('update.job',function ( User $user , Job $job){
            return $user->id == $job->user_id || $user->role == 'admin';
        });

        Gate::define('delete.job',function ( User $user , Job $job ){
            return $user->id == $job->user_id || $user->role == 'admin';
        });
        
    }
}
