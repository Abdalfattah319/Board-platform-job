{{-- Global Notification System Component --}}

@push('styles')
<style>
/* Global Notification System */
.notification-container {
    position: fixed;
    top: 20px;
    right: 20px;
    z-index: 9999;
    pointer-events: none;
}

.notification {
    pointer-events: auto;
    min-width: 320px;
    max-width: 420px;
    transform: translateX(100%);
    opacity: 0;
    transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
}

.notification.show {
    transform: translateX(0);
    opacity: 1;
}

.notification.hide {
    transform: translateX(100%);
    opacity: 0;
}

/* Notification Types */
.notification-success {
    background: linear-gradient(135deg, #10b981 0%, #059669 100%);
    color: white;
    box-shadow: 0 10px 25px rgba(16, 185, 129, 0.3);
}

.notification-error {
    background: linear-gradient(135deg, #ef4444 0%, #dc2626 100%);
    color: white;
    box-shadow: 0 10px 25px rgba(239, 68, 68, 0.3);
}

.notification-info {
    background: linear-gradient(135deg, #3b82f6 0%, #2563eb 100%);
    color: white;
    box-shadow: 0 10px 25px rgba(59, 130, 246, 0.3);
}

.notification-warning {
    background: linear-gradient(135deg, #f59e0b 0%, #d97706 100%);
    color: white;
    box-shadow: 0 10px 25px rgba(245, 158, 11, 0.3);
}

/* Notification Content */
.notification-content {
    display: flex;
    align-items: flex-start;
    gap: 12px;
    padding: 16px 20px;
    border-radius: 16px;
    backdrop-filter: blur(10px);
    position: relative;
    overflow: hidden;
}

.notification-icon {
    flex-shrink: 0;
    width: 24px;
    height: 24px;
    display: flex;
    align-items: center;
    justify-content: center;
    border-radius: 50%;
    background: rgba(255, 255, 255, 0.2);
}

.notification-text {
    flex: 1;
}

.notification-title {
    font-weight: 600;
    font-size: 14px;
    margin-bottom: 4px;
    line-height: 1.2;
}

.notification-message {
    font-size: 13px;
    opacity: 0.9;
    line-height: 1.3;
}

.notification-close {
    position: absolute;
    top: 8px;
    left: 8px;
    width: 20px;
    height: 20px;
    display: flex;
    align-items: center;
    justify-content: center;
    border-radius: 50%;
    background: rgba(255, 255, 255, 0.1);
    cursor: pointer;
    transition: all 0.2s;
    opacity: 0.7;
}

.notification-close:hover {
    background: rgba(255, 255, 255, 0.2);
    opacity: 1;
}

/* Progress Bar */
.notification-progress {
    position: absolute;
    bottom: 0;
    left: 0;
    height: 3px;
    background: rgba(255, 255, 255, 0.3);
    border-radius: 0 0 16px 16px;
    transition: width linear;
}

/* Animations */
@keyframes slideInRight {
    from {
        transform: translateX(100%);
        opacity: 0;
    }
    to {
        transform: translateX(0);
        opacity: 1;
    }
}

@keyframes slideOutRight {
    from {
        transform: translateX(0);
        opacity: 1;
    }
    to {
        transform: translateX(100%);
        opacity: 0;
    }
}

@keyframes pulse {
    0%, 100% {
        transform: scale(1);
    }
    50% {
        transform: scale(1.05);
    }
}

.notification-enter {
    animation: slideInRight 0.4s cubic-bezier(0.4, 0, 0.2, 1);
}

.notification-exit {
    animation: slideOutRight 0.4s cubic-bezier(0.4, 0, 0.2, 1);
}

/* Responsive */
@media (max-width: 640px) {
    .notification-container {
        top: 10px;
        right: 10px;
        left: 10px;
    }
    
    .notification {
        min-width: auto;
        max-width: none;
    }
}
</style>
@endpush

@push('scripts')
<script>
// Global Notification System
class NotificationSystem {
    constructor() {
        this.container = null;
        this.notifications = [];
        this.init();
    }

    init() {
        // Create container if not exists
        if (!document.querySelector('.notification-container')) {
            this.container = document.createElement('div');
            this.container.className = 'notification-container';
            document.body.appendChild(this.container);
        } else {
            this.container = document.querySelector('.notification-container');
        }
    }

    show(message, type = 'info', options = {}) {
        const {
            title = this.getDefaultTitle(type),
            duration = this.getDefaultDuration(type),
            closable = true,
            progress = true
        } = options;

        const id = Date.now() + Math.random();
        const notification = this.createNotification(id, message, title, type, closable, progress);
        
        this.container.appendChild(notification);
        this.notifications.push({ id, element: notification, type });

        // Trigger animation
        setTimeout(() => notification.classList.add('show'), 10);

        // Auto hide
        if (duration > 0) {
            this.startProgress(notification, duration);
            setTimeout(() => this.hide(id), duration);
        }

        return id;
    }

    hide(id) {
        const notificationIndex = this.notifications.findIndex(n => n.id === id);
        if (notificationIndex === -1) return;

        const { element, type } = this.notifications[notificationIndex];
        
        element.classList.add('hide');
        
        setTimeout(() => {
            if (element.parentNode) {
                element.parentNode.removeChild(element);
            }
            this.notifications.splice(notificationIndex, 1);
        }, 400);
    }

    createNotification(id, message, title, type, closable, progress) {
        const notification = document.createElement('div');
        notification.className = `notification notification-${type}`;
        notification.dataset.id = id;

        const icon = this.getIcon(type);
        
        notification.innerHTML = `
            <div class="notification-content">
                <div class="notification-icon">
                    <i class="fas ${icon}"></i>
                </div>
                <div class="notification-text">
                    <div class="notification-title">${title}</div>
                    <div class="notification-message">${message}</div>
                </div>
                ${closable ? `
                    <button class="notification-close" onclick="notificationSystem.hide(${id})">
                        <i class="fas fa-times text-xs"></i>
                    </button>
                ` : ''}
                ${progress ? '<div class="notification-progress"></div>' : ''}
            </div>
        `;

        return notification;
    }

    startProgress(notification, duration) {
        const progressBar = notification.querySelector('.notification-progress');
        if (!progressBar) return;

        progressBar.style.transition = `width ${duration}ms linear`;
        progressBar.style.width = '0%';
        
        // Force reflow
        notification.offsetHeight;
        
        progressBar.style.width = '100%';
    }

    getDefaultTitle(type) {
        const titles = {
            success: 'نجاح!',
            error: 'خطأ!',
            info: 'معلومة',
            warning: 'تنبيه'
        };
        return titles[type] || 'معلومة';
    }

    getDefaultDuration(type) {
        const durations = {
            success: 4000,
            error: 6000,
            info: 3000,
            warning: 5000
        };
        return durations[type] || 3000;
    }

    getIcon(type) {
        const icons = {
            success: 'fa-check',
            error: 'fa-exclamation',
            info: 'fa-info',
            warning: 'fa-exclamation-triangle'
        };
        return icons[type] || 'fa-info';
    }

    // Convenience methods
    success(message, options = {}) {
        return this.show(message, 'success', options);
    }

    error(message, options = {}) {
        return this.show(message, 'error', options);
    }

    info(message, options = {}) {
        return this.show(message, 'info', options);
    }

    warning(message, options = {}) {
        return this.show(message, 'warning', options);
    }

    // Clear all notifications
    clear() {
        this.notifications.forEach(({ id }) => this.hide(id));
    }
}

// Initialize global notification system
window.notificationSystem = new NotificationSystem();

// Global helper functions for backward compatibility
window.showNotification = function(message, type = 'info', options = {}) {
    return window.notificationSystem.show(message, type, options);
};

window.showSuccess = function(message, options = {}) {
    return window.notificationSystem.success(message, options);
};

window.showError = function(message, options = {}) {
    return window.notificationSystem.error(message, options);
};

window.showInfo = function(message, options = {}) {
    return window.notificationSystem.info(message, options);
};

window.showWarning = function(message, options = {}) {
    return window.notificationSystem.warning(message, options);
};
</script>
@endpush
