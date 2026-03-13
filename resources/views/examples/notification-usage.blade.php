{{-- Examples of Using the Global Notification System --}}

@extends('layouts.app')

@section('content')
<div class="max-w-4xl mx-auto py-8">
    <h1 class="text-3xl font-bold mb-8">أمثلة نظام الإشعارات الموحد</h1>
    
    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
        <!-- Success Examples -->
        <div class="bg-white rounded-lg shadow p-6">
            <h2 class="text-xl font-semibold mb-4">إشعارات النجاح</h2>
            <div class="space-y-3">
                <button onclick="showSuccess('تم حفظ التغييرات بنجاح')" 
                        class="px-4 py-2 bg-green-600 text-white rounded hover:bg-green-700">
                    نجاح بسيط
                </button>
                
                <button onclick="showSuccess('تم إنشاء الحساب بنجاح', {title: 'مرحباً!', duration: 6000})" 
                        class="px-4 py-2 bg-green-600 text-white rounded hover:bg-green-700">
                    نجاح مع عنوان مخصص
                </button>
                
                <button onclick="showSuccess('تم رفع الملف بنجاح', {progress: false, closable: false})" 
                        class="px-4 py-2 bg-green-600 text-white rounded hover:bg-green-700">
                    نجاح بدون إغلاق
                </button>
            </div>
        </div>

        <!-- Error Examples -->
        <div class="bg-white rounded-lg shadow p-6">
            <h2 class="text-xl font-semibold mb-4">إشعارات الخطأ</h2>
            <div class="space-y-3">
                <button onclick="showError('حدث خطأ في الاتصال')" 
                        class="px-4 py-2 bg-red-600 text-white rounded hover:bg-red-700">
                    خطأ بسيط
                </button>
                
                <button onclick="showError('فشل في تسجيل الدخول', {title: 'خطأ في المصادقة'})" 
                        class="px-4 py-2 bg-red-600 text-white rounded hover:bg-red-700">
                    خطأ مع عنوان
                </button>
                
                <button onclick="showError('البيانات المدخلة غير صحيحة', {duration: 8000})" 
                        class="px-4 py-2 bg-red-600 text-white rounded hover:bg-red-700">
                    خطأ طويل المدة
                </button>
            </div>
        </div>

        <!-- Info Examples -->
        <div class="bg-white rounded-lg shadow p-6">
            <h2 class="text-xl font-semibold mb-4">إشعارات المعلومات</h2>
            <div class="space-y-3">
                <button onclick="showInfo('تم تحديث الصفحة')" 
                        class="px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700">
                    معلومة بسيطة
                </button>
                
                <button onclick="showInfo('جاري تحميل البيانات...', {title: 'جاري التحميل', closable: false})" 
                        class="px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700">
                    معلومة غير قابلة للإغلاق
                </button>
                
                <button onclick="showInfo('سيتم تطبيق التغييرات عند إعادة التشغيل')" 
                        class="px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700">
                    معلومة تفصيلية
                </button>
            </div>
        </div>

        <!-- Warning Examples -->
        <div class="bg-white rounded-lg shadow p-6">
            <h2 class="text-xl font-semibold mb-4">إشعارات التحذير</h2>
            <div class="space-y-3">
                <button onclick="showWarning('سيتم حذف البيانات permanently')" 
                        class="px-4 py-2 bg-yellow-600 text-white rounded hover:bg-yellow-700">
                    تحذير بسيط
                </button>
                
                <button onclick="showWarning('لم يتم حفظ التغييرات', {title: 'تنبيه هام'})" 
                        class="px-4 py-2 bg-yellow-600 text-white rounded hover:bg-yellow-700">
                    تحذير مع عنوان
                </button>
                
                <button onclick="showWarning('انتهت صلاحية الجلسة', {duration: 10000})" 
                        class="px-4 py-2 bg-yellow-600 text-white rounded hover:bg-yellow-700">
                    تحذير طويل
                </button>
            </div>
        </div>
    </div>

    <!-- Advanced Examples -->
    <div class="mt-8 bg-white rounded-lg shadow p-6">
        <h2 class="text-xl font-semibold mb-4">أمثلة متقدمة</h2>
        <div class="space-y-3">
            <button onclick="showMultipleNotifications()" 
                    class="px-4 py-2 bg-purple-600 text-white rounded hover:bg-purple-700">
                إظهار عدة إشعارات
            </button>
            
            <button onclick="showNotificationWithCallback()" 
                    class="px-4 py-2 bg-purple-600 text-white rounded hover:bg-purple-700">
                إشعار مع callback
            </button>
            
            <button onclick="clearAllNotifications()" 
                    class="px-4 py-2 bg-gray-600 text-white rounded hover:bg-gray-700">
                مسح جميع الإشعارات
            </button>
        </div>
    </div>

    <!-- Usage Guide -->
    <div class="mt-8 bg-gray-50 rounded-lg p-6">
        <h2 class="text-xl font-semibold mb-4">طريقة الاستخدام</h2>
        <div class="space-y-4 text-sm">
            <div>
                <h3 class="font-semibold mb-2">الوظائف الأساسية:</h3>
                <code class="block bg-gray-200 p-2 rounded">
                    showSuccess('رسالة النجاح')<br>
                    showError('رسالة الخطأ')<br>
                    showInfo('رسالة المعلومة')<br>
                    showWarning('رسالة التحذير')
                </code>
            </div>
            
            <div>
                <h3 class="font-semibold mb-2">خيارات متقدمة:</h3>
                <code class="block bg-gray-200 p-2 rounded">
                    showSuccess('رسالة', {<br>
                    &nbsp;&nbsp;title: 'عنوان مخصص',<br>
                    &nbsp;&nbsp;duration: 5000,<br>
                    &nbsp;&nbsp;closable: true,<br>
                    &nbsp;&nbsp;progress: true<br>
                    })
                </code>
            </div>
        </div>
    </div>
</div>

<script>
// Advanced Examples
function showMultipleNotifications() {
    showSuccess('تمت العملية الأولى');
    setTimeout(() => showInfo('جاري العملية الثانية'), 500);
    setTimeout(() => showWarning('تنبيه للعملية الثالثة'), 1000);
    setTimeout(() => showSuccess('اكتملت جميع العمليات'), 1500);
}

function showNotificationWithCallback() {
    const id = showInfo('جاري المعالجة...', {closable: false});
    
    setTimeout(() => {
        notificationSystem.hide(id);
        showSuccess('تمت المعالجة بنجاح!');
    }, 3000);
}

function clearAllNotifications() {
    notificationSystem.clear();
    showInfo('تم مسح جميع الإشعارات');
}
</script>
@endsection
