<?php

namespace App\Policies;

use App\Models\Article;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class ArticlePolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view the article.
     */
    public function view(User $user, Article $article): bool
    {
        return true; // Everyone can view articles
    }

    /**
     * Determine whether the user can create articles.
     */
    public function create(User $user): bool
    {
        return true; // Authenticated users can create articles
    }

    /**
     * Determine whether the user can update the article.
     */
    public function update(User $user, Article $article): bool
    {
        return $user->id === $article->user_id || $user->role === 'admin';
    }

    /**
     * Determine whether the user can delete the article.
     */
    public function delete(User $user, Article $article): bool
    {
        return $user->id === $article->user_id || $user->role === 'admin';
    }

    /**
     * Determine whether the user can manage the article.
     */
    public function manage(User $user, Article $article): bool
    {
        return $user->id === $article->user_id || $user->role === 'admin';
    }
}
