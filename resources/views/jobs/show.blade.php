@extends('layouts.app')

@section('content')
<div class="min-h-screen bg-gradient-to-br from-gray-50 via-white to-blue-50 py-8">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

        <!-- Professional Job Header -->
        <div class="bg-white rounded-3xl shadow-2xl overflow-hidden border border-gray-200 mb-12 relative">
            <!-- Background Pattern -->
            <div class="absolute inset-0 opacity-5">
                <div class="absolute inset-0 bg-gradient-to-br from-blue-50 to-purple-50"></div>
                <div class="absolute inset-0" style="background-image: url('data:image/svg+xml,%3Csvg width=\"60\" height=\"60\" viewBox=\"0 0 60 60\" xmlns=\"http://www.w3.org/2000/svg\"%3E%3Cg fill=\"none\" fill-opacity=\"0.1\" fill-rule=\"evenodd\" d=\"M0 0h60v60H0z\"%3E%3C/g%3E%3C/svg%3E'); background-size: 60px 60px;"></div>
            </div>

            <!-- Top Gradient Bar -->
            <div class="relative h-3 bg-gradient-to-r from-blue-600 via-indigo-600 to-purple-600">
                <div class="absolute inset-0 bg-white opacity-10"></div>
                <!-- Decorative Pattern -->
                <div class="absolute inset-0 flex items-center justify-center">
                    <div class="flex space-x-8">
                        <div class="w-2 h-2 bg-white rounded-full opacity-20"></div>
                        <div class="w-2 h-2 bg-white rounded-full opacity-40"></div>
                        <div class="w-2 h-2 bg-white rounded-full opacity-60"></div>
                        <div class="w-2 h-2 bg-white rounded-full opacity-40"></div>
                        <div class="w-2 h-2 bg-white rounded-full opacity-20"></div>
                    </div>
                </div>
            </div>

            <div class="relative p-10">
                <div class="flex flex-col lg:flex-row lg:items-center lg:justify-between gap-8">
                    <!-- Company Info -->
                    <div class="flex items-center gap-8">
                        <div class="relative group">
                            <!-- Enhanced Logo Container -->
                            <div class="relative">
                                <div class="absolute -inset-1 bg-gradient-to-r from-blue-500 to-purple-600 rounded-3xl opacity-20 group-hover:opacity-30 transition-opacity duration-500"></div>
                                <img src="{{ $job->company_logo ?? 'https://ui-avatars.com/api/?name=' . urlencode(optional($job->company)->name ?? $job->user->name) }}"
                                     alt="{{ optional($job->company)->name ?? $job->user->name }}"
                                     class="relative w-24 h-24 rounded-3xl object-cover border-4 border-white shadow-2xl group-hover:scale-105 transition-transform duration-500">

                                <!-- Enhanced Status Indicator -->
                                @if($job->is_active)
                                    <div class="absolute -bottom-3 -right-3 w-8 h-8 bg-gradient-to-r from-green-500 to-emerald-600 rounded-full border-4 border-white flex items-center justify-center shadow-lg animate-pulse">
                                        <i class="fas fa-check text-white text-sm"></i>
                                    </div>
                                @else
                                    <div class="absolute -bottom-3 -right-3 w-8 h-8 bg-gradient-to-r from-gray-400 to-gray-600 rounded-full border-4 border-white flex items-center justify-center shadow-lg">
                                        <i class="fas fa-pause text-white text-sm"></i>
                                    </div>
                                @endif
                            </div>
                        </div>

                        <div class="flex-1">
                            <h1 class="text-4xl font-black bg-gradient-to-r from-blue-600 to-purple-600 bg-clip-text text-transparent mb-3 leading-tight">
                                {{ $job->title }}
                            </h1>

                            <div class="flex flex-wrap items-center gap-4 text-gray-700">
                                <span class="text-xl font-medium flex items-center gap-2">
                                    <i class="fas fa-building text-blue-500"></i>
                                    {{ optional($job->company)->name ?? $job->user->name }}
                                </span>
                                <span class="text-gray-400">•</span>
                                <span class="inline-flex items-center px-4 py-2 rounded-full bg-blue-100 text-blue-700 border border-blue-200 font-medium">
                                    <i class="fas fa-map-marker-alt ml-2"></i>
                                    {{ $job->location }}
                                </span>
                                <span class="text-gray-400">•</span>
                                <span class="inline-flex items-center px-4 py-2 rounded-full bg-purple-100 text-purple-700 border border-purple-200 font-medium">
                                    <i class="fas fa-briefcase ml-2"></i>
                                    {{ $job->type_arabic }}
                                </span>

                                @if ($job->created_at > now()->subDays(7))
                                    <span class="inline-flex items-center px-4 py-2 rounded-full bg-green-100 text-green-700 border border-green-200 text-sm font-bold animate-pulse">
                                        <i class="fas fa-star ml-2"></i>
                                        جديد
                                    </span>
                                @endif
                            </div>
                        </div>
                    </div>

                    <!-- Enhanced Action Buttons -->
                    <div class="flex flex-wrap gap-4">
                        @auth
                            @if(auth()->user()->role === 'applicant')
                                <!-- Enhanced Save Job Button -->
                                @php
                                    $isSaved = auth()->user()->savedJobs->contains($job->id);
                                @endphp

                                <div class="relative group">
                                    <form action="#" method="POST" id="saveJobForm" class="inline">
                                        @csrf
                                        <button type="submit"
                                                class="save-job-btn inline-flex items-center px-8 py-4 border-2 rounded-2xl text-base font-bold transition-all duration-500 relative
                                                {{ $isSaved
                                                    ? 'bg-gradient-to-r from-yellow-400 via-orange-500 to-red-500 text-white border-yellow-400 shadow-2xl shadow-yellow-300 hover:shadow-3xl hover:shadow-yellow-400'
                                                    : 'bg-white text-gray-700 border-gray-300 hover:border-blue-400 hover:bg-blue-50 hover:text-blue-700' }}">

                                            <!-- Background Ripple Effect -->
                                            <div class="absolute inset-0 bg-gradient-to-r from-blue-500 to-purple-500 opacity-0 group-hover:opacity-20 transition-opacity duration-500 overflow-hidden"></div>

                                            <!-- Icon Container -->
                                            <div class="relative flex items-center">
                                                <div class="icon-wrapper relative">
                                                    <svg class="h-6 w-6 ml-3 transition-all duration-500 {{ $isSaved ? 'text-white animate-pulse' : 'text-gray-500 group-hover:text-blue-600' }}"
                                                         fill="{{ $isSaved ? 'currentColor' : 'none' }}"
                                                         stroke="currentColor"
                                                         stroke-width="3"
                                                         viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round"
                                                              d="M5 5a2 2 0 012-2h10a2 2 0 012 2v16l-7-4-7 4V5z"/>
                                                    </svg>

                                                    <!-- Enhanced Particle Effects for Saved State -->
                                                    @if($isSaved)
                                                        <div class="absolute inset-0 pointer-events-none">
                                                            <div class="particle-1"></div>
                                                            <div class="particle-2"></div>
                                                            <div class="particle-3"></div>
                                                            <div class="particle-4"></div>
                                                            <div class="particle-5"></div>
                                                        </div>
                                                    @endif
                                                </div>

                                                <span class="relative z-10 text-base font-medium">{{ $isSaved ? 'محفوظة' : 'حفظ الوظيفة' }}</span>

                                                <!-- Enhanced Loading Spinner -->
                                                <div class="loading-spinner hidden ml-3">
                                                    <svg class="animate-spin h-5 w-5" fill="none" viewBox="0 0 24 24">
                                                        <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="3"></circle>
                                                        <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 016-12v4a8 8 0 018 8z"></path>
                                                    </svg>
                                                </div>
                                            </div>

                                            <!-- Enhanced Shine Effect -->
                                            <div class="absolute inset-0 bg-gradient-to-r from-transparent via-white to-transparent opacity-0 group-hover:opacity-30 transform -skew-x-12 -translate-x-full group-hover:translate-x-full transition-all duration-1000"></div>
                                        </button>
                                    </form>

                                    <!-- Enhanced Professional Tooltip -->
                                    <div class="absolute bottom-full right-0 mb-4 px-6 py-3 bg-gray-900 text-white text-sm rounded-2xl opacity-0 group-hover:opacity-100 transition-all duration-500 pointer-events-none whitespace-nowrap transform translate-y-4 group-hover:translate-y-0 z-[9999] shadow-2xl">
                                        <div class="flex items-center gap-3">
                                            <i class="fas fa-{{ $isSaved ? 'bookmark' : 'heart' }} text-base"></i>
                                            <div>
                                                <span class="font-semibold">{{ $isSaved ? 'إلغاء حفظ الوظيفة' : 'حفظ للوصول لاحقاً' }}</span>
                                                <div class="text-xs opacity-80 mt-1">{{ $isSaved ? 'يمكنك إلغاء الحفظ في أي وقت' : 'احفظ الوظيفة للوصول إليها لاحقاً' }}</div>
                                            </div>
                                        </div>
                                        <!-- Enhanced Tooltip Arrow -->
                                        <div class="absolute top-full right-8 w-0 h-0 border-l-8 border-r-8 border-t-8 border-transparent border-t-gray-900"></div>
                                    </div>
                                </div>

                                <a href="{{ route('jobs.applications.create', $job) }}"
                                   class="inline-flex items-center px-8 py-4 bg-gradient-to-r from-green-600 via-emerald-600 to-teal-600 text-white font-bold rounded-2xl hover:from-green-700 hover:via-emerald-700 hover:to-teal-700 transition-all duration-500 hover:shadow-2xl hover:scale-105">
                                    <i class="fas fa-paper-plane ml-3"></i>
                                    التقديم الآن
                                </a>
                            @endif

                            @if(auth()->id() === $job->user_id)
                                <!-- Enhanced Employer Controls -->
                                <a href="{{ route('jobs.applications.index', $job) }}"
                                   class="inline-flex items-center px-8 py-4 bg-gradient-to-r from-blue-600 via-indigo-600 to-purple-600 text-white font-bold rounded-2xl hover:from-blue-700 hover:via-indigo-700 hover:to-purple-700 transition-all duration-500 hover:shadow-2xl hover:scale-105">
                                    <i class="fas fa-users ml-3"></i>
                                    طلبات التقديم
                                </a>

                                <a href="{{route('jobs.edit', $job) }}"
                                   class="inline-flex items-center px-8 py-4 bg-gradient-to-r from-amber-500 via-orange-500 to-red-500 text-white font-bold rounded-2xl hover:from-amber-600 hover:via-orange-600 hover:to-red-600 transition-all duration-500 hover:shadow-2xl hover:scale-105">
                                    <i class="fas fa-edit ml-3"></i>
                                    تعديل
                                </a>

                                <form action="{{ route('jobs.destroy', $job) }}" method="POST" class="inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit"
                                            class="inline-flex items-center px-8 py-4 bg-gradient-to-r from-red-600 via-pink-600 to-rose-600 text-white font-bold rounded-2xl hover:from-red-700 hover:via-pink-700 hover:to-rose-700 transition-all duration-500 hover:shadow-2xl hover:scale-105"
                                            onclick="return confirm('هل أنت متأكد من حذف هذه الوظيفة؟')">
                                        <i class="fas fa-trash ml-3"></i>
                                        حذف
                                    </button>
                                </form>
                            @endif
                        @else
                            <!-- Enhanced Guest Login -->
                            <a href="{{ route('login') }}"
                               class="inline-flex items-center px-8 py-4 bg-gradient-to-r from-blue-600 via-indigo-600 to-purple-600 text-white font-bold rounded-2xl hover:from-blue-700 hover:via-indigo-700 hover:to-purple-700 transition-all duration-500 hover:shadow-2xl hover:scale-105">
                                <i class="fas fa-sign-in-alt ml-3"></i>
                                سجل دخول للتقديم
                            </a>
                        @endauth
                    </div>
                </div>
            </div>
        </div>

        <!-- Job Content -->
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
            <!-- Main Content -->
            <div class="lg:col-span-2 space-y-8">
                <!-- Job Description -->
                <div class="bg-white rounded-2xl shadow-lg p-8 border border-gray-100">
                    <div class="flex items-center gap-3 mb-6">
                        <div class="w-10 h-10 bg-gradient-to-br from-blue-500 to-indigo-600 rounded-xl flex items-center justify-center">
                            <i class="fas fa-file-alt text-white"></i>
                        </div>
                        <h2 class="text-2xl font-bold text-gray-900">وصف الوظيفة</h2>
                    </div>

                    <div class="prose prose-lg max-w-none text-gray-700 leading-relaxed">
                        {!! nl2br(e($job->description)) !!}
                    </div>
                </div>

                <!-- Requirements -->
                <div class="bg-white rounded-2xl shadow-lg p-8 border border-gray-100">
                    <div class="flex items-center gap-3 mb-6">
                        <div class="w-10 h-10 bg-gradient-to-br from-purple-500 to-pink-600 rounded-xl flex items-center justify-center">
                            <i class="fas fa-clipboard-check text-white"></i>
                        </div>
                        <h2 class="text-2xl font-bold text-gray-900">المتطلبات</h2>
                    </div>
                    <div class="prose prose-lg max-w-none text-gray-700 leading-relaxed">
                        {!! nl2br(e($job->requirements)) !!}
                    </div>
                </div>

                <!-- Benefits -->
                @if($job->benefits)
                <div class="bg-white rounded-2xl shadow-lg p-8 border border-gray-100">
                    <div class="flex items-center gap-3 mb-6">
                        <div class="w-10 h-10 bg-gradient-to-br from-green-500 to-emerald-600 rounded-xl flex items-center justify-center">
                            <i class="fas fa-gift text-white"></i>
                        </div>
                        <h2 class="text-2xl font-bold text-gray-900">المميزات وال benefits</h2>
                    </div>
                    <div class="prose prose-lg max-w-none text-gray-700 leading-relaxed">
                        {!! nl2br(e($job->benefits)) !!}
                    </div>
                </div>
                @endif

                {{-- Sidebar --}}
            <div class="space-y-6">
                <!-- Job Summary Card -->
                <div class="bg-gradient-to-br from-white to-gray-50 rounded-2xl shadow-lg p-6 border border-gray-100">
                    <h3 class="text-xl font-bold text-gray-900 mb-6 flex items-center gap-2">
                        <i class="fas fa-info-circle text-blue-500"></i>
                        معلومات الوظيفة
                    </h3>

                    <div class="space-y-4">
                        <div class="flex justify-between items-center py-3 border-b border-gray-100">
                            <span class="text-gray-600 font-medium">الشركة</span>
                            <span class="text-gray-900 font-semibold">{{ optional($job->company)->name ?? $job->user->name }}</span>
                        </div>

                        <div class="flex justify-between items-center py-3 border-b border-gray-100">
                            <span class="text-gray-600 font-medium">القسم</span>
                            <span class="text-gray-900 font-semibold">{{ optional($job->category)->name ?? 'غير محدد' }}</span>
                        </div>

                        <div class="flex justify-between items-center py-3 border-b border-gray-100">
                            <span class="text-gray-600 font-medium">نوع الوظيفة</span>
                            <span class="text-gray-900 font-semibold">{{ $job->type_arabic }}</span>
                        </div>

                        <div class="flex justify-between items-center py-3 border-b border-gray-100">
                            <span class="text-gray-600 font-medium">الموقع</span>
                            <span class="text-gray-900 font-semibold">{{ $job->location }}</span>
                        </div>

                        @if($job->experience_level)
                        <div class="flex justify-between items-center py-3 border-b border-gray-100">
                            <span class="text-gray-600 font-medium">مستوى الخبرة</span>
                            <span class="text-gray-900 font-semibold">{{ $job->experience_level }}</span>
                        </div>
                        @endif

                        @if($job->salary_min || $job->salary_max)
                        <div class="flex justify-between items-center py-3 border-b border-gray-100">
                            <span class="text-gray-600 font-medium">الراتب</span>
                            <span class="text-gray-900 font-semibold text-green-600">
                                @if($job->salary_min && $job->salary_max)
                                    {{ number_format($job->salary_min) }} - {{ number_format($job->salary_max) }}
                                @elseif($job->salary_min)
                                    من {{ number_format($job->salary_min) }}
                                @else
                                    حتى {{ number_format($job->salary_max) }}
                                @endif
                                $
                            </span>
                        </div>
                        @endif

                        <div class="flex justify-between items-center py-3 border-b border-gray-100">
                            <span class="text-gray-600 font-medium">تاريخ النشر</span>
                            <span class="text-gray-900 font-semibold">{{ $job->created_at->format('Y-m-d') }}</span>
                        </div>

                        <div class="flex justify-between items-center py-3">
                            <span class="text-gray-600 font-medium">الحالة</span>
                            <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-semibold
                                {{ $job->is_active
                                    ? 'bg-green-100 text-green-700 border border-green-200'
                                    : 'bg-gray-100 text-gray-700 border border-gray-200' }}">
                                <i class="fas fa-{{ $job->is_active ? 'check' : 'pause' }} ml-2"></i>
                                {{ $job->is_active ? 'نشطة' : 'غير نشطة' }}
                            </span>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>
