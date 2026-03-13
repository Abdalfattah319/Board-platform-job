@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-8">
    <!-- Header -->
    <div class="mb-8">
        <h1 class="text-3xl font-bold text-gray-900 dark:text-white">لوحة تحكم الشركة</h1>
        <p class="text-gray-600 dark:text-gray-400 mt-2">مرحباً {{ $user->name }}، إدارة وظائفك وطلبات التوظيف</p>
    </div>

    <!-- Stats Cards -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
        <div class="bg-white dark:bg-gray-800 rounded-xl shadow p-6">
            <div class="flex items-center">
                <div class="p-3 bg-blue-100 dark:bg-blue-900 rounded-lg">
                    <i class="fas fa-briefcase text-blue-600 dark:text-blue-300 text-xl"></i>
                </div>
                <div class="mr-4">
                    <p class="text-sm text-gray-500 dark:text-gray-400">إجمالي الوظائف</p>
                    <p class="text-2xl font-semibold text-gray-900 dark:text-white">{{ $data['total_jobs'] }}</p>
                </div>
            </div>
        </div>

        <div class="bg-white dark:bg-gray-800 rounded-xl shadow p-6">
            <div class="flex items-center">
                <div class="p-3 bg-green-100 dark:bg-green-900 rounded-lg">
                    <i class="fas fa-users text-green-600 dark:text-green-300 text-xl"></i>
                </div>
                <div class="mr-4">
                    <p class="text-sm text-gray-500 dark:text-gray-400">إجمالي الطلبات</p>
                    <p class="text-2xl font-semibold text-gray-900 dark:text-white">{{ $data['total_applications'] }}</p>
                </div>
            </div>
        </div>

        <div class="bg-white dark:bg-gray-800 rounded-xl shadow p-6">
            <div class="flex items-center">
                <div class="p-3 bg-yellow-100 dark:bg-yellow-900 rounded-lg">
                    <i class="fas fa-dollar-sign text-yellow-600 dark:text-yellow-300 text-xl"></i>
                </div>
                <div class="mr-4">
                    <p class="text-sm text-gray-500 dark:text-gray-400">الإيرادات</p>
                    <p class="text-2xl font-semibold text-gray-900 dark:text-white">${{ number_format($data['total_revenue'], 2) }}</p>
                </div>
            </div>
        </div>

        <div class="bg-white dark:bg-gray-800 rounded-xl shadow p-6">
            <div class="flex items-center">
                <div class="p-3 bg-purple-100 dark:bg-purple-900 rounded-lg">
                    <i class="fas fa-user-check text-purple-600 dark:text-purple-300 text-xl"></i>
                </div>
                <div class="mr-4">
                    <p class="text-sm text-gray-500 dark:text-gray-400">الموظفون الجدد</p>
                    <p class="text-2xl font-semibold text-gray-900 dark:text-white">{{ $data['hired_count'] }}</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Recent Applications -->
    <div class="bg-white dark:bg-gray-800 rounded-xl shadow overflow-hidden">
        <div class="px-6 py-4 border-b border-gray-200 dark:border-gray-700">
            <h3 class="text-lg font-medium text-gray-900 dark:text-white">أحدث طلبات التوظيف</h3>
        </div>
        
        <div class="divide-y divide-gray-200 dark:divide-gray-700">
            @forelse($applications as $application)
            <div class="p-4 hover:bg-gray-50 dark:hover:bg-gray-700/50 transition-colors duration-200">
                <div class="flex items-center justify-between">
                    <div class="flex items-center">
                        <div class="ml-3">
                            <p class="text-sm font-medium text-gray-900 dark:text-white">طلب #{{ $application->id }}</p>
                            <p class="text-sm text-gray-500 dark:text-gray-400">{{ $application->user->name }}</p>
                            <p class="text-xs text-gray-400 dark:text-gray-500">{{ $application->job->title }}</p>
                        </div>
                    </div>
                    <div class="text-right">
                        <p class="text-sm text-gray-900 dark:text-white">{{ $application->created_at->format('d M Y') }}</p>
                        <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full 
                            @if($application->status === 'applied') bg-yellow-100 text-yellow-800
                            @elseif($application->status === 'hired') bg-green-100 text-green-800
                            @elseif($application->status === 'rejected') bg-red-100 text-red-800
                            @elseif($application->status === 'shortlisted') bg-blue-100 text-blue-800
                            @else bg-gray-100 text-gray-800 @endif">
                            @if($application->status === 'applied') مقدم
                            @elseif($application->status === 'hired') مقبول
                            @elseif($application->status === 'rejected') مرفوض
                            @elseif($application->status === 'shortlisted') مختار
                            @else {{ $application->status }} @endif
                        </span>
                    </div>
                </div>
            </div>
            @empty
            <div class="p-4 text-center text-gray-500 dark:text-gray-400">
                لا توجد طلبات توظيف حديثة
            </div>
            @endforelse
        </div>
    </div>
</div>
@endsection
