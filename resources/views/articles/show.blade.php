@extends('layouts.app')

@section('content')    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h1 class="text-2xl font-bold text-gray-900">{{ $article->title }}</h1>
            @auth
            @can('update', $article)
            <div class="space-x-2 space-x-reverse">
                <x-secondary-button>
                    <a href="{{ route('articles.edit', $article) }}">تعديل</a>
                </x-secondary-button>
                <form action="{{ route('articles.destroy', $article) }}" method="POST" onsubmit="return confirm('هل أنت متأكد من حذف هذا المقال؟')">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="px-4 py-2 bg-red-600 text-white rounded-lg hover:bg-red-700 transition-colors">
                        حذف
                    </button>
                </form>
            </div>
            @endcan
            @endauth
        </div>
    </x-slot>

    <div class="py-6">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
            <article class="bg-white rounded-2xl shadow-xl overflow-hidden">
                <!-- Article Header -->
                <div class="p-8 border-b border-gray-200">
                    <div class="flex items-center mb-6">
                        <div class="h-12 w-12 rounded-full bg-gradient-to-br from-indigo-500 to-purple-600 flex items-center justify-center">
                            <span class="text-white font-bold">
                                {{ substr($article->author, 0, 1) }}
                            </span>
                        </div>
                        <div class="mr-4">
                            <p class="text-lg font-medium text-gray-900">{{ $article->author }}</p>
                            <div class="flex items-center text-sm text-gray-500">
                                <time datetime="{{ $article->created_at->format('Y-m-d') }}">
                                    {{ $article->created_at->format('d F Y') }}
                                </time>
                                <span class="mx-2"> &middot; </span>
                                <span>{{ ceil(strlen($article->content) / 200) }} دقيقة قراءة</span>
                            </div>
                        </div>
                    </div>
                    
                    <h1 class="text-3xl md:text-4xl font-black text-gray-900 mb-6">
                        {{ $article->title }}
                    </h1>
                    
                    @if($article->image)
                        <img class="w-full h-64 md:h-96 object-cover rounded-xl" 
                             src="{{ asset('storage/' . $article->image) }}" 
                             alt="{{ $article->title }}">
                    @endif
                </div>

                <!-- Article Content -->
                <div class="p-8">
                    <div class="prose prose-lg max-w-none">
                        {!! nl2br(e($article->content)) !!}
                    </div>
                </div>

                <!-- Article Footer -->
                <div class="p-8 bg-gray-50 border-t border-gray-200">
                    <div class="flex items-center justify-between">
                        <div class="flex items-center space-x-4 space-x-reverse">
                            <div class="h-10 w-10 rounded-full bg-gradient-to-br from-indigo-500 to-purple-600 flex items-center justify-center">
                                <span class="text-white font-bold">
                                    {{ substr($article->author, 0, 1) }}
                                </span>
                            </div>
                            <div>
                                <p class="font-medium text-gray-900">{{ $article->author }}</p>
                                <p class="text-sm text-gray-500">كاتب المقال</p>
                            </div>
                        </div>
                        
                        <div class="text-sm text-gray-500">
                            <time datetime="{{ $article->created_at->format('Y-m-d') }}">
                                نشر في {{ $article->created_at->format('d F Y') }}
                            </time>
                        </div>
                    </div>
                    
                    <!-- Likes Section -->
                    <div class="mt-6 pt-6 border-t border-gray-200">
                        <div class="flex items-center justify-between">
                            <div class="flex items-center space-x-2 space-x-reverse">
                                <span class="text-lg font-semibold text-gray-900">
                                    {{ $article->likes->count() ?? 0 }}
                                </span>
                                <span class="text-red-500">❤️</span>
                                <span class="text-sm text-gray-500">
                                    {{ $article->likes->count() == 1 ? 'إعجاب' : 'إعجابات' }}
                                </span>
                            </div>

                            @auth
                                @if($article->isLikedByUser())
                                    <form method="POST" action="{{ route('articles.unlike', $article) }}" class="inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="px-4 py-2 bg-red-500 text-white rounded-lg hover:bg-red-600 transition-colors flex items-center">
                                            <i class="fas fa-heart-broken ml-2"></i>
                                            إلغاء الإعجاب
                                        </button>
                                    </form>
                                @else
                                    <form method="POST" action="{{ route('articles.like', $article) }}" class="inline">
                                        @csrf
                                        <button type="submit" class="px-4 py-2 bg-red-500 text-white rounded-lg hover:bg-red-600 transition-colors flex items-center">
                                            <i class="fas fa-heart ml-2"></i>
                                            إعجاب
                                        </button>
                                    </form>
                                @endif
                            @endauth
                        </div>
                    </div>
                </div>
            </article>

            <!-- Action Buttons -->
            <div class="mt-8 flex justify-center space-x-4 space-x-reverse">
                <!-- Create New Article Button -->
                @can('create', \App\Models\Article::class)
                <x-primary-button>
                    <a href="{{ route('articles.create') }}" class="flex items-center">
                        <i class="fas fa-plus ml-2"></i>
                        مقال جديد
                    </a>
                </x-primary-button>
                @endcan
                
                <!-- Update Article Button -->
                @can('update', $article)
                    <x-secondary-button>
                        <a href="{{ route('articles.edit', $article) }}" class="flex items-center">
                            <i class="fas fa-edit ml-2"></i>
                            تعديل المقال
                        </a>
                    </x-secondary-button>
                @endcan
                
                <!-- Back Button -->
                <x-secondary-button>
                    <a href="{{ route('articles.index') }}" class="flex items-center">
                        <i class="fas fa-arrow-right ml-2"></i>
                        العودة للمقالات
                    </a>
                </x-secondary-button>
            </div>
        </div>
    </div>
@endsection