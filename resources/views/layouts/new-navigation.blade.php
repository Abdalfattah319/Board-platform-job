<nav x-data="{ open: false, userMenuOpen: false }" class="bg-white shadow-lg border-b border-gray-100 sticky top-0 z-50 backdrop-blur-lg bg-opacity-95" @keydown.escape="userMenuOpen = false">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16">
            <!-- Logo and main navigation -->
            <div class="flex items-center space-x-8">
                <!-- Logo -->
                <div class="flex-shrink-0 flex items-center">
                    <a href="{{ route('dashboard.index') }}" class="flex items-center space-x-3 group">
                        <x-application-logo class="block h-8 w-auto text-indigo-600 transform transition-transform duration-300 group-hover:scale-110" />
                        <span class="mr-2 text-xl font-bold bg-gradient-to-r from-indigo-600 to-purple-600 bg-clip-text text-transparent">
                            {{ config('app.name') }}
                        </span>
                    </a>
                </div>

                <!-- Desktop Navigation -->
                <div class="hidden md:flex space-x-1">
                    <a href="{{ route('dashboard.index') }}" 
                       class="relative px-4 py-2 text-sm font-medium text-gray-700 hover:text-indigo-600 rounded-lg hover:bg-indigo-50 transition-all duration-300 group">
                        <i class="fas fa-home ml-2 text-gray-400 group-hover:text-indigo-600"></i>
                        <span class="relative z-10">الرئيسية</span>
                        <div class="absolute inset-x-0 bottom-0 h-0.5 bg-indigo-600 scale-x-0 group-hover:scale-x-100 transition-transform duration-300"></div>
                    </a>
                    
                    <a href="{{ route('jobs.index') }}" 
                       class="relative px-4 py-2 text-sm font-medium text-gray-700 hover:text-indigo-600 rounded-lg hover:bg-indigo-50 transition-all duration-300 group">
                        <i class="fas fa-briefcase ml-2 text-gray-400 group-hover:text-indigo-600"></i>
                        <span class="relative z-10">الوظائف</span>
                        <div class="absolute inset-x-0 bottom-0 h-0.5 bg-indigo-600 scale-x-0 group-hover:scale-x-100 transition-transform duration-300"></div>
                    </a>
                    
                    <a href="{{ route('companies.index') }}" 
                       class="relative px-4 py-2 text-sm font-medium text-gray-700 hover:text-indigo-600 rounded-lg hover:bg-indigo-50 transition-all duration-300 group">
                        <i class="fas fa-building ml-2 text-gray-400 group-hover:text-indigo-600"></i>
                        <span class="relative z-10">الشركات</span>
                        <div class="absolute inset-x-0 bottom-0 h-0.5 bg-indigo-600 scale-x-0 group-hover:scale-x-100 transition-transform duration-300"></div>
                    </a>
                    
                    <a href="{{ route('articles.index') }}" 
                       class="relative px-4 py-2 text-sm font-medium text-gray-700 hover:text-indigo-600 rounded-lg hover:bg-indigo-50 transition-all duration-300 group">
                        <i class="fas fa-newspaper ml-2 text-gray-400 group-hover:text-indigo-600"></i>
                        <span class="relative z-10">المقالات</span>
                        <div class="absolute inset-x-0 bottom-0 h-0.5 bg-indigo-600 scale-x-0 group-hover:scale-x-100 transition-transform duration-300"></div>
                    </a>
                    
                    @auth
                    <a href="{{ route('saved-jobs.index') }}" 
                       class="relative px-4 py-2 text-sm font-medium text-gray-700 hover:text-red-600 rounded-lg hover:bg-red-50 transition-all duration-300 group">
                        <i class="fas fa-heart ml-2 text-red-400 group-hover:text-red-600"></i>
                        <span class="relative z-10">المحفوظات</span>
                        <div class="absolute inset-x-0 bottom-0 h-0.5 bg-red-600 scale-x-0 group-hover:scale-x-100 transition-transform duration-300"></div>
                    </a>
                    @endauth
                </div>
            </div>

            <!-- Right side navigation -->
            <div class="hidden md:flex md:items-center md:space-x-4">
                @auth
                    <!-- Notifications -->
                    <div class="relative" x-data="{ open: false }" @click.away="open = false">
                        <button @click="open = !open"
                                class="relative p-2 text-gray-400 hover:text-indigo-600 transition-colors duration-300 rounded-lg hover:bg-indigo-50 group">
                            <i class="fas fa-bell text-lg"></i>
                            @if(auth()->user()->unreadNotifications->count() > 0)
                                <span class="absolute -top-1 -right-1 h-5 w-5 bg-red-500 text-white text-xs rounded-full flex items-center justify-center font-bold">
                                    {{ auth()->user()->unreadNotifications->count() > 9 ? '9+' : auth()->user()->unreadNotifications->count() }}
                                </span>
                            @endif
                        </button>

                        <!-- Notifications Dropdown -->
                        <div x-show="open" 
                             x-transition:enter="transition ease-out duration-200"
                             x-transition:enter-start="transform opacity-0 scale-95"
                             x-transition:enter-end="transform opacity-100 scale-100"
                             x-transition:leave="transition ease-in duration-150"
                             x-transition:leave-start="transform opacity-100 scale-100"
                             x-transition:leave-end="transform opacity-0 scale-95"
                             class="origin-top-right absolute right-0 mt-2 w-80 rounded-xl shadow-2xl py-2 bg-white ring-1 ring-black ring-opacity-5 focus:outline-none z-50">
                            <div class="px-4 py-3 border-b border-gray-100">
                                <h3 class="text-sm font-semibold text-gray-900">الإشعارات</h3>
                            </div>
                            
                            <div class="max-h-96 overflow-y-auto">
                                @if(auth()->user()->unreadNotifications->count() > 0)
                                    @foreach(auth()->user()->unreadNotifications()->take(5)->get() as $notification)
                                        <a href="{{ $notification->data['job_id'] ? route('jobs.show', $notification->data['job_id']) : '#' }}" 
                                           class="block px-4 py-3 hover:bg-gray-50 transition-colors bg-indigo-50">
                                            <div class="flex items-start">
                                                <div class="flex-shrink-0 ml-3">
                                                    <div class="h-8 w-8 rounded-full bg-indigo-100 flex items-center justify-center">
                                                        <i class="fas fa-briefcase text-indigo-600 text-sm"></i>
                                                    </div>
                                                </div>
                                                <div class="flex-1 mr-3">
                                                    <p class="text-sm font-medium text-gray-900">
                                                        {{ $notification->data['title'] ?? 'إشعار جديد' }}
                                                    </p>
                                                    <p class="text-sm text-gray-500 mt-1">
                                                        {{ $notification->data['message'] ?? 'لديك إشعار جديد' }}
                                                    </p>
                                                    <p class="text-xs text-gray-400 mt-1">
                                                        {{ $notification->created_at->diffForHumans() }}
                                                    </p>
                                                </div>
                                            </div>
                                        </a>
                                    @endforeach
                                @else
                                    <div class="px-4 py-8 text-center">
                                        <i class="fas fa-bell-slash text-3xl text-gray-400 mb-3"></i>
                                        <p class="text-sm text-gray-500">لا توجد إشعارات غير مقروءة</p>
                                    </div>
                                @endif
                            </div>
                            
                            @if(auth()->user()->unreadNotifications->count() > 0)
                            <div class="px-4 py-3 border-t border-gray-100">
                                <a href="{{ route('notifications.index') }}" 
                                   class="text-sm text-indigo-600 hover:text-indigo-900 font-medium">
                                    عرض جميع الإشعارات ({{ auth()->user()->unreadNotifications->count() }})
                                </a>
                            </div>
                            @endif
                        </div>
                    </div>

                    <!-- Profile dropdown -->
                    <div class="relative" x-data="{ open: false }" @click.away="open = false">
                        <button @click="open = !open"
                            class="flex items-center max-w-xs text-sm rounded-full focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 p-1 hover:bg-gray-100 transition-all duration-300">
                            <div class="h-8 w-8 rounded-full bg-gradient-to-r from-indigo-500 to-purple-600 flex items-center justify-center text-white font-semibold shadow-lg">
                                {{ strtoupper(substr(Auth::user()->name ?? 'U', 0, 1)) }}
                            </div>
                            <span class="mr-3 text-sm font-medium text-gray-700">{{ Auth::user()->name ?? 'مستخدم' }}</span>
                            <i class="fas fa-chevron-down text-xs text-gray-400 ml-1 transition-transform duration-300" :class="{ 'rotate-180': open }"></i>
                        </button>

                        <!-- Dropdown menu -->
                        <div x-show="open" x-transition:enter="transition ease-out duration-200"
                            x-transition:enter-start="transform opacity-0 scale-95"
                            x-transition:enter-end="transform opacity-100 scale-100"
                            x-transition:leave="transition ease-in duration-150"
                            x-transition:leave-start="transform opacity-100 scale-100"
                            x-transition:leave-end="transform opacity-0 scale-95"
                            class="origin-top-right absolute right-0 mt-2 w-56 rounded-xl shadow-2xl py-2 bg-white ring-1 ring-black ring-opacity-5 focus:outline-none z-50">
                            <div class="py-1 border-b border-gray-100">
                                <a href="{{ route('saved-jobs.index') }}"
                                    class="flex items-center w-full px-4 py-3 text-sm text-gray-700 hover:bg-red-50 hover:text-red-600 transition-all duration-300">
                                    <i class="fas fa-heart ml-3 text-red-500"></i>
                                    <span>الوظائف المحفوظة</span>
                                </a>
                            </div>
                            <div class="py-1">
                                <a href="{{ route('profile.edit') }}"
                                    class="flex items-center w-full px-4 py-3 text-sm text-gray-700 hover:bg-indigo-50 hover:text-indigo-600 transition-all duration-300">
                                    <i class="fas fa-user-circle ml-3 text-indigo-500"></i>
                                    <span>الملف الشخصي</span>
                                </a>
                            </div>
                            <div class="py-1 border-t border-gray-100">
                                <a href="#" 
                                    class="flex items-center w-full px-4 py-3 text-sm text-gray-700 hover:bg-gray-50 hover:text-gray-900 transition-all duration-300">
                                    <i class="fas fa-cog ml-3 text-gray-500"></i>
                                    <span>الإعدادات</span>
                                </a>
                            </div>
                            <div class="py-1">
                                <form method="POST" action="{{ route('logout') }}">
                                    @csrf
                                    <button type="submit"
                                        class="flex items-center w-full px-4 py-3 text-sm text-gray-700 hover:bg-red-50 hover:text-red-600 transition-all duration-300">
                                        <i class="fas fa-sign-out-alt ml-3 text-red-500"></i>
                                        <span>تسجيل خروج</span>
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                @else
                    <div class="flex space-x-4">
                        <a href="{{ route('login') }}"
                            class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium text-indigo-600 hover:bg-indigo-50 rounded-lg transition-all duration-300">
                            <i class="fas fa-sign-in-alt ml-2"></i>
                            {{ __('تسجيل دخول') }}
                        </a>
                        <a href="{{ route('register') }}"
                            class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium text-white bg-indigo-600 hover:bg-indigo-700 rounded-lg transition-all duration-300">
                            {{ __('حساب جديد') }}
                        </a>
                    </div>
                @endauth
            </div>

            <!-- Mobile menu button -->
            <div class="md:hidden">
                <button @click="open = !open" type="button"
                    class="inline-flex items-center justify-center p-2 rounded-md text-gray-400 hover:text-gray-500 hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-inset focus:ring-indigo-500 transition-all duration-300">
                    <span class="sr-only">Open main menu</span>
                    <!-- Icon when menu is closed -->
                    <svg x-show="!open" class="block h-6 w-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                    </svg>
                    <!-- Icon when menu is open -->
                    <svg x-show="open" class="block h-6 w-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <!-- Mobile menu, show/hide based on menu state -->
    <div x-show="open" x-transition:enter="transition ease-out duration-200"
         x-transition:enter-start="transform opacity-0 scale-95"
         x-transition:enter-end="transform opacity-100 scale-100"
         x-transition:leave="transition ease-in duration-150"
         x-transition:leave-start="transform opacity-100 scale-100"
         x-transition:leave-end="transform opacity-0 scale-95"
         class="md:hidden z-50">
        <div class="px-2 pt-2 pb-3 space-y-1 bg-white shadow-2xl ring-1 ring-black ring-opacity-5">
            <div class="px-3 py-2 border-b border-gray-100">
                <a href="{{ route('dashboard.index') }}"
                    class="flex items-center w-full text-base font-medium text-gray-700 hover:bg-indigo-50 hover:text-indigo-600 rounded-lg px-3 py-2 transition-all duration-300">
                    <i class="fas fa-home ml-3 text-indigo-500"></i>
                    <span>الرئيسية</span>
                </a>
            </div>
            <div class="px-3 py-2 border-b border-gray-100">
                <a href="{{ route('jobs.index') }}"
                    class="flex items-center w-full text-base font-medium text-gray-700 hover:bg-indigo-50 hover:text-indigo-600 rounded-lg px-3 py-2 transition-all duration-300">
                    <i class="fas fa-briefcase ml-3 text-indigo-500"></i>
                    <span>الوظائف</span>
                </a>
            </div>
            <div class="px-3 py-2 border-b border-gray-100">
                <a href="{{ route('companies.index') }}"
                    class="flex items-center w-full text-base font-medium text-gray-700 hover:bg-indigo-50 hover:text-indigo-600 rounded-lg px-3 py-2 transition-all duration-300">
                    <i class="fas fa-building ml-3 text-indigo-500"></i>
                    <span>الشركات</span>
                </a>
            </div>
            <div class="px-3 py-2 border-b border-gray-100">
                <a href="{{ route('articles.index') }}"
                    class="flex items-center w-full text-base font-medium text-gray-700 hover:bg-indigo-50 hover:text-indigo-600 rounded-lg px-3 py-2 transition-all duration-300">
                    <i class="fas fa-newspaper ml-3 text-indigo-500"></i>
                    <span>المقالات</span>
                </a>
            </div>
            @auth
            <div class="px-3 py-2 border-b border-gray-100">
                <a href="{{ route('saved-jobs.index') }}"
                    class="flex items-center w-full text-base font-medium text-gray-700 hover:bg-red-50 hover:text-red-600 rounded-lg px-3 py-2 transition-all duration-300">
                    <i class="fas fa-heart ml-3 text-red-500"></i>
                    <span>الوظائف المحفوظة</span>
                </a>
            </div>
            @endauth
            @auth
            <div class="pt-4 pb-3 space-y-1 border-t border-gray-100">
                <div class="px-3 py-2">
                    <a href="{{ route('profile.edit') }}"
                        class="flex items-center w-full text-base font-medium text-gray-700 hover:bg-indigo-50 hover:text-indigo-600 rounded-lg px-3 py-2 transition-all duration-300">
                        <i class="fas fa-user-circle ml-3 text-indigo-500"></i>
                        <span>الملف الشخصي</span>
                    </a>
                </div>
                <div class="px-3 py-2">
                    <a href="#"
                        class="flex items-center w-full text-base font-medium text-gray-700 hover:bg-gray-50 hover:text-gray-900 rounded-lg px-3 py-2 transition-all duration-300">
                        <i class="fas fa-cog ml-3 text-gray-500"></i>
                        <span>الإعدادات</span>
                    </a>
                </div>
                <div class="px-3 py-2 border-t border-gray-100">
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit"
                            class="flex items-center w-full text-base font-medium text-gray-700 hover:bg-red-50 hover:text-red-600 rounded-lg px-3 py-2 transition-all duration-300">
                            <i class="fas fa-sign-out-alt ml-3 text-red-500"></i>
                            <span>تسجيل خروج</span>
                        </button>
                    </form>
                </div>
            @else
            <div class="pt-4 pb-3 space-y-1 border-t border-gray-100">
                <div class="px-3 py-2">
                    <a href="{{ route('login') }}"
                        class="flex items-center w-full text-base font-medium text-indigo-600 hover:bg-indigo-50 rounded-lg px-3 py-2 transition-all duration-300">
                        <i class="fas fa-sign-in-alt ml-3"></i>
                        <span>{{ __('تسجيل دخول') }}</span>
                    </a>
                </div>
                <div class="px-3 py-2">
                    <a href="{{ route('register') }}"
                        class="flex items-center w-full text-base font-medium text-white bg-indigo-600 hover:bg-indigo-700 rounded-lg px-3 py-2 transition-all duration-300">
                        <span>{{ __('حساب جديد') }}</span>
                    </a>
                </div>
            </div>
            @endauth
        </div>
    </div>
</nav>
