<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" dir="rtl" class="h-full">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ $title ?? config('app.name', 'لوحة التحكم') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css2?family=Tajawal:wght@400;500;700;800&display=swap" rel="stylesheet">
    
    <!-- Icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <!-- AOS Animation -->
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
    
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    
    <style>
        :root {
            --primary: #4F46E5;
            --primary-dark: #4338CA;
            --secondary: #10B981;
            --dark: #1F2937;
            --light: #F9FAFB;
            --gray: #6B7280;
        }
        
        body {
            font-family: 'Tajawal', sans-serif;
            @apply bg-gray-50 text-gray-800;
        }
        
        .gradient-bg {
            background: linear-gradient(135deg, var(--primary) 0%, #7C3AED 100%);
        }
        
        .card {
            @apply bg-white rounded-xl shadow-sm hover:shadow-md transition-all duration-300;
        }
        
        .btn-primary {
            @apply bg-indigo-600 text-white px-6 py-2.5 rounded-lg font-medium hover:bg-indigo-700 transition-all duration-300 transform hover:-translate-y-0.5;
        }
        
        .btn-outline {
            @apply border border-indigo-600 text-indigo-600 px-6 py-2.5 rounded-lg font-medium hover:bg-indigo-50 transition-all duration-300;
        }
        
        /* Custom scrollbar */
        ::-webkit-scrollbar {
            width: 8px;
            height: 8px;
        }
        
        ::-webkit-scrollbar-track {
            @apply bg-gray-100 rounded-full;
        }
        
        ::-webkit-scrollbar-thumb {
            @apply bg-indigo-300 rounded-full hover:bg-indigo-400;
        }
    </style>
    
    @stack('styles')
</head>
<body class="min-h-screen flex flex-col" x-data="{ mobileMenuOpen: false, userMenuOpen: false }" :class="{ 'overflow-hidden': mobileMenuOpen }">
    <!-- Alerts Container -->
    <div class="fixed top-20 left-4 z-[60] space-y-3 max-w-md w-full">
        @if(session('success'))
            <x-alert type="success" />
        @endif
        @if(session('error'))
            <x-alert type="error" />
        @endif
        @if(session('warning'))
            <x-alert type="warning" />
        @endif
        @if(session('info'))
            <x-alert type="info" />
        @endif
    </div>

    <!-- Navigation -->
    @include('layouts.new-navigation')

    <!-- Page Content -->
    
        <x-slot name="header">
                    <div class="flex justify-between items-center">
                        <h1 class="text-3xl font-bold text-gray-900">{{ $company->name }}</h1>
                        @auth
                        @if(auth()->user()->role === 'employer' && auth()->user()->id === $company->user_id)
                        <x-primary-button>
                            <a href="{{ route('companies.edit', $company) }}">تعديل الشركة</a>
                        </x-primary-button>
                        @endif
                        @endauth
                    </div>
        </x-slot>

        <div class="py-6">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <!-- Company Header -->
                <div class="bg-white rounded-2xl shadow-xl overflow-hidden mb-8 premium-shadow">
                    <div class="bg-gradient-to-r from-indigo-500 to-purple-600 p-8 text-white">
                        <div class="flex flex-col md:flex-row items-center md:items-start gap-6">
                            <div class="flex-shrink-0">
                                @if($company->logo)
                                    <img src="{{ $company->logo }}" alt="{{ $company->name }}" 
                                        class="w-24 h-24 rounded-full border-4 border-white shadow-lg object-cover">
                                @else
                                    <div class="w-24 h-24 rounded-full border-4 border-white shadow-lg bg-white/20 flex items-center justify-center">
                                        <span class="text-3xl font-bold">{{ substr($company->name, 0, 2) }}</span>
                                    </div>
                                @endif
                            </div>
                            <div class="flex-1 text-center md:text-right">
                                <h1 class="text-3xl md:text-4xl font-black mb-2">{{ $company->name }}</h1>
                                <p class="text-xl text-white/90 mb-4">{{ $company->industry ?? 'غير محدد' }}</p>
                                <div class="flex flex-col md:flex-row gap-4 justify-center md:justify-start">
                                    @if($company->website)
                                    <a href="{{ $company->website }}" target="_blank" 
                                    class="inline-flex items-center px-4 py-2 bg-white/20 backdrop-blur-sm rounded-full text-white hover:bg-white/30 transition-all duration-300">
                                        <svg class="w-5 h-5 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"></path>
                                        </svg>
                                        زيارة الموقع
                                    </a>
                                    @endif
                                    <div class="inline-flex items-center px-4 py-2 bg-white/20 backdrop-blur-sm rounded-full text-white">
                                        <svg class="w-5 h-5 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
                                        </svg>
                                        {{ $company->jobs_count ?? 0 }} وظيفة
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Company Info -->
                    <div class="p-8">
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                            <div>
                                <h3 class="text-xl font-bold text-gray-900 mb-4">معلومات الشركة</h3>
                                <div class="space-y-4">
                                    <div class="flex items-center">
                                        <svg class="w-5 h-5 ml-3 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                                        </svg>
                                        <span class="text-gray-700">المالك: {{ $company->user->name }}</span>
                                    </div>
                                    @if($company->location)
                                    <div class="flex items-center">
                                        <svg class="w-5 h-5 ml-3 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path>
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                        </svg>
                                        <span class="text-gray-700">{{ $company->location }}</span>
                                    </div>
                                    @endif
                                    @if($company->size)
                                    <div class="flex items-center">
                                        <svg class="w-5 h-5 ml-3 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 4M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path>
                                        </svg>
                                        <span class="text-gray-700">{{ $company->size }} موظف</span>
                                    </div>
                                    @endif
                                </div>
                            </div>
                            
                            <div>
                                <h3 class="text-xl font-bold text-gray-900 mb-4">نبذة عن الشركة</h3>
                                <p class="text-gray-600 leading-relaxed">
                                    {{ $company->description ?? 'لا يوجد وصف متوفر للشركة.' }}
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
                                        <svg class="flex-shrink-0 mr-1.5 h-5 w-5 text-gray-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                                            <path fill-rule="evenodd" d="M6 6V5a3 3 0 013-3h2a3 3 0 013 3v1h2a2 2 0 012 2v3.57A22.952 22.952 0 0110 13a22.95 22.95 0 01-8-1.43V8a2 2 0 012-2h2zm2-1a1 1 0 011-1h2a1 1 0 011 1v1H8V5zm1 5a1 1 0 011-1h.01a1 1 0 110 2H10a1 1 0 01-1-1z" clip-rule="evenodd" />
                                            <path d="M2 13.692V16a2 2 0 002 2h12a2 2 0 002-2v-2.308A24.974 24.974 0 0110 15c-2.796 0-5.487-.46-8-1.308z" />
                                        </svg>
                                        {{ $company->industry }}
                                    </div>
                                    @if($company->website)
                                    <div class="mt-2 flex items-center text-sm text-gray-500">
                                        <!-- Heroicon name: solid/globe -->
                                        <svg class="flex-shrink-0 mr-1.5 h-5 w-5 text-gray-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                                            <path fill-rule="evenodd" d="M4.083 9h1.946c.089-1.546.383-2.97.837-4.118A6.004 6.004 0 004.083 9zM10 2a8 8 0 100 16 8 8 0 000-16zm0 2c-.076 0-.232.032-.465.262-.238.234-.497.623-.737 1.182-.39.918-.605 2.222-.605 3.656 0 1.434.215 2.738.605 3.656.24.56.5.948.737 1.182.233.23.389.262.465.262.076 0 .232-.032.465-.262.238-.234.498-.623.737-1.182.39-.918.605-2.222.605-3.656 0-1.434-.215-2.738-.605-3.656-.24-.56-.5-.948-.737-1.182C10.232 4.032 10.076 4 10 4zm3.894 5.814a8.019 8.019 0 01-1.276 3.391c.21.03.42.047.632.047a8 8 0 001.86-.203 7.95 7.95 0 01-1.216-3.235zM13.93 9a15.327 15.327 0 00-.605-3.656c-.24-.56-.5-.948-.737-1.182C12.354 4.032 12.198 4 12.122 4H12v.08C12.931 4.669 13.58 6.319 13.93 9z" clip-rule="evenodd" />
                                        </svg>
                                        <a href="{{ $company->website }}" target="_blank" class="text-indigo-600 hover:text-indigo-900">
                                            {{ parse_url($company->website, PHP_URL_HOST) }}
                                        </a>
                                    </div>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                    @auth
                        @if(auth()->user()->id === $company->user_id)
                        <div class="mt-4 flex space-x-3 md:mt-0">
                            <a href="{{ route('companies.edit', $company) }}" class="inline-flex items-center px-4 py-2 border border-gray-300 shadow-sm text-sm font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                                <svg class="-ml-1 mr-2 h-5 w-5 text-gray-500" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                                    <path d="M13.586 3.586a2 2 0 112.828 2.828l-.793.793-2.828-2.828.793-.793zM11.379 5.793L3 14.172V17h2.828l8.38-8.379-2.83-2.828z" />
                                </svg>
                                تعديل
                            </a>
                        </div>
                        @endif
                    @endauth
                </div>
            </div>
        </div>

        <div class="py-10">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="lg:grid lg:grid-cols-12 lg:gap-8">
                    <!-- Main Content -->
                    <div class="lg:col-span-8">
                        <!-- About Section -->
                        <div class="bg-white shadow overflow-hidden sm:rounded-lg mb-8">
                            <div class="px-4 py-5 sm:px-6">
                                <h3 class="text-lg leading-6 font-medium text-gray-900">
                                    عن الشركة
                                </h3>
                            </div>
                            <div class="border-t border-gray-200 px-4 py-5 sm:p-0">
                                <div class="py-4 sm:py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                                    <div class="prose max-w-none">
                                        {!! nl2br(e($company->description)) !!}
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Contact Information -->
                        <div class="bg-white shadow overflow-hidden sm:rounded-lg mb-8">
                            <div class="px-4 py-5 sm:px-6">
                                <h3 class="text-lg leading-6 font-medium text-gray-900">
                                    معلومات التواصل
                                </h3>
                            </div>
                            <div class="border-t border-gray-200">
                                <dl>
                                    @if($company->email)
                                    <div class="bg-gray-50 px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                                        <dt class="text-sm font-medium text-gray-500">
                                            البريد الإلكتروني
                                        </dt>
                                        <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">
                                            <a href="mailto:{{ $company->email }}" class="text-indigo-600 hover:text-indigo-900">
                                                {{ $company->email }}
                                            </a>
                                        </dd>
                                    </div>
                                    @endif
                                    
                                    @if($company->phone)
                                    <div class="bg-white px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                                        <dt class="text-sm font-medium text-gray-500">
                                            رقم الهاتف
                                        </dt>
                                        <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">
                                            {{ $company->phone }}
                                        </dd>
                                    </div>
                                    @endif
                                    
                                    @if($company->address)
                                    <div class="bg-gray-50 px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                                        <dt class="text-sm font-medium text-gray-500">
                                            العنوان
                                        </dt>
                                        <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">
                                            {{ $company->address }}
                                        </dd>
                                    </div>
                                    @endif
                                    
                                    @if($company->twitter || $company->linkedin)
                                    <div class="bg-white px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                                        <dt class="text-sm font-medium text-gray-500">
                                            وسائل التواصل الاجتماعي
                                        </dt>
                                        <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">
                                            <div class="flex space-x-6">
                                                @if($company->twitter)
                                                <a href="https://twitter.com/{{ $company->twitter }}" target="_blank" class="text-gray-400 hover:text-gray-500">
                                                    <span class="sr-only">تويتر</span>
                                                    <svg class="h-6 w-6" fill="currentColor" viewBox="0 0 24 24">
                                                        <path d="M8.29 20.251c7.547 0 11.675-6.253 11.675-11.675 0-.178 0-.355-.012-.53A8.348 8.348 0 0022 5.92a8.19 8.19 0 01-2.357.646 4.118 4.118 0 001.804-2.27 8.224 8.224 0 01-2.605.996 4.107 4.107 0 00-6.993 3.743 11.65 11.65 0 01-8.457-4.287 4.106 4.106 0 001.27 5.477A4.072 4.072 0 012.8 9.713v.052a4.105 4.105 0 003.292 4.022 4.095 4.095 0 01-1.853.07 4.108 4.108 0 003.834 2.85A8.233 8.233 0 012 18.407a11.616 11.616 0 006.29 1.84"></path>
                                                    </svg>
                                                </a>
                                                @endif
                                                
                                                @if($company->linkedin)
                                                <a href="https://linkedin.com/company/{{ $company->linkedin }}" target="_blank" class="text-gray-400 hover:text-gray-500">
                                                    <span class="sr-only">لينكد إن</span>
                                                    <svg class="h-6 w-6" fill="currentColor" viewBox="0 0 24 24">
                                                        <path d="M19 0h-14c-2.761 0-5 2.239-5 5v14c0 2.761 2.239 5 5 5h14c2.762 0 5-2.239 5-5v-14c0-2.761-2.238-5-5-5zm-11 19h-3v-11h3v11zm-1.5-12.268c-.966 0-1.75-.79-1.75-1.764s.784-1.764 1.75-1.764 1.75.79 1.75 1.764-.783 1.764-1.75 1.764zm13.5 12.268h-3v-5.604c0-3.368-4-3.113-4 0v5.604h-3v-11h3v1.765c1.396-2.586 7-2.777 7 2.476v6.759z"/>
                                                    </svg>
                                                </a>
                                                @endif
                                            </div>
                                        </dd>
                                    </div>
                                    @endif
                                </dl>
                            </div>
                        </div>
                    </div>

                    <!-- Sidebar -->
                    <div class="lg:col-span-4">
                        <!-- Jobs -->
                        <div class="bg-white shadow overflow-hidden sm:rounded-lg mb-8">
                            <div class="px-4 py-5 sm:px-6">
                                <h3 class="text-lg leading-6 font-medium text-gray-900">
                                    الوظائف المتاحة
                                </h3>
                            </div>
                            <div class="border-t border-gray-200">
                                @if($company->jobs->count() > 0)
                                    <ul class="divide-y divide-gray-200">
                                        @foreach($company->jobs->take(5) as $job)
                                        <li>
                                            <a href="{{ route('jobs.show', $job) }}" class="block hover:bg-gray-50">
                                                <div class="px-4 py-4 sm:px-6">
                                                    <div class="flex items-center justify-between">
                                                        <p class="text-sm font-medium text-indigo-600 truncate">
                                                            {{ $job->title }}
                                                        </p>
                                                        <div class="ml-2 flex-shrink-0 flex">
                                                            <p class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">
                                                                {{ $job->type_arabic }}
                                                            </p>
                                                        </div>
                                                    </div>
                                                    <div class="mt-2 sm:flex sm:justify-between">
                                                        <div class="sm:flex">
                                                            <p class="flex items-center text-sm text-gray-500">
                                                                <svg class="flex-shrink-0 mr-1.5 h-5 w-5 text-gray-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                                                    <path fill-rule="evenodd" d="M5.05 4.05a7 7 0 119.9 9.9L10 18.9l-4.95-4.95a7 7 0 010-9.9zM10 11a2 2 0 100-4 2 2 0 000 4z" clip-rule="evenodd" />
                                                                </svg>
                                                                {{ $job->location }}
                                                            </p>
                                                        </div>
                                                        <div class="mt-2 flex items-center text-sm text-gray-500 sm:mt-0">
                                                            <svg class="flex-shrink-0 mr-1.5 h-5 w-5 text-gray-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                                                <path fill-rule="evenodd" d="M6 2a1 1 0 00-1 1v1H4a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V6a2 2 0 00-2-2h-1V3a1 1 0 10-2 0v1H7V3a1 1 0 00-1-1zm0 5a1 1 0 000 2h8a1 1 0 100-2H6z" clip-rule="evenodd" />
                                                            </svg>
                                                            <p>
                                                                {{ $job->created_at->diffForHumans() }}
                                                            </p>
                                                        </div>
                                                    </div>
                                                </div>
                                            </a>
                                        </li>
                                        @endforeach
                                    </ul>
                                    @if($company->jobs->count() > 5)
                                    <div class="px-4 py-4 sm:px-6 text-center">
                                        <a href="{{ route('jobs.index', ['company' => $company->id]) }}" class="text-sm font-medium text-indigo-600 hover:text-indigo-500">
                                            عرض المزيد من الوظائف
                                        </a>
                                    </div>
                                    @endif
                                @else
                                    <div class="px-4 py-5 sm:p-6 text-center">
                                        <p class="text-sm text-gray-500">لا توجد وظائف متاحة حاليًا</p>
                                    </div>
                                @endif
                            </div>
                        </div>

                        <!-- Company Stats -->
                        <div class="bg-white shadow overflow-hidden sm:rounded-lg">
                            <div class="px-4 py-5 sm:px-6">
                                <h3 class="text-lg leading-6 font-medium text-gray-900">
                                    إحصائيات الشركة
                                </h3>
                            </div>
                            <div class="border-t border-gray-200">
                                <dl>
                                    <div class="bg-gray-50 px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                                        <dt class="text-sm font-medium text-gray-500">
                                            عدد الموظفين
                                        </dt>
                                        <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">
                                            {{ $company->employee_count ?? 'غير محدد' }}
                                        </dd>
                                    </div>
                                    <div class="bg-white px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                                        <dt class="text-sm font-medium text-gray-500">
                                            سنة التأسيس
                                        </dt>
                                        <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">
                                            {{ $company->founded_year ?? 'غير محدد' }}
                                        </dd>
                                    </div>
                                    <div class="bg-gray-50 px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                                        <dt class="text-sm font-medium text-gray-500">
                                            نوع الشركة
                                        </dt>
                                        <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">
                                            {{ $company->company_type ?? 'غير محدد' }}
                                        </dd>
                                    </div>
                                </dl>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Footer -->
    <footer class="bg-gradient-to-br from-gray-900 via-gray-800 to-gray-900 text-white mt-auto">
        <div class="max-w-7xl mx-auto py-16 px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8">
                <!-- عن المنصة -->
                <div class="space-y-4">
                    <h3 class="text-xl font-bold mb-6 text-transparent bg-clip-text bg-gradient-to-r from-blue-400 to-indigo-400">
                        <i class="fas fa-rocket ml-2"></i>عن المنصة
                    </h3>
                    <p class="text-gray-300 leading-relaxed">
                        منصة عربية متكاملة تجمع بين أصحاب العمل والباحثين عن فرص عمل في مختلف المجالات والقطاعات.
                    </p>
                    <div class="flex space-x-4 space-x-reverse mt-6">
                        <a href="#" class="text-gray-400 hover:text-blue-400 transition-all duration-300 transform hover:scale-110">
                            <i class="fab fa-twitter text-xl"></i>
                        </a>
                        <a href="#" class="text-gray-400 hover:text-blue-500 transition-all duration-300 transform hover:scale-110">
                            <i class="fab fa-facebook text-xl"></i>
                        </a>
                        <a href="#" class="text-gray-400 hover:text-blue-600 transition-all duration-300 transform hover:scale-110">
                            <i class="fab fa-linkedin text-xl"></i>
                        </a>
                    </div>
                </div>
                
                <!-- روابط سريعة -->
                <div class="space-y-4">
                    <h3 class="text-xl font-bold mb-6 text-transparent bg-clip-text bg-gradient-to-r from-green-400 to-emerald-400">
                        <i class="fas fa-link ml-2"></i>روابط سريعة
                    </h3>
                    <ul class="space-y-3">
                        <li>
                            <a href="{{ route('dashboard.index') }}" class="text-gray-300 hover:text-white transition-all duration-300 flex items-center group">
                                <i class="fas fa-home ml-3 text-blue-400 group-hover:text-blue-300"></i>
                                <span>الرئيسية</span>
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('jobs.index') }}" class="text-gray-300 hover:text-white transition-all duration-300 flex items-center group">
                                <i class="fas fa-briefcase ml-3 text-green-400 group-hover:text-green-300"></i>
                                <span>الوظائف</span>
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('companies.index') }}" class="text-gray-300 hover:text-white transition-all duration-300 flex items-center group">
                                <i class="fas fa-building ml-3 text-purple-400 group-hover:text-purple-300"></i>
                                <span>الشركات</span>
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('articles.index') }}" class="text-gray-300 hover:text-white transition-all duration-300 flex items-center group">
                                <i class="fas fa-newspaper ml-3 text-orange-400 group-hover:text-orange-300"></i>
                                <span>المقالات</span>
                            </a>
                        </li>
                    </ul>
                </div>
                
                <!-- للشركات -->
                <div class="space-y-4">
                    <h3 class="text-xl font-bold mb-6 text-transparent bg-clip-text bg-gradient-to-r from-purple-400 to-pink-400">
                        <i class="fas fa-briefcase ml-2"></i>للشركات
                    </h3>
                    <ul class="space-y-3">
                        <li>
                            <a href="{{ route('jobs.create') }}" class="text-gray-300 hover:text-white transition-all duration-300 flex items-center group">
                                <i class="fas fa-plus-circle ml-3 text-indigo-400 group-hover:text-indigo-300"></i>
                                <span>إعلان وظيفة</span>
                            </a>
                        </li>
                        <li>
                            <a href="#" class="text-gray-300 hover:text-white transition-all duration-300 flex items-center group">
                                <i class="fas fa-search ml-3 text-yellow-400 group-hover:text-yellow-300"></i>
                                <span>البحث عن موظفين</span>
                            </a>
                        </li>
                        <li>
                            <a href="#" class="text-gray-300 hover:text-white transition-all duration-300 flex items-center group">
                                <i class="fas fa-users ml-3 text-red-400 group-hover:text-red-300"></i>
                                <span>حسابات الشركات</span>
                            </a>
                        </li>
                    </ul>
                </div>
                
                <!-- تواصل معنا -->
                <div class="space-y-4">
                    <h3 class="text-xl font-bold mb-6 text-transparent bg-clip-text bg-gradient-to-r from-red-400 to-orange-400">
                        <i class="fas fa-envelope ml-2"></i>تواصل معنا
                    </h3>
                    <ul class="space-y-4">
                        <li class="flex items-center text-gray-300 hover:text-white transition-all duration-300 group">
                            <i class="fas fa-envelope ml-3 text-blue-400 group-hover:text-blue-300"></i>
                            <span>abdlafttahAlkordi@gmail.com</span>
                        </li>
                        <li class="flex items-center text-gray-300 hover:text-white transition-all duration-300 group">
                            <i class="fas fa-phone ml-3 text-green-400 group-hover:text-green-300"></i>
                            <span dir="ltr">+972 597 481 907</span>
                        </li>
                        <li class="flex items-start text-gray-300 hover:text-white transition-all duration-300 group">
                            <i class="fas fa-map-marker-alt ml-3 text-red-400 group-hover:text-red-300 mt-1"></i>
                            <span>فلسطين</span>
                        </li>
                    </ul>
                </div>
            </div>
            
            <!-- حقوق النشر والشعار -->
            <div class="mt-16 pt-8 border-t border-gray-700">
                <div class="flex flex-col md:flex-row justify-between items-center space-y-4 md:space-y-0">
                    <div class="flex items-center space-x-4 space-x-reverse">
                        <span class="text-gray-400 text-sm">
                            &copy; {{ date('Y') }} 
                        </span>
                        <span class="text-white font-semibold">
                            {{ config('app.name', 'SeenStore') }}
                        </span>
                        <span class="text-gray-400 text-sm">
                            - جميع الحقوق محفوظة.
                        </span>
                    </div>
                    <div class="flex items-center space-x-3">
                    </div>
                </div>
            </div>
        </div>
    </footer>

    <!-- AOS Animation -->
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    
    <!-- Alpine.js -->
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    
    <script>
        // Initialize AOS
        document.addEventListener('DOMContentLoaded', function() {
            AOS.init({
                duration: 800,
                easing: 'ease-in-out',
                once: true
            });
        });

        // Close mobile menu when clicking outside
        document.addEventListener('click', function(event) {
            const nav = document.querySelector('nav');
            const menuButton = document.querySelector('[aria-controls="mobile-menu"]');
            
            if (menuButton && !menuButton.contains(event.target) && !nav.contains(event.target)) {
                Alpine.store('mobileMenuOpen', false);
            }
        });
    </script>
    
    <!-- Include Global Notification System -->
    @include('components.notifications')
    
    @stack('scripts')
</body>
</html>
