@props(['type' => 'success', 'message' => null, 'dismissible' => true, 'timeout' => 5000])

@php
    $typeClasses = [
        'success' => 'bg-gradient-to-r from-green-50 to-emerald-50 border-green-200 text-green-800',
        'error' => 'bg-gradient-to-r from-red-50 to-rose-50 border-red-200 text-red-800',
        'warning' => 'bg-gradient-to-r from-amber-50 to-yellow-50 border-amber-200 text-amber-800',
        'info' => 'bg-gradient-to-r from-blue-50 to-indigo-50 border-blue-200 text-blue-800',
    ];

    $iconClasses = [
        'success' => 'fas fa-check-circle text-green-500',
        'error' => 'fas fa-exclamation-circle text-red-500',
        'warning' => 'fas fa-exclamation-triangle text-amber-500',
        'info' => 'fas fa-info-circle text-blue-500',
    ];

    $currentClass = $typeClasses[$type] ?? $typeClasses['success'];
    $currentIcon = $iconClasses[$type] ?? $iconClasses['success'];
@endphp

@if($message || session($type))
    <div 
        class="alert-container relative overflow-hidden rounded-xl border shadow-lg backdrop-blur-sm transition-all duration-500 ease-out {{ $currentClass }} {{ $dismissible ? 'alert-dismissible' : '' }}"
        x-data="{ 
            show: true, 
            progress: 100,
            init() {
                @if($timeout > 0)
                    setTimeout(() => this.close(), {{ $timeout }});
                    this.animateProgress();
                @endif
            },
            animateProgress() {
                const duration = {{ $timeout }};
                const interval = 50;
                const step = (interval / duration) * 100;
                
                const timer = setInterval(() => {
                    this.progress -= step;
                    if (this.progress <= 0) {
                        clearInterval(timer);
                    }
                }, interval);
            },
            close() {
                this.show = false;
                setTimeout(() => this.$el.remove(), 300);
            }
        }"
        x-show="show"
        x-transition:enter="transition ease-out duration-300"
        x-transition:enter-start="opacity-0 transform translate-x-full"
        x-transition:enter-end="opacity-100 transform translate-x-0"
        x-transition:leave="transition ease-in duration-300"
        x-transition:leave-start="opacity-100 transform translate-x-0"
        x-transition:leave-end="opacity-0 transform translate-x-full"
        data-aos="fade-left"
        data-aos-duration="500"
    >
        <!-- Progress Bar -->
        @if($timeout > 0)
            <div class="absolute top-0 left-0 h-1 bg-gradient-to-r from-green-400 to-emerald-400 transition-all duration-50 ease-linear" 
                 :style="`width: ${progress}%`"
                 x-show="show">
            </div>
        @endif

        <!-- Alert Content -->
        <div class="flex items-center justify-between p-4">
            <div class="flex items-center space-x-3 space-x-reverse">
                <!-- Icon -->
                <div class="flex-shrink-0">
                    <i class="{{ $currentIcon }} text-xl animate-pulse"></i>
                </div>
                
                <!-- Message -->
                <div class="flex-1">
                    <p class="font-medium text-sm leading-relaxed">
                        {{ $message ?? session($type) }}
                    </p>
                </div>
            </div>

            <!-- Close Button -->
            @if($dismissible)
                <button 
                    @click="close()"
                    class="flex-shrink-0 ml-4 p-1 rounded-full hover:bg-black hover:bg-opacity-10 transition-colors duration-200 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500"
                    aria-label="إغلاق"
                >
                    <i class="fas fa-times text-gray-500 hover:text-gray-700 text-sm"></i>
                </button>
            @endif
        </div>

        <!-- Decorative Elements -->
        <div class="absolute top-0 left-0 w-20 h-20 bg-gradient-to-br from-white to-transparent opacity-20 rounded-full -translate-x-10 -translate-y-10"></div>
        <div class="absolute bottom-0 right-0 w-16 h-16 bg-gradient-to-tl from-white to-transparent opacity-10 rounded-full translate-x-8 translate-y-8"></div>
    </div>
@endif