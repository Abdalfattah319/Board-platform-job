@extends('layouts.app')

@section('content')
<div class="container mx-auto px-2 sm:px-4 py-4 sm:py-6">
    <!-- Professional Header -->
    <div class="bg-gradient-to-br from-indigo-600 via-purple-600 to-pink-600 rounded-2xl shadow-2xl p-8 mb-8 text-white relative overflow-hidden">
        <!-- Background Pattern -->
        <div class="absolute inset-0 opacity-10">
            <div class="absolute top-0 left-0 w-full h-full bg-repeat" style="background-image: url('data:image/svg+xml,%3Csvg width="60" height="60" viewBox="0 0 60 60" xmlns="http://www.w3.org/2000/svg"%3E%3Cg fill="none" fill-rule="evenodd"%3E%3Cg fill="%23ffffff" fill-opacity="0.4"%3E%3Cpath d="M36 34v-4h-2v4h-4v2h4v4h2v-4h4v-2h-4zm0-30V0h-2v4h-4v2h4v4h2V6h4V4h-4zM6 34v-4H4v4H0v2h4v4h2v-4h4v-2H6zM6 4V0H4v4H0v2h4v4h2V6h4V4H6z"/%3E%3C/g%3E%3C/g%3E%3C/svg%3E');"></div>
        </div>
        
        <div class="relative z-10">
            <div class="flex flex-col lg:flex-row justify-between items-start lg:items-center space-y-6 lg:space-y-0">
                <div class="flex-1">
                    <div class="flex items-center mb-4">
                        <div class="w-16 h-16 bg-white/20 backdrop-blur rounded-2xl flex items-center justify-center mr-4">
                            <i class="fas fa-briefcase text-3xl"></i>
                        </div>
                        <div>
                            <h1 class="text-4xl lg:text-5xl font-bold mb-2">فرص عمل استثنائية</h1>
                            <p class="text-xl text-indigo-100">
                                اكتشف <span class="font-bold text-yellow-300 text-2xl">{{ $jobs->count() }}</span> وظيفة في أفضل الشركات
                            </p>
                        </div>
                    </div>
                    
                    <!-- Quick Stats -->
                    <div class="flex flex-wrap gap-4 mt-6">
                        <div class="bg-white/10 backdrop-blur rounded-xl px-4 py-2">
                            <span class="text-sm text-indigo-200">محدث الآن</span>
                            <p class="font-semibold">{{ now()->format('H:i') }}</p>
                        </div>
                        <div class="bg-white/10 backdrop-blur rounded-xl px-4 py-2">
                            <span class="text-sm text-indigo-200">شركات</span>
                            <p class="font-semibold">50+</p>
                        </div>
                        <div class="bg-white/10 backdrop-blur rounded-xl px-4 py-2">
                            <span class="text-sm text-indigo-200">مدن</span>
                            <p class="font-semibold">15+</p>
                        </div>
                    </div>
                </div>
                
                @auth
                    @if (in_array(auth()->user()->role, ['employer', 'admin']))
                        <a href="{{ route('jobs.create') }}" 
                           class="bg-white text-indigo-600 hover:bg-gray-100 px-8 py-4 rounded-xl font-bold transition-all duration-300 transform hover:scale-105 shadow-xl flex items-center">
                            <i class="fas fa-plus-circle ml-3 text-xl"></i>
                            نشر وظيفة
                        </a>
                    @endif
                @endauth
            </div>
        </div>
    </div>

    <!-- Advanced Search Section -->
    <div class="bg-white rounded-2xl shadow-xl border border-gray-100 p-8 mb-8">
        <div class="flex items-center mb-6">
            <div class="w-12 h-12 bg-gradient-to-br from-indigo-500 to-purple-600 rounded-xl flex items-center justify-center ml-4">
                <i class="fas fa-search text-white text-lg"></i>
            </div>
            <div>
                <h2 class="text-2xl font-bold text-gray-900">ابحث عن وظيفتك المثالية</h2>
                <p class="text-gray-600">استخدم أدوات البحث المتقدمة للعثور على الفرص المناسبة</p>
            </div>
        </div>
        
        <form action="{{ route('jobs.index') }}" method="GET">
            <div class="grid grid-cols-1 lg:grid-cols-4 gap-6">
                <div class="lg:col-span-2">
                    <label class="block text-sm font-medium text-gray-700 mb-2">البحث المتقدم</label>
                    <div class="relative group">
                        <div class="absolute inset-0 bg-gradient-to-r from-indigo-500 to-purple-600 rounded-xl opacity-0 group-hover:opacity-5 transition-opacity duration-300"></div>
                        <input type="text" name="search" value="{{ request('search') }}" 
                               class="relative w-full pr-12 pl-4 py-4 border-2 border-gray-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition-all duration-300 font-medium text-gray-900 placeholder-gray-500" 
                               placeholder="ابحث عن وظيفة، شركة، أو موقع...">
                        <div class="absolute left-4 top-1/2 transform -translate-y-1/2 text-indigo-500">
                            <i class="fas fa-search text-lg"></i>
                        </div>
                    </div>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">نوع الوظيفة</label>
                    <select name="type" class="w-full px-4 py-4 border-2 border-gray-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition-all duration-300 font-medium text-gray-900">
                        <option value="">جميع الأنواع</option>
                        <option value="full-time" {{ request('type') == 'full-time' ? 'selected' : '' }}>دوام كامل</option>
                        <option value="part-time" {{ request('type') == 'part-time' ? 'selected' : '' }}>دوام جزئي</option>
                        <option value="remote" {{ request('type') == 'remote' ? 'selected' : '' }}>عمل عن بعد</option>
                    </select>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">&nbsp;</label>
                    <button type="submit" 
                            class="w-full bg-gradient-to-r from-indigo-600 to-purple-600 text-white hover:from-indigo-700 hover:to-purple-700 px-6 py-4 rounded-xl font-bold transition-all duration-300 transform hover:scale-105 shadow-lg flex items-center justify-center">
                        <i class="fas fa-search ml-2"></i>
                        بحث الآن
                    </button>
                </div>
            </div>
        </form>
    </div>

    <!-- Jobs List Section -->
    <div class="bg-white rounded-xl shadow-md border border-gray-200">
        @auth
            @if (auth()->user()->is_employer || auth()->user()->is_admin)
                {{-- Employer View - My Jobs --}}
                @forelse($myJobs as $job)
                    <div class="border-b border-gray-200 last:border-b-0 p-6 hover:bg-gray-50 transition-colors group">
                    <!-- Gradient Top Bar -->
                    <div class="h-2 bg-gradient-to-r from-blue-500 via-purple-500 to-pink-500"></div>
                    
                    <div class="p-8">
                        <div class="flex items-center justify-between">
                            <div class="flex-1">
                                <div class="flex items-center mb-4">
                                    <div class="relative">
                                        <div class="absolute inset-0 bg-gradient-to-br from-blue-400 to-purple-600 rounded-full opacity-20 blur-xl"></div>
                                        <img src="{{ $job->company_logo }}" alt="Company" class="relative w-16 h-16 rounded-full ml-6 shadow-lg transform group-hover:scale-110 transition-transform duration-300" width="64" height="64">
                                    </div>
                                    <div>
                                        <h3 class="text-2xl font-bold text-gray-900 mb-2 group-hover:text-blue-600 transition-colors">
                                            <a href="{{ route('jobs.show', $job) }}" class="bg-gradient-to-r from-blue-600 to-purple-600 bg-clip-text text-transparent">{{ $job->title }}</a>
                                        </h3>
                                        <p class="text-gray-600 font-medium">{{ optional($job->company)->name ?? 'غير محدد' }}</p>
                                    </div>
                                </div>
                                
                                <div class="flex flex-wrap gap-3 mb-4">
                                    <span class="inline-flex items-center px-4 py-2 rounded-full text-sm font-semibold bg-gradient-to-r from-blue-100 to-blue-200 text-blue-800 border border-blue-300">
                                        <i class="fas fa-map-marker-alt ml-2"></i>
                                        {{ $job->location }}
                                    </span>
                                    <span class="inline-flex items-center px-4 py-2 rounded-full text-sm font-semibold bg-gradient-to-r from-green-100 to-emerald-200 text-green-800 border border-green-300">
                                        <i class="fas fa-briefcase ml-2"></i>
                                        {{ $job->type_arabic }}
                                    </span>
                                    @if($job->salary_min || $job->salary_max)
                                    <span class="inline-flex items-center px-4 py-2 rounded-full text-sm font-semibold bg-gradient-to-r from-yellow-100 to-amber-200 text-yellow-800 border border-yellow-300">
                                        <i class="fas fa-money-bill-wave ml-2"></i>
                                        {{ $job->salary_min ? number_format($job->salary_min) : '' }}
                                        {{ $job->salary_min && $job->salary_max ? '-' : '' }}
                                        {{ $job->salary_max ? number_format($job->salary_max) : '' }}
                                        $
                                    </span>
                                    @endif
                                    <span class="inline-flex items-center px-4 py-2 rounded-full text-sm font-semibold bg-gradient-to-r from-gray-100 to-gray-200 text-gray-800 border border-gray-300">
                                        <i class="fas fa-clock ml-2"></i>
                                        {{ $job->created_at?->diffForHumans() }}
                                    </span>
                                </div>
                            </div>
                            
                            <div class="text-left">
                                @if($job->is_active)
                                    <span class="inline-flex items-center px-4 py-2 rounded-full text-sm font-bold bg-gradient-to-r from-green-500 to-emerald-600 text-white mb-3 shadow-lg">
                                        <i class="fas fa-check-circle ml-2"></i>
                                        نشطة
                                    </span>
                                @else
                                    <span class="inline-flex items-center px-4 py-2 rounded-full text-sm font-bold bg-gradient-to-r from-gray-500 to-gray-600 text-white mb-3 shadow-lg">
                                        <i class="fas fa-pause-circle ml-2"></i>
                                        غير نشطة
                                    </span>
                                @endif
                                
                                <div class="text-gray-600 font-medium mb-4">
                                    <i class="fas fa-users ml-2"></i>
                                    {{ $job->applications->count() }} متقدم
                                </div>
                                
                                <div class="flex flex-col space-y-3 space-y-reverse">
                                    <a href="{{ route('jobs.show', $job) }}" 
                                       class="inline-flex items-center justify-center px-6 py-3 bg-gradient-to-r from-blue-500 to-indigo-600 text-white font-bold rounded-xl shadow-lg hover:shadow-xl transform hover:-translate-y-1 transition-all duration-300">
                                        <i class="fas fa-eye ml-2"></i> عرض التفاصيل
                                    </a>
                                    @if ($job->user_id === auth()->id())
                                        <div class="flex space-x-2 space-x-reverse">
                                            <a href="{{ route('jobs.edit', $job) }}" 
                                               class="inline-flex items-center justify-center px-4 py-2 bg-gradient-to-r from-amber-500 to-orange-500 text-white font-bold rounded-lg shadow hover:shadow-lg transform hover:-translate-y-1 transition-all duration-300">
                                                <i class="fas fa-edit ml-1"></i> تعديل
                                            </a>
                                            <form action="{{ route('jobs.destroy', $job) }}" method="POST" class="inline">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" 
                                                        class="inline-flex items-center justify-center px-4 py-2 bg-gradient-to-r from-red-500 to-pink-500 text-white font-bold rounded-lg shadow hover:shadow-lg transform hover:-translate-y-1 transition-all duration-300" 
                                                        onclick="return confirm('هل أنت متأكد من حذف هذه الوظيفة؟')">
                                                    <i class="fas fa-trash ml-1"></i> حذف
                                                </button>
                                            </form>
                                        </div>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @empty
                <div class="bg-white/90 backdrop-blur-lg rounded-2xl shadow-xl border border-white/20 text-center py-16">
                    <div class="inline-flex items-center justify-center w-24 h-24 bg-gradient-to-br from-gray-400 to-gray-600 rounded-full shadow-2xl mb-6">
                        <i class="fas fa-briefcase text-white text-4xl"></i>
                    </div>
                    <h3 class="text-2xl font-bold text-gray-900 mb-4">لا توجد وظائف لديك حالياً</h3>
                    <p class="text-gray-600 text-lg mb-8 max-w-md mx-auto">ابدأ بنشر وظائفك للعثور على أفضل المواهب المناسبة</p>
                    <a href="{{ route('jobs.create') }}" 
                       class="inline-flex items-center px-8 py-4 bg-gradient-to-r from-green-500 to-emerald-600 text-white font-bold rounded-xl shadow-lg hover:shadow-xl transform hover:-translate-y-1 transition-all duration-300">
                        <i class="fas fa-plus ml-3"></i>
                        نشر وظيفة جديدة
                    </a>
                </div>
            @endforelse
        @else
            {{-- Applicant View - All Jobs --}}
            @forelse($jobs as $job)
                <div class="group bg-white/90 backdrop-blur-lg rounded-2xl shadow-lg hover:shadow-2xl transition-all duration-500 overflow-hidden border border-white/20 mb-6 transform hover:-translate-y-2">
                    <!-- Gradient Top Bar -->
                    <div class="h-2 bg-gradient-to-r from-purple-500 via-pink-500 to-red-500"></div>
                    
                    <div class="p-8">
                        <div class="flex items-center justify-between">
                            <div class="flex-1">
                                <div class="flex items-center mb-4">
                                    <div class="relative">
                                        <div class="absolute inset-0 bg-gradient-to-br from-purple-400 to-pink-600 rounded-full opacity-20 blur-xl"></div>
                                        <img src="{{ $job->company_logo }}" alt="Company" class="relative w-16 h-16 rounded-full ml-6 shadow-lg transform group-hover:scale-110 transition-transform duration-300" width="64" height="64">
                                    </div>
                                    <div>
                                        <h3 class="text-2xl font-bold text-gray-900 mb-2 group-hover:text-purple-600 transition-colors">
                                            <a href="{{ route('jobs.show', $job) }}" class="bg-gradient-to-r from-purple-600 to-pink-600 bg-clip-text text-transparent">{{ $job->title }}</a>
                                        </h3>
                                        <p class="text-gray-600 font-medium">{{ optional($job->company)->name ?? 'غير محدد' }}</p>
                                    </div>
                                </div>
                                
                                <div class="flex flex-wrap gap-3 mb-4">
                                    <span class="inline-flex items-center px-4 py-2 rounded-full text-sm font-semibold bg-gradient-to-r from-blue-100 to-blue-200 text-blue-800 border border-blue-300">
                                        <i class="fas fa-map-marker-alt ml-2"></i>
                                        {{ $job->location }}
                                    </span>
                                    <span class="inline-flex items-center px-4 py-2 rounded-full text-sm font-semibold bg-gradient-to-r from-green-100 to-emerald-200 text-green-800 border border-green-300">
                                        <i class="fas fa-briefcase ml-2"></i>
                                        {{ $job->type_arabic }}
                                    </span>
                                    @if($job->salary_min || $job->salary_max)
                                    <span class="inline-flex items-center px-4 py-2 rounded-full text-sm font-semibold bg-gradient-to-r from-yellow-100 to-amber-200 text-yellow-800 border border-yellow-300">
                                        <i class="fas fa-money-bill-wave ml-2"></i>
                                        {{ $job->salary_min ? number_format($job->salary_min) : '' }}
                                        {{ $job->salary_min && $job->salary_max ? '-' : '' }}
                                        {{ $job->salary_max ? number_format($job->salary_max) : '' }}
                                        $
                                    </span>
                                    @endif
                                    <span class="inline-flex items-center px-4 py-2 rounded-full text-sm font-semibold bg-gradient-to-r from-gray-100 to-gray-200 text-gray-800 border border-gray-300">
                                        <i class="fas fa-clock ml-2"></i>
                                        {{ $job->created_at?->diffForHumans() }}
                                    </span>
                                </div>
                                
                                @if($job->description)
                                <p class="text-gray-600 leading-relaxed mb-4">
                                    {{ Str::limit(strip_tags($job->description), 150) }}
                                </p>
                                @endif
                            </div>
                            
                            <div class="text-left">
                                @php
                                    $isSaved = in_array($job->id, $savedJobIds ?? []);
                                @endphp
                                <div class="flex flex-col gap-3">
                                    <!-- Save Job Button -->
                                    <button onclick="toggleSaveJob({{ $job->id }})" 
                                            id="save-btn-{{ $job->id }}"
                                            class="save-job-btn relative inline-flex items-center justify-center px-6 py-3 rounded-xl font-bold transition-all duration-300 transform hover:scale-105 group {{ $isSaved ? 'bg-gradient-to-r from-red-500 to-pink-600 text-white shadow-lg hover:shadow-xl' : 'bg-gray-100 text-gray-700 hover:bg-gray-200 hover:text-gray-900' }}">
                                        <i class="fas fa-heart ml-2 transition-all duration-300 {{ $isSaved ? 'text-white animate-pulse' : 'text-gray-500 group-hover:text-red-500' }}"></i>
                                        <span class="transition-all duration-300">{{ $isSaved ? 'محفوظة' : 'حفظ' }}</span>
                                        @if($isSaved)
                                            <div class="absolute -top-1 -right-1 w-3 h-3 bg-red-500 rounded-full animate-ping"></div>
                                            <div class="absolute -top-1 -right-1 w-3 h-3 bg-red-500 rounded-full"></div>
                                        @endif
                                    </button>
                                    
                                    <!-- View Details Button -->
                                    <a href="{{ route('jobs.show', $job) }}" 
                                       class="inline-flex items-center justify-center px-6 py-3 bg-gradient-to-r from-indigo-500 to-purple-600 text-white font-bold rounded-xl shadow-lg hover:shadow-xl transform hover:-translate-y-1 transition-all duration-300 hover:from-indigo-600 hover:to-purple-700">
                                        <i class="fas fa-eye ml-2"></i>
                                        <span>عرض التفاصيل</span>
                                    </a>
                                    
                                    @if ($job->user_id === auth()->id())
                                        <!-- Owner Actions -->
                                        <div class="space-y-3">
                                            <!-- Primary Actions -->
                                            <div class="flex gap-2">
                                                <a href="{{ route('jobs.edit', $job) }}" 
                                                   class="flex-1 inline-flex items-center justify-center px-4 py-2.5 bg-gradient-to-r from-blue-500 to-indigo-600 text-white font-bold rounded-lg shadow hover:shadow-lg transform hover:-translate-y-1 transition-all duration-300 hover:from-blue-600 hover:to-indigo-700">
                                                    <i class="fas fa-edit ml-1.5"></i>
                                                    <span>تعديل</span>
                                                </a>
                                                <a href="{{ route('jobs.show', $job) . '#applications' }}" 
                                                   class="flex-1 inline-flex items-center justify-center px-4 py-2.5 bg-gradient-to-r from-emerald-500 to-teal-600 text-white font-bold rounded-lg shadow hover:shadow-lg transform hover:-translate-y-1 transition-all duration-300 hover:from-emerald-600 hover:to-teal-700">
                                                    <i class="fas fa-users ml-1.5"></i>
                                                    <span>المتقدمين</span>
                                                </a>
                                            </div>
                                            
                                            <!-- Secondary Actions -->
                                            <div class="flex gap-2">
                                                <button onclick="toggleJobStatus({{ $job->id }}, '{{ $job->is_active ? 'deactivate' : 'activate' }}')" 
                                                        class="flex-1 inline-flex items-center justify-center px-4 py-2 {{ $job->is_active ? 'bg-gradient-to-r from-orange-500 to-amber-600 hover:from-orange-600 hover:to-amber-700' : 'bg-gradient-to-r from-green-500 to-emerald-600 hover:from-green-600 hover:to-emerald-700' }} text-white font-bold rounded-lg shadow hover:shadow-lg transform hover:-translate-y-1 transition-all duration-300">
                                                    <i class="fas fa-{{ $job->is_active ? 'pause' : 'play' }} ml-1.5"></i>
                                                    <span>{{ $job->is_active ? 'إيقاف' : 'تفعيل' }}</span>
                                                </button>
                                                
                                                <button onclick="shareJob({{ $job->id }})" 
                                                        class="flex-1 inline-flex items-center justify-center px-4 py-2 bg-gradient-to-r from-purple-500 to-pink-600 text-white font-bold rounded-lg shadow hover:shadow-lg transform hover:-translate-y-1 transition-all duration-300 hover:from-purple-600 hover:to-pink-700">
                                                    <i class="fas fa-share-alt ml-1.5"></i>
                                                    <span>مشاركة</span>
                                                </button>
                                            </div>
                                            
                                            <!-- Danger Zone -->
                                            <div class="relative">
                                                <div class="absolute inset-0 flex items-center">
                                                    <div class="w-full border-t border-gray-300"></div>
                                                </div>
                                                <div class="relative flex justify-center text-sm">
                                                    <span class="px-2 bg-white text-gray-500">منطقة الخطر</span>
                                                </div>
                                            </div>
                                            
                                            <form action="{{ route('jobs.destroy', $job) }}" method="POST" class="w-full">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" 
                                                        class="w-full inline-flex items-center justify-center px-4 py-2.5 bg-gradient-to-r from-red-600 to-rose-700 text-white font-bold rounded-lg shadow hover:shadow-lg transform hover:-translate-y-1 transition-all duration-300 hover:from-red-700 hover:to-rose-800 border-2 border-red-200" 
                                                        onclick="return confirm('⚠️ تحذير: هل أنت متأكد من حذف هذه الوظيفة؟\n\n• سيتم حذف جميع الطلبات المرتبطة\n• لا يمكن التراجع عن هذا الإجراء\n• سيتم إزالة الوظيفة نهائياً')">
                                                    <i class="fas fa-trash-alt ml-1.5"></i>
                                                    <span>حذف الوظيفة</span>
                                                </button>
                                            </form>
                                        </div>
                                    @else
                                        <!-- Apply Button -->
                                        <a href="{{ route('jobs.applications.create', $job) }}" 
                                           class="inline-flex items-center justify-center px-6 py-3 bg-gradient-to-r from-emerald-500 to-teal-600 text-white font-bold rounded-xl shadow-lg hover:shadow-xl transform hover:-translate-y-1 transition-all duration-300 hover:from-emerald-600 hover:to-teal-700">
                                            <i class="fas fa-paper-plane ml-2"></i>
                                            <span>التقديم الآن</span>
                                        </a>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @empty
                <div class="bg-white/90 backdrop-blur-lg rounded-2xl shadow-xl border border-white/20 text-center py-16">
                    <div class="inline-flex items-center justify-center w-24 h-24 bg-gradient-to-br from-purple-400 to-pink-600 rounded-full shadow-2xl mb-6">
                        <i class="fas fa-search text-white text-4xl"></i>
                    </div>
                    <h3 class="text-2xl font-bold text-gray-900 mb-4">لا توجد وظائف متاحة حالياً</h3>
                    <p class="text-gray-600 text-lg mb-8 max-w-md mx-auto">حاول تغيير معايير البحث أو فلترة النتائج للعثور على وظائف مناسبة</p>
                    <button onclick="clearFilters()" 
                            class="inline-flex items-center px-8 py-4 bg-gradient-to-r from-gray-500 to-gray-600 text-white font-bold rounded-xl shadow-lg hover:shadow-xl transform hover:-translate-y-1 transition-all duration-300">
                        <i class="fas fa-redo ml-3"></i>
                        مسح الفلاتر
                    </button>
                </div>
            @endforelse
        @endif
    @else
        {{-- Guest View --}}
        @forelse($jobs as $job)
            <div class="group bg-white/90 backdrop-blur-lg rounded-2xl shadow-lg hover:shadow-2xl transition-all duration-500 overflow-hidden border border-white/20 mb-6 transform hover:-translate-y-2">
                <!-- Gradient Top Bar -->
                <div class="h-2 bg-gradient-to-r from-indigo-500 via-blue-500 to-cyan-500"></div>
                
                <div class="p-8">
                    <div class="flex items-center justify-between">
                        <div class="flex-1">
                            <div class="flex items-center mb-4">
                                @if($job->company)
                                    <div class="relative">
                                        <div class="absolute inset-0 bg-gradient-to-br from-indigo-400 to-blue-600 rounded-full opacity-20 blur-xl"></div>
                                        <img src="{{ $job->company->logo_url ?? 'https://ui-avatars.com/api/?name=' . urlencode($job->company->name) }}" 
                                             alt="{{ $job->company->name }}" 
                                             class="relative w-16 h-16 rounded-full ml-6 shadow-lg transform group-hover:scale-110 transition-transform duration-300" width="64" height="64">
                                    </div>
                                    <div>
                                        <h3 class="text-2xl font-bold text-gray-900 mb-2 group-hover:text-indigo-600 transition-colors">
                                            <a href="{{ route('jobs.show', $job) }}" class="bg-gradient-to-r from-indigo-600 to-blue-600 bg-clip-text text-transparent">{{ $job->title }}</a>
                                        </h3>
                                        <p class="text-gray-600 font-medium">{{ $job->company->name ?? 'غير محدد' }}</p>
                                    </div>
                                @else
                                    <div class="relative">
                                        <div class="absolute inset-0 bg-gradient-to-br from-indigo-400 to-blue-600 rounded-full opacity-20 blur-xl"></div>
                                        <div class="relative w-16 h-16 rounded-full bg-gradient-to-br from-indigo-500 to-blue-600 text-white flex items-center justify-center ml-6 shadow-lg text-2xl font-bold">
                                            {{ substr($job->user->name, 0, 1) }}
                                        </div>
                                    </div>
                                    <div>
                                        <h3 class="text-2xl font-bold text-gray-900 mb-2 group-hover:text-indigo-600 transition-colors">
                                            <a href="{{ route('jobs.show', $job) }}" class="bg-gradient-to-r from-indigo-600 to-blue-600 bg-clip-text text-transparent">{{ $job->title }}</a>
                                        </h3>
                                        <p class="text-gray-600 font-medium">{{ $job->user->name }}</p>
                                    </div>
                                @endif
                            </div>
                            
                            <div class="flex flex-wrap gap-3 mb-4">
                                <span class="inline-flex items-center px-4 py-2 rounded-full text-sm font-semibold bg-gradient-to-r from-blue-100 to-blue-200 text-blue-800 border border-blue-300">
                                    <i class="fas fa-map-marker-alt ml-2"></i>
                                    {{ $job->location }}
                                </span>
                                <span class="inline-flex items-center px-4 py-2 rounded-full text-sm font-semibold bg-gradient-to-r from-green-100 to-emerald-200 text-green-800 border border-green-300">
                                    <i class="fas fa-briefcase ml-2"></i>
                                    {{ $job->type_arabic }}
                                </span>
                                <span class="inline-flex items-center px-4 py-2 rounded-full text-sm font-semibold bg-gradient-to-r from-gray-100 to-gray-200 text-gray-800 border border-gray-300">
                                    <i class="fas fa-clock ml-2"></i>
                                    {{ $job->created_at?->diffForHumans() }}
                                </span>
                            </div>
                        </div>
                        
                        <div class="text-left">
                            <div class="flex flex-col space-y-3 space-y-reverse">
                                <a href="{{ route('jobs.show', $job) }}" 
                                   class="inline-flex items-center justify-center px-6 py-3 bg-gradient-to-r from-indigo-500 to-blue-600 text-white font-bold rounded-xl shadow-lg hover:shadow-xl transform hover:-translate-y-1 transition-all duration-300">
                                    <i class="fas fa-eye ml-2"></i> عرض التفاصيل
                                </a>
                                <a href="{{ route('login') }}" 
                                   class="inline-flex items-center justify-center px-6 py-3 bg-gradient-to-r from-gray-500 to-gray-600 text-white font-bold rounded-xl shadow-lg hover:shadow-xl transform hover:-translate-y-1 transition-all duration-300">
                                    <i class="fas fa-sign-in-alt ml-2"></i> سجل دخول للتقديم
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @empty
            <div class="bg-white/90 backdrop-blur-lg rounded-2xl shadow-xl border border-white/20 text-center py-16">
                <div class="inline-flex items-center justify-center w-24 h-24 bg-gradient-to-br from-indigo-400 to-blue-600 rounded-full shadow-2xl mb-6">
                    <i class="fas fa-search text-white text-4xl"></i>
                </div>
                <h3 class="text-2xl font-bold text-gray-900 mb-4">لا توجد وظائف متاحة حالياً</h3>
                <p class="text-gray-600 text-lg max-w-md mx-auto">حاول تغيير معايير البحث أو فلترة النتائج للعثور على وظائف مناسبة</p>
            </div>
        @endforelse
    @endauth
    </div>
