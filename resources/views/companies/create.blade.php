<x-app-layout>
    <x-slot name="header">
        <h2 class="text-3xl font-bold text-gray-900">إضافة شركة جديدة</h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="bg-white rounded-2xl shadow-xl p-8 premium-shadow">
                <form method="POST" action="{{ route('companies.store') }}" enctype="multipart/form-data" class="space-y-6">
                    @csrf

                    <!-- Company Information -->
                    <div class="border-b border-gray-200 pb-6">
                        <h3 class="text-xl font-bold text-gray-900 mb-6">معلومات الشركة الأساسية</h3>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">اسم الشركة *</label>
                                <input type="text" name="name" required
                                       value="{{ old('name') }}"
                                       class="w-full px-4 py-3 border-2 border-gray-200 rounded-xl focus:outline-none focus:border-indigo-500 focus:ring-2 focus:ring-indigo-200 transition-all">
                                @error('name')
                                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                                @enderror
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">المجال *</label>
                                <select name="industry" required
                                        class="w-full px-4 py-3 border-2 border-gray-200 rounded-xl focus:outline-none focus:border-indigo-500 focus:ring-2 focus:ring-indigo-200 transition-all">
                                    <option value="">اختر المجال</option>
                                    <option value="تكنولوجيا المعلومات" {{ old('industry') == 'تكنولوجيا المعلومات' ? 'selected' : '' }}>تكنولوجيا المعلومات</option>
                                    <option value="الخدمات المالية" {{ old('industry') == 'الخدمات المالية' ? 'selected' : '' }}>الخدمات المالية</option>
                                    <option value="الرعاية الصحية" {{ old('industry') == 'الرعاية الصحية' ? 'selected' : '' }}>الرعاية الصحية</option>
                                    <option value="التعليم" {{ old('industry') == 'التعليم' ? 'selected' : '' }}>التعليم</option>
                                    <option value="التجارة" {{ old('industry') == 'التجارة' ? 'selected' : '' }}>التجارة</option>
                                    <option value="التصنيع" {{ old('industry') == 'التصنيع' ? 'selected' : '' }}>التصنيع</option>
                                    <option value="الخدمات" {{ old('industry') == 'الخدمات' ? 'selected' : '' }}>الخدمات</option>
                                </select>
                                @error('industry')
                                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                                @enderror
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">الموقع *</label>
                                <input type="text" name="location" required
                                       value="{{ old('location') }}"
                                       class="w-full px-4 py-3 border-2 border-gray-200 rounded-xl focus:outline-none focus:border-indigo-500 focus:ring-2 focus:ring-indigo-200 transition-all">
                                @error('location')
                                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                                @enderror
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">حجم الشركة</label>
                                <select name="size"
                                        class="w-full px-4 py-3 border-2 border-gray-200 rounded-xl focus:outline-none focus:border-indigo-500 focus:ring-2 focus:ring-indigo-200 transition-all">
                                    <option value="">اختر الحجم</option>
                                    <option value="1-10" {{ old('size') == '1-10' ? 'selected' : '' }}>1-10 موظفين</option>
                                    <option value="11-50" {{ old('size') == '11-50' ? 'selected' : '' }}>11-50 موظفين</option>
                                    <option value="51-200" {{ old('size') == '51-200' ? 'selected' : '' }}>51-200 موظفين</option>
                                    <option value="201-500" {{ old('size') == '201-500' ? 'selected' : '' }}>201-500 موظفين</option>
                                    <option value="500+" {{ old('size') == '500+' ? 'selected' : '' }}>أكثر من 500 موظف</option>
                                </select>
                                @error('size')
                                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <!-- Description -->
                    <div class="border-b border-gray-200 pb-6">
                        <h3 class="text-xl font-bold text-gray-900 mb-4">وصف الشركة</h3>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">الوصف *</label>
                            <textarea name="description" rows="6" required
                                      class="w-full px-4 py-3 border-2 border-gray-200 rounded-xl focus:outline-none focus:border-indigo-500 focus:ring-2 focus:ring-indigo-200 transition-all"
                                      placeholder="اكتب وصفاً مفصلاً عن شركة، نشاطاتها، وقيمتها...">{{ old('description') }}</textarea>
                            @error('description')
                                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>

                    <!-- Online Presence -->
                    <div class="border-b border-gray-200 pb-6">
                        <h3 class="text-xl font-bold text-gray-900 mb-4">الحضور الإلكتروني</h3>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">الموقع الإلكتروني</label>
                            <input type="url" name="website"
                                   value="{{ old('website') }}"
                                   class="w-full px-4 py-3 border-2 border-gray-200 rounded-xl focus:outline-none focus:border-indigo-500 focus:ring-2 focus:ring-indigo-200 transition-all"
                                   placeholder="https://example.com">
                            @error('website')
                                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>

                    <!-- Logo Upload -->
                    <div>
                        <h3 class="text-xl font-bold text-gray-900 mb-4">شعار الشركة</h3>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">الشعار</label>
                            <div class="flex items-center space-x-6 space-x-reverse">
                                <div class="flex-1">
                                    <input type="file" name="logo" accept="image/*"
                                           class="w-full px-4 py-3 border-2 border-gray-200 rounded-xl focus:outline-none focus:border-indigo-500 focus:ring-2 focus:ring-indigo-200 transition-all">
                                    <p class="text-sm text-gray-500 mt-1">PNG, JPG, JPEG, GIF (الحد الأقصى: 2MB)</p>
                                    @error('logo')
                                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                                    @enderror
                                </div>
                                @if(old('logo'))
                                    <div class="flex-shrink-0">
                                        <img src="{{ asset('storage/' . old('logo')) }}" alt="Logo preview" 
                                             class="w-20 h-20 rounded-xl object-cover border-2 border-gray-200">
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>

                    <!-- Submit Buttons -->
                    <div class="flex justify-between items-center pt-6">
                        <a href="{{ route('companies.index') }}" 
                           class="px-6 py-3 border-2 border-gray-300 text-gray-700 rounded-xl font-medium hover:bg-gray-50 transition-all duration-300">
                            إلغاء
                        </a>
                        <div class="space-x-4 space-x-reverse">
                            <button type="submit" 
                                    class="px-8 py-3 bg-gradient-to-r from-indigo-600 to-purple-600 text-white rounded-xl font-bold hover:from-indigo-700 hover:to-purple-700 transform hover:scale-105 transition-all duration-300 shadow-lg btn-primary">
                                <svg class="w-5 h-5 inline ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                                </svg>
                                إضافة الشركة
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
