@extends('layouts.app')

@section('content')
<div class="min-h-screen bg-gradient-to-br from-gray-50 via-white to-blue-50 py-8">
    <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8">
        
        <!-- Breadcrumb Navigation -->
        <nav class="flex mb-8" aria-label="breadcrumb">
            <ol class="flex items-center space-x-2 text-sm">
                <li>
                    <a href="{{ route('dashboard.index') }}" class="text-gray-500 hover:text-gray-700 transition-colors">
                        <i class="fas fa-home"></i>
                        لوحة التحكم
                    </a>
                </li>
                <li>
                    <span class="text-gray-400">/</span>
                </li>
                <li>
                    <a href="{{ route('jobs.index') }}" class="text-gray-500 hover:text-gray-700 transition-colors">
                        الوظائف
                    </a>
                </li>
                <li>
                    <span class="text-gray-400">/</span>
                </li>
                <li>
                    <a href="{{ route('jobs.show', $job->slug) }}" class="text-blue-600 hover:text-blue-800 font-medium">
                        {{ $job->title }}
                    </a>
                </li>
                <li class="text-gray-700">
                    تعديل الوظيفة
                </li>
            </ol>
        </nav>

        <!-- Header Section -->
        <div class="text-center mb-10">
            <div class="inline-flex items-center justify-center w-20 h-20 bg-gradient-to-br from-blue-500 to-indigo-600 rounded-2xl shadow-2xl mb-6 floating">
                <i class="fas fa-briefcase text-white text-3xl"></i>
            </div>
            <h1 class="text-4xl font-black text-gray-900 mb-3">
                تعديل الوظيفة
            </h1>
            <p class="text-xl text-gray-600 max-w-2xl mx-auto">
                قم بتحديث تفاصيل وظيفة <span class="font-bold text-indigo-600">{{ $job->title }}</span> لجذب أفضل المواهب
            </p>
        </div>

        <!-- Edit Form -->
        <div class="bg-white rounded-3xl shadow-2xl overflow-hidden border border-gray-100">
            <!-- Top Gradient Bar -->
            <div class="h-2 bg-gradient-to-r from-blue-600 via-indigo-600 to-purple-600"></div>
            
            <div class="p-8 lg:p-10">
                <form method="POST" action="{{ route('jobs.update', $job) }}" class="space-y-8">
                    @csrf
                    @method('PUT')

                    <!-- Job Title -->
                    <div class="space-y-3">
                        <label for="title" class="flex items-center text-lg font-bold text-gray-800">
                            <i class="fas fa-heading ml-2 text-indigo-600"></i>
                            عنوان الوظيفة
                            <span class="text-red-500 mr-2">*</span>
                        </label>
                        <div class="relative">
                            <input id="title" 
                                   type="text"
                                   name="title" 
                                   value="{{ old('title', $job->title) }}" 
                                   required 
                                   autofocus
                                   placeholder="مثال: مطور واجهات أمامية"
                                   class="input-field w-full px-6 py-4 text-lg border-2 border-gray-200 rounded-xl focus:border-indigo-500 focus:ring-4 focus:ring-indigo-100 transition-all duration-300 @error('title') border-red-500 @enderror">
                            <div class="absolute left-4 top-1/2 transform -translate-y-1/2 text-gray-400">
                                <i class="fas fa-briefcase text-xl"></i>
                            </div>
                        </div>
                        @error('title')
                            <p class="mt-2 text-sm text-red-600 flex items-center">
                                <i class="fas fa-exclamation-circle ml-2"></i>
                                {{ $message }}
                            </p>
                        @enderror
                    </div>

                    <!-- Job Description -->
                    <div class="space-y-3">
                        <label for="description" class="flex items-center text-lg font-bold text-gray-800">
                            <i class="fas fa-align-left ml-2 text-indigo-600"></i>
                            وصف الوظيفة
                            <span class="text-red-500 mr-2">*</span>
                        </label>
                        <div class="relative">
                            <textarea id="description"
                                      name="description" 
                                      rows="6" 
                                      required
                                      placeholder="اكتب وصفاً تفصيلياً للوظيفة والمهام المطلوبة..."
                                      class="input-field w-full px-6 py-4 text-lg border-2 border-gray-200 rounded-xl focus:border-indigo-500 focus:ring-4 focus:ring-indigo-100 transition-all duration-300 resize-none @error('description') border-red-500 @enderror">{{ old('description', $job->description) }}</textarea>
                            <div class="absolute left-4 top-4 text-gray-400">
                                <i class="fas fa-file-alt text-xl"></i>
                            </div>
                        </div>
                        @error('description')
                            <p class="mt-2 text-sm text-red-600 flex items-center">
                                <i class="fas fa-exclamation-circle ml-2"></i>
                                {{ $message }}
                            </p>
                        @enderror
                    </div>

                    <!-- Job Requirements -->
                    <div class="space-y-3">
                        <label for="requirements" class="flex items-center text-lg font-bold text-gray-800">
                            <i class="fas fa-list-check ml-2 text-indigo-600"></i>
                            المتطلبات
                            <span class="text-red-500 mr-2">*</span>
                        </label>
                        <div class="relative">
                            <textarea id="requirements"
                                      name="requirements" 
                                      rows="5" 
                                      required
                                      placeholder="اذكر المتطلبات الأساسية للوظيفة..."
                                      class="input-field w-full px-6 py-4 text-lg border-2 border-gray-200 rounded-xl focus:border-indigo-500 focus:ring-4 focus:ring-indigo-100 transition-all duration-300 resize-none @error('requirements') border-red-500 @enderror">{{ old('requirements', $job->requirements) }}</textarea>
                            <div class="absolute left-4 top-4 text-gray-400">
                                <i class="fas fa-clipboard-list text-xl"></i>
                            </div>
                        </div>
                        @error('requirements')
                            <p class="mt-2 text-sm text-red-600 flex items-center">
                                <i class="fas fa-exclamation-circle ml-2"></i>
                                {{ $message }}
                            </p>
                        @enderror
                    </div>

                    <!-- Two Column Grid -->
                    <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
                        <!-- Job Type -->
                        <div class="space-y-3">
                            <label for="type" class="flex items-center text-lg font-bold text-gray-800">
                                <i class="fas fa-clock ml-2 text-indigo-600"></i>
                                نوع الوظيفة
                                <span class="text-red-500 mr-2">*</span>
                            </label>
                            <div class="relative">
                                <select id="type"
                                        name="type" 
                                        required
                                        class="input-field w-full px-6 py-4 text-lg border-2 border-gray-200 rounded-xl focus:border-indigo-500 focus:ring-4 focus:ring-indigo-100 transition-all duration-300 appearance-none cursor-pointer @error('type') border-red-500 @enderror">
                                    <option value="">اختر نوع الوظيفة</option>
                                    <option value="full_time" @selected(old('type', $job->type) == 'full_time')>🏢 دوام كامل</option>
                                    <option value="part_time" @selected(old('type', $job->type) == 'part_time')>⏰ دوام جزئي</option>
                                    <option value="remote" @selected(old('type', $job->type) == 'remote')>🏠 عن بعد</option>
                                    <option value="contract" @selected(old('type', $job->type) == 'contract')>📋 عقد</option>
                                </select>
                                <div class="absolute left-4 top-1/2 transform -translate-y-1/2 text-gray-400 pointer-events-none">
                                    <i class="fas fa-briefcase text-xl"></i>
                                </div>
                            </div>
                            @error('type')
                                <p class="mt-2 text-sm text-red-600 flex items-center">
                                    <i class="fas fa-exclamation-circle ml-2"></i>
                                    {{ $message }}
                                </p>
                            @enderror
                        </div>

                        <!-- Location -->
                        <div class="space-y-3">
                            <label for="location" class="flex items-center text-lg font-bold text-gray-800">
                                <i class="fas fa-map-marker-alt ml-2 text-indigo-600"></i>
                                الموقع
                                <span class="text-red-500 mr-2">*</span>
                            </label>
                            <div class="relative">
                                <input id="location" 
                                       type="text"
                                       name="location" 
                                       value="{{ old('location', $job->location) }}" 
                                       required
                                       placeholder="مثال: الرياض، السعودية"
                                       class="input-field w-full px-6 py-4 text-lg border-2 border-gray-200 rounded-xl focus:border-indigo-500 focus:ring-4 focus:ring-indigo-100 transition-all duration-300 @error('location') border-red-500 @enderror">
                                <div class="absolute left-4 top-1/2 transform -translate-y-1/2 text-gray-400">
                                    <i class="fas fa-map-marker-alt text-xl"></i>
                                </div>
                            </div>
                            @error('location')
                                <p class="mt-2 text-sm text-red-600 flex items-center">
                                    <i class="fas fa-exclamation-circle ml-2"></i>
                                    {{ $message }}
                                </p>
                            @enderror
                        </div>
                    </div>

                    <!-- Salary Range -->
                    <div class="bg-gradient-to-br from-gray-50 to-blue-50 rounded-2xl p-6 border border-gray-200">
                        <h3 class="text-lg font-bold text-gray-800 mb-6 flex items-center">
                            <i class="fas fa-dollar-sign ml-2 text-green-600"></i>
                            نطاق الراتب (اختياري)
                        </h3>
                        <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
                            <!-- Salary Min -->
                            <div class="space-y-3">
                                <label for="salary_min" class="flex items-center text-base font-semibold text-gray-700">
                                    <i class="fas fa-arrow-down ml-2 text-green-600"></i>
                                    الراتب الأدنى
                                </label>
                                <div class="relative">
                                    <input id="salary_min" 
                                           type="number"
                                           name="salary_min" 
                                           value="{{ old('salary_min', $job->salary_min) }}" 
                                           placeholder="0"
                                           min="0"
                                           class="input-field w-full px-6 py-4 text-lg border-2 border-gray-200 rounded-xl focus:border-green-500 focus:ring-4 focus:ring-green-100 transition-all duration-300 @error('salary_min') border-red-500 @enderror">
                                    <div class="absolute left-4 top-1/2 transform -translate-y-1/2 text-gray-400">
                                        <i class="fas fa-coins text-xl"></i>
                                    </div>
                                </div>
                                @error('salary_min')
                                    <p class="mt-2 text-sm text-red-600 flex items-center">
                                        <i class="fas fa-exclamation-circle ml-2"></i>
                                        {{ $message }}
                                    </p>
                                @enderror
                            </div>

                            <!-- Salary Max -->
                            <div class="space-y-3">
                                <label for="salary_max" class="flex items-center text-base font-semibold text-gray-700">
                                    <i class="fas fa-arrow-up ml-2 text-green-600"></i>
                                    الراتب الأعلى
                                </label>
                                <div class="relative">
                                    <input id="salary_max" 
                                           type="number"
                                           name="salary_max" 
                                           value="{{ old('salary_max', $job->salary_max) }}" 
                                           placeholder="0"
                                           min="0"
                                           class="input-field w-full px-6 py-4 text-lg border-2 border-gray-200 rounded-xl focus:border-green-500 focus:ring-4 focus:ring-green-100 transition-all duration-300 @error('salary_max') border-red-500 @enderror">
                                    <div class="absolute left-4 top-1/2 transform -translate-y-1/2 text-gray-400">
                                        <i class="fas fa-wallet text-xl"></i>
                                    </div>
                                </div>
                                @error('salary_max')
                                    <p class="mt-2 text-sm text-red-600 flex items-center">
                                        <i class="fas fa-exclamation-circle ml-2"></i>
                                        {{ $message }}
                                    </p>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <!-- Company Selection -->
                   
                    <!-- Action Buttons -->
                    <div class="flex flex-col sm:flex-row gap-4 pt-8 border-t-2 border-gray-100">
                        <button type="submit"
                                class="flex-1 px-8 py-4 bg-gradient-to-r from-blue-600 to-indigo-600 text-white font-bold text-lg rounded-xl hover:from-blue-700 hover:to-indigo-700 transition-all duration-300 hover:shadow-xl hover:scale-105 flex items-center justify-center">
                            <i class="fas fa-save ml-3"></i>
                            حفظ التغييرات
                        </button>
                        <a href="{{ route('jobs.show', $job->slug) }}"
                           class="flex-1 px-8 py-4 bg-gray-100 text-gray-700 font-bold text-lg rounded-xl hover:bg-gray-200 transition-all duration-300 hover:shadow-lg flex items-center justify-center border-2 border-gray-200">
                            <i class="fas fa-times ml-3"></i>
                            إلغاء
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

