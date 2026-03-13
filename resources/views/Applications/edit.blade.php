@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-8 max-w-3xl">
    <div class="bg-white rounded-lg shadow-md p-6">
        <h1 class="text-2xl font-bold text-gray-800 mb-6">تعديل طلب التقديم</h1>
        
        <form action="{{ route('applications.update', $application) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            
            <div class="mb-6">
                <label class="block text-gray-700 text-sm font-bold mb-2" for="cover_letter">
                    خطاب التغطية
                </label>
                <textarea name="cover_letter" id="cover_letter" rows="6"
                    class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"
                    required>{{ old('cover_letter', $application->cover_letter) }}</textarea>
                @error('cover_letter')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-6">
                <label class="block text-gray-700 text-sm font-bold mb-2" for="resume">
                    السيرة الذاتية (اختياري)
                </label>
                <div class="mb-2">
                    <p class="text-sm text-gray-600 mb-1">الملف الحالي:</p>
                    <div class="flex items-center">
                        @php
                            $extension = pathinfo($application->resume, PATHINFO_EXTENSION);
                            $icon = $extension === 'pdf' ? 'file-pdf' : 'file-word';
                            $color = $extension === 'pdf' ? 'text-red-500' : 'text-blue-500';
                        @endphp
                        <i class="fas fa-{{ $icon }} {{ $color }} text-xl ml-2"></i>
                        <span class="text-gray-700">السيرة_الذاتية.{{ $extension }}</span>
                        <a href="{{ route('applications.download', $application) }}" 
                           class="mr-auto text-blue-600 hover:text-blue-800 text-sm flex items-center">
                            <i class="fas fa-download ml-1"></i>
                            تحميل
                        </a>
                    </div>
                </div>
                <input type="file" name="resume" id="resume"
                    class="block w-full text-sm text-gray-500
                    file:mr-4 file:py-2 file:px-4
                    file:rounded-md file:border-0
                    file:text-sm file:font-semibold
                    file:bg-gray-50 file:text-gray-700
                    hover:file:bg-gray-100">
                @error('resume')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
                <p class="text-xs text-gray-500 mt-1">اتركه فارغاً إذا كنت لا تريد تغيير السيرة الذاتية (الحد الأقصى: 2 ميجابايت)</p>
            </div>

            <div class="flex items-center justify-between">
                <a href="{{ route('applications.show', $application) }}" 
                   class="bg-gray-200 text-gray-800 px-4 py-2 rounded-md hover:bg-gray-300">
                    إلغاء
                </a>
                <button type="submit" 
                        class="bg-blue-600 text-white px-6 py-2 rounded-md hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                    حفظ التغييرات
                </button>
            </div>
        </form>
    </div>
</div>
@endsection