</div>

<script>
// Toggle save job functionality
function toggleSaveJob(jobId) {
    const btn = document.getElementById(`save-btn-${jobId}`);
    const icon = btn.querySelector('i');
    const text = btn.querySelector('span');
    const isCurrentlySaved = btn.classList.contains('from-red-500');
    
    // Add loading state
    btn.disabled = true;
    btn.classList.add('opacity-75', 'cursor-not-allowed');
    icon.className = 'fas fa-spinner fa-spin ml-2';
    text.textContent = isCurrentlySaved ? 'جاري الإلغاء...' : 'جاري الحفظ...';
    
    if (isCurrentlySaved) {
        // Unsave job - find and delete the saved job
        fetch(`/saved-jobs/by-job/${jobId}`, {
            method: 'DELETE',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
            }
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                // Update button to unsaved state
                btn.classList.remove('from-red-500', 'to-pink-600', 'text-white', 'shadow-lg', 'hover:shadow-xl');
                btn.classList.add('bg-gray-100', 'text-gray-700', 'hover:bg-gray-200', 'hover:text-gray-900');
                icon.className = 'fas fa-heart ml-2 text-gray-500 group-hover:text-red-500 transition-all duration-300';
                text.textContent = 'حفظ';
                
                // Remove indicator dots
                const dots = btn.querySelectorAll('.absolute');
                dots.forEach(dot => dot.remove());
                
                // Show success message
                showNotification('تم إلغاء حفظ الوظيفة', 'info');
                
                // Save state to localStorage
                saveButtonState(jobId, false);
            } else {
                showNotification(data.message || 'فشل إلغاء حفظ الوظيفة', 'error');
            }
        })
        .catch(error => {
            console.error('Error:', error);
            showNotification('حدث خطأ في الاتصال بالسيرفر', 'error');
        })
        .finally(() => {
            btn.disabled = false;
            btn.classList.remove('opacity-75', 'cursor-not-allowed');
        });
    } else {
        // Save job
        fetch(`/saved-jobs`, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
            },
            body: JSON.stringify({
                job_id: jobId
            })
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                // Update button to saved state
                btn.classList.remove('bg-gray-100', 'text-gray-700', 'hover:bg-gray-200', 'hover:text-gray-900');
                btn.classList.add('from-red-500', 'to-pink-600', 'text-white', 'shadow-lg', 'hover:shadow-xl');
                icon.className = 'fas fa-heart ml-2 text-white animate-pulse transition-all duration-300';
                text.textContent = 'محفوظة';
                
                // Add indicator dots
                const pingDot = document.createElement('div');
                pingDot.className = 'absolute -top-1 -right-1 w-3 h-3 bg-red-500 rounded-full animate-ping';
                const solidDot = document.createElement('div');
                solidDot.className = 'absolute -top-1 -right-1 w-3 h-3 bg-red-500 rounded-full';
                btn.appendChild(pingDot);
                btn.appendChild(solidDot);
                
                // Show success message
                showNotification('تم حفظ الوظيفة بنجاح!', 'success');
                
                // Save state to localStorage
                saveButtonState(jobId, true);
            } else {
                showNotification(data.message || 'فشل حفظ الوظيفة', 'error');
            }
        })
        .catch(error => {
            console.error('Error:', error);
            showNotification('حدث خطأ في الاتصال بالسيرفر', 'error');
        })
        .finally(() => {
            btn.disabled = false;
            btn.classList.remove('opacity-75', 'cursor-not-allowed');
        });
    }
}