@push('styles')
<style>
.floating {
    animation: float 6s ease-in-out infinite;
}

@keyframes float {
    0%, 100% { transform: translateY(0px); }
    50% { transform: translateY(-10px); }
}

.input-field {
    transition: all 0.3s ease;
}

.input-field:focus {
    transform: translateY(-2px);
    box-shadow: 0 10px 25px -5px rgba(99, 102, 241, 0.15);
}

select.input-field {
    background-image: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' fill='none' viewBox='0 0 20 20'%3e%3cpath stroke='%236b7280' stroke-linecap='round' stroke-linejoin='round' stroke-width='1.5' d='m6 8 4 4 4-4'/%3e%3c/svg%3e");
    background-position: right 1rem center;
    background-repeat: no-repeat;
    background-size: 1.5em 1.5em;
    padding-right: 3rem;
}

select.input-field:focus {
    background-image: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' fill='none' viewBox='0 0 20 20'%3e%3cpath stroke='%236366f1' stroke-linecap='round' stroke-linejoin='round' stroke-width='1.5' d='m6 8 4 4 4-4'/%3e%3c/svg%3e");
}

textarea.input-field {
    padding-left: 3rem;
}

textarea.input-field:focus {
    padding-left: 3rem;
}
</style>
@endpush

@endsection
