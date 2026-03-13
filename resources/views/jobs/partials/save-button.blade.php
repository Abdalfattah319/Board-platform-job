<!-- Enhanced Save Button -->
<div class="relative">
    <button id="saveJobBtn_{{ $job->id }}" 
            class="save-job-btn-advanced group relative p-3 rounded-xl transition-all duration-500"
            data-job-id="{{ $job->id }}"
            data-is-saved="{{ $isSaved ?? '0' }}">
        
        <!-- Background Effect -->
        <div class="absolute inset-0 bg-gradient-to-r from-pink-500 to-red-500 rounded-xl opacity-0 group-hover:opacity-20 transition-opacity"></div>
        
        <!-- Icon Container -->
        <div class="relative">
            <i class="fas fa-heart text-2xl transition-all duration-500 {{ $isSaved ? 'text-red-500 scale-110' : 'text-gray-400' }}"></i>
            
            <!-- Ripple Effect -->
            <div class="absolute inset-0 rounded-xl bg-red-500 opacity-0 scale-0 group-hover:scale-150 group-hover:opacity-20 transition-all duration-500"></div>
        </div>
        
        <!-- Tooltip -->
        <span class="absolute -top-10 right-0 bg-gray-900 text-white text-xs px-3 py-2 rounded-lg opacity-0 group-hover:opacity-100 transition-all duration-300 whitespace-nowrap pointer-events-none">
            {{ $isSaved ? 'محفوظة' : 'حفظ الوظيفة' }}
        </span>
        
        <!-- Particle Effects -->
        <div class="absolute inset-0 pointer-events-none">
            @if($isSaved)
                <div class="particle"></div>
                <div class="particle" style="animation-delay: 0.2s"></div>
                <div class="particle" style="animation-delay: 0.4s"></div>
            @endif
        </div>
    </button>
</div>

<style>
.save-job-btn-advanced {
    @apply bg-white border-2 border-gray-200 hover:border-red-300 hover:shadow-lg;
}

.save-job-btn-advanced.saved {
    @apply border-red-300 bg-red-50;
}

.particle {
    position: absolute;
    width: 4px;
    height: 4px;
    background: #ef4444;
    border-radius: 50%;
    top: 50%;
    left: 50%;
    animation: particle-explosion 1s ease-out forwards;
}

@keyframes particle-explosion {
    0% {
        transform: translate(-50%, -50%) scale(0);
        opacity: 1;
    }
    100% {
        transform: translate(-50%, -50%) scale(20);
        opacity: 0;
    }
}
</style>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const saveBtn = document.getElementById('saveJobBtn_{{ $job->id }}');
    if (saveBtn) {
        saveBtn.addEventListener('click', function(e) {
            e.preventDefault();
            const jobId = this.dataset.jobId;
            const isSaved = this.dataset.isSaved === '1';
            
            // Toggle animation
            this.classList.add('animate-pulse');
            
            // Simulate API call
            setTimeout(() => {
                if (isSaved) {
                    // Unsave
                    this.dataset.isSaved = '0';
                    this.querySelector('i').classList.remove('text-red-500', 'scale-110');
                    this.querySelector('i').classList.add('text-gray-400');
                    this.classList.remove('saved');
                } else {
                    // Save
                    this.dataset.isSaved = '1';
                    this.querySelector('i').classList.remove('text-gray-400');
                    this.querySelector('i').classList.add('text-red-500', 'scale-110');
                    this.classList.add('saved');
                }
                
                this.classList.remove('animate-pulse');
            }, 500);
        });
    }
});
</script>
