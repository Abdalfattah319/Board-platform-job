<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Article;

class ArticleController extends Controller
{
    /**
     * Display a listing of articles.
     */
    // public function index()
    // {
    //     $featuredArticle = Article::where('published', true)->latest()->first();
    //     $articles = Article::where('published', true)->latest()->paginate(9);
    //     return view('articles.index', compact('articles', 'featuredArticle'));
    // }
    public function index(Request $request)
    {
        $query = Article::where('published', 1);

        if ($request->search) {
            $query->where('title', 'like', '%' . $request->search . '%')
                ->orWhere('content', 'like', '%' . $request->search . '%');
        }

        $articles = $query->latest()->paginate(9);
        $featuredArticle = Article::where('published', 1)->latest()->first();

        return view('articles.index', compact('articles', 'featuredArticle'));
    }
    
    public function create()
    {
        return view('articles.create');
    }
    
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'author' => 'nullable|string|max:255',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048'
        ]);
        
        $article = new Article();
        $article->title = $request->title;
        $article->content = $request->content;
        $article->author = $request->author;
        $article->slug = \Str::slug($request->title);
        $article->published = $request->published ?? true;
        $article->user_id = auth()->id(); // ربط المقال بالمستخدم الحالي
        
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('articles', 'public');
            $article->image = $imagePath;
        }
        
        $article->save();
        
        return redirect()->route('articles.index')->with('success', 'تم إضافة المقال بنجاح');
    }
    
    public function show(Article $article)
    {
        return view('articles.show', compact('article'));
    }
    
    public function edit(Article $article)
    {
        // Check if user can edit the article
        $this->authorize('update', $article);
        
        return view('articles.edit', compact('article'));
    }
    
    public function update(Request $request, Article $article)
    {
        // Check if user can update the article
        $this->authorize('update', $article);
        
        $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'author' => 'nullable|string|max:255',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048'
        ]);
        
        $article->title = $request->title;
        $article->content = $request->content;
        $article->author = $request->author;
        $article->slug = \Str::slug($request->title);
        $article->published = $request->published ?? true;
        
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('articles', 'public');
            $article->image = $imagePath;
        }
        
        $article->save();
        
        return redirect()->route('articles.show', $article)->with('success', 'تم تحديث المقال بنجاح');
    }
    
    public function destroy(Article $article)
    {
        // Check if user can delete the article
        $this->authorize('delete', $article);
        
        $article->delete();
        
        return redirect()->route('articles.index')->with('success', 'تم حذف المقال بنجاح');
    }
    
    public function search(Request $request)
    {
        $query = $request->input('q');
        
        $articles = Article::where('title', 'LIKE', "%{$query}%")
                    ->orWhere('content', 'LIKE', "%{$query}%")
                    ->latest()
                    ->paginate(9);
        
        return view('articles.index', compact('articles', 'query'));
    }
}
