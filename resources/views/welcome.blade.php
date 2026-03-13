<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" dir="rtl">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="{{ config('app.name', 'Fursaana') }} - منصة التوظيف الرائدة في العالم العربي">

    <title>{{ config('app.name', 'Fursaana') }} - اكتشف فرصتك المهنية</title>

    <!-- Favicon -->
    <link rel="icon" href="{{ asset('favicon.ico') }}">

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=tajawal:400,500,700,900" rel="stylesheet" />

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
        /* Hero Section */
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
            background: url('data:image/svg+xml,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1440 320"><path fill="%23ffffff" fill-opacity="0.1" d="M0,96L48,112C96,128,192,160,288,160C384,160,480,128,576,122.7C672,117,768,139,864,133.3C960,128,1056,96,1152,90.7C1248,85,1344,107,1392,117.3L1440,128L1440,320L1392,320C1344,320,1248,320,1152,320C1056,320,960,320,864,320C768,320,672,320,576,320C480,320,384,320,288,320C192,320,96,320,48,320L0,320Z"></path></svg>') no-repeat bottom;
            background-size: cover;
        }
        
        /* Animations */
        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(30px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
        
        @keyframes slideInRight {
            from {
                opacity: 0;
                transform: translateX(30px);
            }
            to {
                opacity: 1;
                transform: translateX(0);
            }
        }
        
        @keyframes pulse {
            0%, 100% {
                transform: scale(1);
            }
            50% {
                transform: scale(1.05);
            }
        }
        
        .fade-in-up {
            animation: fadeInUp 0.8s ease-out;
        }
        
        .slide-in-right {
            animation: slideInRight 0.8s ease-out;
        }
        
        .animate-delay-200 {
            animation-delay: 0.2s;
        }
        
        .animate-delay-400 {
            animation-delay: 0.4s;
        }
        
        /* Cards */
        .feature-card {
            transition: all 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275);
            background: linear-gradient(145deg, #ffffff, #f8fafc);
            border: 1px solid rgba(255, 255, 255, 0.18);
            box-shadow: 0 8px 32px 0 rgba(31, 38, 135, 0.1);
        }
        .feature-card:hover {
            transform: translateY(-8px) scale(1.02);
            box-shadow: 0 25px 50px rgba(102, 126, 234, 0.25);
            background: linear-gradient(145deg, #ffffff, #f1f5f9);
        }
        
        .category-card {
            transition: all 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275);
            background: linear-gradient(145deg, #ffffff, #f3f4f6);
            border: 1px solid rgba(255, 255, 255, 0.18);
            box-shadow: 0 8px 32px 0 rgba(31, 38, 135, 0.15);
        }
        .category-card:hover {
            transform: translateY(-8px) scale(1.02);
            box-shadow: 0 20px 40px rgba(102, 126, 234, 0.3);
            background: linear-gradient(145deg, #ffffff, #e5e7eb);
        }
        
        .job-card {
            transition: all 0.3s ease;
            border: 1px solid #e5e7eb;
            background: #ffffff;
        }
        .job-card:hover {
            transform: translateY(-4px);
            box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.1), 0 10px 10px -5px rgba(0, 0, 0, 0.04);
            border-color: #6366f1;
        }
        
        .company-card {
            transition: all 0.3s ease;
            border: 1px solid #e5e7eb;
            background: #ffffff;
        }
        .company-card:hover {
            transform: translateY(-4px);
            box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.1), 0 10px 10px -5px rgba(0, 0, 0, 0.04);
            border-color: #6366f1;
        }
        
        /* Typography */
        body {
            font-family: 'Tajawal', sans-serif;
        }
        
        /* Search Box */
        .search-box {
            background: rgba(255, 255, 255, 0.98);
            backdrop-filter: blur(20px);
            border: 1px solid rgba(255, 255, 255, 0.3);
            box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.25);
            transition: all 0.3s ease;
        }
        .search-box:hover {
            box-shadow: 0 30px 60px -12px rgba(0, 0, 0, 0.3);
        }
        
        /* Glass Effect */
        .glass-effect {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(10px);
            border: 1px solid rgba(255, 255, 255, 0.2);
        }
        
        /* Floating Animation */
        .floating {
            animation: float 6s ease-in-out infinite;
        }
        @keyframes float {
            0%, 100% { transform: translateY(0px); }
            50% { transform: translateY(-20px); }
        }
        
        /* Gradient Text */
        .gradient-text {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 50%, #f093fb 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }
        
        /* Premium Shadow */
        .premium-shadow {
            box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.25);
        }
        
        /* Buttons */
        .btn-primary {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            transition: all 0.3s ease;
            box-shadow: 0 4px 15px rgba(102, 126, 234, 0.4);
        }
        .btn-primary:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 25px rgba(102, 126, 234, 0.6);
        }
        
        /* Stats Cards */
        .stat-card {
            background: linear-gradient(145deg, #ffffff, #f8fafc);
            border: 1px solid rgba(255, 255, 255, 0.18);
            box-shadow: 0 8px 32px 0 rgba(31, 38, 135, 0.1);
            transition: all 0.3s ease;
        }
        .stat-card:hover {
            transform: translateY(-4px);
            box-shadow: 0 20px 40px rgba(102, 126, 234, 0.2);
        }
        
        /* Responsive */
        @media (max-width: 640px) {
            .hero-gradient h1 {
                font-size: 2rem;
            }
            .search-box {
                margin: 0 1rem;
            }
        }
    </style>
</head>
<body class="font-sans antialiased bg-gray-50 h-full">
    <!-- Navigation -->
    <nav class="glass-effect sticky top-0 z-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between h-16">
                <div class="flex items-center">
                    <div class="flex-shrink-0 flex items-center">
                        <span class="text-2xl font-black gradient-text">{{ config('app.name', 'Fursaana') }}</span>
                    </div>
                </div>
                <div class="hidden sm:ml-6 sm:flex sm:items-center space-x-4">
                    @if (Route::has('login'))
                        @auth
                            <a href="{{ url('/dashboard') }}" class="px-4 py-2 rounded-full text-sm font-medium text-gray-700 hover:text-indigo-600 transition-colors duration-300">لوحة التحكم</a>
                        @else
                            <a href="{{ route('login') }}" class="px-4 py-2 rounded-full text-sm font-medium text-gray-700 hover:text-indigo-600 transition-colors duration-300">تسجيل الدخول</a>
                            @if (Route::has('register'))
                                <a href="{{ route('register') }}" class="ml-4 px-6 py-2 rounded-full shadow-lg text-sm font-medium text-white bg-gradient-to-r from-indigo-600 to-purple-600 hover:from-indigo-700 hover:to-purple-700 transform hover:scale-105 transition-all duration-300">
                                    إنشاء حساب
                                </a>
                            @endif
                        @endauth
                    @endif
                </div>
            </div>
        </div>
    </nav>

    <!-- Hero Section -->
    <div class="hero-gradient text-white relative">
        <div class="max-w-7xl mx-auto px-4 py-24 sm:px-6 lg:px-8 relative z-10">
            <div class="text-center fade-in-up">
                <h1 class="text-5xl md:text-6xl lg:text-7xl font-black tracking-tight floating mb-8">
                    اكتشف فرصتك <span class="text-yellow-300">المهنية</span> اليوم
                </h1>
                <p class="mt-6 max-w-3xl mx-auto text-xl md:text-2xl text-white/90 leading-relaxed animate-delay-200">
                    تواصل مع أفضل أصحاب العمل واكتشف آلاف الفرص الوظيفية التي تناسب مهاراتك وخبراتك في العالم العربي
                </p>
                <div class="mt-12 flex flex-col sm:flex-row justify-center gap-4 animate-delay-400">
                    <a href="{{ route('register') }}" class="group px-8 py-4 bg-white text-indigo-600 rounded-full font-bold text-lg shadow-2xl hover:shadow-3xl transform hover:scale-105 transition-all duration-300 flex items-center justify-center btn-primary">
                        <span style="color:white">ابدأ الآن</span>
                        <svg style="color:white" class="w-5 h-5 mr-2 transform group-hover:-translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 17L17 7M17 7H7M17 7V17"></path>
                        </svg>
                    </a>
                    <a href="#features" class="px-8 py-4 bg-white/20 backdrop-blur-sm text-white rounded-full font-bold text-lg border-2 border-white/30 hover:bg-white/30 transform hover:scale-105 transition-all duration-300 flex items-center justify-center">
                        تعرف المزيد
                    </a>
                </div>
                
                <!-- Search Box -->
                <div class="mt-16 search-box rounded-2xl p-8 max-w-5xl mx-auto premium-shadow slide-in-right">
                    <h3 class="text-3xl font-bold text-gray-800 mb-8 text-center">ابحث عن وظيفتك المثالية</h3>
                    <div class="grid grid-cols-1 md:grid-cols-4 gap-4">
                        <input type="text" placeholder="المسمى الوظيفي أو الكلمة المفتاحية" class="col-span-1 md:col-span-2 px-6 py-4 border-2 border-gray-200 rounded-xl text-gray-700 focus:outline-none focus:border-indigo-500 focus:ring-2 focus:ring-indigo-200 transition-all text-lg">
                        <select class="px-6 py-4 border-2 border-gray-200 rounded-xl text-gray-700 focus:outline-none focus:border-indigo-500 focus:ring-2 focus:ring-indigo-200 transition-all text-lg">
                            <option>جميع المدن</option>
                            <option>الرياض</option>
                            <option>جدة</option>
                            <option>الدمام</option>
                            <option>القاهرة</option>
                            <option>دبي</option>
                            <option>عمان</option>
                        </select>
                        <button class="px-8 py-4 bg-gradient-to-r from-indigo-600 to-purple-600 text-white rounded-xl font-bold text-lg hover:from-indigo-700 hover:to-purple-700 transform hover:scale-105 transition-all duration-300 shadow-lg btn-primary">
                            بحث
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Categories Section -->
    <div class="py-20 bg-gradient-to-br from-gray-50 to-gray-100">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="lg:text-center mb-16 fade-in-up">
                <h2 class="text-lg font-bold gradient-text uppercase tracking-wider">التصنيفات</h2>
                <p class="mt-4 text-4xl md:text-5xl font-black text-gray-900">
                    استكشف الوظائف حسب <span class="text-indigo-600">المجال</span>
                </p>
                <p class="mt-6 max-w-3xl text-xl text-gray-600 lg:mx-auto leading-relaxed">
                    اختر من بين آلاف الوظائف في مختلف المجالات والقطاعات الرائدة
                </p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
                <div class="category-card group p-8 rounded-2xl text-center fade-in-up animate-delay-200">
                    <div class="text-5xl mb-4 group-hover:scale-110 transition-transform duration-300">💻</div>
                    <h3 class="text-xl font-bold text-gray-900 group-hover:text-indigo-600 transition-colors">تقنية المعلومات</h3>
                    <p class="text-lg text-gray-600 mt-2 font-medium">1,234 وظيفة</p>
                </div>
                <div class="category-card group p-8 rounded-2xl text-center fade-in-up animate-delay-300">
                    <div class="text-5xl mb-4 group-hover:scale-110 transition-transform duration-300">📈</div>
                    <h3 class="text-xl font-bold text-gray-900 group-hover:text-indigo-600 transition-colors">التسويق</h3>
                    <p class="text-lg text-gray-600 mt-2 font-medium">856 وظيفة</p>
                </div>
                <div class="category-card group p-8 rounded-2xl text-center fade-in-up animate-delay-400">
                    <div class="text-5xl mb-4 group-hover:scale-110 transition-transform duration-300">💰</div>
                    <h3 class="text-xl font-bold text-gray-900 group-hover:text-indigo-600 transition-colors">المالية</h3>
                    <p class="text-lg text-gray-600 mt-2 font-medium">642 وظيفة</p>
                </div>
                <div class="category-card group p-8 rounded-2xl text-center fade-in-up animate-delay-500">
                    <div class="text-5xl mb-4 group-hover:scale-110 transition-transform duration-300">🏥</div>
                    <h3 class="text-xl font-bold text-gray-900 group-hover:text-indigo-600 transition-colors">الصحة</h3>
                    <p class="text-lg text-gray-600 mt-2 font-medium">423 وظيفة</p>
                </div>
                <div class="category-card group p-8 rounded-2xl text-center fade-in-up animate-delay-600">
                    <div class="text-5xl mb-4 group-hover:scale-110 transition-transform duration-300">🎓</div>
                    <h3 class="text-xl font-bold text-gray-900 group-hover:text-indigo-600 transition-colors">التعليم</h3>
                    <p class="text-lg text-gray-600 mt-2 font-medium">789 وظيفة</p>
                </div>
                <div class="category-card group p-8 rounded-2xl text-center fade-in-up animate-delay-700">
                    <div class="text-5xl mb-4 group-hover:scale-110 transition-transform duration-300">🏭</div>
                    <h3 class="text-xl font-bold text-gray-900 group-hover:text-indigo-600 transition-colors">التصنيع</h3>
                    <p class="text-lg text-gray-600 mt-2 font-medium">367 وظيفة</p>
                </div>
                <div class="category-card group p-8 rounded-2xl text-center fade-in-up animate-delay-800">
                    <div class="text-5xl mb-4 group-hover:scale-110 transition-transform duration-300">🛍️</div>
                    <h3 class="text-xl font-bold text-gray-900 group-hover:text-indigo-600 transition-colors">المبيعات</h3>
                    <p class="text-lg text-gray-600 mt-2 font-medium">945 وظيفة</p>
                </div>
                <div class="category-card group p-8 rounded-2xl text-center fade-in-up animate-delay-900">
                    <div class="text-5xl mb-4 group-hover:scale-110 transition-transform duration-300">🎨</div>
                    <h3 class="text-xl font-bold text-gray-900 group-hover:text-indigo-600 transition-colors">التصميم</h3>
                    <p class="text-lg text-gray-600 mt-2 font-medium">521 وظيفة</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Features Section -->
    <div id="features" class="py-20 bg-gradient-to-br from-white to-gray-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="lg:text-center mb-16 fade-in-up">
                <h2 class="text-lg font-bold gradient-text uppercase tracking-wider">المميزات</h2>
                <p class="mt-4 text-4xl md:text-5xl font-black text-gray-900">
                    لماذا تختار <span class="text-indigo-600">{{ config('app.name', 'Fursaana') }}</span>؟
                </p>
                <p class="mt-6 max-w-3xl text-xl text-gray-600 lg:mx-auto leading-relaxed">
                    منصة متكاملة توفر لك كل ما تحتاجه للعثور على وظيفة أحلامك
                </p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                <div class="feature-card bg-white p-8 rounded-2xl shadow-lg hover:shadow-2xl text-right fade-in-up animate-delay-200">
                    <div class="w-16 h-16 rounded-2xl bg-gradient-to-br from-indigo-500 to-purple-600 flex items-center justify-center mb-6 shadow-lg">
                        <span class="text-3xl">🎯</span>
                    </div>
                    <h3 class="text-2xl font-bold text-gray-900 mb-4">وظائف مخصصة</h3>
                    <p class="text-lg text-gray-600 leading-relaxed">نظام ذكي يوصي بالوظائف المناسبة بناءً على مهاراتك وخبراتك</p>
                </div>

                <div class="feature-card bg-white p-8 rounded-2xl shadow-lg hover:shadow-2xl text-right fade-in-up animate-delay-300">
                    <div class="w-16 h-16 rounded-2xl bg-gradient-to-br from-indigo-500 to-purple-600 flex items-center justify-center mb-6 shadow-lg">
                        <span class="text-3xl">🏢</span>
                    </div>
                    <h3 class="text-2xl font-bold text-gray-900 mb-4">شركات موثوقة</h3>
                    <p class="text-lg text-gray-600 leading-relaxed">انضم إلى آلاف الشركات الرائدة التي تبحث عن المواهب العربية</p>
                </div>

                <div class="feature-card bg-white p-8 rounded-2xl shadow-lg hover:shadow-2xl text-right fade-in-up animate-delay-400">
                    <div class="w-16 h-16 rounded-2xl bg-gradient-to-br from-indigo-500 to-purple-600 flex items-center justify-center mb-6 shadow-lg">
                        <span class="text-3xl">📱</span>
                    </div>
                    <h3 class="text-2xl font-bold text-gray-900 mb-4">سهولة الاستخدام</h3>
                    <p class="text-lg text-gray-600 leading-relaxed">واجهة بسيطة وسهلة الاستخدام مصممة خصيصاً للسوق العربي</p>
                </div>

                <div class="feature-card bg-white p-8 rounded-2xl shadow-lg hover:shadow-2xl text-right fade-in-up animate-delay-500">
                    <div class="w-16 h-16 rounded-2xl bg-gradient-to-br from-indigo-500 to-purple-600 flex items-center justify-center mb-6 shadow-lg">
                        <span class="text-3xl">🔍</span>
                    </div>
                    <h3 class="text-2xl font-bold text-gray-900 mb-4">بحث متقدم</h3>
                    <p class="text-lg text-gray-600 leading-relaxed">أدوات بحث قوية تساعدك على العثور على الوظيفة المثالية بسهولة</p>
                </div>

                <div class="feature-card bg-white p-8 rounded-2xl shadow-lg hover:shadow-2xl text-right fade-in-up animate-delay-600">
                    <div class="w-16 h-16 rounded-2xl bg-gradient-to-br from-indigo-500 to-purple-600 flex items-center justify-center mb-6 shadow-lg">
                        <span class="text-3xl">📊</span>
                    </div>
                    <h3 class="text-2xl font-bold text-gray-900 mb-4">تحليلات احترافية</h3>
                    <p class="text-lg text-gray-600 leading-relaxed">تقارير مفصلة عن سوق العمل والراتب في مختلف القطاعات</p>
                </div>

                <div class="feature-card bg-white p-8 rounded-2xl shadow-lg hover:shadow-2xl text-right fade-in-up animate-delay-700">
                    <div class="w-16 h-16 rounded-2xl bg-gradient-to-br from-indigo-500 to-purple-600 flex items-center justify-center mb-6 shadow-lg">
                        <span class="text-3xl">🤝</span>
                    </div>
                    <h3 class="text-2xl font-bold text-gray-900 mb-4">دعم مباشر</h3>
                    <p class="text-lg text-gray-600 leading-relaxed">فريق دعم متخصص لمساعدتك في كل خطوة من رحلتك المهنية</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Stats Section -->
    <div class="hero-gradient text-white relative overflow-hidden">
        <div class="max-w-7xl mx-auto px-4 py-20 sm:px-6 lg:px-8 relative z-10" >
            <div class="text-center mb-16 fade-in-up">
                <h2 class="text-4xl md:text-5xl font-black tracking-tight mb-6">
                    أرقامنا <span class="text-yellow-300">الحقيقية</span> عنا
                </h2>
                <p class="text-xl md:text-2xl text-white/90 leading-relaxed max-w-3xl mx-auto">
                    انضم إلى آلاف المستخدمين الذين وجدوا وظائف أحلامهم من خلال منصتنا
                </p>
            </div>
            <div class="grid grid-cols-2 gap-8 md:grid-cols-4">
                <div class="stat-card text-center p-6 rounded-2xl bg-white shadow-lg hover:shadow-2xl hover:-translate-y-2 transition duration-300 fade-in-up animate-delay-200">
                    <div class="text-4xl md:text-5xl font-black mb-2 text-blue-600 counter" data-target="">{{ App\Models\User::count() }}</div>
                    <div class="text-lg md:text-xl font-medium text-gray-600">مستخدم</div>
                </div>

                <div class="stat-card text-center p-6 rounded-2xl bg-white shadow-lg hover:shadow-2xl hover:-translate-y-2 transition duration-300 fade-in-up animate-delay-300">
                    <div class="text-4xl md:text-5xl font-black mb-2 text-purple-600 counter" data-target="">{{ App\Models\Company::count() }}</div>
                    <div class="text-lg md:text-xl font-medium text-gray-600">شركة</div>
                </div>

                <div class="stat-card text-center p-6 rounded-2xl bg-white shadow-lg hover:shadow-2xl hover:-translate-y-2 transition duration-300 fade-in-up animate-delay-400">
                    <div class="text-4xl md:text-5xl font-black mb-2 text-green-600 counter" data-target="">{{ App\Models\Job::count() }}0</div>
                    <div class="text-lg md:text-xl font-medium text-gray-600">وظيفة</div>
                </div>
                @php 
                    $totalApplications = \App\Models\Application::count();
                    $acceptedApplications = \App\Models\Application::where('status', 'accepted')->count();
                    $successRate = $totalApplications > 0 ? round(($acceptedApplications / $totalApplications) * 100, 1) : 0;
                @endphp
                <div class="stat-card text-center p-6 rounded-2xl bg-white shadow-lg hover:shadow-2xl hover:-translate-y-2 transition duration-300 fade-in-up animate-delay-500">
                    <div class="text-4xl md:text-5xl font-black mb-2 text-orange-500 counter" data-target="">{{$successRate}}</div>
                    <div class="text-lg md:text-xl font-medium text-gray-600">معدل النجاح</div>
                </div>
            </div>
        </div>
    </div>

    <!-- Featured Jobs Section -->
    <div class="py-20 bg-gradient-to-br from-gray-50 to-gray-100">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="lg:text-center mb-16 fade-in-up">
                <h2 class="text-lg font-bold gradient-text uppercase tracking-wider">وظائف مميزة</h2>
                <p class="mt-4 text-4xl md:text-5xl font-black text-gray-900">
                    اكتشف أفضل <span class="text-indigo-600">الفرص المتاحة</span>
                </p>
                <p class="mt-6 max-w-3xl text-xl text-gray-600 lg:mx-auto leading-relaxed">
                    وظائف مختارة بعناية من أفضل الشركات في المنطقة
                </p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                @php
                    $featuredJobs = App\Models\Job::with('company')->active()->latest()->take(6)->get();
                @endphp
                
                @foreach($featuredJobs as $job)
                    <div class="job-card bg-white rounded-2xl shadow-lg hover:shadow-2xl transition-all duration-300 overflow-hidden group fade-in-up">
                        <!-- Job Header -->
                        <div class="bg-gradient-to-r from-indigo-500 to-purple-600 p-6 text-white">
                            <div class="flex justify-between items-start">
                                <div>
                                    <h3 class="text-xl font-bold mb-2 group-hover:text-yellow-300 transition-colors">
                                        {{ Str::limit($job->title, 40) }}
                                    </h3>
                                    <div class="flex items-center text-white/80 text-sm">
                                        <svg class="w-4 h-4 ml-2" fill="currentColor" viewBox="0 0 20 20">
                                            <path fill-rule="evenodd" d="M5.05 4.05a7 7 0 119.9 9.9L10 18.9l-4.95-4.95a7 7 0 010-9.9zM10 11a2 2 0 100-4 2 2 0 000 4z" clip-rule="evenodd" />
                                        </svg>
                                        {{ $job->location }}
                                    </div>
                                </div>
                                <div class="text-right">
                                    <span class="bg-white/20 backdrop-blur-sm px-3 py-1 rounded-full text-sm font-medium">
                                        {{ $job->getTypeArabicAttribute() }}
                                    </span>
                                </div>
                            </div>
                        </div>
                        
                        <!-- Job Content -->
                        <div class="p-6">
                            <div class="mb-4">
                                <p class="text-gray-600 leading-relaxed">
                                    {{ Str::limit(strip_tags($job->description), 120) }}
                                </p>
                            </div>
                            
                            <div class="flex justify-between items-center mb-4">
                                <div class="text-2xl font-bold text-indigo-600">
                                    {{ number_format($job->salary_min) }} - {{ number_format($job->salary_max) }}
                                    <span class="text-sm text-gray-500 font-normal" style="color: #4f46e5; font-size:20px">$</span>
                                </div>
                                @if($job->company)
                                    <div class="text-sm text-gray-500">
                                        <span class="font-medium">{{ $job->company->name }}</span>
                                    </div>
                                @endif
                            </div>
                            
                            <div class="flex justify-between items-center">
                                <div class="text-sm text-gray-500">
                                    <svg class="w-4 h-4 ml-1 inline" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M6 2a1 1 0 00-1 1v1H4a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V6a2 2 0 00-2-2h-1V3a1 1 0 10-2 0v1H7V3a1 1 0 00-1-1zm0 5a1 1 0 000 2h8a1 1 0 100-2H6z" clip-rule="evenodd" />
                                    </svg>
                                    @if($job->deadline)
                                        {{ \Carbon\Carbon::parse($job->deadline)->diffForHumans() }}
                                    @else
                                        مفتوح
                                    @endif
                                </div>
                                <a href="{{ route('jobs.show', $job->slug) }}" 
                                   class="bg-gradient-to-r from-indigo-600 to-purple-600 text-white px-6 py-2 rounded-full font-medium hover:from-indigo-700 hover:to-purple-700 transform hover:scale-105 transition-all duration-300 btn-primary">
                                    التفاصيل
                                </a>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
            
            <div class="text-center mt-12">
                <a href="{{ route('jobs.index') }}" 
                   class="inline-flex items-center px-8 py-4 bg-gradient-to-r from-indigo-600 to-purple-600 text-white rounded-full font-bold text-lg hover:from-indigo-700 hover:to-purple-700 transform hover:scale-105 transition-all duration-300 shadow-xl">
                    <span>عرض جميع الوظائف</span>
                    <svg class="w-5 h-5 mr-2 transform group-hover:-translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 17L17 7M17 7H7M17 7V17"></path>
                    </svg>
                </a>
            </div>
        </div>
    </div>

    <!-- Featured Companies Section -->
    <div class="py-20 bg-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="lg:text-center mb-16 fade-in-up">
                <h2 class="text-lg font-bold gradient-text uppercase tracking-wider">شركات رائدة</h2>
                <p class="mt-4 text-4xl md:text-5xl font-black text-gray-900">
                    انضم إلى <span class="text-indigo-600">أفضل الشركات</span>
                </p>
                <p class="mt-6 max-w-3xl text-xl text-gray-600 lg:mx-auto leading-relaxed">
                    اعمل مع أشهر الشركات في المنطقة العربية
                </p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                @php
                    $featuredCompanies = App\Models\Company::with('user')->latest()->take(6)->get();
                @endphp
                
                @foreach($featuredCompanies as $company)
                    <div class="company-card bg-white rounded-2xl shadow-lg hover:shadow-2xl transition-all duration-300 overflow-hidden group border border-gray-100 fade-in-up">
                        <!-- Company Header -->
                        <div class="bg-gradient-to-r from-gray-50 to-gray-100 p-6 border-b border-gray-100">
                            <div class="flex justify-between items-start">
                                <div>
                                    <h3 class="text-xl font-bold text-gray-900 mb-2 group-hover:text-indigo-600 transition-colors">
                                        {{ $company->name }}
                                    </h3>
                                    @if($company->website)
                                        <a href="{{ $company->website }}" target="_blank" 
                                           class="text-indigo-600 hover:text-indigo-700 text-sm font-medium transition-colors">
                                            <svg class="w-4 h-4 inline ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"></path>
                                            </svg>
                                            زيارة الموقع
                                        </a>
                                    @endif
                                </div>
                                <div class="text-right">
                                    <span class="bg-indigo-100 text-indigo-600 px-3 py-1 rounded-full text-sm font-medium">
                                        شركة موثوقة
                                    </span>
                                </div>
                            </div>
                        </div>
                        
                        <!-- Company Content -->
                        <div class="p-6">
                            <div class="mb-4">
                                <p class="text-gray-600 leading-relaxed">
                                    {{ Str::limit($company->description, 100) }}
                                </p>
                            </div>
                            
                            <div class="flex justify-between items-center mb-4">
                                <div class="text-sm text-gray-500">
                                    <svg class="w-4 h-4 inline ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                                    </svg>
                                    {{ $company->user->name }}
                                </div>
                                @if($company->jobs_count ?? 0)
                                    <div class="text-sm text-gray-500">
                                        <svg class="w-4 h-4 inline ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
                                        </svg>
                                        {{ $company->jobs_count }} وظيفة
                                    </div>
                                @endif
                            </div>
                            
                            <div class="text-center">
                                <a href="{{ route('companies.show', $company->id) }}" 
                                   class="bg-gradient-to-r from-indigo-600 to-purple-600 text-white px-6 py-2 rounded-full font-medium hover:from-indigo-700 hover:to-purple-700 transform hover:scale-105 transition-all duration-300 btn-primary">
                                    عرض الوظائف
                                </a>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
            
            <div class="text-center mt-12">
                <a href="{{ route('companies.index') }}" 
                   class="inline-flex items-center px-8 py-4 bg-gradient-to-r from-indigo-600 to-purple-600 text-white rounded-full font-bold text-lg hover:from-indigo-700 hover:to-purple-700 transform hover:scale-105 transition-all duration-300 shadow-xl btn-primary">
                    <span>عرض جميع الشركات</span>
                    <svg class="w-5 h-5 mr-2 transform group-hover:-translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 17L17 7M17 7H7M17 7V17"></path>
                    </svg>
                </a>
            </div>
        </div>
    </div>

    <!-- Footer -->
    <footer class="bg-gradient-to-br from-gray-900 via-gray-800 to-gray-900 text-white mt-auto">
        <div class="max-w-7xl mx-auto py-16 px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8">
                <!-- عن المنصة -->
                <div class="space-y-4 fade-in-up">
                    <h3 class="text-xl font-bold mb-6 text-transparent bg-clip-text bg-gradient-to-r from-blue-400 to-indigo-400">
                        <svg class="w-5 h-5 inline ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path>
                        </svg>
                        عن المنصة
                    </h3>
                    <p class="text-gray-300 leading-relaxed">
                        منصة عربية متكاملة تجمع بين أصحاب العمل والباحثين عن فرص عمل في مختلف المجالات والقطاعات.
                    </p>
                    <div class="flex space-x-4 space-x-reverse mt-6">
                        <a href="#" class="text-gray-400 hover:text-blue-400 transition-all duration-300 transform hover:scale-110">
                            <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M8.29 20.251c7.547 0 11.675-6.253 11.675-11.675 0-.178 0-.355-.012-.53A8.348 8.348 0 0022 5.92a8.19 8.19 0 01-2.357.646 4.118 4.118 0 00-1.767 1.226 8.224 8.224 0 01-2.605.996 4.117 4.117 0 00-1.789.49 11.654 11.654 0 006.29 2.274c-5.977 0-10.396-4.317-10.396-9.823 0-.213.002-.425.006-.637.014A4.118 4.118 0 014.292 15.813a7.977 7.977 0 01-2.215-.847 4.118 4.118 0 003.192 2.803 8.224 8.224 0 01-2.605.996 11.654 11.654 0 006.29 2.274c-5.977 0-10.396-4.317-10.396-9.823 0-.213.002-.425.006-.637.014z"/>
                            </svg>
                        </a>
                        <a href="#" class="text-gray-400 hover:text-blue-500 transition-all duration-300 transform hover:scale-110">
                            <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.47h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.47h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z"/>
                            </svg>
                        </a>
                        <a href="#" class="text-gray-400 hover:text-blue-600 transition-all duration-300 transform hover:scale-110">
                            <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M20.447 20.452h-3.554v-5.569c0-1.328-.027-3.037-1.852-3.037-1.853 0-2.136 1.445-2.136 2.939v5.667H9.351V9h3.414v1.561h.046c.477-.9 1.637-1.85 3.37-1.85 3.601 0 4.267 2.37 4.267 5.455v6.286zM5.337 7.433c-1.144 0-2.063-.926-2.063-2.065 0-1.138.92-2.063 2.063-2.063 1.14 0 2.064.925 2.064 2.063 0 1.139-.925 2.065-2.064 2.065zm1.782 13.019H3.555V9h3.564v11.452zM22.225 0H1.771C.792 0 0 .774 0 1.729v20.542C0 23.227.792 24 1.771 24h20.451C23.2 24 24 23.227 24 22.271V1.729C24 .774 23.2 0 22.222 0h.003z"/>
                            </svg>
                        </a>
                    </div>
                </div>
                
                <!-- روابط سريعة -->
                <div class="space-y-4 fade-in-up animate-delay-200">
                    <h3 class="text-xl font-bold mb-6 text-transparent bg-clip-text bg-gradient-to-r from-green-400 to-emerald-400">
                        <svg class="w-5 h-5 inline ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.828 10.172a4 4 0 00-5.656 0l-4 4a4 4 0 105.656 5.656l1.102-1.101m-.758-4.899a4 4 0 005.656 0l4-4a4 4 0 00-5.656-5.656l-1.1 1.1"></path>
                        </svg>
                        روابط سريعة
                    </h3>
                    <ul class="space-y-3">
                        <li>
                            <a href="{{ route('dashboard.index') }}" class="text-gray-300 hover:text-white transition-all duration-300 flex items-center group">
                                <svg class="w-4 h-4 ml-3 text-blue-400 group-hover:text-blue-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path>
                                </svg>
                                <span>الرئيسية</span>
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('jobs.index') }}" class="text-gray-300 hover:text-white transition-all duration-300 flex items-center group">
                                <svg class="w-4 h-4 ml-3 text-green-400 group-hover:text-green-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
                                </svg>
                                <span>الوظائف</span>
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('companies.index') }}" class="text-gray-300 hover:text-white transition-all duration-300 flex items-center group">
                                <svg class="w-4 h-4 ml-3 text-purple-400 group-hover:text-purple-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path>
                                </svg>
                                <span>الشركات</span>
                            </a>
                        </li>
                        <li>
                            <a href="#" class="text-gray-300 hover:text-white transition-all duration-300 flex items-center group">
                                <svg class="w-4 h-4 ml-3 text-orange-400 group-hover:text-orange-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m-6 0l2 2m-2-2h6m2 2v9a2 2 0 01-2 2h-2m-4 0V9a2 2 0 00-2-2H6a2 2 0 00-2 2v6m2 0V9a2 2 0 012-2h2a2 2 0 012 2v6"></path>
                                </svg>
                                <span>المقالات</span>
                            </a>
                        </li>
                    </ul>
                </div>
                
                <!-- للشركات -->
                <div class="space-y-4 fade-in-up animate-delay-300">
                    <h3 class="text-xl font-bold mb-6 text-transparent bg-clip-text bg-gradient-to-r from-purple-400 to-pink-400">
                        <svg class="w-5 h-5 inline ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
                        </svg>
                        للشركات
                    </h3>
                    <ul class="space-y-3">
                        <li>
                            <a href="{{ route('jobs.create') }}" class="text-gray-300 hover:text-white transition-all duration-300 flex items-center group">
                                <svg class="w-4 h-4 ml-3 text-indigo-400 group-hover:text-indigo-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                                </svg>
                                <span>إعلان وظيفة</span>
                            </a>
                        </li>
                        <li>
                            <a href="#" class="text-gray-300 hover:text-white transition-all duration-300 flex items-center group">
                                <svg class="w-4 h-4 ml-3 text-yellow-400 group-hover:text-yellow-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                                </svg>
                                <span>البحث عن موظفين</span>
                            </a>
                        </li>
                        <li>
                            <a href="#" class="text-gray-300 hover:text-white transition-all duration-300 flex items-center group">
                                <svg class="w-4 h-4 ml-3 text-red-400 group-hover:text-red-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 4M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path>
                                </svg>
                                <span>حسابات الشركات</span>
                            </a>
                        </li>
                    </ul>
                </div>
                
                <!-- تواصل معنا -->
                <div class="space-y-4 fade-in-up animate-delay-400">
                    <h3 class="text-xl font-bold mb-6 text-transparent bg-clip-text bg-gradient-to-r from-red-400 to-orange-400">
                        <svg class="w-5 h-5 inline ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
                        </svg>
                        تواصل معنا
                    </h3>
                    <ul class="space-y-4">
                        <li class="flex items-center text-gray-300 hover:text-white transition-all duration-300 group">
                            <svg class="w-4 h-4 ml-3 text-blue-400 group-hover:text-blue-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
                            </svg>
                            <span>abdlafttahAlkordi@gmail.com</span>
                        </li>
                        <li class="flex items-center text-gray-300 hover:text-white transition-all duration-300 group">
                            <svg class="w-4 h-4 ml-3 text-green-400 group-hover:text-green-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 2.256a1 1 0 01-1.21.502L4.684 9.972a1 1 0 01-.684-.948V5z"></path>
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5v14h18V5H3z"></path>
                            </svg>
                            <span dir="ltr">+972 597 481 907</span>
                        </li>
                        <li class="flex items-start text-gray-300 hover:text-white transition-all duration-300 group">
                            <svg class="w-4 h-4 ml-3 text-red-400 group-hover:text-red-300 mt-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path>
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                            </svg>
                            <span>فلسطين</span>
                        </li>
                    </ul>
                </div>
            </div>
            
            <!-- حقوق النشر والشعار -->
            <div class="mt-16 pt-8 border-t border-gray-700 fade-in-up animate-delay-500">
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
