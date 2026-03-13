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
                            <i class="fas fa-users ml-2"></i>
                            إدارة التقديمات
                        </h3>
                        <p class="opacity-90">تقييم وإدارة طلبات المتقدمين</p>
                    </div>
                    <div>
                        <a href="{{ url('/dashboard') }}" class="bg-white text-blue-600 px-4 py-2 rounded-lg font-medium hover:bg-gray-100 transition-colors duration-200 inline-flex items-center">
                            <i class="fas fa-arrow-right ml-2"></i>
                            العودة
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Stats Cards -->
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-6 gap-4 mb-6">
        <div class="bg-blue-500 text-white rounded-xl shadow-md p-4 text-center">
            <h4 class="text-2xl font-bold mb-1">{{ $applications->count() }}</h4>
            <small class="text-sm">إجمالي التقديمات</small>
        </div>
        <div class="bg-yellow-500 text-white rounded-xl shadow-md p-4 text-center">
            <h4 class="text-2xl font-bold mb-1">{{ $applications->where('status', 'applied')->count() }}</h4>
            <small class="text-sm">متقدم</small>
        </div>
        <div class="bg-cyan-500 text-white rounded-xl shadow-md p-4 text-center">
            <h4 class="text-2xl font-bold mb-1">{{ $applications->where('status', 'under_review')->count() }}</h4>
            <small class="text-sm">قيد المراجعة</small>
        </div>
        <div class="bg-purple-500 text-white rounded-xl shadow-md p-4 text-center">
            <h4 class="text-2xl font-bold mb-1">{{ $applications->where('status', 'shortlisted')->count() }}</h4>
            <small class="text-sm">مختار</small>
        </div>
        <div class="bg-green-500 text-white rounded-xl shadow-md p-4 text-center">
            <h4 class="text-2xl font-bold mb-1">{{ $applications->where('status', 'hired')->count() }}</h4>
            <small class="text-sm">متم توظيفه</small>
        </div>
        <div class="bg-red-500 text-white rounded-xl shadow-md p-4 text-center">
            <h4 class="text-2xl font-bold mb-1">{{ $applications->where('status', 'rejected')->count() }}</h4>
            <small class="text-sm">مرفوض</small>
        </div>
    </div>

    <!-- Applications Table -->
    <div class="bg-white rounded-xl shadow-md overflow-hidden">
        <div class="border-b border-gray-200 px-6 py-4">
            <h5 class="text-lg font-semibold text-gray-800 flex items-center">
                <i class="fas fa-list-ul ml-2 text-blue-600"></i>
                قائمة المتقدمين
            </h5>
        </div>
        <div class="p-6">
            @if(session('success'))
                <div class="bg-green-50 border border-green-200 text-green-800 px-4 py-3 rounded-lg mb-4 flex items-center">
                    <i class="fas fa-check-circle ml-2"></i>
                    {{ session('success') }}
                </div>
            @endif
            
            @if(session('error'))
                <div class="bg-red-50 border border-red-200 text-red-800 px-4 py-3 rounded-lg mb-4 flex items-center">
                    <i class="fas fa-exclamation-triangle ml-2"></i>
                    {{ session('error') }}
                </div>
            @endif

            @if($applications->count() > 0)
                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                            <tr>
                                <th class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    <i class="fas fa-user ml-1"></i>
                                    المتقدم
                                </th>
                                <th class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    <i class="fas fa-briefcase ml-1"></i>
                                    الوظيفة
                                </th>
                                <th class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    <i class="fas fa-calendar ml-1"></i>
                                    التاريخ
                                </th>
                                <th class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    <i class="fas fa-info-circle ml-1"></i>
                                    الحالة
                                </th>
                                <th class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    <i class="fas fa-cogs ml-1"></i>
                                    الإجراءات
                                </th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            @forelse($applications as $application)
                                <tr class="hover:bg-gray-50 transition-colors">
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="flex items-center">
                                            <div class="bg-blue-500 text-white rounded-full w-10 h-10 flex items-center justify-center font-bold ml-3">
                                                {{ substr($application->user->name, 0, 1) }}
                                            </div>
                                            <div>
                                                <div class="text-sm font-medium text-gray-900">{{ $application->user->name }}</div>
                                                <div class="text-sm text-gray-500">{{ $application->user->email }}</div>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <a href="{{ route('jobs.show', $application->job) }}" class="text-sm text-blue-600 hover:text-blue-900 font-medium">
                                            {{ $application->job->title }}
                                        </a>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <span class="px-2 py-1 text-xs font-medium bg-gray-100 text-gray-800 rounded-full">
                                            {{ $application->created_at->format('Y-m-d') }}
                                        </span>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        @if($application->status == 'applied')
                                            <span class="px-3 py-1 text-xs font-medium bg-yellow-100 text-yellow-800 rounded-full inline-flex items-center">
                                                <i class="fas fa-paper-plane ml-1"></i>
                                                متقدم
                                            </span>
                                        @elseif($application->status == 'under_review')
                                            <span class="px-3 py-1 text-xs font-medium bg-cyan-100 text-cyan-800 rounded-full inline-flex items-center">
                                                <i class="fas fa-eye ml-1"></i>
                                                قيد المراجعة
                                            </span>
                                        @elseif($application->status == 'shortlisted')
                                            <span class="px-3 py-1 text-xs font-medium bg-purple-100 text-purple-800 rounded-full inline-flex items-center">
                                                <i class="fas fa-star ml-1"></i>
                                                مختار
                                            </span>
                                        @elseif($application->status == 'hired')
                                            <span class="px-3 py-1 text-xs font-medium bg-green-100 text-green-800 rounded-full inline-flex items-center">
                                                <i class="fas fa-check-circle ml-1"></i>
                                                متم توظيفه
                                            </span>
                                        @elseif($application->status == 'rejected')
                                            <span class="px-3 py-1 text-xs font-medium bg-red-100 text-red-800 rounded-full inline-flex items-center">
                                                <i class="fas fa-times-circle ml-1"></i>
                                                مرفوض
                                            </span>
                                        @else
                                            <span class="px-3 py-1 text-xs font-medium bg-gray-100 text-gray-800 rounded-full inline-flex items-center">
                                                <i class="fas fa-question-circle ml-1"></i>
                                                {{ $application->status }}
                                            </span>
                                        @endif
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm">
                                        @if(auth()->user()->role === 'admin' || auth()->user()->id === $application->job->user_id)
                                            <div class="flex items-center space-x-2 space-x-reverse">
                                                <a href="{{ route('jobs.applications.show', [$application->job, $application]) }}" class="bg-indigo-100 text-indigo-600 p-2 rounded-lg hover:bg-indigo-200 transition-colors duration-200" title="عرض التفاصيل">
                                                    <i class="fas fa-eye"></i>
                                                </a>
                                                <form method="POST" action="{{ route('jobs.applications.update', [$application->job, $application]) }}" class="inline">
                                                    @csrf
                                                    @method('PATCH')
                                                    <input type="hidden" name="status" value="under_review">
                                                    <button type="submit" class="bg-cyan-100 text-cyan-600 p-2 rounded-lg hover:bg-cyan-200 transition-colors duration-200" title="قيد المراجعة">
                                                        <i class="fas fa-search"></i>
                                                    </button>
                                                </form>
                                                <form method="POST" action="{{ route('jobs.applications.update', [$application->job, $application]) }}" class="inline">
                                                    @csrf
                                                    @method('PATCH')
                                                    <input type="hidden" name="status" value="shortlisted">
                                                    <button type="submit" class="bg-purple-100 text-purple-600 p-2 rounded-lg hover:bg-purple-200 transition-colors duration-200" title="مختار">
                                                        <i class="fas fa-star"></i>
                                                    </button>
                                                </form>
                                                <form method="POST" action="{{ route('jobs.applications.update', [$application->job, $application]) }}" class="inline">
                                                    @csrf
                                                    @method('PATCH')
                                                    <input type="hidden" name="status" value="hired">
                                                    <button type="submit" class="bg-green-100 text-green-600 p-2 rounded-lg hover:bg-green-200 transition-colors duration-200" title="متم توظيفه">
                                                        <i class="fas fa-check-circle"></i>
                                                    </button>
                                                </form>
                                                <form method="POST" action="{{ route('jobs.applications.update', [$application->job, $application]) }}" class="inline">
                                                    @csrf
                                                    @method('PATCH')
                                                    <input type="hidden" name="status" value="rejected">
                                                    <button type="submit" class="bg-red-100 text-red-600 p-2 rounded-lg hover:bg-red-200 transition-colors duration-200" title="مرفوض">
                                                        <i class="fas fa-times-circle"></i>
                                                    </button>
                                                </form>
                                                <form method="POST" action="{{ route('jobs.applications.destroy', [$application->job, $application]) }}" class="inline" onsubmit="return confirm('هل أنت متأكد من حذف هذا التقديم؟')">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="bg-gray-100 text-gray-600 p-2 rounded-lg hover:bg-gray-200 transition-colors duration-200" title="حذف">
                                                        <i class="fas fa-trash"></i>
                                                    </button>
                                                </form>
                                            </div>
                                        @else
                                            <button class="bg-gray-100 text-gray-400 p-2 rounded-lg cursor-not-allowed" disabled title="غير مصرح">
                                                <i class="fas fa-lock"></i>
                                            </button>
                                        @endif
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="6" class="px-6 py-12 text-center">
                                        <div class="text-center">
                                            <i class="fas fa-inbox text-4xl text-gray-400 mb-4"></i>
                                            <h5 class="text-lg font-medium text-gray-900 mb-2">لا توجد تقديمات</h5>
                                            <p class="text-gray-500">لم يتم تقديم أي طلبات بعد</p>
                                        </div>
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            @else
                <div class="text-center py-12">
                    <i class="fas fa-inbox text-4xl text-gray-400 mb-4"></i>
                    <h5 class="text-lg font-medium text-gray-900 mb-2">لا توجد تقديمات</h5>
                    <p class="text-gray-500">لم يتم تقديم أي طلبات بعد</p>
                </div>
            @endif
        </div>
    </div>
</div>

@endsection
