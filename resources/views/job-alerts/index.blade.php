@extends('layouts.app')

@section('title', 'إنذارات الوظائف')

@section('content')
<div class="container mx-auto px-4 py-8">
    <div class="max-w-4xl mx-auto">
        <!-- Header -->
        <div class="mb-8">
            <h1 class="text-3xl font-bold text-gray-900 mb-2">إنذارات الوظائف</h1>
            <p class="text-gray-600">احصل على إشعارات فورية عندما تظهر وظائف جديدة تطابق معاييرك</p>
        </div>

        <!-- Create Alert Form -->
        <div class="bg-white rounded-lg shadow-md p-6 mb-8">
            <h2 class="text-xl font-semibold mb-4">إنشاء إنذار جديد</h2>
            <form action="{{ route('job-alerts.store') }}" method="POST" class="space-y-4">
                @csrf
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">
                            الكلمات المفتاحية *
                        </label>
                        <input type="text" 
                               name="keywords" 
                               required
                               placeholder="مثال: Laravel, PHP, Developer"
                               class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500">
                    </div>
                    
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">
                            الموقع
                        </label>
                        <select name="location" 
                                class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500">
                            <option value="">جميع المواقع</option>
                            <option value="رام الله">رام الله</option>
                            <option value="غزة">غزة</option>
                            <option value="القدس">القدس</option>
                            <option value="نابلس">نابلس</option>
                            <option value="الخليل">الخليل</option>
                            <option value="Remote">عن بعد</option>
                        </select>
                    </div>
                    
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">
                            نوع العمل
                        </label>
                        <select name="type" 
                                class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500">
                            <option value="">جميع الأنواع</option>
                            <option value="full_time">دوام كامل</option>
                            <option value="part_time">دوام جزئي</option>
                            <option value="remote">عن بعد</option>
                            <option value="contract">عقد</option>
                        </select>
                    </div>
                    
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">
                            الحد الأدنى للراتب
                        </label>
                        <input type="number" 
                               name="salary_min" 
                               min="0"
                               placeholder="0"
                               class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500">
                    </div>
                    
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">
                            الحد الأعلى للراتب
                        </label>
                        <input type="number" 
                               name="salary_max" 
                               min="0"
                               placeholder="10000"
                               class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500">
                    </div>
                </div>
                
                <button type="submit" 
                        class="w-full md:w-auto px-6 py-2 bg-indigo-600 text-white font-medium rounded-lg hover:bg-indigo-700 transition-colors">
                    إنشاء إنذار
                </button>
            </form>
        </div>

        <!-- Existing Alerts -->
        <div class="bg-white rounded-lg shadow-md p-6">
            <h2 class="text-xl font-semibold mb-4">إنذاراتك الحالية</h2>
            
            @if($alerts->count() > 0)
                <div class="space-y-4">
                    @foreach($alerts as $alert)
                        <div class="border border-gray-200 rounded-lg p-4 {{ $alert->is_active ? 'bg-white' : 'bg-gray-50' }}">
                            <div class="flex items-start justify-between">
                                <div class="flex-1">
                                    <h3 class="font-semibold text-lg text-gray-900">
                                        {{ $alert->keywords }}
                                    </h3>
                                    <div class="mt-2 space-y-1">
                                        @if($alert->location)
                                            <p class="text-sm text-gray-600">
                                                <i class="fas fa-map-marker-alt ml-1"></i>
                                                {{ $alert->location }}
                                            </p>
                                        @endif
                                        
                                        @if($alert->type)
                                            <p class="text-sm text-gray-600">
                                                <i class="fas fa-briefcase ml-1"></i>
                                                {{ __('types.' . $alert->type) }}
                                            </p>
                                        @endif
                                        
                                        @if($alert->salary_min || $alert->salary_max)
                                            <p class="text-sm text-gray-600">
                                                <i class="fas fa-dollar-sign ml-1"></i>
                                                {{ $alert->salary_min ? $alert->salary_min : '0' }} 
                                                @if($alert->salary_max) - {{ $alert->salary_max }} @endif
                                            </p>
                                        @endif
                                    </div>
                                    
                                    <div class="mt-3">
                                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium {{ $alert->is_active ? 'bg-green-100 text-green-800' : 'bg-gray-100 text-gray-800' }}">
                                            {{ $alert->is_active ? 'نشط' : 'غير نشط' }}
                                        </span>
                                    </div>
                                </div>
                                
                                <div class="flex items-center space-x-2 space-x-reverse">
                                    <button onclick="toggleAlert({{ $alert->id }})" 
                                            class="text-indigo-600 hover:text-indigo-900">
                                        <i class="fas fa-{{ $alert->is_active ? 'pause' : 'play' }}"></i>
                                    </button>
                                    <button onclick="editAlert({{ $alert->id }})" 
                                            class="text-blue-600 hover:text-blue-900">
                                        <i class="fas fa-edit"></i>
                                    </button>
                                    <form action="{{ route('job-alerts.destroy', $alert) }}" 
                                          method="POST" 
                                          class="inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" 
                                                class="text-red-600 hover:text-red-900"
                                                onclick="return confirm('هل أنت متأكد من حذف هذا الإنذار؟')">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
                
                <!-- Pagination -->
                {{ $alerts->links() }}
            @else
                <div class="text-center py-8">
                    <i class="fas fa-bell-slash text-4xl text-gray-400 mb-4"></i>
                    <p class="text-gray-600">لم تقم بإنشاء أي إنذارات بعد</p>
                    <p class="text-sm text-gray-500 mt-2">أنشئ إنذاراً جديداً للحصول على إشعارات فورية!</p>
                </div>
            @endif
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script>
function toggleAlert(id) {
    // Toggle alert status (active/inactive)
    fetch(`/job-alerts/${id}/toggle`, {
        method: 'PATCH',
        headers: {
            'X-CSRF-TOKEN': '{{ csrf_token() }}',
            'Content-Type': 'application/json',
        }
    })
    .then(response => response.json())
    .then(data => {
        location.reload();
    });
}

function editAlert(id) {
    // Edit alert functionality
    window.location.href = `/job-alerts/${id}/edit`;
}
</script>
@endsection
