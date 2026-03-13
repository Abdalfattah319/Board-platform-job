<!-- Premium Dashboard Widget -->
<div class="group relative bg-gradient-to-br from-white to-gray-50 rounded-2xl shadow-lg hover:shadow-2xl transition-all duration-500 overflow-hidden border border-gray-100">
    <!-- Animated Background -->
    <div class="absolute inset-0 bg-gradient-to-br from-blue-500/5 to-indigo-500/5"></div>
    
    <!-- Content -->
    <div class="relative p-6">
        <div class="flex items-center justify-between mb-4">
            <div>
                <h3 class="text-lg font-bold text-gray-900 flex items-center gap-2">
                    الوظائف المحفوظة
                    <span class="px-2 py-1 bg-blue-100 text-blue-600 text-xs rounded-full">+3</span>
                </h3>
                <p class="text-3xl font-bold bg-gradient-to-r from-blue-600 to-indigo-600 bg-clip-text text-transparent mt-2">
                    {{ $savedJobsCount ?? 0 }}
                </p>
                <p class="text-sm text-gray-600 mt-1">
                    <span class="text-green-600">↑ 12%</span> عن الأسبوع الماضي
                </p>
            </div>
            
            <div class="relative">
                <div class="absolute inset-0 bg-blue-100 rounded-full blur-xl opacity-50 animate-pulse"></div>
                <div class="relative bg-gradient-to-br from-blue-500 to-indigo-600 p-4 rounded-2xl text-white">
                    <i class="fas fa-bookmark text-2xl"></i>
                </div>
            </div>
        </div>
        
        <!-- Mini Chart -->
        <div class="h-16 flex items-end gap-1 mb-4">
            <div class="flex-1 bg-gradient-to-t from-blue-500 to-blue-300 rounded-t" style="height: 40%"></div>
            <div class="flex-1 bg-gradient-to-t from-blue-500 to-blue-300 rounded-t" style="height: 60%"></div>
            <div class="flex-1 bg-gradient-to-t from-blue-500 to-blue-300 rounded-t" style="height: 80%"></div>
            <div class="flex-1 bg-gradient-to-t from-blue-500 to-blue-300 rounded-t" style="height: 45%"></div>
            <div class="flex-1 bg-gradient-to-t from-blue-500 to-blue-300 rounded-t" style="height: 90%"></div>
            <div class="flex-1 bg-gradient-to-t from-blue-500 to-blue-300 rounded-t" style="height: 70%"></div>
            <div class="flex-1 bg-gradient-to-t from-blue-500 to-blue-300 rounded-t" style="height: 85%"></div>
        </div>
        
        <a href="{{ route('saved-jobs.index') }}" 
           class="block w-full text-center bg-gradient-to-r from-blue-600 to-indigo-600 text-white py-3 rounded-xl hover:from-blue-700 hover:to-indigo-700 transition-all duration-300 hover:shadow-lg hover:scale-[1.02]">
            عرض جميع الوظائف المحفوظة
        </a>
    </div>
    
    <!-- Hover Effect -->
    <div class="absolute inset-0 bg-gradient-to-t from-blue-600/10 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-500 pointer-events-none"></div>
</div>
