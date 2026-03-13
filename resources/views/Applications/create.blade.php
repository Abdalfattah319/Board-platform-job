@extends('layouts.app')

@section('content')
<div class="min-h-screen bg-gradient-to-br from-gray-50 via-white to-blue-50 py-8">
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
        
        <!-- Breadcrumb Navigation -->
        <nav class="flex mb-8" aria-label="breadcrumb">
            <ol class="flex items-center space-x-2 text-sm">
                <li>
                    <a href="{{ route('jobs.index') }}" class="text-gray-500 hover:text-gray-700 transition-colors">
                        <i class="fas fa-home"></i>
                        الوظائف
                    </a>
                </li>
                <li>
                    <span class="text-gray-400">/</span>
                </li>
                <li>
                    <a href="{{ route('jobs.show', $job) }}" class="text-gray-500 hover:text-gray-700 transition-colors">
                        {{ $job->title }}
                    </a>
                </li>
                <li>
                    <span class="text-gray-400">/</span>
                </li>
                <li class="text-gray-700 font-medium">
                    التقديم على الوظيفة
                </li>
            </ol>
        </nav>

        <!-- Job Information Card -->
        <div class="bg-white rounded-2xl shadow-xl overflow-hidden border border-gray-200 mb-8">
            <!-- Top Gradient Bar -->
            <div class="h-2 bg-gradient-to-r from-blue-600 via-indigo-600 to-purple-600"></div>
            
            <div class="p-8">
                <div class="flex items-start gap-6">
                    <!-- Company Logo -->
                    <div class="relative group">
                        <img src="{{ $job->company_logo ?? 'https://ui-avatars.com/api/?name=' . urlencode(optional($job->company)->name ?? $job->user->name) }}" 
                             alt="{{ optional($job->company)->name ?? $job->user->name }}" 
                             class="w-20 h-20 rounded-2xl object-cover border-4 border-white shadow-lg group-hover:scale-110 transition-transform duration-300">
                        
                        <!-- Status Indicator -->
                        @if($job->is_active)
                            <div class="absolute -bottom-2 -right-2 w-8 h-8 bg-gradient-to-r from-green-500 to-emerald-600 rounded-full border-4 border-white flex items-center justify-center shadow-lg animate-pulse">
                                <i class="fas fa-check text-white text-sm"></i>
                            </div>
                        @else
                            <div class="absolute -bottom-2 -right-2 w-8 h-8 bg-gradient-to-r from-gray-400 to-gray-600 rounded-full border-4 border-white flex items-center justify-center shadow-lg">
                                <i class="fas fa-pause text-white text-sm"></i>
                            </div>
                        @endif
                    </div>
                    
                    <div class="flex-1">
                        <h1 class="text-3xl font-bold text-gray-900 mb-3">
                            <a href="{{ route('jobs.show', $job) }}" 
                               class="hover:text-blue-600 transition-colors">
                                {{ $job->title }}
                            </a>
                        </h1>
                        
                        <div class="flex flex-wrap items-center gap-3 text-gray-600">
                            <span class="text-lg font-medium">{{ optional($job->company)->name ?? $job->user->name }}</span>
                            <span class="text-gray-400">•</span>
                            <span class="inline-flex items-center px-3 py-1 rounded-full bg-blue-50 text-blue-700 border border-blue-200">
                                <i class="fas fa-map-marker-alt ml-2"></i>
                                {{ $job->location }}
                            </span>
                            <span class="text-gray-400">/</span>
                            <span class="inline-flex items-center px-3 py-1 rounded-full bg-purple-50 text-purple-700 border border-purple-200">
                                <i class="fas fa-briefcase ml-2"></i>
                                {{ $job->type_arabic }}
                            </span>
                            
                            @if ($job->created_at > now()->subDays(7))
                                <span class="inline-flex items-center px-3 py-1 rounded-full bg-green-100 text-green-700 border border-green-200 text-sm font-bold animate-pulse">
                                    <i class="fas fa-star ml-2"></i>
                                    جديد
                                </span>
                            @endif
                        </div>
                    </div>
                </div>
                <p class="text-xs text-gray-500 mt-1">الحد الأقصى لحجم الملف: 2 ميجابايت</p>
            </div>

            <div class="flex items-center justify-between">
                <a href="{{ url()->previous() }}" 
                   class="bg-gray-200 text-gray-800 px-4 py-2 rounded-md hover:bg-gray-300">
                    رجوع
                </a>
                <button type="submit" 
                        class="bg-blue-600 text-white px-6 py-2 rounded-md hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                    تقديم الطلب
                </button>
            </div>
        </form>
    </div>
