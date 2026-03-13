@extends('layouts.app')

@section('content')
<div class="min-h-screen bg-gradient-to-br from-gray-50 via-white to-blue-50">
    <!-- Header احترافي -->
    <div class="bg-white border-b border-gray-200 sticky top-0 z-40 backdrop-blur-lg bg-opacity-90">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-6">
            <div class="flex items-center justify-between">
                <div>
                    <h1 class="text-4xl font-bold bg-gradient-to-r from-blue-600 to-indigo-600 bg-clip-text text-transparent">
                        الوظائف المحفوظة
                    </h1>
                    <p class="text-gray-600 mt-2 flex items-center gap-2">
                        <i class="fas fa-bookmark text-blue-500"></i>
                        <span>{{ $savedJobs->count() }} وظيفة محفوظة</span>
                        @if($savedJobs->count() > 0)
                            <span class="text-sm text-gray-400">• آخر تحديث: {{ now()->format('H:i') }}</span>
                        @endif
                    </p>
                </div>
                
                <!-- Advanced Search & Filter -->
                <div class="flex items-center gap-4">
                    <div class="relative">
                        <input type="text" 
                               id="searchSavedJobs"
                               placeholder="بحث في الوظائف المحفوظة..." 
                               class="w-64 pl-10 pr-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                        <i class="fas fa-search absolute left-3 top-3 text-gray-400"></i>
                    </div>
                    
                    <button onclick="toggleFilters()" 
                            class="p-2 bg-gray-100 rounded-lg hover:bg-gray-200 transition-colors">
                        <i class="fas fa-filter"></i>
                    </button>
                    
                    <button onclick="exportSavedJobs()" 
                            class="p-2 bg-blue-100 text-blue-600 rounded-lg hover:bg-blue-200 transition-colors">
                        <i class="fas fa-download"></i>
                    </button>
                </div>
            </div>
            
            <!-- Advanced Filters Panel -->
            <div id="filtersPanel" class="hidden mt-4 p-4 bg-gray-50 rounded-lg">
                <div class="grid grid-cols-4 gap-4">
                    <select class="filter-select">
                        <option>كل الأنواع</option>
                        <option>دوام كامل</option>
                        <option>دوام جزئي</option>
                        <option>عمل عن بعد</option>
                    </select>
                    <select class="filter-select">
                        <option>كل المواقع</option>
                        <option>الرياض</option>
                        <option>جدة</option>
                        <option>الدمام</option>
                    </select>
                    <input type="text" placeholder="الراتب الأدنى" class="filter-input">
                    <button class="bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700">
                        تطبيق الفلاتر
                    </button>
                </div>
            </div>
        </div>
    </div>

    <!-- Main Content -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        @if($savedJobs->count() > 0)
            <!-- Stats Cards -->
            <div class="grid grid-cols-4 gap-6 mb-8">
                <div class="bg-white rounded-xl shadow-sm p-6 border border-gray-100">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-sm text-gray-600">إجمالي المحفوظ</p>
                            <p class="text-2xl font-bold text-gray-900">{{ $savedJobs->count() }}</p>
                        </div>
                        <div class="bg-blue-100 p-3 rounded-lg">
                            <i class="fas fa-bookmark text-blue-600"></i>
                        </div>
                    </div>
                </div>
                
                <div class="bg-white rounded-xl shadow-sm p-6 border border-gray-100">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-sm text-gray-600">هذا الأسبوع</p>
                            <p class="text-2xl font-bold text-green-600">3</p>
                        </div>
                        <div class="bg-green-100 p-3 rounded-lg">
                            <i class="fas fa-calendar-week text-green-600"></i>
                        </div>
                    </div>
                </div>
                
                <div class="bg-white rounded-xl shadow-sm p-6 border border-gray-100">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-sm text-gray-600">الشركات</p>
                            <p class="text-2xl font-bold text-purple-600">8</p>
                        </div>
                        <div class="bg-purple-100 p-3 rounded-lg">
                            <i class="fas fa-building text-purple-600"></i>
                        </div>
                    </div>
                </div>
                
                <div class="bg-white rounded-xl shadow-sm p-6 border border-gray-100">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-sm text-gray-600">متوسط الراتب</p>
                            <p class="text-2xl font-bold text-orange-600">15K</p>
                        </div>
                        <div class="bg-orange-100 p-3 rounded-lg">
                            <i class="fas fa-money-bill text-orange-600"></i>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Jobs Grid with Advanced Cards -->
            <div class="grid gap-6 lg:grid-cols-2" id="savedJobsGrid">
                @foreach($savedJobs as $savedJob)
                    <div class="group relative bg-white rounded-2xl shadow-lg hover:shadow-2xl transition-all duration-500 overflow-hidden border border-gray-100 hover:border-blue-200">
                        <!-- Animated Background Gradient -->
                        <div class="absolute inset-0 bg-gradient-to-br from-blue-50 via-transparent to-indigo-50 opacity-0 group-hover:opacity-100 transition-opacity duration-500"></div>
                        
                        <!-- Top Bar -->
                        <div class="relative h-1 bg-gradient-to-r from-blue-500 via-indigo-500 to-purple-500"></div>
                        
                        <!-- Content -->
                        <div class="relative p-6">
                            <!-- Header Section -->
                            <div class="flex items-start justify-between mb-4">
                                <div class="flex items-center gap-4">
                                    <!-- Company Logo with Animation -->
                                    <div class="relative">
                                        <img src="{{ asset('images/default-company.png') }}" 
                                             alt="{{ optional($savedJob->job->company)->name ?? 'غير محدد' }}" 
                                             class="w-14 h-14 rounded-xl object-cover border-2 border-white shadow-lg group-hover:scale-110 transition-transform duration-300">
                                        <div class="absolute -bottom-1 -right-1 w-4 h-4 bg-green-500 rounded-full border-2 border-white"></div>
                                    </div>
                                    
                                    <div>
                                        <h3 class="text-xl font-bold text-gray-900 group-hover:text-blue-600 transition-colors">
                                            <a href="{{ route('jobs.show', $savedJob->job->id) }}" 
                                               class="hover:underline">
                                                {{ $savedJob->job->title }}
                                            </a>
                                        </h3>
                                        <p class="text-gray-600 font-medium">{{ optional($savedJob->job->company)->name ?? 'غير محدد' }}</p>
                                    </div>
                                </div>
                                
                                <!-- Save Button with Heart Animation -->
                                <button onclick="unsaveJob({{ $savedJob->id }}, {{ $savedJob->job_id }})" 
                                        id="unsave-btn-{{ $savedJob->id }}"
                                        class="group/btn relative p-2 bg-red-50 rounded-xl hover:bg-red-100 transition-all duration-300 hover:scale-110"
                                        style="margin-left:25px;margin-top:12px">
                                    <i class="fas fa-heart text-red-500 group-hover/btn:scale-125 transition-transform"></i>
                                    <span class="absolute -top-8 right-0 bg-gray-800 text-white text-xs px-2 py-1 rounded opacity-0 group-hover/btn:opacity-100 transition-opacity whitespace-nowrap">
                                        إلغاء الحفظ
                                    </span>
                                </button>
                            </div>
                            
                            <!-- Job Details -->
                            <div class="space-y-3 mb-4">
                                <!-- Location & Type -->
                                <div class="flex flex-wrap gap-2">
                                    <span class="inline-flex items-center px-3 py-1 rounded-full text-sm bg-blue-50 text-blue-700 border border-blue-200">
                                        <i class="fas fa-map-marker-alt ml-2"></i>
                                        {{ $savedJob->job->location ?? 'الرياض' }}
                                    </span>
                                    <span class="inline-flex items-center px-3 py-1 rounded-full text-sm bg-purple-50 text-purple-700 border border-purple-200">
                                        <i class="fas fa-briefcase ml-2"></i>
                                        {{ $savedJob->job->type ?? 'دوام كامل' }}
                                    </span>
                                    <span class="inline-flex items-center px-3 py-1 rounded-full text-sm bg-green-50 text-green-700 border border-green-200">
                                        <i class="fas fa-chart-line ml-2"></i>
                                        متوسط الخبرة
                                    </span>
                                </div>
                                
                                <!-- Salary -->
                                <div class="flex items-center gap-2 text-green-600 font-semibold">
                                    <i class="fas fa-money-bill-wave"></i>
                                    <span>{{ $savedJob->job->salary ?? 'غير محدد' }}</span>
                                </div>
                                
                                <!-- Description Snippet -->
                                <p class="text-gray-600 text-sm line-clamp-2">
                                    وظيفة مميزة في شركة رائعة تتطلب مهارات عالية وتوفر بيئة عمل ممتازة...
                                </p>
                            </div>
                            
                            <!-- Footer Section -->
                            <div class="flex items-center justify-between pt-4 border-t border-gray-100">
                                <!-- Save Date -->
                                <div class="flex items-center gap-2 text-xs text-gray-500">
                                    <i class="fas fa-clock"></i>
                                    <span>تم الحفظ {{ $savedJob->created_at->diffForHumans() }}</span>
                                </div>
                                
                                <!-- Action Buttons -->
                                <div class="flex gap-2">
                                    <a href="{{ route('jobs.show', $savedJob->job) }}" 
                                       class="px-4 py-2 bg-gradient-to-r from-blue-600 to-indigo-600 text-white rounded-lg hover:from-blue-700 hover:to-indigo-700 transition-all duration-300 hover:shadow-lg hover:scale-105">
                                        <i class="fas fa-eye ml-2"></i>
                                        عرض
                                    </a>
                                    
                                    <a href="{{ route('jobs.applications.create',$savedJob->job) }}" 
                                       class="px-4 py-2 bg-gradient-to-r from-green-600 to-emerald-600 text-white rounded-lg hover:from-green-700 hover:to-emerald-700 transition-all duration-300 hover:shadow-lg hover:scale-105">
                                        <i class="fas fa-paper-plane ml-2"></i>
                                        تقديم
                                    </a>
                                </div>
                            </div>
                        </div>
                        
                        <!-- Hover Effect Overlay -->
                        <div class="absolute inset-0 bg-gradient-to-t from-blue-600/10 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-500 pointer-events-none"></div>
                    </div>
                @endforeach
            </div>
            
            <!-- Advanced Pagination -->
            <div class="mt-12 flex justify-center">
                <div class="bg-white rounded-xl shadow-sm p-4 border border-gray-100">
                    {{ $savedJobs->links('pagination::tailwind') }}
                </div>
            </div>
        @else
            <!-- Empty State with Animation -->
            <div class="text-center py-20">
                <div class="relative inline-block">
                    <div class="absolute inset-0 bg-blue-100 rounded-full blur-3xl opacity-50 animate-pulse"></div>
                    <i class="fas fa-bookmark text-8xl text-blue-500 relative animate-bounce"></i>
                </div>
                
                <h3 class="text-3xl font-bold text-gray-900 mt-8 mb-4">
                    لا توجد وظائف محفوظة بعد
                </h3>
                <p class="text-xl text-gray-600 mb-8 max-w-2xl mx-auto">
                    ابدأ رحلتك في البحث عن وظيفة أحلامك واحفظ الوظائف التي تهمك للعودة إليها لاحقاً
                </p>
                
                <div class="flex gap-4 justify-center">
                    <a href="{{ route('jobs.index') }}" 
                       class="group px-8 py-3 bg-gradient-to-r from-blue-600 to-indigo-600 text-white rounded-xl hover:from-blue-700 hover:to-indigo-700 transition-all duration-300 hover:shadow-xl hover:scale-105">
                        <i class="fas fa-search ml-2 group-hover:animate-pulse"></i>
                        استكشاف الوظائف
                    </a>
                    
                    <button onclick="showTutorial()" 
                            class="px-8 py-3 bg-gray-100 text-gray-700 rounded-xl hover:bg-gray-200 transition-all duration-300">
                        <i class="fas fa-question-circle ml-2"></i>
                        كيف تعمل؟
                    </button>
                </div>
            </div>
        @endif
    </div>
