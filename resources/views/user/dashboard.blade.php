@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-8">

    <!-- Header -->
    <div class="mb-10">
        <h1 class="text-3xl font-extrabold text-gray-900 dark:text-white flex items-center gap-2">
            <i class="fas fa-user-tie text-blue-600"></i>
            لوحة تحكم الباحث عن عمل
        </h1>
        <p class="text-gray-600 dark:text-gray-400 mt-2">
            مرحباً
            <span class="font-semibold text-gray-900 dark:text-white">
                {{ $user->name }}
            </span>
            👋 — تابع طلباتك وفرص العمل المناسبة لك
        </p>
    </div>

    <!-- Stats Cards -->
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6 mb-10">
        @php
            $cards = [
                ['title'=>'إجمالي الطلبات','icon'=>'fa-paper-plane','color'=>'blue','value'=>$data['total_applications']],
                ['title'=>'قيد المراجعة','icon'=>'fa-clock','color'=>'yellow','value'=>$data['under_review_applications']],
                ['title'=>'مقبول','icon'=>'fa-trophy','color'=>'green','value'=>$data['hired_count']],
                ['title'=>'وظائف محفوظة','icon'=>'fa-bookmark','color'=>'purple','value'=>$data['saved_jobs'] ?? 0],
            ];
        @endphp

        @foreach($cards as $card)
        <div class="bg-white dark:bg-gray-800 rounded-2xl shadow-sm hover:shadow-lg transition p-6">
            <div class="flex items-center gap-4">
                <div class="p-4 rounded-xl bg-{{ $card['color'] }}-100 dark:bg-{{ $card['color'] }}-900">
                    <i class="fas {{ $card['icon'] }} text-{{ $card['color'] }}-600 dark:text-{{ $card['color'] }}-300 text-xl"></i>
                </div>
                <div>
                    <p class="text-sm text-gray-500 dark:text-gray-400">{{ $card['title'] }}</p>
                    <p class="text-3xl font-bold text-gray-900 dark:text-white">
                        {{ $card['value'] }}
                    </p>
                </div>
            </div>
        </div>
        @endforeach
    </div>

    <!-- Content -->
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">

        <!-- Recent Applications -->
        <div class="bg-white dark:bg-gray-800 rounded-2xl shadow overflow-hidden">
            <div class="px-6 py-4 border-b border-gray-200 dark:border-gray-700">
                <h3 class="text-lg font-bold text-gray-900 dark:text-white">
                    طلباتي الأخيرة
                </h3>
            </div>

            <div class="divide-y divide-gray-200 dark:divide-gray-700">
                @forelse($applications as $application)
                <div class="p-5 hover:bg-gray-50 dark:hover:bg-gray-700/50 transition">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="font-semibold text-gray-900 dark:text-white">
                                {{ $application->job?->title ?? 'وظيفة غير معروفة' }}
                            </p>
                            <p class="text-sm text-gray-500 dark:text-gray-400">
                                {{ $application->job?->company?->name
                                    ?? $application->job?->user?->name
                                    ?? 'جهة غير معروفة' }}
                            </p>
                            <p class="text-xs text-gray-400 mt-1">
                                {{ optional($application->created_at)->format('d M Y') }}
                            </p>
                        </div>

                        <span class="px-3 py-1 text-xs font-semibold rounded-full
                        @if($application->status === 'applied') bg-yellow-100 text-yellow-800
                        @elseif($application->status === 'hired') bg-green-100 text-green-800
                        @elseif($application->status === 'rejected') bg-red-100 text-red-800
                        @elseif($application->status === 'shortlisted') bg-blue-100 text-blue-800
                        @elseif($application->status === 'under_review') bg-gray-100 text-gray-800
                        @else bg-gray-100 text-gray-800 @endif">
                            @if($application->status === 'applied') مقدم
                            @elseif($application->status === 'hired') مقبول
                            @elseif($application->status === 'rejected') مرفوض
                            @elseif($application->status === 'shortlisted') مختار
                            @elseif($application->status === 'under_review') قيد المراجعة
                            @else {{ $application->status }} @endif
                        </span>
                    </div>
                </div>
                @empty
                <div class="p-6 text-center text-gray-500 dark:text-gray-400">
                    لم تقم بتقديم أي طلبات بعد
                </div>
                @endforelse
            </div>
        </div>

        <!-- Suggested Jobs -->
        <div class="bg-white dark:bg-gray-800 rounded-2xl shadow overflow-hidden">
            <div class="px-6 py-4 border-b border-gray-200 dark:border-gray-700">
                <h3 class="text-lg font-bold text-gray-900 dark:text-white">
                    وظائف مقترحة
                </h3>
            </div>

            <div class="divide-y divide-gray-200 dark:divide-gray-700">
                @forelse($suggestedJobs as $job)
                @if($job)
                <div class="p-5 hover:bg-gray-50 dark:hover:bg-gray-700/50 transition">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="font-semibold text-gray-900 dark:text-white">
                                {{ $job->title }}
                            </p>
                            <p class="text-sm text-gray-500 dark:text-gray-400">
                                {{ $job?->company?->name
                                    ?? $job?->user?->name
                                    ?? 'شركة غير محددة' }}
                            </p>
                            <p class="text-xs text-gray-400 mt-1">
                                {{ $job->location ?? 'غير محدد' }}
                            </p>
                        </div>

                        <a href="{{ route('jobs.show', $job) }}"
                           class="inline-flex items-center gap-1 text-blue-600 hover:text-blue-800 text-sm font-semibold">
                            عرض التفاصيل
                            <i class="fas fa-arrow-left text-xs"></i>
                        </a>
                    </div>
                </div>
                @endif
                @empty
                <div class="p-5 text-center text-gray-500">
                    <p>لا توجد وظائف مقترحة حالياً</p>
                </div>
                @endforelse
            </div>
        </div>

    </div>
</div>
@endsection
