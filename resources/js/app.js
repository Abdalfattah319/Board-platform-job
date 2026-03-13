import './bootstrap';
import Alpine from 'alpinejs';
import persist from '@alpinejs/persist';
import AOS from 'aos';
import 'aos/dist/aos.css';

// Initialize AOS
AOS.init({
    duration: 800,
    easing: 'ease-in-out',
    once: true
});

// Initialize Alpine.js
window.Alpine = Alpine;
Alpine.plugin(persist);
Alpine.start();