@endsection

@push('styles')
<style>
/* Professional Save Button Styles */
.save-job-btn {
    position: relative;
}

.prose h1, .prose h2, .prose h3 {
    color: #111827;
    font-weight: 600;
}

.prose p {
    margin-bottom: 1.25rem;
}

.prose ul, .prose ol {
    margin-bottom: 1.25rem;
    padding-left: 1.5rem;
}

.prose li {
    margin-bottom: 0.5rem;
}

/* Enhanced Particle Effects */
.particle-1, .particle-2, .particle-3, .particle-4, .particle-5 {
    position: absolute;
    width: 6px;
    height: 6px;
    background: linear-gradient(45deg, #fbbf24, #f59e0b, #f97316);
    border-radius: 50%;
    top: 50%;
    left: 50%;
    opacity: 0;
}

.particle-1 {
    animation: particleFloat 4s ease-out infinite;
    animation-delay: 0s;
}

.particle-2 {
    animation: particleFloat 4s ease-out infinite;
    animation-delay: 0.8s;
}

.particle-3 {
    animation: particleFloat 4s ease-out infinite;
    animation-delay: 1.6s;
}

.particle-4 {
    animation: particleFloat 4s ease-out infinite;
    animation-delay: 2.4s;
}

.particle-5 {
    animation: particleFloat 4s ease-out infinite;
    animation-delay: 3.2s;
}

@keyframes particleFloat {
    0% {
        transform: translate(-50%, -50%) scale(0);
        opacity: 1;
    }
    100% {
        transform: translate(calc(-50% + 40px), calc(-50% - 40px)) scale(1);
        opacity: 0;
    }
}

/* Enhanced Save Button Styles */
.save-job-btn {
    position: relative;
    transform-style: preserve-3d;
    transition: all 0.5s cubic-bezier(0.4, 0, 0.2, 1);
    z-index: 10;
    overflow: hidden;
}

.save-job-btn::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background: linear-gradient(45deg, transparent 30%, rgba(255, 255, 255, 0.1) 50%, transparent 70%, rgba(255, 255, 255, 0));
    border-radius: 2xl;
    opacity: 0;
    transition: opacity 0.5s ease;
}