// Show notification function
function showNotification(message, type = 'info') {
    const notification = document.createElement('div');
    const colors = {
        success: 'bg-green-500',
        error: 'bg-red-500',
        info: 'bg-blue-500'
    };
    
    notification.className = `fixed top-24 left-4 ${colors[type]} text-white px-6 py-3 rounded-lg shadow-lg z-[70] transform translate-x-0 transition-all duration-300`;
    notification.innerHTML = `
        <div class="flex items-center">
            <i class="fas fa-${type === 'success' ? 'check-circle' : type === 'error' ? 'exclamation-circle' : 'info-circle'} ml-2"></i>
            ${message}
        </div>
    `;
    
    document.body.appendChild(notification);
    
    // Animate in
    setTimeout(() => {
        notification.classList.add('translate-x-0');
    }, 100);
    
    // Remove after 3 seconds
    setTimeout(() => {
        notification.classList.add('translate-x-full', 'opacity-0');
        setTimeout(() => {
            document.body.removeChild(notification);
        }, 300);
    }, 3000);
}

// Clear filters function
function clearFilters() {
    window.location.href = '{{ route("jobs.index") }}';
}

// Save button state to localStorage
function saveButtonState(jobId, isSaved) {
    const savedStates = JSON.parse(localStorage.getItem('savedJobStates') || '{}');
    savedStates[jobId] = isSaved;
    localStorage.setItem('savedJobStates', JSON.stringify(savedStates));
}

