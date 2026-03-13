@extends('layouts.app')

@section('content')    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h1 class="text-2xl font-bold text-gray-900">المقالات</h1>
            @auth
            <x-primary-button>
                <a href="{{ route('articles.create') }}">مقال جديد</a>
            </x-primary-button>
            @endauth
        </div>
    </x-slot>

    <div class="py-6">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <!-- Featured Article -->
            @if($featuredArticle)
            <div class="mb-8 bg-white rounded-2xl shadow-xl overflow-hidden fade-in-up">
                <div class="md:flex">
                    <div class="md:flex-shrink-0">
                        <img class="h-48 w-full md:w-64 object-cover" 
                             src="{{ $featuredArticle->image ? asset('storage/' . $featuredArticle->image) : 'https://source.unsplash.com/random/800x600/?business' }}" 
                             alt="{{ $featuredArticle->title }}">
                    </div>
                    <div class="p-8">
                        <div class="uppercase tracking-wide text-sm text-indigo-600 font-semibold">مقال مميز</div>
                        <a href="{{ route('articles.show', $featuredArticle) }}" class="block mt-1 text-xl font-semibold text-gray-900 hover:text-indigo-600">
                            {{ $featuredArticle->title }}
                        </a>
                        <p class="mt-2 text-gray-600 line-clamp-2">
                            {{ Str::limit($featuredArticle->content, 150) }}
                        </p>
                        <div class="mt-4 flex items-center">
                            <div class="flex-shrink-0">
                                <div class="h-10 w-10 rounded-full bg-gradient-to-br from-indigo-500 to-purple-600 flex items-center justify-center">
                                    <span class="text-white font-bold">
                                        {{ substr($featuredArticle->author, 0, 1) }}
                                    </span>
                                </div>
                            </div>
                            <div class="mr-3">
                                <p class="text-sm font-medium text-gray-900">{{ $featuredArticle->author }}</p>
                                <div class="flex space-x-1 text-sm text-gray-500 space-x-reverse">
                                    <time datetime="{{ $featuredArticle->created_at->format('Y-m-d') }}">
                                        {{ $featuredArticle->created_at->diffForHumans() }}
                                    </time>
                                    <span aria-hidden="true"> &middot; </span>
                                    <span>{{ ceil(strlen($featuredArticle->content) / 200) }} دقيقة قراءة</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @endif

            <!-- Articles Grid -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                @forelse($articles as $article)
                    <div class="bg-white rounded-2xl shadow-lg hover:shadow-2xl hover:-translate-y-2 transition-all duration-300 overflow-hidden fade-in-up">
                        @if($article->image)
                            <img class="h-48 w-full object-cover" 
                                 src="{{ asset('storage/' . $article->image) }}" 
                                 alt="{{ $article->title }}">
                        @else
                            <div class="h-48 w-full bg-gradient-to-br from-indigo-500 to-purple-600 flex items-center justify-center">
                                <span class="text-white text-4xl">📝</span>
                            </div>
                        @endif
                        
                        <div class="p-6">
                            <div class="flex items-center mb-3">
                                <div class="h-8 w-8 rounded-full bg-gradient-to-br from-indigo-500 to-purple-600 flex items-center justify-center">
                                    <span class="text-white text-sm font-bold">
                                        {{ substr($article->author, 0, 1) }}
                                    </span>
                                </div>
                                <span class="text-sm text-gray-500 mr-2">{{ $article->author }}</span>
                            </div>
                            
                            <h3 class="text-lg font-bold text-gray-900 mb-2">
                                <a href="{{ route('articles.show', $article) }}" class="hover:text-indigo-600 transition-colors">
                                    {{ $article->title }}
                                </a>
                            </h3>
                            
                            <p class="text-gray-600 text-sm line-clamp-3 mb-4">
                                {{ Str::limit($article->content, 120) }}
                            </p>
                            
                            <div class="flex items-center justify-between text-sm text-gray-500">
                                <time datetime="{{ $article->created_at->format('Y-m-d') }}">
                                    {{ $article->created_at->diffForHumans() }}
                                </time>
                                <span>{{ ceil(strlen($article->content) / 200) }} دقيقة قراءة</span>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="col-span-full text-center py-16">
                        <div class="text-gray-400 text-6xl mb-4">📝</div>
                        <h3 class="text-xl font-bold text-gray-900 mb-2">لا توجد مقالات</h3>
                        <p class="text-gray-600 mb-8">كن أول من يضيف مقالاً جديداً</p>
                        @auth
                        <x-primary-button>
                            <a href="{{ route('articles.create') }}">إضافة مقال</a>
                        </x-primary-button>
                        @endauth
                    </div>
                @endforelse
            </div>

            <!-- Pagination -->
            @if($articles->hasPages())
                <div class="mt-12">
                    {{ $articles->links() }}
                </div>
            @endif
        </div>
    </div>
@endsection