</div>

<!-- Application Form -->
<div class="bg-white rounded-2xl shadow-xl overflow-hidden border border-gray-200">
    <!-- Top Gradient Bar -->
    <div class="h-2 bg-gradient-to-r from-green-600 via-emerald-600 to-teal-600"></div>
    
    <div class="p-8">
        <div class="mb-8">
            <h2 class="text-2xl font-bold text-gray-900 mb-2 flex items-center gap-3">
                <i class="fas fa-paper-plane text-green-600"></i>
                التقديم على الوظيفة
            </h2>
            <p class="text-gray-600">املأ النموذج أدناه لتقديم طلبك على هذه الوظيفة</p>
        </div>

        <form action="{{ route('jobs.applications.store', $job) }}" method="POST" enctype="multipart/form-data" class="space-y-8">
            @csrf

            <!-- Personal Information -->
            <div class="bg-gradient-to-br from-blue-50 to-indigo-50 rounded-2xl p-6 border border-blue-200">
                <h3 class="text-xl font-semibold text-gray-900 mb-6 flex items-center gap-2">
                    <i class="fas fa-user text-blue-600"></i>
                    المعلومات الشخصية
                </h3>
                
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label for="name" class="block text-sm font-medium text-gray-700 mb-2">
                            الاسم الكامل <span class="text-red-500">*</span>
                        </label>
                        <input type="text" 
                               id="name" 
                               name="name" 
                               value="{{ auth()->user()->name ?? '' }}"
                               required
                               class="w-full px-4 py-3 rounded-xl border-2 border-gray-200 focus:border-blue-500 focus:ring-2 focus:ring-blue-200 transition-all duration-300">
                    </div>
                    
                    <div>
                        <label for="email" class="block text-sm font-medium text-gray-700 mb-2">
                            البريد الإلكتروني <span class="text-red-500">*</span>
                        </label>
                        <input type="email" 
                               id="email" 
                               name="email" 
                               value="{{ auth()->user()->email ?? '' }}"
                               required
                               class="w-full px-4 py-3 rounded-xl border-2 border-gray-200 focus:border-blue-500 focus:ring-2 focus:ring-blue-200 transition-all duration-300">
                    </div>
                    
                    <div>
                        <label for="phone" class="block text-sm font-medium text-gray-700 mb-2">
                            رقم الهاتف <span class="text-red-500">*</span>
                        </label>
                        <input type="tel" 
                               id="phone" 
                               name="phone" 
                               value="{{ old('phone') ?? '' }}"
                               required
                               class="w-full px-4 py-3 rounded-xl border-2 border-gray-200 focus:border-blue-500 focus:ring-2 focus:ring-blue-200 transition-all duration-300">
                    </div>
                    
                    <div>
                        <label for="expected_salary" class="block text-sm font-medium text-gray-700 mb-2">
                            الراتب المتوقع ($)
                        </label>
                        <input type="number" 
                               id="expected_salary" 
                               name="expected_salary" 
                               value="{{ old('expected_salary') ?? '' }}"
                               min="0"
                               step="1000"
                               class="w-full px-4 py-3 rounded-xl border-2 border-gray-200 focus:border-blue-500 focus:ring-2 focus:ring-blue-200 transition-all duration-300">
                    </div>
                </div>
            </div>

            <!-- Cover Letter -->
            <div class="bg-gradient-to-br from-purple-50 to-pink-50 rounded-2xl p-6 border border-purple-200">
                <h3 class="text-xl font-semibold text-gray-900 mb-6 flex items-center gap-2">
                    <i class="fas fa-envelope text-purple-600"></i>
                    رسالة التقديم
                </h3>
                
                <div class="mb-4">
                    <label for="cover_letter" class="block text-sm font-medium text-gray-700 mb-2">
                        رسالة التقديم <span class="text-red-500">*</span>
                    </label>
                    <textarea id="cover_letter" 
                              name="cover_letter" 
                              rows="8" 
                              required
                              placeholder="اكتب رسالة تقديم قصيرة تشرح فيها لماذا أنت مناسب لهذه الوظيفة..."
                              class="w-full px-4 py-3 rounded-xl border-2 border-gray-200 focus:border-purple-500 focus:ring-2 focus:ring-purple-200 transition-all duration-300 resize-none">{{ old('cover_letter') ?? '' }}</textarea>
                    @error('cover_letter')
                        <p class="text-red-500 text-sm mt-2">{{ $message }}</p>
                    @enderror
                </div>
                
                <div class="text-sm text-gray-600">
                    <i class="fas fa-info-circle ml-2"></i>
                    اكتب رسالة قصيرة ومقنعة تشرح فيها مؤهلاتك وخبراتك وتوضح لماذا أنت مناسب لهذه الوظيفة
                </div>
            </div>

            <!-- Resume Upload -->
            <div class="bg-gradient-to-br from-green-50 to-emerald-50 rounded-2xl p-6 border border-green-200">
                <h3 class="text-xl font-semibold text-gray-900 mb-6 flex items-center gap-2">
                    <i class="fas fa-file-alt text-green-600"></i>
                    السيرة الذاتية
                </h3>
                
                <div class="mb-4">
                    <label for="resume" class="block text-sm font-medium text-gray-700 mb-2">
                        رفع السيرة الذاتية <span class="text-red-500">*</span>
                    </label>
                    <div class="relative">
                        <input type="file" 
                               id="resume" 
                               name="resume" 
                               accept=".pdf,.doc,.docx"
                               required
                               class="w-full px-4 py-3 rounded-xl border-2 border-gray-200 focus:border-green-500 focus:ring-2 focus:ring-green-200 transition-all duration-300 file:mr-4 file:py-2 file:px-4 file:rounded-xl file:border-0 file:text-sm file:font-semibold file:bg-green-50 file:text-green-700 hover:file:bg-green-100">
                        @error('resume')
                            <p class="text-red-500 text-sm mt-2">{{ $message }}</p>
                        @enderror
                    </div>
                </div>
                
                <div class="text-sm text-gray-600">
                    <i class="fas fa-info-circle ml-2"></i>
                    الصيغ المسموح بها: PDF, DOC, DOCX (الحد الأقصى: 5MB)
                </div>
            </div>

            <!-- Submit Buttons -->
            <div class="flex flex-col sm:flex-row gap-4">
                <button type="submit" 
                        class="flex-1 inline-flex items-center justify-center px-8 py-4 bg-gradient-to-r from-green-600 via-emerald-600 to-teal-600 text-white font-bold rounded-2xl hover:from-green-700 hover:via-emerald-700 hover:to-teal-700 transition-all duration-300 hover:shadow-2xl hover:scale-105">
                    <i class="fas fa-paper-plane ml-3"></i>
                    إرسال الطلب
                </button>
                
                <a href="{{ route('jobs.show', $job) }}" 
                   class="inline-flex items-center justify-center px-8 py-4 bg-gray-200 text-gray-700 font-bold rounded-2xl hover:bg-gray-300 transition-all duration-300 hover:shadow-lg hover:scale-105">
                    <i class="fas fa-times ml-3"></i>
                    إلغاء
                </a>
            </div>
        </form>
    </div>
</div>
</div>
</div>

<!-- Professional Styles -->
@push('styles')
<style>
/* Application Form Styles */
.form-input {
    transition: all 0.3s ease;
}

.form-input:focus {
    transform: translateY(-2px);
    box-shadow: 0 10px 25px -5px rgba(0, 0, 0, 0.1);
}

.file-input {
    position: relative;
}

.file-input::file-selector-button {
    background: linear-gradient(135deg, #10b981 0%, #059669 100%);
    color: white;
    border: none;
    padding: 8px 16px;
    border-radius: 8px;
    font-weight: 600;
    cursor: pointer;
    transition: all 0.3s ease;
}

.file-input::file-selector-button:hover {
    background: linear-gradient(135deg, #059669 0%, #047857 100%);
    transform: translateY(-2px);
}

/* Card Hover Effects */
.application-card {
    transition: all 0.5s cubic-bezier(0.4, 0, 0.2, 1);
}

.application-card:hover {
    transform: translateY(-4px);
    box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.1), 0 10px 15px -5px rgba(0, 0, 0, 0.08);
}

/* Button Styles */
.btn-primary {
    background: linear-gradient(135deg, #10b981 0%, #059669 100%);
    transition: all 0.3s ease;
}

.btn-primary:hover {
    background: linear-gradient(135deg, #059669 0%, #047857 100%);
    transform: translateY(-2px);
    box-shadow: 0 10px 25px -5px rgba(0, 0, 0, 0.15);
}

.btn-secondary {
    transition: all 0.3s ease;
}

.btn-secondary:hover {
    transform: translateY(-2px);
    box-shadow: 0 10px 25px -5px rgba(0, 0, 0, 0.1);
}

/* Checkbox Styles */
.form-checkbox {
    transition: all 0.3s ease;
}

.form-checkbox:checked {
    background-color: #3b82f6;
    border-color: #3b82f6;
}

/* Section Headers */
.section-header {
    position: relative;
    overflow: hidden;
}

.section-header::after {
    content: '';
    position: absolute;
    bottom: 0;
    left: 0;
    width: 100%;
    height: 2px;
    background: linear-gradient(90deg, transparent, currentColor, transparent);
    animation: shimmer 2s infinite;
}

@keyframes shimmer {
    0% { transform: translateX(-100%); }
    100% { transform: translateX(100%); }
}

/* Loading State */
.loading {
    position: relative;
    pointer-events: none;
    opacity: 0.7;
}

.loading::after {
    content: '';
    position: absolute;
    top: 50%;
    left: 50%;
    width: 20px;
    height: 20px;
    margin: -10px 0 0 -10px;
    border: 2px solid #f3f4f6;
    border-top: 2px solid #3b82f6;
    border-radius: 50%;
    animation: spin 1s linear infinite;
}

@keyframes spin {
    0% { transform: rotate(0deg); }
    100% { transform: rotate(360deg); }
}
</style>
@endpush

<!-- Professional JavaScript -->
@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    const form = document.querySelector('form');
    const submitBtn = form.querySelector('button[type="submit"]');
    const fileInput = document.getElementById('resume');
    const maxSize = 5 * 1024 * 1024; // 5MB
    
    // File validation
    fileInput.addEventListener('change', function(e) {
        const file = e.target.files[0];
        
        if (file) {
            // Check file size
            if (file.size > maxSize) {
                alert('حجم الملف كبير جداً. الحد الأقصى هو 5MB');
                e.target.value = '';
                return;
            }
            
            // Check file type
            const allowedTypes = ['application/pdf', 'application/msword', 'application/vnd.openxmlformats-officedocument.wordprocessingml.document'];
            if (!allowedTypes.includes(file.type)) {
                alert('نوع الملف غير مدعوم. الرجاء رفع ملف PDF أو Word');
                e.target.value = '';
                return;
            }
            
            // Show file info
            const fileInfo = document.createElement('div');
            fileInfo.className = 'mt-2 text-sm text-green-600';
            fileInfo.innerHTML = `<i class="fas fa-check-circle ml-2"></i>تم اختيار: ${file.name} (${(file.size / 1024 / 1024).toFixed(2)} MB)`;
            
            // Remove previous file info
            const prevInfo = fileInput.parentElement.querySelector('.text-green-600');
            if (prevInfo) {
                prevInfo.remove();
            }
            
            fileInput.parentElement.appendChild(fileInfo);
        }
    });
    
    // Form submission
    form.addEventListener('submit', function(e) {
        // Show loading state
        submitBtn.disabled = true;
        submitBtn.innerHTML = '<i class="fas fa-spinner fa-spin ml-3"></i> جاري الإرسال...';
        submitBtn.classList.add('loading');
        
        // Simulate form submission (remove this in production)
        setTimeout(() => {
            // Remove loading state
            submitBtn.disabled = false;
            submitBtn.innerHTML = '<i class="fas fa-paper-plane ml-3"></i> إرسال الطلب';
            submitBtn.classList.remove('loading');
        }, 2000);
    });
    
    // Character counter for cover letter
    const coverLetter = document.getElementById('cover_letter');
    const maxLength = 1000;
    
    if (coverLetter) {
        const counter = document.createElement('div');
        counter.className = 'mt-2 text-sm text-gray-600 text-left';
        counter.innerHTML = `<span id="char-count">0</span> / ${maxLength} حرف`;
        coverLetter.parentElement.appendChild(counter);
        
        coverLetter.addEventListener('input', function() {
            const currentLength = this.value.length;
            document.getElementById('char-count').textContent = currentLength;
            
            if (currentLength > maxLength) {
                this.value = this.value.substring(0, maxLength);
                document.getElementById('char-count').textContent = maxLength;
            }
            
            // Change color based on length
            const counterElement = document.getElementById('char-count').parentElement;
            if (currentLength > maxLength * 0.9) {
                counterElement.className = 'mt-2 text-sm text-red-600 text-left';
            } else if (currentLength > maxLength * 0.7) {
                counterElement.className = 'mt-2 text-sm text-yellow-600 text-left';
            } else {
                counterElement.className = 'mt-2 text-sm text-gray-600 text-left';
            }
        });
    }
});
</script>
@endpush
@endsection