// Get button state from localStorage
function getButtonState(jobId) {
    const savedStates = JSON.parse(localStorage.getItem('savedJobStates') || '{}');
    return savedStates[jobId] || false;
}

// Initialize button states on page load
document.addEventListener('DOMContentLoaded', function() {
    // Sync localStorage with server state
    const savedStates = JSON.parse(localStorage.getItem('savedJobStates') || '{}');
    
    // Clear localStorage states that don't match server state
    @foreach($savedJobIds as $savedJobId)
        savedStates[{{ $savedJobId }}] = true;
    @endforeach
    
    localStorage.setItem('savedJobStates', JSON.stringify(savedStates));
});

// Toggle job status function
function toggleJobStatus(jobId, action) {
    const btn = event.target.closest('button');
    const icon = btn.querySelector('i');
    const text = btn.querySelector('span');
    
    // Add loading state
    btn.disabled = true;
    btn.classList.add('opacity-75', 'cursor-not-allowed');
    icon.className = 'fas fa-spinner fa-spin ml-1.5';
    text.textContent = 'جاري المعالجة...';
    
    // Send AJAX request
    fetch(`/jobs/${jobId}/status`, {
        method: 'PATCH',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
        },
        body: JSON.stringify({
            action: action
        })
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            // Update button appearance
            if (action === 'activate') {
                btn.classList.remove('from-green-500', 'to-emerald-600', 'hover:from-green-600', 'hover:to-emerald-700');
                btn.classList.add('from-orange-500', 'to-amber-600', 'hover:from-orange-600', 'hover:to-amber-700');
                icon.className = 'fas fa-pause ml-1.5';
                text.textContent = 'إيقاف';
                showNotification('تم تفعيل الوظيفة بنجاح', 'success');
            } else {
                btn.classList.remove('from-orange-500', 'to-amber-600', 'hover:from-orange-600', 'hover:to-amber-700');
                btn.classList.add('from-green-500', 'to-emerald-600', 'hover:from-green-600', 'hover:to-emerald-700');
                icon.className = 'fas fa-play ml-1.5';
                text.textContent = 'تفعيل';
                showNotification('تم إيقاف الوظيفة بنجاح', 'info');
            }
        } else {
            showNotification(data.message || 'فشل تحديث حالة الوظيفة', 'error');
        }
    })
    .catch(error => {
        console.error('Error:', error);
        showNotification('حدث خطأ في الاتصال بالسيرفر', 'error');
    })
    .finally(() => {
        btn.disabled = false;
        btn.classList.remove('opacity-75', 'cursor-not-allowed');
    });
}

// Share job function
function shareJob(jobId) {
    const jobUrl = `${window.location.origin}/jobs/${jobId}`;
    
    // Try to use Web Share API if available
    if (navigator.share) {
        navigator.share({
            title: 'فرصة عمل مميزة',
            text: 'شاهد هذه الفرصة الوظيفية الممتازة',
            url: jobUrl
        })
        .then(() => {
            showNotification('تم مشاركة الوظيفة بنجاح', 'success');
        })
        .catch((error) => {
            console.log('Share cancelled');
        });
    } else {
        // Fallback: Copy to clipboard
        navigator.clipboard.writeText(jobUrl).then(() => {
            showNotification('تم نسخ رابط الوظيفة', 'success');
        }).catch(() => {
            // Fallback: Show modal with URL
            prompt('انسخ رابط الوظيفة:', jobUrl);
        });
    }
}
</script>

@endsection
