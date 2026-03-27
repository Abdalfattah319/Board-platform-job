<?php

namespace App\Providers;

use App\Models\Article;
use App\Models\Job;
use App\Models\User;
use App\Policies\ArticlePolicy;
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
        Article::class => ArticlePolicy::class,
    ];

    /**
     * Register any authentication / authorization services.
     */
    public function boot(): void
    {
        $this->registerPolicies();

        Gate::define('create.job',function(User $user, Job $job){
            return $user->role == 'admin' || $user->id == $job->user_id;
        });
        
        Gate::define('update.job',function ( User $user , Job $job){
            return $user->role == 'admin' || $user->id == $job->user_id;
        });

        Gate::define('delete.job',function ( User $user , Job $job ){
            return $user->role == 'admin' || $user->id == $job->user_id;
        });

        // Article Gates
        Gate::define('create.article', function(User $user){
            return $user->role == 'admin' || $user->role == 'company' || $user->role == 'user';
        });
        
        Gate::define('update.article', function(User $user, Article $article){
            return $user->role == 'admin' || $user->id == $article->user_id;
        });

        Gate::define('delete.article', function(User $user, Article $article){
            return $user->role == 'admin' || $user->id == $article->user_id;
        });
        
    }
}
