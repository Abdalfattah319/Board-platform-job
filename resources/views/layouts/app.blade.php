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
    <main class="flex-1">
        @yield('content')
    </main>

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