</div>

<!-- Advanced Styles -->
<style>
.filter-select, .filter-input {
    @apply w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent;
}

.line-clamp-2 {
    display: -webkit-box;
    -webkit-line-clamp: 2;
    -webkit-box-orient: vertical;
    overflow: hidden;
}

/* Custom Animations */
@keyframes float {
    0%, 100% { transform: translateY(0px); }
    50% { transform: translateY(-10px); }
}

.animate-float {
    animation: float 3s ease-in-out infinite;
}
</style>

<!-- Advanced JavaScript -->
<script>
// Search functionality
document.getElementById('searchSavedJobs')?.addEventListener('input', function(e) {
    const searchTerm = e.target.value.toLowerCase();
    const cards = document.querySelectorAll('#savedJobsGrid > div');
    
    cards.forEach(card => {
        const text = card.textContent.toLowerCase();
        card.style.display = text.includes(searchTerm) ? 'block' : 'none';
    });
});

// Toggle filters
function toggleFilters() {
    const panel = document.getElementById('filtersPanel');
    panel.classList.toggle('hidden');
}

// Export functionality
function exportSavedJobs() {
    console.log('Exporting saved jobs...');
}

// Tutorial
function showTutorial() {
    console.log('Showing tutorial...');
}

// Unsave job function
function unsaveJob(savedJobId, jobId) {
    const btn = document.getElementById(`unsave-btn-${savedJobId}`);
    const card = btn.closest('.bg-white');
    
    // Add loading state
    btn.disabled = true;
    btn.classList.add('opacity-75', 'cursor-not-allowed');
    btn.innerHTML = '<i class="fas fa-spinner fa-spin text-red-500"></i>';
    
    // Send AJAX request
    fetch(`/saved-jobs/${savedJobId}`, {
        method: 'DELETE',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
        }
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            // Show success message
            showNotification('تم إلغاء حفظ الوظيفة بنجاح', 'info');
            
            // Animate card removal
            card.style.transition = 'all 0.3s ease-out';
            card.style.transform = 'translateX(100%)';
            card.style.opacity = '0';
            
            // Remove card after animation
            setTimeout(() => {
                card.remove();
                
                // Check if no more jobs
                const remainingCards = document.querySelectorAll('.bg-white');
                if (remainingCards.length === 0) {
                    location.reload(); // Reload to show empty state
                }
            }, 300);
        } else {
            showNotification(data.message || 'فشل إلغاء حفظ الوظيفة', 'error');
        }
    })
    .catch(error => {
        console.error('Error:', error);
        showNotification('حدث خطأ في الاتصال بالسيرفر', 'error');
    })
    .finally(() => {
        // Restore button if card wasn't removed
        if (document.getElementById(`unsave-btn-${savedJobId}`)) {
            btn.disabled = false;
            btn.classList.remove('opacity-75', 'cursor-not-allowed');
            btn.innerHTML = '<i class="fas fa-heart text-red-500 group-hover/btn:scale-125 transition-transform"></i>';
        }
    });
}

// Show notification function (same as jobs/index)
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
</script>
@endsection
