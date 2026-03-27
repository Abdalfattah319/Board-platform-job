<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Article;
use App\Models\Like;

class LikesController extends Controller
{
    /**
     * Like an article.
     */
    public function like(Article $article)
    {
        if (!auth()->check()) {
            return redirect()->route('login');
        }

        // منع تكرار الإعجاب
        $article->likes()->firstOrCreate([
            'user_id' => auth()->id()
        ]);

        return back()->with('success', 'تم إضافة الإعجاب');
    }

    /**
     * Unlike an article.
     */
    public function unlike(Article $article)
    {
        if (!auth()->check()) {
            return redirect()->route('login');
        }

        $article->likes()->where('user_id', auth()->id())->delete();

        return back()->with('success', 'تم إلغاء الإعجاب');
    }
}
