<svg width="40" height="40" viewBox="0 0 40 40" fill="none" xmlns="http://www.w3.org/2000/svg" {{ $attributes }}>
  <!-- Background Circle with subtle glow -->
  <circle cx="20" cy="20" r="18" fill="url(#gradient1)" opacity="0.1"/>
  <circle cx="20" cy="20" r="16" fill="url(#gradient1)" stroke="url(#gradient1)" stroke-width="0.5" opacity="0.9"/>
  
  <!-- Main Briefcase Icon -->
  <g transform="translate(20, 20)">
    <!-- Briefcase Body -->
    <rect x="-8" y="-2" width="16" height="12" rx="2" fill="white" opacity="0.95"/>
    <!-- Briefcase Handle -->
    <rect x="-4" y="-4" width="8" height="4" rx="1" fill="white" opacity="0.95"/>
    <!-- Briefcase Lock -->
    <circle cx="0" cy="4" r="1.5" fill="url(#gradient2)" opacity="0.8"/>
  </g>
  
  <!-- Network Nodes -->
  <g opacity="0.7">
    <!-- Top Node -->
    <circle cx="20" cy="8" r="2" fill="url(#gradient2)"/>
    <line x1="20" y1="10" x2="20" y2="14" stroke="url(#gradient2)" stroke-width="1.5"/>
    
    <!-- Left Node -->
    <circle cx="10" cy="20" r="2" fill="url(#gradient2)"/>
    <line x1="12" y1="20" x2="14" y2="20" stroke="url(#gradient2)" stroke-width="1.5"/>
    
    <!-- Right Node -->
    <circle cx="30" cy="20" r="2" fill="url(#gradient2)"/>
    <line x1="28" y1="20" x2="26" y2="20" stroke="url(#gradient2)" stroke-width="1.5"/>
  </g>
  
  <!-- Animated Pulse Effect -->
  <circle cx="20" cy="20" r="16" fill="none" stroke="url(#gradient1)" stroke-width="1" opacity="0.3">
    <animate attributeName="r" values="16;18;16" dur="3s" repeatCount="indefinite"/>
    <animate attributeName="opacity" values="0.3;0.1;0.3" dur="3s" repeatCount="indefinite"/>
  </circle>
  
  <!-- Definitions -->
  <defs>
    <linearGradient id="gradient1" x1="0%" y1="0%" x2="100%" y2="100%">
      <stop offset="0%" style="stop-color:#4F46E5;stop-opacity:1" />
      <stop offset="50%" style="stop-color:#7C3AED;stop-opacity:1" />
      <stop offset="100%" style="stop-color:#EC4899;stop-opacity:1" />
    </linearGradient>
    <linearGradient id="gradient2" x1="0%" y1="0%" x2="100%" y2="100%">
      <stop offset="0%" style="stop-color:#10B981;stop-opacity:1" />
      <stop offset="100%" style="stop-color:#3B82F6;stop-opacity:1" />
    </linearGradient>
  </defs>
</svg>
