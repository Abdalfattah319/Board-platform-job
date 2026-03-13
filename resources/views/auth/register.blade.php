<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" dir="rtl">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="{{ config('app.name', 'Fursaana') }} - إنشاء حساب جديد في منصة التوظيف الرائدة">

    <title>{{ config('app.name', 'Fursaana') }} - إنشاء حساب جديد</title>

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
        
        .register-card {
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
        
        .input-field {
            background: rgba(255, 255, 255, 0.9);
            border: 2px solid rgba(102, 126, 234, 0.2);
            transition: all 0.3s ease;
        }
        
        .input-field:focus {
            outline: none;
            border-color: #667eea;
            box-shadow: 0 0 0 3px rgba(102, 126, 234, 0.1);
            background: rgba(255, 255, 255, 1);
        }
        
        .btn-primary {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 50%, #f093fb 100%);
            transition: all 0.3s ease;
        }
        
        .btn-primary:hover {
            transform: translateY(-2px);
            box-shadow: 0 15px 30px -10px rgba(102, 126, 234, 0.4);
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
        
        .role-card {
            transition: all 0.3s ease;
            cursor: pointer;
        }
        
        .role-card:hover {
            transform: translateY(-2px);
            box-shadow: 0 10px 25px -5px rgba(102, 126, 234, 0.3);
        }
        
        .role-card.selected {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 50%, #f093fb 100%);
            color: white;
            border-color: #667eea;
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
                    @if (Route::has('login'))
                        <a href="{{ route('login') }}" class="px-4 py-2 rounded-full text-sm font-medium text-white bg-white/20 backdrop-blur-sm border border-white/30 hover:bg-white/30 transform hover:scale-105 transition-all duration-300">
                            تسجيل الدخول
                        </a>
                    @endif
                </div>
            </div>
        </div>
    </nav>

    <!-- Main Content -->
    <div class="min-h-screen flex items-center justify-center px-4 py-12">
        <div class="max-w-2xl w-full space-y-8">
            <!-- Logo and Title -->
            <div class="text-center">
                <div class="floating inline-block">
                    <div class="w-24 h-24 bg-white rounded-2xl shadow-2xl flex items-center justify-center mx-auto mb-6">
                        <span class="text-5xl">🎯</span>
                    </div>
                </div>
                <h1 class="text-4xl font-black text-white mb-2">
                    انضم إلى {{ config('app.name', 'Fursaana') }}
                </h1>
                <p class="text-white/80 text-lg">
                    ابدأ رحلتك المهنية اليوم مع أفضل منصة توظيف في العالم العربي
                </p>
            </div>

            <!-- Register Form -->
            <div class="register-card rounded-3xl p-8">
                <!-- Validation Errors -->
                @if ($errors->any())
                    <div class="mb-6 p-4 bg-red-50 border border-red-200 rounded-xl">
                        <ul class="text-red-800 text-sm space-y-1 text-right">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form method="POST" action="{{ route('register') }}" class="space-y-6">
                    @csrf

                    <!-- Name -->
                    <div>
                        <label for="name" class="block text-lg font-bold text-gray-800 mb-3">
                            الاسم الكامل
                        </label>
                        <div class="relative">
                            <input id="name" 
                                   type="text" 
                                   name="name" 
                                   :value="old('name')" 
                                   required 
                                   autofocus
                                   autocomplete="name"
                                   class="input-field w-full px-6 py-4 rounded-xl text-gray-800 text-lg placeholder-gray-500"
                                   placeholder="أدخل اسمك الكامل">
                            <div class="absolute left-4 top-1/2 transform -translate-y-1/2 text-2xl">
                                👤
                            </div>
                        </div>
                    </div>

                    <!-- Email Address -->
                    <div>
                        <label for="email" class="block text-lg font-bold text-gray-800 mb-3">
                            البريد الإلكتروني
                        </label>
                        <div class="relative">
                            <input id="email" 
                                   type="email" 
                                   name="email" 
                                   :value="old('email')" 
                                   required 
                                   autocomplete="username"
                                   class="input-field w-full px-6 py-4 rounded-xl text-gray-800 text-lg placeholder-gray-500"
                                   placeholder="example@email.com">
                            <div class="absolute left-4 top-1/2 transform -translate-y-1/2 text-2xl">
                                📧
                            </div>
                        </div>
                    </div>

                    <!-- Password -->
                    <div>
                        <label for="password" class="block text-lg font-bold text-gray-800 mb-3">
                            كلمة المرور
                        </label>
                        <div class="relative">
                            <input id="password" 
                                   type="password" 
                                   name="password" 
                                   required 
                                   autocomplete="new-password"
                                   class="input-field w-full px-6 py-4 pr-16 rounded-xl text-gray-800 text-lg placeholder-gray-500"
                                   placeholder="•••••••••">
                            <button type="button" 
                                    onclick="togglePassword('password')" 
                                    class="absolute left-4 top-1/2 transform -translate-y-1/2 text-gray-500 hover:text-gray-700 transition-colors">
                                <span id="toggle-password-icon" class="text-xl">👁</span>
                            </button>
                        </div>
                    </div>

                    <!-- Confirm Password -->
                    <div>
                        <label for="password_confirmation" class="block text-lg font-bold text-gray-800 mb-3">
                            تأكيد كلمة المرور
                        </label>
                        <div class="relative">
                            <input id="password_confirmation" 
                                   type="password" 
                                   name="password_confirmation" 
                                   required 
                                   autocomplete="new-password"
                                   class="input-field w-full px-6 py-4 pr-16 rounded-xl text-gray-800 text-lg placeholder-gray-500"
                                   placeholder="•••••••••">
                            <button type="button" 
                                    onclick="togglePassword('password_confirmation')" 
                                    class="absolute left-4 top-1/2 transform -translate-y-1/2 text-gray-500 hover:text-gray-700 transition-colors">
                                <span id="toggle-password-confirmation-icon" class="text-xl">👁</span>
                            </button>
                        </div>
                    </div>

                    <!-- Role Selection -->
                    <div>
                        <label class="block text-lg font-bold text-gray-800 mb-4">
                            نوع الحساب
                        </label>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <!-- Employer -->
                            <label class="role-card relative">
                                <input type="radio" name="role" value="employer" class="sr-only peer"
                                       {{ old('role') == 'employer' ? 'checked' : '' }}>
                                <div class="p-6 bg-white border-2 border-gray-200 rounded-2xl peer-checked:border-indigo-600 peer-checked:bg-gradient-to-br peer-checked:from-indigo-50 peer-checked:to-purple-50 transition-all duration-300">
                                    <div class="text-center">
                                        <div class="text-4xl mb-3">🏢</div>
                                        <h3 class="text-lg font-bold text-gray-800 peer-checked:text-indigo-600">صاحب العمل</h3>
                                        <p class="text-sm text-gray-600 mt-2">انشر وظائفك وابحث عن المواهب</p>
                                    </div>
                                </div>
                            </label>

                            <!-- Applicant -->
                            <label class="role-card relative">
                                <input type="radio" name="role" value="applicant" class="sr-only peer"
                                       {{ old('role') == 'applicant' || old('role') === null ? 'checked' : '' }}>
                                <div class="p-6 bg-white border-2 border-gray-200 rounded-2xl peer-checked:border-indigo-600 peer-checked:bg-gradient-to-br peer-checked:from-indigo-50 peer-checked:to-purple-50 transition-all duration-300">
                                    <div class="text-center">
                                        <div class="text-4xl mb-3">💼</div>
                                        <h3 class="text-lg font-bold text-gray-800 peer-checked:text-indigo-600">باحث عن عمل</h3>
                                        <p class="text-sm text-gray-600 mt-2">ابحث عن وظيفة أحلامك</p>
                                    </div>
                                </div>
                            </label>
                        </div>
                        @error('role')
                            <p class="mt-2 text-sm text-red-600 text-right">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Submit Button -->
                    <div>
                        <button type="submit" 
                                class="btn-primary w-full py-4 px-6 rounded-xl text-white font-bold text-lg shadow-xl">
                            إنشاء حساب جديد
                        </button>
                    </div>
                </form>

                <!-- Login Link -->
                @if (Route::has('login'))
                    <div class="text-center pt-6 border-t border-gray-200">
                        <p class="text-gray-600 text-lg">
                            لديك حساب بالفعل؟ 
                            <a href="{{ route('login') }}" 
                               class="font-bold text-indigo-600 hover:text-indigo-800 transition-colors">
                                تسجيل الدخول
                            </a>
                        </p>
                    </div>
                @endif
            </div>
        </div>
    </div>

    <!-- Footer -->
    <footer class="absolute bottom-0 w-full text-center py-6 text-white/60">
        <p>&copy; {{ date('Y') }} {{ config('app.name', 'Fursaana') }}. جميع الحقوق محفوظة.</p>
    </footer>

    <script>
        function togglePassword(fieldId) {
            const password = document.getElementById(fieldId);
            const icon = document.getElementById('toggle-' + fieldId + '-icon');
            
            if (password.type === 'password') {
                password.type = 'text';
                icon.textContent = '👁‍🗨';
            } else {
                password.type = 'password';
                icon.textContent = '👁';
            }
        }
    </script>
</body>
</html>
