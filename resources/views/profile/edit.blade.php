<!-- resources/views/profile/show.blade.php -->
<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <!-- Profile Header -->
                    <div class="flex flex-col md:flex-row items-center md:items-start space-y-6 md:space-y-0 md:space-x-6">
                        <!-- Profile Picture -->
                        <div class="flex-shrink-0">
                            <div class="relative">
                                <img class="h-32 w-32 rounded-full ring-4 ring-white" 
                                     src="{{ Auth::user()->profile_photo_url ?? 'https://ui-avatars.com/api/?name='.urlencode(Auth::user()->name).'&color=7F9CF5&background=EBF4FF' }}" 
                                     alt="{{ Auth::user()->name }}">
                                <span class="absolute bottom-0 right-0 block h-4 w-4 rounded-full bg-green-400 ring-2 ring-white"></span>
                            </div>
                        </div>
                        
                        <!-- User Info -->
                        <div class="text-center md:text-left">
                            <h1 class="text-2xl font-bold text-gray-900">{{ Auth::user()->name }}</h1>
                            <p class="text-gray-600">{{ Auth::user()->email }}</p>
                            <div class="mt-2">
                                <span class="px-3 py-1 text-sm font-semibold rounded-full 
                                    @if(Auth::user()->role === 'admin') bg-purple-100 text-purple-800
                                    @elseif(Auth::user()->role === 'employer') bg-blue-100 text-blue-800
                                    @else bg-green-100 text-green-800 @endif">
                                    {{ ucfirst(Auth::user()->role) }}
                                </span>
                            </div>
                            
                            @if(Auth::user()->role === 'employer' && $company = Auth::user()->companies->first())
                            <div class="mt-2 flex items-center text-gray-600">
                                <svg class="h-5 w-5 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h3m9 0h-3m4 0h2m-9-4v4m0-8v4m8-4v4m0-8v4m8 8h2m-2 0h-5m-9 0H3m2 0h3" />
                                </svg>
                                {{ $company->name }}
                            </div>
                            @endif
                        </div>
                        
                        <!-- Action Buttons -->
                        <div class="flex space-x-3 md:ml-auto">
                            <a href="{{ route('profile.edit') }}" 
                               class="inline-flex items-center px-4 py-2 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                                <svg class="-ml-1 mr-2 h-5 w-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                    <path d="M13.586 3.586a2 2 0 112.828 2.828l-.793.793-2.828-2.828.793-.793zM11.379 5.793L3 14.172V17h2.828l8.38-8.379-2.83-2.828z" />
                                </svg>
                                تعديل الملف الشخصي
                            </a>
                        </div>
                    </div>

                    <!-- Tabs Navigation -->
                    <div class="mt-8 border-b border-gray-200">
                        <nav class="-mb-px flex space-x-8" x-data="{ activeTab: 'overview' }">
                            <button @click="activeTab = 'overview'" 
                                    :class="activeTab === 'overview' ? 'border-indigo-500 text-indigo-600' : 'border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300'"
                                    class="whitespace-nowrap py-4 px-1 border-b-2 font-medium text-sm">
                                نظرة عامة
                            </button>
                            
                            @if(Auth::user()->role === 'employer')
                            <button @click="activeTab = 'jobs'" 
                                    :class="activeTab === 'jobs' ? 'border-indigo-500 text-indigo-600' : 'border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300'"
                                    class="whitespace-nowrap py-4 px-1 border-b-2 font-medium text-sm">
                                الوظائف المنشورة
                                <span class="ml-2 bg-gray-100 text-gray-600 text-xs font-semibold px-2.5 py-0.5 rounded-full">
                                    {{ Auth::user()->jobs->count() }}
                                </span>
                            </button>
                            @endif

                            @if(Auth::user()->role === 'applicant')
                            <button @click="activeTab = 'applications'" 
                                    :class="activeTab === 'applications' ? 'border-indigo-500 text-indigo-600' : 'border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300'"
                                    class="whitespace-nowrap py-4 px-1 border-b-2 font-medium text-sm">
                                طلبات التقديم
                                <span class="ml-2 bg-gray-100 text-gray-600 text-xs font-semibold px-2.5 py-0.5 rounded-full">
                                    {{ Auth::user()->applications->count() }}
                                </span>
                            </button>
                            @endif
                        </nav>
                    </div>

                    <!-- Tab Panels -->
                    <div class="mt-6">
                        <!-- Overview Tab -->
                        <div x-show="activeTab === 'overview'">
                            <h3 class="text-lg font-medium text-gray-900">معلومات الحساب</h3>
                            <div class="mt-4 grid grid-cols-1 gap-6 sm:grid-cols-2">
                                <div class="bg-gray-50 p-4 rounded-lg">
                                    <dt class="text-sm font-medium text-gray-500">الاسم الكامل</dt>
                                    <dd class="mt-1 text-sm text-gray-900">{{ Auth::user()->name }}</dd>
                                </div>
                                <div class="bg-gray-50 p-4 rounded-lg">
                                    <dt class="text-sm font-medium text-gray-500">البريد الإلكتروني</dt>
                                    <dd class="mt-1 text-sm text-gray-900">{{ Auth::user()->email }}</dd>
                                </div>
                                <div class="bg-gray-50 p-4 rounded-lg">
                                    <dt class="text-sm font-medium text-gray-500">تاريخ الانضمام</dt>
                                    <dd class="mt-1 text-sm text-gray-900">{{ Auth::user()->created_at->format('d M Y') }}</dd>
                                </div>
                                <div class="bg-gray-50 p-4 rounded-lg">
                                    <dt class="text-sm font-medium text-gray-500">حالة الحساب</dt>
                                    <dd class="mt-1">
                                        <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">
                                            نشط
                                        </span>
                                    </dd>
                                </div>
                            </div>

                            @if(Auth::user()->role === 'applicant')
                            <div class="mt-8">
                                <h3 class="text-lg font-medium text-gray-900">السيرة الذاتية</h3>
                                <div class="mt-4">
                                    @if(Auth::user()->resume_path)
                                        <a href="{{ Storage::url(Auth::user()->resume_path) }}" 
                                           class="inline-flex items-center text-indigo-600 hover:text-indigo-900" 
                                           target="_blank">
                                            <svg class="h-5 w-5 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                                            </svg>
                                            عرض السيرة الذاتية
                                        </a>
                                    @else
                                        <p class="text-sm text-gray-500">لم تقم برفع سيرة ذاتية بعد.</p>
                                        <a href="{{ route('profile.edit') }}" class="mt-2 inline-flex items-center px-3 py-1.5 border border-transparent text-xs font-medium rounded-md shadow-sm text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                                            رفع سيرة ذاتية
                                        </a>
                                    @endif
                                </div>
                            </div>
                            @endif
                        </div>

                        <!-- Jobs Tab (Employer Only) -->
                        @if(Auth::user()->role === 'employer')
                        <div x-show="activeTab === 'jobs'" x-cloak>
                            <div class="flex justify-between items-center mb-4">
                                <h3 class="text-lg font-medium text-gray-900">الوظائف المنشورة</h3>
                                <a href="{{ route('jobs.create') }}" 
                                   class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md shadow-sm text-white bg-indigo-600 hover:bg-indigo-700">
                                    <svg class="-ml-1 mr-2 h-5 w-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                        <path fill-rule="evenodd" d="M10 5a1 1 0 011 1v3h3a1 1 0 110 2h-3v3a1 1 0 11-2 0v-3H6a1 1 0 110-2h3V6a1 1 0 011-1z" clip-rule="evenodd" />
                                    </svg>
                                    نشر وظيفة جديدة
                                </a>
                            </div>
                            
                            <div class="bg-white shadow overflow-hidden sm:rounded-md">
                                <ul class="divide-y divide-gray-200">
                                    @forelse(Auth::user()->jobs as $job)
                                    <li>
                                        <a href="{{ route('jobs.show', $job) }}" class="block hover:bg-gray-50">
                                            <div class="px-4 py-4 sm:px-6">
                                                <div class="flex items-center justify-between">
                                                    <p class="text-sm font-medium text-indigo-600 truncate">{{ $job->title }}</p>
                                                    <div class="ml-2 flex-shrink-0 flex">
                                                        <p class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full 
                                                            @if($job->status === 'active') bg-green-100 text-green-800
                                                            @else bg-yellow-100 text-yellow-800 @endif">
                                                            {{ $job->status === 'active' ? 'نشط' : 'مغلق' }}
                                                        </p>
                                                    </div>
                                                </div>
                                                <div class="mt-2 sm:flex sm:justify-between">
                                                    <div class="sm:flex">
                                                        <p class="flex items-center text-sm text-gray-500">
                                                            <svg class="flex-shrink-0 mr-1.5 h-5 w-5 text-gray-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                                                <path fill-rule="evenodd" d="M6 6V5a3 3 0 013-3h2a3 3 0 013 3v1h2a2 2 0 012 2v3.57A22.952 22.952 0 0110 13a22.95 22.95 0 01-8-1.43V8a2 2 0 012-2h2zm2-1a1 1 0 011-1h2a1 1 0 011 1v1H8V5zm1 5a1 1 0 011-1h.01a1 1 0 110 2H10a1 1 0 01-1-1z" clip-rule="evenodd" />
                                                                <path d="M2 13.692V16a2 2 0 002 2h12a2 2 0 002-2v-2.308A24.974 24.974 0 0110 15c-2.796 0-5.487-.46-8-1.308z" />
                                                            </svg>
                                                            {{ $job->type_arabic }}
                                                        </p>
                                                        <p class="mt-2 flex items-center text-sm text-gray-500 sm:mt-0 sm:ml-6">
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
                                                            <time datetime="2020-01-07">{{ $job->created_at->diffForHumans() }}</time>
                                                        </p>
                                                    </div>
                                                </div>
                                            </div>
                                        </a>
                                    </li>
                                    @empty
                                    <li class="py-4 text-center text-gray-500">
                                        <p>لم تقم بنشر أي وظائف بعد.</p>
                                    </li>
                                    @endforelse
                                </ul>
                            </div>
                        </div>
                        @endif

                        <!-- Applications Tab (Applicant Only) -->
                        @if(Auth::user()->role === 'applicant')
                        <div x-show="activeTab === 'applications'" x-cloak>
                            <h3 class="text-lg font-medium text-gray-900 mb-4">طلبات التقديم</h3>
                            
                            <div class="bg-white shadow overflow-hidden sm:rounded-md">
                                <ul class="divide-y divide-gray-200">
                                    @forelse(Auth::user()->applications as $application)
                                    <li>
                                        <div class="px-4 py-4 sm:px-6">
                                            <div class="flex items-center justify-between">
                                                <p class="text-sm font-medium text-indigo-600 truncate">
                                                    <a href="{{ route('jobs.show', $application->job) }}">{{ $application->job->title }}</a>
                                                </p>
                                                <div class="ml-2 flex-shrink-0 flex">
                                                    <p class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full 
                                                        @if($application->status === 'pending') bg-yellow-100 text-yellow-800
                                                        @elseif($application->status === 'accepted') bg-green-100 text-green-800
                                                        @else bg-red-100 text-red-800 @endif">
                                                        @if($application->status === 'pending') قيد المراجعة
                                                        @elseif($application->status === 'accepted') مقبول
                                                        @else مرفوض @endif
                                                    </p>
                                                </div>
                                            </div>
                                            <div class="mt-2 sm:flex sm:justify-between">
                                                <div class="sm:flex">
                                                    <p class="flex items-center text-sm text-gray-500">
                                                        <svg class="flex-shrink-0 mr-1.5 h-5 w-5 text-gray-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                                            <path fill-rule="evenodd" d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z" clip-rule="evenodd" />
                                                        </svg>
                                                        {{ auth()->user()->name}}
                                                    </p>
                                                    <p class="mt-2 flex items-center text-sm text-gray-500 sm:mt-0 sm:ml-6">
                                                        <svg class="flex-shrink-0 mr-1.5 h-5 w-5 text-gray-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                                            <path fill-rule="evenodd" d="M5.05 4.05a7 7 0 119.9 9.9L10 18.9l-4.95-4.95a7 7 0 010-9.9zM10 11a2 2 0 100-4 2 2 0 000 4z" clip-rule="evenodd" />
                                                        </svg>
                                                        {{ $application->job->location }}
                                                    </p>
                                                </div>
                                                <div class="mt-2 flex items-center text-sm text-gray-500 sm:mt-0">
                                                    <svg class="flex-shrink-0 mr-1.5 h-5 w-5 text-gray-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                                        <path fill-rule="evenodd" d="M6 2a1 1 0 00-1 1v1H4a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V6a2 2 0 00-2-2h-1V3a1 1 0 10-2 0v1H7V3a1 1 0 00-1-1zm0 5a1 1 0 000 2h8a1 1 0 100-2H6z" clip-rule="evenodd" />
                                                    </svg>
                                                    <p>
                                                        <time datetime="2020-01-07">{{ $application->created_at->diffForHumans() }}</time>
                                                    </p>
                                                </div>
                                            </div>
                                        </div>
                                    </li>
                                    @empty
                                    <li class="py-4 text-center text-gray-500">
                                        <p>لم تقم بالتقديم على أي وظائف بعد.</p>
                                        <a href="{{ route('jobs.index') }}" class="mt-2 inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md text-indigo-700 bg-indigo-100 hover:bg-indigo-200 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                                            تصفح الوظائف المتاحة
                                        </a>
                                    </li>
                                    @endforelse
                                </ul>
                            </div>
                        </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>

    @push('scripts')
    <script>
        // Alpine.js for tab functionality
        document.addEventListener('alpine:init', () => {
            Alpine.data('tabs', () => ({
                activeTab: 'overview',
                setActive(tab) {
                    this.activeTab = tab;
                }
            }));
        });
    </script>
    @endpush
</x-app-layout>