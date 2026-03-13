<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ config('app.name', 'Fursaana') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Tajawal:wght@300;400;500;700;900&display=swap" rel="stylesheet">

    <!-- Scripts -->
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js" defer></script>

    <!-- Styles -->
    <style>
        /* Custom Styles */
        body {
            font-family: 'Tajawal', sans-serif;
        }
        
        /* Animations */
        @keyframes fade-in-up {
            from {
                opacity: 0;
                transform: translateY(30px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
        
        .fade-in-up {
            animation: fade-in-up 0.6s ease-out forwards;
        }
        
        .animate-delay-100 { animation-delay: 0.1s; }
        .animate-delay-200 { animation-delay: 0.2s; }
        .animate-delay-300 { animation-delay: 0.3s; }
        .animate-delay-400 { animation-delay: 0.4s; }
        .animate-delay-500 { animation-delay: 0.5s; }
        
        /* Premium Shadow */
        .premium-shadow {
            box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.1), 0 10px 10px -5px rgba(0, 0, 0, 0.04);
        }
        
        /* Gradient Text */
        .gradient-text {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }
        
        /* Hero Gradient */
        .hero-gradient {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 50%, #f093fb 100%);
            position: relative;
            overflow: hidden;
        }
        
        .hero-gradient::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: rgba(0, 0, 0, 0.1);
            z-index: 1;
        }
        
        /* Floating Animation */
        @keyframes floating {
            0%, 100% { transform: translateY(0px); }
            50% { transform: translateY(-10px); }
        }
        
        .floating {
            animation: floating 3s ease-in-out infinite;
        }
        
        /* Line Clamp */
        .line-clamp-2 {
            display: -webkit-box;
            -webkit-line-clamp: 2;
            -webkit-box-orient: vertical;
            overflow: hidden;
        }
        
        .line-clamp-3 {
            display: -webkit-box;
            -webkit-line-clamp: 3;
            -webkit-box-orient: vertical;
            overflow: hidden;
        }
        
        /* RTL Support */
        .direction-rtl {
            direction: rtl;
        }
        
        /* Custom Button Styles */
        .btn-primary {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            padding: 12px 24px;
            border-radius: 12px;
            font-weight: 600;
            transition: all 0.3s ease;
            border: none;
            cursor: pointer;
        }
        
        .btn-primary:hover {
            transform: translateY(-2px);
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.2);
        }
        
        /* Responsive */
        @media (max-width: 640px) {
            .hero-gradient h1 {
                font-size: 2rem;
            }
            .search-box {
                padding: 1rem;
            }
        }
    </style>
