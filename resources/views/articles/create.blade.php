@extends('layouts.app')

@section('content')  
  <x-slot name="header">
        <h1 class="text-2xl font-bold text-gray-900">إضافة مقال جديد</h1>
    </x-slot>

    <div class="py-6">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="bg-white rounded-2xl shadow-xl p-8">
                <form method="POST" action="{{ route('articles.store') }}" enctype="multipart/form-data" class="space-y-6">
                    @csrf

                    <!-- Title -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">عنوان المقال *</label>
                        <input type="text" name="title" required
                               value="{{ old('title') }}"
                               class="w-full px-4 py-3 border-2 border-gray-200 rounded-xl focus:outline-none focus:border-indigo-500 focus:ring-2 focus:ring-indigo-200 transition-all">
                        @error('title')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Author -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">اسم الكاتب</label>
                        <input type="text" name="author"
                               value="{{ old('author') ?? auth()->user()->name }}"
                               class="w-full px-4 py-3 border-2 border-gray-200 rounded-xl focus:outline-none focus:border-indigo-500 focus:ring-2 focus:ring-indigo-200 transition-all">
                        @error('author')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Content -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">محتوى المقال *</label>
                        <textarea name="content" rows="12" required
                                  class="w-full px-4 py-3 border-2 border-gray-200 rounded-xl focus:outline-none focus:border-indigo-500 focus:ring-2 focus:ring-indigo-200 transition-all"
                                  placeholder="اكتب محتوى المقال هنا...">{{ old('content') }}</textarea>
                        @error('content')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Image -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">صورة المقال</label>
                        <div class="flex items-center space-x-4 space-x-reverse">
                            <div class="flex-1">
                                <input type="file" name="image" accept="image/*"
                                       class="w-full px-4 py-3 border-2 border-gray-200 rounded-xl focus:outline-none focus:border-indigo-500 focus:ring-2 focus:ring-indigo-200 transition-all">
                                <p class="text-sm text-gray-500 mt-1">PNG, JPG, JPEG, GIF (الحد الأقصى: 2MB)</p>
                                @error('image')
                                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <!-- Published -->
                    <div class="flex items-center">
                        <input type="checkbox" name="published" id="published" value="1" checked
                               class="h-4 w-4 text-indigo-600 border-gray-300 rounded focus:ring-indigo-500">
                        <label for="published" class="mr-2 text-sm font-medium text-gray-700">
                            نشر المقال فوراً
                        </label>
                    </div>

                    <!-- Submit Buttons -->
                    <div class="flex justify-between items-center pt-6">
                        <a href="{{ route('articles.index') }}" 
                           class="px-6 py-3 border-2 border-gray-300 text-gray-700 rounded-xl font-medium hover:bg-gray-50 transition-all duration-300">
                            إلغاء
                        </a>
                        <div class="space-x-4 space-x-reverse">
                            <button type="submit" 
                                    class="px-8 py-3 bg-gradient-to-r from-indigo-600 to-purple-600 text-white rounded-xl font-bold hover:from-indigo-700 hover:to-purple-700 transform hover:scale-105 transition-all duration-300 shadow-lg">
                                <svg class="w-5 h-5 inline ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                                </svg>
                                نشر المقال
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection