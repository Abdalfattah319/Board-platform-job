@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-6">
    <!-- Header -->
    <div class="mb-6">
        <div class="bg-gradient-to-r from-blue-600 to-purple-600 rounded-xl shadow-lg overflow-hidden">
            <div class="p-6 text-white">
                <div class="flex flex-col md:flex-row items-center justify-between">
                    <div class="mb-4 md:mb-0">
                        <h3 class="text-2xl font-bold mb-2 flex items-center">
                            <i class="fas fa-file-alt ml-2"></i>
                            تفاصيل التقديم
                        </h3>
                        <p class="opacity-90">عرض وتقييم طلب المتقدم للوظيفة</p>
                    </div>
                    <div class="flex space-x-2 space-x-reverse">
                        <a href="{{ route('jobs.applications.index', $application->job) }}" class="bg-white bg-opacity-20 text-white px-4 py-2 rounded-lg font-medium hover:bg-opacity-30 transition-all duration-200 inline-flex items-center">
                            <i class="fas fa-arrow-right ml-2"></i>
                            العودة للتقديمات
                        </a>
                        <a href="{{ route('jobs.show', $application->job) }}" class="bg-white text-blue-600 px-4 py-2 rounded-lg font-medium hover:bg-gray-100 transition-colors duration-200 inline-flex items-center">
                            <i class="fas fa-briefcase ml-2"></i>
                            الوظيفة
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Application Details -->
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        <!-- Applicant Info -->
        <div class="lg:col-span-2 space-y-6">
            <!-- Applicant Card -->
            <div class="bg-white rounded-xl shadow-md overflow-hidden">
                <div class="border-b border-gray-200 px-6 py-4">
                    <h5 class="text-lg font-semibold text-gray-800 flex items-center">
                        <i class="fas fa-user ml-2 text-blue-600"></i>
                        معلومات المتقدم
                    </h5>
                </div>
                <div class="p-6">
                    <div class="flex items-start space-x-4 space-x-reverse">
                        <div class="bg-blue-500 text-white rounded-full w-16 h-16 flex items-center justify-center font-bold text-xl flex-shrink-0">
                            {{ substr($application->user->name, 0, 1) }}
                        </div>
                        <div class="flex-grow">
                            <h4 class="text-xl font-semibold text-gray-900 mb-1">{{ $application->user->name }}</h4>
                            <p class="text-gray-600 mb-2">{{ $application->user->email }}</p>
                            <div class="flex flex-wrap gap-2">
                                <span class="px-3 py-1 text-xs font-medium bg-blue-100 text-blue-800 rounded-full">
                                    <i class="fas fa-envelope ml-1"></i>
                                    {{ $application->user->email }}
                                </span>
                                @if($application->user->phone)
                                    <span class="px-3 py-1 text-xs font-medium bg-green-100 text-green-800 rounded-full">
                                        <i class="fas fa-phone ml-1"></i>
                                        {{ $application->user->phone }}
                                    </span>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Job Info Card -->
            <div class="bg-white rounded-xl shadow-md overflow-hidden">
                <div class="border-b border-gray-200 px-6 py-4">
                    <h5 class="text-lg font-semibold text-gray-800 flex items-center">
                        <i class="fas fa-briefcase ml-2 text-purple-600"></i>
                        معلومات الوظيفة
                    </h5>
                </div>
                <div class="p-6">
                    <div class="space-y-4">
                        <div>
                            <h4 class="text-xl font-semibold text-gray-900 mb-2">{{ $application->job->title }}</h4>
                            <p class="text-gray-600">{{ $application->job->description }}</p>
                        </div>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div>
                                <span class="text-sm text-gray-500">الشركة:</span>
                                <p class="font-medium">{{ $application->job->company ? $application->job->company->name : 'غير محدد' }}</p>
                            </div>
                            <div>
                                <span class="text-sm text-gray-500">نوع الوظيفة:</span>
                                <p class="font-medium">{{ $application->job->job_type ?? 'غير محدد' }}</p>
                            </div>
                            <div>
                                <span class="text-sm text-gray-500">الموقع:</span>
                                <p class="font-medium">{{ $application->job->location ?? 'غير محدد' }}</p>
                            </div>
                            <div>
                                <span class="text-sm text-gray-500">الراتب:</span>
                                <p class="font-medium">{{ $application->job->salary ?? 'غير محدد' }}</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Application Files -->
            <div class="bg-white rounded-xl shadow-md overflow-hidden">
                <div class="border-b border-gray-200 px-6 py-4">
                    <h5 class="text-lg font-semibold text-gray-800 flex items-center">
                        <i class="fas fa-paperclip ml-2 text-green-600"></i>
                        ملفات التقديم
                    </h5>
                </div>
                <div class="p-6">
                    <div class="space-y-4">
                        <!-- Resume File -->
                        @if($application->resume)
                            <div class="border border-gray-200 rounded-lg p-4 hover:bg-gray-50 transition-colors">
                                <div class="flex items-center justify-between">
                                    <div class="flex items-center space-x-3 space-x-reverse">
                                        <div class="bg-red-100 text-red-600 p-3 rounded-lg">
                                            <i class="fas fa-file-pdf text-2xl"></i>
                                        </div>
                                        <div>
                                            <h6 class="font-medium text-gray-900">السيرة الذاتية</h6>
                                            <p class="text-sm text-gray-500">ملف PDF</p>
                                        </div>
                                    </div>
                                    <div class="flex space-x-2 space-x-reverse">
                                        <a href="{{ asset('storage/' . $application->resume) }}" 
                                           target="_blank" 
                                           class="bg-blue-100 text-blue-600 px-3 py-2 rounded-lg hover:bg-blue-200 transition-colors duration-200 inline-flex items-center text-sm">
                                            <i class="fas fa-eye ml-2"></i>
                                            عرض
                                        </a>
                                        <a href="{{ asset('storage/' . $application->resume) }}" 
                                           download 
                                           class="bg-green-100 text-green-600 px-3 py-2 rounded-lg hover:bg-green-200 transition-colors duration-200 inline-flex items-center text-sm">
                                            <i class="fas fa-download ml-2"></i>
                                            تحميل
                                        </a>
                                    </div>
                                </div>
                            </div>
                        @else
                            <div class="bg-gray-50 border border-gray-200 rounded-lg p-4 text-center">
                                <i class="fas fa-file-pdf text-3xl text-gray-400 mb-2"></i>
                                <p class="text-gray-500">لا توجد سيرة ذاتية مرفقة</p>
                            </div>
                        @endif

                        <!-- Cover Letter -->
                        @if($application->cover_letter)
                            <div class="border border-gray-200 rounded-lg p-4 hover:bg-gray-50 transition-colors">
                                <div class="flex items-center justify-between">
                                    <div class="flex items-center space-x-3 space-x-reverse">
                                        <div class="bg-blue-100 text-blue-600 p-3 rounded-lg">
                                            <i class="fas fa-file-alt text-2xl"></i>
                                        </div>
                                        <div>
                                            <h6 class="font-medium text-gray-900">رسالة تعريفية</h6>
                                            <p class="text-sm text-gray-500">ملف نصي</p>
                                        </div>
                                    </div>
                                    <div class="flex space-x-2 space-x-reverse">
                                        <a href="{{ asset('storage/' . $application->cover_letter) }}" 
                                           target="_blank" 
                                           class="bg-blue-100 text-blue-600 px-3 py-2 rounded-lg hover:bg-blue-200 transition-colors duration-200 inline-flex items-center text-sm">
                                            <i class="fas fa-eye ml-2"></i>
                                            عرض
                                        </a>
                                        <a href="{{ asset('storage/' . $application->cover_letter) }}" 
                                           download 
                                           class="bg-green-100 text-green-600 px-3 py-2 rounded-lg hover:bg-green-200 transition-colors duration-200 inline-flex items-center text-sm">
                                            <i class="fas fa-download ml-2"></i>
                                            تحميل
                                        </a>
                                    </div>
                                </div>
                            </div>
                        @else
                            <div class="bg-gray-50 border border-gray-200 rounded-lg p-4 text-center">
                                <i class="fas fa-file-alt text-3xl text-gray-400 mb-2"></i>
                                <p class="text-gray-500">لا توجد رسالة تعريفية مرفقة</p>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>

        <!-- Sidebar -->
        <div class="space-y-6">
            <!-- Status Card -->
            <div class="bg-white rounded-xl shadow-md overflow-hidden">
                <div class="border-b border-gray-200 px-6 py-4">
                    <h5 class="text-lg font-semibold text-gray-800 flex items-center">
                        <i class="fas fa-info-circle ml-2 text-indigo-600"></i>
                        حالة التقديم
                    </h5>
                </div>
                <div class="p-6">
                    <div class="text-center mb-4">
                        @if($application->status == 'applied')
                            <div class="bg-yellow-100 text-yellow-800 px-4 py-3 rounded-full inline-flex items-center">
                                <i class="fas fa-paper-plane ml-2"></i>
                                متقدم
                            </div>
                        @elseif($application->status == 'under_review')
                            <div class="bg-cyan-100 text-cyan-800 px-4 py-3 rounded-full inline-flex items-center">
                                <i class="fas fa-eye ml-2"></i>
                                قيد المراجعة
                            </div>
                        @elseif($application->status == 'shortlisted')
                            <div class="bg-purple-100 text-purple-800 px-4 py-3 rounded-full inline-flex items-center">
                                <i class="fas fa-star ml-2"></i>
                                مختار
                            </div>
                        @elseif($application->status == 'hired')
                            <div class="bg-green-100 text-green-800 px-4 py-3 rounded-full inline-flex items-center">
                                <i class="fas fa-check-circle ml-2"></i>
                                متم توظيفه
                            </div>
                        @elseif($application->status == 'rejected')
                            <div class="bg-red-100 text-red-800 px-4 py-3 rounded-full inline-flex items-center">
                                <i class="fas fa-times-circle ml-2"></i>
                                مرفوض
                            </div>
                        @else
                            <div class="bg-gray-100 text-gray-800 px-4 py-3 rounded-full inline-flex items-center">
                                <i class="fas fa-question-circle ml-2"></i>
                                {{ $application->status }}
                            </div>
                        @endif
                    </div>
                    
                    <div class="text-center text-sm text-gray-500">
                        <p>تاريخ التقديم: {{ $application->created_at->format('Y-m-d H:i') }}</p>
                        <p>آخر تحديث: {{ $application->updated_at->format('Y-m-d H:i') }}</p>
                    </div>
                </div>
            </div>

            <!-- Actions Card -->
            @if(auth()->user()->role === 'admin' || auth()->user()->id === $application->job->user_id)
                <div class="bg-white rounded-xl shadow-md overflow-hidden">
                    <div class="border-b border-gray-200 px-6 py-4">
                        <h5 class="text-lg font-semibold text-gray-800 flex items-center">
                            <i class="fas fa-cogs ml-2 text-orange-600"></i>
                            الإجراءات
                        </h5>
                    </div>
                    <div class="p-6">
                        <div class="space-y-3">
                            <form method="POST" action="{{ route('jobs.applications.update', [$application->job, $application]) }}">
                                @csrf
                                @method('PATCH')
                                <input type="hidden" name="status" value="under_review">
                                <button type="submit" class="w-full bg-cyan-100 text-cyan-600 px-4 py-3 rounded-lg hover:bg-cyan-200 transition-colors duration-200 font-medium inline-flex items-center justify-center">
                                    <i class="fas fa-eye ml-2"></i>
                                    قيد المراجعة
                                </button>
                            </form>
                            
                            <form method="POST" action="{{ route('jobs.applications.update', [$application->job, $application]) }}">
                                @csrf
                                @method('PATCH')
                                <input type="hidden" name="status" value="shortlisted">
                                <button type="submit" class="w-full bg-purple-100 text-purple-600 px-4 py-3 rounded-lg hover:bg-purple-200 transition-colors duration-200 font-medium inline-flex items-center justify-center">
                                    <i class="fas fa-star ml-2"></i>
                                    مختار
                                </button>
                            </form>
                            
                            <form method="POST" action="{{ route('jobs.applications.update', [$application->job, $application]) }}">
                                @csrf
                                @method('PATCH')
                                <input type="hidden" name="status" value="hired">
                                <button type="submit" class="w-full bg-green-100 text-green-600 px-4 py-3 rounded-lg hover:bg-green-200 transition-colors duration-200 font-medium inline-flex items-center justify-center">
                                    <i class="fas fa-check-circle ml-2"></i>
                                    متم توظيفه
                                </button>
                            </form>
                            
                            <form method="POST" action="{{ route('jobs.applications.update', [$application->job, $application]) }}">
                                @csrf
                                @method('PATCH')
                                <input type="hidden" name="status" value="rejected">
                                <button type="submit" class="w-full bg-red-100 text-red-600 px-4 py-3 rounded-lg hover:bg-red-200 transition-colors duration-200 font-medium inline-flex items-center justify-center">
                                    <i class="fas fa-times-circle ml-2"></i>
                                    مرفوض
                                </button>
                            </form>
                            
                            <hr class="my-4">
                            
                            <form method="POST" action="{{ route('jobs.applications.destroy', [$application->job, $application]) }}" onsubmit="return confirm('هل أنت متأكد من حذف هذا التقديم؟')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="w-full bg-gray-100 text-gray-600 px-4 py-3 rounded-lg hover:bg-gray-200 transition-colors duration-200 font-medium inline-flex items-center justify-center">
                                    <i class="fas fa-trash ml-2"></i>
                                    حذف التقديم
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            @endif
        </div>
    </div>
</div>
@endsection
