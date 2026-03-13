@extends('layouts.app')

@section('title', 'الإشعارات')

@section('content')
<div class="container mx-auto px-4 py-8">
    <div class="max-w-4xl mx-auto">
        <!-- Header -->
        <div class="mb-8 flex items-center justify-between">
            <div>
                <h1 class="text-3xl font-bold text-gray-900 mb-2">الإشعارات</h1>
                <p class="text-gray-600">جميع إشعاراتك في مكان واحد</p>
            </div>
            
            <div class="flex items-center space-x-4 space-x-reverse">
                @if(auth()->user()->unreadNotifications->count() > 0)
                    <form action="{{ route('notifications.mark-all-read') }}" method="POST" class="inline">
                        @csrf
                        @method('PATCH')
                        <button type="submit" 
                                class="px-4 py-2 bg-indigo-600 text-white text-sm font-medium rounded-lg hover:bg-indigo-700 transition-colors">
                            <i class="fas fa-check-double ml-2"></i>
                            تحديد الكل كمقروء
                        </button>
                    </form>
                @endif
                
                <form action="{{ route('notifications.destroy-all') }}" method="POST" class="inline">
                    @csrf
                    @method('DELETE')
                    <button type="submit" 
                            class="px-4 py-2 bg-red-600 text-white text-sm font-medium rounded-lg hover:bg-red-700 transition-colors"
                            onclick="return confirm('هل أنت متأكد من حذف جميع الإشعارات؟')">
                        <i class="fas fa-trash ml-2"></i>
                        حذف الكل
                    </button>
                </form>
            </div>
        </div>

        <!-- Notifications List -->
        @if($notifications->count() > 0)
            <div class="bg-white rounded-lg shadow-md">
                @foreach($notifications as $notification)
                    <div class="border-b border-gray-200 last:border-b-0 {{ $notification->read_at ? 'bg-white' : 'bg-indigo-50' }}">
                        <div class="p-6">
                            <div class="flex items-start justify-between">
                                <div class="flex items-start flex-1">
                                    <!-- Notification Icon -->
                                    <div class="flex-shrink-0 ml-4">
                                        <div class="h-10 w-10 rounded-full bg-indigo-100 flex items-center justify-center">
                                            @if($notification->data['job_id'])
                                                <i class="fas fa-briefcase text-indigo-600"></i>
                                            @else
                                                <i class="fas fa-bell text-indigo-600"></i>
                                            @endif
                                        </div>
                                    </div>
                                    
                                    <!-- Notification Content -->
                                    <div class="flex-1 mr-4">
                                        <h3 class="text-lg font-semibold text-gray-900">
                                            {{ $notification->data['title'] ?? 'إشعار جديد' }}
                                        </h3>
                                        <p class="text-gray-600 mt-1">
                                            {{ $notification->data['message'] ?? 'لديك إشعار جديد' }}
                                        </p>
                                        
                                        <!-- Job Info -->
                                        @if($notification->data['job_id'])
                                        <div class="mt-3 p-3 bg-white rounded-lg border border-gray-200">
                                            <p class="text-sm text-gray-700">
                                                <i class="fas fa-link ml-1"></i>
                                                <a href="{{ route('jobs.show', $notification->data['job_id']) }}" 
                                                   class="text-indigo-600 hover:text-indigo-900 font-medium">
                                                    عرض الوظيفة
                                                </a>
                                            </p>
                                        </div>
                                        @endif
                                        
                                        <!-- Meta Info -->
                                        <div class="mt-3 flex items-center text-sm text-gray-500">
                                            <i class="fas fa-clock ml-1"></i>
                                            {{ $notification->created_at->diffForHumans() }}
                                            
                                            @if($notification->read_at)
                                                <span class="mr-4">
                                                    <i class="fas fa-check-circle ml-1 text-green-500"></i>
                                                    تمت قراءته
                                                </span>
                                            @else
                                                <span class="mr-4">
                                                    <i class="fas fa-circle ml-1 text-indigo-600"></i>
                                                    غير مقروء
                                                </span>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                                
                                <!-- Actions -->
                                <div class="flex items-center space-x-2 space-x-reverse mr-4">
                                    @if(!$notification->read_at)
                                        <form action="{{ route('notifications.mark-as-read', $notification->id) }}" method="POST" class="inline">
                                            @csrf
                                            @method('PATCH')
                                            <button type="submit" 
                                                    class="text-indigo-600 hover:text-indigo-900"
                                                    title="تحديد كمقروء">
                                                <i class="fas fa-check"></i>
                                            </button>
                                        </form>
                                    @endif
                                    
                                    <form action="{{ route('notifications.destroy', $notification->id) }}" 
                                          method="POST" 
                                          class="inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" 
                                                class="text-red-600 hover:text-red-900"
                                                title="حذف الإشعار"
                                                onclick="return confirm('هل أنت متأكد من حذف هذا الإشعار؟')">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    @endforeach
            </div>
            
            <!-- Pagination -->
            <div class="mt-6">
                {{ $notifications->links() }}
            </div>
        @else
            <div class="text-center py-12">
                <i class="fas fa-bell-slash text-6xl text-gray-400 mb-6"></i>
                <h3 class="text-xl font-semibold text-gray-900 mb-2">لا توجد إشعارات</h3>
                <p class="text-gray-600">لم تتلق أي إشعارات بعد</p>
                <p class="text-sm text-gray-500 mt-2">عندما تتلقى إشعارات، ستظهر هنا</p>
            </div>
        @endif
    </div>
</div>
@endsection
