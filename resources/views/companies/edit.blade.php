@extends('layouts.app')

@section('content')
<div class="py-8">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-6 bg-white border-b border-gray-200">
                <h2 class="text-2xl font-semibold text-gray-900 mb-6">تعديل بيانات الشركة</h2>
                
                <form action="{{ route('companies.update', $company) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <!-- Company Name -->
                        <div class="col-span-2">
                            <x-label for="name" value="اسم الشركة" />
                            <x-input id="name" name="name" type="text" class="mt-1 block w-full" value="{{ old('name', $company->name) }}" required autofocus />
                            @error('name')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Logo -->
                        <div class="col-span-2">
                            <x-label for="logo" value="شعار الشركة" />
                            
                            @if($company->logo_path)
                            <div class="mb-4">
                                <img src="{{ $company->logo_url }}" alt="{{ $company->name }}" class="h-24 w-24 rounded-full object-cover">
                                <div class="mt-2">
                                    <label class="inline-flex items-center">
                                        <input type="checkbox" name="remove_logo" value="1" class="rounded border-gray-300 text-indigo-600 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                                        <span class="mr-2 text-sm text-gray-600">حذف الشعار الحالي</span>
                                    </label>
                                </div>
                            </div>
                            @endif
                            
                            <x-input id="logo" name="logo" type="file" class="mt-1 block w-full" accept="image/*" />
                            <p class="mt-1 text-sm text-gray-500">يجب أن تكون الصورة بحجم 400×400 بكسل</p>
                            @error('logo')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Industry -->
                        <div>
                            <x-label for="industry" value="المجال" />
                            <x-input id="industry" name="industry" type="text" class="mt-1 block w-full" value="{{ old('industry', $company->industry) }}" required />
                            @error('industry')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Website -->
                        <div>
                            <x-label for="website" value="الموقع الإلكتروني" />
                            <x-input id="website" name="website" type="url" class="mt-1 block w-full" value="{{ old('website', $company->website) }}" />
                            @error('website')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Email -->
                        <div>
                            <x-label for="email" value="البريد الإلكتروني" />
                            <x-input id="email" name="email" type="email" class="mt-1 block w-full" value="{{ old('email', $company->email) }}" required />
                            @error('email')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Phone -->
                        <div>
                            <x-label for="phone" value="رقم الهاتف" />
                            <x-input id="phone" name="phone" type="tel" class="mt-1 block w-full" value="{{ old('phone', $company->phone) }}" />
                            @error('phone')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Address -->
                        <div class="col-span-2">
                            <x-label for="address" value="العنوان" />
                            <x-textarea id="address" name="address" class="mt-1 block w-full" rows="2">{{ old('address', $company->address) }}</x-textarea>
                            @error('address')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Description -->
                        <div class="col-span-2">
                            <x-label for="description" value="وصف الشركة" />
                            <x-textarea id="description" name="description" class="mt-1 block w-full" rows="4" required>{{ old('description', $company->description) }}</x-textarea>
                            <p class="mt-1 text-sm text-gray-500">اكتب وصفًا مختصرًا عن الشركة ونشاطاتها</p>
                            @error('description')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Additional Information -->
                        <div class="col-span-2">
                            <h3 class="text-lg font-medium text-gray-900 mb-4">معلومات إضافية</h3>
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                <!-- Employee Count -->
                                <div>
                                    <x-label for="employee_count" value="عدد الموظفين" />
                                    <select id="employee_count" name="employee_count" class="mt-1 block w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm">
                                        <option value="">اختر عدد الموظفين</option>
                                        <option value="1-10" {{ old('employee_count', $company->employee_count) == '1-10' ? 'selected' : '' }}>1-10 موظف</option>
                                        <option value="11-50" {{ old('employee_count', $company->employee_count) == '11-50' ? 'selected' : '' }}>11-50 موظف</option>
                                        <option value="51-200" {{ old('employee_count', $company->employee_count) == '51-200' ? 'selected' : '' }}>51-200 موظف</option>
                                        <option value="201-500" {{ old('employee_count', $company->employee_count) == '201-500' ? 'selected' : '' }}>201-500 موظف</option>
                                        <option value="501-1000" {{ old('employee_count', $company->employee_count) == '501-1000' ? 'selected' : '' }}>501-1000 موظف</option>
                                        <option value="1001-5000" {{ old('employee_count', $company->employee_count) == '1001-5000' ? 'selected' : '' }}>1001-5000 موظف</option>
                                        <option value="5001+" {{ old('employee_count', $company->employee_count) == '5001+' ? 'selected' : '' }}>أكثر من 5000 موظف</option>
                                    </select>
                                </div>

                                <!-- Founded Year -->
                                <div>
                                    <x-label for="founded_year" value="سنة التأسيس" />
                                    <x-input id="founded_year" name="founded_year" type="number" min="1900" max="{{ date('Y') }}" class="mt-1 block w-full" value="{{ old('founded_year', $company->founded_year) }}" />
                                </div>

                                <!-- Company Type -->
                                <div>
                                    <x-label for="company_type" value="نوع الشركة" />
                                    <select id="company_type" name="company_type" class="mt-1 block w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm">
                                        <option value="">اختر نوع الشركة</option>
                                        <option value="حكومية" {{ old('company_type', $company->company_type) == 'حكومية' ? 'selected' : '' }}>حكومية</option>
                                        <option value="خاصة" {{ old('company_type', $company->company_type) == 'خاصة' ? 'selected' : '' }}>خاصة</option>
                                        <option value="غير ربحية" {{ old('company_type', $company->company_type) == 'غير ربحية' ? 'selected' : '' }}>غير ربحية</option>
                                        <option value="ناشئة" {{ old('company_type', $company->company_type) == 'ناشئة' ? 'selected' : '' }}>ناشئة</option>
                                        <option value="متعددة الجنسيات" {{ old('company_type', $company->company_type) == 'متعددة الجنسيات' ? 'selected' : '' }}>متعددة الجنسيات</option>
                                    </select>
                                </div>
                            </div>
                        </div>

                        <!-- Social Media -->
                        <div class="col-span-2">
                            <h3 class="text-lg font-medium text-gray-900 mb-3">وسائل التواصل الاجتماعي</h3>
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                <div>
                                    <x-label for="twitter" value="تويتر" />
                                    <div class="mt-1 flex rounded-md shadow-sm">
                                        <span class="inline-flex items-center px-3 rounded-r-md border border-r-0 border-gray-300 bg-gray-50 text-gray-500 sm:text-sm">
                                            https://twitter.com/
                                        </span>
                                        <x-input type="text" name="twitter" id="twitter" class="flex-1 min-w-0 block rounded-none rounded-l-md sm:text-sm border-gray-300" placeholder="اسم المستخدم" value="{{ old('twitter', $company->twitter) }}" />
                                    </div>
                                </div>
                                <div>
                                    <x-label for="linkedin" value="لينكد إن" />
                                    <div class="mt-1 flex rounded-md shadow-sm">
                                        <span class="inline-flex items-center px-3 rounded-r-md border border-r-0 border-gray-300 bg-gray-50 text-gray-500 sm:text-sm">
                                            https://linkedin.com/company/
                                        </span>
                                        <x-input type="text" name="linkedin" id="linkedin" class="flex-1 min-w-0 block rounded-none rounded-l-md sm:text-sm border-gray-300" placeholder="اسم الشركة" value="{{ old('linkedin', $company->linkedin) }}" />
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="flex justify-end mt-8 space-x-3">
                        <a href="{{ route('companies.show', $company) }}" class="inline-flex items-center px-4 py-2 bg-white border border-gray-300 rounded-md font-semibold text-xs text-gray-700 uppercase tracking-widest shadow-sm hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 disabled:opacity-25 transition">
                            إلغاء
                        </a>
                        <x-button type="button" onclick="confirm('هل أنت متأكد من حفظ التغييرات؟') ? this.form.submit() : null">
                            حفظ التغييرات
                        </x-button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