.save-job-btn:hover::before {
    opacity: 1;
}

.save-job-btn:hover {
    transform: translateY(-4px);
    box-shadow: 0 25px 35px -8px rgba(0, 0, 0, 0.15), 0 15px 25px -5px rgba(0, 0, 0, 0.08);
}

.save-job-btn.saved svg {
    animation: heartBeat 1.5s ease-in-out infinite;
}

/* Loading State */
.save-job-btn.loading {
    opacity: 0.7;
    cursor: not-allowed;
    pointer-events: none;
}

/* Success Animation */
@keyframes successPulse {
    0% { transform: scale(1); }
    50% { transform: scale(1.08); }
    100% { transform: scale(1); }
}

.save-job-btn.success {
    animation: successPulse 0.8s ease-in-out;
}

/* Enhanced Tooltip Positioning */
.group:hover .group-hover\:opacity-100 {
    opacity: 1;
}

.group:hover .group-hover\:translate-y-0 {
    transform: translateY(0);
}

/* Background Pattern Animation */
@keyframes patternMove {
    0% { transform: translateX(0); }
    100% { transform: translateX(60px); }
}

.bg-pattern {
    animation: patternMove 20s linear infinite;
}
</style>
@endpush

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    const saveForm = document.getElementById('saveJobForm');
    if (saveForm) {
        saveForm.addEventListener('submit', function(e) {
            e.preventDefault();

            const btn = this.querySelector('.save-job-btn');
            const jobId = {{ $job->id }};
            const isCurrentlySaved = btn.classList.contains('saved');

            // Show loading state
            btn.classList.add('loading');
            btn.disabled = true;

            // Send AJAX request
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
                    btn.classList.remove('loading');
                    btn.classList.add('success');

                    if (isCurrentlySaved) {
                        // Unsave logic
                        btn.classList.remove('saved');
                        btn.querySelector('span').textContent = 'حفظ الوظيفة';
                        btn.querySelector('svg').setAttribute('fill', 'none');
                        showNotification('تم إلغاء حفظ الوظيفة', 'info');
                    } else {
                        // Save logic
                        btn.classList.add('saved');
                        btn.querySelector('span').textContent = 'محفوظة';
                        btn.querySelector('svg').setAttribute('fill', 'currentColor');
                        showNotification('تم حفظ الوظيفة بنجاح!', 'success', {
                            message: 'يمكنك الوصول لها من لوحة التحكم'
                        });
                    }

                    // Remove success animation after completion
                    setTimeout(() => btn.classList.remove('success'), 600);
                } else {
                    btn.classList.remove('loading');
                    showNotification(data.message || 'حدث خطأ ما', 'error');
                }
            })
            .catch(error => {
                console.error('Error:', error);
                btn.classList.remove('loading');
                showNotification('حدث خطأ في الاتصال بالسيرفر', 'error');
            })
            .finally(() => {
                btn.disabled = false;
            });
        });
    }
});

</script>
@endpush