</head>
<body class="bg-gray-50 direction-rtl">
    <div class="min-h-screen flex flex-col">
        <!-- Navigation -->
        <nav class="bg-white shadow-lg sticky top-0 z-50">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="flex justify-between h-16">
                    <div class="flex items-center">
                        <a href="{{ route('welcome') }}" class="flex items-center">
                            <x-application-logo class="block h-8 w-auto" />
                        </a>
                    </div>

                    <div class="hidden sm:flex sm:items-center sm:space-x-8 sm:space-x-reverse">
                        <!-- Navigation Links -->
                        <a href="{{ route('welcome') }}" class="text-gray-700 hover:text-indigo-600 px-3 py-2 rounded-md text-sm font-medium transition-colors">
                            الرئيسية
                        </a>
                        <a href="{{ route('jobs.index') }}" class="text-gray-700 hover:text-indigo-600 px-3 py-2 rounded-md text-sm font-medium transition-colors">
                            الوظائف
                        </a>
                        <a href="{{ route('companies.index') }}" class="text-gray-700 hover:text-indigo-600 px-3 py-2 rounded-md text-sm font-medium transition-colors">
                            الشركات
                        </a>
                        <a href="{{ route('articles.index') }}" class="text-gray-700 hover:text-indigo-600 px-3 py-2 rounded-md text-sm font-medium transition-colors">
                            المقالات
                        </a>
                        
                        <!-- Authenticated User Menu -->
                        @auth
                            <div class="relative" x-data="{ open: false }">
                                <button @click="open = !open" class="flex items-center text-sm rounded-full focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                                    <span class="sr-only">Open user menu</span>
                                    <div class="h-8 w-8 rounded-full bg-gradient-to-br from-indigo-500 to-purple-600 flex items-center justify-center">
                                        <span class="text-white text-sm font-bold">
                                            {{ substr(auth()->user()->name, 0, 1) }}
                                        </span>
                                    </div>
                                </button>

                                <div x-show="open" 
                                     x-transition:enter="transition ease-out duration-100"
                                     x-transition:enter-start="transform opacity-0 scale-95"
                                     x-transition:enter-end="transform opacity-100 scale-100"
                                     x-transition:leave="transition ease-in duration-75"
                                     x-transition:leave-start="transform opacity-100 scale-100"
                                     x-transition:leave-end="transform opacity-0 scale-95"
                                     @click.away="open = false"
                                     class="absolute right-0 z-10 mt-2 w-48 rounded-md shadow-lg bg-white ring-1 ring-black ring-opacity-5 focus:outline-none">
                                    <div class="py-1">
                                        <a href="{{ route('dashboard') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">
                                            لوحة التحكم
                                        </a>
                                        <a href="{{ route('profile.edit') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">
                                            الملف الشخصي
                                        </a>
                                        <form method="POST" action="{{ route('logout') }}" class="block">
                                            @csrf
                                            <button type="submit" class="w-full text-right px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">
                                                تسجيل الخروج
                                            </button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        @endauth
                    </div>

                    <!-- Mobile menu button -->
                    <div class="sm:hidden" x-data="{ open: false }">
                        <button @click="open = !open" class="inline-flex items-center justify-center p-2 rounded-md text-gray-700 hover:text-indigo-600 hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-inset focus:ring-indigo-500">
                            <span class="sr-only">Open main menu</span>
                            <svg class="h-6 w-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                            </svg>
                        </button>
                    </div>
                </div>

                <!-- Mobile menu -->
                <div class="sm:hidden" x-data="{ open: false }" x-show="open" x-transition:enter="transition ease-out duration-100" x-transition:enter-start="transform opacity-0 scale-95" x-transition:enter-end="transform opacity-100 scale-100" x-transition:leave="transition ease-in duration-75" x-transition:leave-start="transform opacity-100 scale-100" x-transition:leave-end="transform opacity-0 scale-95">
                    <div class="px-2 pt-2 pb-3 space-y-1">
                        <a href="{{ route('welcome') }}" class="block px-3 py-2 rounded-md text-base font-medium text-gray-700 hover:text-indigo-600 hover:bg-gray-50">
                            الرئيسية
                        </a>
                        <a href="{{ route('jobs.index') }}" class="block px-3 py-2 rounded-md text-base font-medium text-gray-700 hover:text-indigo-600 hover:bg-gray-50">
                            الوظائف
                        </a>
                        <a href="{{ route('companies.index') }}" class="block px-3 py-2 rounded-md text-base font-medium text-gray-700 hover:text-indigo-600 hover:bg-gray-50">
                            الشركات
                        </a>
                        <a href="{{ route('articles.index') }}" class="block px-3 py-2 rounded-md text-base font-medium text-gray-700 hover:text-indigo-600 hover:bg-gray-50">
                            المقالات
                        </a>
                        
                        @auth
                            <a href="{{ route('dashboard') }}" class="block px-3 py-2 rounded-md text-base font-medium text-gray-700 hover:text-indigo-600 hover:bg-gray-50">
                                لوحة التحكم
                            </a>
                            <a href="{{ route('profile.edit') }}" class="block px-3 py-2 rounded-md text-base font-medium text-gray-700 hover:text-indigo-600 hover:bg-gray-50">
                                الملف الشخصي
                            </a>
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <button type="submit" class="w-full text-right px-3 py-2 rounded-md text-base font-medium text-gray-700 hover:text-indigo-600 hover:bg-gray-50">
                                    تسجيل الخروج
                                </button>
                            </form>
                        @endauth
                    </div>
                </div>
            </div>
        </nav>

        <!-- Page Heading -->
        @hasSection('header')
            <header class="bg-white shadow-sm">
                <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                    {{ $header }}
                </div>
            </header>
        @endif

        <!-- Page Content -->
        <main class="flex-1">
            {{ $slot }}
        </main>
    </div>

    <!-- Footer -->
    <footer class="bg-gray-900 text-white">
        <div class="max-w-7xl mx-auto py-12 px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 md:grid-cols-4 gap-8">
                <!-- Company Info -->
                <div class="space-y-4">
                    <h3 class="text-lg font-bold">{{ config('app.name', 'Fursaana') }}</h3>
                    <p class="text-gray-300 text-sm leading-relaxed">
                        منصتك الأولى للبحث عن وظائف أحلامك في فلسطين والمنطقة
                    </p>
                    <div class="flex space-x-4 space-x-reverse">
                        <a href="#" class="text-gray-400 hover:text-white transition-colors">
                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12a11.96 11.96 0 007.757 11.785c.115.022.23.005.345.008a3.087 3.087 0 01-3.227-1.794 3.098 3.098 0 01-1.158-.295 1.083 1.083 0 01-.276-.285 1.041 1.041 0 01-.192-.047 3.054 3.054 0 01-2.516-1.194 3.157 3.157 0 01-.866-.318 3.07 3.07 0 01-2.12-.835 3.08 3.08 0 01-.577-.419c1.613.906 3.19 1.83 4.863 2.75-.447.062-.895.115-1.44.115-2.363 0-1.365-.565-2.593-1.834-3.176 1.452-.845 2.568-2.33 3.080-4.038.159.062.328.126.488.199h-.003c-.17.05-.347.1-.536.1-.335 0-.683-.235-1.27-.688-1.745s-1.41-.688-1.745-.688c-.336 0-.673.1-1.01.1-.335 0-.682.235-1.27.688-1.745h-.003c-.845 1.513-2.33 2.63-4.038 3.088.062.159.126.322.199.488.447.062.895.115 1.44.115 2.363 0 1.365-.565 2.593-1.834 3.176-1.452.845-2.568 2.33-3.08 4.038-.159-.062-.328-.126-.488-.199h-.003zm-3.5 5.847c0-.964-.262-1.829-.7-2.568h.003c.435-.837.7-1.782.7-2.568 0-1.513-.565-2.593-1.834-3.176-1.452-.845-2.568-2.33-3.08-4.038-.159.062-.328.126-.488.199h-.003c-.17.05-.347.1-.536.1-.335 0-.683-.235-1.27-.688-1.745s-1.41-.688-1.745-.688c-.336 0-.673.1-1.01.1-.335 0-.682.235-1.27.688-1.745h-.003c-.845 1.513-2.33 2.63-4.038 3.088.062.159.126.322.199.488.447.062.895.115 1.44.115 2.363 0 1.365-.565 2.593-1.834 3.176-1.452.845-2.568 2.33-3.08 4.038-.159-.062-.328-.126-.488-.199h-.003z"/>
                            </svg>
                        </a>
                        <a href="#" class="text-gray-400 hover:text-white transition-colors">
                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M12.315 2c2.43 0 2.784.013 3.808.06 1.064.049 1.791.218 2.427.465 1.348.268 2.29.598 3.174.916.56.097 1.347.268 1.977.48l1.598 1.598c.289.289.29.767.29 1.06 0l2.616-2.616c.376-.375.49-.897.49-1.419 0-.527-.124-1.032-.49-1.41l-1.582-1.583c-.416-.416-.902-.49-1.423-.49-.523 0-1.008.074-1.424.49l-1.598 1.598c-.289.289-.29.767-.29 1.06 0l-2.616 2.616c-.376.375-.49.897-.49 1.419 0 .527.124 1.032.49 1.41l1.582 1.583c.416.416.902.49 1.423.49.523 0 1.008-.074 1.424-.49l1.598-1.598c.289-.289.29-.767.29-1.06 0zm-10.686 8.598c-.523 0-1.008-.074-1.424-.49l-1.598-1.583c-.416-.416-.902-.49-1.423-.49-.523 0-1.008.074-1.424.49l-1.598 1.583c-.289.289-.29.767-.29 1.06 0l2.616 2.616c.376.375.49.897.49 1.419 0 .527-.124 1.032-.49 1.41l-1.582 1.583c-.416.416-.902.49-1.423.49-.523 0-1.008-.074-1.424-.49l-1.598-1.583c-.289-.289-.29-.767-.29-1.06 0l2.616-2.616c.376-.375.49-.897.49-1.419 0-.527-.124-1.032-.49-1.41l-1.582-1.583c-.416-.416-.902-.49-1.423-.49-.523 0-1.008.074-1.424.49l-1.598 1.583c-.289.289-.29.767-.29 1.06 0z"/>
                            </svg>
                        </a>
                        <a href="#" class="text-gray-400 hover:text-white transition-colors">
                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M12 2.163c3.204 0 3.584.012 4.85.07 3.252.262 6.132 1.004 8.25 1.004 2.416 0 4.998-.742 6.847-2.32 3.51 3.48 8.025 5.848 13.653 5.848 1.082 0 2.15-.218 3.12-.64.328.13.64.362 1.021.362 2.167 0 2.79-.218 4.008-.648 3.75-3.02 6.847-5.82 9.245-7.17.213-.179.425-.72.425-1.163.425-2.713 0-5.221-4.258-9.455-9.455-9.455-5.204 0-9.455 4.258-9.455 9.455 0 1.101.386 2.175.822 3.14 1.425.665-1.025 1.39-1.62 2.202-2.134.963-.396 2.017-.793 2.88-1.175.345.232.67.473 1.068.473 1.841 0 3.244-.722 4.361-1.75 2.082-1.113 2.452-2.516 2.452-4.486 0-.348-.076-.705-.226-1.034zm1.76 16.28c-1.6 0-2.895-.667-2.895-1.492 0-.825.295-1.492 2.895-1.492 1.6 0 2.895.667 2.895 1.492 0 .825-.295 1.492-2.895 1.492z"/>
                            </svg>
                        </a>
                    </div>
                </div>

                <!-- Quick Links -->
                <div>
                    <h3 class="text-lg font-bold mb-4">روابط سريعة</h3>
                    <ul class="space-y-2">
                        <li>
                            <a href="{{ route('jobs.index') }}" class="text-gray-300 hover:text-white transition-colors">
                                البحث عن وظائف
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('companies.index') }}" class="text-gray-300 hover:text-white transition-colors">
                                الشركات
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('articles.index') }}" class="text-gray-300 hover:text-white transition-colors">
                                المقالات
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('dashboard') }}" class="text-gray-300 hover:text-white transition-colors">
                                لوحة التحكم
                            </a>
                        </li>
                    </ul>
                </div>

                <!-- Support -->
                <div>
                    <h3 class="text-lg font-bold mb-4">الدعم</h3>
                    <ul class="space-y-2">
                        <li>
                            <a href="#" class="text-gray-300 hover:text-white transition-colors">
                                مركز المساعدة
                            </a>
                        </li>
                        <li>
                            <a href="#" class="text-gray-300 hover:text-white transition-colors">
                                اتصل بنا
                            </a>
                        </li>
                        <li>
                            <a href="#" class="text-gray-300 hover:text-white transition-colors">
                                الشروط والأحكام
                            </a>
                        </li>
                        <li>
                            <a href="#" class="text-gray-300 hover:text-white transition-colors">
                                سياسة الخصوصية
                            </a>
                        </li>
                    </ul>
                </div>

                <!-- Contact -->
                <div>
                    <h3 class="text-lg font-bold mb-4">تواصل معنا</h3>
                    <ul class="space-y-2">
                        <li class="flex items-center text-gray-300 hover:text-white transition-colors">
                            <svg class="w-4 h-4 ml-3 text-red-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
                            </svg>
                            <span>info@fursaana.com</span>
                        </li>
                        <li class="flex items-center text-gray-300 hover:text-white transition-colors">
                            <svg class="w-4 h-4 ml-3 text-green-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502.874l-1.498-4.493A1 1 0 008.28 3H6a2 2 0 00-2 2v14a2 2 0 002 2h12a2 2 0 002-2V5a2 2 0 00-2-2z"></path>
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8"></path>
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 19v5m0 0a2 2 0 01-2 2h-4a2 2 0 01-2-2v-5m8 0v5a2 2 0 01-2 2h-4a2 2 0 01-2-2v-5"></path>
                            </svg>
                            <span dir="ltr">+972 597 481 907</span>
                        </li>
                        <li class="flex items-center text-gray-300 hover:text-white transition-colors">
                            <svg class="w-4 h-4 ml-3 text-red-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path>
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                            </svg>
                            <span>فلسطين</span>
                        </li>
                    </ul>
                </div>
            </div>
            
            <!-- Copyright -->
            <div class="mt-16 pt-8 border-t border-gray-700">
                <div class="flex flex-col md:flex-row justify-between items-center space-y-4 md:space-y-0">
                    <div class="flex items-center space-x-4 space-x-reverse">
                        <span class="text-gray-400 text-sm">
                            &copy; {{ date('Y') }} 
                        </span>
                        <span class="text-white font-semibold">
                            {{ config('app.name', 'Fursaana') }}
                        </span>
                        <span class="text-gray-400 text-sm">
                            - جميع الحقوق محفوظة.
                        </span>
                    </div>
                    <div class="flex items-center space-x-4 space-x-reverse">
                        <span class="text-gray-400 text-sm">
                        </span>
                    </div>
                </div>
            </div>
        </div>
    </footer>
</body>
</html>
