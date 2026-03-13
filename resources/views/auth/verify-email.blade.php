<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" dir="rtl">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="{{ config('app.name', 'Fursaana') }} - التحقق من البريد الإلكتروني">

    <title>{{ config('app.name', 'Fursaana') }} - التحقق من البريد الإلكتروني</title>

    <!-- Favicon -->
    <link rel="icon" href="{{ asset('favicon.ico') }}">

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=tajawal:400,500,700,900" rel="stylesheet" />

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
        body {
            font-family: 'Tajawal', sans-serif;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 50%, #f093fb 100%);
            min-height: 100vh;
        }
        
        .glass-effect {
            background: rgba(255, 255, 255, 0.1);
            backdrop-filter: blur(10px);
            border: 1px solid rgba(255, 255, 255, 0.2);
        }
        
        .verify-card {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(20px);
            border: 1px solid rgba(255, 255, 255, 0.2);
            box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.25);
        }
        
        .gradient-text {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 50%, #f093fb 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }
        
        .btn-primary {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 50%, #f093fb 100%);
            transition: all 0.3s ease;
        }
        
        .btn-primary:hover {
            transform: translateY(-2px);
            box-shadow: 0 15px 30px -10px rgba(102, 126, 234, 0.4);
        }
        
        .btn-secondary {
            background: rgba(255, 255, 255, 0.2);
            backdrop-filter: blur(10px);
            border: 1px solid rgba(255, 255, 255, 0.3);
            transition: all 0.3s ease;
        }
        
        .btn-secondary:hover {
            background: rgba(255, 255, 255, 0.3);
            transform: translateY(-2px);
        }
        
        .floating {
            animation: float 6s ease-in-out infinite;
        }
        
        @keyframes float {
            0%, 100% { transform: translateY(0px); }
            50% { transform: translateY(-20px); }
        }
        
        .pattern-bg {
            background-image: url('data:image/svg+xml,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1440 320"><path fill="%23ffffff" fill-opacity="0.05" d="M0,96L48,112C96,128,192,160,288,160C384,160,480,128,576,122.7C672,117,768,139,864,133.3C960,128,1056,96,1152,90.7C1248,85,1344,107,1392,117.3L1440,128L1440,320L1392,320C1344,320,1248,320,1152,320C1056,320,960,320,864,320C768,320,672,320,576,320C480,320,384,320,288,320C192,320,96,320,48,320L0,320Z"></path></svg>');
            background-repeat: no-repeat;
            background-position: bottom;
            background-size: cover;
        }
    </style>
</head>
<body class="antialiased pattern-bg">
    <!-- Navigation -->
    <nav class="glass-effect sticky top-0 z-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between h-16">
                <div class="flex items-center">
                    <a href="{{ url('/') }}" class="text-2xl font-black gradient-text">
                        {{ config('app.name', 'Fursaana') }}
                    </a>
                </div>
                <div class="flex items-center space-x-4">
                    <a href="{{ url('/') }}" class="text-white/80 hover:text-white transition-colors duration-300">
                        الرئيسية
                    </a>
                    <form method="POST" action="{{ route('logout') }}" class="inline">
                        @csrf
                        <button type="submit" class="px-4 py-2 rounded-full text-sm font-medium text-white bg-white/20 backdrop-blur-sm border border-white/30 hover:bg-white/30 transform hover:scale-105 transition-all duration-300">
                            تسجيل الخروج
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </nav>

    <!-- Main Content -->
    <div class="min-h-screen flex items-center justify-center px-4 py-12">
        <div class="max-w-md w-full space-y-8">
            <!-- Logo and Title -->
            <div class="text-center">
                <div class="floating inline-block">
                    <div class="w-20 h-20 bg-white rounded-2xl shadow-2xl flex items-center justify-center mx-auto mb-6">
                        <span class="text-4xl">✉️</span>
                    </div>
                </div>
                <h1 class="text-4xl font-black text-white mb-2">
                    تحقق من بريدك الإلكتروني
                </h1>
                <p class="text-white/80 text-lg">
                    شكراً على تسجيلك في {{ config('app.name', 'Fursaana') }}
                </p>
            </div>

            <!-- Verification Card -->
            <div class="verify-card rounded-3xl p-8">
                <!-- Success Message -->
                @if (session('status') == 'verification-link-sent')
                    <div class="mb-6 p-4 bg-green-50 border border-green-200 rounded-xl text-green-800 text-center">
                        <div class="text-2xl mb-2">🎉</div>
                        <p class="font-medium">تم إرسال رابط التحقق الجديد إلى بريدك الإلكتروني</p>
                    </div>
                @endif

                <!-- Instructions -->
                <div class="mb-8 text-center">
                    <div class="text-6xl mb-4">📧</div>
                    <p class="text-gray-600 text-lg leading-relaxed">
                        قبل أن تبدأ، يرجى التحقق من بريدك الإلكتروني بالنقر على الرابط الذي أرسلناه لك للتو. 
                        إذا لم تستلم البريد الإلكتروني، سيسعدنا إرسال رابط جديد.
                    </p>
                </div>

                <!-- User Email Display -->
                @if (auth()->user())
                    <div class="mb-6 p-4 bg-indigo-50 border border-indigo-200 rounded-xl text-center">
                        <p class="text-sm text-indigo-600 font-medium">البريد الإلكتروني المسجل:</p>
                        <p class="text-lg font-bold text-indigo-800">{{ auth()->user()->email }}</p>
                    </div>
                @endif

                <!-- Action Buttons -->
                <div class="space-y-4">
                    <!-- Resend Verification Email -->
                    <form method="POST" action="{{ route('verification.send') }}">
                        @csrf
                        <button type="submit" 
                                class="btn-primary w-full py-4 px-6 rounded-xl text-white font-bold text-lg shadow-xl flex items-center justify-center">
                            <span class="ml-2">🔄</span>
                            إعادة إرسال رابط التحقق
                        </button>
                    </form>

                    <!-- Logout -->
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" 
                                class="btn-secondary w-full py-4 px-6 rounded-xl text-white font-bold text-lg flex items-center justify-center">
                            <span class="ml-2">🚪</span>
                            تسجيل الخروج
                        </button>
                    </form>
                </div>

                <!-- Help Text -->
                <div class="mt-6 text-center">
                    <p class="text-gray-500 text-sm">
                        إذا واجهت أي مشكلة، 
                        <a href="#" class="text-indigo-600 hover:text-indigo-800 font-medium transition-colors">
                            تواصل مع الدعم الفني
                        </a>
                    </p>
                </div>
            </div>
        </div>
    </div>

    <!-- Footer -->
    <footer class="absolute bottom-0 w-full text-center py-6 text-white/60">
        <p>&copy; {{ date('Y') }} {{ config('app.name', 'Fursaana') }}. جميع الحقوق محفوظة.</p>
    </footer>
</body>
</html>
