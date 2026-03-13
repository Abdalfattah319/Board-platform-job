<!-- Advanced Job Card -->
<div class="group relative bg-white rounded-2xl shadow-lg hover:shadow-2xl transition-all duration-500 overflow-hidden border border-gray-100 hover:border-blue-200">
    <!-- Animated Background Gradient -->
    <div class="absolute inset-0 bg-gradient-to-br from-blue-50 via-transparent to-indigo-50 opacity-0 group-hover:opacity-100 transition-opacity duration-500"></div>
    
    <!-- Top Bar -->
    <div class="relative h-1 bg-gradient-to-r from-blue-500 via-indigo-500 to-purple-500"></div>
    
    <!-- Content -->
    <div class="relative p-6">
        <!-- Header Section -->
        <div class="flex items-start justify-between mb-4">
            <div class="flex items-center gap-4">
                <!-- Company Logo with Animation -->
                <div class="relative">
                    <img src="{{ asset('images/default-company.png') }}" 
                         alt="{{ $job->company->name }}" 
                         class="w-14 h-14 rounded-xl object-cover border-2 border-white shadow-lg group-hover:scale-110 transition-transform duration-300">
                    <div class="absolute -bottom-1 -right-1 w-4 h-4 bg-green-500 rounded-full border-2 border-white"></div>
                </div>
                
                <div>
                    <h3 class="text-xl font-bold text-gray-900 group-hover:text-blue-600 transition-colors">
                        <a href="{{ route('jobs.show', $job->id) }}" 
                           class="hover:underline">
                            {{ $job->title }}
                        </a>
                    </h3>
                    <p class="text-gray-600 font-medium">{{ $job->company->name }}</p>
                </div>
            </div>
            
            <!-- Save Button -->
            <div class="relative">
                <button class="save-job-card-btn group/btn relative p-2 bg-gray-50 rounded-xl hover:bg-red-50 transition-all duration-300 hover:scale-110"
                        data-job-id="{{ $job->id }}"
                        data-is-saved="{{ $isSaved ?? '0' }}">
                    <i class="fas fa-heart {{ $isSaved ? 'text-red-500' : 'text-gray-400' }} group-hover/btn:text-red-500 transition-colors"></i>
                    <span class="absolute -top-8 right-0 bg-gray-800 text-white text-xs px-2 py-1 rounded opacity-0 group-hover/btn:opacity-100 transition-opacity whitespace-nowrap">
                        {{ $isSaved ? 'محفوظة' : 'حفظ' }}
                    </span>
                </button>
            </div>
        </div>
        
        <!-- Job Details -->
        <div class="space-y-3 mb-4">
            <!-- Location & Type -->
            <div class="flex flex-wrap gap-2">
                <span class="inline-flex items-center px-3 py-1 rounded-full text-sm bg-blue-50 text-blue-700 border border-blue-200">
                    <i class="fas fa-map-marker-alt ml-2"></i>
                    {{ $job->location ?? 'الرياض' }}
                </span>
                <span class="inline-flex items-center px-3 py-1 rounded-full text-sm bg-purple-50 text-purple-700 border border-purple-200">
                    <i class="fas fa-briefcase ml-2"></i>
                    {{ $job->type ?? 'دوام كامل' }}
                </span>
                @if($job->experience_level)
                <span class="inline-flex items-center px-3 py-1 rounded-full text-sm bg-green-50 text-green-700 border border-green-200">
                    <i class="fas fa-chart-line ml-2"></i>
                    {{ $job->experience_level }}
                </span>
                @endif
            </div>
            
            <!-- Salary -->
            @if($job->salary)
            <div class="flex items-center gap-2 text-green-600 font-semibold">
                <i class="fas fa-money-bill-wave"></i>
                <span>{{ $job->salary }}</span>
            </div>
            @endif
            
            <!-- Description Snippet -->
            @if($job->description)
            <p class="text-gray-600 text-sm line-clamp-2">
                {{ Str::limit(strip_tags($job->description), 150) }}
            </p>
            @endif
        </div>
        
        <!-- Footer Section -->
        <div class="flex items-center justify-between pt-4 border-t border-gray-100">
            <!-- Posted Date -->
            <div class="flex items-center gap-2 text-xs text-gray-500">
                <i class="fas fa-clock"></i>
                <span>منذ {{ $job->created_at->diffForHumans() }}</span>
            </div>
            
            <!-- Action Buttons -->
            <div class="flex gap-2">
                <a href="{{ route('jobs.show', $job->id) }}" 
                   class="px-4 py-2 bg-gradient-to-r from-blue-600 to-indigo-600 text-white rounded-lg hover:from-blue-700 hover:to-indigo-700 transition-all duration-300 hover:shadow-lg hover:scale-105">
                    <i class="fas fa-eye ml-2"></i>
                    عرض
                </a>
                
                @if(!$job->applications()->where('user_id', auth()->id())->exists())
                <a href="{{ route('jobs.applications.create', $job->id) }}" 
                   class="px-4 py-2 bg-gradient-to-r from-green-600 to-emerald-600 text-white rounded-lg hover:from-green-700 hover:to-emerald-700 transition-all duration-300 hover:shadow-lg hover:scale-105">
                    <i class="fas fa-paper-plane ml-2"></i>
                    تقديم
                </a>
                @endif
            </div>
        </div>
    </div>
    
    <!-- Hover Effect Overlay -->
    <div class="absolute inset-0 bg-gradient-to-t from-blue-600/10 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-500 pointer-events-none"></div>
</div>

<style>
.line-clamp-2 {
    display: -webkit-box;
    -webkit-line-clamp: 2;
    -webkit-box-orient: vertical;
    overflow: hidden;
}
</style>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const saveBtns = document.querySelectorAll('.save-job-card-btn');
    saveBtns.forEach(btn => {
        btn.addEventListener('click', function(e) {
            e.preventDefault();
            const jobId = this.dataset.jobId;
            const isSaved = this.dataset.isSaved === '1';
            const icon = this.querySelector('i');
            
            // Toggle animation
            this.classList.add('animate-pulse');
            
            // Simulate API call
            setTimeout(() => {
                if (isSaved) {
                    // Unsave
                    this.dataset.isSaved = '0';
                    icon.classList.remove('text-red-500');
                    icon.classList.add('text-gray-400');
                } else {
                    // Save
                    this.dataset.isSaved = '1';
                    icon.classList.remove('text-gray-400');
                    icon.classList.add('text-red-500');
                }
                
                this.classList.remove('animate-pulse');
            }, 500);
        });
    });
});
</script>
