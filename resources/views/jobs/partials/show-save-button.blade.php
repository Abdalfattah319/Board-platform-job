<!-- Enhanced Save Button for Job Show Page -->
<div class="mb-6">
    @auth
        <form id="saveJobForm" action="#" method="POST" class="inline">
            @csrf
            <button type="submit" 
                    id="saveJobBtn"
                    class="save-job-btn {{ $isSaved ?? false ? 'saved' : '' }}"
                    data-job-id="{{ $job->id }}">
                <div class="flex items-center gap-3 px-6 py-3 rounded-xl border-2 transition-all duration-300 {{ $isSaved ?? false ? 'border-red-300 bg-red-50 text-red-600' : 'border-gray-300 bg-white text-gray-700 hover:border-red-300 hover:bg-red-50' }}">
                    <i class="fas fa-heart text-xl {{ $isSaved ?? false ? 'text-red-500' : 'text-gray-400' }}"></i>
                    <span class="font-medium">{{ $isSaved ?? false ? 'الوظيفة محفوظة' : 'حفظ الوظيفة' }}</span>
                </div>
            </button>
        </form>
    @else
        <a href="{{ route('login') }}" 
           class="inline-flex items-center gap-3 px-6 py-3 bg-gray-100 text-gray-600 rounded-xl hover:bg-gray-200 transition-colors">
            <i class="fas fa-heart text-gray-400"></i>
            <span class="font-medium">سجل دخول لحفظ الوظيفة</span>
        </a>
    @endauth
</div>

<style>
.save-job-btn {
    position: relative;
    overflow: hidden;
}

.save-job-btn::before {
    content: '';
    position: absolute;
    top: 50%;
    left: 50%;
    width: 0;
    height: 0;
    border-radius: 50%;
    background: rgba(239, 68, 68, 0.1);
    transform: translate(-50%, -50%);
    transition: width 0.6s, height 0.6s;
}

.save-job-btn:active::before {
    width: 300px;
    height: 300px;
}

.save-job-btn.saved i {
    animation: heartBeat 1.3s ease-in-out infinite;
}

@keyframes heartBeat {
    0% { transform: scale(1); }
    14% { transform: scale(1.3); }
    28% { transform: scale(1); }
    42% { transform: scale(1.3); }
    70% { transform: scale(1); }
}
</style>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const saveForm = document.getElementById('saveJobForm');
    if (saveForm) {
        saveForm.addEventListener('submit', function(e) {
            e.preventDefault();
            
            const btn = document.getElementById('saveJobBtn');
            const icon = btn.querySelector('i');
            const text = btn.querySelector('span');
            const jobId = btn.dataset.jobId;
            const isSaved = btn.classList.contains('saved');
            
            // Change button state temporarily
            btn.disabled = true;
            icon.classList.add('fa-spin');
            
            // Simulate API call
            setTimeout(() => {
                if (isSaved) {
                    // Unsave
                    btn.classList.remove('saved');
                    btn.querySelector('div').classList.remove('border-red-300', 'bg-red-50', 'text-red-600');
                    btn.querySelector('div').classList.add('border-gray-300', 'bg-white', 'text-gray-700');
                    icon.classList.remove('text-red-500', 'fa-spin');
                    icon.classList.add('text-gray-400');
                    text.textContent = 'حفظ الوظيفة';
                } else {
                    // Save
                    btn.classList.add('saved');
                    btn.querySelector('div').classList.remove('border-gray-300', 'bg-white', 'text-gray-700');
                    btn.querySelector('div').classList.add('border-red-300', 'bg-red-50', 'text-red-600');
                    icon.classList.remove('text-gray-400', 'fa-spin');
                    icon.classList.add('text-red-500');
                    text.textContent = 'الوظيفة محفوظة';
                    
                    // Update form action for unsave
                    saveForm.action = `/jobs/${jobId}/unsave`;
                }
                
                btn.disabled = false;
                
                // Show toast notification
                showToast(isSaved ? 'تم إلغاء حفظ الوظيفة' : 'تم حفظ الوظيفة بنجاح');
            }, 800);
        });
    }
});

function showToast(message) {
    // Create toast element
    const toast = document.createElement('div');
    toast.className = 'fixed bottom-4 right-4 bg-gray-900 text-white px-6 py-3 rounded-lg shadow-lg transform translate-x-full transition-transform duration-300 z-50';
    toast.innerHTML = `
        <div class="flex items-center gap-3">
            <i class="fas fa-check-circle text-green-400"></i>
            <span>${message}</span>
        </div>
    `;
    
    document.body.appendChild(toast);
    
    // Show toast
    setTimeout(() => {
        toast.classList.remove('translate-x-full');
    }, 100);
    
    // Hide toast after 3 seconds
    setTimeout(() => {
        toast.classList.add('translate-x-full');
        setTimeout(() => {
            document.body.removeChild(toast);
        }, 300);
    }, 3000);
}
</script>
